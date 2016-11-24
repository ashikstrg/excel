<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Notification;

class NotificationSearch extends Notification
{

    public function rules()
    {
        return [
            [['id', 'hr_id'], 'integer'],
            [['name', 'module_name', 'url', 'hr_employee_id', 'hr_designation', 'hr_employee_type', 'hr_name', 'message', 'read_status', 'seen', 'created_at', 'created_by', 'created_by_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Notification::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'hr_id' => $this->hr_id,
            'seen' => $this->seen,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'module_name', $this->module_name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'read_status', $this->read_status])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
    
    public function read($params)
    {
        $query = Notification::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'hr_id' => $this->hr_id,
            'seen' => $this->seen,
            'created_at' => $this->created_at,
            'read_status' => 'Read',
            'module_name' => 'Training',
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
    
    public function unread($params)
    {
        $query = Notification::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'hr_id' => $this->hr_id,
            'seen' => $this->seen,
            'created_at' => $this->created_at,
            'read_status' => 'Unread',
            'module_name' => 'Training',
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_designation', $this->hr_designation])
            ->andFilterWhere(['like', 'hr_employee_type', $this->hr_employee_type])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'created_by', $this->created_by]);

        return $dataProvider;
    }
    
    public function all($params)
    {
        $query = Notification::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'hr_employee_id' => Yii::$app->session->get('employee_id'),
            'seen' => $this->seen,
            'created_at' => $this->created_at,
            'read_status' => $this->read_status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'module_name', $this->module_name])
            ->andFilterWhere(['like', 'message', $this->message])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'created_by_name', $this->created_by_name]);

        return $dataProvider;
    }
    
}
