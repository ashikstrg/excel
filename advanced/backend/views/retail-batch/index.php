<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Uploaded Data';
$this->miniTitle = 'Retail Module';
$this->subTitle = 'List of Active Retail Batch Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-batch-index">

    <?php 
    $gridColumns = [
        ['class' => '\kartik\grid\CheckboxColumn'], // 0
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete}',
        ], // 1
        [
            'header' => 'Seach',
            'format' => 'raw',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value'=>function ($data) {
                return Html::a('<i class="fa fa-search"></i>', ['/retail/index', 'RetailSearch[batch]' => $data->batch]);
            },
        ], //2
        ['class' => 'yii\grid\SerialColumn'], // 3

        'batch',
        'total_row',
        'created_by',
        'created_at'
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0, 1, 2],
        'noExportColumns'=>[0, 1, 2],
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Retail Batch File in Descending Order',
                'after' => html::button('<i class="glyphicon glyphicon-remove"></i> Delete Selected Data', ['class' => 'btn btn-danger mdelete pull-right']) . '<div class="clearfix"></div>'
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Retail Files are linked to the main data. Be careful before delete.</i>
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