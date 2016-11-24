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
            'name',
            'message',
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

</div>