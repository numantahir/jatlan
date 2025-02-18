<?php

$mode = 'I';

if($_SERVER['REQUEST_METHOD'] == "POST"){

	

	$mode					= $_POST['mode'];

	$user_shift_id			= $_POST['user_shift_id'];

	$day_id					= $_POST['day_id'];

	$shift_id				= $_POST['shift_id'];

	$employee_id			= trim($_POST['employee_id']);

	$objValidate->setArray($_POST);

	$vResult = $objValidate->doValidate();

	// See if any error are not returned

	if(!$vResult){

				

				for($D=1;$D<=7;$D++){ 

				

				//echo $mode[$D].'-'.$user_shift_id[$D].'-'.$day_id[$D].'-'.$shift_id[$D].'<br>';

				$objQayaduser->resetProperty();

				if($mode[$D] == 'I'){

				$objQayaduser->setProperty("user_shift_id", $objQayaduser->genCode("rs_tbl_user_shifts", "user_shift_id"));

				} else {

				$objQayaduser->setProperty("user_shift_id", trim($objBF->decrypt($user_shift_id[$D], 1, ENCRYPTION_KEY)));	

				}

				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));

				$objQayaduser->setProperty("shift_id", $shift_id[$D]);

				$objQayaduser->setProperty("day_id", $day_id[$D]);

				if($shift_id[$D] == 0){

				$objQayaduser->setProperty("day_status", 2);

				} else {

				$objQayaduser->setProperty("day_status", 1);

				}

				

				$objQayaduser->setProperty("isActive", 1);

				$objQayaduser->actUserShifts($mode[$D]);

				

				}

				

				/*$objQayaduser->resetProperty();

				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));

				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));

				if($mode == 'I'){

				$objQayaduser->setProperty("activity_detail", "Add New Shift by ".$LoginUserInfo["fullname"]." -> (".$shift_name .")");

				} else {

				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Shift info -> (".$shift_name .")");

				}

				$objQayaduser->actUserLog("I");*/

				//die();

						$objCommon->setMessage(_SHIFT_ADDED_SUCCESSFULLY, 'Info');

						$link = Route::_('show=employeopt&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));

						redirect($link);

				}

				

			//}

	} else {

			

/*if(isset($_GET['i']) && !empty($_GET['i']))

		$shift_id = $_GET['i'];

	else if(isset($_POST['shift_id']) && !empty($_POST['shift_id']))

		$shift_id = $_POST['shift_id'];

	if(isset($shift_id) && !empty($shift_id)){

		$objQayaduser->setProperty("shift_id", trim($objBF->decrypt($shift_id, 1, ENCRYPTION_KEY)));

		$objQayaduser->lstShifts();

		$data = $objQayaduser->dbFetchArray(1);

		$mode	= "U";

		extract($data);	

	}*/

}