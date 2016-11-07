<?php

namespace backend\controllers;

use Yii;
use backend\models\TrainingBatch;
use backend\models\TrainingBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

// Custom Helpers
use yii\helpers\HtmlPurifier;

class TrainingBatchController extends Controller
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
        $searchModel = new TrainingBatchSearch();
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
        $model = new TrainingBatch();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
    
    public function actionAdd($id)
    {
        $model = new TrainingBatch();
        
        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        
        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) { 
            
            $model->file = UploadedFile::getInstance($model, 'file');
            $uploadExists = 0;

            if($model->file){

                $filePath = 'uploads/files/training/csv/';

                $bulkInsertArray = array();
                $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
                $rand = rand(10,100);
                $random = $random_date . $rand . $userId;
                $now = new Expression('NOW()');

                $model->file_import = $filePath . $random .'-'.str_replace('','-',$model->file->name);

                $uploadExists = 1;
            }

            if($uploadExists){

                $trainingPDF = \backend\models\TrainingPdf::findOne($id);

                $model->file->saveAs($model->file_import) ;

                $handle = fopen($model->file_import, 'r');

                if ($handle) {

                    $model->batch = $trainingPDF->batch;
                    $model->name = $trainingPDF->name;
                    $model->status = $trainingPDF->status;
                    $model->created_by = $username;
                    $model->created_at = $now;

                    if($model->save()){

                        $rowNumber = 0;
                        while( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                            $rowNumber++;
                            $emloyeeType = HtmlPurifier::process(trim($line[0]));
                            $employeeId = HtmlPurifier::process(trim($line[1]));

                            if($rowNumber == 1) {
                                continue;
                            }

                            $hrModel = null;
                            if(strtolower($emloyeeType) == 'sales') {
                                $hrModel = \backend\models\HrSales::find()
                                    ->select(['id', 'employee_id', 'designation', 'employee_type', 'name'])
                                    ->where('employee_id=:employee_id', 
                                            [':employee_id' => $employeeId])
                                    ->one();
                            } else if(strtolower($emloyeeType) == 'fsm') {
                                $hrModel = \backend\models\Hr::find()
                                    ->select(['id', 'employee_id', 'designation', 'employee_type', 'name'])
                                    ->where('employee_id=:employee_id', 
                                            [':employee_id' => $employeeId])
                                    ->one();
                            }

                            if($hrModel !== null) {

                                $bulkInsertArray[]=[
                                    'batch' => $trainingPDF->batch,
                                    'name' => $trainingPDF->name,
                                    'hr_id' => $hrModel->id,
                                    'hr_employee_id' => $hrModel->employee_id,
                                    'hr_designation' => $hrModel->designation,
                                    'hr_employee_type' => $hrModel->employee_type,
                                    'hr_name' => $hrModel->name,
                                    'message' => $model->message,
                                    'training_datetime' => $trainingPDF->training_datetime,
                                    'status' => $trainingPDF->status,
                                    'read_status' => 'Unread',
                                    'created_at' => $now,
                                    'created_by' => $username
                                ];

                                $successArray[] = 'Row Number ' . $rowNumber . ':Training Data has successfully been uploaded.';

                            } else {

                                $errorsArray[] = 'Row Number ' . $rowNumber . ':Employee ID does not exist.';

                            }

                        }

                    }

                    fclose($handle);

                    $tableName = 'training';
                    $columnNameArray=[
                        'batch',
                        'name',
                        'hr_id',
                        'hr_employee_id',
                        'hr_designation',
                        'hr_employee_type',
                        'hr_name',
                        'message',
                        'training_datetime',
                        'status',
                        'read_status',
                        'created_at',
                        'created_by'
                    ];
                    Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $bulkInsertArray)->execute();
                    #print_r($bulkInsertArray);
                }
            }

            \Yii::$app->session['errorsArray'] = $errorsArray;
            \Yii::$app->session['successArray'] = $successArray;
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            return $this->render('add', [
                'model' => $model
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
        if (($model = TrainingBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
