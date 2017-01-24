<?php

namespace backend\controllers;

use Yii;
use backend\models\InventoryBatch;
use backend\models\InventoryBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

// Custom Helpers
use yii\helpers\HtmlPurifier;

// Custom Model
use backend\models\Product;
use backend\models\Retail;
use backend\models\Inventory;

class InventoryBatchController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $searchModel = new InventoryBatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionUpload() {
        
        $model = new InventoryBatch();

        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];
        $successCount = 0;

        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;

        $model->file = UploadedFile::getInstance($model, 'file');
        $uploadExists = 0;

        if ($model->file) {

            $bulkInsertArray = array();
            $current_date = time();
            $random = $current_date . rand(10, 100) . $userId;
            $now = new Expression('NOW()');
            $today = date('Y-m-d', time());

            $filePath = 'uploads/files/inventory/admin/';
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

                if ($model->validate()) {

                    if (!empty($username)) {

                        $rowNumber = 0;
                        while (($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                            $rowNumber++;
                            $inventoryIMEI = HtmlPurifier::process(trim($line[0]));
                            $inventoryModelCode = HTMLPurifier::process(trim($line[1]));
                            $inventoryColor = HTMLPurifier::process(trim($line[2]));

                            if ($rowNumber == 1) {
                                continue;
                            }

                            if (strlen($inventoryIMEI) == 15) {

                                $inventorySubmission = Inventory::find()
                                        ->select('id')
                                        ->where('imei_no=:imei_no', [':imei_no' => $inventoryIMEI])
                                        ->one();

                                if ($inventorySubmission === null) {

                                    $productModel = Product::find()
                                            ->select(['id', 'name', 'model_code', 'model_name', 'color',
                                                'type', 'rrp', 'lifting_price', 'status'])
                                            ->where('model_code=:model_code AND color=:color', [':model_code' => $inventoryModelCode, ':color' => $inventoryColor])
                                            ->one();

                                    if ($productModel !== null) {

                                        $bulkInsertArray[] = [
                                            'batch' => $model->batch,
                                            'product_id' => $productModel->id,
                                            'product_name' => $productModel->name,
                                            'product_model_code' => $productModel->model_code,
                                            'product_model_name' => $productModel->model_name,
                                            'product_color' => $productModel->color,
                                            'product_type' => $productModel->type,
                                            'rrp' => $productModel->rrp,
                                            'lifting_price' => $productModel->lifting_price,
                                            'status' => $productModel->status,
                                            'validity' => Inventory::$validityIn,
                                            'stage' => Inventory::$stageInventory,
                                            'imei_no' => $inventoryIMEI,
                                            'created_at' => $now,
                                            'created_by' => $username
                                        ];

                                        $successArray[] = 'Row Number ' . $rowNumber . ':Inventory Data has successfully been uploaded.';
                                        $successCount++;
                                        
                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': The <b>Product Code</b> or <b>Color</b> has not been added in the database yet.';
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

                    $model->total_row = count($successArray);
                    $model->save(false);
                }

                fclose($handle);

                $tableName = 'inventory';
                $columnNameArray = [
                    'batch',
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
                    'stage',
                    'imei_no',
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

    public function actionCreate() {
        $model = new InventoryBatch();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id) {
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
        
            Inventory::deleteAll(['batch' => $model->batch]);

            $model->status = 'Deleted';
            $model->deleted_by = Yii::$app->user->identity->username;
            $model->deleted_at = new Expression('NOW()');
            $model->save();
            
            if(is_writable(getcwd() . '/' . $model->file_import)){
                unlink(getcwd() . '/' . $model->file_import); 
            }
        }

        Yii::$app->session->setFlash('success', 'The list of selected files has successfully been deleted.');
        return $this->redirect(['index']);

    }

    public function actionDelete($id) 
    {
        
        $model = $this->findModel($id);
        
        Inventory::deleteAll(['batch' => $model->batch]);
        
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
    
    public function actionDeleted()
    {
        $searchModel = new InventoryBatchSearch();
        $dataProvider = $searchModel->deleted(Yii::$app->request->queryParams);

        return $this->render('deleted', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($id) {
        if (($model = InventoryBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
