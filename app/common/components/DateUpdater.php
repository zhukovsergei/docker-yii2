<?php

namespace common\components;

use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class DateUpdater extends TimestampBehavior
{
  public $createdAtAttribute = 'date_add';

  public $updatedAtAttribute = NULL;

  public $value;

  protected function getValue($event)
  {
    if ($this->value instanceof Expression) {
      return $this->value;
    } else {
      return $this->value !== null ? call_user_func($this->value, $event) : date('Y-m-d H:i:s');
    }
  }
}
