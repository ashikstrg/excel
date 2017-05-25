<?php

$this->title = 'Single Stock Add';
$this->miniTitle = 'Stock Module';
$this->subTitle = 'Stock Form';

$this->params['breadcrumbs'][] = ['label' => 'Stock Raw Data', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <?= $this->render('_form_add', [
        'model' => $model
    ]) ?>

</div>
