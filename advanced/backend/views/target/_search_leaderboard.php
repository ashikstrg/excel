<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

// Custom
use kartik\widgets\DatePicker;

?>

<div class="stock-search_daily">
    
    <?php $form = ActiveForm::begin([
        'action' => ['leaderboard'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-8">
            <?php
            
            if(!Yii::$app->session->get('isTM') && Yii::$app->session->get('userRole') != 'Trainer') {
                echo Html::a('<i class="glyphicon glyphicon-group"></i> TM wise Leaderboard', ['leaderboard_tm'], ['class' => 'btn btn-primary', 'title'=> 'Refresh']); 
            } else {
                echo '&nbsp;';
            }
            
            echo '&nbsp;';
            
            if (!Yii::$app->session->get('isTM') && !Yii::$app->session->get('isAM') && Yii::$app->session->get('userRole') != 'Trainer') {
                echo Html::a('<i class="glyphicon glyphicon-group"></i> AM wise Leaderboard', ['leaderboard_am'], ['class' => 'btn btn-primary', 'title' => 'Refresh']);
            } else {
                echo '&nbsp;';
            }
            
            echo '&nbsp;';
            
            if (Yii::$app->session->get('userRole') == 'Management') {
                echo Html::a('<i class="glyphicon glyphicon-group"></i> CSM wise Leaderboard', ['leaderboard_csm'], ['class' => 'btn btn-primary', 'title' => 'Refresh']);
            } else {
                echo '&nbsp;';
            }
?>
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
