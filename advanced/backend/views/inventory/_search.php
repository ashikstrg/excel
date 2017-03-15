<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Custom
use kartik\widgets\DatePicker;

?>

<div class="inventory-search">
    
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-7">
            &nbsp; 
        </div>
        <div class="col-md-2">
            <div class="pull-right">
                <?= $form->field($model, 'from_row')->textInput(['placeholder' => 'From number of row'])->label(false) ?>
            </div>
        </div>
        <div class="col-md-2">
            <div class="pull-right">
                <?= $form->field($model, 'total_row')->textInput(['placeholder' => 'Total Row'])->label(false) ?>
                <?= $form->field($model, 'validity')->hiddenInput()->label(false) ?>
            </div>
        </div>
        <div class="col-md-1">
            <div class="pull-right">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
