<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// Custom Datepicker
use kartik\datetime\DateTimePicker;
// Multiple Select
use kartik\widgets\Select2;

if(!empty($model->designations)) {
    $model->designations = explode(',', $model->designations);
}

?>

<div class="training-pdf-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'designations')->widget(Select2::classname(), [
    'data' => $designationModel,
    'options' => ['placeholder' => 'Select Designation', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
    ],
    ]); ?>
    
    <?= $form->field($model, 'message')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'training_datetime')->widget(DateTimePicker::classname(), [
                'options' => ['placeholder' => 'Enter Training Date Time', 'autocomplete' => 'off'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd HH:ii P'
                ]
            ]); ?>

    <div class="box-footer" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Next Page' : 'Update Data', ['class' => 'btn btn-primary']) ?>
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