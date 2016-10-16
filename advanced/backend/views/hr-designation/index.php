<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Designation Configuration';
$this->miniTitle = 'HR Module';
$this->subTitle = 'Designation Data';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-designation-index">

    <?php Pjax::begin(); ?>    

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'type',
                'employee_type',
                'parent_name',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Designation'
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Designation should not be configure without Super Admin privilege.</i>
        </div>
    </div>
</div>