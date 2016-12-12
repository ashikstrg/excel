<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'MI Product Preview';
$this->miniTitle = 'MI Module';
$this->subTitle = $model->brand;
$this->params['breadcrumbs'][] = ['label' => 'MI Product Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-product-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'brand',
            'model',
            'display_size',
            'display_type',
            'generation',
            'sim',
            'weight',
            'ram',
            'rom',
            'processor',
            'battery',
            'camera_rear',
            'camera_front',
            'special_feature',
            'price',
            'sale_out_vol',
            'region',
            'district',
            'town'
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