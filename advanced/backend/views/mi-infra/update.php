<?php

use yii\helpers\Html;

$this->title = 'MI Infra Update';
$this->miniTitle = 'MI Module';
$this->subTitle = '<b>MI Infra Form:</b> ' . $model->brand;

$this->params['breadcrumbs'][] = ['label' => 'MI Infra Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-infra-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
