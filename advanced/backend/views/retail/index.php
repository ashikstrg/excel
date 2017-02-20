<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

$this->title = 'Retail Configuration';
$this->miniTitle = 'Retail Control Panel';
$this->subTitle = 'Retail Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-index">

    <?php 
    $gridColumns = [
        ['class' => '\kartik\grid\CheckboxColumn'],
        ['class' => 'yii\grid\SerialColumn'],
        
        'channel_type',
        'retail_type',
        'status',
        'dms_code',
        'name',
        'retail_zone',
        'retail_area',
        'territory',
        'retail_location',
        'division',
        'district',
        'upazila',
        'market_name',
        'geotag',
        'Address',
        'contact_no',
        'owner_name',
        'owner_contact_no',
        'owner_email:email',
        'store_contact_no',
        'store_email:email',
        'manager_name',
        'manager_contact_no',
        'store_size_sft',
        'store_facade_feet',
        'number_sec',
        'number_rsa',
        'day_off',
        'connectivity_wifi',
        'created_by',
        'created_at',
        'updated_at',
        'updated_by',

        ['class' => 'yii\grid\ActionColumn'],
    ];

    $fullExportMenu = ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'target' => ExportMenu::TARGET_BLANK,
        'fontAwesome' => true,
        'hiddenColumns'=>[0, 36],
        'noExportColumns'=>[0, 36],
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
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Retail',
                'after' => html::button('<i class="glyphicon glyphicon-remove"></i> Delete Selected Data', ['class' => 'btn btn-danger mdelete pull-right']) . '<div class="clearfix"></div>'
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Retail can not be deleted without Admin privilege.</i>
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
