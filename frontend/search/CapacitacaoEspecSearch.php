<?php

namespace frontend\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\CapacitacaoEspec;

/**
 * CapacitacaoEspecSearch represents the model behind the search form about `frontend\models\CapacitacaoEspec`.
 */
class CapacitacaoEspecSearch extends CapacitacaoEspec
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_espectador'], 'integer'],
            [['nome', 'cpf', 'email', 'id_unidade', 'telefone'], 'safe'],
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
        $query = CapacitacaoEspec::find();

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
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'cpf', $this->cpf])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'id_unidade', $this->id_unidade])
            ->andFilterWhere(['like', 'telefone', $this->telefone]);

        return $dataProvider;
    }
}
