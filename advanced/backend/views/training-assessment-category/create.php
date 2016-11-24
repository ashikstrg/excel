<?php

use yii\helpers\Html;

$this->title = 'Add Assessment';
$this->miniTitle = 'Assessment Module';
$this->subTitle = 'Monthly Assessment Form';

$this->params['breadcrumbs'][] = ['label' => 'Assessment Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-category-create">

    <?= $this->render('_form', [
        'model' => $model,
        'designationModel' => $designationModel
    ]) ?>

</div>