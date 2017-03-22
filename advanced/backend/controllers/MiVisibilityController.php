<?php

namespace backend\controllers;

use Yii;
use backend\models\MiVisibility;
use backend\models\MiVisibilitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// For Image
use yii\web\UploadedFile;
use yii\imagine\Image;  
use Imagine\Image\Box; 

class MiVisibilityController extends Controller
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
        $searchModel = new MiVisibilitySearch();
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
        $model = new MiVisibility();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->hr_id = Yii::$app->session->get('hrId');
            $model->hr_employee_id = Yii::$app->session->get('employee_id');
            $model->hr_name  = Yii::$app->session->get('name');
            $model->hr_designation = Yii::$app->session->get('designation');
            $model->hr_employee_type = Yii::$app->session->get('userRole');
            
            if(Yii::$app->session->get('isTM')) {
                $hrModel = \backend\models\Hr::find()->select(['am_employee_id', 'am_name', 'csm_employee_id', 'csm_name'])->where(['tm_employee_id' => $model->hr_employee_id])->orderBy(['id' => SORT_DESC])->one();
                $model->am_employee_id = $hrModel->am_employee_id;
                $model->am_name = $hrModel->am_name;
                $model->csm_employee_id = $hrModel->csm_employee_id;
                $model->csm_name = $hrModel->csm_name;
            } else if(\Yii::$app->session->get('isAM')) {
                $hrModel = \backend\models\Hr::find()->select(['csm_employee_id', 'csm_name'])->where(['am_employee_id' => $model->hr_employee_id])->orderBy(['id' => SORT_DESC])->one();
                $model->am_employee_id = $model->hr_employee_id;
                $model->am_name = $model->hr_name;
                $model->csm_employee_id = $hrModel->csm_employee_id;
                $model->csm_name = $hrModel->csm_name;
            } else {
                
                $model->am_employee_id = 'N/A';
                $model->am_name = 'N/A';
                $model->csm_employee_id = 'N/A';
                $model->csm_name = 'N/A';
                
            }
            $model->created_at = date('Y-m-d H:i:s', time());
            
            $image = UploadedFile::getInstance($model, 'image');
            if (!is_null($image)) {

                $model->image_src_filename = $image->name;
                $ext = end((explode(".", $image->name)));
                // generate a unique file name to prevent duplicate filenames
                $model->image_web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                // the path to save file, you can set an uploadPath
                // in Yii::$app->params (as used in example below)                       
                Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/mi/image/';
                $path = Yii::$app->params['uploadPath'] . $model->image_web_filename;
                $image->saveAs($path);

                Image::thumbnail($path, 160, 160)
                ->resize(new Box(160,160))
                ->save(Yii::$app->params['uploadPath'] . $model->image_web_filename, ['quality' => 70]);
                //unlink($path);

            }
            
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'MI Infra & Visibility has successfully been added.');            
                return $this->redirect(['view', 'id' => $model->id]);
            }  else {
                
                return $this->render('create', [
                    'model' => $model,
                ]);
            }      
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = date('Y-m-d H:i:s', time());

        if ($model->load(Yii::$app->request->post())) {
            
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
            
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'MI Infra and Visibility has successfully been updated.');   
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
            
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
            $sql = "DELETE FROM mi_visibility WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

        Yii::$app->session->setFlash('success', 'List of batch data has successfully been deleted.');
        return $this->redirect(['index']);

    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = MiVisibility::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
