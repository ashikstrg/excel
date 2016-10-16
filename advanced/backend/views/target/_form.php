<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Target */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="target-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'batch')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_dms_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_channel_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_zone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retail_territory')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'employee_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fsm_vol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fsm_val')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_vol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tm_val')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_vol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'am_val')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_parent')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_vol')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'csm_val')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_model_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_model_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target_date')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
