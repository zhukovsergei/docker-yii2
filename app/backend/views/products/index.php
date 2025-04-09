<?php
/* @var $this yii\web\View */
$this->title = 'Items';
use yii\helpers\Html;
use yii\helpers\Url;
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
          <a href="/<?=Yii::$app->controller->id?>" class="btn btn-warning btn-labeled fa fa-repeat">Reset filters</a>
          <a href="<?=Url::to(['add'])?>" class="btn btn-primary btn-labeled fa fa-plus">Add a new entry</a>
        </div>
        <h3 class="panel-title">All entries </h3>
      </div>

      <div class="panel-body">
        <?= yii\grid\GridView::widget([
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
            'id',
            [
              'attribute' => 'date_add',
              'format' => ['date', 'php:d F Y в H:i'],
              'filter' => false
            ],
            [
              'attribute' => 'thumb',
              'format' => 'raw',
              'value' => function($data){
                return Html::img($data->getThumbFileUrl('image'));
              },
              'filter' => false
            ],
            [
              'class' => yii\grid\DataColumn::class, // this line is optional
              'attribute' => 'name',
              'format' => 'text',
              'value' => function ($row) {
                return $row->name; // $data['name'] for array data, e.g. using SqlDataProvider.
              },
            ],
            [
              'attribute' => 'category_id',
              'value' => 'category.name',
            ],
            'price',
            'qt',
            [
              'attribute' => 'is_rec',
              'value' => function($row){
                return ($row->is_rec) ? 'Yes' : 'No';
              },
              'filter' => [0 => 'No', 1 => 'Yes']
            ],
            [
              'class' => yii\grid\ActionColumn::class,
            ],
          ],
        ]) ?>
      </div>
    </div>
  </div>

</div>