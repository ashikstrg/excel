<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// For dropdown
use kartik\widgets\DepDrop;
use yii\helpers\Url; 

?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'imei_no')->textInput(['maxlength' => true, 'autocomplete' => 'off', 'placeholder' => 'Insert IMEI Number']) ?>

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
