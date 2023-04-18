<?php

namespace frontend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CapacitacaoRel;

/**
 * CapacitacaoRelSearch represents the model behind the search form about `frontend\models\CapacitacaoRel`.
 */
class CapacitacaoRelSearch extends CapacitacaoRel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_espectador', 'id_capacitacao', 'id'], 'integer'],
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
        $query = CapacitacaoRel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id_espectador' => $this->id_espectador,
            'id_capacitacao' => $this->id_capacitacao,
            'id' => $this->id,
        ]);

        return $dataProvider;
    }
}
