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
use backend\models\AttendanceChecklist;
// Access Components
use backend\components\Access;
// Message Components
use backend\components\Message;
// Custom DB Helper
use yii\db\Expression;
// Helper
use yii\helpers\Url;

class AppbasicController extends Controller {

    public $enableCsrfValidation = false;
    public static $paramsUrl = 'http://45.64.135.139/~excelsts/advanced/backend/web';

    public function behaviors() {
        
        // Rules
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'sales_report', 'sales_view', 'stock_report', 'stock_view', 'stock_fetch', 'add_sales', 'inventory_fetch', 
                            'add_stock', 'attendance_fetch', 'add_attendance', 'add_attendance_out', 'leaderboard', 'leaderboard_val', 'target', 
                            'target_val', 'target_total', 'target_total_val', 'training', 'complain_fetch', 'complain_add', 'complain_view', 
                            'notification_fetch', 'notification_count', 'notification_view'],
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
    
    // Mobile Notification Count
    public function actionNotification_count() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->total = 0;

            if (isset($request->employee_id) && !empty($request->employee_id)) {
                
                $employeeId = $request->employee_id;

                $notificationCount = \backend\models\Notification::find()->where(
                                'hr_employee_id=:hr_employee_id AND read_status=:read_status', 
                        [':hr_employee_id' => $employeeId, ':read_status' => 'Unread'])
                        ->count();

                if ($notificationCount > 0) {

                    if($notificationCount > 5) {
                        
                        $request->total = '5+';
                        
                    } else {
                        $request->total = $notificationCount;
                    }
                    
                } else {

                    $request->total = 0;
                }
            } else {

                $request->total = 0;
            }

        } else {

            $request->total = 0;
        }
        
        echo json_encode($request);
    }
    
    // Mobile Notification Fetch
    public function actionNotification_fetch() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->employee_id) && !empty($request->employee_id)) {
                
                $employeeId = $request->employee_id;

                $notificationModel = \backend\models\Notification::find()->where(
                                'hr_employee_id=:hr_employee_id AND read_status=:read_status', 
                        [':hr_employee_id' => $employeeId, ':read_status' => 'Unread'])
                        ->limit(5)
                        ->orderBy(['id' => SORT_DESC])
                        ->asArray()
                        ->all();

                if (!empty($notificationModel)) {

                    $request = $notificationModel;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'You have no notification.';
                }
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }

        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
    }
    
    // Mobile Notification Fetch
    public function actionNotification_view() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->ntid) && !empty($request->ntid)) {
                
                $ntId = $request->ntid;

                $notificationModel = \backend\models\Notification::find()->where(
                                'id=:id AND read_status=:read_status', 
                        [':id' => $ntId, ':read_status' => 'Unread'])
                        ->one();

                if (!empty($notificationModel)) {
                    
                    $notificationModel->read_status = 'Read';
                    $notificationModel->seen = new Expression('NOW()');
                    $notificationModel->save(false);
                    
                    $request->response = 'Success';
                    $request->name = $notificationModel->name;
                    $request->message = $notificationModel->message;
                    $request->module_name = $notificationModel->module_name;
                    $request->created_at = date('d-m-Y g:i a', strtotime($notificationModel->created_at));
                    $request->created_by_name = $notificationModel->created_by_name;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'This notification is no more valid.';
                }
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }

        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
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
    
    // Mobile Complain Box Method
    public function actionComplain_fetch() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->employee_id) && !empty($request->employee_id)) {

                $complainboxModel = \backend\models\Complainbox::find()
                        ->select(['id', 'token_no'])
                        ->where('hr_employee_id=:hr_employee_id', [':hr_employee_id' => $request->employee_id])
                        ->orderBy(['id' => SORT_DESC])
                        ->limit(20)
                        ->asArray()
                        ->all();

                if (!empty($complainboxModel)) {

                    $request = $complainboxModel;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'You have not submitted any complain yet.';
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
    
    // Mobile Complain Box Method
    public function actionComplain_add() {

        Access::setPermission();
        
        $model = new \backend\models\Complainbox();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->employee_id) && !empty($request->employee_id)) {
                
                if(isset($request->complain) && !empty($request->complain)) {
                    
                    $employeeId = $request->employee_id;
                    
                    $hrModel = Hr::find()
                            ->select(['id', 'retail_dms_code', 'retail_name', 'name', 'image_web_filename'])
                            ->where('employee_id=:employee_id', [':employee_id' => $employeeId])
                            ->one();
                    
                    if(!empty($hrModel)) {
                        
                        $current_date = time();
                        $random = $current_date . rand(10, 99) . $hrModel->id;
                        $now = new Expression('NOW()');

                        $model->token_no = $random;
                        $model->complain = $request->complain;
                        $model->hr_employee_id = $employeeId;
                        $model->hr_name = $hrModel->name;
                        $model->retail_dms_code = $hrModel->retail_dms_code;
                        $model->retail_name = $hrModel->retail_name;
                        $model->status = 'Pending';
                        $model->complain_date = $now;

                        if ($model->save()) {
                            
                            $hrManagementModel = \backend\models\HrManagement::find()
                                    ->select(['id', 'name', 'employee_id', 'employee_type'])
                                    ->where('designation=:designation', [':designation' => 'Admin'])
                                    ->all();
                            
                            if (!empty($hrManagementModel)) {

                                foreach ($hrManagementModel as $hrManagement) {

                                    $bulkInsertArray[] = [
                                        
                                        'batch' => $model->token_no,
                                        'name' => 'Complain Box',
                                        'module_name' => 'Complain',
                                        'url' => '/complainbox/notification_view?id=' . $model->id,
                                        'hr_id' => $hrManagement->id,
                                        'hr_employee_id' => $hrManagement->employee_id,
                                        'hr_designation' => 'Admin',
                                        'hr_employee_type' => 'Admin',
                                        'hr_name' => $hrManagement->name,
                                        'message' => $model->complain,
                                        'read_status' => 'Unread',
                                        'created_at' => $now,
                                        'created_by' => $model->hr_employee_id,
                                        'image_web_filename' => $hrModel->image_web_filename,
                                        'created_by_name' => $hrModel->name
                                    ];
                                }
                                
                                $tableName = 'notification';
                                $columnNameArray = [
                                    'batch',
                                    'name',
                                    'module_name',
                                    'url',
                                    'hr_id',
                                    'hr_employee_id',
                                    'hr_designation',
                                    'hr_employee_type',
                                    'hr_name',
                                    'message',
                                    'read_status',
                                    'created_at',
                                    'created_by',
                                    'image_web_filename',
                                    'created_by_name'
                                ];
                                Yii::$app->db->createCommand()->batchInsert($tableName, $columnNameArray, $bulkInsertArray)->execute();
                            }

                            $request->response = 'Success';
                            $request->message = 'Your complain has successfully been submitted. Your token number is: ' . $model->token_no;
                            
                        } else {

                            $request->response = 'Error';
                            $request->message = 'You have not submitted any complain yet.';
                        }
                        
                    } else {

                        $request->response = 'Error';
                        $request->message = 'Please exit app and try again.';
                    }
                    
                } else {
                    
                    $request->response = 'Error';
                    $request->message = 'Complain Box cannot be empty.';
                    
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

    // Mobile Leaderboard Volume
    public function actionLeaderboard() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            $product = array();

            if (isset($request->employee_id) && !empty($request->employee_id)) {

                $targetDate = date('Y-m', time()) . '-01';
                $targetProductModel = \backend\models\Target::find()->select('product_model_code')->where(['target_date' => $targetDate])->distinct()->all();
                if (!empty($targetProductModel)) {
                    foreach ($targetProductModel as $value) {
                        $product[] = $value->product_model_code;
                    }
                }

                $productString = '"' . implode('","', $product) . '"';
                $sql = "SELECT employee_id, employee_name, designation, SUM(fsm_vol) AS total_target, SUM(fsm_vol_sales) AS total_achievement, "
                . "CONCAT(FORMAT(case when SUM(fsm_vol)=0 then 0 else ( SUM(fsm_vol_sales)/SUM(fsm_vol))*100 end ,2), '%') AS achievement_percent "
                . "FROM target WHERE (product_model_code IN ($productString)) AND (target_date='$targetDate') "
                        . "GROUP BY employee_id ORDER BY `achievement_percent` DESC LIMIT 20";
                $leaderboardQuery = Yii::$app->db->createCommand($sql)->queryAll();

                if (!empty($leaderboardQuery)) {

                    $request = $leaderboardQuery;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'Monthly leaderboard is not available at this moment.';
                }
                
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
    }
    
    // Mobile Leaderboard Value
    public function actionLeaderboard_val() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            $product = array();

            if (isset($request->employee_id) && !empty($request->employee_id)) {

                $targetDate = date('Y-m', time()) . '-01';
                $targetProductModel = \backend\models\Target::find()->select('product_model_code')->where(['target_date' => $targetDate])->distinct()->all();
                if (!empty($targetProductModel)) {
                    foreach ($targetProductModel as $value) {
                        $product[] = $value->product_model_code;
                    }
                }

                $productString = '"' . implode('","', $product) . '"';
                $sql = "SELECT employee_id, employee_name, designation, FORMAT(SUM(fsm_val), 2) AS total_target, FORMAT(SUM(fsm_val_sales), 2) AS total_achievement,
                    CONCAT(FORMAT(case when SUM(fsm_val)=0 then 0 else ( SUM(fsm_val_sales)/SUM(fsm_val))*100 end ,2), '%') AS achievement_percent 
                    FROM target "
                . "WHERE (product_model_code IN ($productString)) AND (target_date='$targetDate') "
                        . "GROUP BY employee_id ORDER BY `achievement_percent` DESC LIMIT 20";
                $leaderboardQuery = Yii::$app->db->createCommand($sql)->queryAll();

                if (!empty($leaderboardQuery)) {

                    $request = $leaderboardQuery;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'Monthly leaderboard is not available at this moment.';
                }
                
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
    }
    
    // Mobile Total Target Value
    public function actionTarget_total_val() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            $product = array();

            if (isset($request->employee_id) && !empty($request->employee_id)) {
                
                $employeeId = $request->employee_id;

                $targetDate = date('Y-m', time()) . '-01';
                $sql = "SELECT SUM(fsm_val) AS total_target, SUM(fsm_val_sales) AS total_achievement, "
                . "CONCAT(FORMAT(case when SUM(fsm_val)=0 then 0 else ( SUM(fsm_val_sales)/SUM(fsm_val))*100 end ,2), '%') AS achievement_percent "
                . "FROM target WHERE (employee_id='$employeeId') AND (target_date='$targetDate')";
                $targetTotalModel = Yii::$app->db->createCommand($sql)->queryOne();

                if (!empty($targetTotalModel)) {

                    $request = $targetTotalModel;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'Monthly total Target Vs Achievement is not available at this moment.';
                }
                
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
    }
    
    // Mobile Total Target Volume
    public function actionTarget_total() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            $product = array();

            if (isset($request->employee_id) && !empty($request->employee_id)) {
                
                $employeeId = $request->employee_id;

                $targetDate = date('Y-m', time()) . '-01';
                $sql = "SELECT SUM(fsm_vol) AS total_target, SUM(fsm_vol_sales) AS total_achievement, "
                . "CONCAT(FORMAT(case when SUM(fsm_vol)=0 then 0 else ( SUM(fsm_vol_sales)/SUM(fsm_vol))*100 end ,2), '%') AS achievement_percent "
                . "FROM target WHERE (employee_id='$employeeId') AND (target_date='$targetDate')";
                $targetTotalModel = Yii::$app->db->createCommand($sql)->queryOne();

                if (!empty($targetTotalModel)) {

                    $request = $targetTotalModel;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'Monthly total Target Vs Achievement is not available at this moment.';
                }
                
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
    }
    
    // Mobile Target VS Achievement Value
    public function actionTarget_val() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            $product = array();

            if (isset($request->employee_id) && !empty($request->employee_id)) {
                
                $employeeId = $request->employee_id;
                $targetDate = date('Y-m', time()) . '-01';
                $sql = "SELECT product_model_name, fsm_val, fsm_val_sales, CONCAT(FORMAT(case when fsm_val=0 then 0 else ( fsm_val_sales/fsm_val)*100 end ,2), '%') AS achievement_percent FROM `target` WHERE employee_id='$employeeId' AND target_date='$targetDate' group by product_model_code";
                $targetQuery = Yii::$app->db->createCommand($sql)->queryAll();
                
                if (!empty($targetQuery)) {

                    $request = $targetQuery;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'Monthly Target Vs Achievement is not available at this moment.';
                }
                
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
    }
    
    // Training Method
    public function actionTraining() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if ((isset($request->employee_id) && !empty($request->employee_id)) && (isset($request->designation) && !empty($request->designation))) {
                
                $employeeId = $request->employee_id;
                $designation = $request->designation;
                $trainingPdfModel = \backend\models\TrainingPdf::find()
                        ->andFilterWhere(['status' => 'Active'])
                        ->andFilterWhere(['like', 'designations', $designation])
                        ->orderBy(['id' => SORT_DESC])
                        ->asArray()
                        ->one();
                
                if (!empty($trainingPdfModel)) {
                    
                    $fileParams = explode('/', $trainingPdfModel['file_import']);
                    
                    $trainingPdfModel['file_import'] =  self::$paramsUrl . '/uploads/files/training/pdf/index.php?file_name=' . $fileParams[4];

                    $request = $trainingPdfModel;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'Training content is not available at this moment.';
                }
                
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
    }
    
    // Mobile Target VS Achievement Volume
    public function actionTarget() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';
            $product = array();

            if (isset($request->employee_id) && !empty($request->employee_id)) {
                
                $employeeId = $request->employee_id;
                $targetDate = date('Y-m', time()) . '-01';
                $sql = "SELECT product_model_name, fsm_vol, fsm_vol_sales, CONCAT(FORMAT(case when fsm_vol=0 then 0 else ( fsm_vol_sales/fsm_vol)*100 end ,2), '%') AS achievement_percent FROM `target` WHERE employee_id='$employeeId' AND target_date='$targetDate' group by product_model_code";
                $targetQuery = Yii::$app->db->createCommand($sql)->queryAll();
                
                if (!empty($targetQuery)) {

                    $request = $targetQuery;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'Monthly Target Vs Achievement is not available at this moment.';
                }
                
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
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
    
    // Mobile Complain View
    public function actionComplain_view() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = 'Server error !!! Please Try again';

            if (isset($request->token_no) && !empty($request->token_no)) {

                $complainboxModel = \backend\models\Complainbox::find()
                        ->select(['id', 'token_no', 'complain', 'feedback', 'status', 'complain_date'])
                        ->where('token_no=:token_no', [':token_no' => $request->token_no])
                        ->asArray()
                        ->one();

                if (!empty($complainboxModel)) {

                    $complainboxModel['complain_date'] = date('d-m-Y g:i a', strtotime($complainboxModel['complain_date']));
                    $request = $complainboxModel;
                    
                } else {

                    $request->response = 'Error';
                    $request->message = 'The token number has been marked as invalid.';
                }
            } else {

                $request->response = 'Error';
                $request->message = 'Please exit app and login again.';
            }
            
        } else {

            $request->response = 'Error';
            $request->message = 'Data not submitted.';
        }
        
        echo json_encode($request);
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
                            $stockModelOne->save(false);

                            $inventoryModelOne = Inventory::find()
                                    ->where('imei_no=:imei_no', [':imei_no' => $model->imei_no])
                                    ->one();
                            $inventoryModelOne->updated_at = $now;
                            $inventoryModelOne->updated_by = $username;
                            $inventoryModelOne->stage = Inventory::$stageSold;
                            $inventoryModelOne->save(false);

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

    // Fetch Attendance
    public function actionAttendance_fetch() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = Message::$serverError;

            if (isset($request->employee_id) && !empty($request->employee_id)) {

                $attendanceCount = AttendanceChecklist::find()
                        ->where('hr_employee_id=:hr_employee_id AND checklist_date=:checklist_date', [':hr_employee_id' => $request->employee_id, ':checklist_date' => date('Y-m-d', time())])
                        ->count();

                if ($attendanceCount == 0) {

                    $request->response = 'IN';
                    $attendanceQuestionModel = \backend\models\AttendanceQuestion::find()->asArray()->all();
                    $request = $attendanceQuestionModel;
                } else {

                    $attendanceOutCount = AttendanceChecklist::find()
                            ->where('hr_employee_id=:hr_employee_id AND checklist_date=:checklist_date AND out_time IS NULL', [':hr_employee_id' => $request->employee_id, ':checklist_date' => date('Y-m-d', time())])
                            ->count();

                    if ($attendanceOutCount == 0) {

                        $request->response = 'DONE';
                        $request->message = 'You have already given your attendance.';
                    } else {

                        $request->response = 'OUT';
                    }
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

    // Add Attendance
    public function actionAdd_attendance() {

        Access::setPermission();

        $model = new AttendanceChecklist();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = Message::$serverError;

            if ((isset($request->employee_id) && !empty($request->employee_id)) && (isset($request->answer) && !empty($request->answer))) {

                $employee_id = $request->employee_id;
                $answer = json_decode($request->answer);

                $hrModelOne = Hr::find()
                        ->select(['retail_dms_code', 'retail_name', 'employee_id', 'name'])
                        ->where('employee_id=:employee_id', [':employee_id' => $employee_id])
                        ->orderBy(['id' => SORT_DESC])
                        ->one();

                if (!empty($hrModelOne)) {

                    $questionArray[] = array();
                    $questionModel = \backend\models\AttendanceQuestion::find()->all();

                    if (count($questionModel) == count((array) $answer->option)) {

                        foreach ($questionModel as $attendanceQuestion) {

                            $qid = $attendanceQuestion->id;
                            $questionArray[$qid] = $attendanceQuestion->question;
                        }

                        $checklist = '';
                        $error = false;
                        foreach ($answer->option as $key => $value) {

                            if ($value == 'Yes') {

                                $checklist .= '<div>' . '<b>Question: </b>' . $questionArray[$key] . ', <b> Answer: </b>' . $value . '.</div> ';
                            } else if ($value == 'No') {

                                if (isset($answer->remark->$key) && $answer->remark->$key != '') {

                                    $checklist .= '<div>' . '<b>Question: </b>' . $questionArray[$key] . ', <b> Answer: </b>' . $value . ', <b>Review: </b>' . $answer->remark->$key . '.</div> ';
                                } else {

                                    $error = true;
                                    $request->response = 'Error';
                                    $request->message = 'Remark cannot be blank.';
                                    break;
                                }
                            }
                        }

                        if (!$error) {

                            $model->checklist = $checklist;
                            $model->retail_dms_code = $hrModelOne->retail_dms_code;
                            $model->retail_name = $hrModelOne->retail_name;
                            $model->hr_employee_id = $hrModelOne->employee_id;
                            $model->hr_name = $hrModelOne->name;
                            $model->checklist_date = date('Y-m-d', time());
                            $model->in_time = date('H:i:s', time());
                            $model->status = AttendanceChecklist::$statusPending;

                            if ($model->save()) {

                                $request->response = 'Success';
                                $request->message = Message::$successMessage;
                            } else {

                                $request->response = 'Error';
                                $request->message = Message::$serverError;
                            }
                        }
                    } else {

                        $request->response = 'Error';
                        $request->message = Message::$questionMandatory;
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

    // Add Attendance Out
    public function actionAdd_attendance_out() {

        Access::setPermission();

        $postdata = file_get_contents("php://input");
        if (isset($postdata) && !empty($postdata)) {

            $request = json_decode($postdata);
            $request->response = 'Error';
            $request->message = Message::$serverError;

            if (isset($request->employee_id) && !empty($request->employee_id)) {

                $attendanceChecklistModel = AttendanceChecklist::find()
                        ->where('hr_employee_id=:hr_employee_id AND checklist_date=:checklist_date AND out_time IS NULL', [':hr_employee_id' => $request->employee_id, ':checklist_date' => date('Y-m-d', time())])
                        ->one();

                if (!empty($attendanceChecklistModel)) {

                    $attendanceChecklistModel->out_time = date('H:i:s', time());
                    $attendanceChecklistModel->save(false);

                    $request->response = 'Success';
                    $request->message = Message::$successMessage;
                } else {

                    $request->response = 'Error';
                    $request->message = 'Your request cannot be processed.';
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
