<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $contact_form app\models\PostsManager\forms\ContactPostForm */
/* @var $descriptive_form app\models\PostsManager\forms\DescriptivePostForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use app\models\PostsManager\model\schema\PostTypes;

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form-horizontal">
        <div class="form-group">
            <label class="col-lg-1 control-label" for="">Type</label>
            <div class="col-lg-3">
                <select id="PostTypeSelector" class="form-control">
                    <?php foreach(array_merge(['placeholder' => ' - choose type -'], PostTypes::getTitles()) as $key=>$title): ?>
                        <option value="<?= $key ?>"><?= $title ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div id="PostForm-placeholder" class="PostForm text-center text-muted text-lg-center">
        <p>select type first</p>
    </div>

    <div id="PostForm-<?= PostTypes::contact ?>" class="PostForm" style="display: none;">
        <?= $this->render('form/contact', [
            'contact_form' => $contact_form
        ]); ?>
    </div>

    <div id="PostForm-<?= PostTypes::descriptive ?>" class="PostForm" style="display: none;">
        <?= $this->render('form/descriptive', [
            'descriptive_form' => $descriptive_form
        ]); ?>
    </div>


    <?php
    $this->registerJs(<<<JS
$(function(){
    $("#PostTypeSelector").change(function(){

        $(".PostForm").hide();
        $("#PostForm-" + $(this).val()).show();

    });
});
JS
, \yii\web\View::POS_READY,
        'my-button-handler'
    );
    ?>

</div>
