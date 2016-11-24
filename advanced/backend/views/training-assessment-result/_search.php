<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentResultSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-assessment-result-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'hr_employee_id') ?>

    <?= $form->field($model, 'hr_name') ?>

    <?= $form->field($model, 'hr_designation') ?>

    <?php // echo $form->field($model, 'hr_employee_type') ?>

    <?php // echo $form->field($model, 'retail_dms_code') ?>

    <?php // echo $form->field($model, 'retail_name') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'score_percent') ?>

    <?php // echo $form->field($model, 'total_time') ?>

    <?php // echo $form->field($model, 'date_month') ?>

    <?php // echo $form->field($model, 'participation_datetime') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
