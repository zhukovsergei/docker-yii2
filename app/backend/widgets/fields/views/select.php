<div class="form-group">
  <label class="col-lg-<?=$lg[0]?> control-label"><?=$lf?> </label>
  <div class="col-lg-<?=$lg[1]?>">
    <select name="<?=$nf?>" class="selectpicker" data-width="auto" data-live-search="true">
      <?if($notSet):?>
        <option value="0">Not selected</option>
      <?endif;?>
      <?if($source):?>
        <?foreach($source as $k => $v):?>
          <?if(is_object($v)):?>
            <option <?if($val AND $v->id == $val):?>selected<?endif;?> value="<?=$v->id?>"> <?if($depth):?><?=str_repeat('&#160;&#160;&#160;', --$v->depth)?><?endif;?><?=$v->$sourceNameField?></option>
          <?else:?>
            <option <?if($val AND $k == $val):?>selected<?endif;?> value="<?=$k?>"> <?=$v?></option>
          <?endif;?>
        <?endforeach;?>
      <?endif;?>
    </select>
    <small class="help-block"><?=$hint?></small>
  </div>
</div>