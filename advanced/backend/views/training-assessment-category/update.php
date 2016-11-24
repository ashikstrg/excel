<?php

use yii\helpers\Html;

$this->title = 'Update Assessment';
$this->miniTitle = 'Assessment Module';
$this->subTitle = '<b>Monthly Assessment Form: </b>' . $model->name;

$this->params['breadcrumbs'][] = ['label' => 'Assessment Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

if(!empty($model->designations)) {
    $model->designations = explode(',', $model->designations);
}

?>
<div class="training-assessment-category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'designationModel' => $designationModel
    ]) ?>

</div>