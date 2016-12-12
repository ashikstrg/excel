<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="mi-infra-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'retail_type')->dropDownList([ 'Brandshop' => 'Brandshop', 'SIS' => 'SIS', 'Priority Store' => 'Priority Store', ], ['prompt' => 'Choose Retail Type']) ?>

            <?= $form->field($model, 'store_size')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'owner')->dropDownList([ 'Company' => 'Company', 'Franchise' => 'Franchise', ], ['prompt' => 'Choose Owner']) ?>

            <?= $form->field($model, 'distributor_type')->dropDownList([ 'RD' => 'RD', 'Distributor' => 'Distributor', ], ['prompt' => 'Choose Distributor Type']) ?>

            <?= $form->field($model, 'sales_team')->textInput(['maxlength' => true]) ?>
    
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'rsa')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fsm_type')->dropDownList([ 'SEC' => 'SEC', 'BP' => 'BP', ], ['prompt' => 'Choose FSM Type']) ?>

            <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add Infra (MI)' : 'Update Infra (MI)', ['class' => 'btn btn-primary']) ?>
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
