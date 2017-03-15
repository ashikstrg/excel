<?php

namespace backend\controllers;

use Yii;
use backend\models\Inventory;
use backend\models\InventorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom (Dropdown)
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

// db\Expression
use yii\db\Expression;

class InventoryController extends Controller
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

        $searchModel = new InventorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 100;

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
        $model = new Inventory();
        
        $productModel = ArrayHelper::map(\backend\models\Product::find()
                    ->orderBy(['model_code' => SORT_ASC])->all(), 'model_code', 'model_code');
        $hrId = \Yii::$app->session->get('hrId');

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->batch = time() . $hrId . rand(10, 99);
            
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
            $model->validity = Inventory::$validityIn;
            $model->stage = Inventory::$stageInventory;
            
            $model->created_at = new Expression('NOW()');
            $model->created_by = Yii::$app->user->identity->username;
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'The product has successfully been added in the inventory.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                
                Yii::$app->session->setFlash('error', 'Sorry! Server can not process your request. Please contact with system administrator.');
                return $this->render('create', [
                    'model' => $model,
                    'productModel' => $productModel
                ]);
                
            }

        } else {
            
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
        if (($model = Inventory::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
