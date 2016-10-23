<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'F/M Report by Value';
$this->miniTitle = 'Sales Module';
$this->subTitle = 'FSM-wise Product Model Data';
$this->params['breadcrumbs'][] = $this->title;

$stringBoxHeader = '';
if(!empty($searchModel->date_range)) {

    $stringBoxHeader = '<b>Date Range: </b>From ';
    $salesDate = $searchModel->date_range;

} else if(!empty($searchModel->sales_date)) {
    
    $stringBoxHeader = '<b>Month: </b>';
    $salesDate = date('F, Y', strtotime($searchModel->sales_date . '-01'));

} else {

    $stringBoxHeader = '<b>Month: </b>';
    $salesDate = date('F, Y', time());

}

$stringBoxHeader .= $salesDate;

?>
<div class="sales-retail_model_value">
    
    <?php echo $this->render('_search_retail_model_value', ['model' => $searchModel]); ?>

    <?php 
    
    $gridColumns = [
        
        ['class' => 'yii\grid\SerialColumn'],
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        //'columns' => $gridColumns,
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
            //'columns' => $gridColumns,
            'showPageSummary' => true,
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
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['retail_model_value'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],
            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> ' . $stringBoxHeader,
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Either search by <b>date range</b> or <b>month</b>.</i>
        </div>
    </div>
</div>
