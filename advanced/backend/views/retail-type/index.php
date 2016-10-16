<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Retail Type Configuration';
$this->miniTitle = 'Retail Type Control Panel';
$this->subTitle = 'Retail Type Data';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-type-index">

<?php Pjax::begin(); ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => '\kartik\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'channel_type_id',
                'value' => 'channelType.type',
            ],
            'type',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
    
</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-6">
            <?= html::button('Delete Multiple', ['class' => 'btn btn-danger mdelete']) ?>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <?= Html::a('Create New', ['create'], ['class' => 'btn btn-success']) ?>
            </div>
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
