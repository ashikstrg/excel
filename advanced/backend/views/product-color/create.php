<?php

use yii\helpers\Html;

$this->title = 'Product Color Add';
$this->miniTitle = 'Product Module';
$this->subTitle = 'Product Color Form';

$this->params['breadcrumbs'][] = ['label' => 'Product Color Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-color-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
