<?php

use yii\helpers\Html;

$this->title = 'MI Visibility Update';
$this->miniTitle = 'MI Module';
$this->subTitle = '<b>MI Visibility Form:</b> ' . $model->brand;

$this->params['breadcrumbs'][] = ['label' => 'MI Visibility Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mi-visibility-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]); ?>

</div>
