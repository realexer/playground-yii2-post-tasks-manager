<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 3:28 PM
 */

namespace app\models\PostsManager\model\processors;

use app\models\PostsManager\forms\DescriptivePostForm;
use app\models\PostsManager\forms\PostForm;
use app\models\PostsManager\model\entities\posts\DescriptivePost;

class DescriptivePostProcessor implements PostProcessorInterface
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
     * @param DescriptivePostForm $form
     */
    private function savePost(int $postId, DescriptivePostForm $form)
    {
        $post = new DescriptivePost();
        $post->post_id = $postId;
        $post->position_description = $form->position_description;
        $post->salary = $form->salary;
        $post->starts_at = $form->starts_at;
        $post->ends_at = $form->ends_at;

        $post->save();
    }
}