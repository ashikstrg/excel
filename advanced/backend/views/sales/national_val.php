<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$month = date('F', time());
$year = date('Y', time());
if(!empty($searchModel->sales_date)) {
    $monthYear = explode('-', $searchModel->sales_date);
    $year = $monthYear[0];
    $month = date('F', mktime(0, 0, 0, $monthYear[1], 10));
}

$this->title = 'National Sales Data (Value)';
$this->miniTitle = 'Sales Module';
$this->subTitle = 'Model/Day wise sales data (Value)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-national_val">
    
    <?php echo $this->render('_search_national_val', ['model' => $searchModel]); ?>

    <?php 
    $gridColumns = [
//        [
//            'class' => 'yii\grid\ActionColumn',
//            'template' => '{view}',
//        ], // 0
        ['class' => 'yii\grid\SerialColumn'], // 1
        'product_type',
        'product_model_name',
        'product_model_code', // 2
        'total_national',
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
        'D29',
        'D30',
        'D31'
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
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['national_val'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> ' . '<b>Month: </b>' . $month . ', ' . $year,
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