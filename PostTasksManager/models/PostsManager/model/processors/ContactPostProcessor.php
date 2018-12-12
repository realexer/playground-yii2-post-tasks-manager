<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 11:16 PM
 */

namespace app\models\PostsManager\model\processors;

use app\models\PostsManager\forms\ContactPostForm;
use app\models\PostsManager\forms\PostForm;
use app\models\PostsManager\model\entities\posts\ContactPost;

class ContactPostProcessor implements PostProcessorInterface
{

    /**
     * @param int $postId
     * @param PostForm $form
     */
    public function processPost(int $postId, PostForm $form)
    {
        $this->savePost($postId, $form);
    }

    /**
     * @param int $postId
     * @param ContactPostForm $form
     */
    private function savePost(int $postId, ContactPostForm $form)
    {
        $contactPost = new ContactPost();
        $contactPost->post_id = $postId;
        $contactPost->contact_name = $form->contact_name;
        $contactPost->contact_email = $form->contact_email;

        $contactPost->save();
    }
}