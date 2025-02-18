<?php 
$objSiteChecker = new Common;

if($objSiteChecker->getConfigValue("site_maintenance") == "yes"){
include_once(HTML_PATH . 'site_maintenance.php');
} else {
$objCheckLogin		= new Qayaduser;
if($objCheckLogin->checkLogin() == false){

if($objCheckLogin->checkLogin() == false && $_GET['show']==''){
include_once(HTML_PATH . 'login.php');
} elseif($_GET['show']=='verification' && $objCheckLogin->checkLogin() == false){
include_once(HTML_PATH . 'verification.php');
} elseif($_GET['show']=='forgot' && $objCheckLogin->checkLogin() == false){
include_once(HTML_PATH . 'forgot.php');
} else {
include_once(HTML_PATH . 'login.php');
}
} else {
if($_GET['show'] == 'print'){
$inc_page = getPage($_GET['show']);
include_once($inc_page);
} elseif($_GET['show'] == 'printreport'){
$inc_page = getPage($_GET['show']);
include_once($inc_page);
} elseif($_GET['show'] == 'newappregjoint'){
include_once(INC_PATH . 'header.php');
$inc_page = getPage($_GET['show']);
include_once($inc_page);
include_once(INC_PATH . 'footer.php');
} else {
include_once(INC_PATH . 'header.php');
include_once(INC_PATH . 'menu.php');
include_once(INC_PATH . 'top.php');
if(!isset($_GET['show']) || empty($_GET['show']))
	include_once(HTML_PATH . 'home.php');
else{
	$inc_page = getPage($_GET['show']);
	include_once($inc_page);
}
include_once(INC_PATH . 'footer.php');
}
}
}
?>