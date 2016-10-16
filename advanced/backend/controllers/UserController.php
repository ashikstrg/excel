<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
// Custom
use yii\helpers\ArrayHelper;
use backend\models\UserCreate;
use backend\models\UserRole;

class UserController extends Controller
{
    /**
     * @inheritdoc
     */
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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
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
        $auth = Yii::$app->authManager;
        $model = new UserCreate();

        if ($model->load(Yii::$app->request->post())) {

            if ($user = $model->create()) {
                $authorRole = $auth->getRole($model->role);
                $auth->assign($authorRole, $user->getId());
            }
        }

        $userRoleModel = ArrayHelper::map(UserRole::find()->select('role')->all(), 'role', 'role');
        return $this->render('create', [
            'model' => $model,
            'userRoleModel' => $userRoleModel
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

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionChange_password()
    {
        $user = Yii::$app->user->identity;

        $loadedPost = $user->load(Yii::$app->request->post());

        if($loadedPost && $user->validate()) {
            $user->password = $user->newPassword;
            $user->save(false);
            Yii::$app->session->setFlash('success', 'You have successfully changed your password');
            return $this->refresh();
        }

        return $this->render('change_password', [
                'model' => $user
            ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
