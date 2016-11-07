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

    public function actionCreate()
    {
        $model = new TrainingPdf();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            Yii::$app->session->set('training_pdf_name', $model->name);
            Yii::$app->session->set('training_pdf_training_datetime', $model->training_datetime);
            
            Yii::$app->session->setFlash('warning', 'If you do not upload PDF here, then your data will not be saved.');
            $this->redirect('next');
            
        } else {
            return $this->render('create', [
                'model' => $model,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionMdelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $model = $this->findModel($value);
        
            \backend\models\Training::deleteAll(['batch' => $model->batch]);

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

        \backend\models\Training::deleteAll(['batch' => $traingPDFModel->batch]);
        
        $traingPDFModel->delete();
        
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
