<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Upazilas */

$this->title = 'Create Upazilas';
$this->params['breadcrumbs'][] = ['label' => 'Upazilas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upazilas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
