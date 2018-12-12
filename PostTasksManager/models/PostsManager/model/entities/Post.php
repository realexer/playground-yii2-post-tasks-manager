<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 9:04 PM
 */

namespace app\models\PostsManager\model\entities;

use app\models\PostsManager\model\schema\TablesList;
use app\models\PostsManager\notifier\contract\DataProviderInterface;
use yii\db\ActiveRecord;

class Post extends ActiveRecord implements DataProviderInterface
{
    public static function tableName()
    {
        return '{{'.TablesList::posts.'}}';
    }

//    public $id;
//    public $company_name;
//    public $position;
//    public $type;

    public function getLabeledData()
    {
        return [
            "id" => $this->id,
            "Type" => $this->type,
            "Company Name" => $this->company_name,
            "Position" => $this->position
        ];
    }
}