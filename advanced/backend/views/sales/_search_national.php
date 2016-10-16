<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Custom
use kartik\widgets\DatePicker;

?>

<div class="sales-search_national">
    
    <?php $form = ActiveForm::begin([
        'action' => ['national'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            &nbsp; 
        </div>
        <div class="col-md-3">
            <div class="pull-right">
                <?= $form->field($model, 'sales_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter Sales Month', 'autocomplete' => 'off'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'startView'=>'year',
                        'minViewMode'=>'months',
                        'format' => 'yyyy-mm'
                    ]
                ])->label(false); ?>
            </div>
            
        </div>
        <div class="col-md-1">
            <div class="pull-right">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
