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

class DescriptivePost extends ActiveRecord implements DataProviderInterface
{
    public static function tableName()
    {
        return '{{'.TablesList::posts_descriptive.'}}';
    }


    public function getLabeledData()
    {
        return [
            "Description" => $this->position_description,
            "Salary" => $this->salary,
            "Starts At" => $this->starts_at,
            "Ends At" => $this->ends_at,
        ];
    }
}