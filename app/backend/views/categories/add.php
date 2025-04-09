<?php
/* @var $this yii\web\View */
$this->title = 'Categories';

use backend\widgets\fields\File;
use backend\widgets\fields\Text;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

?>
<div id="content-container">

  <div id="page-title">
    <h1 class="page-header text-overflow"><?=$this->title?></h1>
  </div>

  <?=Breadcrumbs::widget([
    'homeLink' => [
      'label' => 'Main',
      'url' => Yii::$app->homeUrl,
    ],
    'links' => [
      ['label' => $this->title, 'url' => ['index']],
      'Создание записи'
    ],
  ]);
  ?>

  <!--Page content-->
  <!--===================================================-->
  <div id="page-content">
    <div class="row">

      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title"><?if(\Yii::$app->controller->action->id === 'add'):?>Creating a new entry<?else:?>Editing the entry<?endif;?></h3>
          </div>

          <!--Input Size-->
          <!--===================================================-->
          <form class="form-horizontal" action="<?=Url::current()?>" method="POST" enctype="multipart/form-data">
            <div class="panel-body">

              <?= Text::widget([
                'lf' => 'Header',
                'nf' => 'fd[name]',
              ])?>

              <div class="form-group">
                <label class="col-lg-2 control-label">Parent</label>
                <div class="col-lg-2">
                  <select name="fd[parent_id]" class="selectpicker" >
                    <?foreach($categories as $cat):?>
                      <option value="<?=$cat->id?>"><?=str_repeat('&#160;&#160;&#160;', $cat->depth)?> <?=Html::encode($cat->name)?></option>
                    <?endforeach;?>
                  </select>
                </div>
                <div class="col-lg-1">
                  <div class="checkbox">
                    <input name="fd[prependTo]" value="0" type="hidden">
                    <label class="form-checkbox form-normal form-primary">
                      <input name="fd[prependTo]" value="1" type="checkbox"> Prepend to
                    </label>
                  </div>
                </div>
              </div>

              <?= File::widget([
                'lf' => 'Image',
                'nf' => 'image',
              ])?>

            </div>
            <div class="panel-footer">
              <div class="row">
                <div class="col-lg-9 col-lg-offset-3">
                  <button class="btn btn-primary btn-labeled fa fa-check" type="submit"><?if( \Yii::$app->controller->action->id === 'add'):?>Create<?else:?>Save<?endif;?></button>
                  <a href="<?=Url::to(['index'])?>" class="btn btn-warning btn-labeled fa fa-repeat" >Cancel</a>
                </div>
              </div>
            </div>
          </form>
          <!--===================================================-->
          <!--End Input Size-->


        </div>
      </div>


    </div>

  </div>
  <!--===================================================-->
  <!--End page content-->
</div>