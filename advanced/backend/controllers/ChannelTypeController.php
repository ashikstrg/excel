<?php

namespace backend\controllers;

use Yii;
use backend\models\ChannelType;
use backend\models\ChannelTypeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ChannelTypeController implements the CRUD actions for ChannelType model.
 */
class ChannelTypeController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all ChannelType models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChannelTypeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChannelType model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ChannelType model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChannelType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Channel Type has successfully been added.');
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
            Yii::$app->session->setFlash('success', 'Channel Type has successfully been updated.');
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

    public function actionMdelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $sql = "DELETE FROM `channel_type` WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();

            Yii::$app->session->setFlash('success', 'List of Channel Type has successfully been deleted.');
        }

        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = ChannelType::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
