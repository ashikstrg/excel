<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'CSM wise Leaderboard by Value';
$this->miniTitle = 'Leaderboard Module';
$this->subTitle = 'Leaderboard Ranking';
$this->params['breadcrumbs'][] = $this->title;

$year = date('Y', time());
$month = date('m', time());
$monthFullName = date('F', time());
if(!empty($searchModel->target_date)) {
    $monthYear = explode('-', $searchModel->target_date);
    $year = $monthYear[0];
    $month = $monthYear[1];
    $monthFullName = date('F', mktime(0, 0, 0, $monthYear[1], 10));
}

$currentMonth = date('m', time());
$currentYear = date('Y', time());
if($currentMonth ==  $month && $currentYear == $year) {
    $timePass = round(((date('d', time()) - 1) / date('t', time())) * 100);
} elseif(($currentMonth >  $month && $currentYear >= $year) || ($currentMonth <=  $month && $currentYear > $year)) {
    $timePass = 100;
} else {
    $timePass = 0;
}

?>
<div class="target-leaderboard">
    
    <?php echo $this->render('_search_leaderboard_value_csm', ['model' => $searchModel]); ?>

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
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['leaderboard_value_csm'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> <b>Leaderboard Report (Month): </b>' . $monthFullName . ' | <b>Total Time Pass: </b>' . $timePass .'%',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Ranking by <b>achievement percentage</b> in ascending order by default.</i>
        </div>
    </div>
</div>