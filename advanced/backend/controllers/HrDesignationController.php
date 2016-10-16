<?php

namespace backend\controllers;

use Yii;
use backend\models\HrDesignation;
use backend\models\HrDesignationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom helpers
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

// Custom Models
use backend\models\HrEmployeeType;

class HrDesignationController extends Controller
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
        $searchModel = new HrDesignationSearch();
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
        $model = new HrDesignation();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $hrEmployeeType = HrEmployeeType::find()->select(['type'])->where(['id' => $model->employee_type_id])->one();
            $model->employee_type = $hrEmployeeType->type;
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Designation has successfully been added.');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {

            $hrEmployeeTypeModel = ArrayHelper::map(HrEmployeeType::find()->all(), 'id', 'type');
            $hrDesignationModel = ArrayHelper::map(HrDesignation::find()->all(), 'id', 'type');

            return $this->render('create', [
                'model' => $model,
                'hrEmployeeTypeModel' => $hrEmployeeTypeModel,
                'hrDesignationModel' => $hrDesignationModel
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $hrEmployeeType = HrEmployeeType::find()->select(['type'])->where(['id' => $model->employee_type_id])->one();
            $model->employee_type = $hrEmployeeType->type;

            $hrDesignation = HrDesignation::find()->select(['type'])->where(['id' => $model->parent])->one();
            $model->parent_name = $hrDesignation->type;
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Designation has successfully been updated.');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {

            $hrEmployeeTypeModel = ArrayHelper::map(HrEmployeeType::find()->all(), 'id', 'type');
            $hrDesignationModel = ArrayHelper::map(HrDesignation::find()->all(), 'id', 'type');

            return $this->render('update', [
                'model' => $model,
                'hrEmployeeTypeModel' => $hrEmployeeTypeModel,
                'hrDesignationModel' => $hrDesignationModel
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HrDesignation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return HrDesignation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HrDesignation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
