<?php

namespace frontend\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\CapacitacaoCad]].
 *
 * @see \frontend\models\CapacitacaoCad
 */
class CapacitacaoCadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\CapacitacaoCad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\CapacitacaoCad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
