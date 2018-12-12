<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 12:38 AM
 */

namespace app\models\PostsManager\notifier\email;


use app\models\PostsManager\notifier\contract\NotifierInterface;

class Notifier implements NotifierInterface
{
    public function send(string $notification)
    {
        //
        // PRINT CONTENT FOR TESTING PURPOSE
        //
        echo "<pre>$notification</pre>";

        // TODO: send email...
        // - PUT EMAIL ADDRESSES OF THE RECIPIENTS INTO CONFIG
        // - ADD SOME EMAIL EXTENSION eg https://www.yiiframework.com/extension/yiimailer
        // - MAYBE EVEN GROUP NOTIFICATIONS IN ONE EMAIL TO REDUCE SPAMMING
        // - USE IT
    }
}