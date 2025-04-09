<?php

namespace common\traits;

trait AssociateLabels
{
  public function attributeLabels()
  {
    $labels = [];
    foreach(self::getTableSchema()->columns as $column)
    {
      if(!empty($column->comment))
      {
          $labels[$column->name] = $column->comment;
      }
    }

    return $labels;
  }
}