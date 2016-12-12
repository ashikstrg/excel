<?php

$this->title = 'Product Add';
$this->miniTitle = 'MI Module';
$this->subTitle = 'MI Product Form';

$this->params['breadcrumbs'][] = ['label' => 'MI Product Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-product-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
