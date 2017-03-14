<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="complainbox-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'status')->dropDownList(['Pending' => 'Pending', 'Resolved' => 'Resolved', 'Declined' => 'Declined'], ['prompt' => 'Select Status']) ?>
    
    <?= $form->field($model, 'complain')->textarea(['rows' => 6, 'readOnly' => 'readOnly']) ?>
    
    <?= $form->field($model, 'feedback')->textarea(['rows' => 6]) ?>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::submitButton('Submit Feedback', ['class' => 'btn btn-primary']) ?>
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
