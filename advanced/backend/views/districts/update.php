<?php

use yii\helpers\Html;

$this->title = 'District Update';
$this->miniTitle = 'Utility Module';
$this->subTitle = 'District Form: ' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Dictrict Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-create">

    <?= $this->render('_form', [
        'model' => $model,
        'divisionModel' => $divisionModel
    ]) ?>

</div>
