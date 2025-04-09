<?php
namespace backend\widgets;

use yii\base\Widget;

class WYSIWYG extends Widget
{
  public $labelField = 'Содержание';
  public $nameField = 'fd[text]';

  public $minHeight = 400;
  public $colLabel = 2;
  public $colDiv = 9;

  public $content;

  public function init()
  {
    parent::init();

  }
  public function run()
  {
    return $this->render('wysiwyg', [
      'labelField' => $this->labelField,
      'nameField' => $this->nameField,

      'minHeight' => $this->minHeight,
      'colLabel' => $this->colLabel,
      'colDiv' => $this->colDiv,

      'content' => $this->content
    ]);
  }
}