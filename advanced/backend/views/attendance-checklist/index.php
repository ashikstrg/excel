<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\AttendanceChecklistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Attendance Checklists';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attendance-checklist-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Attendance Checklist', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'question:ntext',
            'answer',
            'remark:ntext',
            'retail_dms_code',
            // 'retail_name',
            // 'hr_employee_id',
            // 'hr_name',
            // 'checklist_date',
            // 'in_time',
            // 'out_time',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
