<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Upazila Configuration';
$this->miniTitle = 'Upazila Control Panel';
$this->subTitle = 'Upazila Data';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upazilas-index">

    <?php Pjax::begin(); ?>    

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'division_id',
                    'value' => 'district.division.name'
                ],
                [
                    'attribute' => 'district_id',
                    'value' => 'district.name'
                ],
                'name'
            ],
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Upazilas'
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Upazilas can not be added/updated/deleted without Super Admin privilege.</i>
        </div>
    </div>
</div>

