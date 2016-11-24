<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TrainingAssessmentQuestion;

/**
 * TrainingAssessmentQuestionSearch represents the model behind the search form about `backend\models\TrainingAssessmentQuestion`.
 */
class TrainingAssessmentQuestionSearch extends TrainingAssessmentQuestion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'answer', 'category_id'], 'integer'],
            [['question_name', 'answer1', 'answer2', 'answer3', 'answer4', 'choice'], 'safe'],
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
        $query = TrainingAssessmentQuestion::find();

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
            'answer' => $this->answer,
            'category_id' => $this->category_id,
        ]);

        $query->andFilterWhere(['like', 'question_name', $this->question_name])
            ->andFilterWhere(['like', 'answer1', $this->answer1])
            ->andFilterWhere(['like', 'answer2', $this->answer2])
            ->andFilterWhere(['like', 'answer3', $this->answer3])
            ->andFilterWhere(['like', 'answer4', $this->answer4])
            ->andFilterWhere(['like', 'choice', $this->choice]);

        return $dataProvider;
    }
}
