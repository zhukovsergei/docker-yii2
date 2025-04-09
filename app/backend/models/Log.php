<?php

namespace backend\models;

use yii\db\ActiveRecord;
use common\components\DateUpdater;

class Log extends ActiveRecord
{

  public function behaviors()
  {
    return [
      'timestamp' => [
        'class' => DateUpdater::class,
//        'updatedAtAttribute' => 'date_upd'
      ],
    ];
  }

  public function rules($className=__CLASS__)
  {
    return [
      [ $className::getTableSchema()->getColumnNames(), 'safe' ],
    ];
  }
}