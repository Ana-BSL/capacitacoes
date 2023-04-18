<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "capacitacao_rel".
 *
 * @property int $id_espectador
 * @property int $id_capacitacao
 * @property int $id
 *
 * @property CapacitacaoCad $capacitacao
 * @property CapacitacaoEspec $espectador
 */
class CapacitacaoRel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'capacitacao_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_espectador', 'id_capacitacao'], 'required'],
            [['id_espectador', 'id_capacitacao'], 'default', 'value' => null],
            [['id_espectador', 'id_capacitacao'], 'integer'],
            [['id_capacitacao'], 'exist', 'skipOnError' => true, 'targetClass' => CapacitacaoCad::class, 'targetAttribute' => ['id_capacitacao' => 'id_capacitacao']],
            [['id_espectador'], 'exist', 'skipOnError' => true, 'targetClass' => CapacitacaoEspec::class, 'targetAttribute' => ['id_espectador' => 'id_espectador']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_espectador' => 'Espectador',
            'id_capacitacao' => 'Capacitacao',
            'id' => 'ID',
        ];
    }

    /**
     * Gets query for [[Capacitacao]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\CapacitacaoCadQuery
     */
    public function getCapacitacao()
    {
        return $this->hasOne(CapacitacaoCad::class, ['id_capacitacao' => 'id_capacitacao']);
    }

    /**
     * Gets query for [[Espectador]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\CapacitacaoEspecQuery
     */
    public function getEspectador()
    {
        return $this->hasOne(CapacitacaoEspec::class, ['id_espectador' => 'id_espectador']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\query\CapacitacaoRelQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\query\CapacitacaoRelQuery(get_called_class());
    }

    
}
