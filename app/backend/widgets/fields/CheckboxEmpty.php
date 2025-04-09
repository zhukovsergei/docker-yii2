<?php
namespace backend\widgets\fields;


use yii\base\Widget;

class CheckboxEmpty extends Widget
{
  public $lf;
  public $nf;
  public $val;
  public $hint;

  public $pretty = false;
  public $seo = false;
  public $checked = false;
  public $multiMod = false;

  public $lg = [2, 4];

  public function beforeRun()
  {
    if ( ! parent::beforeRun() ) {
      return false;
    }

    if(empty($this->lf))
    {
      throw new \UnexpectedValueException('Label field must be exists');
    }

    if(empty($this->nf))
    {
      throw new \UnexpectedValueException('Name field must be exists');
    }

    return true;
  }

  public function run()
  {
    return $this->render('checkbox-empty', [
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