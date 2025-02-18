<?php include_once(ACTION_PATH.'script.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<meta name="viewport" content="width=device-width" />
<title><?php echo $objCommon->getConfigValue($MetaTitle);?></title>
<meta name="description" content="<?php echo $objCommon->getConfigValue($MetaDesc);?>" />
<meta name="keywords" content="<?php echo $objCommon->getConfigValue($MetaKeywords);?>" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/bootstrap.min.css" rel="stylesheet" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/material-dashboard23cd.css?v=1.3.1" rel="stylesheet" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/Qayad.min.css" rel="stylesheet" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/css/font-awesome.min.css" rel="stylesheet">
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/libs/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/libs/datatables/responsive.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/libs/datatables/buttons.bootstrap4.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/libs/datatables/select.bootstrap4.css" rel="stylesheet" type="text/css" />

<link rel="shortcut icon" href="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/favicon.png">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!--<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons" />

<link href="https://fonts.googleapis.com/css?family=Raleway:500" rel="stylesheet">-->
</head>
<body>
<div class="wrapper">