<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Hr;

class HrSearch extends Hr
{
    public function rules()
    {
        return [
            [['id', 'designation_id', 'employee_type_id', 'retail_id', 'status', 'previous_experience', 'previous_experience_two', 'batch'], 'integer'],

            [['batch', 'designation', 'employee_type', 'employee_id', 'tm_employee_id', 'tm_name', 'am_employee_id', 'am_name', 'csm_employee_id', 'csm_name', 'retail_dms_code', 'retail_channel_type', 'retail_type', 'retail_name', 'retail_zone', 'retail_area', 'retail_territory', 'name', 'joining_date', 'leaving_date', 'image', 'image_src_filename', 'image_web_filename', 'contact_no_official', 'contact_no_personal', 'name_immergency_contact_person', 'relation_immergency_contact_person', 'contact_no_immergency', 'email_address', 'email_address_official', 'bank_name', 'bank_ac_name', 'bank_ac_no', 'bkash_no', 'blood_group', 'graduation_status', 'educational_qualification', 'educational_institute', 'educational_qualification_second_last', 'educational_institute_second_last', 'permanent_address', 'present_address', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Hr::find();

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
            'batch' => $this->batch,
            'designation_id' => $this->designation_id,
            'employee_type_id' => $this->employee_type_id,
            'retail_id' => $this->retail_id,
            'status' => $this->status,
            'joining_date' => $this->joining_date,
            'leaving_date' => $this->leaving_date,
            'previous_experience' => $this->previous_experience,
            'previous_experience_two' => $this->previous_experience_two,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'designation', $this->designation])
            ->andFilterWhere(['like', 'employee_type', $this->employee_type])
            ->andFilterWhere(['like', 'employee_id', $this->employee_id])
            ->andFilterWhere(['like', 'tm_employee_id', $this->tm_employee_id])
            ->andFilterWhere(['like', 'tm_name', $this->tm_name])
            ->andFilterWhere(['like', 'am_employee_id', $this->am_employee_id])
            ->andFilterWhere(['like', 'am_name', $this->am_name])
            ->andFilterWhere(['like', 'csm_employee_id', $this->csm_employee_id])
            ->andFilterWhere(['like', 'csm_name', $this->csm_name])
            ->andFilterWhere(['like', 'retail_dms_code', $this->retail_dms_code])
            ->andFilterWhere(['like', 'retail_channel_type', $this->retail_channel_type])
            ->andFilterWhere(['like', 'retail_type', $this->retail_type])
            ->andFilterWhere(['like', 'retail_name', $this->retail_name])
            ->andFilterWhere(['like', 'retail_zone', $this->retail_zone])
            ->andFilterWhere(['like', 'retail_area', $this->retail_area])
            ->andFilterWhere(['like', 'retail_territory', $this->retail_territory])
            ->andFilterWhere(['like', 'name', $this->name])
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
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'bank_ac_name', $this->bank_ac_name])
            ->andFilterWhere(['like', 'bank_ac_no', $this->bank_ac_no])
            ->andFilterWhere(['like', 'bkash_no', $this->bkash_no])
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
