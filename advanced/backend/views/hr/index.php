<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'HR (FSM) Configuration';
$this->miniTitle = 'HR Module';
$this->subTitle = 'HR (FSM) Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-index">

    <?php 
    $gridColumns = [
        ['class' => '\kartik\grid\CheckboxColumn'], // 0
        ['class' => 'yii\grid\ActionColumn'], // 1
        ['class' => 'yii\grid\SerialColumn'], // 2

        'retail_dms_code', // 3
        'retail_name', // 4
        'retail_channel_type', // 5
        'retail_type', // 6
        'retail_zone', // 7
        'retail_area', // 8
        'retail_territory', // 9
        'employee_id', // 10
        'name', // 11
        'employee_type', // 12
        'designation', // 13
        [
            'attribute' => 'Image',
            'format' => 'raw',
            'value' => function ($model) {   
            if ($model->image_web_filename!='')
              return '<img src="'.Yii::$app->homeUrl. '/../uploads/hr/'.$model->image_web_filename.'" width="50px" height="auto">'; else return 'no image';
            },
        ], // 14
        'joining_date', //15
        'leaving_date', // 16
        'contact_no_official', // 17
        'contact_no_personal', //18
        'name_immergency_contact_person', // 19
        'relation_immergency_contact_person', // 20
        'contact_no_immergency', // 21
        'email_address_official:email', // 22
        'email_address:email', // 23
        'bank_name', // 24
        'bank_ac_name', // 25
        'bank_ac_no', // 26
        'bkash_no', // 27
        'permanent_address', // 28
        'present_address', // 29
        'blood_group', // 30
        'graduation_status', // 31
        'educational_qualification', // 32
        'educational_institute', // 33
        'educational_qualification_second_last', // 34
        'educational_institute_second_last', // 35
        'previous_experience', // 36
        'previous_experience_two', // 37
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'Total Tenure',
            'value'=>function ($model, $key, $index, $widget) { 

                $p = compact('model', 'key', 'index');
                $additionPreviousExperience = $widget->col(36, $p) + $widget->col(37, $p);

                $d1 = new DateTime($widget->col(15, $p));
                $d2 = new DateTime(date('Y-m-d', time()));
                $currentExperience = $d1->diff($d2)->m + ($d1->diff($d2)->y*12);

                return $additionPreviousExperience + $currentExperience;
            },
            'mergeHeader'=>false,
            'width'=>'150px',
            'hAlign'=>'right',
        ], // 38
        'status', // 39
        'tm_employee_id', // 40
        'tm_name', // 41  
        'created_at', // 42
        'created_by', // 43
        'updated_at', // 44
        'updated_by', // 45
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0, 1, 14],
        'noExportColumns'=>[0, 1, 14],
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of HR (FSM) in Descending Order',
                'after' => html::button('<i class="glyphicon glyphicon-remove"></i> Delete Selected Data', ['class' => 'btn btn-danger mdelete pull-right']) . '<div class="clearfix"></div>'
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* HR should not be deleted without Super Admin privilege.</i>
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