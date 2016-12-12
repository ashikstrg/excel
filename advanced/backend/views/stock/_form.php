<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// For dropdown
use kartik\widgets\DepDrop;
use yii\helpers\Url; 

?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_model_code')->dropDownList($productModel, [
            'prompt' => 'Select Product Model'
            ]); ?>

    <?= $form->field($model, 'product_color')->widget(DepDrop::classname(), [
        'options'=>['placeholder'=>'At First Select Product Model'],
        'data'=>[$model->product_color => $model->product_color],
        'pluginOptions'=>[
            'depends'=>['stock-product_model_code'],
            'placeholder'=>'Select Product Color',
            'url'=>Url::to(['/stock/find_color'])
        ]
    ]); ?>

    <?= $form->field($model, 'imei_no')->textInput(['maxlength' => true, 'autocomplete' => 'off']) ?>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add Stock' : 'Update Stock', ['class' => 'btn btn-primary']) ?>
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
