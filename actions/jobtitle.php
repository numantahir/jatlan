<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$job_title				= trim($_POST['job_title']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("job_title", _job_title . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$job_title_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['job_title_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_job_title", "job_title_id");
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("job_title_id", $job_title_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("job_title", $job_title);
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actJobTitle($mode)){
						
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Job Title by ".$LoginUserInfo["fullname"]." -> (".$job_title .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Job Title info -> (".$job_title .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage(_JOBTITLE_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=jobtitle');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$job_title_id = $_GET['i'];
	else if(isset($_POST['job_title_id']) && !empty($_POST['job_title_id']))
		$job_title_id = $_POST['job_title_id'];
	if(isset($job_title_id) && !empty($job_title_id)){
		$objQayaduser->setProperty("job_title_id", trim($objBF->decrypt($job_title_id, 1, ENCRYPTION_KEY)));
		$objQayaduser->lstJobTitle();
		$data = $objQayaduser->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}