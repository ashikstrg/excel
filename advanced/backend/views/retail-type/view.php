<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Retail Type Detail';
$this->miniTitle = 'View Retail Type';
$this->subTitle = $model->type;
$this->params['breadcrumbs'][] = ['label' => 'Retail Type Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-type-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'channelType.type',
            'type',
        ],
    ]); ?>

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
