<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 11:29 PM
 */

namespace app\models\PostsManager\model\entities;


use app\models\PostsManager\model\schema\TablesList;
use yii\db\ActiveRecord;

class PostQueue extends ActiveRecord
{
    public static function tableName()
    {
        return '{{'.TablesList::posts_queue.'}}';
    }

    /**
     * So that we can update rows using post_id
     * @return array|string[]
     */
    public static function primaryKey()
    {
        return ['post_id'];
    }

//    public $post_id;
//    public $place_at;
//    public $notification_sent_at;
}