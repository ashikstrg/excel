<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Hr;

class AppbasicController extends Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'sales_report'],
                        'allow' => true,
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
    
    // Mobile Sales Report
    public function actionSales_report() {
        
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {
            
            
            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            
            if(isset($request->employee_id) && !empty($request->employee_id)) {
                
                $salesModel = \backend\models\Sales::find()
                        ->select(['id', 'imei_no', 'product_model_name', 'product_model_code', 'price', 'sales_date'])
                        ->where('employee_id=:employee_id', [':employee_id' => $request->employee_id])
                        ->orderBy(['id'=>SORT_DESC])
                        ->limit(20)
                        ->asArray()
                        ->all();
                
                if(!empty($salesModel)) {
                    
                    $request = $salesModel;
                    
                } else {
                
                    $request->response = 'Error';
                    $request->message = 'You have not sold any device yet.';
                
                }
                               
            } else {
                
                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
                
            }
            
            echo json_encode($request);
                        
            
        } else {
            
            $request->response = 'Error';
            $request->message = 'Data not submitted.';
            echo json_encode($request);
            
        }
    }

    // Mobile Login
    public function actionLogin() {
        
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // cache for 1 day
        }

        // Access-Control headers are received during OPTIONS requests
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

            exit(0);
        }

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {
            
            
            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            
            if(isset($request->username) && !empty($request->username)) {
                
                if(isset($request->password) && !empty($request->password)) {
                    
                    $model = new LoginForm();
                    $model->username = $request->username;
                    $model->password = $request->password;

                    if($model->login()) {
                        
                        $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId()); 
                        foreach($userRole as $key => $value) {
                            $request->userRole = $userRole[$key]->name;
                        }

                        if($request->userRole == 'FSM') {
                            
                            $hrModel = Hr::find()->select(['id', 'name', 'employee_id', 'designation', 'joining_date', 'image_web_filename'])->where(['user_id' => Yii::$app->user->identity->id])->one();
                            $request->hrId = $hrModel->id;
                            $request->name = $hrModel->name;
                            $request->employee_id = $hrModel->employee_id;
                            $request->designation = $hrModel->designation;
                            $request->joining_date = $hrModel->joining_date;
                            $request->image_web_filename = $hrModel->image_web_filename;
                            
                            $request->response = 'Success';
                            $request->message = 'Loging in ...';
                                 
                        } else {
                            
                            $request->response = 'Error';
                            $request->message = 'Please enter a valid login credential.';
                            
                        }

                        
                                                
                    } else {

                        $request->response = 'Error';
                        $request->message = 'Username/Password incorrect.';

                    }
                    
                } else {
                    
                    $request->response = 'Error';
                    $request->message = 'Password can not be blank.';
                    
                }
                               
            } else {
                
                $request->response = 'Error';
                $request->message = 'Username can not be blank.';
                
            }
            
            echo json_encode($request);
                        
            
        } else {
            
            $request->response = 'Error';
            $request->message = 'Data not submitted.';
            echo json_encode($request);
            
        }
    }

}
