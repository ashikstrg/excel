<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Managerial Data';
$this->miniTitle = 'Travel Module';
$this->subTitle = 'Your Actions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="travel-manage">

    <?php 
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        
        'batch',
        'hr_employee_id',
        'hr_name',
        'hr_designation',
        'start_date',
        'end_date',
        'reason',
        'place',
        'cost',
        'created_at',
        'status',
        'action_date',     
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
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['manage'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of your action in terms of travel application'
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Delete operation can not be performed without Admin Approval.</i>
        </div>
    </div>
</div>
