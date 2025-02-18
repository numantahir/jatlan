<?php 
include_once(ACTION_PATH.'verification.php');
list($Mob_no,$Usr_id)= explode(',', $objBF->decrypt($_GET['vi'], ENCRYPTION_KEY));
//echo $objBF->decrypt($_GET['vi'], ENCRYPTION_KEY);
//die();
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_mobile", trim($objBF->decrypt($_GET['vi'], ENCRYPTION_KEY)));
$objQayaduser->lstUsers();
$GetShortCode = $objQayaduser->dbFetchArray(1);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo SITE_URL;?>/assets<?php echo $CallMenuBarAndHeader;?>/img/apple-icon.png" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title><?php echo $objCommon->getConfigValue($MetaTitle);?></title>
<meta name="description" content="<?php echo $objCommon->getConfigValue($MetaDesc);?>" />
<meta name="keywords" content="<?php echo $objCommon->getConfigValue($MetaKeywords);?>" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<link rel="shortcut icon" href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/qayad_fav.ico">
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/material-dashboard23cd.css?v=1.2.1" rel="stylesheet" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/Qayad.css" rel="stylesheet" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
.card .card-content {
	min-height: auto !important;
}
</style>
</head>

<body class="off-canvas-sidebar  authentication-bg authentication-bg-pattern">

<div class="wrapper wrapper-full-page">
  <div class="full-page login-page" filter-color="black">
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
            <form method="post" action="" name="frmlogin" id="frmlogin">
              <input type="hidden" name="vi" value="<?php echo $_GET["vi"];?>">
              <!--<div class="card card-login card-hidden bg-pattern">-->
              <div class="card card-login card-hidden">
                <p class="category text-center"> <a href="<?php echo SITE_URL;?>"> <span><img src="<?php echo SITE_URL;?>assets_ig/img/qayad-logo.png" alt="" height="150"></span> </a> </p>
                <div class="card-content"> <span style="color:#F00">
                  <center>
                    <?php echo $vResult['invalid_login'];?>
                  </center>
                  </span>
                  <div class="input-group"> <span class="input-group-addon"> <!--<i class="material-icons">code</i>--> </span>
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'short_code');?>">
                      <label class="control-label">Code</label>
                      <input type="number" name="short_code" id="short_code" class="form-control" value="<?php echo $GetShortCode["short_code"];?>" required>
                      <small><?php echo $vResult["short_code"];?></small> </div>
                  </div>
                  <div class="input-group"> </div>
                </div>
                <div class="footer text-center">
                  <button type="submit" class="btn btn-rose btn-simple btn-wd btn-lg">Let's go</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</body>
<!--   Core JS Files   -->
<script src="<?php echo SITE_URL;?>assets_js/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/material.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/perfect-scrollbar.jquery.min.js" type="text/javascript"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jquery.validate.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/bootstrap-notify.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/material-dashboard23cd.js?v=1.2.1"></script>
<script src="<?php echo SITE_URL;?>assets_js/js/Qayad.js"></script>
<script type="text/javascript">
    $().ready(function() {
        demo.checkFullPageBackgroundImage();
		<?php echo $objCommon->displayMessage_js(); ?>
        setTimeout(function() {
            $('.card').removeClass('card-hidden');
        }, 700)
    });
</script>
</html>