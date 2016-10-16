<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Stock */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stock-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'batch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_dms_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_channel_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_zone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_territory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_model_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_model_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'submission_date')->textInput() ?>

    <?= $form->field($model, 'cretated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
