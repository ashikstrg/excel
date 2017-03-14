<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'HR Configuration (Sales)';
$this->miniTitle = 'HR Module';
$this->subTitle = 'HR Data (Sales)';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-sales-index">

    <?php 
    $gridColumns = [
        ['class' => '\kartik\grid\CheckboxColumn'], // 0
        ['class' => 'yii\grid\ActionColumn'], // 1
        ['class' => 'yii\grid\SerialColumn'], // 2

        'employee_id', // 3
        'name', // 4
        'employee_type', // 5
        'designation', // 6
        [
            'attribute' => 'Image',
            'format' => 'raw',
            'value' => function ($model) {   
            if ($model->image_web_filename!='')
              return '<img src="'.Yii::$app->homeUrl. '/../uploads/hr/'.$model->image_web_filename.'" width="50px" height="auto">'; else return 'no image';
            },
        ], // 7
        'joining_date', // 8
        'leaving_date', // 9
        'contact_no_official', // 10
        'contact_no_personal', //11
        'name_immergency_contact_person', // 12
        'relation_immergency_contact_person', // 13
        'contact_no_immergency', // 14
        'email_address_official:email', // 15
        'email_address:email', // 16
        'bank_name', // 17
        'bank_ac_name', // 18
        'bank_ac_no', // 19
        'bkash_no', // 20
        'permanent_address', // 21
        'present_address', // 22
        'blood_group', // 23
        'graduation_status', // 24
        'educational_qualification', // 25
        'educational_institute', // 26
        'educational_qualification_second_last', // 27
        'educational_institute_second_last', // 28
        'previous_experience', // 29
        'previous_experience_two', // 30
        [
            'class'=>'kartik\grid\FormulaColumn',
            'header'=>'Total Tenure',
            'value'=>function ($model, $key, $index, $widget) { 

                $p = compact('model', 'key', 'index');
                $additionPreviousExperience = $widget->col(29, $p) + $widget->col(30, $p);

                $d1 = new DateTime($widget->col(8, $p));
                $d2 = new DateTime(date('Y-m-d', time()));
                $currentExperience = $d1->diff($d2)->m + ($d1->diff($d2)->y*12);

                return $additionPreviousExperience + $currentExperience;
            },
            'mergeHeader'=>false,
            'width'=>'150px',
            'hAlign'=>'right',
        ], // 31
        'status', // 32
        'manager_id', // 33
        'manager_name', // 34
        'manager_designation', // 35     
        'created_at', // 36
        'created_by', // 37
        'updated_at', // 38
        'updated_by', // 39
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0, 1, 7],
        'noExportColumns'=>[0, 1, 7],
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of HR (Sales) in Descending Order',
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

        var keys = $(\'#w1\').yiiGridView(\'getSelectedRows\');
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