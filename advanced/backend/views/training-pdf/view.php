<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Training Detail';
$this->miniTitle = 'Training Module';
$this->subTitle = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Training Configuration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-pdf-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'batch',
            'name',
            'status',
            'notification_count',
            'created_by',
            'created_at',
            'training_datetime',
        ],
    ]) ?>

    <?= \yii2assets\pdfjs\PdfJs::widget([
        'width'=>'100%',
        'height'=> '800px',
        'url'=> Url::base(). '/' .$model->file_import,
        'buttons'=>[
            'presentationMode' => false,
            'openFile' => false,
            'print' => true,
            'download' => false,
            'viewBookmark' => false,
            'secondaryToolbarToggle' => false
        ]
    ]); ?>


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