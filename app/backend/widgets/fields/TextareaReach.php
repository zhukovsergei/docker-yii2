<?php
namespace backend\widgets\fields;

class TextareaReach extends ExtendWidget
{
  public $lg = [2, 9];
  public $height = 400;

  public function run()
  {
    return $this->render('textarea-reach', [
      'lf' => $this->lf,
      'nf' => $this->nf,
      'hint' => $this->hint,
      'val' => $this->val,
      'lg' => $this->lg,
      'height' => $this->height,
    ]);
  }
}