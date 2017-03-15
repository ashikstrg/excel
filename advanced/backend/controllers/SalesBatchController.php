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
use backend\models\Target;
use backend\models\Stock;
use backend\models\Inventory;

// Custom Helpers
use yii\helpers\HtmlPurifier;

class SalesBatchController extends Controller {

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
        $searchModel = new SalesBatchSearch();
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

    public function actionCreate() {
        $model = new SalesBatch();

        $errorsArray = \Yii::$app->session['errorsArray'];
        $successArray = \Yii::$app->session['successArray'];

        $userId = Yii::$app->user->identity->id;
        $username = Yii::$app->user->identity->username;

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');
            $uploadExists = 0;

            if ($model->file) {

                $filePath = 'uploads/files/sales/';
                $model->file_import = $filePath . rand(10, 100) . '-' . str_replace('', '-', $model->file->name);

                $bulkInsertArray = array();
                $random_date = Yii::$app->formatter->asDatetime(date("dmyyhis"), "php:dmYHis");
                $random = $random_date . rand(10, 100) . $userId;
                $now = new Expression('NOW()');
                $today = date('Y-m-d', time());
                $monthYear = explode('-', $today);
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

                    if ($model->save()) {

                        $hrModelOne = Hr::find()
                                ->select(['retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 'retail_area', 'retail_territory',
                                    'id', 'designation', 'employee_id', 'name', 'tm_parent', 'tm_employee_id', 'tm_name', 'am_parent', 'am_employee_id', 'am_name',
                                    'csm_parent', 'csm_employee_id', 'csm_name', 'retail_dms_code'])
                                ->where(['user_id' => $userId])
                                ->one();

                        if ($hrModelOne !== null) {

                            $rowNumber = 0;

                            while (($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                                $rowNumber++;
                                $imeiNumber = HtmlPurifier::process(trim($line[0]));

                                if ($rowNumber == 1) {
                                    continue;
                                }

                                if (strlen($imeiNumber) === 15) {

                                    $salesModelOne = Sales::find()
                                            ->select(['id'])
                                            ->where('imei_no=:imei_no', [':imei_no' => $imeiNumber])
                                            ->one();

                                    if (empty($salesModelOne)) {

                                        $stockModelOne = Stock::find()
                                                ->where('retail_dms_code=:retail_dms_code AND imei_no=:imei_no', [':retail_dms_code' => $hrModelOne->retail_dms_code, ':imei_no' => $imeiNumber])
                                                ->orderBy(['id' => SORT_DESC])
                                                ->one();

                                        if (!empty($stockModelOne)) {

                                            $bulkInsertArray[] = [
                                                'batch' => $model->batch,
                                                'retail_id' => $hrModelOne->retail_id,
                                                'retail_dms_code' => $hrModelOne->retail_dms_code,
                                                'retail_name' => $hrModelOne->retail_name,
                                                'retail_channel_type' => $hrModelOne->retail_channel_type,
                                                'retail_type' => $hrModelOne->retail_type,
                                                'retail_zone' => $hrModelOne->retail_zone,
                                                'retail_area' => $hrModelOne->retail_area,
                                                'retail_territory' => $hrModelOne->retail_territory,
                                                'hr_id' => $hrModelOne->id,
                                                'designation' => $hrModelOne->designation,
                                                'employee_id' => $hrModelOne->employee_id,
                                                'employee_name' => $hrModelOne->name,
                                                'tm_parent' => $hrModelOne->tm_parent,
                                                'tm_employee_id' => $hrModelOne->tm_employee_id,
                                                'tm_name' => $hrModelOne->tm_name,
                                                'am_parent' => $hrModelOne->am_parent,
                                                'am_employee_id' => $hrModelOne->am_employee_id,
                                                'am_name' => $hrModelOne->am_name,
                                                'csm_parent' => $hrModelOne->csm_parent,
                                                'csm_employee_id' => $hrModelOne->csm_employee_id,
                                                'csm_name' => $hrModelOne->csm_name,
                                                'product_id' => $stockModelOne->product_id,
                                                'product_name' => $stockModelOne->product_name,
                                                'product_model_code' => $stockModelOne->product_model_code,
                                                'product_model_name' => $stockModelOne->product_model_name,
                                                'product_color' => $stockModelOne->product_color,
                                                'product_type' => $stockModelOne->product_type,
                                                'imei_no' => $stockModelOne->imei_no,
                                                'price' => $stockModelOne->rrp,
                                                'lifting_price' => $stockModelOne->lifting_price,
                                                'status' => $stockModelOne->status,
                                                'sales_date' => $today,
                                                'created_at' => $now,
                                                'created_by' => $username
                                            ];


                                            $targetModel = Target::find()->where('(employee_id=:employee_id AND product_model_code=:product_model_code) AND (YEAR(target_date)=:target_date_year AND MONTH(target_date)=:target_date_month)', [':employee_id' => $hrModelOne->employee_id, ':product_model_code' => $stockModelOne->product_model_code, ':target_date_year' => $monthYear[0], ':target_date_month' => $monthYear[1]])->one();
                                            $targetUpdateCounter = [
                                                'fsm_vol_sales' => 1, 'fsm_val_sales' => $stockModelOne->rrp,
                                                'tm_vol_sales' => 1, 'tm_val_sales' => $stockModelOne->rrp,
                                                'am_vol_sales' => 1, 'am_val_sales' => $stockModelOne->rrp,
                                                'csm_vol_sales' => 1, 'csm_val_sales' => $stockModelOne->rrp];

                                            if (!empty($targetModel)) {
                                                $targetModel->updateCounters($targetUpdateCounter);
                                            }

                                            $stockModelOne->updated_at = $now;
                                            $stockModelOne->updated_by = $username;
                                            $stockModelOne->validity = Stock::$validityOut;
                                            $stockModelOne->save(false);

                                            $inventoryModelOne = Inventory::find()
                                                ->where('imei_no=:imei_no', [':imei_no' => $stockModelOne->imei_no])
                                                ->one();
                                            $inventoryModelOne->updated_at = $now;
                                            $inventoryModelOne->updated_by = $username;
                                            $inventoryModelOne->stage = Inventory::$stageSold;
                                            $inventoryModelOne->save(false);
                                            
                                            $successArray[] = 'Row Number ' . $rowNumber . ':Sales Data has successfully been uploaded.';
                                            
                                        } else {
                                            
                                            $errorsArray[] = 'Row Number ' . $rowNumber . ':IMEI Number has not been added in the stock yet.';
                                            
                                        }
                                        
                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ':IMEI Number has already been used.';
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
                        'lifting_price',
                        'status',
                        'sales_date',
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

    public function actionDelete($id) {
        $model = $this->findModel($id);

        Sales::deleteAll(['batch' => $model->batch]);

        $model->status = 'Deleted';
        $model->deleted_by = Yii::$app->user->identity->username;
        $model->deleted_at = new Expression('NOW()');
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionMdelete() {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) {
            $model = $this->findModel($value);

            Sales::deleteAll(['batch' => $model->batch]);

            $model->status = 'Deleted';
            $model->deleted_by = Yii::$app->user->identity->username;
            $model->deleted_at = new Expression('NOW()');
            $model->save();
        }

        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = SalesBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
