<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Book';
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
            'name',
            [
              'class' => yii\grid\ActionColumn::class,
              'template' => '{update} {delete}',
            ],
          ],
        ]) ?>
      </div>

    </div>
  </div>

</div>