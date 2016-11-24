<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = 'Monthly Assessment';
$this->miniTitle = 'Assessment Module';
$this->subTitle = 'Result Detail';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-assessment-result-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'date_month',
                'value' => date('F, Y', strtotime($model->date_month))
            ],
            [
                'attribute' => 'participation_datetime',
                'value' => date('Y-m-d h:i:s A', strtotime($model->participation_datetime))
            ],
            'right_answer',
            'wrong_answer',
            'un_answer',
            [
                'attribute' => 'total_time',
                'value' => $model->total_time . ' Min'
            ],
        ],
    ]); ?>


</div>

<div class="box-footer">
    <div class="row">
        <div class="col-md-12">
            <a href="#">
                <h3>
                  Score Percentage
                  <small class="pull-right"><?= $model->score_percent; ?>%</small>
                </h3>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-aqua" style="width: <?= floor($model->score_percent); ?>%" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    <span class="sr-only"><?= $model->score_percent; ?>% Complete</span>
                  </div>
                </div>
            </a>
        </div>
    </div>
</div>