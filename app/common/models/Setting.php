<?php

namespace common\models;

use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Setting extends \pheme\settings\models\Setting
{
    use FreeRules;
    use AssociateLabels;

    public function behaviors() :array
    {
        return [];
    }
}