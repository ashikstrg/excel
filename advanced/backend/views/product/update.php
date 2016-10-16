<?php

use yii\helpers\Html;

$this->title = 'Product Update';
$this->miniTitle = 'Product Module';
$this->subTitle = '<b>Product Form:</b> ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Product Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-update">

    <?= $this->render('_form', [
        'model' => $model,
        'productTypeModel' => $productTypeModel,
        'productColorModel' => $productColorModel
    ]) ?>

</div>
