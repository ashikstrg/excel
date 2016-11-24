<?php

namespace backend\controllers;

use Yii;
use backend\models\TrainingAssessmentResult;
use backend\models\TrainingAssessmentResultSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// yii\db\Expression for current time
use yii\db\Expression;

class TrainingAssessmentResultController extends Controller
{
    public $enableCsrfValidation = false;

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
        $searchModel = new TrainingAssessmentResultSearch();
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
    
    public function actionQuestions($id)
    {
        $modelTrainingAssessMentCategory = \backend\models\TrainingAssessmentCategory::find()->where(
                'id=:id AND status=:status', [
                    ':id' => $id,
                    ':status' => 'Active'
                ])->one();
        
        if(empty($modelTrainingAssessMentCategory)) {
            
            return $this->render('/site/error', [
                'name' => 'Inactive',
                'message' => 'Sorry! The assessment is over.'
            ]);
            
        } else {
            
            $modelTrainingAssessMentResult = \backend\models\TrainingAssessmentResult::find()->where(
                    'category_id=:category_id AND hr_employee_id=:hr_employee_id', [
                    ':category_id' => $id,
                    ':hr_employee_id' => Yii::$app->session->get('employee_id')
                ])->one(); 
            
            if(!empty($modelTrainingAssessMentResult)) {
                
                return $this->render('/site/error', [
                    'name' => 'Invalid',
                    'message' => 'Sorry! You already have participated in the test.'
                ]);
            }
        }
        
        $modelTrainingAssessMentQuestions = \backend\models\TrainingAssessmentQuestion::find()->where(
                'category_id=:category_id', [
                    ':category_id' => $id
                ])
                ->orderBy(new Expression('rand()'))
                ->limit($modelTrainingAssessMentCategory->qlimit)
                ->all();
        
        $totalQuestion = count($modelTrainingAssessMentQuestions);
        
        Yii::$app->session->set('start_time', time());
        Yii::$app->session->set('category_id', $modelTrainingAssessMentCategory->id);
        
        return $this->render('questions', [
            'modelTrainingAssessMentQuestions' => $modelTrainingAssessMentQuestions,
            'modelTrainingAssessMentCategory' => $modelTrainingAssessMentCategory,
            'totalQuestion' => $totalQuestion
        ]);
        
    }
    
    public function actionResult()
    {
        if(isset(Yii::$app->session['category_id']) && isset(Yii::$app->session['start_time'])){
            
            $category_id = Yii::$app->session->get('category_id');
            $start_time = Yii::$app->session->get('start_time');

            Yii::$app->session->remove('category_id');
            Yii::$app->session->remove('start_time'); 
            
        } else {

            return $this->render('/site/error', [
                'name' => 'Session Expired',
                'message' => 'Sorry! Please try again.'
            ]);

        }
        
        $modelTrainingAssessMentCategory = \backend\models\TrainingAssessmentCategory::find()->where(
                'id=:id', [
                ':id' => $category_id
                ])->one();
        
        if(empty($modelTrainingAssessMentCategory)) {
            
            return $this->render('/site/error', [
                'name' => 'Inactive',
                'message' => 'Sorry! The assessment does not exist anymore.'
            ]);
            
        } 
        
        $right_answer=0;
        $wrong_answer=0;
        $unanswered=0; 
        $keys=array_keys($_POST);
        $order=join(",",$keys);
        
        $response = Yii::$app->db->createCommand("select id, answer from training_assessment_question where id IN($order) ORDER BY FIELD(id,$order)")->queryAll();
        
        foreach($response as $result){
            
            if($result['answer']==$_POST[$result['id']]){
                    $right_answer++;
                }else if($_POST[$result['id']]==5){
                    $unanswered++;
                }
                else{
                    $wrong_answer++;
                }
         }

        $score = $right_answer;
        $score_percent = number_format((($score/$modelTrainingAssessMentCategory->qlimit) * 100), 2);
        
        $end_time = time();
        $total_time = number_format((($end_time - $start_time) / 60), 2);

        $model = new TrainingAssessmentResult();
        $model->category_id = $category_id;
        $model->hr_employee_id = Yii::$app->session->get('employee_id');
        $model->hr_name = Yii::$app->session->get('name');
        $model->hr_designation = Yii::$app->session->get('designation');
        $model->hr_employee_type = Yii::$app->session->get('userRole');
        $model->score = $score;
        $model->right_answer = $right_answer;
        $model->wrong_answer = $wrong_answer;
        $model->un_answer = $unanswered;
        $model->score_percent = $score_percent;
        $model->total_time = $total_time;
        $model->date_month = $modelTrainingAssessMentCategory->date_month;
        $model->participation_datetime = new Expression('NOW()');
        $model->status = 'Active';
        
        if($model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            
            return $this->render('/site/error', [
                'name' => 'Invalid Data',
                'message' => 'Sorry! Your result could not be processed due to some invalid data. Please contact with system administrator or try later.'
            ]);
            
        }
        
        
    }

    public function actionCreate()
    {
        $model = new TrainingAssessmentResult();

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
        if (($model = TrainingAssessmentResult::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
