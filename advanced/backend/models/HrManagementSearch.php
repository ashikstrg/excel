<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\HrManagement;

/**
 * HrManagementSearch represents the model behind the search form about `backend\models\HrManagement`.
 */
class HrManagementSearch extends HrManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'designation_id', 'employee_type_id', 'previous_experience', 'previous_experience_two', 'user_id'], 'integer'],
            [['designation', 'employee_type', 'employee_id', 'name', 'status', 'joining_date', 'leaving_date', 'image', 'image_src_filename', 'image_web_filename', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'blood_group', 'graduation_status', 'educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'permanent_address', 'present_address', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = HrManagement::find();

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
            'designation_id' => $this->designation_id,
            'employee_type_id' => $this->employee_type_id,
            'joining_date' => $this->joining_date,
            'leaving_date' => $this->leaving_date,
            'previous_experience' => $this->previous_experience,
            'previous_experience_two' => $this->previous_experience_two,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'employee_type', $this->employee_type])
            ->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'image_src_filename', $this->image_src_filename])
            ->andFilterWhere(['like', 'image_web_filename', $this->image_web_filename])
            ->andFilterWhere(['like', 'contact_no_official', $this->contact_no_official])
            ->andFilterWhere(['like', 'contact_no_personal', $this->contact_no_personal])
            ->andFilterWhere(['like', 'name_immergency_contact_person', $this->name_immergency_contact_person])
            ->andFilterWhere(['like', 'relation_immergency_contact_person', $this->relation_immergency_contact_person])
            ->andFilterWhere(['like', 'contact_no_immergency', $this->contact_no_immergency])
            ->andFilterWhere(['like', 'email_address', $this->email_address])
            ->andFilterWhere(['like', 'email_address_official', $this->email_address_official])
            ->andFilterWhere(['like', 'blood_group', $this->blood_group])
            ->andFilterWhere(['like', 'graduation_status', $this->graduation_status])
            ->andFilterWhere(['like', 'educational_qualification', $this->educational_qualification])
            ->andFilterWhere(['like', 'educational_institute', $this->educational_institute])
            ->andFilterWhere(['like', 'educational_qualification_second_last', $this->educational_qualification_second_last])
            ->andFilterWhere(['like', 'educational_institute_second_last', $this->educational_institute_second_last])
            ->andFilterWhere(['like', 'permanent_address', $this->permanent_address])
            ->andFilterWhere(['like', 'present_address', $this->present_address])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}
