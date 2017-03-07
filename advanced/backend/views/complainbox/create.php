<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Complainbox */

$this->title = 'Create Complainbox';
$this->params['breadcrumbs'][] = ['label' => 'Complainboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complainbox-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
