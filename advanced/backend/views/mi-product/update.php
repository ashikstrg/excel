<?php

use yii\helpers\Html;

$this->title = 'MI Product Update';
$this->miniTitle = 'MI Module';
$this->subTitle = '<b>MI Product Form:</b> ' . $model->brand;

$this->params['breadcrumbs'][] = ['label' => 'MI Product Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-product-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
