 <?php
$SectionArea = trim(DecData($_GET["sa"], 1, $objBF));
$mode = 'I';
if($SectionArea == 1){
/***************************************************************************************************/
/***************************************************************************************************/

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["sectionarea"] == 1){

	$skills				= trim($_POST['skills']);
	$employee_id		= trim($_POST['employee_id']);
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
				$objQayaduser->setProperty("user_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
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
				
						$objCommon->setMessage('Skills detail saved successfully.', 'Info');
						$link = Route::_('show=profile');
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

/***************************************************************************************************/
/***************************************************************************************************/
} elseif($SectionArea == 2){
/***************************************************************************************************/
/***************************************************************************************************/

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
				$objQayaduser->setProperty("user_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
				$objQayaduser->setProperty("institute_name", $institute_name);
				$objQayaduser->setProperty("major", $major);
				$objQayaduser->setProperty("start_date", dateFormate_10($start_date));
				$objQayaduser->setProperty("end_date", dateFormate_10($end_date));				
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserEducation($mode)){
				
				
				if(is_uploaded_file($_FILES['document_file']['tmp_name'])){
				$objQayaduser->resetProperty();
				$document_file_name = $objQayaduser->getDocumentName($_FILES['document_file']['name'], trim(DecData($objQayaduser->user_id, 1, $objBF)));
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
				
						$objCommon->setMessage('Education info saved successfully.', 'Info');
						$link = Route::_('show=profile');
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


/***************************************************************************************************/
/***************************************************************************************************/
} elseif($SectionArea == 3){
/***************************************************************************************************/
/***************************************************************************************************/

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$company_name			= trim($_POST['company_name']);
	$job_title				= trim($_POST['job_title']);
	$employee_id			= trim($_POST['employee_id']);
	$from_date				= trim($_POST['from_date']);
	$end_date				= trim($_POST['end_date']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("company_name", _COMPANYNAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_employment_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_employment_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_employment", "user_employment_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_employment_id", $user_employment_id);
				$objQayaduser->setProperty("user_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
				$objQayaduser->setProperty("company_name", $company_name);
				$objQayaduser->setProperty("job_title", $job_title);
				$objQayaduser->setProperty("from_date", dateFormate_10($from_date));
				$objQayaduser->setProperty("end_date", dateFormate_10($end_date));				
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserEmployment($mode)){
				
				
						$objCommon->setMessage('Employment History info saved successfully.', 'Info');
						$link = Route::_('show=profile');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_employment_id = $_GET['ei'];
	else if(isset($_POST['user_employment_id']) && !empty($_POST['user_employment_id']))
		$user_employment_id = $_POST['user_employment_id'];
	if(isset($user_employment_id) && !empty($user_employment_id)){
		$objQayaduser->setProperty("user_employment_id", trim($objBF->decrypt($user_employment_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserEmploymentHistory();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}

/***************************************************************************************************/
/***************************************************************************************************/
} elseif($SectionArea == 4){
/***************************************************************************************************/
/***************************************************************************************************/

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$person_name			= trim($_POST['person_name']);
	$contact_no				= trim($_POST['contact_no']);
	$employee_id			= trim($_POST['employee_id']);
	$company_name			= trim($_POST['company_name']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("person_name", _PERSONENAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_reference_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_reference_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_reference", "user_reference_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_reference_id", $user_reference_id);
				$objQayaduser->setProperty("user_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
				$objQayaduser->setProperty("person_name", $person_name);
				$objQayaduser->setProperty("contact_no", $contact_no);
				$objQayaduser->setProperty("company_name", $company_name);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserReference($mode)){
				
				
						$objCommon->setMessage("Reference info saved successfully.", 'Info');
						$link = Route::_('show=profile');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_reference_id = $_GET['ei'];
	else if(isset($_POST['user_reference_id']) && !empty($_POST['user_reference_id']))
		$user_reference_id = $_POST['user_reference_id'];
	if(isset($user_reference_id) && !empty($user_reference_id)){
		$objQayaduser->setProperty("user_reference_id", trim($objBF->decrypt($user_reference_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserReference();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}

/***************************************************************************************************/
/***************************************************************************************************/
} elseif($SectionArea == 5){
/***************************************************************************************************/
/***************************************************************************************************/

if($_SERVER['REQUEST_METHOD'] == "POST"){

	$person_name			= trim($_POST['person_name']);
	$contact_number			= trim($_POST['contact_number']);
	$employee_id			= trim($_POST['employee_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("person_name", _PERSONENAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_emergency_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_emergency_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_emergency", "user_emergency_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_emergency_id", $user_emergency_id);
				$objQayaduser->setProperty("user_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
				$objQayaduser->setProperty("person_name", $person_name);
				$objQayaduser->setProperty("contact_number", $contact_number);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserEmergencyNumber($mode)){
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Holiday by ".$LoginUserInfo["fullname"]." -> (".$person_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Holiday info -> (".$person_name .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage("Emergency contact number info saved successfully.", 'Info');
						$link = Route::_('show=profile');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['ei']) && !empty($_GET['ei']))
		$user_emergency_id = $_GET['ei'];
	else if(isset($_POST['user_emergency_id']) && !empty($_POST['user_emergency_id']))
		$user_emergency_id = $_POST['user_emergency_id'];
	if(isset($user_emergency_id) && !empty($user_emergency_id)){
		$objQayaduser->setProperty("user_emergency_id", trim($objBF->decrypt($user_emergency_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserEmergency();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}

/***************************************************************************************************/
/***************************************************************************************************/
} else {

}
?>