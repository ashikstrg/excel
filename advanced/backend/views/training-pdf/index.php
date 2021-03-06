<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Uploaded Data';
$this->miniTitle = 'Training Module';
$this->subTitle = 'Uploaded Training Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-pdf-index">

    <?php 
    $gridColumns = [
        ['class' => '\kartik\grid\CheckboxColumn'], // 0
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {active} {inactive} {notification} {update} {delete}',
            'buttons' => [
                'active' => function ($url, $model) {
                    return $model->status == 'Inactive' ? Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                'title' => Yii::t('app', 'Activate'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to active this training?'),
                                'data-method' => 'post',
                    ]) : '';
                },
                'inactive' => function ($url, $model) {
                    return $model->status == 'Active' ? Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                'title' => Yii::t('app', 'Inactivate'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to inactivate this training?'),
                                'data-method' => 'post',
                    ]) : '';
                },
                        
                'notification' => function ($url, $model) {
                    return $model->status == 'Active' ? Html::a('<span class="glyphicon glyphicon-bell"></span>', $url, [
                                'title' => Yii::t('app', 'Send Notification'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to send notification?'),
                                'data-method' => 'post',
                    ]) : '';
                },
                        
                'delete' => function ($url, $model) {
                    return $model->status == 'Deleted' ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                'data-method' => 'post',
                    ]) : '';
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'active') {
                    $url = Yii::$app->urlManager->createUrl('training-pdf/active?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'inactive') {
                    $url = Yii::$app->urlManager->createUrl('training-pdf/inactive?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'notification') {
                    $url = Yii::$app->urlManager->createUrl('training-pdf/notification?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'view') {
                    $url = Yii::$app->urlManager->createUrl('training-pdf/view?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'update') {
                    $url = Yii::$app->urlManager->createUrl('training-pdf/update?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'delete') {
                    $url = Yii::$app->urlManager->createUrl('training-pdf/delete?id=' . $model->id);
                    return $url;
                }
            }
        ], // 1
        ['class' => 'yii\grid\SerialColumn'], // 2

            'batch',
            'name',
            'designations',
            'message',
            'status',
            'notification_count',
            'created_by',
            'created_at',
            'deleted_by',
            'deleted_at',
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0, 1],
        'noExportColumns'=>[0, 1],
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Uploaded Training Data',
                'after' => html::button('<i class="glyphicon glyphicon-remove"></i> Delete Selected Data', ['class' => 'btn btn-danger mdelete pull-right']) . '<div class="clearfix"></div>'
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Training Files are linked to the main target data. Be careful before delete.</i>
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