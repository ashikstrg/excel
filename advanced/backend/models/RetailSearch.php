<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Retail;

/**
 * RetailSearch represents the model behind the search form about `backend\models\Retail`.
 */
class RetailSearch extends Retail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'channelType', 'retailType', 'retailZone', 'retailArea', 'retailLocation', 'divisionProperty', 'districtProperty', 'upazilaProperty', 'store_size_sft', 'store_facade_feet', 'number_sec', 'number_rsa'], 'integer'],
            [['channel_type', 'retail_type', 'status', 'dms_code', 'name', 'retail_zone', 'retail_area', 'territory', 'retail_location', 'division', 'district', 'upazila', 'market_name', 'geotag', 'Address', 'contact_no', 'owner_name', 'owner_contact_no', 'owner_email', 'store_contact_no', 'store_email', 'manager_name', 'manager_contact_no', 'day_off', 'connectivity_wifi', 'created_by', 'created_at', 'updated_at', 'updated_by'], 'safe'],
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
        $query = Retail::find();

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
            'channelType' => $this->channelType,
            'retailType' => $this->retailType,
            'retailZone' => $this->retailZone,
            'retailArea' => $this->retailArea,
            'retailLocation' => $this->retailLocation,
            'divisionProperty' => $this->divisionProperty,
            'districtProperty' => $this->districtProperty,
            'upazilaProperty' => $this->upazilaProperty,
            'store_size_sft' => $this->store_size_sft,
            'store_facade_feet' => $this->store_facade_feet,
            'number_sec' => $this->number_sec,
            'number_rsa' => $this->number_rsa,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'channel_type', $this->channel_type])
            ->andFilterWhere(['like', 'retail_type', $this->retail_type])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'dms_code', $this->dms_code])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'retail_zone', $this->retail_zone])
            ->andFilterWhere(['like', 'retail_area', $this->retail_area])
            ->andFilterWhere(['like', 'territory', $this->territory])
            ->andFilterWhere(['like', 'retail_location', $this->retail_location])
            ->andFilterWhere(['like', 'division', $this->division])
            ->andFilterWhere(['like', 'district', $this->district])
            ->andFilterWhere(['like', 'upazila', $this->upazila])
            ->andFilterWhere(['like', 'market_name', $this->market_name])
            ->andFilterWhere(['like', 'geotag', $this->geotag])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'contact_no', $this->contact_no])
            ->andFilterWhere(['like', 'owner_name', $this->owner_name])
            ->andFilterWhere(['like', 'owner_contact_no', $this->owner_contact_no])
            ->andFilterWhere(['like', 'owner_email', $this->owner_email])
            ->andFilterWhere(['like', 'store_contact_no', $this->store_contact_no])
            ->andFilterWhere(['like', 'store_email', $this->store_email])
            ->andFilterWhere(['like', 'manager_name', $this->manager_name])
            ->andFilterWhere(['like', 'manager_contact_no', $this->manager_contact_no])
            ->andFilterWhere(['like', 'day_off', $this->day_off])
            ->andFilterWhere(['like', 'connectivity_wifi', $this->connectivity_wifi])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'updated_by', $this->updated_by]);

        return $dataProvider;
    }
}