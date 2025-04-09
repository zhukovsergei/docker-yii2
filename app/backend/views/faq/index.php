<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Frequently Asked Questions';
?>
<div id="content-container">

  <?php echo backend\widgets\Alert::widget()?>

  <div id="page-title">
    <h1 class="page-header text-overflow"><?=$this->title?></h1>
  </div>

  <div id="page-content">

    <div class="panel">
      <div class="panel-heading">
        <div class="panel-control">
          <a href="<?=Url::to(['add'])?>" class="btn btn-primary btn-labeled fa fa-plus"> Add a new entry</a>
        </div>
        <h3 class="panel-title">All entries</h3>
      </div>

      <div class="panel-body">
        <?= yii\grid\GridView::widget([
          'dataProvider' => $dataProvider,
          'columns' => [
            'id',
            [
              'attribute' => 'date_add',
              'format' => ['date', 'php:d F Y в H:i']
            ],
            'text',
            /*[
              'attribute' => 'approve',
              'value' => function($row){
                return ($row->approve) ? 'Yes' : 'No';
              }
            ],*/
            [
              'class' => yii\grid\ActionColumn::class,
              'template' => '{update} {delete}',
              'buttons' => [
                'approve' => function ($url, $model) {
                  return '';
                },
              ],
            ],


          ],
        ]) ?>
      </div>

    </div>
  </div>

</div>