<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
// Custom Models
use backend\models\Hr;
use backend\models\Stock;
use backend\models\Sales;
use backend\models\Inventory;
// Access Components
use backend\components\Access;
// Message Components
use backend\components\Message;
// Custom DB Helper
use yii\db\Expression;

class AppbasicController extends Controller {

    public $enableCsrfValidation = false;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'sales_report', 'sales_view', 'stock_report', 'stock_view', 'stock_fetch', 'add_sales', 'inventory_fetch', 'add_stock'],
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

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->employee_id) && !empty($request->employee_id)) {

                $salesModel = \backend\models\Sales::find()
                        ->select(['id', 'imei_no'])
                        ->where('employee_id=:employee_id', [':employee_id' => $request->employee_id])
                        ->orderBy(['id' => SORT_DESC])
                        ->limit(50)
                        ->asArray()
                        ->all();

                if (!empty($salesModel)) {

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

    // Mobile Sales View
    public function actionSales_view() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->imei_no) && !empty($request->imei_no)) {

                $salesModel = \backend\models\Sales::find()
                        ->select(['id', 'imei_no', 'product_name', 'product_model_name', 'product_model_code', 'price', 'sales_date'])
                        ->where('imei_no=:imei_no', [':imei_no' => $request->imei_no])
                        ->asArray()
                        ->one();

                if (!empty($salesModel)) {

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

    // Mobile Stock View
    public function actionStock_view() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->imei_no) && !empty($request->imei_no)) {

                $stockModel = \backend\models\Stock::find()
                        ->select(['id', 'imei_no', 'product_name', 'product_model_name', 'product_model_code', 'lifting_price', 'rrp', 'submission_date'])
                        ->where('imei_no=:imei_no', [':imei_no' => $request->imei_no])
                        ->asArray()
                        ->one();

                if (!empty($stockModel)) {

                    $request = $stockModel;
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

    // Fetch Stock
    public function actionStock_fetch() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = Message::$serverError;

            if ((isset($request->imei_no) && !empty($request->imei_no)) && (isset($request->employee_id) && !empty($request->employee_id))) {

                $salesCount = Sales::find()
                        ->where('imei_no=:imei_no', [':imei_no' => $request->imei_no])
                        ->count();

                if ($salesCount == 0) {

                    $hrModel = Hr::find()
                            ->select(['id', 'employee_id', 'retail_id'])
                            ->where('employee_id=:employee_id', [':employee_id' => $request->employee_id])
                            ->one();

                    if (!empty($hrModel)) {

                        $stockModel = Stock::find()
                                ->select(['id', 'imei_no', 'product_name', 'product_model_name', 'product_model_code', 'product_color', 'lifting_price', 'rrp'])
                                ->where('imei_no=:imei_no AND retail_id=:retail_id AND validity=:validity', [':imei_no' => $request->imei_no, ':retail_id' => $hrModel->retail_id, ':validity' => Stock::$validityIn])
                                ->asArray()
                                ->one();

                        if (!empty($stockModel)) {

                            $request = $stockModel;
                        } else {

                            $request->response = 'Error';
                            $request->message = Message::$imeiNotFoundStock;
                        }
                    } else {

                        $request->response = 'Error';
                        $request->message = Message::$employeeIdNotFound;
                    }
                } else {

                    $request->response = 'Error';
                    $request->message = Message::$imeiSold;
                }
            } else {

                $request->response = 'Error';
                $request->message = Message::$employeeIdNotFound;
            }
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }

        echo json_encode($request);
    }

    // Fetch Inventory
    public function actionInventory_fetch() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = Message::$serverError;

            if ((isset($request->imei_no) && !empty($request->imei_no)) && (isset($request->employee_id) && !empty($request->employee_id))) {

                $stockModel = Stock::find()
                        ->where('imei_no=:imei_no', [':imei_no' => $request->imei_no])
                        ->count();

                if ($stockModel == 0) {

                    $inventoryModel = Inventory::find()
                            ->select(['id', 'imei_no', 'product_name', 'product_model_name', 'product_model_code', 'product_color', 'lifting_price', 'rrp'])
                            ->where('imei_no=:imei_no AND validity=:validity', [':imei_no' => $request->imei_no, ':validity' => Stock::$validityIn])
                            ->asArray()
                            ->one();

                    if (!empty($inventoryModel)) {

                        $request = $inventoryModel;

                    } else {

                        $request->response = 'Error';
                        $request->message = Message::$imeiNotFoundInventory;
                    }
                    
                } else {

                    $request->response = 'Error';
                    $request->message = Message::$imeiAdded;
                }
            } else {

                $request->response = 'Error';
                $request->message = Message::$employeeIdNotFound;
            }
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }

        echo json_encode($request);
    }

    // Add Sales
    public function actionAdd_sales() {

        Access::setPermission();

        $model = new Sales();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = Message::$serverError;

            if ((isset($request->imei_no) && !empty($request->imei_no)) && (isset($request->employee_id) && !empty($request->employee_id))) {

                $imei_no = $request->imei_no;
                $employee_id = $request->employee_id;

                $model->imei_no = $imei_no;

                $hrModelOne = Hr::find()
                        ->select(['retail_id', 'retail_dms_code', 'retail_name', 'retail_channel_type', 'retail_type', 'retail_zone', 'retail_area', 'retail_territory',
                            'id', 'designation', 'employee_id', 'name', 'tm_parent', 'tm_employee_id', 'tm_name', 'am_parent', 'am_employee_id', 'am_name',
                            'csm_parent', 'csm_employee_id', 'csm_name', 'retail_dms_code'])
                        ->where('employee_id=:employee_id', [':employee_id' => $employee_id])
                        ->orderBy(['id' => SORT_DESC])
                        ->one();

                if (!empty($hrModelOne)) {
                    $stockModelOne = Stock::find()
                            ->where('retail_dms_code=:retail_dms_code AND imei_no=:imei_no AND validity=:validity', [':retail_dms_code' => $hrModelOne->retail_dms_code, ':imei_no' => $model->imei_no, ':validity' => Stock::$validityIn])
                            ->one();

                    if (!empty($stockModelOne)) {

                        $username = $employee_id;
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

                        if ($model->save()) {

                            $targetModel = \backend\models\Target::find()->where('(employee_id=:employee_id AND product_model_code=:product_model_code) AND (YEAR(target_date)=:target_date_year AND MONTH(target_date)=:target_date_month)', [':employee_id' => $hrModelOne->employee_id, ':product_model_code' => $stockModelOne->product_model_code, ':target_date_year' => $monthYear[0], ':target_date_month' => $monthYear[1]])->one();
                            $targetUpdateCounter = [
                                'fsm_vol_sales' => 1, 'fsm_val_sales' => $stockModelOne->rrp,
                                'tm_vol_sales' => 1, 'tm_val_sales' => $stockModelOne->rrp,
                                'am_vol_sales' => 1, 'am_val_sales' => $stockModelOne->rrp,
                                'csm_vol_sales' => 1, 'csm_val_sales' => $stockModelOne->rrp];

                            if (!empty($targetModel)) {
                                $targetModel->updateCounters($targetUpdateCounter);
                            }

                            $stockModelOne->updated_at = $now;
                            $stockModelOne->updated_by = $username;
                            $stockModelOne->validity = Stock::$validityOut;
                            $stockModelOne->save();

                            $inventoryModelOne = Inventory::find()
                                    ->where('imei_no=:imei_no', [':imei_no' => $model->imei_no])
                                    ->one();
                            $inventoryModelOne->updated_at = $now;
                            $inventoryModelOne->updated_by = $username;
                            $inventoryModelOne->stage = Inventory::$stageSold;
                            $inventoryModelOne->save();

                            $request->response = 'Success';
                            $request->message = Message::$successMessage;
                        } else {

                            $request->response = 'Error';
                            $request->message = Message::$serverError;
                        }
                    } else {

                        $request->response = 'Error';
                        $request->message = Message::$imeiNotFoundStock;
                    }
                } else {

                    $request->response = 'Error';
                    $request->message = Message::$employeeIdNotFound;
                }
            } else {

                $request->response = 'Error';
                $request->message = Message::$employeeIdNotFound;
            }
        } else {
            $request->response = 'Error';
            $request->message = Message::$unauthorizedAccess;
        }

        echo json_encode($request);
    }

    // Add Stock
    public function actionAdd_stock() {

        Access::setPermission();

        $model = new Stock();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = Message::$serverError;

            if ((isset($request->imei_no) && !empty($request->imei_no)) && (isset($request->employee_id) && !empty($request->employee_id))) {

                $imei_no = $request->imei_no;
                $employee_id = $request->employee_id;

                $model->imei_no = $imei_no;

                $model->batch = 0;

                $hrModelOne = Hr::find()
                        ->select(['retail_id', 'retail_dms_code', 'retail_name', 'retail_type', 'retail_channel_type', 'retail_zone', 'retail_area', 'retail_territory'])
                        ->where('employee_id=:employee_id', [':employee_id' => $employee_id])
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

                if (!empty($inventoryModelOne)) {

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
                    $model->created_by = $employee_id;

                    $inventoryModelOne->validity = Inventory::$validityOut;
                    $inventoryModelOne->stage = Inventory::$stageStock;
                    $inventoryModelOne->updated_at = new Expression('NOW()');
                    $inventoryModelOne->updated_by = $employee_id;

                    if ($inventoryModelOne->update() !== false) {

                        if ($model->save()) {

                            $request->response = 'Success';
                            $request->message = Message::$successMessage;
                            
                        } else {

                            $request->response = 'Error';
                            $request->message = Message::$serverError;
                        }
                        
                    } else {

                        $request->response = 'Error';
                        $request->message = Message::$serverError . ' ' . var_dump($inventoryModelOne->errors);
                    }
                    
                } else {

                    $request->response = 'Error';
                    $request->message = Message::$imeiNotFoundInventory;
                }
                
            } else {
                
                $request->response = 'Error';
                $request->message = Message::$employeeIdNotFound;
                
            }
            
        } else {
            
            $request->response = 'Error';
            $request->message = Message::$unauthorizedAccess;
        }

        echo json_encode($request);
    }

    // Mobile Stock Report
    public function actionStock_report() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->employee_id) && !empty($request->employee_id)) {

                $hrModel = Hr::find()->select('retail_id')->where(['employee_id' => $request->employee_id])->all();
                $stockModel = \backend\models\Stock::find()
                        ->select(['id', 'imei_no'])
                        ->where(['retail_id' => $hrModel])
                        ->orderBy(['id' => SORT_DESC])
                        ->limit(50)
                        ->asArray()
                        ->all();

                if (!empty($stockModel)) {

                    $request = $stockModel;
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

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {


            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->username) && !empty($request->username)) {

                if (isset($request->password) && !empty($request->password)) {

                    $model = new LoginForm();
                    $model->username = $request->username;
                    $model->password = $request->password;

                    if ($model->login()) {

                        $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                        foreach ($userRole as $key => $value) {
                            $request->userRole = $userRole[$key]->name;
                        }

                        if ($request->userRole == 'FSM') {

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
