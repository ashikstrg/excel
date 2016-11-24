<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Monthly Assessment';
$this->miniTitle = 'Assessment Module';
$this->subTitle = $model->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-pdf-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'message',
            'designations',
            'qlimit',
            'estimated_time',
            [
                'attribute' => 'date_month',
                'value' => date('F, Y', strtotime($model->date_month))
            ]
        ],
    ]) ?>
    
    <div class="box-footer">
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <?= Html::a('Start Test', ['/training-assessment-result/questions', 'id' => $id], ['class' => 'btn btn-lg btn-primary']) ?>
            </div>
        </div>
    </div>

</div>