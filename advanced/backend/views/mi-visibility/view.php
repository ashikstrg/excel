<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'MI Infra and Visibility Preview';
$this->miniTitle = 'MI Module';
$this->subTitle = $model->brand;
$this->params['breadcrumbs'][] = ['label' => 'MI Infra and Visibility Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-visibility-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'brand',
            'model',
            'retail_type',
            'store_size',
            'owner',
            'distributor_type',
            'sales_team',
            'rsa',
            'fsm_type',
            'region',
            'district',
            'town',
            'posm',
        ],
    ]) ?>
    
    <?php
       if ($model->image_web_filename!='') {
         echo '<br /><p><img src="'.Yii::$app->homeUrl. '/../uploads/mi/image/'.$model->image_web_filename.'"></p>';
       }    
    ?>

    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Add New', ['create'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Configure', ['index'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
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