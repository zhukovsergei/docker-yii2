<?php
/* @var $this yii\web\View */
$this->title = 'Categories';
use yii\helpers\Url;

\backend\assets\Category::register($this);
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
        <div class="panel-body">
          <?= yii\grid\GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
              'id',
              'name',
              [
                'format' => 'html',
                'attribute' => 'column',
                'label' => 'Владелец',
                'value' => function($row) {
                  if(isset($row->parents(1)->one()->root) && $row->parents(1)->one()->root)
                    return '<span class="label label-table label-default">Корневая</span>';
                  else
                    return $row->parents(1)->one()->name;
                }
              ],
              [
                'class' => yii\grid\ActionColumn::class,
                'template' => '{update} {delete}',
              ],


            ],
          ]) ?>
        </div>

      </div>

    </div>

    <?=backend\widgets\categories\Tree::widget()?>

  </div>

  <?=backend\widgets\categories\Sortable::widget()?>

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->

