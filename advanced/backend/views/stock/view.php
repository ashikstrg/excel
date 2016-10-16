<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Stock */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'batch',
            'retail_id',
            'retail_dms_code',
            'retail_name',
            'retail_type',
            'retail_channel_type',
            'retail_zone',
            'retail_area',
            'retail_territory',
            'product_id',
            'product_name',
            'product_model_code',
            'product_model_name',
            'product_color',
            'product_type',
            'status',
            'volume',
            'submission_date',
            'cretated_at',
            'created_by',
            'updated_at',
            'updated_by',
        ],
    ]) ?>

</div>
