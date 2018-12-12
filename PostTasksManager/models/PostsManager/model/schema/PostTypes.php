<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 6:38 PM
 */

namespace app\models\PostsManager\model\schema;

class PostTypes
{
    const descriptive = 'descriptive';
    const contact = 'contact';

    public static function getAll()
    {
        return [
            self::descriptive,
            self::contact
        ];
    }

    public static function getTitles()
    {
        return [
            self::descriptive => 'descriptive',
            self::contact => 'contact'
        ];
    }
}