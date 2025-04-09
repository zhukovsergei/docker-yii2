<?php

namespace common\models\articles;

use common\traits\AssociateLabels;
use common\traits\FreeRules;
use yii\db\ActiveRecord;

class ArticleLang extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;

    public static function tableName() :string
    {
        return '{{%article_lang}}';
    }
}