<?php

$this->title = 'Fill Travel Application';
$this->miniTitle = 'Travel Module';
$this->subTitle = 'Travel Application Form';

$this->params['breadcrumbs'][] = ['label' => 'Travel Application Status', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travel-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
