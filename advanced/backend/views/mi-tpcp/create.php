<?php

$this->title = 'TP&CP Add';
$this->miniTitle = 'MI Module';
$this->subTitle = 'MI TP&CP Form';

$this->params['breadcrumbs'][] = ['label' => 'MI TP&CP Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-tpcp-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
