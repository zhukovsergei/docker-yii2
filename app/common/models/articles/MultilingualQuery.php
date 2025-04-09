<?php


namespace common\models\articles;

use omgdef\multilingual\MultilingualTrait;
use yii\db\ActiveQuery;

class MultilingualQuery extends ActiveQuery
{
    use MultilingualTrait;
}