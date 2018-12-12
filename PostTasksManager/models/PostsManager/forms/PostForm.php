<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 9:16 PM
 */


namespace app\models\PostsManager\forms;

use app\models\PostsManager\model\schema\PostTypes;
use yii\base\Model;

class PostForm extends Model
{
    public $company_name;
    public $position;
    public $post_type;
    public $place_at;

    public function rules()
    {
        return [
            [['company_name', 'position', 'post_type', 'place_at'], 'required'],
            ['post_type', 'in', 'range' => PostTypes::getAll()],
            [['place_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['place_at'], 'compare', 'compareValue' => date("Y-m-d H:i:s"), 'operator' => '>'],
        ];
    }
}