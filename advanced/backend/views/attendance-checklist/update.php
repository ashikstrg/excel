<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AttendanceChecklist */

$this->title = 'Update Attendance Checklist: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attendance Checklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="attendance-checklist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
