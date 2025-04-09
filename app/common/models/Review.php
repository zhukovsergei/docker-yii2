<?php

namespace common\models;

use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Review extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

    public function behaviors() :array
    {
        return [
            'timestamp' => [
                'class' => DateUpdater::class,
                //        'updatedAtAttribute' => 'date_upd',
            ],
        ];
    }
}