<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$holiday_name			= trim($_POST['holiday_name']);
	
	$holiday_sd				= trim($_POST['holiday_sd']);
	$holiday_ed				= trim($_POST['holiday_ed']);
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("holiday_name", _HOLIDAY_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$holiday_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['holiday_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_holidays", "holiday_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("holiday_id", $holiday_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("holiday_name", $holiday_name);
				$objQayaduser->setProperty("holiday_sd", dateFormate_10($holiday_sd));
				$objQayaduser->setProperty("holiday_ed", dateFormate_10($holiday_ed));				
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actHolidays($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Holiday by ".$LoginUserInfo["fullname"]." -> (".$holiday_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Holiday info -> (".$holiday_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_HOLIDAYS_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=holidays');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$holiday_id = $_GET['i'];
	else if(isset($_POST['holiday_id']) && !empty($_POST['holiday_id']))
		$holiday_id = $_POST['holiday_id'];
	if(isset($holiday_id) && !empty($holiday_id)){
		$objQayaduser->setProperty("holiday_id", trim($objBF->decrypt($holiday_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstHolidays();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}