<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 2:34 PM
 */

namespace app\models\PostsManager\model\entities\posts;


use app\models\PostsManager\model\schema\PostTypes;
use app\models\PostsManager\model\schema\TablesList;
use http\Exception\UnexpectedValueException;

class PostLookuper
{
    public static function getPost(int $postId, string $type)
    {
        $t = null; // table

        $post = null; // post object

        switch ($type)
        {
            case PostTypes::contact:
                $t = TablesList::posts_contact;
                $post = new ContactPost();
                break;

            case PostTypes::descriptive:
                $t = TablesList::posts_descriptive;
                $post = new DescriptivePost();
                break;

            default:
                throw new UnexpectedValueException("Post type '{$type}'' is not supported.");
        }

        $data = (new \yii\db\Query())
            ->select(["$t.*"])
            ->from($t)
            ->where(['post_id' => $postId])
            ->one();

        if($data) {
            \Yii::configure($post, $data);
        }

        return $post;
    }
}