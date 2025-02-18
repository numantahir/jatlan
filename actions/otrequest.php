<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$reason_overtime		= trim($_POST['reason_overtime']);
	$attendance_id			= trim($_POST['attendance_id']);
	
	$noofone				= trim($_POST['noofone']);
	$noofonepfive			= trim($_POST['noofonepfive']);
	$noofoneptwo			= trim($_POST['noofoneptwo']);
	
	$att_date				= trim($_POST["att_date"]);
	
	
	$objQayaduser->resetProperty();
	$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
	$objQayaduser->setProperty("isActive", 1);
	$objQayaduser->setProperty("salary_type", 1);
	$objQayaduser->lstSalary();
	$EmployeeSalary = $objQayaduser->dbFetchArray(1);
	$EmployeeDailySalary = trim($objBF->decrypt($EmployeeSalary["salary_amount"], 1, ENCRYPTION_KEY)) / 30;

//	print_r($_POST);
//	die();
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("reason_overtime", 'Reason overtime' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("attendance_id", trim($objBF->decrypt($attendance_id, 1, ENCRYPTION_KEY)));
				$objQayadAttendance->setProperty("reason_overtime", $reason_overtime);
				$objQayadAttendance->setProperty("overtime_status", 2);
				if($objQayadAttendance->actAttendance('U')){
					
					if($noofone != ""){
						$objQayaduser->resetProperty();
						$emp_overtime_id = $objQayaduser->genCode("rs_tbl_user_overtime_detail", "emp_overtime_id");
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("emp_overtime_id", $emp_overtime_id);
						$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
						$objQayaduser->setProperty("att_id", trim($objBF->decrypt($attendance_id, 1, ENCRYPTION_KEY)));
						$objQayaduser->setProperty("att_date", $att_date);
						$objQayaduser->setProperty("no_of_hrs", $noofone);
						$objQayaduser->setProperty("rate_per_hr", 1);
						$objQayaduser->setProperty("per_day_salary", $EmployeeDailySalary);
						$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
						$objQayaduser->setProperty("isActive", 1);
						$objQayaduser->actEmployeeOverTimeDetail('I');
					} 
					
					if($noofonepfive != ""){
						$objQayaduser->resetProperty();
						$emp_overtime_id = $objQayaduser->genCode("rs_tbl_user_overtime_detail", "emp_overtime_id");
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("emp_overtime_id", $emp_overtime_id);
						$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
						$objQayaduser->setProperty("att_id", trim($objBF->decrypt($attendance_id, 1, ENCRYPTION_KEY)));
						$objQayaduser->setProperty("att_date", $att_date);
						$objQayaduser->setProperty("no_of_hrs", $noofonepfive);
						$objQayaduser->setProperty("rate_per_hr", 2);
						$objQayaduser->setProperty("per_day_salary", $EmployeeDailySalary);
						$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
						$objQayaduser->setProperty("isActive", 1);
						$objQayaduser->actEmployeeOverTimeDetail('I');
					}
					
					if($noofoneptwo != ""){
						$objQayaduser->resetProperty();
						$emp_overtime_id = $objQayaduser->genCode("rs_tbl_user_overtime_detail", "emp_overtime_id");
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("emp_overtime_id", $emp_overtime_id);
						$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
						$objQayaduser->setProperty("att_id", trim($objBF->decrypt($attendance_id, 1, ENCRYPTION_KEY)));
						$objQayaduser->setProperty("att_date", $att_date);
						$objQayaduser->setProperty("no_of_hrs", $noofoneptwo);
						$objQayaduser->setProperty("rate_per_hr", 3);
						$objQayaduser->setProperty("per_day_salary", $EmployeeDailySalary);
						$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
						$objQayaduser->setProperty("isActive", 1);
						$objQayaduser->actEmployeeOverTimeDetail('I');
					}
					
					
						
						$objCommon->setMessage($LoginUserInfo["user_fname"].' '._OVERTIME_REQUEST_ADDED_SUCCESSFULLY, 'Info');
						$link = Route::_('show=myattendance');
						redirect($link);
				}
				
		}
} 