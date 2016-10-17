<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// Custom Datepicker
use kartik\widgets\DatePicker;
// Custom Fileinput
use kartik\file\FileInput;

?>

<div class="target-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'target_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Enter Target Month', 'autocomplete' => 'off'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'startView'=>'year',
                    'minViewMode'=>'months',
                    'format' => 'yyyy-mm'
                ]
            ]); ?>

    <?php 
    
    echo '<label class="control-label">CSV File</label>';
    
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'file',
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'showUpload' => false,
            'allowedFileExtensions'=>['csv'],
            'maxFileCount' => 1
        ]
    ]);
    ?>

    <div class="box-footer" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton('Upload CSV', ['class' => 'btn btn-primary']) ?>
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