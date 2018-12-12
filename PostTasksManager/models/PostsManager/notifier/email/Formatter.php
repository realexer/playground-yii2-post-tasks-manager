<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 12:22 PM
 */

namespace app\models\PostsManager\notifier\email;


use app\models\PostsManager\notifier\contract\DataProviderInterface;
use app\models\PostsManager\notifier\contract\NotificationFormatterInterface;

class Formatter implements NotificationFormatterInterface
{
    public function format(DataProviderInterface ...$post)
    {
        $notif = "New post needs to be posted: \n\n";

        foreach($post as $p)
        {
            foreach($p->getLabeledData() as $label => $data)
            {
                $notif.= "$label: $data \n";
            }
        }

        return $notif;
    }
}