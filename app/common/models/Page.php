<?php

namespace common\models;

use backend\components\NotifyBehavior;
use common\behaviors\WysiwygFileCleaner;
use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Page extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

    public function behaviors() :array
    {
        return [
            /*      [
                    'class' => DateUpdater::class,
                  ],*/
            [
                'class' => WysiwygFileCleaner::class,
                'attributes' => [
                ],
            ],
            [
                'class' => NotifyBehavior::class,
            ]
        ];
    }
}