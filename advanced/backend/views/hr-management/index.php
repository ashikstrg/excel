<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\HrManagementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hr Managements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hr-management-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Hr Management', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'designation_id',
            'designation',
            'employee_type_id',
            'employee_type',
            // 'employee_id',
            // 'name',
            // 'status',
            // 'joining_date',
            // 'leaving_date',
            // 'image',
            // 'image_src_filename',
            // 'image_web_filename',
            // 'contact_no_official',
            // 'contact_no_personal',
            // 'name_immergency_contact_person',
            // 'relation_immergency_contact_person',
            // 'contact_no_immergency',
            // 'email_address:email',
            // 'email_address_official:email',
            // 'blood_group',
            // 'graduation_status',
            // 'educational_qualification',
            // 'educational_institute',
            // 'educational_qualification_second_last',
            // 'educational_institute_second_last',
            // 'previous_experience',
            // 'previous_experience_two',
            // 'permanent_address',
            // 'present_address',
            // 'created_at',
            // 'created_by',
            // 'updated_at',
            // 'updated_by',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
