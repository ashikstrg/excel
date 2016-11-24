<?php

namespace backend\controllers;

use Yii;
use backend\models\TrainingPdf;
use backend\models\TrainingPdfSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

class TrainingPdfController extends Controller
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
        $searchModel = new TrainingPdfSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        ]);
    }

    public function actionCreate()
    {
        $model = new TrainingPdf();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            Yii::$app->session->set('training_pdf_name', $model->name);
            Yii::$app->session->set('training_pdf_message', $model->message);
            Yii::$app->session->set('training_pdf_designations', implode(',', $model->designations));
            Yii::$app->session->set('training_pdf_training_datetime', $model->training_datetime);
            
            Yii::$app->session->setFlash('warning', 'If you do not upload PDF here, then your data will not be saved.');
            $this->redirect('next');
            
        } else {
            
            $designationModel = \yii\helpers\ArrayHelper::map(\backend\models\HrDesignation::find()->where("employee_type='Sales' OR employee_type='FSM'")->all(), 'type', 'type');
            
            return $this->render('create', [
                'model' => $model,
                'designationModel' => $designationModel
            ]);
        }
    }
    
    public function actionNext()
    {
        if(!Yii::$app->session->has('training_pdf_name') || !Yii::$app->session->has('training_pdf_training_datetime')) {
            
            Yii::$app->session->setFlash('error', 'Please enter training name and date-time.');
            $this->redirect('create');
            
        }
        
        $model = new TrainingPdf();
        
        return $this->render('next', [
            'model' => $model,
        ]);
    }
    
    public function actionUpload()
    {
        if(!Yii::$app->session->has('training_pdf_name') || !Yii::$app->session->has('training_pdf_training_datetime')) {
            
            Yii::$app->session->setFlash('error', 'Please enter training name and date-time.');
            $this->redirect('create');
            
        } 
        
        $model = new TrainingPdf();
        
        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;
        
        $model->file = UploadedFile::getInstance($model, 'file');
        $uploadExists = 0;

        if($model->file){
            
            $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
            $rand = rand(10,100);
            $random = $random_date . $rand . $userId;
            $now = new Expression('NOW()');

            $filePath = 'uploads/files/training/pdf/';  
            $model->file_import = $filePath . $random .'-'.str_replace('','-',$model->file->name);

            $uploadExists = 1;
        }

        if($uploadExists){

            $model->file->saveAs($model->file_import);
            $model->batch = $random;
            $model->created_by = $username;
            $model->created_at = $now;
            $model->name = Yii::$app->session->get('training_pdf_name');
            $model->message = Yii::$app->session->get('training_pdf_message');
            $model->designations = Yii::$app->session->get('training_pdf_designations');
            $model->training_datetime = Yii::$app->session->get('training_pdf_training_datetime');    
            
            if($model->save()) {
                Yii::$app->session->remove('training_pdf_name');
                Yii::$app->session->remove('training_pdf_training_datetime');
                
                Yii::$app->session->setFlash('success', 'Training PDF has successfully been uploaded.');
                $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'System error. Please try again.');
                $this->redirect('next');
            }
            
        } else {
            Yii::$app->session->setFlash('error', 'System error. Please try again.');
            $this->redirect('next');
        }

    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            Yii::$app->session->set('training_pdf_name', $model->name);
            Yii::$app->session->set('training_pdf_message', $model->message);
            Yii::$app->session->set('training_pdf_designations', implode(',', $model->designations));
            Yii::$app->session->set('training_pdf_training_datetime', $model->training_datetime);
            
            Yii::$app->session->setFlash('warning', 'If you do not upload PDF here, then your data will not be saved.');
            $this->redirect('next');
            
        } else {
            
            $designationModel = \yii\helpers\ArrayHelper::map(\backend\models\HrDesignation::find()->where("employee_type='Sales' OR employee_type='FSM'")->all(), 'type', 'type');
            
            return $this->render('update', [
                'model' => $model,
                'designationModel' => $designationModel
            ]);
        }
    }
    
    public function actionMdelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $model = $this->findModel($value);

            $model->status = 'Deleted';
            $model->deleted_by = Yii::$app->user->identity->username;
            $model->deleted_at = new Expression('NOW()');
            $model->save(false);
        }

        return $this->redirect(['index']);

    }

    public function actionDelete($id)
    {
        $traingPDFModel = $this->findModel($id);

        unlink(getcwd() . '/' . $traingPDFModel->file_import);
        
        $traingPDFModel->delete();
        
        Yii::$app->session->setFlash('success', 'Data has successfully been deleted.');
        return $this->redirect(['index']);
    }
    
    public function actionActive($id){ 
        $traingPDFModel = $this->findModel($id);
        
        $traingPDFModel->created_by = Yii::$app->user->identity->username;
        $traingPDFModel->created_at = new Expression('NOW()');
        $traingPDFModel->status = 'Active';
        $traingPDFModel->save(false);
        
        Yii::$app->session->setFlash('success', 'The training has successfully been activated.');
        return $this->redirect(['index']);
    }
    
    public function actionInactive($id){  
        $traingPDFModel = $this->findModel($id);
        
        $traingPDFModel->created_by = Yii::$app->user->identity->username;
        $traingPDFModel->created_at = new Expression('NOW()');
        $traingPDFModel->status = 'Inactive';
        $traingPDFModel->save(false);
        
        Yii::$app->session->setFlash('success', 'The training has successfully been inactivated.');
        return $this->redirect(['index']);
    }
    
    public function actionNotification($id){ 
        
        $bulkInsertArray = array();
        $now = new Expression('NOW()');
        $username = Yii::$app->user->identity->username;
        
        $traingPDFModel = $this->findModel($id);
        $traingPDFModel->notification_count += 1;
        $traingPDFModel->save(false);
        
        $designations = array();
        $designations = explode(',', $traingPDFModel->designations);
        
        foreach ($designations as $k => $v) {
            
            $hrModel = null;
            
            if($v == 'CSM' || $v == 'AM' || $v == 'TM') {
                
                $hrModel = \backend\models\HrSales::find()->select(['id', 'name', 'employee_id', 'employee_type'])->where('designation=:designation', [':designation' => $v])->all();
                
            } else {
                
                $hrModel = \backend\models\Hr::find()->select(['id', 'name', 'employee_id', 'employee_type'])->where('designation=:designation', [':designation' => $v])->all();
                
            }
            
            if(!empty($hrModel)) {
                
                foreach ($hrModel as $hr) {
                    
                    $bulkInsertArray[]=[
                        'batch' => $traingPDFModel->batch,
                        'name' => $traingPDFModel->name,
                        'module_name' => 'Training',
                        'url' => '/training-pdf/notification_view?id=' . $id,
                        'hr_id' => $hr->id,
                        'hr_employee_id' => $hr->employee_id,
                        'hr_designation' => $v,
                        'hr_employee_type' => $hr->employee_type,
                        'hr_name' => $hr->name,
                        'message' => $traingPDFModel->message,
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
    
    public function actionAdd($id)
    {
        $model = $this->findModel($id);
            
        return $this->redirect(['training-batch/add', 'id' => $model->id]);

    }

    protected function findModel($id)
    {
        if (($model = TrainingPdf::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
