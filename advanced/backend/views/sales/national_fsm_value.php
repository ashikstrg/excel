<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$year = date('Y', time());
$month = date('m', time());
$monthFullName = date('F', time());
if(!empty($searchModel->sales_date)) {
    $monthYear = explode('-', $searchModel->sales_date);
    $year = $monthYear[0];
    $month = $monthYear[1];
    $monthFullName = date('F', mktime(0, 0, 0, $monthYear[1], 10));
}

$visibleDay31 = 0;
$visibleDay30 = 0;
$visibleDay29 = 0;
if(date('t', strtotime($year . '-' . $month . '-' . '01')) == 31) {
    $visibleDay31 = 1;
    $visibleDay30 = 1;
    $visibleDay29 = 1;
} else if(date('t', strtotime($year . '-' . $month . '-' . '01')) == 30) {
    $visibleDay31 = 0;
    $visibleDay30 = 1;
    $visibleDay29 = 1;
} else if(date('t', strtotime($year . '-' . $month . '-' . '01')) == 29) {
    $visibleDay31 = 0;
    $visibleDay30 = 0;
    $visibleDay29 = 1;
}

$this->title = 'F/D Report (Value)';
$this->miniTitle = 'Sales Module';
$this->subTitle = 'FSM/Day wise sales data (Value)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-national_retail">
    
    <?php echo $this->render('_search_national_fsm_value', ['model' => $searchModel]); ?>

    <?php 
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'], // 1
        'retail_dms_code', 
        'retail_name', 
        'retail_type', 
        'retail_channel_type', 
        'retail_zone', 
        'retail_area', 
        'retail_territory', 
        'employee_id', 
        'employee_name', 
        'designation',
        'total',
        'D01',
        'D02',
        'D03',
        'D04',
        'D05',
        'D06',
        'D07',
        'D08',
        'D09',
        'D10',
        'D11',
        'D12',
        'D13',
        'D14',
        'D15',
        'D16',
        'D17',
        'D18',
        'D19',
        'D20',
        'D21',
        'D22',
        'D23',
        'D24',
        'D25',
        'D26',
        'D27',
        'D28',
        [
            'attribute' => 'D29',
            'visible' => $visibleDay29
        ],
        [
            'attribute' => 'D30',
            'visible' => $visibleDay30
        ],
        [
            'attribute' => 'D31',
            'visible' => $visibleDay31
        ],
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        //'hiddenColumns'=>[0],
        //'noExportColumns'=>[0],
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
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['national'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> ' . '<b>Month: </b>' . $monthFullName . ', ' . $year,
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