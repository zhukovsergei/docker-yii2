<?php
use JBZoo\Utils\Str;
use yii\helpers\Url;

?>
<div class="form-group">
  <label class="col-lg-<?=$lg[0]?> control-label" for="<?=Str::slug($nf);?>"><?=$lf?></label>
  <div class="col-lg-<?=$lg[1]?>">
    <textarea id="<?=Str::slug($nf);?>" name="<?=$nf?>" rows="6" class="form-control"><?if($val):?><?=$val?><?endif;?></textarea>
    <?if($hint):?>
      <small class="help-block"><?=$hint?></small>
    <?endif;?>
  </div>
</div>
