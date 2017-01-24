<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Inventory Raw Data';
$this->miniTitle = 'Inventory Module';
$this->subTitle = 'Inventory Data in Descending Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventory-index">

    <?php 
    $gridColumns = [
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
        ], // 0
        ['class' => 'yii\grid\SerialColumn'], // 1

        'imei_no', // 9
        'product_model_code', // 10
        'product_model_name', // 11
        'product_color', // 12
        'product_type', // 13
        'rrp',
        'lifting_price',
        'status', // 14
        'created_at', // 16
        'created_by', // 17
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0],
        'noExportColumns'=>[0],
        'pjaxContainerId' => 'kv-pjax-container',
        'exportConfig' => [
            'HTML' => false,
            'TXT' => false,
        ],
        'dropdownOptions' => [
            'label' => 'Full',
            'class' => 'btn btn-default',
            'itemsBefore' => [
                '<li class="dropdown-header">Export All Data</li>',
            ],
        ],
    ]);

    ?>

    <?php Pjax::begin(); ?>    
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => $gridColumns,
            'pjax' => true,
            'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
            'export' => [
                'label' => 'Page',
                'fontAwesome' => true,
            ],
            'toolbar' =>  [
                '{export}',
                $fullExportMenu,
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Inventory Raw Data',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Inventory data should not be deleted without admin permission.</i>
        </div>
    </div>
</div>