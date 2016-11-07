<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url; 

?>

<div class="training-pdf-form-next">
    
    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered">
              <tr>
                <th style="width: 50%">Training Name</th>
                <th style="width: 50%">Training Date Time</th>
              </tr>
              <tr>
                <td><?= Yii::$app->session->get('training_pdf_name'); ?></td>
                <td><?= Yii::$app->session->get('training_pdf_training_datetime'); ?></td>
              </tr>
            </table>
        </div>
    </div>

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?php 
    
    echo '<label class="control-label">PDF File</label>';
    
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'file',
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'uploadUrl' => Url::to(['/training-pdf/upload']),
            'allowedFileExtensions'=>['pdf'],
            'maxFileCount' => 1,
            'maxFileSize'=> 5120,
        ]
    ]);
    ?>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                &nbsp;
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>


