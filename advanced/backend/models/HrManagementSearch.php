<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\HrManagement;

class HrManagementSearch extends HrManagement
{
    public function rules()
    {
        return [
            [['employee_id', 'name', 'status', 'joining_date', 'leaving_date', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'blood_group', 'permanent_address', 'present_address', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = HrManagement::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'contact_no_official', $this->contact_no_official])
            ->andFilterWhere(['like', 'contact_no_personal', $this->contact_no_personal])
            ->andFilterWhere(['like', 'name_immergency_contact_person', $this->name_immergency_contact_person])
            ->andFilterWhere(['like', 'relation_immergency_contact_person', $this->relation_immergency_contact_person])
            ->andFilterWhere(['like', 'contact_no_immergency', $this->contact_no_immergency])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'email_address_official', $this->email_address_official])
            ->andFilterWhere(['like', 'blood_group', $this->blood_group])
            ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
            ->andFilterWhere(['like', 'present_address', $this->present_address])
            ->andFilterWhere(['like', 'joining_date', $this->joining_date])
            ->andFilterWhere(['like', 'leaving_date', $this->leaving_date])
            ->andFilterWhere(['like', 'created_at', $this->created_at])
            ->andFilterWhere(['like', 'updated_at', $this->updated_at])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
