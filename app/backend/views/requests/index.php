<?php
/* @var $this yii\web\View */
$this->title = 'Applications';
?>
<div id="content-container">

  <?php echo backend\widgets\Alert::widget()?>

  <div id="page-title">
    <h1 class="page-header text-overflow"> <?=$this->title?> </h1>
  </div>

  <div id="page-content">

    <div class="panel">
      <div class="panel-heading">
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
            'name',
            'phone',
            'email',
            [
              'class' => yii\grid\ActionColumn::class,
              'template' => '{approve} {delete}',
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