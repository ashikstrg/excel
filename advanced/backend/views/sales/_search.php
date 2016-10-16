<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'retail_id') ?>

    <?= $form->field($model, 'retail_dms_code') ?>

    <?= $form->field($model, 'retail_name') ?>

    <?= $form->field($model, 'retail_channel_type') ?>

    <?php // echo $form->field($model, 'retail_type') ?>

    <?php // echo $form->field($model, 'retail_zone') ?>

    <?php // echo $form->field($model, 'retail_area') ?>

    <?php // echo $form->field($model, 'retail_territory') ?>

    <?php // echo $form->field($model, 'designation') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'employee_name') ?>

    <?php // echo $form->field($model, 'tm_parent') ?>

    <?php // echo $form->field($model, 'tm_employee_id') ?>

    <?php // echo $form->field($model, 'tm_name') ?>

    <?php // echo $form->field($model, 'am_parent') ?>

    <?php // echo $form->field($model, 'am_employee_id') ?>

    <?php // echo $form->field($model, 'am_name') ?>

    <?php // echo $form->field($model, 'csm_parent') ?>

    <?php // echo $form->field($model, 'csm_employee_id') ?>

    <?php // echo $form->field($model, 'csm_name') ?>

    <?php // echo $form->field($model, 'product_id') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'product_model_code') ?>

    <?php // echo $form->field($model, 'product_model_name') ?>

    <?php // echo $form->field($model, 'product_color') ?>

    <?php // echo $form->field($model, 'product_type') ?>

    <?php // echo $form->field($model, 'imei_no') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'sales_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
