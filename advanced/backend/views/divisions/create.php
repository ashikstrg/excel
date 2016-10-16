<?php

use yii\helpers\Html;

$this->title = 'Division Add';
$this->miniTitle = 'Create New Division';
$this->subTitle = 'Division Form';

$this->params['breadcrumbs'][] = ['label' => 'Division Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="divisions-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
