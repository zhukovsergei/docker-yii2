<?php

namespace common\models;

use common\traits\AssociateLabels;
use common\traits\FreeRules;
use common\traits\ImagePathGenerator;
use yii\db\ActiveRecord;

class ProductsImages extends ActiveRecord
{
    use FreeRules;
    use AssociateLabels;
    use ImagePathGenerator;

    public function getProduct()
    {
        return $this->hasOne(Products::class, ['id' => 'product_id']);
    }
}