<?php

namespace backend\controllers;

use Yii;
use backend\models\Sales;
use backend\models\SalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SalesController extends Controller
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
        $searchModel = new SalesSearch();
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
        $model = new Sales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionNational()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->national(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize= 20;

        return $this->render('national', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNational_val()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->national_val(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize= 20;

        return $this->render('national_val', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNational_retail()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->national_retail(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize= 20;

        return $this->render('national_retail', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNational_fsm_value()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->national_fsm_value(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize= 20;

        return $this->render('national_fsm_value', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRetail_model()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->retail_model(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize= 20;

        return $this->render('retail_model', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionRetail_model_value()
    {
        $searchModel = new SalesSearch();
        $dataProvider = $searchModel->retail_model_value(Yii::$app->request->queryParams);
        
        $dataProvider->pagination->pageSize= 20;

        return $this->render('retail_model_value', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Sales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
