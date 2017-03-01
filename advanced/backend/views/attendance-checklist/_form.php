<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AttendanceChecklist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="attendance-checklist-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'remark')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'retail_dms_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checklist_date')->textInput() ?>

    <?= $form->field($model, 'in_time')->textInput() ?>

    <?= $form->field($model, 'out_time')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Pending' => 'Pending', 'Approved' => 'Approved', 'Declined' => 'Declined', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
