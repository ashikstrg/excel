<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Custom FileInput
use kartik\file\FileInput;

?>

<div class="sales-batch-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

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

<div class="row" style="margin-top: 40px;">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Upload Format</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered">
                <tr>
                  <th style="width: 30%">Product Model Code</th>
                  <th style="width: 30%">Color</th>
                  <th style="width: 40%">IMEI Number</th>
                </tr>
                <tr>
                  <td>XXXXXXXXXXX</td>
                  <td>XXXXX</td>
                  <td>XXXXXXXXXXXXXXX</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="content-header">Conditions</div>
              <ul>
                 <li>Product Model &amp; Color must be exist in the product list.</li>
                <li>IMEI Number must be 15 characters long.</li>
              </ul>
            </div>
          </div>
          <!-- /.box -->
    </div>
</div>


