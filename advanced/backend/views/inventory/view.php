<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Inventory Preview';
$this->miniTitle = 'Inventory Module';
$this->subTitle = $model->product_model_code . ' - ' . $model->product_color;
$this->params['breadcrumbs'][] = ['label' => 'Inventory Raw Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'imei_no',
            'product_name',
            'product_model_code',
            'product_model_name',
            'product_color',
            'product_type',
            'lifting_price',
            'rrp',
            'status',
            'validity',
            'stage',
            'created_at',
            'created_by',
        ],
    ]) ?>

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