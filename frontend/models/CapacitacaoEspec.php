<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "capacitacao_espec".
 *
 * @property int $id_espectador
 * @property string|null $nome
 * @property string|null $cpf
 * @property string|null $email
 * @property string|null $id_unidade
 * @property string|null $telefone
 *
 * @property CapacitacaoRel[] $capacitacaoRels
 * @property UnidadeSaude $unidade
 */
class CapacitacaoEspec extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'capacitacao_espec';
    }

    const SCENARIO_VALIDACAO_CPF = 'validacao_cpf';
    const SCENARIO_VALIDACAO_TOTAL = 'validacao_total';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'cpf', 'email', 'id_unidade', 'telefone'], 'string'],
            [['id_unidade'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadeSaude::class, 'targetAttribute' => ['id_unidade' => 'cnes']],
            [['cpf'], 'required', 'on' => self::SCENARIO_VALIDACAO_CPF],
            [['nome', 'cpf', 'email', 'id_unidade', 'telefone'], 'required', 'on' => self::SCENARIO_VALIDACAO_TOTAL],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_espectador' => 'Id Espectador',
            'nome' => 'Nome',
            'cpf' => 'Cpf',
            'email' => 'Email',
            'id_unidade' => 'Unidade',
            'telefone' => 'Telefone',
        ];
    }

    /**
     * Gets query for [[CapacitacaoRels]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\CapacitacaoRelQuery
     */
    public function getCapacitacaoRels()
    {
        return $this->hasMany(CapacitacaoRel::class, ['id_espectador' => 'id_espectador']);
    }

    /**
     * Gets query for [[Unidade]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\UnidadeSaudeQuery
     */
    public function getUnidade()
    {
        return $this->hasOne(UnidadeSaude::class, ['cnes' => 'id_unidade']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\query\CapacitacaoEspecQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\query\CapacitacaoEspecQuery(get_called_class());
    }

    public static function getEspectadores(){
        $droptions = CapacitacaoEspec::find()->orderBy('nome')->all();
        $array = ArrayHelper::map($droptions, 'id_espectador', 'nome');
        return $array;
    }
}
