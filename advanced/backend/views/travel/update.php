<?php

use yii\helpers\Html;

$this->title = 'Travel Application Update';
$this->miniTitle = 'Travel Module';
$this->subTitle = '<b>Travel Application Form:</b> ' . $model->reason;

$this->params['breadcrumbs'][] = ['label' => 'Travel Application Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travel-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
