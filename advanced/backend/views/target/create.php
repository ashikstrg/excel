<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Target */

$this->title = 'Create Target';
$this->params['breadcrumbs'][] = ['label' => 'Targets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
