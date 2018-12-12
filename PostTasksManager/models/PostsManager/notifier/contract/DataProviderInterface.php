<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/12/18
 * Time: 3:00 PM
 */

namespace app\models\PostsManager\notifier\contract;


interface DataProviderInterface
{
    public function getLabeledData();
}