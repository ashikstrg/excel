<?php

namespace backend\controllers;

use Yii;
use backend\models\Target;
use backend\models\TargetSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TargetController extends Controller
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
    
    public function actionTrend_achv_model()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->trend_achv_model(Yii::$app->request->queryParams);

        return $this->render('trend_achv_model', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTrend_achv_model_val()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->trend_achv_model_val(Yii::$app->request->queryParams);

        return $this->render('trend_achv_model_val', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTrend_achievement()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->trend_achievement(Yii::$app->request->queryParams);

        return $this->render('trend_achievement', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionTrend_achievement_value()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->trend_achievement_value(Yii::$app->request->queryParams);

        return $this->render('trend_achievement_value', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLeaderboard()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard(Yii::$app->request->queryParams);

        return $this->render('leaderboard', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLeaderboard_csm() {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard_csm(Yii::$app->request->queryParams);

        return $this->render('leaderboard_csm', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLeaderboard_am() {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard_am(Yii::$app->request->queryParams);

        return $this->render('leaderboard_am', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLeaderboard_tm()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard_tm(Yii::$app->request->queryParams);

        return $this->render('leaderboard_tm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLeaderboard_value_csm() {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard_value_csm(Yii::$app->request->queryParams);

        return $this->render('leaderboard_value_csm', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLeaderboard_value_am() {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard_value_am(Yii::$app->request->queryParams);

        return $this->render('leaderboard_value_am', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLeaderboard_value_tm()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard_value_tm(Yii::$app->request->queryParams);

        return $this->render('leaderboard_value_tm', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAchv()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->achv(Yii::$app->request->queryParams);

        return $this->render('achv', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionAchv_val()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->achv_val(Yii::$app->request->queryParams);

        return $this->render('achv_val', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionLeaderboard_value()
    {
        $searchModel = new TargetSearch();
        $dataProvider = $searchModel->leaderboard_value(Yii::$app->request->queryParams);

        return $this->render('leaderboard_value', [
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
        $model = new Target();

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

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Target::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
