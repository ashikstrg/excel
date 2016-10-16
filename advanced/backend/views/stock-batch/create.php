<?php

use yii\helpers\Html;

$this->title = 'Stock Data Upload';
$this->miniTitle = 'Stock Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Stock Batch Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-batch-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
