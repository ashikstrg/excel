<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'trainer'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    
    public function actionTrainer()
    {
        $assessmentCategoryModel = \backend\models\TrainingAssessmentCategory::find()->orderBy(['id' => SORT_DESC])->one();
        $assessmentResultModel = \backend\models\TrainingAssessmentResult::find()
                ->where('category_id=:category_id', [':category_id' => $assessmentCategoryModel->id])
                ->orderBy(['score_percent' => SORT_DESC])
                ->limit(20)
                ->all();
        
        return $this->render('trainer', [
            'assessmentCategoryModel' => $assessmentCategoryModel,
            'assessmentResultModel' => $assessmentResultModel
        ]);
    }

    public function actionIndex()
    {
        if(Yii::$app->session->get('userRole') == 'Trainer') {
            return $this->redirect(['trainer']);
        }
        
        $targetQuery = \backend\models\Target::find();
        $targetQuery->select([
            'SUM(`fsm_vol`) as fsm_vol', 
            'SUM(fsm_vol_sales) AS fsm_vol_sales', 
            'SUM(`fsm_val`) as fsm_val', 
            'SUM(`fsm_val_sales`) as fsm_val_sales',
            'SUM(`tm_vol`) as tm_vol', 
            'SUM(`tm_vol_sales`) as tm_vol_sales', 
            'SUM(`tm_val`) as tm_val', 
            'SUM(`tm_val_sales`) as tm_val_sales', 
            'SUM(`am_vol`) as am_vol', 
            'SUM(`am_vol_sales`) as am_vol_sales', 
            'SUM(`am_val`) as am_val', 
            'SUM(`am_val_sales`) as am_val_sales', 
            'SUM(`csm_vol`) as csm_vol', 
            'SUM(`csm_vol_sales`) as csm_vol_sales', 
            'SUM(`csm_val`) as csm_val', 
            'SUM(`csm_val_sales`) as csm_val_sales', 
            '(SUM(`fsm_vol_sales`)/SUM(fsm_vol))*100 as total_achv_percent',
            '(SUM(`fsm_val_sales`)/SUM(fsm_val))*100 as total_achv_percent_value',
            ]);    
        $targetQuery->andFilterWhere([
            'MONTH(target_date)' => date('m', time()),
            'YEAR(target_date)' => date('Y', time()),
        ]);
        if(Yii::$app->session->get('isFSM')) {
            $targetQuery->andFilterWhere([
                'employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isTM')) {
            $targetQuery->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isAM')) {
            $targetQuery->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isCSM')) {
            $targetQuery->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        }
        $target = $targetQuery->one();
        
        $salesProductTypeQuery = \backend\models\Sales::find();
        $salesProductTypeQuery->select([
            'COUNT(id) AS total',
            'product_type'
        ]);
        $salesProductTypeQuery->andFilterWhere([
            'MONTH(sales_date)' => date('m', time()),
            'YEAR(sales_date)' => date('Y', time()),
        ]);
        if(Yii::$app->session->get('isFSM')) {
            $salesProductTypeQuery->andFilterWhere([
                'employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isTM')) {
            $salesProductTypeQuery->andFilterWhere([
                'tm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isAM')) {
            $salesProductTypeQuery->andFilterWhere([
                'am_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        } else if(Yii::$app->session->get('isCSM')) {
            $salesProductTypeQuery->andFilterWhere([
                'csm_employee_id' => Yii::$app->session->get('employee_id')
            ]);
        }
        $salesProductTypeQuery->groupBy(['product_type']);
        $salesProductType = $salesProductTypeQuery->all();
        
        return $this->render('index', [
            'target' => $target,
            'salesProductType' => $salesProductType
        ]);
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()); 
            foreach($userRole as $key => $value) {
                Yii::$app->session->set('userRole', $userRole[$key]->name);
            }
            
            if(Yii::$app->session->get('userRole') == 'FSM') {
                
                $hrModel = \backend\models\Hr::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date', 'image_web_filename'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                Yii::$app->session->set('isFSM', 1);
                Yii::$app->session->set('isSales', 0);
                Yii::$app->session->set('isAdmin', 0);
                
            } else if (Yii::$app->session->get('userRole') == 'Sales') {
                
                $hrModel = \backend\models\HrSales::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date', 'image_web_filename'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                Yii::$app->session->set('isSales', 1);
                Yii::$app->session->set('isFSM', 0);
                Yii::$app->session->set('isAdmin', 0);
                
            } else if (Yii::$app->session->get('userRole') == 'admin') {
                
                $hrModel = \backend\models\HrManagement::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date', 'image_web_filename'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                
                Yii::$app->session->set('isAdmin', 1);
                Yii::$app->session->set('isSales', 0);
                Yii::$app->session->set('isFSM', 0);
                
            } else if (Yii::$app->session->get('userRole') == 'Trainer') {
                
                $hrModel = \backend\models\HrTrainer::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date', 'image_web_filename'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                
                Yii::$app->session->set('isAdmin', 0);
                Yii::$app->session->set('isSales', 0);
                Yii::$app->session->set('isFSM', 0);
                
            } 
            
            if($hrModel->designation == 'TM') {
                
                Yii::$app->session->set('isTM', 1);
                Yii::$app->session->set('isAM', 0);
                Yii::$app->session->set('isCSM', 0);
                
            } else if($hrModel->designation == 'AM') {
                
                Yii::$app->session->set('isTM', 0);
                Yii::$app->session->set('isAM', 1);
                Yii::$app->session->set('isCSM', 0);
                
            } else if($hrModel->designation == 'CSM') {
                
                Yii::$app->session->set('isTM', 0);
                Yii::$app->session->set('isAM', 0);
                Yii::$app->session->set('isCSM', 1);
                
            }
            
            Yii::$app->session->set('hrId', $hrModel->id);
            Yii::$app->session->set('name', $hrModel->name);
            Yii::$app->session->set('employee_id', $hrModel->employee_id);
            Yii::$app->session->set('designation', $hrModel->designation);
            Yii::$app->session->set('joining_date', $hrModel->joining_date);
            Yii::$app->session->set('image_web_filename', $hrModel->image_web_filename);
                
            return $this->goHome();
            
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
