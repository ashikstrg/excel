<?php

namespace backend\controllers;

use Yii;
use backend\models\Stock;
use backend\models\StockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom (Dropdown)
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

// db\Expression
use yii\db\Expression;

class StockController extends Controller
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
    
    public function actionDaily() 
    {
        $searchModel = new StockSearch();
        $dataProvider = $searchModel->searchDaily(Yii::$app->request->queryParams);

        return $this->render('daily', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new StockSearch();
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
    
    public static function getColor($parent) {

        $data = \backend\models\Product::find()
                ->where(['model_code'=> $parent])->select(['color as id', 'color as name'])->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }
    
    public function actionFind_color() 
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $product_model_code = $parents[0];
                $out = self::getColor($product_model_code); 
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }

        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionCreate()
    {
        $model = new Stock();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->batch = 0;
            
            $hrModelOne = \backend\models\Hr::find()
                    ->select(['retail_id', 'retail_dms_code', 'retail_name', 'retail_type', 'retail_channel_type', 'retail_zone', 'retail_area', 'retail_territory'])
                    ->where('employee_id=:employee_id', [':employee_id' => Yii::$app->session->get('employee_id')])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();
            $model->retail_id = $hrModelOne->retail_id;
            $model->retail_dms_code = $hrModelOne->retail_dms_code;
            $model->retail_name = $hrModelOne->retail_name;
            $model->retail_type = $hrModelOne->retail_type;
            $model->retail_channel_type = $hrModelOne->retail_channel_type;
            $model->retail_zone = $hrModelOne->retail_zone;
            $model->retail_area = $hrModelOne->retail_area;
            $model->retail_territory = $hrModelOne->retail_territory;
            
            $productModelOne = \backend\models\Product::find()
                    ->select(['id', 'name', 'model_name', 'type', 'lifting_price', 'rrp', 'status'])
                    ->where('model_code=:model_code AND color=:color', [':model_code' => $model->product_model_code, ':color' => $model->product_color])
                    ->one();
            $model->product_id = $productModelOne->id;
            $model->product_name = $productModelOne->name;
            $model->product_model_name = $productModelOne->model_name;
            $model->product_type = $productModelOne->type;
            $model->lifting_price = $productModelOne->lifting_price;
            $model->rrp = $productModelOne->rrp;
            $model->status = $productModelOne->status;
            
            $model->submission_date = date('Y-m-d', time());
            $model->created_at = new Expression('NOW()');
            $model->created_by = Yii::$app->user->identity->username;
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'The product has successfully been added in the stock.');
                return $this->redirect(['view', 'id' => $model->id]);
            }

        } else {
            
            $productModel = ArrayHelper::map(\backend\models\Product::find()
                    ->orderBy(['model_code' => SORT_ASC])->all(), 'model_code', 'model_code');
            
            return $this->render('create', [
                'model' => $model,
                'productModel' => $productModel
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
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
