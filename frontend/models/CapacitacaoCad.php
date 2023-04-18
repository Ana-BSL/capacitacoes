<?php

namespace frontend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "capacitacao_cad".
 *
 * @property int $id_capacitacao
 * @property string $titulo
 * @property string|null $descricao
 * @property int|null $carga_horaria
 * @property string|null $data_realizacao
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property string|null $cnes_unidade
 *
 * @property UnidadeSaude $cnesUnidade
 */
class CapacitacaoCad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'capacitacao_cad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['titulo', 'descricao', 'cnes_unidade'], 'string'],
            [['carga_horaria', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['carga_horaria', 'created_by', 'updated_by'], 'integer'],
            [['data_realizacao', 'created_at', 'updated_at'], 'safe'],
            [['cnes_unidade'], 'exist', 'skipOnError' => true, 'targetClass' => UnidadeSaude::class, 'targetAttribute' => ['cnes_unidade' => 'cnes']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_capacitacao' => 'Id Capacitacao',
            'titulo' => 'Título',
            'descricao' => 'Descrição',
            'carga_horaria' => 'Carga Horária',
            'data_realizacao' => 'Data de Realização',
            'created_at' => 'Criado em',
            'updated_at' => 'Editado em',
            'created_by' => 'Criado por',
            'updated_by' => 'Editado por',
            'cnes_unidade' => 'Unidade',
        ];
    }

    /**
     * Gets query for [[CnesUnidade]].
     *
     * @return \yii\db\ActiveQuery|\frontend\query\UnidadeSaudeQuery
     */
    public function getUnidade()
    {
        return $this->hasOne(UnidadeSaude::class, ['cnes' => 'cnes_unidade']);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\query\CapacitacaoCadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \frontend\query\CapacitacaoCadQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            
            if ($insert) {
                $this->created_by = Yii::$app->user->id;
                $this->created_at = date('Y-m-d H:i:s');
            } else {
                $this->updated_by = Yii::$app->user->id;
                $this->updated_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

    public static function getCapacitacoes(){
        $droptions = CapacitacaoCad::find()->orderBy('titulo')->all();
        $array = ArrayHelper::map($droptions, 'id_capacitacao', 'titulo');
        return $array;
    }

}
