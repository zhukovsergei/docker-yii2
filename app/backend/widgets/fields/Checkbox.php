<?php
namespace backend\widgets\fields;

class Checkbox extends ExtendWidget
{
  public $pretty = false;
  public $seo = false;
  public $checked = false;
  public $multiMod = false;

  public $lg = [2, 4];

  public function run()
  {
    return $this->render('checkbox', [
      'lf' => $this->lf,
      'nf' => $this->nf,
      'hint' => $this->hint,
      'val' => $this->val,
      'pretty' => $this->pretty,
      'checked' => $this->checked,
      'multiMod' => $this->multiMod,

      'lg' => $this->lg,
    ]);
  }
}