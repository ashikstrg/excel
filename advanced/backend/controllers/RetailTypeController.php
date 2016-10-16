<?php

namespace backend\controllers;

use Yii;
use backend\models\RetailType;
use backend\models\RetailTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom
use yii\helpers\ArrayHelper;
use backend\models\ChannelType;

class RetailTypeController extends Controller
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
        $searchModel = new RetailTypeSearch();
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
        $model = new RetailType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Retail Type has successfully been added.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            $channelTypeModel = ArrayHelper::map(ChannelType::find()->all(), 'id', 'type');
            return $this->render('create', [
                'model' => $model,
                'channelTypeModel' => $channelTypeModel
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Retail Type has successfully been updated.');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $channelTypeModel = ArrayHelper::map(ChannelType::find()->all(), 'id', 'type');
            return $this->render('update', [
                'model' => $model,
                'channelTypeModel' => $channelTypeModel
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
            $sql = "DELETE FROM `retail_type` WHERE `id` = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();

            Yii::$app->session->setFlash('success', 'List of Retail Type has successfully been deleted.');
        }

        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = RetailType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
