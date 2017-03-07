<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Complainbox;

/**
 * ComplainboxSearch represents the model behind the search form about `backend\models\Complainbox`.
 */
class ComplainboxSearch extends Complainbox
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'token_no'], 'integer'],
            [['complain', 'hr_employee_id', 'hr_name', 'retail_dms_code', 'retail_name', 'status', 'complain_date', 'feedback', 'feedback_by_employee_id', 'feedback_by_name', 'feedback_date'], 'safe'],
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
        $query = Complainbox::find();

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
            'token_no' => $this->token_no,
            'complain_date' => $this->complain_date,
            'feedback_date' => $this->feedback_date,
        ]);

        $query->andFilterWhere(['like', 'complain', $this->complain])
            ->andFilterWhere(['like', 'hr_employee_id', $this->hr_employee_id])
            ->andFilterWhere(['like', 'hr_name', $this->hr_name])
            ->andFilterWhere(['like', 'retail_dms_code', $this->retail_dms_code])
            ->andFilterWhere(['like', 'retail_name', $this->retail_name])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'feedback', $this->feedback])
            ->andFilterWhere(['like', 'feedback_by_employee_id', $this->feedback_by_employee_id])
            ->andFilterWhere(['like', 'feedback_by_name', $this->feedback_by_name]);

        return $dataProvider;
    }
}
