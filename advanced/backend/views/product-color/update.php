<?php

use yii\helpers\Html;

$this->title = 'Product Color Update';
$this->miniTitle = 'Product Module';
$this->subTitle = '<b>Product Color Form:</b> ' . $model->color;

$this->params['breadcrumbs'][] = ['label' => 'Product Color Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-color-update">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
