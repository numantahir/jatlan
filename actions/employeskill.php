<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$skills				= trim($_POST['skills']);
	$employee_id			= trim($_POST['employee_id']);
	$mode 				= trim($_POST['mode']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("skills", _SKILLDETAYK . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_skills_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_skills_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_skills", "user_skills_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_skills_id", $user_skills_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("skills", $skills);
				if($objQayaduser->actUserSkills($mode)){
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Holiday by ".$LoginUserInfo["fullname"]." -> (".$skills .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Holiday info -> (".$skills .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage(_EMPLOYEE_SKILL_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=employeskills&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_skills_id = $_GET['ei'];
	else if(isset($_POST['user_skills_id']) && !empty($_POST['user_skills_id']))
		$user_skills_id = $_POST['user_skills_id'];
	if(isset($user_skills_id) && !empty($user_skills_id)){
		$objQayaduser->setProperty("user_skills_id", trim($objBF->decrypt($user_skills_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserSkills();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}