<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Upazilas;

class UpazilasSearch extends Upazilas
{
    public $division_id;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'district_id', 'division_id'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Upazilas::find();

        $query->joinWith('district')->joinWith(['district.division']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['division_id'] = [
            'asc' => ['divisions.name' => SORT_ASC],
            'desc' => ['divisions.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id
        ]);

        $query->andFilterWhere(['like', 'upazilas.name', $this->name]);
        $query->andFilterWhere(['like', 'districts.name', $this->district_id]);
        $query->andFilterWhere(['like', 'divisions.name', $this->division_id]);

        return $dataProvider;
    }
}
