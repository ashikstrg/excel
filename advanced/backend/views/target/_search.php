<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TargetSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="target-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'batch') ?>

    <?= $form->field($model, 'retail_id') ?>

    <?= $form->field($model, 'retail_dms_code') ?>

    <?= $form->field($model, 'retail_name') ?>

    <?php // echo $form->field($model, 'retail_channel_type') ?>

    <?php // echo $form->field($model, 'retail_type') ?>

    <?php // echo $form->field($model, 'retail_zone') ?>

    <?php // echo $form->field($model, 'retail_area') ?>

    <?php // echo $form->field($model, 'retail_territory') ?>

    <?php // echo $form->field($model, 'hr_id') ?>

    <?php // echo $form->field($model, 'employee_id') ?>

    <?php // echo $form->field($model, 'employee_name') ?>

    <?php // echo $form->field($model, 'designation') ?>

    <?php // echo $form->field($model, 'fsm_vol') ?>

    <?php // echo $form->field($model, 'fsm_val') ?>

    <?php // echo $form->field($model, 'tm_parent') ?>

    <?php // echo $form->field($model, 'tm_employee_id') ?>

    <?php // echo $form->field($model, 'tm_name') ?>

    <?php // echo $form->field($model, 'tm_vol') ?>

    <?php // echo $form->field($model, 'tm_val') ?>

    <?php // echo $form->field($model, 'am_parent') ?>

    <?php // echo $form->field($model, 'am_employee_id') ?>

    <?php // echo $form->field($model, 'am_name') ?>

    <?php // echo $form->field($model, 'am_vol') ?>

    <?php // echo $form->field($model, 'am_val') ?>

    <?php // echo $form->field($model, 'csm_parent') ?>

    <?php // echo $form->field($model, 'csm_employee_id') ?>

    <?php // echo $form->field($model, 'csm_name') ?>

    <?php // echo $form->field($model, 'csm_vol') ?>

    <?php // echo $form->field($model, 'csm_val') ?>

    <?php // echo $form->field($model, 'product_name') ?>

    <?php // echo $form->field($model, 'product_model_code') ?>

    <?php // echo $form->field($model, 'product_model_name') ?>

    <?php // echo $form->field($model, 'product_type') ?>

    <?php // echo $form->field($model, 'target_date') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
