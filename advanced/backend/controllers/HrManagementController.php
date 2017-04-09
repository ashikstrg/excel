<?php

namespace backend\controllers;

use Yii;
use backend\models\HrManagement;
use backend\models\HrManagementSearch;
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
use common\models\User;

class HrManagementController extends Controller
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
        $searchModel = new HrManagementSearch();
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
        $model = new HrManagement();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->designation_id = 100;
            $model->designation = 'Management';
            $model->employee_type_id = 5;
            $model->employee_type = 'Management';

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

                Yii::$app->session->setFlash('success', 'HR (Management) has successfully been added.');
                return $this->redirect(['view', 'id' => $model->id]);    

            }  else {

                var_dump ($model->getErrors()); die();

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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->designation_id = 100;
            $model->designation = 'Management';
            $model->employee_type_id = 5;
            $model->employee_type = 'Management';

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

                Yii::$app->session->setFlash('success', 'HR (Management) has successfully been updated.');
                return $this->redirect(['view', 'id' => $model->id]);    

            }  else {

                var_dump ($model->getErrors()); die();

            }            


        } else {

            return $this->render('update', [
                'model' => $model
            ]);
        }
    }
    
    public function actionProfile($id)
    {
        return $this->render('profile', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionMdelete()
    {
        $updated_at = date('Y-m-d H:i:s', time());
        $updated_by = Yii::$app->user->identity->username;
        
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $sql = "UPDATE hr_management SET status='Inactive', updated_at='$updated_at', updated_by='$updated_by' WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

        Yii::$app->session->setFlash('success', 'HR (Managemennt) has successfully been Inactive.');
        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = HrManagement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
