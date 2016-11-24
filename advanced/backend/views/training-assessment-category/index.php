<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Monthly Assessment';
$this->miniTitle = 'Assessment Module';
$this->subTitle = 'Assessment Data in Descending Order';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-result-index">

    <?php 
    
    $gridColumns = [
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {active} {finish} {add} {notification} {update} {delete} ',
            'buttons' => [
                'active' => function ($url, $model) {
                    return $model->status == 'Pending' ? Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                                'title' => Yii::t('app', 'Activate'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to active this assessment?'),
                                'data-method' => 'post',
                    ]) : '';
                },
                        
                'finish' => function ($url, $model) {
                    return $model->status == 'Active' ? Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, [
                                'title' => Yii::t('app', 'Finish'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to finish this assessment?'),
                                'data-method' => 'post',
                    ]) : '';
                },
                        
                'add' => function ($url, $model) {
                    return $model->status == 'Inactive' || $model->status == 'Pending' ? Html::a('<span class="glyphicon glyphicon-question-sign"></span>', $url, [
                                'title' => Yii::t('app', 'Inactivate'),
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
                    return $model->status == 'Inactive' ? Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => Yii::t('app', 'Delete'),
                                'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                'data-method' => 'post',
                    ]) : '';
                },
            ],
            'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'active') {
                    $url = Yii::$app->urlManager->createUrl('training-assessment-category/active?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'finish') {
                    $url = Yii::$app->urlManager->createUrl('training-assessment-category/finish?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'notification') {
                    $url = Yii::$app->urlManager->createUrl('training-assessment-category/notification?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'view') {
                    $url = Yii::$app->urlManager->createUrl('training-assessment-category/view?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'add') {
                    $url = Yii::$app->urlManager->createUrl('training-assessment-question/add?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'update') {
                    $url = Yii::$app->urlManager->createUrl('training-assessment-category/update?id=' . $model->id);
                    return $url;
                }
                
                if ($action === 'delete') {
                    $url = Yii::$app->urlManager->createUrl('training-assessment-category/delete?id=' . $model->id);
                    return $url;
                }
            }
        ], // 0
        [
            'header' => 'Questions',
            'format' => 'raw',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value'=>function ($data) {
                    return Html::a('<i class="fa fa-search"></i>', ['/training-assessment-question/index', 'TrainingAssessmentQuestionSearch[category_id]' => $data->id]);
            },
        ], // 1
        [
            'header' => 'Results',
            'format' => 'raw',
            'hAlign' => 'center',
            'vAlign' => 'middle',
            'value'=>function ($data) {
                    return Html::a('<i class="fa fa-search"></i>', ['/training-assessment-result/index', 'TrainingAssessmentResultSearch[category_id]' => $data->id]);
            },
        ], // 2
        ['class' => 'yii\grid\SerialColumn'], // 3
        'name',
        'designations',
        'qlimit',
        'estimated_time',
        'date_month',
        'status',
        'message',
        'notification_count',
        'created_by',
        'created_at'
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0, 1, 2],
        'noExportColumns'=>[0, 1,  2],
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Assessment Data',
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>