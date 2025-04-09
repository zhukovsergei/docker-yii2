<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;

class Directory extends ActiveRecord
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
}