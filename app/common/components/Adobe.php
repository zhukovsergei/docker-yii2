<?php
namespace common\components;

use JBZoo\Utils\Str;
use Yii;

class Adobe
{
  public static function genName($fname, $dot = '.')
  {
    return substr(md5(microtime()), 24). '-' . Str::slug($fname) . $dot;
  }

  public static function cuteDate($date)
  {
    $today = date('d.m.Y', time());
    $yesterday = date('d.m.Y', time() - 86400);
    $dbDate = date('d.m.Y', strtotime($date));
    $dbTime = date('H:i', strtotime($date));
    switch ($dbDate)
    {
      case $today : $output = 'Сегодня в '. $dbTime; break;
      case $yesterday : $output = 'Вчера в '. $dbTime; break;
      default : $output = $dbDate;
    }
    return $output;
  }
}