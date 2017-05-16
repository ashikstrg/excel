<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Custom
use kartik\widgets\DatePicker;

?>

<div class="stock-search_daily">
    
    <?php $form = ActiveForm::begin([
        'action' => ['leaderboard_tm'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            &nbsp;
        </div>
        
        <div class="col-md-3">
            <div class="pull-right">
                <?= $form->field($model, 'target_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Enter Stock Date', 'autocomplete' => 'off'],
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
