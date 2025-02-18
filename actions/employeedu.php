<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$institute_name			= trim($_POST['institute_name']);
	$major					= trim($_POST['major']);
	$employee_id			= trim($_POST['employee_id']);
	$start_date				= trim($_POST['start_date']);
	$end_date				= trim($_POST['end_date']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("institute_name", _INSTITUTENAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_education_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_education_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_education", "user_education_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_education_id", $user_education_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("institute_name", $institute_name);
				$objQayaduser->setProperty("major", $major);
				$objQayaduser->setProperty("start_date", dateFormate_10($start_date));
				$objQayaduser->setProperty("end_date", dateFormate_10($end_date));				
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserEducation($mode)){
				
				
				if(is_uploaded_file($_FILES['document_file']['tmp_name'])){
				$objQayaduser->resetProperty();
				$document_file_name = $objQayaduser->getDocumentName($_FILES['document_file']['name'], trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				if(move_uploaded_file($_FILES['document_file']['tmp_name'], USER_DOCUMENT_PATH . $document_file_name)){}
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("document_file_name", $_FILES['document_file']['name']);
				$objQayaduser->setProperty("document_file", $document_file_name);
				$objQayaduser->setProperty("user_education_id", $user_education_id);
				$objQayaduser->actUserEducation("U");
				}
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Holiday by ".$LoginUserInfo["fullname"]." -> (".$institute_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Holiday info -> (".$institute_name .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage(_EMPLOYEE_EDUCATION_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=employeedu&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_education_id = $_GET['ei'];
	else if(isset($_POST['user_education_id']) && !empty($_POST['user_education_id']))
		$user_education_id = $_POST['user_education_id'];
	if(isset($user_education_id) && !empty($user_education_id)){
		$objQayaduser->setProperty("user_education_id", trim($objBF->decrypt($user_education_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserEducationDetail();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}