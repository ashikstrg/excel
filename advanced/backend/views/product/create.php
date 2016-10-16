<?php

use yii\helpers\Html;

$this->title = 'Product Add';
$this->miniTitle = 'Product Module';
$this->subTitle = 'Product Form';

$this->params['breadcrumbs'][] = ['label' => 'Product Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <?= $this->render('_form', [
        'model' => $model,
        'productTypeModel' => $productTypeModel,
        'productColorModel' => $productColorModel
    ]) ?>

</div>
