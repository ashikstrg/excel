<?php

use yii\helpers\Html;

$this->title = 'Designation Update';
$this->miniTitle = 'HR Module';
$this->subTitle = '<b>Designation Form:</b> ' . $model->type;

$this->params['breadcrumbs'][] = ['label' => 'Designation Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-designation-update">

    <?= $this->render('_form', [
        'model' => $model,
        'hrEmployeeTypeModel' => $hrEmployeeTypeModel,
        'hrDesignationModel' => $hrDesignationModel
    ]) ?>

</div>
