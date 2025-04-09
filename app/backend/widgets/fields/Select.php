<?php
namespace backend\widgets\fields;

class Select extends ExtendWidget
{
  public $source = null;
  public $sourceNameField = 'name';
  public $notSet = false;
  public $depth = false;

  public $lg = [2, 3];


  public function run()
  {
    return $this->render('select', [
      'lf' => $this->lf,
      'nf' => $this->nf,
      'hint' => $this->hint,
      'val' => $this->val,
      'source' => $this->source,
      'sourceNameField' => $this->sourceNameField,
      'notSet' => $this->notSet,
      'depth' => $this->depth,

      'lg' => $this->lg,
    ]);
  }
}