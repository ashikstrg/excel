<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Custom
use kartik\widgets\DatePicker;
use kartik\daterange\DateRangePicker;

?>

<div class="stock-search_daily">
    
    <?php $form = ActiveForm::begin([
        'action' => ['retail_model_value'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-4">
            &nbsp; 
        </div>
        <div class="col-md-4">
            <div class="pull-right">

                <?php
                
                $addon = <<< HTML
                        <span class="input-group-addon">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </span>
HTML;
                echo '<label class="control-label">Date Range</label>';
                echo '<div class="input-group drp-container">';
                echo DateRangePicker::widget([
                    'model'=>$model,
                    'attribute'=>'date_range',
                    'convertFormat'=>true,
                    'useWithAddon'=>true,
                    'pluginOptions'=>[
                        'locale'=>[
                            'format'=>'Y-m-d',
                            'separator'=>' to ',
                        ],
                        'opens'=>'left'
                    ]
                ]) . $addon;
                echo '</div>';
                
                ?>
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
                ])->label('Month'); ?>
            </div>
            
        </div>
        <div class="col-md-1">
            <div class="pull-right">
                <label class="control-label">&nbsp;&nbsp;</label><br />
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
