<?php
if(trim(DecData($_GET["rq"], 1, $objBF)) == 'Approved' && trim(DecData($_GET["lqi"], 1, $objBF)) != ''){
		
		$objQayaduser->setProperty("leave_request_id", trim(DecData($_GET["lqi"], 1, $objBF)));
		$objQayaduser->setProperty("forward_director", 2);
		$objQayaduser->setProperty("leave_status", 2);
		$objQayaduser->actUserLeaveRequest('U');
		
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("leave_request_id", trim(DecData($_GET["lqi"], 1, $objBF)));
		$objQayaduser->lstUserLeaveRequest();
		$MyLeaveRequest = $objQayaduser->dbFetchArray(1);
		
				
				$objQayadAttendanceUpdate = new Qayadattendance;
				$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("DATEFILTER", "YES");
				$objQayadAttendance->setProperty("STARTDATE", $MyLeaveRequest["leave_sd"]);
				$objQayadAttendance->setProperty("ENDDATE", $MyLeaveRequest["leave_ed"]);
				$objQayadAttendance->setProperty("user_id", $MyLeaveRequest["user_id"]);
				$objQayadAttendance->lstUserAttLeaves();
				if($objQayadAttendance->totalRecords() > 0){
					while($AttLeaveID = $objQayadAttendance->dbFetchArray(1)){
						if($AttLeaveID["att_leave_id"] != ""){
						$objQayadAttendanceUpdate->resetProperty();
						$objQayadAttendanceUpdate->setProperty("att_leave_id", $AttLeaveID["att_leave_id"]);
						$objQayadAttendanceUpdate->actUserAttLeavs('D');	
						}
					}
				}
		
		
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", $MyLeaveRequest["user_id"]);
				$objQayaduser->lstUsers();
				$EmployeeDetail = $objQayaduser->dbFetchArray(1);
				if($EmployeeDetail["user_mobile"] != ""){
					$MobileNumber = $EmployeeDetail["user_mobile"];					
					if(strlen($MobileNumber) >= 10){
						
						if(trim(substr($MobileNumber,0,1)) == 0){
							$ReturnNumber = trim(substr($MobileNumber,1, 13));
						} elseif(trim(substr($MobileNumber,0,3)) == '920'){
							$ReturnNumber = trim(substr($MobileNumber,3, 13));
						} elseif(trim(substr($MobileNumber,0,2)) == '92'){
							$ReturnNumber = trim(substr($MobileNumber,2, 13));
						} else {
							$ReturnNumber = $MobileNumber;
						}
					
				$ZongSmSAPI = 'http://cbs.zong.com.pk/reachcwsv2/corporatesms.svc?wsdl';
				$ZongAPI = new SoapClient($ZongSmSAPI, array("trace" =>1, "exception" =>0));
				$TextMessageVerification = "Your leave application has been approved.";
				$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessageVerification, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
					}
				}
		
		
		
		
		
		$objCommon->setMessage(_LEAVE_REQUEST_STATUS_MODE_APROVED, 'Info');
		$link = Route::_('show=leaverequests');
		redirect($link);
}
if(trim(DecData($_GET["rq"], 1, $objBF)) == 'Reject' && trim(DecData($_GET["lqi"], 1, $objBF)) != ''){
		
		$objQayaduser->setProperty("leave_request_id", trim(DecData($_GET["lqi"], 1, $objBF)));
		$objQayaduser->setProperty("forward_director", 3);
		$objQayaduser->setProperty("leave_status", 3);
		$objQayaduser->actUserLeaveRequest('U');
		
		
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("leave_request_id", trim(DecData($_GET["lqi"], 1, $objBF)));
		$objQayaduser->lstUserLeaveRequest();
		$MyLeaveRequest = $objQayaduser->dbFetchArray(1);
		
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", $MyLeaveRequest["user_id"]);
				$objQayaduser->lstUsers();
				$EmployeeDetail = $objQayaduser->dbFetchArray(1);
				if($EmployeeDetail["user_mobile"] != ""){
					$MobileNumber = $EmployeeDetail["user_mobile"];					
					if(strlen($MobileNumber) >= 10){
						
						if(trim(substr($MobileNumber,0,1)) == 0){
							$ReturnNumber = trim(substr($MobileNumber,1, 13));
						} elseif(trim(substr($MobileNumber,0,3)) == '920'){
							$ReturnNumber = trim(substr($MobileNumber,3, 13));
						} elseif(trim(substr($MobileNumber,0,2)) == '92'){
							$ReturnNumber = trim(substr($MobileNumber,2, 13));
						} else {
							$ReturnNumber = $MobileNumber;
						}
					
				$ZongSmSAPI = 'http://cbs.zong.com.pk/reachcwsv2/corporatesms.svc?wsdl';
				$ZongAPI = new SoapClient($ZongSmSAPI, array("trace" =>1, "exception" =>0));
				$TextMessageVerification = "Your leave application has been rejected.";
				$ZongAPI->QuickSMS(array('obj_QuickSMS' => array('loginId' => '923109244351', 'loginPassword'=>'123', 'Destination' => '92'.$ReturnNumber, 'Mask' => 'Qayad', 'Message' => $TextMessageVerification, 'UniCode' => '0', 'ShortCodePrefered' => 'n')));
					}
				}
		
		
		
		
		
		$objCommon->setMessage(_LEAVE_REQUEST_STATUS_MODE_REJECT, 'Info');
		$link = Route::_('show=leaverequests');
		redirect($link);
}
?>