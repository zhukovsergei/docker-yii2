<?php

namespace common\models;

use creocoder\nestedsets\NestedSetsQueryBehavior;
use yii\db\ActiveQuery;

class CategoryQuery extends ActiveQuery
{
    public function init()
    {
        $this->orderBy('lft');
        parent::init();
    }

    public function behaviors() :array
    {
        return [
            NestedSetsQueryBehavior::class,
        ];
    }
}
