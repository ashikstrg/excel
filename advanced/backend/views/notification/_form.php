<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Notification */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notification-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'module_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_employee_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'read_status')->dropDownList([ 'Read' => 'Read', 'Unread' => 'Unread', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'seen')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
