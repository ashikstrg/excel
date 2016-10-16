<?php

use yii\helpers\Html;

$this->title = 'Retail Location Update';
$this->miniTitle = 'Edit Retail Location';
$this->subTitle = '<b>Retail Location Form:</b> ' . $model->location;

$this->params['breadcrumbs'][] = ['label' => 'Retail Location Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="retail-location-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
