<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Monthly Assessment Submitted Answer';
$this->miniTitle = 'Assessment Module';
$this->subTitle = 'Assessment Data in Descending Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-answer-index">

    <?php 
    
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'], // 0
        'question_name:ntext',
        'answer',
        'remark',
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> ' . '<b>Employee ID:</b> ' . $searchModel->hr_employee_id . ', <b>Name:</b> ' . $searchModel->hr_name . ', <b>Designation:</b> ' . $searchModel->hr_designation,
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>