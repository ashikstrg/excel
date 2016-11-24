<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// Multiple Select
use kartik\widgets\Select2;
// Custom Datepicker
use kartik\widgets\DatePicker;

?>

<div class="training-assessment-category-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Assessment Name']) ?>
    
    <?= $form->field($model, 'message')->textInput(['maxlength' => true, 'placeholder' => 'Notification Message']) ?>

    <?= $form->field($model, 'designations')->widget(Select2::classname(), [
    'data' => $designationModel,
    'options' => ['placeholder' => 'Select Designation', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
    ],
    ]); ?>
    
    <?= $form->field($model, 'qlimit')->textInput(['maxlength' => true, 'placeholder' => 'Question Limitation']) ?>
    
    <?= $form->field($model, 'estimated_time')->textInput(['maxlength' => true, 'placeholder' => 'Estimated Time']) ?>

    <?= $form->field($model, 'date_month')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter Assesment Month', 'autocomplete' => 'off'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'startView'=>'year',
                    'minViewMode'=>'months',
                    'format' => 'yyyy-mm'
                ]
            ]); ?>

    <div class="box-footer" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Create Assessment' : 'Update Data', ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <?= Html::resetButton('Reset Form', ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
