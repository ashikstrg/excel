<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="mi-product-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'display_size')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'display_type')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'generation')->dropDownList([ '2G' => '2G', '3G' => '3G', '4G' => '4G', ], ['prompt' => 'Choose Generation']) ?>

            <?= $form->field($model, 'sim')->dropDownList([ 'Single' => 'Single', 'Dual' => 'Dual', ], ['prompt' => 'Choose SIM']) ?>

            <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'ram')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'rom')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'processor')->textInput(['maxlength' => true]) ?>
    
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'battery')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'camera_rear')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'camera_front')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'special_feature')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'sale_out_vol')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add Product (MI)' : 'Update Product (MI)', ['class' => 'btn btn-primary']) ?>
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
