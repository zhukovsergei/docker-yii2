<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
  <?= Html::csrfMetaTags() ?>
  <?if( ! empty(\Yii::$app->seo->block('title')) ):?>
    <title><?= Html::encode(\Yii::$app->seo->block('title')) ?></title>
  <?else:?>
    <title><?= Html::encode($this->title) ?></title>
  <?endif;?>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= frontend\widgets\Header::widget()?>

<?=$content?>

<?= frontend\widgets\Footer::widget()?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
