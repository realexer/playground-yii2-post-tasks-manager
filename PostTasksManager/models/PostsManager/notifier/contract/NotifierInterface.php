<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 12:27 PM
 */

namespace app\models\PostsManager\notifier\contract;

interface NotifierInterface
{
    public function send(string $message);
}