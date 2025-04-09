<?php
/* @var $this yii\web\View */
$this->title = 'Мета';

use backend\widgets\fields\Checkbox;
use backend\widgets\fields\File;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use backend\widgets\fields\Text;
use backend\widgets\fields\Textarea;

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
    'Editing the entry'
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