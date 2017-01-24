<?php

$this->title = 'Inventory Add';
$this->miniTitle = 'Inventory Module';
$this->subTitle = 'Inventory Form';

$this->params['breadcrumbs'][] = ['label' => 'Inventory Raw Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-create">

    <?= $this->render('_form', [
        'model' => $model,
        'productModel' => $productModel
    ]) ?>

</div>
