<?php
use JBZoo\Utils\Str;

?>

<div class="form-group">
  <label class="col-lg-<?=$lg[0]?> control-label" for="<?=Str::slug($nf);?>"><?=$lf?></label>
  <div class="col-lg-<?=$lg[1]?>">
    <?if($date || $datetime):?>

      <?if($date):?>
    <input class="form-control" id="<?=Str::slug($nf);?>" name="<?=$nf?>" type="text" <?if($val):?>value="<?=(new \DateTime($val))->format('Y-m-d')?>"<?endif;?>>

      <script>
        $(function () {
          $.datetimepicker.setLocale('de');
          $('#<?=Str::slug($nf);?>').datetimepicker({
            format: 'Y-m-d',
            timepicker: false
          });
        });
      </script>
    <?endif;?>

    <?if($datetime):?>
    <input class="form-control" id="<?=Str::slug($nf);?>" name="<?=$nf?>" type="text" <?if($val):?>value="<?=(new \DateTime($val))->format('Y-m-d H:i')?>"<?endif;?>>

      <script>
        $(function () {
          $.datetimepicker.setLocale('de');
          $('#<?=Str::slug($nf);?>').datetimepicker({
            format: 'Y-m-d H:i'
          });
        });
      </script>
    <?endif;?>

    <?else:?>
    <input id="<?=Str::slug($nf);?>" name="<?=$nf?>" <?if($val):?>value="<?=\yii\helpers\Html::encode($val)?>"<?endif;?> <?if($ph):?>placeholder="<?=$ph?>"<?endif;?>type="text" class="form-control">
    <?endif;?>
    <?if($hint):?>
      <small class="help-block"><?=$hint?></small>
    <?endif;?>
  </div>
</div>

