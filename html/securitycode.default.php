<?php
/*
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", trim(DecData($objCheckLogin->user_id, 1, $objBF)));
$objQayaduser->checkUserSecurityCode();
$SecurityCode = $objQayaduser->dbFetchArray(1);
echo trim(DecData($SecurityCode["user_security_code"], 1, $objBF));
die(); */
?><div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="margin-top:10%;">
        <form method="post" action="" name="frmlogin" id="frmlogin">
          <div class="card card-login card-hidden">
            <div class="card-header text-center">
              <h4 class="card-title">Security Code</h4>
            </div>
            <p class="category text-center"> </p>
            <div class="card-content">
              <div class="input-group"> </div>
              <div class="input-group"> <span class="input-group-addon"> <i class="material-icons">lock_outline</i> </span>
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_security_code');?>">
                  <label class="control-label">Security Code</label>
                  <input type="password" name="user_security_code" id="user_security_code" class="form-control" required>
                  <small><?php echo $vResult["user_security_code"];?></small> </div>
              </div>
              <div class="input-group"> <span class="input-group-addon"></span>
                <div class="form-group label-floating" style="text-align:left; font-size:small"> <code><a href="<?php echo Route::_('show=securitycode&mode=csd');?>">Create/Forgot Security Code</a></code> </div>
              </div>
            </div>
            <div class="footer text-center">
              <button type="submit" class="btn btn-rose btn-fill">Let's go</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
