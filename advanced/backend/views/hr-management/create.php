<?php

use yii\helpers\Html;

$this->title = 'HR Add (Management)';
$this->miniTitle = 'HR Module';
$this->subTitle = 'HR Form (Management)';

$this->params['breadcrumbs'][] = ['label' => 'HR Config (Management)', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-management-create">

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
