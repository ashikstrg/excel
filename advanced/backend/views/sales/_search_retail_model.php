<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Custom
use kartik\widgets\DatePicker;
use kartik\daterange\DateRangePicker;

?>

<div class="stock-search_daily">
    
    <?php $form = ActiveForm::begin([
        'action' => ['retail_model'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            &nbsp; 
        </div>
        <div class="col-md-4">
            <div class="pull-right">

                <?= $form->field($model, 'date_range', [
                    'options'=>['class'=>'drp-container form-group']
                ])->widget(DateRangePicker::classname(), [
                    'pluginOptions'=>[
                        'locale'=>[
                            'format'=>'Y-M-D',
                            'separator'=>' to ',
                        ],
                        'opens'=>'left'
                    ]
                ])->label(false); ?>
            </div>
            
        </div>
        <div class="col-md-3">
            <div class="pull-right">
                <?= $form->field($model, 'sales_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter Month', 'autocomplete' => 'off'],
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
