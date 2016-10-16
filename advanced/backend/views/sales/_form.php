<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'retail_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_dms_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_channel_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_zone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_territory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_model_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_model_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imei_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sales_date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
