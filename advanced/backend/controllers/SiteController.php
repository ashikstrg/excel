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
                        'actions' => ['logout', 'index'],
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

    public function actionIndex()
    {
        return $this->render('index');
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
                
                $hrModel = \backend\models\Hr::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                Yii::$app->session->set('isFSM', 1);
                Yii::$app->session->set('isSales', 0);
                Yii::$app->session->set('isAdmin', 0);
                
            } else if (Yii::$app->session->get('userRole') == 'Sales') {
                
                $hrModel = \backend\models\HrSales::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                Yii::$app->session->set('isSales', 1);
                Yii::$app->session->set('isFSM', 0);
                Yii::$app->session->set('isAdmin', 0);
                
            } else if (Yii::$app->session->get('userRole') == 'admin') {
                
                $hrModel = \backend\models\HrManagement::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                Yii::$app->session->set('isAdmin', 1);
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
                
            return $this->goBack();
            
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
