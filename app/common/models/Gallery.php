<?php

namespace common\models;

use common\traits\FreeRules;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Gallery extends ActiveRecord
{
    use FreeRules;

    public function behaviors() :array
    {
        return [
            [
                'class' => DateUpdater::class
            ],
        ];
    }
}