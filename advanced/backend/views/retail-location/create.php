<?php

use yii\helpers\Html;

$this->title = 'Retail Location Add';
$this->miniTitle = 'Create New Retail Location';
$this->subTitle = 'Retail Location Form';

$this->params['breadcrumbs'][] = ['label' => 'Retail Location Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="retail-location-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
