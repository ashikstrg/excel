<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Target Raw Data';
$this->miniTitle = 'Target Module';
$this->subTitle = 'Target Data in Descending Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="target-index">

    <?php 
    $gridColumns = [
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}',
        ], // 0
        ['class' => 'yii\grid\SerialColumn'], // 1
        'batch', // 2
        'retail_dms_code', // 3
        'retail_name', // 4
        'retail_channel_type', // 5
        'retail_type', // 6
        'retail_zone', // 7
        'retail_area', // 8
        'retail_territory', // 9
        [
            'attribute' => 'employee_id',
            'visible' => Yii::$app->session->get('isSales') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 10
        [
            'attribute' => 'employee_name',
            'visible' => Yii::$app->session->get('isSales') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 11
        [
            'attribute' => 'designation',
            'visible' => Yii::$app->session->get('isSales') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 12
        [
            'attribute' => 'fsm_vol',
            'visible' => Yii::$app->session->get('isSales') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 13
        [
            'attribute' => 'fsm_val',
            'visible' => Yii::$app->session->get('isSales') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 14
        [
            'attribute' => 'tm_employee_id',
            'visible' =>  Yii::$app->session->get('isAM') || Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 15
        [
            'attribute' => 'tm_name',
            'visible' => Yii::$app->session->get('isAM') || Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 16
        [
            'attribute' => 'tm_vol',
            'visible' => Yii::$app->session->get('isAM') || Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 17
        [
            'attribute' => 'tm_val',
            'visible' => Yii::$app->session->get('isAM') || Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 18
        [
            'attribute' => 'am_employee_id',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 19
        [
            'attribute' => 'am_name',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 20
        [
            'attribute' => 'am_vol',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 21
        [
            'attribute' => 'am_val',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 22
        [
            'attribute' => 'csm_employee_id',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 23
        [
            'attribute' => 'csm_name',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 24
        [
            'attribute' => 'csm_vol',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 25
        [
            'attribute' => 'csm_val',
            'visible' => Yii::$app->session->get('isCSM') || Yii::$app->session->get('isAdmin') ? 1 : 0
        ], // 26
        'product_model_code', // 27
        'product_model_name', // 28
        'product_type', // 29
        'target_date', // 30
        'created_at', // 31
        'created_by' // 32
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0, 2, 31, 32],
        'noExportColumns'=>[0, 2, 31, 32],
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Target Raw Data',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Target data can not deleted. But batch file can be deleted.</i>
        </div>
    </div>
</div>