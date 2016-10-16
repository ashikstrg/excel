<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Product Color Configuration';
$this->miniTitle = 'Product Module';
$this->subTitle = 'Product Color Data';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-color-index">

    <?php Pjax::begin(); ?>    

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'color',

                ['class' => 'yii\grid\ActionColumn'],
            ],
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Product Color'
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Product Color should not be configured without Admin privilege.</i>
        </div>
    </div>
</div>