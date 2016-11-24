<?php

use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Monthly Assessment Result';
$this->miniTitle = 'Assessment Module';
$this->subTitle = 'Report Data in Descending Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-category-index">

    <?php 
    
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'], // 0
        'hr_employee_id',
        'hr_name',
        'hr_designation',
        'right_answer',
        'wrong_answer',
        'un_answer',
        'score_percent',
        'total_time',
        [
            'attribute' => 'participation_datetime',
            'value' => function ($data) {
                    return date('Y-m-d h:i:s A', strtotime($data->participation_datetime));
            },
        ],
        'date_month',
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        //'hiddenColumns'=>[0, 1],
        //'noExportColumns'=>[0, 1],
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
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> Test Report',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>