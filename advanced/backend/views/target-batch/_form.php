<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// Custom Datepicker
use kartik\widgets\DatePicker;

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

    <?= $form->field($model, 'file')->fileInput() ?>
    
    <?php
    if ($model->file_import) {
        echo '<img src="'.\Yii::$app->urlManagerFrontend->baseUrl.'/'.$model->file_import.'" width="90px">&nbsp;&nbsp;&nbsp;';
        echo Html::a('Delete Files', ['deleteimg', 'id'=>$model->id, 'field'=> 'file_import'], ['class'=>'btn btn-danger']).'<p>';
    }
    ?>

    <div class="box-footer">
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