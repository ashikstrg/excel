<?php

namespace backend\controllers;

use Yii;
use backend\models\SalesBatch;
use backend\models\SalesBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

//Custom Models
use backend\models\Product;
use backend\models\Hr;
use backend\models\Sales;

// Custom Helpers
use yii\helpers\HtmlPurifier;

class SalesBatchController extends Controller
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
        $searchModel = new SalesBatchSearch();
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
        $model = new SalesBatch();
        
        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        
        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $uploadExists = 0;
            
            if($model->file){
                
                $filePath = 'uploads/files/sales/';
                $model->file_import = $filePath .rand(10,100).'-'.str_replace('','-',$model->file->name);

                $bulkInsertArray = array();
                $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
                $random = $random_date.rand(10,100).$userId;
                $now = new Expression('NOW()');
                $today = date('Y-m-d', time());

                $uploadExists = 1;
            }

            if($uploadExists){
                
                    $model->file->saveAs($model->file_import) ;

                    $handle = fopen($model->file_import, 'r');
                    
                    if ($handle) {
                            
                        $model->batch = $random;
                        $model->status = 'Active';
                        $model->created_by = $username;
                        $model->created_at = $now;
                        
                        if($model->save()){
                            
                            $hrModel = Hr::find()
                                    ->select(['id', 'retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 
                                        'retail_area', 'retail_territory', 'designation', 'employee_id', 'name', 'tm_parent', 'tm_employee_id', 
                                        'tm_name', 'am_parent', 'am_employee_id', 'am_name', 'csm_parent', 'csm_employee_id', 'csm_name'])
                                    ->where(['user_id' => $userId])
                                    ->one();
                            
                            if($hrModel !== null) {
                                
                                $rowNumber = 0;
                                while( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {
                                
                                    $rowNumber++;
                                    $productModelCode = HtmlPurifier::process(trim($line[0]));
                                    $productModelColor = HtmlPurifier::process(trim($line[1]));
                                    $imeiNumber = HtmlPurifier::process(trim($line[2]));

                                    if($rowNumber == 1) {
                                        continue;
                                    }
                                    
                                    if (strlen($imeiNumber) === 15) {
                                        
                                        $salesModelImei = Sales::find()
                                                ->select('id')
                                                ->where('imei_no=:imei_no', [':imei_no' => $imeiNumber])
                                                ->one();
                                        
                                        if($salesModelImei === null) {
                                            
                                            $productModel = Product::find()
                                            ->select(['id', 'name', 'model_code', 'model_name', 'color', 'type', 'rrp'])
                                            ->where('model_code=:model_code and color=:color', 
                                                    [':model_code' => $productModelCode, ':color' => $productModelColor])
                                            ->one();   
                                    
                                            if($productModel !== null) {

                                                $bulkInsertArray[]=[
                                                    'batch' => $model->batch,
                                                    'retail_id' => $hrModel->retail_id,
                                                    'retail_dms_code' => $hrModel->retail_dms_code,
                                                    'retail_name' => $hrModel->retail_name,
                                                    'retail_channel_type' => $hrModel->retail_channel_type,
                                                    'retail_type' => $hrModel->retail_type,
                                                    'retail_zone' => $hrModel->retail_zone,
                                                    'retail_area' => $hrModel->retail_area,
                                                    'retail_territory' => $hrModel->retail_territory,
                                                    'hr_id' => $hrModel->id,
                                                    'designation' => $hrModel->designation,
                                                    'employee_id' => $hrModel->employee_id,
                                                    'employee_name' => $hrModel->name,
                                                    'tm_parent' => $hrModel->tm_parent,
                                                    'tm_employee_id' => $hrModel->tm_employee_id,
                                                    'tm_name' => $hrModel->tm_name,
                                                    'am_parent' => $hrModel->am_parent,
                                                    'am_employee_id' => $hrModel->am_employee_id,
                                                    'am_name' => $hrModel->am_name,
                                                    'csm_parent' => $hrModel->csm_parent,
                                                    'csm_employee_id' => $hrModel->csm_employee_id,
                                                    'csm_name' => $hrModel->csm_name,
                                                    'product_id' => $productModel->id,
                                                    'product_name' => $productModel->name,
                                                    'product_model_code' => $productModel->model_code,
                                                    'product_model_name' => $productModel->model_name,
                                                    'product_color' => $productModel->color,
                                                    'product_type' => $productModel->type,
                                                    'imei_no' => $imeiNumber,
                                                    'price' => $productModel->rrp,
                                                    'sales_date' => $today,
                                                    'created_at' => $now,
                                                    'created_by' => $username
                                                ];
                                                
                                                $successArray[] = 'Row Number ' . $rowNumber . ':Sales Data has successfully been uploaded.';

                                            } else {

                                                $errorsArray[] = 'Row Number ' . $rowNumber . ':Product Model/Color is invalid.';

                                            }
                                            
                                        } else {
                                            
                                            $errorsArray[] = 'Row Number ' . $rowNumber . ':IMEI Number is not unique.';
                                            
                                        }
                                        
                                    } else {
                                        
                                        $errorsArray[] = '<b>Row Number ' . $rowNumber . ':IMEI Number is invalid.';
                                        
                                    }

                                }
                                
                            } else {
                                
                                $errorsArray[] = 'System Error:Uploader is not a valid a user.';
                                
                            }
                        }
                        
                        fclose($handle);

                        $tableName = 'sales';
                        $columnNameArray=[
                            'batch', 
                            'retail_id',
                            'retail_dms_code',
                            'retail_name',
                            'retail_channel_type',
                            'retail_type',
                            'retail_zone',
                            'retail_area',
                            'retail_territory',
                            'hr_id',
                            'designation',
                            'employee_id',
                            'employee_name',
                            'tm_parent',
                            'tm_employee_id',
                            'tm_name',
                            'am_parent',
                            'am_employee_id',
                            'am_name',
                            'csm_parent',
                            'csm_employee_id',
                            'csm_name',
                            'product_id',
                            'product_name',
                            'product_model_code',
                            'product_model_name',
                            'product_color',
                            'product_type',
                            'imei_no',
                            'price',
                            'sales_date',
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
            return $this->render('create', [
                'model' => $model
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

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        Sales::deleteAll(['batch' => $model->batch]);
        
        $model->status = 'Deleted';
        $model->deleted_by = Yii::$app->user->identity->username;
        $model->deleted_at = new Expression('NOW()');
        $model->save();
        
        return $this->redirect(['index']);
    }
    
    public function actionMdelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $model = $this->findModel($value);
        
            Sales::deleteAll(['batch' => $model->batch]);

            $model->status = 'Deleted';
            $model->deleted_by = Yii::$app->user->identity->username;
            $model->deleted_at = new Expression('NOW()');
            $model->save();
        }

        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = SalesBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
