<?php
/* @var $this yii\web\View */
$this->title = 'Static pages';
use backend\widgets\fields\Checkbox;
use backend\widgets\fields\Text;
use backend\widgets\fields\Textarea;
use backend\widgets\fields\TextareaReach;
use backend\widgets\fields\TextareaReachi;
use yii\helpers\Url;
?>
<div id="content-container">

    <?php echo backend\widgets\Alert::widget()?>

    <div id="page-title">
    <h1 class="page-header text-overflow"><?=$this->title?></h1>
  </div>

  <!--Page content-->
  <!--===================================================-->
  <div id="page-content">
    <div class="row">
      <form action="<?=Url::current()?>" method="post" enctype="multipart/form-data">
        <div class="col-lg-12">
          <div class="tab-base">

            <!--Nav Tabs-->
            <ul class="nav nav-tabs">
              <li class="active">
                <a data-toggle="tab" href="#demo-lft-tab-1" aria-expanded="true">General</a>
              </li>
              <!--<li class="">
                <a data-toggle="tab" href="#demo-lft-tab-2" aria-expanded="false">SEO-оптимизация</a>
              </li>-->
            </ul>

            <!--Tabs Content-->
            <div class="tab-content">
              <div id="demo-lft-tab-1" class="tab-pane fade active in">
                <div class="panel-body form-horizontal form-padding">

                  <?= Text::widget([
                    'model' => $row,
                    'lf' => 'Header',
                    'nf' => 'fd[name]',
                  ])?>

                  <?= TextareaReachi::widget([
                      'model' => $row,
                      'lf' => 'Content',
                      'nf' => 'fd[text]',
                  ])?>

                </div>
                <!--<button class="btn btn-primary btn-labeled fa fa-floppy-o">Сохранить изменения</button>-->
              </div>
              <!--<div id="demo-lft-tab-2" class="tab-pane fade">
                <div class="panel-body form-horizontal form-padding">

                  <?/*= Text::widget([
                    'lf' => 'Метатег &lt;title&gt;',
                    'nf' => 'fd[title]',
                    'val' => $row->title,
                  ])*/?>

                </div>
              </div>-->
            </div>
            <div class="panel-footer text-right">
              <button class="btn btn-info btn-primary btn-labeled fa fa-floppy-o" type="submit">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>

  </div>
  <!--===================================================-->
  <!--End page content-->
</div>