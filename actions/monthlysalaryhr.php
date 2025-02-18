<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "stg0"){
$Gen_StartDate 			= trim($_POST["start_date"]);
$Gen_EndDate 			= trim($_POST["end_date"]);
$cutting_mode			= trim($_POST["cutting_mode"]);
$EmployeeId				= trim($_POST["employeeid"]);
if($EmployeeId != ""){
$PassParmtInLink = '&empmode='.EncData("Yes", 2, $objBF).'&ei='.EncData($EmployeeId, 2, $objBF);
} else {
$PassParmtInLink = '&empmode='.EncData("No", 2, $objBF);
}
$link = Route::_('show=monthlysalaryhr&v='.EncData('list', 2, $objBF).'&st='.EncData($Gen_StartDate, 2, $objBF).'&ed='.EncData($Gen_EndDate, 2, $objBF).'&cm='.$cutting_mode.$PassParmtInLink);
redirect($link);
}
if(trim(DecData($_GET["v"], 1, $objBF)) == "list" && trim(DecData($_GET["st"], 1, $objBF)) != "" && trim(DecData($_GET["ed"], 1, $objBF)) != ""){
$ST_StartDate 			= trim(DecData($_GET["st"], 1, $objBF));
$ST_EndDate 			= trim(DecData($_GET["ed"], 1, $objBF));
$cutting_mode			= $_GET["cm"];
$EmpModeStatus			= trim(DecData($_GET["empmode"], 1, $objBF));
$EmployeeID				= trim(DecData($_GET["ei"], 1, $objBF));

$GrandTotalNumberofLeaves = 0;
$TotalOfCurrtingAmountValue =0;
$WorkingHRPerDay = 8;

//Advance Salary Checker
$AdvanceSalary = array();
$objQayaduser->resetProperty();
if($EmpModeStatus == "Yes" && $EmployeeID != ""){
$objQayaduser->setProperty("user_id", $EmployeeID);
}
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("DATEFILTER", "YES");
$objQayaduser->setProperty("STARTDATE", dateFormate_10($ST_StartDate));
$objQayaduser->setProperty("ENDDATE", dateFormate_10($ST_EndDate));
$objQayaduser->setProperty("payback_status", 1);
$objQayaduser->lstUserAdvanceSalaryPayBack();
while($EmployeeAdvanceSalary = $objQayaduser->dbFetchArray(1)){
	
	if($AdvanceSalary[$EmployeeAdvanceSalary["user_id"]] == ''){
	$AdvanceSalary[$EmployeeAdvanceSalary["user_id"]] = array('payback_monthly_id' => $EmployeeAdvanceSalary["payback_monthly_id"], 'monthly_amount' => $EmployeeAdvanceSalary["monthly_amount"]);
	} else {
	$AdvanceSalary[$EmployeeAdvanceSalary["user_id"]] = array('payback_monthly_id' => $AdvanceSalary[$EmployeeAdvanceSalary["user_id"]]["payback_monthly_id"].','.$EmployeeAdvanceSalary["payback_monthly_id"], 'monthly_amount' => $AdvanceSalary[$EmployeeAdvanceSalary["user_id"]]["monthly_amount"] + $EmployeeAdvanceSalary["monthly_amount"]);	
	}
	
}
/*
echo '<pre>';
print_r($AdvanceSalary);
die();
*/
//Bonus Amount
$BonusAmount = array();
$objQayaduser->resetProperty();
if($EmpModeStatus == "Yes" && $EmployeeID != ""){
$objQayaduser->setProperty("user_id", $EmployeeID);
}
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("bonus_status", 1);
$objQayaduser->lstBonus();
while($EmployeeBonusSalary = $objQayaduser->dbFetchArray(1)){
	$BonusAmount[$EmployeeBonusSalary["user_id"]] = $EmployeeBonusSalary;
}


//Employee Attendance Detail
/*$EmployeeAttleaves = array();
$objQayadAttendance->resetProperty();
$objQayadAttendance->setProperty("isActive", 1);
$objQayadAttendance->setProperty("DATEFILTER", "YES");
//$objQayadAttendance->setProperty("STARTDATE", dateFormate_10($ST_StartDate));
//$objQayadAttendance->setProperty("ENDDATE", dateFormate_10($ST_EndDate));
$objQayadAttendance->setProperty("STARTDATE", '2019-02-21');
$objQayadAttendance->setProperty("ENDDATE", '2019-03-20');
$objQayadAttendance->lstUserAttLeaves();
$CounyUserAttLeaves = 0;
while($AttendanceCuttingDetail = $objQayadAttendance->dbFetchArray(1)){
	$EmployeeAttleaves[] = $AttendanceCuttingDetail;
}*/
//print_r($EmployeeAttleaves);
//die();
}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "stg1"){

	$cutting_mode		= trim($_POST["cutting_mode"]);
	$user_id			= $_POST["userid"];
	$flt_sd				= trim($_POST["flt_sd"]);
	$flt_ed				= trim($_POST["flt_ed"]);
	$entery_date		= date('Y-m-d H:i:s');
	$isActive			= 1;
	/*for($UI=0;$UI<=count($user_id);$UI++){
	echo $_POST["emp_adv_payback_id_".$user_id[$UI]].'<br>';
	if($_POST["emp_adv_payback_id_".$user_id[$UI]] !=''){
	echo count(explode(',', $_POST["emp_adv_payback_id_".$user_id[$UI]])).'<br><br>';
	
	$empAdvanPayBackArray = explode(',', $_POST["emp_adv_payback_id_".$user_id[$UI]]);
	for($pb=0;$pb<=count($empAdvanPayBackArray);$pb++){
		echo '---'.$empAdvanPayBackArray[$pb].'<br>';
	}
	echo '<br>------------------------------------<br>';
	}
	
	}
	die();*/
	
	//print_r($_POST);
	//die();
	//empmbonus_id_
	//empmbonus_
	//emp_lieo_
	//emp_absent_
	//emp_aprv_leaves_
	//emp_adv_amount_
	//emp_adv_payback_id_
	//emp_deduction_
	//emp_cutting_mode_
	//pay_mode_
	
	
				$objQayaduser->resetProperty();
				$monthly_salary_id = $objQayaduser->genCode("rs_tbl_user_monthly_paid_salary", "monthly_salary_id");
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("monthly_salary_id", $monthly_salary_id);
				$objQayaduser->setProperty("entery_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("flt_start_date", dateFormate_10($flt_sd));
				$objQayaduser->setProperty("flt_end_date", dateFormate_10($flt_ed));
				$objQayaduser->setProperty("entery_date", $entery_date);
				$objQayaduser->setProperty("isActive", $isActive);
				if($objQayaduser->actUserMonthlyPaidSalary('I')){
					
					for($UI=0;$UI<=count($user_id);$UI++){
						if($user_id[$UI] != ""){
							$objQayaduser->resetProperty();
							$paid_salary_detail_id = $objQayaduser->genCode("rs_tbl_user_monthly_paid_salary_detail", "paid_salary_detail_id");
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("paid_salary_detail_id", $paid_salary_detail_id);
							$objQayaduser->setProperty("monthly_salary_id", $monthly_salary_id);
							$objQayaduser->setProperty("user_id", $user_id[$UI]);
							$objQayaduser->setProperty("emp_lieo", number_format((float)$_POST["emp_lieo_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("emp_absent", number_format((float)$_POST["emp_absent_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("emp_aprv_leaves", number_format((float)$_POST["emp_aprv_leaves_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("emp_adv_amount", number_format((float)$_POST["emp_adv_amount_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("emp_adv_payback_id", $_POST["emp_adv_payback_id_".$user_id[$UI]]);
							$objQayaduser->setProperty("emp_deduction", number_format((float)$_POST["emp_deduction_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("emp_cutting_mode", $_POST["emp_cutting_mode_".$user_id[$UI]]);
							$objQayaduser->setProperty("emp_monthly_salary", number_format((float)$_POST["emp_monthly_salary_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("emp_bonus_id", $_POST["emp_bonus_id_".$user_id[$UI]]);
							$objQayaduser->setProperty("emp_bonus", number_format((float)$_POST["emp_bonus_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("emp_overtime", number_format((float)$_POST["emp_overtime_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("incometax", number_format((float)$_POST["emp_incometax_".$user_id[$UI]], 2, '.', ''));
							$objQayaduser->setProperty("pay_mode", $_POST["pay_mode_".$user_id[$UI]]);
							$objQayaduser->setProperty("entery_date", $entery_date);
							$objQayaduser->setProperty("isActive", 1);
							$objQayaduser->actUserMonthlyPaidSalaryDetail('I');
							
								if($_POST["emp_bonus_id_".$user_id[$UI]] != ""){
									$objQayaduser->resetProperty();
									$objQayaduser->setProperty("user_bonus_id", $_POST["emp_bonus_id_".$user_id[$UI]]);
									$objQayaduser->setProperty("bonus_status", 2);
									$objQayaduser->actSalaryBonus('U');
								}
							
								if($_POST["emp_adv_payback_id_".$user_id[$UI]] != ""){
									if(count(explode(',', $_POST["emp_adv_payback_id_".$user_id[$UI]])) > 1){
										
										$empAdvanPayBackArray = explode(',', $_POST["emp_adv_payback_id_".$user_id[$UI]]);
										for($pb=0;$pb<=count($empAdvanPayBackArray);$pb++){
											if($empAdvanPayBackArray[$pb]!=''){
												$objQayaduser->resetProperty();
												$objQayaduser->setProperty("payback_monthly_id", $empAdvanPayBackArray[$pb]);
												$objQayaduser->setProperty("payback_status", 2);
												$objQayaduser->actAdvanceSalaryPayBackDetail('U');
											}
										}
									} else {
									$objQayaduser->resetProperty();
									$objQayaduser->setProperty("payback_monthly_id", $_POST["emp_adv_payback_id_".$user_id[$UI]]);
									$objQayaduser->setProperty("payback_status", 2);
									$objQayaduser->actAdvanceSalaryPayBackDetail('U');
									
									}
								}
							
							
						}
					}
					
					
				}
		$link = Route::_('show=generatedsalary');
		redirect($link);
		//
//	die();
}
?>
