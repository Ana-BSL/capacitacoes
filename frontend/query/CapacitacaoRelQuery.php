<?php

namespace frontend\query;

/**
 * This is the ActiveQuery class for [[\frontend\models\CapacitacaoRel]].
 *
 * @see \frontend\models\CapacitacaoRel
 */
class CapacitacaoRelQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \frontend\models\CapacitacaoRel[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \frontend\models\CapacitacaoRel|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
