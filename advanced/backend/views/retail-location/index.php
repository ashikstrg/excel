<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Retail Location Configuration';
$this->miniTitle = 'Retail Location Control Panel';
$this->subTitle = 'Retail Location Data';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="retail-location-index">

    <?php Pjax::begin(); ?>    

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'kartik\grid\CheckboxColumn'],
                ['class' => 'yii\grid\SerialColumn'],

                'location',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'], ['class' => 'btn btn-success']) . ' '.
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Retail Location',
                'after' => html::button('<i class="glyphicon glyphicon-remove"></i> Delete Selected Data', ['class' => 'btn btn-danger mdelete pull-right']) . '<div class="clearfix"></div>'
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Do not click on the checkbox unless you want to delete multiple rows.</i>
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
