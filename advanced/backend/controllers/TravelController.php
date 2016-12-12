<?php

namespace backend\controllers;

use Yii;
use backend\models\Travel;
use backend\models\TravelSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// yii\db\Expression for current time
use yii\db\Expression;

class TravelController extends Controller
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

    public function actionIndex()
    {
        $searchModel = new TravelSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionManage()
    {
        $searchModel = new TravelSearch();
        $dataProvider = $searchModel->manage(Yii::$app->request->queryParams);

        return $this->render('manage', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionConfig()
    {
        $searchModel = new TravelSearch();
        $dataProvider = $searchModel->config(Yii::$app->request->queryParams);

        return $this->render('config', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        $model = new Travel();
        
        $now = new Expression('NOW()');
        $userId = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
            $rand = rand(10,100);
            $random = $random_date . $rand . $userId;
            
            $model->batch = $random;
            $model->hr_employee_id = Yii::$app->session->get('employee_id');
            $model->hr_name  = Yii::$app->session->get('name');
            $model->hr_designation = Yii::$app->session->get('designation');
            $model->hr_employee_type = Yii::$app->session->get('userRole');
            $lineManagerID = 0;
            $lineManagerEmployeeID = '';
            $lineManagerName = '';
            $lineManagerDesignation = '';
            $lineManagerEmployeeType = '';

            if($model->hr_employee_type == 'Sales') {
                
                $hrModel = \backend\models\HrSales::find()
                        ->select(['parent', 'manager_id', 'manager_name', 'manager_designation'])
                        ->where(['employee_id' => $model->hr_employee_id])
                        ->orderBy(['id' => SORT_DESC])
                        ->one();
                
                $lineManagerID = $hrModel->parent;
                $lineManagerEmployeeID = $hrModel->manager_id;
                $lineManagerName = $hrModel->manager_name;
                $lineManagerDesignation = $hrModel->manager_designation;
                $lineManagerEmployeeType = 'Sales';
                
            } else if($model->hr_employee_type == 'FSM') {
                
                $hrModel = \backend\models\Hr::find()
                        ->select(['tm_parent', 'tm_employee_id', 'tm_name'])
                        ->where(['employee_id' => $model->hr_employee_id])
                        ->orderBy(['id' => SORT_DESC])
                        ->one();
                
                $lineManagerID = $hrModel->tm_parent;
                $lineManagerEmployeeID = $hrModel->tm_employee_id;
                $lineManagerName = $hrModel->tm_name;
                $lineManagerDesignation = 'TM';
                $lineManagerEmployeeType = 'Sales';
            }
            
            $model->line_manager_hr_id = $lineManagerID;
            $model->line_manager_employee_id = $lineManagerEmployeeID;
            $model->line_manager_name = $lineManagerName;
            $model->line_manager_designation = $lineManagerDesignation;
            $model->line_manager_employee_type = $lineManagerEmployeeType;
            $model->created_at = $now;
            
            if($model->save()) {
                
                $this->sendNotification($model->id);
                Yii::$app->session->setFlash('success', 'Travel Application has successfully been sent to your line manage.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function sendNotification($id) {
        
        $model = $this->findModel($id);
        
        $notificationModel = new \backend\models\Notification();
        $notificationModel->batch = $model->batch;
        $notificationModel->name = 'Travel Request';
        $notificationModel->module_name = 'Travel';
        $notificationModel->url = '/travel/notification_view?id=' . $id ;
        $notificationModel->hr_id = $model->line_manager_hr_id;
        $notificationModel->hr_employee_id = $model->line_manager_employee_id;
        $notificationModel->hr_designation = $model->line_manager_designation;
        $notificationModel->hr_employee_type = $model->line_manager_employee_type;
        $notificationModel->hr_name = $model->line_manager_name;
        $notificationModel->message = $model->reason;
        $notificationModel->read_status = 'Unread';
        $notificationModel->created_at = $model->created_at;
        $notificationModel->created_by = $model->hr_employee_id;
        $notificationModel->image_web_filename = Yii::$app->session->get('image_web_filename');
        $notificationModel->created_by_name = $model->hr_name;
        
        $notificationModel->save(false);
        
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
    
    public function actionApprove($id) 
    {
        $model = $this->findModel($id);
        $model->status = 'Approved';
        $model->action_date = new Expression('NOW()');
        $model->action_by = Yii::$app->session->get('employee_id');
        
        if($model->save()) {
            Yii::$app->session->setFlash('success', 'The travel application is approved.');
            $this->redirect(['manage']);
        }
    }
    
    public function actionReject($id) 
    {
        $model = $this->findModel($id);
        $model->status = 'Rejected';
        $model->action_date = new Expression('NOW()');
        $model->action_by = Yii::$app->session->get('employee_id');
        
        if($model->save()) {
            Yii::$app->session->setFlash('error', 'The travel application is rejected.');
            $this->redirect(['manage']);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Travel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
