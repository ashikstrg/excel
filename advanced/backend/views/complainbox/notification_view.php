<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

$this->title = 'Complain Detail';
$this->miniTitle = 'Complain Module';
$this->subTitle = $model->token_no;
$this->params['breadcrumbs'][] = ['label' => 'Complain List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complainbox-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'token_no',
            'complain',
            'feedback',
            'status',
            'hr_employee_id',
            'hr_name',
            'retail_dms_code',
            'retail_name',
            'complain_date'
        ],
    ]) ?>
    
    <div class="box-footer">
        <div class="row">
            <div class="col-md-6">
                <?= Html::a('Complain List', ['index'], ['class' => 'btn btn-primary']) ?>
            </div>
            <div class="col-md-6">
                <div class="pull-right">
                <?= Html::a('Feedback', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>

</div>