<?php
use JBZoo\Utils\Str;
use yii\helpers\Url;

backend\assets\Imperavi::register($this);
?>
<!--WYSIWYG-->
<!--===================================================-->
<div class="form-group">
  <label class="col-lg-<?=$colLabel?> control-label"><?=$labelField;?></label>
  <div class="col-lg-<?=$colDiv?>">
    <textarea id="<?=Str::slug($nameField);?>" name="<?=$nameField;?>"><?=$content?></textarea>
  </div>
</div>

<script>
  $(document).ready(function () {
    $('#<?=Str::slug($nameField);?>').redactor({
      lang:'de',
      minHeight: <?=$minHeight;?>,
      uploadImageFields: {
        'mode': 1
      },
      uploadFileFields: {
        'mode': 0
      },
      buttons: ['html', 'formatting', 'bold', 'italic', 'deleted', 'unorderedlist', 'orderedlist', 'outdent', 'indent',
        'image', 'file', 'link', 'alignment', 'horizontalrule'],
      plugins: ['table', 'video', 'fontsize', 'fontfamily', 'fontcolor', 'fullscreen'],

      imageUpload:'<?=Url::to(['WysiwygUpload'])?>',
      fileUpload:'<?=Url::to(['WysiwygUpload'])?>'
    });
  });
</script>
<!--===================================================-->
<!-- WYSIWYG end-->