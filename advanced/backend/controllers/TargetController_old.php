<?php

namespace backend\controllers;

use Yii;
use backend\models\TargetBatch;
use backend\models\TargetBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

//Custom Models
use backend\models\Product;
use backend\models\Hr;
use backend\models\HrSales;
use backend\models\Target;
use backend\models\Sales;

// Custom Helpers
use yii\helpers\HtmlPurifier;

class TargetBatchController extends Controller
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
        $searchModel = new TargetBatchSearch();
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
    
    public function actionUpload()
    {
        $model = new TargetBatch();
        
        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        
        $username = Yii::$app->user->identity->username;
        $userId = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $uploadExists = 0;
            
            if($model->file){
                
                $filePath = 'uploads/files/targets/';
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
                    
                    if($handle) {
                            
                        $model->batch = $random;
                        $model->status = 'Active';
                        $model->created_by = $username;
                        $model->created_at = $now;
                        $targetDate = $model->target_date . '-01';
                        $model->target_date = $targetDate;
                        
                        if($model->save()){
                                
                            $rowNumber = 0;
                            while( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                                $rowNumber++;
                                $employeeId = HtmlPurifier::process(trim($line[0]));
                                $productModelCode = HtmlPurifier::process(trim($line[1]));
                                $targetVolume = (int)HtmlPurifier::process(trim($line[2]));          

                                if($rowNumber == 1) {
                                    continue;
                                }

                                if (is_int($targetVolume)) {

                                    $productModel = Product::find()
                                    ->select(['rrp'])
                                    ->where('model_code=:model_code', 
                                            [':model_code' => $productModelCode])
                                    ->one();   

                                    if($productModel !== null) {

                                        $targetValue = $productModel->rrp * $targetVolume;

                                        $bulkUpdateArray = array();
                                        if(Yii::$app->session->get('isAM')) {

                                            $bulkUpdateArray = [
                                                'tm_vol' => $targetVolume,
                                                'tm_val' => $targetValue,
                                                'updated_at' => $now,
                                                'updated_by' => $username
                                            ];
                                            
                                            Target::updateAll($bulkUpdateArray, "product_model_code='$productModelCode' AND tm_employee_id='$employeeId' AND target_date='$targetDate'");

                                        } else if(Yii::$app->session->get('isTM')) {

                                            $bulkUpdateArray = [
                                                'fsm_vol' => $targetVolume,
                                                'fsm_val' => $targetValue,
                                                'updated_at' => $now,
                                                'updated_by' => $username
                                            ];

                                             Target::updateAll($bulkUpdateArray, "product_model_code='$productModelCode' AND employee_id='$employeeId' AND target_date='$targetDate'");

                                        } 

                                        $successArray[] = 'Row Number ' . $rowNumber . ':Target Data has successfully been uploaded.';

                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ':Product Model is invalid.';

                                    }

                                } else {

                                    $errorsArray[] = 'Row Number ' . $rowNumber . ':Target Volume is not an integer.';

                                }

                            }
                                
                        }
                        
                        fclose($handle);

                    }
            }
            
            \Yii::$app->session['errorsArray'] = $errorsArray;
            \Yii::$app->session['successArray'] = $successArray;
            return $this->redirect(['view', 'id' => $model->id]);
            
	} else {
            return $this->render('upload', [
                'model' => $model
            ]);
        }
    }

    public function actionCreate()
    {
        $model = new TargetBatch();
        
        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        
        $username = Yii::$app->user->identity->username;
        $userId = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $uploadExists = 0;
            
            if($model->file){
                
                $filePath = 'uploads/files/targets/';
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
                    
                    if($handle) {
                            
                        $model->batch = $random;
                        $model->status = 'Active';
                        $model->created_by = $username;
                        $model->created_at = $now;
                        $model->target_date = $model->target_date . '-01';
                        $monthYear = explode('-', $model->target_date);
                        
                        if($model->save()){
                            
                            $hrSalesModel = HrSales::find()
                                    ->select(['id'])
                                    ->where(['designation' => 'CSM'])
                                    ->one();
                            
                            $hrSalesAmCount = HrSales::find()
                                    ->where(['designation' => 'AM'])
                                    ->count();
                            
                            $hrModel = Hr::find()
                                    ->select(['id', 'retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 
                                        'retail_area', 'retail_territory', 'designation', 'employee_id', 'name', 'tm_parent', 'tm_employee_id', 
                                        'tm_name', 'am_parent', 'am_employee_id', 'am_name', 'csm_parent', 'csm_employee_id', 'csm_name'])
                                    ->where(['csm_parent' => $hrSalesModel->id, 'status' => 'Active'])
                                    ->all();
                            
                            if($hrModel !== null) {
                                
                                $rowNumber = 0;
                                while( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {
                                
                                    $rowNumber++;
                                    if($rowNumber == 1) {
                                        continue;
                                    }
                                    
                                    $productModelCode = HtmlPurifier::process(trim($line[0]));
                                    $targetVolume = (int)HtmlPurifier::process(trim($line[1]));  
                                    
                                    if (is_int($targetVolume)) {
                                        
                                        $targetVolumeAm = ceil($targetVolume/$hrSalesAmCount);
                                        
                                        $targetModelEntry = Target::find()
                                                ->select('id')
                                                ->where('product_model_code=:product_model_code AND target_date=:target_date', [':product_model_code' => $productModelCode, ':target_date' => $model->target_date])
                                                ->one();
                                        
                                        if($targetModelEntry === null) {
                                            
                                            $productModel = Product::find()
                                            ->select(['name', 'model_code', 'model_name', 'type', 'rrp'])
                                            ->where('model_code=:model_code', 
                                                    [':model_code' => $productModelCode])
                                            ->one();   
                                    
                                            if($productModel !== null) {
                                                
                                                $targetValue = $productModel->rrp;
                                                $targetValueAm = number_format(($targetValue / $hrSalesAmCount), 2);

                                                foreach($hrModel as $hr) { 
                                                    
                                                    $hrId = $hr->id;
                                                    $tmParent = $hr->tm_parent;
                                                    $amParent = $hr->am_parent;
                                                    $csmParent = $hr->csm_parent;
                                                    
                                                    $sales = (new \yii\db\Query())
                                                            ->select([
                                                                "sum(case when `hr_id`='$hrId' then 1 else 0 end) fsm_vol",
                                                                "sum(case when `hr_id`='$hrId' then price else 0 end) fsm_val",
                                                                "sum(case when `tm_parent`='$tmParent' then 1 else 0 end) tm_vol",
                                                                "sum(case when `tm_parent`='$tmParent' then price else 0 end) tm_val",
                                                                "sum(case when `am_parent`='$amParent' then 1 else 0 end) am_vol",
                                                                "sum(case when `am_parent`='$amParent' then price else 0 end) am_val",
                                                                "sum(case when `csm_parent`='$csmParent' then 1 else 0 end) csm_vol",
                                                                "sum(case when `csm_parent`='$csmParent' then price else 0 end) csm_val"])
                                                            ->from('sales')
                                                            ->where([
                                                                'product_model_code' => $productModelCode, 
                                                                'YEAR(sales_date)' => $monthYear[0], 
                                                                'MONTH(sales_date)' => $monthYear[1]])
                                                            ->one();
                                                    
//                                                    $salesVol = Sales::find()
//                                                            ->where('product_model_code=:product_model_code AND csm_parent=:csm_parent AND (MONTH(sales_date)=:sales_date_month AND YEAR(sales_date)=:sales_date_year)', 
//                                                                    [':product_model_code' => $productModelCode, ':csm_parent' => $hr->csm_parent, ':sales_date_month' => $monthYear[1], ':sales_date_year' => $monthYear[0]])
//                                                            ->count();
//                                                    $salesVal = Sales::find()
//                                                            ->where('product_model_code=:product_model_code AND csm_parent=:csm_parent AND (MONTH(sales_date)=:sales_date_month AND YEAR(sales_date)=:sales_date_year)', 
//                                                                    [':product_model_code' => $productModelCode, ':csm_parent' => $hr->csm_parent, ':sales_date_month' => $monthYear[1], ':sales_date_year' => $monthYear[0]])
//                                                            ->sum('price');
//                                                    $salesVolAm = Sales::find()
//                                                            ->where('product_model_code=:product_model_code AND am_parent=:am_parent AND (MONTH(sales_date)=:sales_date_month AND YEAR(sales_date)=:sales_date_year)', 
//                                                                    [':product_model_code' => $productModelCode, ':am_parent' => $hr->am_parent, ':sales_date_month' => $monthYear[1], ':sales_date_year' => $monthYear[0]])
//                                                            ->count();
//                                                    $salesValAm = Sales::find()
//                                                            ->where('product_model_code=:product_model_code AND am_parent=:am_parent AND (MONTH(sales_date)=:sales_date_month AND YEAR(sales_date)=:sales_date_year)', 
//                                                                    [':product_model_code' => $productModelCode, ':am_parent' => $hr->am_parent, ':sales_date_month' => $monthYear[1], ':sales_date_year' => $monthYear[0]])
//                                                            ->sum('price');
                                                    
                                                    $bulkInsertArray[]=[
                                                        'batch' => $model->batch,
                                                        'retail_id' => $hr->retail_id,
                                                        'retail_dms_code' => $hr->retail_dms_code,
                                                        'retail_name' => $hr->retail_name,
                                                        'retail_channel_type' => $hr->retail_channel_type,
                                                        'retail_type' => $hr->retail_type,
                                                        'retail_zone' => $hr->retail_zone,
                                                        'retail_area' => $hr->retail_area,
                                                        'retail_territory' => $hr->retail_territory,
                                                        'hr_id' => $hrId,
                                                        'designation' => $hr->designation,
                                                        'employee_id' => $hr->employee_id,
                                                        'employee_name' => $hr->name,
                                                        'fsm_vol' => 0,
                                                        'fsm_val' => 0.00,
                                                        'fsm_vol_sales' => $sales['fsm_vol'],
                                                        'fsm_val_sales' => $sales['fsm_val'],
                                                        'tm_parent' => $tmParent,
                                                        'tm_employee_id' => $hr->tm_employee_id,
                                                        'tm_name' => $hr->tm_name,
                                                        'tm_vol' => 0,
                                                        'tm_val' => 0.0,
                                                        'tm_vol_sales' => $sales['tm_vol'],
                                                        'tm_val_sales' => $sales['tm_val'],
                                                        'am_parent' => $amParent,
                                                        'am_employee_id' => $hr->am_employee_id,
                                                        'am_name' => $hr->am_name,
                                                        'am_vol' => $targetVolumeAm,
                                                        'am_val' => $targetValueAm,
                                                        'am_vol_sales' => $sales['am_vol'],
                                                        'am_val_sales' => $sales['am_val'],
                                                        'csm_parent' => $csmParent,
                                                        'csm_employee_id' => $hr->csm_employee_id,
                                                        'csm_name' => $hr->csm_name,
                                                        'csm_vol' => $targetVolume,
                                                        'csm_val' => $targetValue,
                                                        'csm_vol_sales' => $sales['csm_vol'],
                                                        'csm_val_sales' => $sales['csm_val'],
                                                        'product_name' => $productModel->name,
                                                        'product_model_code' => $productModel->model_code,
                                                        'product_model_name' => $productModel->model_name,
                                                        'product_type' => $productModel->type,
                                                        'target_date' => $model->target_date,
                                                        'created_at' => $now,
                                                        'created_by' => $username
                                                    ];
                                                    
                                                }
                                                
                                                $successArray[] = 'Row Number ' . $rowNumber . ':Target Data has successfully been uploaded.';

                                            } else {

                                                $errorsArray[] = 'Row Number ' . $rowNumber . ':Product Model is invalid.';

                                            }
                                            
                                        } else {
                                            
                                            $errorsArray[] = 'Row Number ' . $rowNumber . ':Target has already been set for this model.';
                                            
                                        }
                                        
                                    } else {
                                        
                                        $errorsArray[] = 'Row Number ' . $rowNumber . ':Target Volume is not an integer.';
                                        
                                    }

                                }
                                
                            } else {
                                
                                $errorsArray[] = 'System Error:CSM not found.';
                                
                            }
                        }
                        
                        fclose($handle);

                        $tableName = 'target';
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
                            'fsm_vol',
                            'fsm_val',
                            'fsm_vol_sales',
                            'fsm_val_sales',
                            'tm_parent',
                            'tm_employee_id',
                            'tm_name',
                            'tm_vol',
                            'tm_val',
                            'tm_vol_sales',
                            'tm_val_sales',
                            'am_parent',
                            'am_employee_id',
                            'am_name',
                            'am_vol',
                            'am_val',
                            'am_vol_sales',
                            'am_val_sales',
                            'csm_parent',
                            'csm_employee_id',
                            'csm_name',
                            'csm_vol',
                            'csm_val',
                            'csm_vol_sales',
                            'csm_val_sales',
                            'product_name',
                            'product_model_code',
                            'product_model_name',
                            'product_type',
                            'target_date',
                            'created_at',
                            'created_by'
                            ];
                        Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $bulkInsertArray)->execute();
                        #print_r($bulkInsertArray);
                    }
                    
                \Yii::$app->session['errorsArray'] = $errorsArray;
                \Yii::$app->session['successArray'] = $successArray;
                return $this->redirect(['view', 'id' => $model->id]);
                
            } else {
                
                Yii::$app->session->setFlash('error', 'Invalid CSV File.');
                return $this->render('create', [
                    'model' => $model
                ]);
            }

            
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
        
        Target::deleteAll(['batch' => $model->batch]);
        
        $model->status = 'Deleted';
        $model->deleted_by = Yii::$app->user->identity->username;
        $model->deleted_at = new Expression('NOW()');
        $model->save(false);
        
        return $this->redirect(['index']);
    }
    
    public function actionMdelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $model = $this->findModel($value);
        
            Target::deleteAll(['batch' => $model->batch]);

            $model->status = 'Deleted';
            $model->deleted_by = Yii::$app->user->identity->username;
            $model->deleted_at = new Expression('NOW()');
            $model->save(false);
        }

        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = TargetBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
