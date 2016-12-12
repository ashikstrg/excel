<?php

$this->title = 'Infra Add';
$this->miniTitle = 'MI Module';
$this->subTitle = 'MI Inra Form';

$this->params['breadcrumbs'][] = ['label' => 'MI Infra Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-inra-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
