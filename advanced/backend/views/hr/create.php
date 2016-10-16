<?php

use yii\helpers\Html;

$this->title = 'HR Add';
$this->miniTitle = 'HR Module';
$this->subTitle = 'HR Form';

$this->params['breadcrumbs'][] = ['label' => 'HR Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-create">

    <?= $this->render('_form', [
        'model' => $model,
        'hrDesignationModel' => $hrDesignationModel, 
        'retailModel' => $retailModel
    ]) ?>

</div>
