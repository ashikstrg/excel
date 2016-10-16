<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Employee Type Detail';
$this->miniTitle = 'HR Module';
$this->subTitle = '<b>Employee Type Data:</b> ' . $model->type;

$this->params['breadcrumbs'][] = ['label' => 'EMployee Type Config', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="hr-employee-type-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'type'
        ],
    ]) ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-6">
            <?= Html::a('Add New', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Configure', ['index'], ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]); ?>
            </div>
        </div>
    </div>
</div>