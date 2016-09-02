<?php

namespace common\models;

use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 *
 * 
 * @property string $created_at
 * @property string $updated_at
 */
class BaseModel extends ActiveRecord
{
    


      public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                 'value' => new Expression('NOW()'),
            ],
            [
                      'class' => BlameableBehavior::className(),
                      'createdByAttribute' => 'created_by',
                      'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

   
    
}
