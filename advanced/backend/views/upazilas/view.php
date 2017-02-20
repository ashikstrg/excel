<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Upazila Detail';
$this->miniTitle = 'View Upazila';
$this->subTitle = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Upazila Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="upazilas-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
        ],
    ]) ?>
    
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

</div>
