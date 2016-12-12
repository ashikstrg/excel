<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TravelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="travel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'hr_employee_id') ?>

    <?= $form->field($model, 'hr_name') ?>

    <?= $form->field($model, 'hr_designation') ?>

    <?= $form->field($model, 'hr_employee_type') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'line_manager_employee_id') ?>

    <?php // echo $form->field($model, 'line_manager_name') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'approved_date') ?>

    <?php // echo $form->field($model, 'approved_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
