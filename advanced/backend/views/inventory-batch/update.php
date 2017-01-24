<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\InventoryBatch */

$this->title = 'Update Inventory Batch: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inventory Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inventory-batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
