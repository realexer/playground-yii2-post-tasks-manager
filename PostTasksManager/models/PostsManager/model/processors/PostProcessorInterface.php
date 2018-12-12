<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 11:16 PM
 */

namespace app\models\PostsManager\model\processors;

use app\models\PostsManager\forms\PostForm;

interface PostProcessorInterface
{
    public function processPost(int $postId, PostForm $form);
}