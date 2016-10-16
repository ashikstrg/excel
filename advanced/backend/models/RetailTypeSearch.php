<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\RetailType;

/**
 * RetailTypeSearch represents the model behind the search form about `backend\models\RetailType`.
 */
class RetailTypeSearch extends RetailType
{
    
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['type', 'channel_type_id'], 'safe'],
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

    public function search($params)
    {
        $query = RetailType::find();
        $query->joinWith('channelType');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type]);

        $query->andFilterWhere(['like', 'channel_type.type', $this->channel_type_id]);

        return $dataProvider;
    }
}
