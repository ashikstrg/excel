<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Employee Type Configuration';
$this->miniTitle = 'HR Module';
$this->subTitle = 'Employee Type Data';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="districts-index">

    <?php Pjax::begin(); ?>    

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'type',
                
                ['class' => 'yii\grid\ActionColumn'],
            ],
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Employee Type'
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Employee Type can not be updated/deleted without Super Admin privilege.</i>
        </div>
    </div>
</div>

