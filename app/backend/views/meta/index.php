<?php
/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;

$this->title = 'Мета';
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
        <?= GridView::widget([
          'dataProvider' => $dataProvider,
          'columns' => [
            [
//              'attribute' => 'фыв',
              'label' => 'URL',
              'format' => 'raw',
              'value' => function($model){
                $params = Json::decode($model->action_params);
                $params = ArrayHelper::merge([$model->view], $params);
                $url = Yii::$app->urlManager->createUrl($params);
                return Html::a(urldecode($url) , str_replace('cp.', '', \Yii::$app->request->getHostInfo()). $url, ['target' => '_blank']);
              }
            ],
            'title.content:raw:Title',
            'keywords.content:raw:Keywords',
            'description.content:raw:Description',
            [
              'class' => yii\grid\ActionColumn::class,
              'template' => '{update} {delete}'
            ],
          ],
        ]); ?>
      </div>

    </div>
  </div>

</div>