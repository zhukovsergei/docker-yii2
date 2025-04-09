<?php
namespace backend\widgets\fields;

class Textarea extends ExtendWidget
{
  public $lg = [2, 9];

  public function run()
  {
    return $this->render('textarea', [
      'lf' => $this->lf,
      'nf' => $this->nf,
      'hint' => $this->hint,
      'val' => $this->val,
      'lg' => $this->lg,
    ]);
  }
}