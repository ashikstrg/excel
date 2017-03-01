<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AttendanceChecklist */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Attendance Checklists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-checklist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'question:ntext',
            'answer',
            'remark:ntext',
            'retail_dms_code',
            'retail_name',
            'hr_employee_id',
            'hr_name',
            'checklist_date',
            'in_time',
            'out_time',
            'status',
        ],
    ]) ?>

</div>
