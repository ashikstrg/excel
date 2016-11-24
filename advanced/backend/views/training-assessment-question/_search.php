<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentQuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-assessment-question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'question_name') ?>

    <?= $form->field($model, 'answer1') ?>

    <?= $form->field($model, 'answer2') ?>

    <?= $form->field($model, 'answer3') ?>

    <?php // echo $form->field($model, 'answer4') ?>

    <?php // echo $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'choice') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
