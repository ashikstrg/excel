<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SalesBatch */

$this->title = 'Update Sales Batch: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sales Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sales-batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
