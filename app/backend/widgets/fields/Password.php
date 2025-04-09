<?php
namespace backend\widgets\fields;

use yii\base\Widget;

class Password extends Widget
{
  public $model;
  public $lf = 'Password';
  public $nf = 'fd[password]';

  public $lg = [2, 4];

  public function run()
  {
    return $this->render('password', [
      'lf' => $this->lf,
      'nf' => $this->nf,
      'lg' => $this->lg,
    ]);
  }
}