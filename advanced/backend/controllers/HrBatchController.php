<?php

namespace backend\controllers;

use Yii;
use backend\models\HrBatch;
use backend\models\HrBatchSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom for file upload
use yii\db\Expression;
use yii\web\UploadedFile;

// Custom Helpers
use yii\helpers\HtmlPurifier;

// Custom Model
use backend\models\Hr;
use backend\models\HrSales;
use common\models\User;

class HrBatchController extends Controller
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
        $searchModel = new HrBatchSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionDeleted()
    {
        $searchModel = new HrBatchSearch();
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
    
    // Upload HR (FSM)
    public function actionUpload() {
        
        $model = new HrBatch();

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

            $filePath = 'uploads/files/hr/csv/fsm/';
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
                        $dmsCode = HtmlPurifier::process(trim($line[0]));
                        $designation = HtmlPurifier::process(trim($line[1]));
                        $employeeId = HtmlPurifier::process(trim($line[2]));
                        $tmEmployeeId = HtmlPurifier::process(trim($line[3]));
                        $name = HtmlPurifier::process(trim($line[4]));
                        $joiningDate = HtmlPurifier::process(trim($line[5]));
                        $contactNoOfficial = HtmlPurifier::process(trim($line[6]));
                        $contactNoPersonal = HtmlPurifier::process(trim($line[7]));
                        $nameEmergencyContactPerson = HtmlPurifier::process(trim($line[8]));
                        $relationEmergencyContactPerson = HtmlPurifier::process(trim($line[9]));
                        $contactNoEmergency = HtmlPurifier::process(trim($line[10]));
                        $emailAddress = HtmlPurifier::process(trim($line[11]));
                        $emailAddressOfficial = HtmlPurifier::process(trim($line[12]));
                        $bankName = HtmlPurifier::process(trim($line[13]));
                        $bankAcName = HtmlPurifier::process(trim($line[14]));
                        $bankAcNo = HtmlPurifier::process(trim($line[15]));
                        $bkashNo = HtmlPurifier::process(trim($line[16]));
                        $bloodGroup = HtmlPurifier::process(trim($line[17]));
                        $graduationStatus = HtmlPurifier::process(trim($line[18]));
                        $educationalQualification = HtmlPurifier::process(trim($line[19]));
                        $educationalInstitute = HtmlPurifier::process(trim($line[20]));
                        $educationalQualification2nd = HtmlPurifier::process(trim($line[21]));
                        $educationalInstitute2nd = HtmlPurifier::process(trim($line[22]));
                        $previousExperience = (int) HtmlPurifier::process(trim($line[23]));
                        $previousExperience2nd = (int) HtmlPurifier::process(trim($line[24]));
                        $permanentAddress = HtmlPurifier::process(trim($line[25]));
                        $presentAddress = HtmlPurifier::process(trim($line[26]));

                        if ($rowNumber == 1) {
                            continue;
                        }

                        if (is_int($previousExperience) && is_int($previousExperience2nd)) {

                            $designationModel = \backend\models\HrDesignation::find()
                                    ->select(['id', 'type', 'employee_type_id', 'employee_type'])
                                    ->where('type=:type', [':type' => $designation])
                                    ->one();

                            if ($designationModel !== null) {

                                $designationId = $designationModel->id;
                                $designation = $designationModel->type;
                                $employeeTypeId = $designationModel->employee_type_id;
                                $employeeType = $designationModel->employee_type;

                                $retailModel = \backend\models\Retail::find()
                                        ->select(['id', 'dms_code', 'name', 'channel_type', 'retail_type', 'retail_zone', 'retail_area', 'territory', 'retail_location'])
                                        ->where('dms_code=:dms_code', [':dms_code' => $dmsCode])
                                        ->one();

                                if ($retailModel !== null) {

                                    $retailId = $retailModel->id;
                                    $retailDmsCode = $retailModel->dms_code;
                                    $retailName = $retailModel->name;
                                    $retailChannelType = $retailModel->channel_type;
                                    $retailType = $retailModel->retail_type;
                                    $retailZone = $retailModel->retail_zone;
                                    $retailArea = $retailModel->retail_area;
                                    $retailTerritory = $retailModel->territory;
                                    $retailLocation = $retailModel->retail_location;

                                    $hrSalesTmModel = HrSales::find()
                                        ->select(['id', 'employee_id', 'name', 'manager_id'])
                                        ->where('employee_id=:employee_id', [':employee_id' => $tmEmployeeId])
                                        ->one();
                                    
                                    if ($hrSalesTmModel !== null) {

                                        $hrTmParent = $hrSalesTmModel->id;
                                        $hrTmEmployeeId = $hrSalesTmModel->employee_id;
                                        $hrTmName = $hrSalesTmModel->name;
                                        
                                        $hrSalesAmModel = HrSales::find()
                                            ->select(['id', 'employee_id', 'name', 'manager_id'])
                                            ->where('employee_id=:employee_id', [':employee_id' => $hrSalesTmModel->manager_id])
                                            ->one();

                                        if ($hrSalesAmModel !== null) {

                                            $hrAmParent = $hrSalesAmModel->id;
                                            $hrAmEmployeeId = $hrSalesAmModel->employee_id;
                                            $hrAmName = $hrSalesAmModel->name;
                                            
                                            $hrSalesCsmModel = HrSales::find()
                                                ->select(['id', 'employee_id', 'name', 'manager_id'])
                                                ->where('employee_id=:employee_id', [':employee_id' => $hrSalesAmModel->manager_id])
                                                ->one();
                                           
                                            if ($hrSalesCsmModel !== null) {

                                                $hrCsmParent = $hrSalesCsmModel->id;
                                                $hrCsmEmployeeId = $hrSalesCsmModel->employee_id;
                                                $hrCsmName = $hrSalesCsmModel->name;

                                                if ($graduationStatus === 'Graduated' || $graduationStatus === 'Pursuing') {
                                                    
                                                    $bloodGroupModel = \backend\models\BloodGroup::find()->select(['name'])->where('name=:name', [':name' => $bloodGroup])->one();

                                                    if ($bloodGroupModel !== null) {

                                                        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $joiningDate)) {
                                                            
                                                            if (filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {

                                                                $userModel = User::find()->select(['id'])->where('email=:email', [':email' => $emailAddressOfficial])->one();
                                                                
                                                                if (filter_var($emailAddressOfficial, FILTER_VALIDATE_EMAIL) && $userModel === null) {

                                                                    $hrCount = Hr::find()->where('employee_id=:employee_id', [':employee_id' => $employeeId])->count();

                                                                    if ($hrCount == 0) {
                                                                        
                                                                        // User Create START
                                                                        $randomString = Yii::$app->security->generateRandomString(6);

                                                                        $user = new User();
                                                                        $user->username = $employeeId;
                                                                        $user->email = $emailAddressOfficial;
                                                                        $user->password_actual = $randomString;
                                                                        $user->setPassword($randomString);
                                                                        $user->generateAuthKey();
                                                                        $user->save(false);

                                                                        // Include auth manager
                                                                        $auth = Yii::$app->authManager;

                                                                        // Assign Role
                                                                        $fmsRole = $auth->getRole($employeeType);
                                                                        $auth->assign($fmsRole, $user->getId());
                                                                        // User Create END

                                                                        $bulkInsertArray[] = [
                                                                            'batch' => $model->batch,
                                                                            'retail_id' => $retailId,
                                                                            'retail_dms_code' => $retailDmsCode,
                                                                            'retail_name' => $retailName,
                                                                            'retail_channel_type' => $retailChannelType,
                                                                            'retail_type' => $retailType,
                                                                            'retail_zone' => $retailZone,
                                                                            'retail_area' => $retailArea,
                                                                            'retail_territory' => $retailTerritory,
                                                                            'retail_location' => $retailLocation,
                                                                            'designation_id' => $designationId,
                                                                            'designation' => $designation,
                                                                            'employee_type_id' => $employeeTypeId,
                                                                            'employee_type' => $employeeType,
                                                                            'employee_id' => $employeeId,
                                                                            'tm_parent' => $hrTmParent,
                                                                            'tm_employee_id' => $hrTmEmployeeId,
                                                                            'tm_name' => $hrTmName,
                                                                            'am_parent' => $hrAmParent,
                                                                            'am_employee_id' => $hrAmEmployeeId,
                                                                            'am_name' => $hrAmName,
                                                                            'csm_parent' => $hrCsmParent,
                                                                            'csm_employee_id' => $hrCsmEmployeeId,
                                                                            'csm_name' => $hrCsmName,
                                                                            'name' => $name,
                                                                            'status' => 'Active',
                                                                            'joining_date' => $joiningDate,
                                                                            'contact_no_official' => $contactNoOfficial,
                                                                            'contact_no_personal' => $contactNoPersonal,
                                                                            'name_immergency_contact_person' => $nameEmergencyContactPerson,
                                                                            'relation_immergency_contact_person' => $relationEmergencyContactPerson,
                                                                            'contact_no_immergency' => $contactNoEmergency,
                                                                            'email_address' => $emailAddress,
                                                                            'email_address_official' => $emailAddressOfficial,
                                                                            'bank_name' => $bankName,
                                                                            'bank_ac_name' => $bankAcName,
                                                                            'bank_ac_no' => $bankAcNo,
                                                                            'bkash_no' => $bkashNo,
                                                                            'blood_group' => $bloodGroup,
                                                                            'graduation_status' => $graduationStatus,
                                                                            'educational_qualification' => $educationalQualification,
                                                                            'educational_institute' => $educationalInstitute,
                                                                            'educational_qualification_second_last' => $educationalQualification2nd,
                                                                            'educational_institute_second_last' => $educationalInstitute2nd,
                                                                            'previous_experience' => $previousExperience,
                                                                            'previous_experience_two' => $previousExperience2nd,
                                                                            'permanent_address' => $permanentAddress,
                                                                            'present_address' => $presentAddress,
                                                                            'created_at' => $now,
                                                                            'created_by' => $username,
                                                                            'user_id' => $user->getId()
                                                                        ];

                                                                        $successArray[] = 'Row Number ' . $rowNumber . ': Retail Data has successfully been uploaded.';
                                                                        $successCount++;
                                                                    } else {

                                                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': This Employee ID has already been used.';
                                                                    }
                                                                } else {

                                                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This Enail Address (official) is invalid.';
                                                                }
                                                            } else {

                                                                $errorsArray[] = 'Row Number ' . $rowNumber . ': This Email Address (Personal) is invalid.';
                                                            }
                                                        } else {

                                                            $errorsArray[] = 'Row Number ' . $rowNumber . ': This date is not in a valid format.';
                                                        }
                                                    } else {

                                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': This blood group is not in a valid format.';
                                                    }
                                                } else {

                                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This graduation status is not valid.';
                                                }
                                            } else {

                                                $errorsArray[] = 'Row Number ' . $rowNumber . ': This Retail Location has not been added yet.';
                                            }
                                        } else {

                                            $errorsArray[] = 'Row Number ' . $rowNumber . ': The AM of this TM has not been added yet.';
                                        }
                                    } else {

                                        $errorsArray[] = 'Row Number ' . $rowNumber . ': This TM Employee ID has not been added yet.';
                                    }
                                } else {

                                    $errorsArray[] = 'Row Number ' . $rowNumber . ': This Retail DMS Code has not been added yet.';
                                }
                            } else {

                                $errorsArray[] = 'Row Number ' . $rowNumber . ': This Designation has not been added yet.';
                            }
                        } else {

                            $errorsArray[] = 'Row Number ' . $rowNumber . ': Previous Experience and Previous Experience Second Last must be an integer number.';
                        }
                    }

                    $model->total_row = $successCount;
                    $model->save(false);
                    
                } else {

                    Yii::$app->session->setFlash('error', 'File is not in a valid format.');
                    return $this->redirect(['create']);
                }

                fclose($handle);

                $tableName = 'hr';
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
                    'designation_id',
                    'designation',
                    'employee_type_id',
                    'employee_type',
                    'employee_id',
                    'tm_parent',
                    'tm_employee_id',
                    'tm_name',
                    'am_parent',
                    'am_employee_id',
                    'am_name',
                    'csm_parent',
                    'csm_employee_id',
                    'csm_name',
                    'name',
                    'status',
                    'joining_date',
                    'contact_no_official',
                    'contact_no_personal',
                    'name_immergency_contact_person',
                    'relation_immergency_contact_person',
                    'contact_no_immergency',
                    'email_address',
                    'email_address_official',
                    'bank_name',
                    'bank_ac_name',
                    'bank_ac_no',
                    'bkash_no',
                    'blood_group',
                    'graduation_status',
                    'educational_qualification',
                    'educational_institute',
                    'educational_qualification_second_last',
                    'educational_institute_second_last',
                    'previous_experience',
                    'previous_experience_two',
                    'permanent_address',
                    'present_address',
                    'created_at',
                    'created_by',
                    'user_id'
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
        $model = new HrBatch();

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

    public function actionDelete($id) {

        $model = $this->findModel($id);

        Hr::deleteAll(['batch' => $model->batch]);

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

            Hr::deleteAll(['batch' => $model->batch]);

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

    protected function findModel($id)
    {
        if (($model = HrBatch::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
