<?php
/**
 * Created by PhpStorm.
 * User: alexeyskrypnik
 * Date: 12/11/18
 * Time: 9:17 PM
 */

namespace app\models\PostsManager\forms;


class ContactPostForm extends PostForm
{
    public $contact_name;
    public $contact_email;

    public function rules()
    {
        return array_merge([
            [['contact_name', 'contact_email'], 'trim'],
            ['contact_email', 'required'],
            ['contact_email', 'email'],
        ], parent::rules());
    }
}