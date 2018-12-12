<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 12:34 AM
 */

namespace app\models\PostsManager\notifier;


use app\models\PostsManager\model\entities\Post;
use app\models\PostsManager\model\entities\posts\PostLookuper;
use app\models\PostsManager\model\entities\PostQueue;
use app\models\PostsManager\model\schema\TablesList;
use app\models\PostsManager\notifier\contract\NotificationFormatterInterface;
use app\models\PostsManager\notifier\contract\NotifierInterface;

class Queue
{
    public function addNotification(int $postId, \DateTime $placeAt)
    {
        $queue = new PostQueue();
        $queue->post_id = $postId;
        $queue->place_at = $placeAt->format('Y-m-d H:i:s');

        $queue->save();
    }

    public function work(NotifierInterface $notifier, NotificationFormatterInterface $formatter)
    {
        $p = TablesList::posts;
        $pq = TablesList::posts_queue;

        $posts = (new \yii\db\Query())
            ->select(["$p.*"])
            ->from($pq)
            ->join('INNER JOIN', $p, "$pq.post_id = $p.id")
            ->where(['<=', 'place_at', 'DATE_NOW()'])
            ->andWhere(['notification_sent_at' => null])
            ->orderBy(['place_at' => SORT_DESC])
            ->all();

        foreach ($posts as $key => $val)
        {
            $post = new Post($val);

            $notifier->send($formatter->format($post, PostLookuper::getPost($post->id, $post->type)));

            $customer = PostQueue::findOne(['post_id' => $post->id]);
            $customer->notification_sent_at = (new \DateTime())->format('Y-m-d H:i:s');
            $customer->save();
        }
    }
}