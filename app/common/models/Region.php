<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;

class Region extends ActiveRecord
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

    public function getTowns()
    {
        return $this->hasMany(Town::class, ['region_id' => 'id']);
    }

}