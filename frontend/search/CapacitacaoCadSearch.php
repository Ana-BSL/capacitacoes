<?php

namespace frontend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CapacitacaoCad;

/**
 * CapacitacaoCadSearch represents the model behind the search form about `frontend\models\CapacitacaoCad`.
 */
class CapacitacaoCadSearch extends CapacitacaoCad
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_capacitacao', 'carga_horaria', 'created_by', 'updated_by'], 'integer'],
            [['titulo', 'descricao', 'data_realizacao', 'created_at', 'updated_at', 'cnes_unidade'], 'safe'],
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
        $query = CapacitacaoCad::find();

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
            'id_capacitacao' => $this->id_capacitacao,
            'carga_horaria' => $this->carga_horaria,
            'data_realizacao' => $this->data_realizacao,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'cnes_unidade', $this->cnes_unidade]);

        return $dataProvider;
    }
}
