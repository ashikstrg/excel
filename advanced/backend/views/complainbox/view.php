<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Complainbox */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Complainboxes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complainbox-view">

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
            'token_no',
            'complain:ntext',
            'hr_employee_id',
            'hr_name',
            'retail_dms_code',
            'retail_name',
            'status',
            'complain_date',
            'feedback:ntext',
            'feedback_by_employee_id',
            'feedback_by_name',
            'feedback_date',
        ],
    ]) ?>

</div>
