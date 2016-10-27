<?php

use yii\helpers\Html;

$this->title = 'HR Add (Trainer)';
$this->miniTitle = 'HR Module';
$this->subTitle = 'HR Form (Trainer)';

$this->params['breadcrumbs'][] = ['label' => 'HR Config (Trainer)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-trainer-create">

    <?= $this->render('_form', [
        'model' => $model,
        'hrDesignationModel' => $hrDesignationModel
    ]) ?>

</div>
