<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "unidade_saude".
 *
 * @property string $cnes
 * @property string|null $descricao
 * @property string|null $nome
 * @property int|null $cidade_id
 * @property int|null $regional_id
 * @property string|null $endereco
 * @property string|null $bairro
 * @property string|null $cep
 * @property string|null $latitude
 * @property string|null $longitude
 * @property string|null $telefone
 * @property int|null $status
 * @property int|null $atencao_id
 *
 * @property UnidadeSaudeAtencao $atencao
 * @property CadQualifica[] $cadQualificas
 * @property CapacitacaoCad[] $capacitacaoCads
 * @property NepPreceptor[] $nepPreceptors
 */
class UnidadeSaude extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unidade_saude';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cnes'], 'required'],
            [['cnes', 'descricao', 'nome', 'endereco', 'bairro', 'cep', 'latitude', 'longitude', 'telefone'], 'string'],
            [['cidade_id', 'regional_id', 'status', 'atencao_id'], 'default', 'value' => null],
            [['cidade_id', 'regional_id', 'status', 'atencao_id'], 'integer'],
            [['cnes'], 'unique'],
            [['atencao_id'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadeSaudeAtencao::class, 'targetAttribute' => ['atencao_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cnes' => 'Cnes',
            'descricao' => 'Descricao',
            'nome' => 'Nome',
            'cidade_id' => 'Cidade ID',
            'regional_id' => 'Regional ID',
            'endereco' => 'Endereco',
            'bairro' => 'Bairro',
            'cep' => 'Cep',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'telefone' => 'Telefone',
            'status' => 'Status',
            'atencao_id' => 'Atencao ID',
        ];
    }

    /**
     * Gets query for [[Atencao]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\UnidadeSaudeAtencaoQuery
     */
    public function getAtencao()
    {
        return $this->hasOne(UnidadeSaudeAtencao::class, ['id' => 'atencao_id']);
    }

    /**
     * Gets query for [[CadQualificas]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\CadQualificaQuery
     */
    public function getCadQualificas()
    {
        return $this->hasMany(CadQualifica::class, ['unidade_saude_id' => 'cnes']);
    }

    /**
     * Gets query for [[CapacitacaoCads]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\CapacitacaoCadQuery
     */
    public function getCapacitacaoCads()
    {
        return $this->hasMany(CapacitacaoCad::class, ['cnes_unidade' => 'cnes']);
    }

    /**
     * Gets query for [[NepPreceptors]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\NepPreceptorQuery
     */
    public function getNepPreceptors()
    {
        return $this->hasMany(NepPreceptor::class, ['unidade_id' => 'cnes']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\query\UnidadeSaudeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\query\UnidadeSaudeQuery(get_called_class());
    }

    public static function getUnidades(){
        $droptions = UnidadeSaude::find()->orderBy('nome')->all();
        $array = ArrayHelper::map($droptions, 'cnes', 'nome');
        return $array;
    }


    }
 