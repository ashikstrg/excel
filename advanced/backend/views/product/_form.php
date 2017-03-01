<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-md-6">

            <?= $form->field($model, 'type')->dropDownList($productTypeModel, ['prompt' => 'Select Handset Type']) ?>
            
            <?= $form->field($model, 'sku_code')->textInput(['placeholder' => 'Enter SKU Code', 'maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['placeholder' => 'Enter Handset Name', 'maxlength' => true]) ?>

            <?= $form->field($model, 'model_code')->textInput(['placeholder' => 'Enter Handset Model Code', 'maxlength' => true]) ?>

            <?= $form->field($model, 'model_name')->textInput(['placeholder' => 'Enter Handset Model Name', 'maxlength' => true]) ?>            
            

        </div>

        <div class="col-md-6">

            <?= $form->field($model, 'color')->dropDownList($productColorModel, ['prompt' => 'Select Handset Color']) ?>

            <?= $form->field($model, 'lifting_price')->textInput(['placeholder' => 'Enter Handset Lifting Price', 'maxlength' => true]) ?>

            <?= $form->field($model, 'rrp')->textInput(['placeholder' => 'Please enter RRP', 'maxlength' => true]) ?>

            <?= $form->field($model, 'status')->dropDownList(['' => 'Select Product Status', 'Active' => 'Active', 'Inactive' => 'Inactive']) ?>

        </div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add Product' : 'Update Product', ['class' => 'btn btn-primary']) ?>
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