<?php

use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url; 

?>

<div class="retail-batch-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?php 
    
    echo '<label class="control-label">Retail Data File</label>';
    
    echo FileInput::widget([
        'model' => $model,
        'attribute' => 'file',
        'options' => ['multiple' => false],
        'pluginOptions' => [
            'previewFileType' => 'any',
            'uploadUrl' => Url::to(['/retail-batch/upload']),
            'allowedFileExtensions'=>['csv'],
            'maxFileCount' => 1
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


