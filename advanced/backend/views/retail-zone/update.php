<?php

use yii\helpers\Html;

$this->title = 'Retail Zone Update';
$this->miniTitle = 'Edit Retail Zone';
$this->subTitle = 'Retail Zone Form: ' . $model->zone;

$this->params['breadcrumbs'][] = ['label' => 'Retail Zone Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="retail-zone-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
