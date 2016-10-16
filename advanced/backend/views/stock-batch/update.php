<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StockBatch */

$this->title = 'Update Stock Batch: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stock Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="stock-batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
