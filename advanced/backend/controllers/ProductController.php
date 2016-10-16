<?php

namespace backend\controllers;

use Yii;
use backend\models\Product;
use backend\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom Helpers
use yii\helpers\ArrayHelper;

// Custom Model
use backend\models\ProductType;
use backend\models\ProductColor;

class ProductController extends Controller
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
        $searchModel = new ProductSearch();
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
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->created_at = date('Y-m-d H:i:s', time());
            $model->created_by = Yii::$app->user->identity->username;

            if($model->save()) {
                Yii::$app->session->setFlash('success', 'New Product has successfully been added.');
                return $this->redirect(['view', 'id' => $model->id]);
            }


        } else {

            $productTypeModel = ArrayHelper::map(ProductType::find()->all(), 'type', 'type');
            $productColorModel = ArrayHelper::map(ProductColor::find()->all(), 'color', 'color');

            return $this->render('create', [
                'model' => $model,
                'productTypeModel' => $productTypeModel,
                'productColorModel' => $productColorModel
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->updated_at = date('Y-m-d H:i:s', time());
            $model->updated_by = Yii::$app->user->identity->username;

            if($model->save()) {
                Yii::$app->session->setFlash('success', 'Product has successfully been updated.');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {

            $productTypeModel = ArrayHelper::map(ProductType::find()->all(), 'type', 'type');
            $productColorModel = ArrayHelper::map(ProductColor::find()->all(), 'color', 'color');

            return $this->render('update', [
                'model' => $model,
                'productTypeModel' => $productTypeModel,
                'productColorModel' => $productColorModel
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
            $sql = "DELETE FROM product WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
