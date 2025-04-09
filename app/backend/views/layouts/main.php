<?php
use yii\helpers\Html;

backend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />
    <style>
        #container {opacity: 1 !important;}
    </style>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div id="container" class="effect mainnav-lg">

    <?= backend\widgets\Header::widget()?>

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <?php echo $content; ?>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->

        <?= backend\widgets\Sidebar::widget() ?>

        <?= backend\widgets\Aside::widget()?>

    </div>

    <?= backend\widgets\Footer::widget()?>

    <!-- SCROLL TOP BUTTON -->
    <!--===================================================-->
    <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
