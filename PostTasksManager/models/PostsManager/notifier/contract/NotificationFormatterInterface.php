<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 12:28 PM
 */

namespace app\models\PostsManager\notifier\contract;


interface NotificationFormatterInterface
{
    public function format(DataProviderInterface ...$post);
}