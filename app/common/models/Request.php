<?php

namespace common\models;

use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Request extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

    public function behaviors() :array
    {
        return [
            'timestamp' => [
                'class' => DateUpdater::class,
            ],
        ];
    }
}