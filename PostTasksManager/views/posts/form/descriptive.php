<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $contact_form app\models\PostsManager\forms\ContactPostForm */
/* @var $descriptive_form app\models\PostsManager\forms\DescriptivePostForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use app\models\PostsManager\model\schema\PostTypes;

?>


    <?php Pjax::begin(['enablePushState' => false]); ?>

    <?php if(\Yii::$app->session->hasFlash('PostAdded')):?>
        <div class="alert alert-success alert-dismissible PostAddedAlert" role="alert">
            <?php echo Yii::$app->session->getFlash('PostAdded'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            $(".PostAddedAlert").fadeTo(15000, 500).slideUp(500, function(){
                $(".PostAddedAlert").slideUp(500);
            });
        </script>
    <?php endif; ?>

    <?php $form = ActiveForm::begin([
        'action' => 'index.php?r=posts/descriptive',
        'options' => ['data' => ['pjax' => true]],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>


    <?= $form->field($descriptive_form, 'post_type')->hiddenInput(['value' => PostTypes::descriptive])->label(false) ?>
    <?= $form->field($descriptive_form, 'company_name')->textInput() ?>
    <?= $form->field($descriptive_form, 'position')->textInput() ?>
    <?= $form->field($descriptive_form, 'position_description')->textarea() ?>
    <?= $form->field($descriptive_form, 'salary')->textInput(['type' => 'int']) ?>
    <?php //TODO:  Use some date time picker, DataPicker from Yii/ui dosn't seems like support time part  ?>
    <?= $form->field($descriptive_form, 'starts_at')->textInput(['type' => '', 'placeholder' => 'Y-m-d H:i:s', 'value' => date('Y-m-d H:i:s')]) ?>
    <?= $form->field($descriptive_form, 'ends_at')->textInput(['type' => '', 'placeholder' => 'Y-m-d H:i:s']) ?>
    <?= $form->field($descriptive_form, 'place_at')->textInput(['type' => '', 'placeholder' => 'Y-m-d H:i:s', 'value' => date('Y-m-d H:i:s')]) ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
</div>

