<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RetailBatch */

$this->title = 'Update Retail Batch: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Retail Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="retail-batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
