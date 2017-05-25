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
    
    public function actionDeleted()
    {
        $searchModel = new TargetBatchSearch();
        $dataProvider = $searchModel->deleted(Yii::$app->request->queryParams);

        return $this->render('deleted', [
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
                
                $bulkInsertArray = array();
                $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
                $random = $random_date.rand(10,100).$userId;
                $now = new Expression('NOW()');
                $today = date('Y-m-d', time());
                
                $filePath = 'uploads/files/targets/';
                $model->file_import = $filePath .$random.'.csv';

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
                            
                            $hrModel = Hr::find()
                                    ->select(['id', 'retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 
                                        'retail_area', 'retail_territory', 'designation', 'employee_id', 'name', 'tm_parent', 'tm_employee_id', 
                                        'tm_name', 'am_parent', 'am_employee_id', 'am_name', 'csm_parent', 'csm_employee_id', 'csm_name'])
                                    ->where('status=:status', [':status' => 'Active'])
                                    ->all();
                            
                            $productModel = Product::find()
                                    ->select(['name', 'model_code', 'model_name', 'type', 'rrp'])
                                    ->where('status=:status', [':status' => 'Active'])
                                    ->groupBy(['model_code'])
                                    ->all(); 
                            
                            if($hrModel !== null && $productModel !== null) {
                                
                                $rowNumber = 0;
                                $employeeModelCode[] = array();
                                $rowArray[] = array();
                                $modelCodes = array();
                                $employeeIDs = array();
                                while( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {
                                
                                    $rowNumber++;  
                                    if($rowNumber == 1) {     
                                        $x = 1;
                                        for ($i = 1; $i <= 1000; $i++) {
                                            
                                            if (isset($line[$i]) && !empty($line[$i])) {
                                                $modelCodes[$i] = HtmlPurifier::process(trim($line[$i]));                                            
                                            } else {
                                                break;
                                            }
                                            
                                        } continue;      
                                    }
                                    
                                    $employeeID = HtmlPurifier::process(trim($line[0])); 
                                    foreach($modelCodes as $key => $value) {
                                        $employeeIDs[$key] = $employeeID;
                                        $employeeModelCode[$employeeID][$value] = (int)$line[$key];
                                        $rowArray[$employeeID][$value] = $rowNumber;
                                    }
                                }
                                
                                foreach ($hrModel as $hr) {
                                    
                                    $hrId = $hr->id;
                                    $hrEmployeeID = $hr->employee_id;
                                    $tmParent = $hr->tm_parent;
                                    $amParent = $hr->am_parent;
                                    $csmParent = $hr->csm_parent;
                                    
                                    foreach ($productModel as $product) {
                                        
                                        $productModelCode = $product->model_code;
                                        
                                        if(isset($employeeModelCode[$hrEmployeeID][$productModelCode])) {
                                            
                                            $targetModelEntry = Target::find()
                                                ->where('employee_id=:employee_id AND product_model_code=:product_model_code AND target_date=:target_date', 
                                                        [':employee_id' => $hrEmployeeID, ':product_model_code' => $productModelCode, ':target_date' => $model->target_date])
                                                ->one();
                                            
                                            $targetVolume = $employeeModelCode[$hrEmployeeID][$productModelCode];
                                            $targetValue = $product->rrp * $employeeModelCode[$hrEmployeeID][$productModelCode]; 
                                            
                                            if($targetModelEntry === null) {
                                                
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
                                                    'fsm_vol' => $targetVolume,
                                                    'fsm_val' => $targetValue,
                                                    'fsm_vol_sales' => $sales['fsm_vol'],
                                                    'fsm_val_sales' => $sales['fsm_val'],
                                                    'tm_parent' => $tmParent,
                                                    'tm_employee_id' => $hr->tm_employee_id,
                                                    'tm_name' => $hr->tm_name,
                                                    'tm_vol' => $targetVolume,
                                                    'tm_val' => $targetValue,
                                                    'tm_vol_sales' => $sales['tm_vol'],
                                                    'tm_val_sales' => $sales['tm_val'],
                                                    'am_parent' => $amParent,
                                                    'am_employee_id' => $hr->am_employee_id,
                                                    'am_name' => $hr->am_name,
                                                    'am_vol' => $targetVolume,
                                                    'am_val' => $targetValue,
                                                    'am_vol_sales' => $sales['am_vol'],
                                                    'am_val_sales' => $sales['am_val'],
                                                    'csm_parent' => $csmParent,
                                                    'csm_employee_id' => $hr->csm_employee_id,
                                                    'csm_name' => $hr->csm_name,
                                                    'csm_vol' => $targetVolume,
                                                    'csm_val' => $targetValue,
                                                    'csm_vol_sales' => $sales['csm_vol'],
                                                    'csm_val_sales' => $sales['csm_val'],
                                                    'product_name' => $product->name,
                                                    'product_model_code' => $product->model_code,
                                                    'product_model_name' => $product->model_name,
                                                    'product_type' => $product->type,
                                                    'target_date' => $model->target_date,
                                                    'created_at' => $now,
                                                    'created_by' => $username
                                                ];
                                                
                                                $successArray[] = 'Row Number ' . $rowArray[$hrEmployeeID][$productModelCode] . ' [' . $product->model_code . ']' . ':Target Data has successfully been uploaded.';
                                                
                                            } else {
                                                
                                                $targetModelEntry->fsm_vol = $targetVolume;
                                                $targetModelEntry->fsm_val = $targetValue;
                                                $targetModelEntry->tm_vol = $targetVolume;
                                                $targetModelEntry->tm_val = $targetValue;
                                                $targetModelEntry->am_vol = $targetVolume;
                                                $targetModelEntry->am_val = $targetValue;
                                                $targetModelEntry->csm_vol = $targetVolume;
                                                $targetModelEntry->csm_val = $targetValue;
                                                
                                                if($targetModelEntry->save()) {
                                                    
                                                    $successArray[] = 'Row Number ' . $rowArray[$hrEmployeeID][$productModelCode] . ':Target plan has successfully been updated for this model.';
                                                
                                                    
                                                } else {
                                                    
                                                    $errorsArray[] = 'Row Number ' . $rowArray[$hrEmployeeID][$productModelCode] . ':Target has already been set for this model. Target data could not be updated due to data inconsistency.';
                                                    
                                                }
                                                
                                                
                                                
                                            }
                                            
                                        }
                                        
                                    }
                                    
                                }
        
                            } else {
                                
                                $errorsArray[] = 'Server is down. Please contact with system administrator.';
                                
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
        if(is_writable(getcwd() . '/' . $model->file_import)){
            unlink(getcwd() . '/' . $model->file_import); 
        }
        
        Yii::$app->session->setFlash('success', 'Selected item has successfully been deleted with all raw data.');
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
            
            if(is_writable(getcwd() . '/' . $model->file_import)){
                unlink(getcwd() . '/' . $model->file_import); 
            }
        }

        Yii::$app->session->setFlash('success', 'List of selected items has successfully been deleted with all raw data.');
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
