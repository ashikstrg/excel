<?php

namespace backend\controllers;

use Yii;
use backend\models\Complainbox;
use backend\models\ComplainboxSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// DB Expression
use yii\db\Expression;

class ComplainboxController extends Controller
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
        $searchModel = new ComplainboxSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionNotification_view($id, $ntid)
    {
        $notificationModel = \backend\models\Notification::find()
                ->where('id=:id AND read_status=:read_status', 
                [':id' => $ntid, ':read_status' => 'Unread'])
                ->one();
        if(!empty($notificationModel)) {
            $notificationModel->read_status = 'Read';
            $notificationModel->seen = new Expression('NOW()');
            $notificationModel->save(false);
        }
        
        return $this->render('notification_view', [
            'model' => $this->findModel($id),
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
        $model = new Complainbox();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $model->feedback_by_employee_id = Yii::$app->user->identity->username;
            $model->feedback_by_name = Yii::$app->session->get('name');
            $model->feedback_date = new Expression('NOW()');
            
            if($model->save()) {
                Yii::$app->session->setFlash('success', 'You feedback has successfully been submitted.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
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
        if (($model = Complainbox::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
