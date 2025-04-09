<?php
/* @var $this yii\web\View */
$this->title = 'Frequently Asked Questions';
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
              <div class="form-group">
                <label class="col-lg-2 control-label">Имя</label>
                <div class="col-lg-4">
                  <input name="fd[name]" value="<?=$row->name?>" type="text" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label">E-mail</label>
                <div class="col-lg-4">
                  <input name="fd[email]" value="<?=$row->email?>" type="text" class="form-control">
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label">Question</label>
                <div class="col-lg-6">
                  <textarea name="fd[text]" rows="6" class="form-control"><?=$row->text?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label">Answer</label>
                <div class="col-lg-6">
                  <textarea name="fd[answer]" rows="6" class="form-control"><?=$row->answer?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label"></label>
                <div class="col-lg-4">
                  <div class="checkbox">
                    <label class="form-checkbox form-normal form-primary">
                      <input name="fd[send]" value="1" type="checkbox"> С отправкой</label>
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-lg-2 control-label"></label>
                <div class="col-lg-4">
                  <div class="checkbox">
                    <label class="form-checkbox form-normal form-primary">
                      <input name="fd[approve]" value="1" type="checkbox" <?if($row->approve):?> checked<?endif;?>> Published on website</label>
                  </div>
                </div>
              </div>

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