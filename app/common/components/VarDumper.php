<?php

namespace common\components;

use yii\helpers\BaseVarDumper;

class VarDumper extends BaseVarDumper
{

  public static function dump($var, $depth = 10, $highlight = TRUE)
  {
    echo static::dumpAsString($var, $depth, $highlight);
  }
}
