<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Sales Raw Data';
$this->miniTitle = 'Sales Module';
$this->subTitle = 'Sales Data in Descending Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-batch-index">

    <?php 
    $gridColumns = [
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
        ], // 0
        ['class' => 'yii\grid\SerialColumn'], // 1

        'retail_dms_code', // 2
        'retail_name', // 3
        'retail_channel_type', // 4
        'retail_type', // 5
        'retail_zone', // 6
        'retail_area', // 7
        'retail_territory', // 8
        [
            'attribute' => 'employee_id',
            'visible' => Yii::$app->session->get('isSales')
        ], // 9
        [
            'attribute' => 'employee_name',
            'visible' => Yii::$app->session->get('isSales')
        ], // 10
        [
            'attribute' => 'designation',
            'visible' => Yii::$app->session->get('isSales')
        ], // 11
        [
            'attribute' => 'tm_employee_id',
            'visible' => Yii::$app->session->get('designation') == 'AM' || Yii::$app->session->get('designation') == 'CSM' ? 1 : 0
        ],
        [
            'attribute' => 'tm_name',
            'visible' => Yii::$app->session->get('designation') == 'AM' || Yii::$app->session->get('designation') == 'CSM' ? 1 : 0
        ],
        [
            'attribute' => 'am_employee_id',
            'visible' => Yii::$app->session->get('designation') == 'CSM' ? 1 : 0
        ],
        [
            'attribute' => 'am_name',
            'visible' => Yii::$app->session->get('designation') == 'CSM' ? 1 : 0
        ],
        'product_model_code',
        'product_model_name',
        'product_color',
        // 'product_type',
        'imei_no',
        'price',
        // 'sales_date',
        'created_at',
        //'created_by',
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Sales Raw Data',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Sales data can not deleted. But batch file can be deleted.</i>
        </div>
    </div>
</div>