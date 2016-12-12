<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="mi-tpcp-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">

            <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'trade_promo')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'consumer_promo')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'fsm_incentive_plan')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'other_scheme')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'region')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add TP&CP (MI)' : 'Update TP&CP (MI)', ['class' => 'btn btn-primary']) ?>
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
