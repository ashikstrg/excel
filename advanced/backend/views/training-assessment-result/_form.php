<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentResult */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-assessment-result-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_employee_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_dms_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'score_percent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_month')->textInput() ?>

    <?= $form->field($model, 'participation_datetime')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Active' => 'Active', 'Inactive' => 'Inactive', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
