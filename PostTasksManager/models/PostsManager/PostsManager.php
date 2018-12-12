<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 9:09 PM
 */

namespace app\models\PostsManager;

use app\models\PostsManager\forms\PostForm;
use app\models\PostsManager\model\entities\Post;
use app\models\PostsManager\model\processors\PostProcessorInterface;

class PostsManager
{
    public function addNew(PostForm $data, PostProcessorInterface $processor)
    {
        $post = new Post();
        $post->company_name = $data->company_name;
        $post->position = $data->position;
        $post->type = $data->post_type;

        $post->save();

        $processor->processPost($post->id, $data);

        return $post;
    }
}