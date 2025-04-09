<div id="container" class="cls-container">
  <div id="bg-overlay" class="bg-img img-balloon" style="background-image: url(/img/bg-img/bg-img-3.jpg);"></div>

  <div class="cls-header cls-header-lg">
    <div class="cls-brand">
      <a class="box-inline" href="#">
        <!-- <img alt="Nifty Admin" src="img/logo.png" class="brand-icon"> -->
        <span class="brand-title">Control <span class="text-thin">panel</span></span>
      </a>
    </div>
  </div>

  <div class="cls-content">
    <div id="auth-ready-panel" class="cls-content-sm panel" <?if(!$noAccounts):?>style="display: none"<?endif;?>>
      <div class="panel-body">
        <p class="pad-btm">Authorization</p>
        <form action="<?=\yii\helpers\Url::to('/auth/login')?>" method="post">
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-user"></i></div>
              <input name="fd[email]" type="text" class="form-control" placeholder="Login">
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-asterisk"></i></div>
              <input name="fd[password]"  type="password" class="form-control" placeholder="Password">
            </div>
          </div>
          <div class="row">
            <div class="col-xs-8 text-left checkbox">
              <label class="form-checkbox form-icon">
                <input name="fd[remember]" value="1" checked type="checkbox"> Remember me (7 days)
              </label>
            </div>
            <div class="col-xs-4">
              <div class="form-group text-right">
                <button class="btn btn-success text-uppercase" type="submit">Login</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <?if(!$noAccounts):?>
      <div id="no-account-panel" class="cls-content-sm panel">
        <div class="panel-body">
          <p class="pad-btm">This is <b>the first</b> auth into CP. Need to generate an account.</p>
          <div class="form-group">
            <div class="input-group">
              <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
              <input name="email" value="triemli@fdsgn.ch" type="text" class="form-control" placeholder="Login">
            </div>
          </div>
          <div class="row">
            <div class="form-group">
              <button id="let-generate-account" class="btn btn-success text-uppercase">Create account</button>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(function(){
          $('#let-generate-account').on('click', function(){
            $('#auth-ready-panel .panel-body').prepend( "<p>Account have been created, check the <b>e-mail</b></p>" );

            $('#no-account-panel').fadeOut(400, function(){
              $('#auth-ready-panel').fadeIn(400);
            });

            $.ajax({
              type: 'POST',
              url : '<?=\yii\helpers\Url::to(['gen-first-account'])?>',
              data: {
                'email':  $('#no-account-panel input[name="email"]').val()
              },
              dataType: 'json'
            });
          });
        })
      </script>
    <?endif;?>
    <div class="pad-ver">
      <a href="https://berta-digital.ch" class="btn-link mar-ctr" target="_blank">© Sergei ZHukov</a>
    </div>
  </div>
</div>

