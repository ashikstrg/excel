<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrainingBatchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Training Batches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="training-batch-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Training Batch', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'batch',
            'name',
            'file_import',
            'status',
            // 'notification_count',
            // 'created_by',
            // 'deleted_by',
            // 'created_at',
            // 'deleted_at',
            // 'training_datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
