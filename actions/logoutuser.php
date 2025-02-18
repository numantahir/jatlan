<?php
session_start();
unset(
	$_SESSION['customer_login'],
	$_SESSION['customer_id'],
	$_SESSION['email'],
	$_SESSION['fullname'],
	$_SESSION['login_time'],
	$_SESSION['first_name'],
	$_SESSION['customer_type'],
	$_SESSION['type_section'],
	$_SESSION['vc'],
	$_SESSION['lnsl']);	
	setcookie("OrderCode", "", time() - 3600);
$link = Route::_('');
redirect($link);