<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MiInfraSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mi-infra-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'brand') ?>

    <?= $form->field($model, 'retail_type') ?>

    <?= $form->field($model, 'store_size') ?>

    <?= $form->field($model, 'owner') ?>

    <?php // echo $form->field($model, 'distributor_type') ?>

    <?php // echo $form->field($model, 'sales_team') ?>

    <?php // echo $form->field($model, 'rsa') ?>

    <?php // echo $form->field($model, 'fsm_type') ?>

    <?php // echo $form->field($model, 'region') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'town') ?>

    <?php // echo $form->field($model, 'hr_id') ?>

    <?php // echo $form->field($model, 'hr_employee_id') ?>

    <?php // echo $form->field($model, 'hr_name') ?>

    <?php // echo $form->field($model, 'hr_designation') ?>

    <?php // echo $form->field($model, 'hr_employee_type') ?>

    <?php // echo $form->field($model, 'am_employee_id') ?>

    <?php // echo $form->field($model, 'am_name') ?>

    <?php // echo $form->field($model, 'csm_employee_id') ?>

    <?php // echo $form->field($model, 'csm_name') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
