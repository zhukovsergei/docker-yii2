<?php

namespace backend\models;

use yii\db\ActiveRecord;

class Settings extends ActiveRecord
{
  public function rules($className=__CLASS__)
  {
    return [
      [ $className::getTableSchema()->getColumnNames(), 'safe' ],
    ];
  }
}