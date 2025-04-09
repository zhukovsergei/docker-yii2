<div class="form-group">
  <label class="col-lg-<?=$lg[0]?> control-label"><?=$lf?></label>
  <div class="col-lg-<?=$lg[1]?>">
    <div class="input-group mar-btm">
      <input name="<?=$nf?>" type="password" class="form-control">
      <span class="input-group-btn">
		   <button class="btn btn-info gen-pwd" type="button"><i class="fa fa-barcode"></i></button>
		  </span>
    </div>
    <span class="generated-pwd"></span>
  </div>
</div>

<script>
  function randomPassword(length) {
    var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOP1234567890";
    var pass = "";
    for (var x = 0; x < length; x++) {
      var i = Math.floor(Math.random() * chars.length);
      pass += chars.charAt(i);
    }
    return pass;
  }

  $('.gen-pwd').on('click', function(){
    var pwd = randomPassword(8);
    $('.generated-pwd').text(pwd);
    $('.generated-pwd').parent().find('input').val(pwd);
  });
</script>