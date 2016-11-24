<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="training-assessment-question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'question_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answer')->dropDownList(['' => 'Select Answer', 1 => 1, 2 => 2, 3 => 3, 4 => 4]) ?>

    <?= $form->field($model, 'choice')->dropDownList([ 'Single' => 'Single', 'Multiple' => 'Multiple'], ['prompt' => 'Select Question Type']) ?>

    <div class="box-footer" style="margin-top: 40px;">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Add Question' : 'Update Question', ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <?= Html::resetButton('Reset Form', ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
