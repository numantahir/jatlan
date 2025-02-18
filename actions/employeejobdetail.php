<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objRoute 						= new Route;
	$objQayadYearlyLeave 		= new Qayaduser;
	$objQayaduser->resetProperty();
	$job_title_id					= trim($_POST['job_title_id']);
	$employee_id					= trim($_POST['employee_id']);
	$job_description				= trim($_POST['job_description']);
	$company_id						= trim($_POST["company_id"]);
	$department_id					= trim($_POST['department_id']);
	$joined_date					= trim($_POST['joined_date']);
	$service_end_date				= trim($_POST['service_end_date']);
	$job_type						= trim($_POST['job_type']);
	$probation_period_end_date		= trim($_POST['probation_period_end_date']);
	$probation_period_status		= trim($_POST['probation_period_status']);
	$leave_type_id					= $_POST['leave_type_id'];
	$mode 							= trim($_POST['mode']);
	$leavechecker					= $_POST["leavechecker"];
	$user_leave_id					= $_POST["user_leave_id"];
	$shift_id						= trim($_POST["shift_id"]);
	
	$shift_mode				= $_POST['shift_mode'];
	$user_shift_id			= $_POST['user_shift_id'];
	$day_id					= $_POST['day_id'];
	
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("job_title_id", _JOBTITLE . _IS_REQUIRED_FLD, "S");
	//$objValidate->setCheckField("department_id", _DEPARTMENT_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("joined_date", _JOINEDATE. _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayaduser->resetProperty();
				$user_job_detail_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['user_job_detail_id'], 1, ENCRYPTION_KEY)) : $objQayaduser->genCode("rs_tbl_user_job_detail", "user_job_detail_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_job_detail_id", $user_job_detail_id);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("job_title_id", $job_title_id);
				$objQayaduser->setProperty("job_description", $job_description);
				$objQayaduser->setProperty("company_id", $company_id);
				$objQayaduser->setProperty("department_id", $department_id);
				
				$objQayaduser->setProperty("joined_date", dateFormate_10($joined_date));
				$objQayaduser->setProperty("service_end_date", dateFormate_10($service_end_date));
				$objQayaduser->setProperty("job_type", $job_type);
				$objQayaduser->setProperty("probation_period_end_date", dateFormate_10($probation_period_end_date));
				$objQayaduser->setProperty("probation_period_status", $probation_period_status);
				$objQayaduser->setProperty("dummy_shift_id", $shift_id);
				if($objQayaduser->actUserJobDetail($mode)){	
					
					/**************************************************************************************************/
					/**************************************************************************************************/
					/**************************************************************************************************/
					if($probation_period_status == 2){
					for($lti=0;$lti<=count($leave_type_id);$lti++){
						if($leave_type_id[$lti] !=''){
						$objQayaduser->resetProperty();
						$objQayadYearlyLeave->setProperty("yearly_leave_type_id", $leave_type_id[$lti]);
						$objQayadYearlyLeave->lstYearlyLeaveType();
						$YearlyLeaveDetail = $objQayadYearlyLeave->dbFetchArray(1);
						if($leavechecker[$lti] == 0){
							$user_leave_id = $objQayaduser->genCode("rs_tbl_user_leaves", "user_leave_id");
							$leave_mode = 'I';
						} else {
							$user_leave_id = $user_leave_id[$lti];
							$leave_mode = 'U';
						}
						$objQayaduser->setProperty("user_leave_id", $user_leave_id);
						$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
						$objQayaduser->setProperty("leave_type_id", $leave_type_id[$lti]);
						$objQayaduser->setProperty("leave_days", $YearlyLeaveDetail["number_of_leave"]);
						$objQayaduser->setProperty("isActive", 1);
						$objQayaduser->actUserLeaves($leave_mode);
						}
					}
					}
					/**************************************************************************************************/
					/**************************************************************************************************/
					/**************************************************************************************************/
					for($D=1;$D<=7;$D++){
					$objQayaduser->resetProperty();
					if($shift_mode[$D] == 'I'){
					$objQayaduser->setProperty("user_shift_id", $objQayaduser->genCode("rs_tbl_user_shifts", "user_shift_id"));
					} else {
					$objQayaduser->setProperty("user_shift_id", trim($objBF->decrypt($user_shift_id[$D], 1, ENCRYPTION_KEY)));	
					}
					$objQayaduser->setProperty("user_id", trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)));
					if($D == 7){
					$objQayaduser->setProperty("shift_id", $shift_id);
					$objQayaduser->setProperty("day_status", 2);
					} else {
					$objQayaduser->setProperty("shift_id", $shift_id);
					$objQayaduser->setProperty("day_status", 1);
					}
					$objQayaduser->setProperty("day_id", $day_id[$D]);
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->actUserShifts($shift_mode[$D]);
					
					}
					
					
					
				
						if($mode == 'I'){
						$objCommon->setMessage(_NEW_ACCOUNT_MSG_SUCCESS, 'Info');
						} else {
						$objCommon->setMessage(_EDIT_ACCOUNT_MSG_SUCCESS, 'Info');
						}
						$link = Route::_('show=employeopt&i='.EncData(trim($objBF->decrypt($employee_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				}
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
		$objQayaduser->lstUserJobDetail();
		if($objQayaduser->totalRecords() > 0){
		$data = $objQayaduser->dbFetchArray(1);

		$mode	= "U";
		extract($data);
		}
	}