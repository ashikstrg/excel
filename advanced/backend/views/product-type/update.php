<?php

use yii\helpers\Html;

$this->title = 'Product Type Update';
$this->miniTitle = 'Product Module';
$this->subTitle = '<b>Product Type Form:</b> ' . $model->type;

$this->params['breadcrumbs'][] = ['label' => 'Product Type Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-update">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
