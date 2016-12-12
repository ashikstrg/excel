<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
?>

<div class="travel-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'reason')->textInput(['maxlength' => true, 'placeholder' => 'Enter Reason']) ?>

    <?=
    $form->field($model, 'start_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter Start Date', 'autocomplete' => 'off'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?=
    $form->field($model, 'end_date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => 'Enter end Date', 'autocomplete' => 'off'],
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);
    ?>

    <?= $form->field($model, 'place')->textInput(['maxlength' => true, 'placeholder' => 'Enter Place']) ?>

    <?= $form->field($model, 'cost')->textInput(['maxlength' => true, 'placeholder' => 'Enter Cost']) ?>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton($model->isNewRecord ? 'Submit Application' : 'Update Application', ['class' => 'btn btn-primary']) ?>
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
