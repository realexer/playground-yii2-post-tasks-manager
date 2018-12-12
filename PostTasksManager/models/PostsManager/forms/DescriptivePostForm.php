<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 9:16 PM
 */

namespace app\models\PostsManager\forms;


class DescriptivePostForm extends PostForm
{
    public $position_description;
    public $salary;
    public $starts_at;
    public $ends_at;

    public function rules()
    {
        return array_merge([
            [['salary', 'starts_at', 'ends_at'], 'required'],
            [['position_description'], 'trim'],
            ['salary', 'number'],
            [['starts_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            [['starts_at'], 'compare', 'compareValue' => date("Y-m-d H:i:s"), 'operator' => '>'],
            [['ends_at'], 'datetime', 'format' => 'php:Y-m-d H:i:s'],
            ['ends_at', 'validatePeriod'],
        ], parent::rules());
    }

    public function validatePeriod()
    {
        $months = 3;
        if((strtotime($this->ends_at) - strtotime($this->starts_at)) < 60*60*24*30*$months)
        {
            $this->addError('ends_at', sprintf('Period should be at least %d month', $months));
        }
    }
}