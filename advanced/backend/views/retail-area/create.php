<?php

use yii\helpers\Html;

$this->title = 'Retail Area Add';
$this->miniTitle = 'Create New Retail Area';
$this->subTitle = 'Retail Area Form';

$this->params['breadcrumbs'][] = ['label' => 'Retail Area Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="retail-area-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
