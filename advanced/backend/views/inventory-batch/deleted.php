<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Uploaded Data';
$this->miniTitle = 'Inventory Module';
$this->subTitle = 'Deleted Files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-batch-index">

    <?php 
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'], // 2

            'batch',
            'deleted_by',
            'deleted_at',
    ];

    ?>

    <?php Pjax::begin(); ?>    
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
            'export' => false,
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['deleted'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_DANGER,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Deleted Batch Files'
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Stock Files are listed in descending order.</i>
        </div>
    </div>
</div>