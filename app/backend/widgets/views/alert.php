<div class="alert alert-success media fade in">
  <button class="close" data-dismiss="alert" type="button">
    <span><i class="fa fa-times-circle"></i></span></button>

  <div class="media-left">
    <span class="icon-wrap icon-wrap-xs icon-circle alert-icon">
      <i class="fa fa-bolt fa-lg"></i>
    </span>
  </div>
  <div class="media-body">
    <h4 class="alert-title">System message</h4>
    <p class="alert-message"><?=\Yii::$app->session->getFlash('msg')?></p>
  </div>
</div>