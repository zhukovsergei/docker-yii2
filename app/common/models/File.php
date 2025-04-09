<?php

namespace common\models;

use common\traits\AssociateLabels;
use yii\db\ActiveRecord;

class File extends ActiveRecord
{
    use AssociateLabels;
}