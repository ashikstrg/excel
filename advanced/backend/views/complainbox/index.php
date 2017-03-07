<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ComplainboxSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Complainboxes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complainbox-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Complainbox', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'token_no',
            'complain:ntext',
            'hr_employee_id',
            'hr_name',
            // 'retail_dms_code',
            // 'retail_name',
            // 'status',
            // 'complain_date',
            // 'feedback:ntext',
            // 'feedback_by_employee_id',
            // 'feedback_by_name',
            // 'feedback_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
