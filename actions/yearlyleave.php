<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$yearly_leave_name		= trim($_POST['yearly_leave_name']);
	$number_of_leave		= trim($_POST['number_of_leave']);
	$yearly_leave_type		= trim($_POST["yearly_leave_type"]);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("yearly_leave_name", _YEARLYLEAVE_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("number_of_leave", _NUMBEROFLEAVE_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$yearly_leave_type_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['yearly_leave_type_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_yearly_leave_type", "yearly_leave_type_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("yearly_leave_type_id", $yearly_leave_type_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("yearly_leave_name", $yearly_leave_name);
				$objQayaduser->setProperty("number_of_leave", $number_of_leave);
				$objQayaduser->setProperty("yearly_leave_type", $yearly_leave_type);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actYearlyLeaveType($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Yearly Leave by ".$LoginUserInfo["fullname"]." -> (".$yearly_leave_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Yearly Leave info -> (".$yearly_leave_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_YEARLYLEAVE_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=yearlyleave');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$yearly_leave_type_id = $_GET['i'];
	else if(isset($_POST['yearly_leave_type_id']) && !empty($_POST['yearly_leave_type_id']))
		$yearly_leave_type_id = $_POST['yearly_leave_type_id'];
	if(isset($yearly_leave_type_id) && !empty($yearly_leave_type_id)){
		$objQayaduser->setProperty("yearly_leave_type_id", trim($objBF->decrypt($yearly_leave_type_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstYearlyLeaveType();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}