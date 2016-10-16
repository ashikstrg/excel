<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Product Detail';
$this->miniTitle = 'Product Module';
$this->subTitle = '<b>Product Data:</b> ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Product Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="product-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'model_code',
            'model_name',
            'color',
            'type',
            'lifting_price',
            'rrp',
        ],
    ]) ?>

</div>

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