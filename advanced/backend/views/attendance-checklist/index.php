<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Attendance Checklist';
$this->miniTitle = 'Attedance Module';
$this->subTitle = 'FSM Attendance Checklist';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-checklist-index">

    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'], // 1
        'retail_dms_code',
        'retail_name',
        'hr_employee_id',
        'hr_name',
        'tm_employee_id',
        'tm_name',
        'checklist_date',
        'in_time',
        'out_time',
        [
            'attribute' => 'checklist',
            'format' => 'html',
        ]
    ];

    $fullExportMenu = ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumns,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                //'hiddenColumns' => [0],
                //'noExportColumns' => [0],
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
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']],
        'export' => [
            'label' => 'Page',
            'fontAwesome' => true,
        ],
        'toolbar' => [
            '{export}',
            $fullExportMenu,
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title' => 'Refresh'])
            ],
        ],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<i class="glyphicon glyphicon-book"></i> FSM wise daily checklist'
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Attendance Checklist in descending order.</i>
        </div>
    </div>
</div>

<?php
$this->registerJs(' 

    $(document).ready(function(){
    $(\'.mdelete\').click(function(){

        var keys = $(\'#w4\').yiiGridView(\'getSelectedRows\');
          $.ajax({
            type: \'POST\',
            url : \'mdelete\',
            data : {row_id: keys},
            success : function() {
              $(this).closest(\'tr\').remove(); //or whatever html you use for displaying rows
            }
        });

    });
    });', \yii\web\View::POS_READY);
?>