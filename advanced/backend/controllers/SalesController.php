<?php

namespace backend\controllers;

use Yii;
use backend\models\Sales;
use backend\models\SalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom Models
use backend\models\Stock;
use backend\models\Hr;

// Custom DB Helper
use yii\db\Expression;

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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $hrModelOne = Hr::find()
                    ->select(['retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 'retail_area', 'retail_territory', 
                        'id', 'designation', 'employee_id', 'name', 'tm_parent', 'tm_employee_id', 'tm_name', 'am_parent', 'am_employee_id', 'am_name', 
                        'csm_parent', 'csm_employee_id', 'csm_name', 'retail_dms_code'])
                    ->where('employee_id=:employee_id', [':employee_id' => \Yii::$app->session->get('employee_id')])
                    ->orderBy(['id' => SORT_DESC])
                    ->one();
            
            if(!empty($hrModelOne)){
                $stockModelOne = Stock::find()
                        ->select(['id', 'product_id', 'product_name', 'product_model_code', 'product_model_name', 'product_color', 'product_type', 'lifting_price', 'rrp', 'status'])
                        ->where('retail_dms_code=:retail_dms_code AND imei_no=:imei_no', [':retail_dms_code' => $hrModelOne->retail_dms_code, ':imei_no' => $model->imei_no])
                        ->orderBy(['id' => SORT_DESC])
                        ->one();
                
                if(!empty($stockModelOne)) {
                    
                    $username = Yii::$app->user->identity->username;
                    $now = new Expression('NOW()');
                    $today = date('Y-m-d', time());
                    $monthYear = explode('-', $today);
                    
                    $model->batch = 0;
                    $model->retail_id = $hrModelOne->retail_id;
                    $model->retail_dms_code = $hrModelOne->retail_dms_code;
                    $model->retail_name = $hrModelOne->retail_name;
                    $model->retail_channel_type = $hrModelOne->retail_channel_type;
                    $model->retail_type = $hrModelOne->retail_type;
                    $model->retail_zone = $hrModelOne->retail_zone;
                    $model->retail_area = $hrModelOne->retail_area;
                    $model->retail_territory = $hrModelOne->retail_territory;
                    $model->hr_id = $hrModelOne->id;
                    $model->designation = $hrModelOne->designation;
                    $model->employee_id = $hrModelOne->employee_id;
                    $model->employee_name = $hrModelOne->name;
                    $model->tm_parent = $hrModelOne->tm_parent;
                    $model->tm_employee_id = $hrModelOne->tm_employee_id;
                    $model->tm_name = $hrModelOne->tm_name;
                    $model->am_parent = $hrModelOne->am_parent;
                    $model->am_employee_id = $hrModelOne->am_employee_id;
                    $model->am_name = $hrModelOne->am_name;
                    $model->csm_parent = $hrModelOne->csm_parent;
                    $model->csm_employee_id = $hrModelOne->csm_employee_id;
                    $model->csm_name = $hrModelOne->csm_name;
                    $model->product_id = $stockModelOne->product_id;
                    $model->product_name = $stockModelOne->product_name;
                    $model->product_model_code = $stockModelOne->product_model_code;
                    $model->product_model_name = $stockModelOne->product_model_name;
                    $model->product_color = $stockModelOne->product_color;
                    $model->product_type = $stockModelOne->product_type;
                    $model->price = $stockModelOne->rrp;
                    $model->lifting_price = $stockModelOne->lifting_price;
                    $model->status = $stockModelOne->status;
                    $model->sales_date = $today;
                    $model->created_at = $now;
                    $model->created_by = $username;
                    
                    if($model->save()) {
                        
                        $targetModel = \backend\models\Target::find()->where('(employee_id=:employee_id AND product_model_code=:product_model_code) AND (YEAR(target_date)=:target_date_year AND MONTH(target_date)=:target_date_month)', 
                            [':employee_id' => $hrModelOne->employee_id, ':product_model_code' => $stockModelOne->product_model_code, ':target_date_year' => $monthYear[0], ':target_date_month' => $monthYear[1]])->one();
                            $targetUpdateCounter = [
                                'fsm_vol_sales' => 1, 'fsm_val_sales' => $stockModelOne->rrp, 
                                'tm_vol_sales' => 1, 'tm_val_sales' => $stockModelOne->rrp,
                                'am_vol_sales' => 1, 'am_val_sales' => $stockModelOne->rrp,
                                'csm_vol_sales' => 1, 'csm_val_sales' => $stockModelOne->rrp];
                            
                            if(!empty($targetModel)) {
                                $targetModel->updateCounters($targetUpdateCounter);
                            }
                        $stockModelOne->delete();
                        Yii::$app->session->setFlash('success', '<b>IMEI Number: ' . $model->imei_no . ' </b>has successfully been added.');
                        return $this->redirect(['view', 'id' => $model->id]);
                        
                    } else {
                        
                        \Yii::$app->session->setFlash('error', 'Inserted data can not be processed due to security issue.');
                        
                    }
                    
                } else {
                    
                    \Yii::$app->session->setFlash('error', 'IMEI number is not valid.');
                    
                }
                
            } else {
                \Yii::$app->session->setFlash('error', 'Logged in user is not valid to perform this operation.');
            }     
            
        } 
        
        return $this->render('create', [
            'model' => $model,
        ]);
        
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
