<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$shift_name				= trim($_POST['shift_name']);
	$shift_st				= trim($_POST['shift_st']);
	$shift_et				= trim($_POST['shift_et']);
	$shift_ligt				= trim($_POST['shift_ligt']);
	$shift_logt				= trim($_POST['shift_logt']);
	$shift_eigt				= trim($_POST['shift_eigt']);
	$shift_eogt				= trim($_POST['shift_eogt']);
	
	$full_late_in			= trim($_POST['full_late_in']);
	$half_late_in			= trim($_POST['half_late_in']);
	$qutr_late_in			= trim($_POST['qutr_late_in']);
	
	$full_off_bef			= trim($_POST['full_off_bef']);
	$half_off_bef_start		= trim($_POST['half_off_bef_start']);
	$half_off_bef_end		= trim($_POST['half_off_bef_end']);
	$qutr_off_bef_start		= trim($_POST['qutr_off_bef_start']);
	$qutr_off_bef_end		= trim($_POST['qutr_off_bef_end']);
	$ten_off_bef_start		= trim($_POST['ten_off_bef_start']);
	$ten_off_bef_end		= trim($_POST['ten_off_bef_end']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	
	$ligt_status			= trim($_POST["ligt_status"]);
	$eogt_status			= trim($_POST["eogt_status"]);
	
	$entery_date			= date('Y-m-d H:i:s');
	//echo date("H:i", strtotime($shift_et));
	//die();
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("shift_name", _SHIFT_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("shift_st", _SHIFT_START_TIME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("shift_et", _SHIFT_END_TIME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$shift_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['shift_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_shifts", "shift_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("shift_id", $shift_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("shift_name", $shift_name);
				$objQayaduser->setProperty("shift_st", date("H:i", strtotime($shift_st)));
				$objQayaduser->setProperty("shift_et", date("H:i", strtotime($shift_et)));
				$objQayaduser->setProperty("shift_ligt", $shift_ligt);
				$objQayaduser->setProperty("shift_logt", $shift_logt);
				//$objQayaduser->setProperty("shift_eigt", $shift_eigt);
				$objQayaduser->setProperty("shift_eogt", $shift_eogt);
				
				$objQayaduser->setProperty("full_late_in", $full_late_in);
				$objQayaduser->setProperty("half_late_in", $half_late_in);
				$objQayaduser->setProperty("qutr_late_in", $qutr_late_in);
				
				
				$objQayaduser->setProperty("full_off_bef", date("H:i", strtotime($full_off_bef)));
				$objQayaduser->setProperty("half_off_bef_start", date("H:i", strtotime($half_off_bef_start)));
				$objQayaduser->setProperty("half_off_bef_end", date("H:i", strtotime($half_off_bef_end)));
				$objQayaduser->setProperty("qutr_off_bef_start", date("H:i", strtotime($qutr_off_bef_start)));
				$objQayaduser->setProperty("qutr_off_bef_end", date("H:i", strtotime($qutr_off_bef_end)));
				$objQayaduser->setProperty("ten_off_bef_start", date("H:i", strtotime($ten_off_bef_start)));
				$objQayaduser->setProperty("ten_off_bef_end", date("H:i", strtotime($ten_off_bef_end)));
				$objQayaduser->setProperty("entery_date", $entery_date);
				
				$objQayaduser->setProperty("ligt_status", $ligt_status);
				$objQayaduser->setProperty("eogt_status", $eogt_status);
				
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actShifts($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Shift by ".$LoginUserInfo["fullname"]." -> (".$shift_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Shift info -> (".$shift_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_SHIFT_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=shift');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$shift_id = $_GET['i'];
	else if(isset($_POST['shift_id']) && !empty($_POST['shift_id']))
		$shift_id = $_POST['shift_id'];
	if(isset($shift_id) && !empty($shift_id)){
		$objQayaduser->setProperty("shift_id", trim($objBF->decrypt($shift_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstShifts();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}