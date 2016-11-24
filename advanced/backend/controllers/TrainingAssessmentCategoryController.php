<?php

namespace backend\controllers;

use Yii;
use backend\models\TrainingAssessmentCategory;
use backend\models\TrainingAssessmentCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// yii\db\Expression for current time
use yii\db\Expression;

class TrainingAssessmentCategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    
    public function actionActive($id){ 
        
        $assessmentCategoryModel = $this->findModel($id);
        
        $assessmentCategoryModel->status = 'Active';
        $assessmentCategoryModel->save(false);
        
        Yii::$app->session->setFlash('success', 'The assessment has successfully been activated.');
        return $this->redirect(['index']);
    }
    
    public function actionFinish($id){  
        
        $assessmentCategoryModel = $this->findModel($id);
        
        $assessmentCategoryModel->status = 'Finish';
        $assessmentCategoryModel->save(false);
        
        Yii::$app->session->setFlash('success', 'The assessment has successfully been activated.');
        return $this->redirect(['index']);
    }
    
    public function actionNotification_view($id, $ntid)
    {
        $notificationModel = \backend\models\Notification::find()
                ->where('id=:id AND read_status=:read_status', 
                [':id' => $ntid, ':read_status' => 'Unread'])
                ->one();
        if(!empty($notificationModel)) {
            $notificationModel->read_status = 'Read';
            $notificationModel->seen = new Expression('NOW()');
            $notificationModel->save(false);
        }
        
        return $this->render('notification_view', [
            'model' => $this->findModel($id),
            'id' => $id
        ]);
    }
    
    public function actionNotification($id){ 
        
        $bulkInsertArray = array();
        $now = new Expression('NOW()');
        $username = Yii::$app->user->identity->username;
        
        $assessmentCategoryModel = $this->findModel($id);
        $assessmentCategoryModel->notification_count += 1;
        $assessmentCategoryModel->save(false);
        
        $designations = array();
        $designations = explode(',', $assessmentCategoryModel->designations);
        
        foreach ($designations as $k => $v) {
            
            $hrModel = null;
            
            if($v == 'CSM' || $v == 'AM' || $v == 'TM') {
                
                $hrModel = \backend\models\HrSales::find()->select(['id', 'name', 'employee_id', 'employee_type'])->where('designation=:designation', [':designation' => $v])->all();
                
            } else {
                
                $hrModel = \backend\models\Hr::find()->select(['id', 'name', 'employee_id', 'employee_type'])->where('designation=:designation', [':designation' => $v])->all();
                
            }
            
            if(!empty($hrModel)) {
                
                foreach($hrModel as $hr) {
                    
                    $bulkInsertArray[]=[
                        'batch' => $assessmentCategoryModel->batch,
                        'name' => $assessmentCategoryModel->name,
                        'module_name' => 'Assessment',
                        'url' => '/training-assessment-category/notification_view?id=' . $id,
                        'hr_id' => $hr->id,
                        'hr_employee_id' => $hr->employee_id,
                        'hr_designation' => $v,
                        'hr_employee_type' => $hr->employee_type,
                        'hr_name' => $hr->name,
                        'message' => $assessmentCategoryModel->message,
                        'read_status' => 'Unread',
                        'created_at' => $now,
                        'created_by' => $username,
                        'image_web_filename' => Yii::$app->session->get('image_web_filename'),
                        'created_by_name' => Yii::$app->session->get('name')
                    ];
                    
                }
                
            }
            
        }
        
        $tableName = 'notification';
        $columnNameArray=[
            'batch',
            'name',
            'module_name',
            'url',
            'hr_id',
            'hr_employee_id',
            'hr_designation',
            'hr_employee_type',
            'hr_name',
            'message',
            'read_status',
            'created_at',
            'created_by',
            'image_web_filename',
            'created_by_name'
        ];
        Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $bulkInsertArray)->execute();
        
        Yii::$app->session->setFlash('success', 'The notification has successfully been sent.');
        return $this->redirect(['index']);
    }

    public function actionIndex()
    {
        $searchModel = new TrainingAssessmentCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAssessment()
    {
        $employeeID = Yii::$app->session->get('employee_id');
        
        $modelTrainingAssessMentCategory = \backend\models\TrainingAssessmentCategory::find()
                ->select(['id', 'batch'])
                ->where(
                'status=:status', [
                ':status' => 'Active'
                ])
                ->orderBy(['id' => SORT_DESC])
                ->one();
        
        if(empty($modelTrainingAssessMentCategory)) {
            $this->render('/site/error', [
                'name' => 'Inactive',
                'message' => 'No Assessment is active right now.'
            ]);
        }
        
        $notificationModel = \backend\models\Notification::find()
        ->select(['id'])
        ->where(
                    'hr_employee_id=:hr_employee_id AND batch=:batch', 
                    [':hr_employee_id' => $employeeID, ':batch' => $modelTrainingAssessMentCategory->batch])
        ->orderBy(['id' => SORT_DESC])
        ->one();
        
        if(empty($modelTrainingAssessMentCategory)) {
            $this->render('/site/error', [
                'name' => 'Inactive',
                'message' => 'No Assessment is active right now.'
            ]);
        }
        
        return $this->redirect(['notification_view', 
            'id' => $modelTrainingAssessMentCategory->id,
            'ntid' => $notificationModel->id
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new TrainingAssessmentCategory();
        $designationModel = \yii\helpers\ArrayHelper::map(\backend\models\HrDesignation::find()->where("employee_type='Sales' OR employee_type='FSM'")->all(), 'type', 'type');
        
        $now = new Expression('NOW()');
        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;
        
        if ($model->load(Yii::$app->request->post())) {
            
            $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
            $rand = rand(10,100);
            $random = $random_date . $rand . $userId;
            
            $model->batch = $random;
            $model->designations = implode(',', $model->designations);
            $model->status = 'Inactive';
            $model->date_month = $model->date_month . '-01';
            $model->notification_count = 0;
            $model->created_by = $username;
            $model->created_at = $now;
            
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Monthly Assessment has successfully been added.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } 
        
        return $this->render('create', [
            'model' => $model,
            'designationModel' => $designationModel
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $designationModel = \yii\helpers\ArrayHelper::map(\backend\models\HrDesignation::find()->where("employee_type='Sales' OR employee_type='FSM'")->all(), 'type', 'type');
        
        $now = new Expression('NOW()');
        $username = Yii::$app->user->identity->username;
        
        if ($model->load(Yii::$app->request->post())) {
            
            $model->designations = implode(',', $model->designations);
            $model->date_month = $model->date_month . '-01';
            $model->created_by = $username;
            $model->created_at = $now;
            
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Monthly Assessment has successfully been updated.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } 
        
        return $this->render('update', [
            'model' => $model,
            'designationModel' => $designationModel
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = TrainingAssessmentCategory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
