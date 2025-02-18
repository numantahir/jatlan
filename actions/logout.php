<?php
session_start();
unset(
	$_SESSION['user_login'],
	$_SESSION['user_id'],
	$_SESSION['user_mobile'],
	$_SESSION['fullname'],
	$_SESSION['login_time'],
	$_SESSION['user_fname'],
	$_SESSION['user_type'],
	$_SESSION['gen_fir'],
	$_SESSION['location_id'],
	$_SESSION['sd_code'],
	$_SESSION['sd_panel']);	
$link = Route::_('');
redirect($link);