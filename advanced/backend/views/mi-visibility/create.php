<?php

$this->title = 'Add Infra and Visibility';
$this->miniTitle = 'MI Module';
$this->subTitle = 'MI Infra and Visibility Form';

$this->params['breadcrumbs'][] = ['label' => 'MI Infra and Visibility Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-visibility-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
