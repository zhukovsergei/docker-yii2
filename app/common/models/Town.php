<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;

class Town extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

    public function behaviors() :array
    {
        return [
            [
                'class' => NotifyBehavior::class,
            ]
        ];
    }

    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }

}