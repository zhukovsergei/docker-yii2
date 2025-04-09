<?php
/* @var $this yii\web\View */
$this->title = 'Мета';
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use backend\widgets\fields\Text;

?>

<div id="content-container">

    <?php echo backend\widgets\Alert::widget()?>

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
<!--            <h3 class="panel-title">--><?//if(\Yii::$app->controller->action->id === 'add'):?><!--Creating a new entry--><?//else:?><!--Editing the entry--><?//endif;?><!--</h3>-->
          </div>

          <!--Input Size-->
          <!--===================================================-->
          <form class="form-horizontal" action="<?=Url::current()?>" method="POST" enctype="multipart/form-data">
            <div class="panel-body">

              <?= Text::widget([
                'lf' => 'title',
                'nf' => 'fd[title]',
                'val' => $rows[0]['content'] ?? '',
              ])?>

              <?= Text::widget([
                'lf' => 'description',
                'nf' => 'fd[description]',
                'val' => $rows[1]['content'] ?? '',
              ])?>

              <?= Text::widget([
                'lf' => 'keywords',
                'nf' => 'fd[keywords]',
                'val' => $rows[2]['content'] ?? '',
              ])?>

              <input type="hidden" name="id" value="<?=\Yii::$app->request->get('id')?>">
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