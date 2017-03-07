<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ComplainboxSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="complainbox-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'token_no') ?>

    <?= $form->field($model, 'complain') ?>

    <?= $form->field($model, 'hr_employee_id') ?>

    <?= $form->field($model, 'hr_name') ?>

    <?php // echo $form->field($model, 'retail_dms_code') ?>

    <?php // echo $form->field($model, 'retail_name') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'complain_date') ?>

    <?php // echo $form->field($model, 'feedback') ?>

    <?php // echo $form->field($model, 'feedback_by_employee_id') ?>

    <?php // echo $form->field($model, 'feedback_by_name') ?>

    <?php // echo $form->field($model, 'feedback_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
