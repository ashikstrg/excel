<?php

use yii\helpers\Html;

$this->title = 'Designation Add';
$this->miniTitle = 'HR Module';
$this->subTitle = 'Designation Form';

$this->params['breadcrumbs'][] = ['label' => 'Designations Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-designation-create">

    <?= $this->render('_form', [
        'model' => $model,
        'hrEmployeeTypeModel' => $hrEmployeeTypeModel,
        'hrDesignationModel' => $hrDesignationModel
    ]) ?>

</div>