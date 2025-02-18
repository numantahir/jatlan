<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	//print_r($_POST);
	$objQayaduser->resetProperty();
	$objRoute 				= new Route;	
	$objQayadRequestLog	= new Qayaduser;
	$loopcot				= $_POST["loopcot"];
	$request_flow_id		= $_POST["request_flow_id"];
	$mode					= $_POST["mode"];
	$department_id			= $_POST["department_id"];
	$company_id				= $_POST["company_id"];
	$leave_request_to		= $_POST["leave_request_to"];
	$overtime_request_to	= $_POST["overtime_request_to"];
	$isActive				= 1;
	$entery_date			= date('Y-m-d H:i:s');

		for($li=0;$li<=count($loopcot);$li++){
			if(trim($leave_request_to[$li]) != "" or $overtime_request_to[$li] != ""){
			
			//echo $li.'->'.trim($mode[$li]).'->'.$department_id[$li].'->'.$leave_request_to[$li].'->'.$overtime_request_to[$li].'->'.$request_flow_id[$li].'<br>';
				
				$request_flow_id_get = (trim($mode[$li]) == "U") ? trim($request_flow_id[$li]) : $objQayaduser->genCode("rs_tbl_user_request_flow", "request_flow_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("request_flow_id", $request_flow_id_get);
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("company_id", trim($company_id[$li]));
				$objQayaduser->setProperty("department_id", trim($department_id[$li]));
				$objQayaduser->setProperty("request_flow_type", 1);
				$objQayaduser->setProperty("leave_request_to", trim($leave_request_to[$li]));
				$objQayaduser->setProperty("overtime_request_to", trim($overtime_request_to[$li]));
				$objQayaduser->setProperty("isActive", $isActive);
				$objQayaduser->setProperty("entery_date", $entery_date);
				if($objQayaduser->actUserRequestFlow(trim($mode[$li]))){

					$objQayadRequestLog->resetProperty();
					$request_flow_log_id = $objQayadRequestLog->genCode("rs_tbl_user_request_flow_log", "request_flow_log_id");
					$objQayadRequestLog->resetProperty();
					if($mode[$li] == "I"){
						$activity_detail = "Assign new employee to department";
					} else {
						$activity_detail = "Modify employee to department";
					}
					$objQayadRequestLog->setProperty("request_flow_log_id", $request_flow_log_id);
					$objQayadRequestLog->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadRequestLog->setProperty("request_flow_id", $request_flow_id_get);
					$objQayadRequestLog->setProperty("activity_detail", $activity_detail);
					$objQayadRequestLog->setProperty("isActive", 1);
					$objQayadRequestLog->setProperty("entery_date", $entery_date);
					$objQayadRequestLog->actUserRequestFlowLog("I");
					
				}
			}
		}

	$objCommon->setMessage("User requested flow structure modification changed successfully.", 'Info');
	$link = Route::_('show=deprequestflow');
	redirect($link);
	//die();
}

?>