<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingAssessmentAnswer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-assessment-answer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_employee_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hr_employee_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'question_name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->dropDownList([ 'Right' => 'Right', 'Wrong' => 'Wrong', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
