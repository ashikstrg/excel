<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Division Configuration';
$this->miniTitle = 'Division Control Panel';
$this->subTitle = 'Division Data';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="divisions-index">

    <?php Pjax::begin(); ?>    

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name'
            ],
            'toolbar' =>  [
                ['content'=>
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['index'], ['class' => 'btn btn-warning', 'title'=> 'Refresh'])
                ],
            ],

            'panel' => [
                'type' => GridView::TYPE_PRIMARY,
                'heading'=> '<i class="glyphicon glyphicon-book"></i> List of Divisions'
            ],
        ]); ?>
    <?php Pjax::end(); ?>

</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <i>* Divisions can not be added/updated/deleted without Super Admin privilege.</i>
        </div>
    </div>
</div>

