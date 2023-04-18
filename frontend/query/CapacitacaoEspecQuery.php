<?php

namespace frontend\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\CapacitacaoEspec]].
 *
 * @see \frontend\models\CapacitacaoEspec
 */
class CapacitacaoEspecQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\CapacitacaoEspec[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\CapacitacaoEspec|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
