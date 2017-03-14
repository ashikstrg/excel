<?php

namespace backend\controllers;

use Yii;
use backend\models\MiInfra;
use backend\models\MiInfraSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class MiInfraController extends Controller
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
        $searchModel = new MiInfraSearch();
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
        $model = new MiInfra();

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
            
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'MI Infra has successfully been added.');            
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'MI Infra has successfully been updated.');   
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
            $sql = "DELETE FROM mi_infra WHERE id = $value";
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
        if (($model = MiInfra::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
