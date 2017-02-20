<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\HrBatch */

$this->title = 'Update Hr Batch: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hr Batches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hr-batch-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
