<?php
namespace backend\widgets\fields;

class TextareaReachi extends ExtendWidget
{
  public $lg = [2, 9];
  public $height = 400;

  public function run()
  {
    return $this->render('textarea-reach-i', [
      'lf' => $this->lf,
      'nf' => $this->nf,
      'hint' => $this->hint,
      'val' => $this->val,
      'lg' => $this->lg,
      'height' => $this->height,
    ]);
  }
}