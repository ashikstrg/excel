<?php

use yii\helpers\Html;

$this->title = 'Sales Data Upload';
$this->miniTitle = 'Sales Module';
$this->subTitle = 'CSV Upload Form';

$this->params['breadcrumbs'][] = ['label' => 'Sales Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-batch-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
