<div class="form-group">
  <input type='hidden' value='0' name='<?=$nf?>'>

  <label class="col-lg-<?=$lg[0]?> control-label"><?if($pretty):?><?=$lf?><?endif;?></label>
  <div class="col-lg-<?=$lg[1]?>">
    <?if($pretty):?>
      <input name="<?=$nf?>" <?if(!empty($val)):?>checked<?endif;?> <?if($pretty):?>class="nicePrettyCheckbox"<?endif;?> value="<?=$val?>" type="checkbox">
    <?else:?>
      <div class="checkbox">
        <label class="form-checkbox form-normal form-primary">
          <?if($multiMod):?>
            <input name="<?=$nf?>" <?if($checked):?>checked<?endif;?> <?if($pretty):?>class="nicePrettyCheckbox"<?endif;?> value="<?=$val?>" type="checkbox"> <?=$lf?>
          <?else:?>
            <input name="<?=$nf?>" <?if(!empty($val)):?>checked<?endif;?> <?if(!empty($val)):?>value="<?=$val?>"<?else:?>value="1"<?endif;?> type="checkbox"> <?=$lf?>
          <?endif;?>
        </label>
      </div>
    <?endif;?>

    <?if($hint):?>
      <small class="help-block"><?=$hint?></small>
    <?endif;?>
  </div>
</div>

