<?php

namespace common\traits;

trait ImagePathGenerator
{
  public function getImagePath($field = 'image')
  {
    return !empty($this->{$field}) ? \Yii::getAlias('@upl/'.$this->{$field}) : null;
  }
}