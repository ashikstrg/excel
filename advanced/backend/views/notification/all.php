<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Notification Summary';
$this->miniTitle = 'Notification Module';
$this->subTitle = 'All Notifications';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-index">

    <?php 
    $gridColumns = [

        ['class' => 'yii\grid\SerialColumn'], 
        
        [
            'header' => 'View',
            'format' => 'raw',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value'=>function ($data) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', [$data->url . '&ntid=' . $data->id]);
            },
        ],
        [
            'attribute' => 'image_web_filename',
            'format' => 'raw',
            'value' => function ($model) {   
            if ($model->image_web_filename!='')
              return '<img src="'.Yii::$app->homeUrl. '/../uploads/hr/'.$model->image_web_filename.'" width="40px" height="40px">'; else return 'no image';
            },
        ], 
        'module_name',
        'created_by_name',
        'name',
        'message',
        'created_at',
        'seen',
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[1],
        'noExportColumns'=>[1],
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
            'rowOptions'=>function($model){
                if($model->read_status == 'Unread'){
                    return ['class' => 'info'];
                }
            },
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
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['all'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> Notifications',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Your reading status will be monitored.</i>
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