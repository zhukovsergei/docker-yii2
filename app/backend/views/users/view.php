<?php
/* @var $this yii\web\View */
$this->title = 'Users';
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
?>
<div id="content-container">

  <?php echo backend\widgets\Alert::widget()?>

  <div id="page-title">
    <h1 class="page-header text-overflow"><?=$this->title?></h1>
  </div>

  <div id="page-content">
    <div class="row">

      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">View data</h3>
          </div>

          <!--Input Size-->
          <!--===================================================-->
          <div class="panel-body">
            <?=DetailView::widget([
              'model' => $row,
              'attributes' => [
                'username',
                'email',
              ],
            ]);?>
          </div>

          <div class="panel-footer">
            <div class="row">
              <div class="col-lg-4 col-lg-offset-2">
                <a href="<?=Url::to(['index'])?>" class="btn btn-primary btn-labeled fa fa-check">OK</a>
              </div>
            </div>
          </div>
          <!--===================================================-->
          <!--End Input Size-->


        </div>
      </div>


    </div>

  </div>

</div>