<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentAnswerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-assessment-answer-search">

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

    <?php // echo $form->field($model, 'question_name') ?>

    <?php // echo $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
