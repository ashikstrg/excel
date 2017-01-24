<?php

namespace backend\controllers;

use Yii;
use backend\models\Stock;
use backend\models\StockSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom Models
use backend\models\Inventory;

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
        
        $productModel = ArrayHelper::map(\backend\models\Product::find()
                    ->orderBy(['model_code' => SORT_ASC])->all(), 'model_code', 'model_code');

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
            
            $inventoryModelOne = Inventory::find()
                    ->where('imei_no=:imei_no AND validity=:validity', [':imei_no' => $model->imei_no, ':validity' => Inventory::$validityIn])
                    ->one();
            
            if(!empty($inventoryModelOne)) {
                
                $model->product_id = $inventoryModelOne->product_id;
                $model->product_name = $inventoryModelOne->product_name;
                $model->product_model_name = $inventoryModelOne->product_model_name;
                $model->product_model_code = $inventoryModelOne->product_model_code;
                $model->product_color = $inventoryModelOne->product_color;
                $model->product_type = $inventoryModelOne->product_type;
                $model->lifting_price = $inventoryModelOne->lifting_price;
                $model->rrp = $inventoryModelOne->rrp;
                $model->validity = Stock::$validityIn;
                $model->status = $inventoryModelOne->status;

                $model->submission_date = date('Y-m-d', time());
                $model->created_at = new Expression('NOW()');
                $model->created_by = Yii::$app->user->identity->username;

                $inventoryModelOne->validity = Inventory::$validityOut;
                $inventoryModelOne->stage = Inventory::$stageStock;
                $inventoryModelOne->updated_at = new Expression('NOW()');
                $inventoryModelOne->updated_by = Yii::$app->user->identity->username;
                
                if($inventoryModelOne->update() !== false){
                                        
                    if($model->save()) {
                        
                        Yii::$app->session->setFlash('success', 'The product has successfully been added in the stock.');
                        return $this->redirect(['view', 'id' => $model->id]);
                        
                    } else {
                    
                        \Yii::$app->session->setFlash('error', 'This IMEI Number could not be added due to the server error.');

                    }
                    
                    
                } else {
                    
                    \Yii::$app->session->setFlash('error', 'This IMEI Number could not be added due to the server error related to inventory.');
                    
                }
                
            } else {
                
                \Yii::$app->session->setFlash('error', 'This IMEI Number has not been added in the inventory yet.');
                
            }   

        } 
            
        return $this->render('create', [
            'model' => $model,
            'productModel' => $productModel
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
        if (($model = Stock::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
