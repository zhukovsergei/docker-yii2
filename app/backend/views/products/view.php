<?php
/* @var $this yii\web\View */
$this->title = 'Items';
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
            <h3 class="panel-title">Просмотр объявления</h3>
          </div>

          <!--Input Size-->
          <!--===================================================-->
          <div class="panel-body">
          <?=DetailView::widget([
            'model' => $row,
            'attributes' => [
              'name',               // title attribute (in plain text)
              'long_text:html',    // description attribute formatted as HTML
              /*[                      // the owner name of the model
                'label' => 'Owner',
                'value' => $model->owner->name,
              ],*/
              'date_add:datetime', // creation date formatted as datetime
            ],
          ]);?>
          </div>
          <div class="panel-footer">
            <div class="row">
              <div class="col-lg-9 col-lg-offset-3">
                <a href="/<?=Yii::$app->controller->id?>" class="btn btn-warning btn-labeled fa fa-check" >OK</a>
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