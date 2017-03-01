<?php

namespace backend\controllers;

use Yii;
use backend\models\RetailBatch;
use backend\models\RetailBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

// Custom Helpers
use yii\helpers\HtmlPurifier;

// Custom Model
use backend\models\Retail;

class RetailBatchController extends Controller {

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
        $searchModel = new RetailBatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDeleted() {
        $searchModel = new RetailBatchSearch();
        $dataProvider = $searchModel->deleted(Yii::$app->request->queryParams);

        return $this->render('deleted', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id) {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // Upload Retail
    public function actionUpload() {
        $model = new RetailBatch();

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

            $filePath = 'uploads/files/retail/csv/';
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

                    $rowNumber = 0;
                    while (($line = fgetcsv($handle, 1000, ",")) != FALSE) {

                        $rowNumber++;
                        $channelType = HtmlPurifier::process(trim($line[0]));
                        $retailType = trim($line[1]);
                        $dmsCode = HtmlPurifier::process(trim($line[2]));
                        $retailName = HtmlPurifier::process(trim($line[3]));
                        $retailZone = HtmlPurifier::process(trim($line[4]));
                        $retailArea = HtmlPurifier::process(trim($line[5]));
                        $retailTerritory = HtmlPurifier::process(trim($line[6]));
                        $retailLocation = HtmlPurifier::process(trim($line[7]));
                        $division = HtmlPurifier::process(trim($line[8]));
                        $district = HtmlPurifier::process(trim($line[9]));
                        $thana = HtmlPurifier::process(trim($line[10]));
                        $marketName = HtmlPurifier::process(trim($line[11]));
                        $geoTag = HtmlPurifier::process(trim($line[12]));
                        $address = HtmlPurifier::process(trim($line[13]));
                        $contactNo = HtmlPurifier::process(trim($line[14]));
                        $ownerName = HtmlPurifier::process(trim($line[15]));
                        $ownerContactNo = HtmlPurifier::process(trim($line[16]));
                        $ownerEmail = HtmlPurifier::process(trim($line[17]));
                        $storeContactNo = HtmlPurifier::process(trim($line[18]));
                        $storeEmail = HtmlPurifier::process(trim($line[19]));
                        $managerName = HtmlPurifier::process(trim($line[20]));
                        $managerContactNo = HtmlPurifier::process(trim($line[21]));
                        $storeSize = (int) HtmlPurifier::process(trim($line[22]));
                        $storeFacade = (int) HtmlPurifier::process(trim($line[23]));
                        $numberSec = HtmlPurifier::process(trim($line[24]));
                        $numberRsa = HtmlPurifier::process(trim($line[25]));
                        $dayOff = HtmlPurifier::process(trim($line[26]));
                        $connectivityWifi = HtmlPurifier::process(trim($line[27]));

                        if ($rowNumber == 1) {
                            continue;
                        }

                        if (is_int($storeSize) && is_int($storeFacade)) {

                            $channelTypeModel = \backend\models\ChannelType::find()->select(['id'])->where(['type' => $channelType])->one();

                            if ($channelTypeModel !== null) {

                                $channelTypeId = $channelTypeModel->id;

                                $retailTypeModel = \backend\models\RetailType::find()->select(['id'])->where(['type' => $retailType])->one();

                                if ($retailTypeModel !== null) {

                                    $retailTypeId = $retailTypeModel->id;

                                    $retailZoneModel = \backend\models\RetailZone::find()->select(['id'])->where('zone=:zone', [':zone' => $retailZone])->one();

                                    if ($retailZoneModel !== null) {

                                        $retailZoneId = $retailZoneModel->id;

                                        $retailAreaModel = \backend\models\RetailArea::find()->select(['id'])->where('area=:area', [':area' => $retailArea])->one();

                                        if ($retailAreaModel !== null) {

                                            $retailAreaId = $retailAreaModel->id;

                                            $retailLocationModel = \backend\models\RetailLocation::find()->select(['id'])->where('location=:location', [':location' => $retailLocation])->one();

                                            if ($retailLocationModel !== null) {

                                                $retailLocationId = $retailLocationModel->id;

                                                $divisionModel = \backend\models\Divisions::find()->select(['id'])->where('name=:name', [':name' => $division])->one();

                                                if ($divisionModel !== null) {

                                                    $divisionProperty = $divisionModel->id;

                                                    $districtModel = \backend\models\Districts::find()->select(['id'])->where('name=:name', [':name' => $district])->one();

                                                    if ($districtModel !== null) {

                                                        $districtProperty = $districtModel->id;

                                                        $thanaModel = \backend\models\Upazilas::find()->select(['id'])->where('name=:name', [':name' => $thana])->one();

                                                        if ($thanaModel !== null) {

                                                            $thanaProperty = $thanaModel->id;

                                                            $dayOffModel = \backend\models\DayOff::find()->select('name')->where('name=:name', [':name' => $dayOff])->one();

                                                            if ($connectivityWifi === 'Yes' || $connectivityWifi === 'No') {

                                                                if ($dayOffModel !== null) {

                                                                    $retailCount = Retail::find()->where('dms_code=:dms_code', [':dms_code' => $dmsCode])->count();

                                                                    if ($retailCount == 0) {

                                                                        $bulkInsertArray[] = [
                                                                            'batch' => $model->batch,
                                                                            'channel_type' => $channelType,
                                                                            'channelType' => $channelTypeId,
                                                                            'retail_type' => $retailType,
                                                                            'retailType' => $retailTypeId,
                                                                            'status' => 'Active',
                                                                            'dms_code' => $dmsCode,
                                                                            'name' => $retailName,
                                                                            'retail_zone' => $retailZone,
                                                                            'retailZone' => $retailZoneId,
                                                                            'retail_area' => $retailArea,
                                                                            'retailArea' => $retailAreaId,
                                                                            'territory' => $retailTerritory,
                                                                            'retail_location' => $retailLocation,
                                                                            'retailLocation' => $retailLocationId,
                                                                            'division' => $division,
                                                                            'divisionProperty' => $divisionProperty,
                                                                            'district' => $district,
                                                                            'districtProperty' => $districtProperty,
                                                                            'upazila' => $thana,
                                                                            'upazilaProperty' => $thanaProperty,
                                                                            'market_name' => $marketName,
                                                                            'geotag' => $geoTag,
                                                                            'address' => $address,
                                                                            'contact_no' => $contactNo,
                                                                            'owner_name' => $ownerName,
                                                                            'owner_contact_no' => $ownerContactNo,
                                                                            'owner_email' => $ownerEmail,
                                                                            'store_contact_no' => $storeContactNo,
                                                                            'store_email' => $storeEmail,
                                                                            'manager_name' => $managerName,
                                                                            'manager_contact_no' => $managerContactNo,
                                                                            'store_size_sft' => $storeSize,
                                                                            'store_facade_feet' => $storeFacade,
                                                                            'number_sec' => $numberSec,
                                                                            'number_rsa' => $numberRsa,
                                                                            'day_off' => $dayOff,
                                                                            'created_at' => $now,
                                                                            'created_by' => $username
                                                                        ];

                                                                        $successArray[] = 'Row Number ' . $rowNumber . ': Retail Data has successfully been uploaded.';
                                                                        $successCount++;
                                                                    } else {

                                                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': This DMS Code has already been used.';
                                                                    }
                                                                } else {

                                                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This day off is invalid.';
                                                                }
                                                            } else {

                                                                $errorsArray[] = 'Row Number ' . $rowNumber . ': Connectivity (wifi) is invalid.';
                                                            }
                                                        } else {

                                                            $errorsArray[] = 'Row Number ' . $rowNumber . ': This Thana has not been added yet.';
                                                        }
                                                    } else {

                                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': This District has not been added yet.';
                                                    }
                                                } else {

                                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This Division has not been added yet.';
                                                }
                                            } else {

                                                $errorsArray[] = 'Row Number ' . $rowNumber . ': This Retail Location has not been added yet.';
                                            }
                                        } else {

                                            $errorsArray[] = 'Row Number ' . $rowNumber . ': This Retail Area has not been added yet.';
                                        }
                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': This Retail Zone has not been added yet.';
                                    }
                                } else {

                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This Retail Type has not been added yet.';
                                }
                            } else {

                                $errorsArray[] = 'Row Number ' . $rowNumber . ': This Channel Type has not been added yet.';
                            }
                        } else {

                            $errorsArray[] = 'Row Number ' . $rowNumber . ': Store Size (SFT) and Store Facade (Feet) must be an integer number.';
                        }
                    }

                    $model->total_row = $successCount;
                    $model->save(false);
                } else {

                    Yii::$app->session->setFlash('error', 'File is not in a valid format.');
                    return $this->redirect(['create']);
                }

                fclose($handle);

                $tableName = 'retail';
                $columnNameArray = [
                    'batch',
                    'channel_type',
                    'channelType',
                    'retail_type',
                    'retailType',
                    'status',
                    'dms_code',
                    'name',
                    'retail_zone',
                    'retailZone',
                    'retail_area',
                    'retailArea',
                    'territory',
                    'retail_location',
                    'retailLocation',
                    'division',
                    'divisionProperty',
                    'district',
                    'districtProperty',
                    'upazila',
                    'upazilaProperty',
                    'market_name',
                    'geotag',
                    'address',
                    'contact_no',
                    'owner_name',
                    'owner_contact_no',
                    'owner_email',
                    'store_contact_no',
                    'store_email',
                    'manager_name',
                    'manager_contact_no',
                    'store_size_sft',
                    'store_facade_feet',
                    'number_sec',
                    'number_rsa',
                    'day_off',
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
        $model = new RetailBatch();

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

    public function actionDelete($id) {

        $model = $this->findModel($id);

        Retail::deleteAll(['batch' => $model->batch]);

        $model->status = 'Deleted';
        $model->deleted_by = Yii::$app->user->identity->username;
        $model->deleted_at = new Expression('NOW()');
        $model->save(false);

        if (is_writable(getcwd() . '/' . $model->file_import)) {
            unlink(getcwd() . '/' . $model->file_import);
        }

        Yii::$app->session->setFlash('success', 'The file has successfully been deleted.');
        return $this->redirect(['index']);
    }

    public function actionMdelete() {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) {
            $model = $this->findModel($value);

            Retail::deleteAll(['batch' => $model->batch]);

            $model->status = 'Deleted';
            $model->deleted_by = Yii::$app->user->identity->username;
            $model->deleted_at = new Expression('NOW()');
            $model->save();

            if (is_writable(getcwd() . '/' . $model->file_import)) {
                unlink(getcwd() . '/' . $model->file_import);
            }
        }

        Yii::$app->session->setFlash('success', 'The list of selected file has successfully been deleted.');
        return $this->redirect(['index']);
    }

    protected function findModel($id) {
        if (($model = RetailBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
