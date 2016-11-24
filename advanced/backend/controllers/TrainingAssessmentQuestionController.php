<?php

namespace backend\controllers;

use Yii;
use backend\models\TrainingAssessmentQuestion;
use backend\models\TrainingAssessmentQuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class TrainingAssessmentQuestionController extends Controller
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
        $searchModel = new TrainingAssessmentQuestionSearch();
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
    
    public function actionAdd($id)
    {
        $model = new TrainingAssessmentQuestion();
        $trainingAssessmentCategoryModel = \backend\models\TrainingAssessmentCategory::findOne($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->category_id = $id;
            
            if($model->save()) {

                $trainingAssessmentCategoryModel->status = 'Pending';
                $trainingAssessmentCategoryModel->save();
                
                Yii::$app->session->setFlash('success', 'The question has successfully been added.');
                
            } else{
                Yii::$app->session->setFlash('error', 'Invalid Character SET !!! Please try again.');
            }
            
        }
        
        return $this->render('add', [
            'model' => $model,
            'trainingAssessmentCategoryModel' => $trainingAssessmentCategoryModel
        ]);
    }

    public function actionCreate()
    {
        $model = new TrainingAssessmentQuestion();

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
        if (($model = TrainingAssessmentQuestion::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
