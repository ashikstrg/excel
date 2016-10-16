<?php

use yii\helpers\Html;

$this->title = 'Retail Zone Add';
$this->miniTitle = 'Create New Retail Zone';
$this->subTitle = 'Retail Zone Form';

$this->params['breadcrumbs'][] = ['label' => 'Retail Zone Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="retail-zone-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
