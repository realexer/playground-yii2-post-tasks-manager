<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 9:14 PM
 */

namespace app\models\PostsManager\model\entities\posts;

use app\models\PostsManager\model\schema\TablesList;
use app\models\PostsManager\notifier\contract\DataProviderInterface;
use yii\db\ActiveRecord;

class ContactPost extends ActiveRecord implements DataProviderInterface
{
    public static function tableName()
    {
        return '{{'.TablesList::posts_contact.'}}';
    }

//    public $post_id;
//    public $contact_name;
//    public $contact_email;

    public function getLabeledData()
    {
        return [
            "Contact Name" => $this->contact_name,
            "Contact Email" => $this->contact_email
        ];
    }
}