<?php

use yii\helpers\Html;

$this->title = 'Sales Data Update';
$this->miniTitle = 'Sales Module';
$this->subTitle = '<b>Sales Form:</b> ' . $model->imei_no;

$this->params['breadcrumbs'][] = ['label' => 'Sales Raw Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
