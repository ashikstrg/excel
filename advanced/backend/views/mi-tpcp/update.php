<?php

use yii\helpers\Html;

$this->title = 'MI TP&CP Update';
$this->miniTitle = 'MI Module';
$this->subTitle = '<b>MI TP&CP Form:</b> ' . $model->brand;

$this->params['breadcrumbs'][] = ['label' => 'MI TP&CP Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-tpcp-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
