<?php

$this->title = 'Add Sales Data';
$this->miniTitle = 'Sales Module';
$this->subTitle = 'Sales Form';

$this->params['breadcrumbs'][] = ['label' => 'Sales Raw Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
