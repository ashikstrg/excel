<?php

use yii\helpers\Html;

$this->title = 'Product Type Add';
$this->miniTitle = 'Product Module';
$this->subTitle = 'Product Type Form';

$this->params['breadcrumbs'][] = ['label' => 'Product Type Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-type-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
