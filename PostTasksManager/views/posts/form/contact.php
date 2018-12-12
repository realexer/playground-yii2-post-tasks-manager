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
    <?php $form = ActiveForm::begin([
        'action' => 'index.php?r=posts/contact',
        'options' => ['data' => ['pjax' => true]],
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php if(\Yii::$app->session->hasFlash('PostAdded')):?>
        <div class="alert alert-success alert-dismissible PostAddedAlert" role="alert">
            <?php echo Yii::$app->session->getFlash('PostAdded'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <script>
            $(".PostAddedAlert").fadeTo(15000, 500).slideUp(500, function() {
                $(".PostAddedAlert").slideUp(500);
            });
        </script>
    <?php endif; ?>


    <?= $form->field($contact_form, 'post_type')->hiddenInput(['value' => PostTypes::contact])->label(false) ?>
    <?= $form->field($contact_form, 'company_name')->textInput() ?>
    <?= $form->field($contact_form, 'position')->textInput() ?>
    <?= $form->field($contact_form, 'contact_name')->textInput() ?>
    <?= $form->field($contact_form, 'contact_email')->textInput(['type' => 'email']) ?>
    <?php //TODO:  Use some date time picker, DataPicker from Yii/ui dosn't seems like support time part  ?>
    <?= $form->field($contact_form, 'place_at')->textInput(['type' => '', 'placeholder' => 'Y-m-d H:i:s', 'value' => date('Y-m-d H:i:s')]) ?>


    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'create-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    <?php Pjax::end(); ?>
