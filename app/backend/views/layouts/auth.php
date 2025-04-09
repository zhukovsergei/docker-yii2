<?php
use yii\helpers\Html;

backend\assets\AuthAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
  <meta charset="<?= Yii::$app->charset ?>">
  <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
  <?= Html::csrfMetaTags() ?>
  <title>Control panel</title>
  <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<?=$content;?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
