<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 9:24 PM
 */

namespace app\controllers;

use app\models\PostsManager\forms\ContactPostForm;
use app\models\PostsManager\forms\DescriptivePostForm;
use app\models\PostsManager\forms\PostForm;
use app\models\PostsManager\model\processors\ContactPostProcessor;
use app\models\PostsManager\model\processors\DescriptivePostProcessor;
use app\models\PostsManager\model\processors\PostProcessorInterface;
use app\models\PostsManager\model\schema\PostTypes;
use app\models\PostsManager\notifier\email\Formatter;
use app\models\PostsManager\notifier\email\Notifier;
use app\models\PostsManager\notifier\Queue;
use app\models\PostsManager\PostsManager;
use Yii;
use yii\web\Controller;

class PostsController extends Controller
{
    public function actionCreate()
    {
        return $this->render('new_post', [
            'contact_form' => new ContactPostForm(),
            'descriptive_form' => new DescriptivePostForm(),
        ]);
    }

    public function actionDescriptive()
    {
        return $this->create(new DescriptivePostForm(), new DescriptivePostProcessor(), PostTypes::descriptive);
    }

    public function actionContact()
    {
        return $this->create(new ContactPostForm(), new ContactPostProcessor(), PostTypes::contact);
    }

    private function create(PostForm $form, PostProcessorInterface $processor, string $postType)
    {
        if ($form->load(Yii::$app->request->post()) && $form->validate())
        {
            $manager = new PostsManager();
            $post = $manager->addNew($form, $processor);

            $queue = new Queue();
            $queue->addNotification($post->id, new \DateTime($form->place_at));

            Yii::$app->session->setFlash('PostAdded', 'Post was added');

            // TODO: IS THERE RESET METHOD
            foreach($form as $key=>$val) {
                $form->{$key} = null;
            }
        }

        return $this->renderAjax('form/'.$postType, [
            $postType.'_form' => $form,
        ]);
    }

    /**
     * REGARDLESS OF WHETHER 'POST_AT' IS CURRENT DATE OR DATE IN THE FUTURE
     * PUT EVERYTHING IN QUEUE, AS THIS WAY WE CAN KEEP TRACK OF ALL THE NOTIFICATIONS
     * AS WELL CONTROL NOTIFICATIONS IN ONE PLACE INSTEAD OF MULTIPLE
     * RUN QUEUE AS THE CRON JOB
     */
    public function actionQueue()
    {
        (new Queue())->work(new Notifier(), new Formatter());

        return $this->asJson(true);
    }
}