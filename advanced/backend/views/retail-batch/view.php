<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\widgets\Alert;

$this->title = 'Retail Data Upload Detail';
$this->miniTitle = 'Retail Module';
$this->subTitle = 'Batch Number: ' . $model->batch;
$this->params['breadcrumbs'][] = ['label' => 'Retail Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-batch-view">
    
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
            <div class="col-md-8">
                <?php 
                if( Yii::$app->session->get('userRole') == 'admin' ) {
                    
                    echo Html::a('Add New', ['/retail/create'], ['class' => 'btn btn-primary']);
                    echo ' ';
                    echo Html::a('Configure', ['/retail/index'], ['class' => 'btn btn-primary']);
                    
                    echo Html::a('Upload Multiple', ['create'], ['class' => 'btn btn-primary']);
                    echo ' ';
                    echo Html::a('Active Batch Data', ['index'], ['class' => 'btn btn-primary']);
                }
                ?>
            </div>
            <div class="col-md-4">
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