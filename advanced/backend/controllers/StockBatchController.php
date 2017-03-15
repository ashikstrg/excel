<?php

namespace backend\controllers;

use Yii;
use backend\models\StockBatch;
use backend\models\StockBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

// Custom Models
use backend\models\Hr;
use backend\models\Stock;
use backend\models\Product;


// Custom Helpers
use yii\helpers\HtmlPurifier;

//Custom Models
use backend\models\Sales;
use backend\models\Inventory;


class StockBatchController extends Controller
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
        $searchModel = new StockBatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDeleted()
    {
        $searchModel = new StockBatchSearch();
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
        $model = new StockBatch();
        
        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        $successCount = 0;
        
        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;

        $model->file = UploadedFile::getInstance($model, 'file');
        $uploadExists = 0;

        if($model->file){

            $bulkInsertArray = array();
            $current_date = time();
            $random = $current_date.rand(10,100).$userId;
            $now = new Expression('NOW()');
            $today = date('Y-m-d', time());
            
            $filePath = 'uploads/files/stock/admin/';
            $model->file_import = $filePath . $random . str_replace($model->file->name, '', $model->file) . '.csv';

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
                $model->stock_date = $today;

                if($model->validate()){

                    $hrModel = Hr::find()
                            ->select(['id', 'retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 
                                'retail_area', 'retail_territory'])
                            ->where('user_id=:user_id AND employee_type=:employee_type', [':user_id' => $userId, ':employee_type' => Hr::$fsmEmployeeType])
                            ->one();

                    if($hrModel !== null) {

                        $rowNumber = 0;
                        while( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                            $rowNumber++;
                            $stockIMEI = HtmlPurifier::process(trim($line[0]));

                            if($rowNumber == 1) {
                                continue;
                            }

                            if (strlen($stockIMEI) == 15) {

                                $stockSubmission = Stock::find()
                                    ->where('imei_no=:imei_no', 
                                            [':imei_no' => $stockIMEI])
                                    ->count();

                                if($stockSubmission == 0) {

                                    $inventoryModel = Inventory::find()
                                        ->where('imei_no=:imei_no AND validity=:validity', 
                                            [':imei_no' => $stockIMEI, ':validity' => Inventory::$validityIn])
                                        ->one();   

                                    if($inventoryModel !== null) {

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
                                            'retail_location' => $hrModel->retail_location,
                                            'product_id' => $inventoryModel->product_id,
                                            'product_name' => $inventoryModel->product_name,
                                            'product_model_code' => $inventoryModel->product_model_code,
                                            'product_model_name' => $inventoryModel->product_model_name,
                                            'product_color' => $inventoryModel->product_color,
                                            'product_type' => $inventoryModel->product_type,
                                            'rrp' => $inventoryModel->rrp,
                                            'lifting_price' => $inventoryModel->lifting_price,
                                            'status' => $inventoryModel->status,
                                            'validity' => Stock::$validityIn,
                                            'imei_no' => $inventoryModel->imei_no,
                                            'submission_date' => $today,
                                            'created_at' => $now,
                                            'created_by' => $username
                                        ];
                                        
                                        $inventoryModel->validity = Inventory::$validityOut;
                                        $inventoryModel->stage = Inventory::$stageStock;
                                        $inventoryModel->save(false);

                                        $successArray[] = 'Row Number ' . $rowNumber . ':Stock Data has successfully been uploaded.';
                                        $successCount++;

                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': This IMEI Number is not added in the inventory yet.';

                                    }

                                } else {

                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This IMEI Number has already been used.';

                                }

                            } else {

                                $errorsArray[] = 'Row Number ' . $rowNumber . ':IMEI number must be 15 characters long.';

                            }

                        }

                    } else {

                        $errorsArray[] = 'System Error: Uploader is not a valid a user.';

                    }

                    $model->total_row = $successCount;
                    $model->save(false);
                }

                fclose($handle);

                $tableName = 'stock';
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
                    'retail_location',
                    'product_id',
                    'product_name',
                    'product_model_code',
                    'product_model_name',
                    'product_color',
                    'product_type',
                    'rrp',
                    'lifting_price',
                    'status',
                    'validity',
                    'imei_no',
                    'submission_date',
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
            
    }

    public function actionCreate()
    {
        $model = new StockBatch();

        return $this->render('create', [
            'model' => $model,
        ]);
        
    }
    
    public function actionUp()
    {
        $model = new StockBatch();
        
        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        $successCount = 0;
        
        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;

        $model->file = UploadedFile::getInstance($model, 'file');
        $uploadExists = 0;

        if($model->file){

            $bulkInsertArray = array();
            $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
            $random = $random_date.rand(10,100).$userId;
            $now = new Expression('NOW()');
            $today = date('Y-m-d', time());
            
            $filePath = 'uploads/files/stock/admin/';
            $model->file_import = $filePath . $random . str_replace($model->file->name, '', $model->file) . '.csv';

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
                    $model->stock_date = $today;

                    if($model->validate()){

                        $rowNumber = 0;
                        while( ($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                            $rowNumber++;      
                            if($rowNumber == 1) {
                                continue;
                            }

                            $stockIMEI = HtmlPurifier::process(trim($line[0]));
                            $retailDMSCode = HtmlPurifier::process(trim($line[1]));

                            if (strlen($stockIMEI) == 15) {

                                $stockSubmission = Stock::find()
                                        ->select('id')
                                        ->where('imei_no=:imei_no', 
                                                [':imei_no' => $stockIMEI])
                                        ->one();

                                if($stockSubmission === null) {

                                    $inventoryModel = Inventory::find()
                                        ->where('imei_no=:imei_no AND validity=:validity', 
                                            [':imei_no' => $stockIMEI, ':validity' => Inventory::$validityIn])
                                        ->one();   

                                    if($inventoryModel !== null) {
                                        
                                        $retailModel = \backend\models\Retail::find()
                                            ->select(['id', 'dms_code', 'name', 'channel_type', 'retail_type', 'retail_zone', 'retail_area', 'territory', 'retail_location'])
                                            ->where('dms_code=:dms_code', 
                                                    [':dms_code' => $retailDMSCode])
                                            ->one();

                                        if($retailModel !== null) {
                                            
                                            $bulkInsertArray[]=[
                                                'batch' => $model->batch,
                                                'retail_id' => $retailModel->id,
                                                'retail_dms_code' => $retailModel->dms_code,
                                                'retail_name' => $retailModel->name,
                                                'retail_channel_type' => $retailModel->channel_type,
                                                'retail_type' => $retailModel->retail_type,
                                                'retail_zone' => $retailModel->retail_zone,
                                                'retail_area' => $retailModel->retail_area,
                                                'retail_territory' => $retailModel->territory,
                                                'retail_location' => $retailModel->retail_location,
                                                'product_id' => $inventoryModel->product_id,
                                                'product_name' => $inventoryModel->product_name,
                                                'product_model_code' => $inventoryModel->product_model_code,
                                                'product_model_name' => $inventoryModel->product_model_name,
                                                'product_color' => $inventoryModel->product_color,
                                                'product_type' => $inventoryModel->product_type,
                                                'rrp' => $inventoryModel->rrp,
                                                'lifting_price' => $inventoryModel->lifting_price,
                                                'status' => $inventoryModel->status,
                                                'validity' => Stock::$validityIn,
                                                'imei_no' => $inventoryModel->imei_no,
                                                'submission_date' => $today,
                                                'created_at' => $now,
                                                'created_by' => $username
                                            ];
                                            
                                            $inventoryModel->validity = Inventory::$validityOut;
                                            $inventoryModel->stage = Inventory::$stageStock;
                                            $inventoryModel->save(false);

                                            $successArray[] = 'Row Number ' . $rowNumber . ': Stock Data has successfully been uploaded.';
                                            $successCount++;
                                            
                                        } else {
                                            
                                            $errorsArray[] = 'Row Number ' . $rowNumber . ': Retail DMS Code is invalid.';
                                            
                                        }

                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': IMEI Number is invalid.';

                                    }

                                } else {

                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This IMEI Number has already been used.';

                                }

                            } else {

                                $errorsArray[] = 'Row Number ' . $rowNumber . ': IMEI number must be 15 characters long.';

                            }

                        }
                        
                        $model->total_row = $successCount;
                        $model->save();

                    }

                    fclose($handle);

                    $tableName = 'stock';
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
                        'retail_location',
                        'product_id',
                        'product_name',
                        'product_model_code',
                        'product_model_name',
                        'product_color',
                        'product_type',
                        'rrp',
                        'lifting_price',
                        'status',
                        'validity',
                        'imei_no',
                        'submission_date',
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
            
    }
    
    public function actionUpre() {
        $model = new StockBatch();

        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        $successCount = 0;

        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;

        $model->file = UploadedFile::getInstance($model, 'file');
        $uploadExists = 0;

        if ($model->file) {

            $bulkInsertArray = array();
            $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
            $random = $random_date . rand(10, 100) . $userId;
            $now = new Expression('NOW()');
            $today = date('Y-m-d', time());

            $filePath = 'uploads/files/stock/admin/';
            $model->file_import = $filePath . $random . str_replace($model->file->name, '', $model->file) . '.csv';

            $uploadExists = 1;
        }

        if ($uploadExists) {

            $model->file->saveAs($model->file_import);

            $handle = fopen($model->file_import, 'r');

            if ($handle) {

                $model->batch = $random;
                $model->status = 'Active';
                $model->created_by = $username;
                $model->created_at = $now;
                $model->stock_date = $today;

                if ($model->validate()) {

                    $rowNumber = 0;
                    while (($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                        $rowNumber++;
                        if ($rowNumber == 1) {
                            continue;
                        }

                        $stockIMEI = HtmlPurifier::process(trim($line[0]));
                        $retailDMSCode = HtmlPurifier::process(trim($line[1]));

                        if (strlen($stockIMEI) == 15) {

                            $stockSubmission = Stock::find()
                                    ->select('id')
                                    ->where('imei_no=:imei_no', [':imei_no' => $stockIMEI])
                                    ->one();

                            if ($stockSubmission !== null) {

                                $inventoryModel = Inventory::find()
                                        ->where('imei_no=:imei_no AND validity=:validity', [':imei_no' => $stockIMEI, ':validity' => Inventory::$validityIn])
                                        ->one();

                                if ($inventoryModel !== null) {

                                    $retailModel = \backend\models\Retail::find()
                                            ->select(['id', 'dms_code', 'name', 'channel_type', 'retail_type', 'retail_zone', 'retail_area', 'territory', 'retail_location'])
                                            ->where('dms_code=:dms_code', [':dms_code' => $retailDMSCode])
                                            ->one();

                                    if ($retailModel !== null) {

                                        $bulkInsertArray[] = [
                                            'batch' => $model->batch,
                                            'retail_id' => $retailModel->id,
                                            'retail_dms_code' => $retailModel->dms_code,
                                            'retail_name' => $retailModel->name,
                                            'retail_channel_type' => $retailModel->channel_type,
                                            'retail_type' => $retailModel->retail_type,
                                            'retail_zone' => $retailModel->retail_zone,
                                            'retail_area' => $retailModel->retail_area,
                                            'retail_territory' => $retailModel->territory,
                                            'retail_location' => $retailModel->retail_location,
                                            'product_id' => $inventoryModel->product_id,
                                            'product_name' => $inventoryModel->product_name,
                                            'product_model_code' => $inventoryModel->product_model_code,
                                            'product_model_name' => $inventoryModel->product_model_name,
                                            'product_color' => $inventoryModel->product_color,
                                            'product_type' => $inventoryModel->product_type,
                                            'rrp' => $inventoryModel->rrp,
                                            'lifting_price' => $inventoryModel->lifting_price,
                                            'status' => $inventoryModel->status,
                                            'validity' => Stock::$validityIn,
                                            'imei_no' => $inventoryModel->imei_no,
                                            'submission_date' => $today,
                                            'created_at' => $now,
                                            'created_by' => $username
                                        ];

                                        $inventoryModel->validity = Inventory::$validityOut;
                                        $inventoryModel->stage = Inventory::$stageStock;
                                        $inventoryModel->save(false);
                                        
                                        $stockSubmission->delete();

                                        $successArray[] = 'Row Number ' . $rowNumber . ': Stock Data has successfully been uploaded.';
                                        $successCount++;
                                        
                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': Retail DMS Code is invalid.';
                                    }
                                } else {

                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': IMEI Number is invalid.';
                                }
                            } else {

                                $errorsArray[] = 'Row Number ' . $rowNumber . ': This IMEI Number has not been added in the stock.';
                            }
                        } else {

                            $errorsArray[] = 'Row Number ' . $rowNumber . ': IMEI number must be 15 characters long.';
                        }
                    }

                    $model->total_row = $successCount;
                    $model->save();
                }

                fclose($handle);

                $tableName = 'stock';
                $columnNameArray = [
                    'batch',
                    'retail_id',
                    'retail_dms_code',
                    'retail_name',
                    'retail_channel_type',
                    'retail_type',
                    'retail_zone',
                    'retail_area',
                    'retail_territory',
                    'retail_location',
                    'product_id',
                    'product_name',
                    'product_model_code',
                    'product_model_name',
                    'product_color',
                    'product_type',
                    'rrp',
                    'lifting_price',
                    'status',
                    'validity',
                    'imei_no',
                    'submission_date',
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
    }

    public function actionMultiple()
    {
        $model = new StockBatch();

        return $this->render('multiple', [
            'model' => $model,
        ]);
        
    }
    
    public function actionReshuffle()
    {
        $model = new StockBatch();

        return $this->render('reshuffle', [
            'model' => $model,
        ]);
        
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
        
            Stock::deleteAll(['batch' => $model->batch]);

            $model->status = 'Deleted';
            $model->deleted_by = Yii::$app->user->identity->username;
            $model->deleted_at = new Expression('NOW()');
            $model->save();
            
            if(is_writable(getcwd() . '/' . $model->file_import)){
                unlink(getcwd() . '/' . $model->file_import); 
            }
        }

        Yii::$app->session->setFlash('success', 'The list of selected file has successfully been deleted.');
        return $this->redirect(['index']);

    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        Stock::deleteAll(['batch' => $model->batch]);
        
        $model->status = 'Deleted';
        $model->deleted_by = Yii::$app->user->identity->username;
        $model->deleted_at = new Expression('NOW()');
        $model->save(false);
        
        if(is_writable(getcwd() . '/' . $model->file_import)){
            unlink(getcwd() . '/' . $model->file_import); 
        }
        
        Yii::$app->session->setFlash('success', 'The file has successfully been deleted.');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = StockBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
