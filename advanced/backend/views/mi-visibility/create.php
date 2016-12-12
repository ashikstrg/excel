<?php

$this->title = 'Visibility Add';
$this->miniTitle = 'MI Module';
$this->subTitle = 'MI Visibility Form';

$this->params['breadcrumbs'][] = ['label' => 'MI Visibility Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-visibility-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
