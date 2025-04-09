<?php
namespace backend\widgets\fields;

class Text extends ExtendWidget
{
  public $ph;
  public $date = false;
  public $datetime = false;

  public $lg = [2, 4];

  public function init()
  {
    parent::init();

    if($this->nf === 'fd[date_add]' || $this->nf === 'fd[date_pub]' || $this->nf === 'fd[num]')
    {
      $this->lg = [2,1];
    }
  }

  public function run()
  {
    return $this->render('text', [
      'lf' => $this->lf,
      'nf' => $this->nf,
      'hint' => $this->hint,
      'val' => $this->val,
      'ph' => $this->ph,
      'date' => $this->date,
      'datetime' => $this->datetime,

      'lg' => $this->lg,
    ]);
  }
}