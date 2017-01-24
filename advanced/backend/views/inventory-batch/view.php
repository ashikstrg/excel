<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\Alert;

$this->title = 'Inventory Data Upload Detail';
$this->miniTitle = 'Inventory Module';
$this->subTitle = 'Batch Number: ' . $model->batch;
$this->params['breadcrumbs'][] = ['label' => 'Inventory Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-batch-view">
    
    <?php
    
    $errorsArray = Yii::$app->session['errorsArray'];
    $successArray = Yii::$app->session['successArray'];
    unset(Yii::$app->session['errorsArray']);
    unset(Yii::$app->session['successArray']);
    
    if(!empty($errorsArray)) {

        foreach ($errorsArray as $errorMessage) {
            
            $error = explode(':', $errorMessage);
            
            echo Alert::widget([
                'type' => Alert::TYPE_DANGER,
                'title' => $error[0],
                'icon' => 'glyphicon glyphicon-remove-sign',
                'body' => $error[1],
                'showSeparator' => true,
            ]);
        }
        
    }
    
    ?>
    
    <?php
    
    if(!empty($successArray)) {
        
        foreach ($successArray as $successMessage) {
            
            $success = explode(':', $successMessage);
            
            echo Alert::widget([
                'type' => Alert::TYPE_SUCCESS,
                'title' => $success[0],
                'icon' => 'glyphicon glyphicon-ok-sign',
                'body' => $success[1],
                'showSeparator' => true,
            ]);
        }
        
    }
    
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'batch',
            'total_row',
            'created_by',
            'created_at',
        ],
    ]) ?>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?php 
                if( Yii::$app->session->get('userRole') == 'admin' ) {
                    
                    echo Html::a('Add New', ['/stock-batch/multiple'], ['class' => 'btn btn-primary']);
                    echo ' ';
                    echo Html::a('Configure', ['index'], ['class' => 'btn btn-primary']);
                    
                } else {
                    echo Html::a('Add New', ['create'], ['class' => 'btn btn-primary']);
                    echo ' ';
                    echo Html::a('Configure', ['index'], ['class' => 'btn btn-primary']);
                }
                ?>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]); ?>
                </div>
            </div>
        </div>
    </div>

</div>