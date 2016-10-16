<?php

namespace backend\controllers;

use Yii;
use backend\models\Hr;
use backend\models\HrSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

// For Image
use yii\web\UploadedFile;
use yii\imagine\Image;  
use Imagine\Image\Box; 

// For models
use backend\models\HrDesignation;
use backend\models\HrEmployeeType;
use backend\models\Retail;
use backend\models\HrSales;
use common\models\User;

class HrController extends Controller
{
    public static $employeeTypeId = 3;

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
        $searchModel = new HrSearch();
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

    public static function getDesignationParent($parent) {

        $data = HrSales::find()->where(['designation_id'=> $parent])->select(['employee_id as id', 'CONCAT(employee_id, " - ", name) as name'])->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public function actionFind_manager() 
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {

            $dependent = $_POST['depdrop_parents'];

            $hrDesignationModel = HrDesignation::find()->select('parent')->where(['id' => $dependent[0]])->one();

            if ($hrDesignationModel != null) {
                $parent = $hrDesignationModel->parent;
                $out = self::getDesignationParent($parent); 
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }

        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionCreate()
    {
        $model = new Hr();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $hrDesignation = HrDesignation::find()->select('type')->where(['id' => $model->designation_id])->one();
            $model->designation = $hrDesignation->type;

            $hrEmployeeType = HrEmployeeType::find()->select('type')->where(['id' => self::$employeeTypeId])->one();
            $model->employee_type = $hrEmployeeType->type;

            $hrSalesTM = HrSales::find()->select(['id', 'name', 'parent'])->where(['employee_id' => $model->tm_employee_id])->one();
            $model->tm_parent = $hrSalesTM->id;
            $model->tm_name = $hrSalesTM->name;

            $hrSalesAM = HrSales::find()->select(['id', 'name', 'employee_id', 'parent'])->where(['id' => $hrSalesTM->parent])->one();
            $model->am_parent = $hrSalesAM->id;
            $model->am_employee_id = $hrSalesAM->employee_id;
            $model->am_name = $hrSalesAM->name;

            $hrSalesCSM = HrSales::find()->select(['id', 'name', 'employee_id', 'parent'])->where(['id' => $hrSalesAM->parent])->one();
            $model->csm_parent = $hrSalesCSM->id;
            $model->csm_employee_id = $hrSalesCSM->employee_id;
            $model->csm_name = $hrSalesCSM->name;

            $retail = Retail::find()->select(['dms_code', 'name', 'channel_type', 'retail_type', 'retail_zone', 'retail_area', 'territory'])->where(['id' => $model->retail_id])->one();
            $model->retail_dms_code = $retail->dms_code;
            $model->retail_name = $retail->name;
            $model->retail_channel_type = $retail->channel_type;
            $model->retail_type = $retail->retail_type;
            $model->retail_zone = $retail->retail_zone;
            $model->retail_area = $retail->retail_area;
            $model->retail_territory = $retail->territory;

            $model->created_at = date('Y-m-d H:i:s', time());
            $model->created_by = Yii::$app->user->identity->username;

            $image = UploadedFile::getInstance($model, 'image');

            if (!is_null($image)) {

                $model->image_src_filename = $image->name;
                $ext = end((explode(".", $image->name)));
                // generate a unique file name to prevent duplicate filenames
                $model->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)                       
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/hr/';
                $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;
                $image->saveAs($path);

                Image::thumbnail($path, 160, 160)
                ->resize(new Box(160,160))
                ->save(Yii::$app->params['uploadPath'] . $model->image_web_filename, ['quality' => 70]);
                //unlink($path);

            }
            
            // User Create START
            $randomString = Yii::$app->security->generateRandomString(6);
            
            $user = new User();
            $user->username = $model->employee_id;
            $user->email = $model->email_address_official;
            $user->password_actual = $randomString;
            $user->setPassword($randomString);
            $user->generateAuthKey();
            $user->save(false);

            // Include auth manager
            $auth = Yii::$app->authManager;

            // Assign Role
            $fmsRole = $auth->getRole($model->employee_type);
            $auth->assign($fmsRole, $user->getId());
            // User Create END
            
            $model->user_id = $user->getId();

            if ($model->save()) {                 

                Yii::$app->session->setFlash('success', 'HR has successfully been added.');
                return $this->redirect(['view', 'id' => $model->id]);    

            }  else {

                var_dump ($model->getErrors()); die();

            }            


        } else {

            $hrDesignationModel = ArrayHelper::map(HrDesignation::find()->select(['id', 'type'])->where(['employee_type_id' => self::$employeeTypeId])->all(), 'id', 'type');
            $retailModel = ArrayHelper::map(Retail::find()->select(['id', 'CONCAT(dms_code, " - ", name) as name'])->all(), 'id', 'name');

            return $this->render('create', [
                'model' => $model,
                'hrDesignationModel' => $hrDesignationModel,
                'retailModel' => $retailModel
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $hrDesignation = HrDesignation::find()->select('type')->where(['id' => $model->designation_id])->one();
            $model->designation = $hrDesignation->type;

            $hrEmployeeType = HrEmployeeType::find()->select('type')->where(['id' => self::$employeeTypeId])->one();
            $model->employee_type = $hrEmployeeType->type;

            $hrSalesTM = HrSales::find()->select(['id', 'name', 'parent'])->where(['employee_id' => $model->tm_employee_id])->one();
            $model->tm_parent = $hrSalesTM->id;
            $model->tm_name = $hrSalesTM->name;

            $hrSalesAM = HrSales::find()->select(['id', 'name', 'employee_id', 'parent'])->where(['id' => $hrSalesTM->parent])->one();
            $model->am_parent = $hrSalesAM->id;
            $model->am_employee_id = $hrSalesAM->employee_id;
            $model->am_name = $hrSalesAM->name;

            $hrSalesCSM = HrSales::find()->select(['id', 'name', 'employee_id', 'parent'])->where(['id' => $hrSalesAM->parent])->one();
            $model->csm_parent = $hrSalesCSM->id;
            $model->csm_employee_id = $hrSalesCSM->employee_id;
            $model->csm_name = $hrSalesCSM->name;

            $retail = Retail::find()->select(['dms_code', 'name', 'channel_type', 'retail_type', 'retail_zone', 'retail_area', 'territory'])->where(['id' => $model->retail_id])->one();
            $model->retail_dms_code = $retail->dms_code;
            $model->retail_name = $retail->name;
            $model->retail_channel_type = $retail->channel_type;
            $model->retail_type = $retail->retail_type;
            $model->retail_zone = $retail->retail_zone;
            $model->retail_area = $retail->retail_area;
            $model->retail_territory = $retail->territory;

            $model->updated_at = date('Y-m-d H:i:s', time());
            $model->updated_by = Yii::$app->user->identity->username;

            $image = UploadedFile::getInstance($model, 'image');

            if (!is_null($image)) {

                $model->image_src_filename = $image->name;
                $ext = end((explode(".", $image->name)));
                // generate a unique file name to prevent duplicate filenames
                $model->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)                       
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/hr/';
                $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;
                $image->saveAs($path);

                Image::thumbnail($path, 160, 160)
                ->resize(new Box(160,160))
                ->save(Yii::$app->params['uploadPath'] . $model->image_web_filename, ['quality' => 70]);
                //unlink($path);

            }

            if ($model->save()) { 

                Yii::$app->session->setFlash('success', 'HR has successfully been updated.');
                return $this->redirect(['view', 'id' => $model->id]);    

            }  else {

                var_dump ($model->getErrors()); die();

            }            


        } else {

            $hrDesignationModel = ArrayHelper::map(HrDesignation::find()->select(['id', 'type'])->where(['employee_type_id' => self::$employeeTypeId])->all(), 'id', 'type');
            $retailModel = ArrayHelper::map(Retail::find()->select(['id', 'CONCAT(dms_code, " - ", name) as name'])->all(), 'id', 'name');

            return $this->render('update', [
                'model' => $model,
                'hrDesignationModel' => $hrDesignationModel,
                'retailModel' => $retailModel
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMdelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $sql = "DELETE FROM hr WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

        return $this->redirect(['index']);

    }


    protected function findModel($id)
    {
        if (($model = Hr::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
