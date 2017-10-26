<?php

namespace backend\controllers;

use Yii;
use backend\models\Retail;
use backend\models\RetailSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// Custom
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

// Custom Models
use backend\models\ChannelType;
use backend\models\RetailType;
use backend\models\RetailZone;
use backend\models\RetailArea;
use backend\models\RetailLocation;
use backend\models\Divisions;
use backend\models\Districts;
use backend\models\Upazilas;

class RetailController extends Controller
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
        $searchModel = new RetailSearch();
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

    public static function getRetailType($channel_type_id) {

        $data = RetailType::find()->where(['channel_type_id'=> $channel_type_id])->select(['id', 'type as name'])->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public function actionRetail_type() 
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $channel_type_id = $parents[0];
                $out = self::getRetailType($channel_type_id); 
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }

        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public static function getDistrict($division_id) {

        $data = Districts::find()->where(['division_id'=> $division_id])->select(['id', 'name'])->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public function actionDistrict() 
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $division_id = $parents[0];
                $out = self::getDistrict($division_id); 
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }

        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public static function getUpazila($district_id) {

        $data = Upazilas::find()->where(['district_id'=> $district_id])->select(['id', 'name'])->asArray()->all();
        $value = (count($data) == 0) ? ['' => ''] : $data;

        return $value;
    }

    public function actionUpazila() 
    {

        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $district_id = $parents[0];
                $out = self::getUpazila($district_id); 
                echo Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }

        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionCreate()
    {
        $model = new Retail();

        if ($model->load(Yii::$app->request->post())) {

            $channelType = ChannelType::find()->select('type')->where(['id' => $model->channelType])->one();
            $model->channel_type = $channelType->type;

            $retailType = RetailType::find()->select('type')->where(['id' => $model->retailType])->one();
            $model->retail_type = $retailType->type;

            $retailZone = RetailZone::find()->select('zone')->where(['id' => $model->retailZone])->one();
            $model->retail_zone = $retailZone->zone;

            $retailArea = RetailArea::find()->select('area')->where(['id' => $model->retailArea])->one();
            $model->retail_area = $retailArea->area;

            $retailLocation = RetailLocation::find()->select('location')->where(['id' => $model->retailLocation])->one();
            $model->retail_location = $retailLocation->location;

            $division = Divisions::find()->select('name')->where(['id' => $model->divisionProperty])->one();
            $model->division = $division->name;

            $district = Districts::find()->select('name')->where(['id' => $model->districtProperty])->one();
            $model->district = $district->name;

            $upazila = Upazilas::find()->select('name')->where(['id' => $model->upazilaProperty])->one();
            $model->upazila = $upazila->name;
            
            $model->created_at = date('Y-m-d H:i:s', time());
            $model->created_by = Yii::$app->user->identity->username;
            
            $model->number_sec += 1;
            $model->number_rsa += 1;

            if($model->save()) {
                
                Yii::$app->session->setFlash('success', 'New retail has successfully been added.');
                return $this->redirect(['view', 'id' => $model->id]);

            }

        } 

        $channelTypeModel = ArrayHelper::map(ChannelType::find()->all(), 'id', 'type');
        $retailZoneModel = ArrayHelper::map(RetailZone::find()->all(), 'id', 'zone');
        $retailAreaModel = ArrayHelper::map(RetailArea::find()->all(), 'id', 'area');
        $retailLocationModel = ArrayHelper::map(RetailLocation::find()->all(), 'id', 'location');
        $divisionsModel = ArrayHelper::map(Divisions::find()->all(), 'id', 'name');

        return $this->render('create', [
            'model' => $model,
            'channelTypeModel' => $channelTypeModel,
            'retailZoneModel' => $retailZoneModel,
            'retailAreaModel' => $retailAreaModel,
            'retailLocationModel' => $retailLocationModel,
            'divisionsModel' => $divisionsModel
        ]);
        
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        $model->number_sec -= 1;
        $model->number_rsa -= 1;

        if ($model->load(Yii::$app->request->post())) {
            
            $channelType = ChannelType::find()->select('type')->where(['id' => $model->channelType])->one();
            $model->channel_type = $channelType->type;

            $retailType = RetailType::find()->select('type')->where(['id' => $model->retailType])->one();
            $model->retail_type = $retailType->type;

            $retailZone = RetailZone::find()->select('zone')->where(['id' => $model->retailZone])->one();
            $model->retail_zone = $retailZone->zone;

            $retailArea = RetailArea::find()->select('area')->where(['id' => $model->retailArea])->one();
            $model->retail_area = $retailArea->area;

            $retailLocation = RetailLocation::find()->select('location')->where(['id' => $model->retailLocation])->one();
            $model->retail_location = $retailLocation->location;

            $division = Divisions::find()->select('name')->where(['id' => $model->divisionProperty])->one();
            $model->division = $division->name;

            $district = Districts::find()->select('name')->where(['id' => $model->districtProperty])->one();
            $model->district = $district->name;

            $upazila = Upazilas::find()->select('name')->where(['id' => $model->upazilaProperty])->one();
            $model->upazila = $upazila->name;

            $model->updated_at = date('Y-m-d H:i:s', time());
            $model->updated_by = Yii::$app->user->identity->username;
            
            $model->number_sec += 1;
            $model->number_rsa += 1;

            if($model->save()) {

                Yii::$app->session->setFlash('success', 'Retail has successfully been updated.');
                return $this->redirect(['view', 'id' => $model->id]);

            }

        } else {

            $channelTypeModel = ArrayHelper::map(ChannelType::find()->all(), 'id', 'type');
            $retailZoneModel = ArrayHelper::map(RetailZone::find()->all(), 'id', 'zone');
            $retailAreaModel = ArrayHelper::map(RetailArea::find()->all(), 'id', 'area');
            $retailLocationModel = ArrayHelper::map(RetailLocation::find()->all(), 'id', 'location');
            $divisionsModel = ArrayHelper::map(Divisions::find()->all(), 'id', 'name');

            return $this->render('update', [
                'model' => $model,
                'channelTypeModel' => $channelTypeModel,
                'retailZoneModel' => $retailZoneModel,
                'retailAreaModel' => $retailAreaModel,
                'retailLocationModel' => $retailLocationModel,
                'divisionsModel' => $divisionsModel
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionMdelete()
    {
        $pk = Yii::$app->request->post('row_id');

        foreach ($pk as $key => $value) 
        {
            $sql = "DELETE FROM retail WHERE id = $value";
            $query = Yii::$app->db->createCommand($sql)->execute();
        }

        return $this->redirect(['index']);

    }

    protected function findModel($id)
    {
        if (($model = Retail::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
