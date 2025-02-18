<?php
$GrandTotalNumberofLeaves = 0;
$TotalOfCurrtingAmountValue =0;
$WorkingHRPerDay = 8;
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("salary_type", 1);
$objQayaduser->lstSalary();
$EmployeeSalary = $objQayaduser->dbFetchArray(1);
$EmployeeMonthlySalary = trim(DecData($EmployeeSalary["salary_amount"], 1, $objBF));
$EmployeeDailySalary = trim(DecData($EmployeeSalary["salary_amount"], 1, $objBF)) / 30;
$EmployeeHourlySalary = $EmployeeDailySalary / $WorkingHRPerDay;
$EmployeeMintuesSalary = $EmployeeHourlySalary / 60;
$ten_PersentCutting = $EmployeeDailySalary * 0.10;
$twentyfine_PersentCutting = $EmployeeDailySalary * 0.25;
$Fifty_PersentCutting = $EmployeeDailySalary * 0.50;
$Hundred_PersentCutting = $EmployeeDailySalary;

$EmployeSalayComplete = $EmployeeMonthlySalary;
$EmployeeWorkingDays = 30;

if($EmployeSalayComplete > 10000){
$CountBasicSalary = $EmployeSalayComplete * 66.666 / 100 / 30 * $EmployeeWorkingDays;
$EmployeeBasicSalaryDetail = round($CountBasicSalary);
} else {
$EmployeeBasicSalaryDetail = $EmployeSalayComplete;
}

if($EmployeSalayComplete > 5000){
$HouseRent = $EmployeSalayComplete * 26.666 / 100 / 30 * $EmployeeWorkingDays;
$EmployeeHouseRent = round($HouseRent);
} else {
$EmployeeHouseRent = 0;
}

if($EmployeSalayComplete > 5000){
$Utilities = $EmployeSalayComplete * 6.666 / 100 / 30 * $EmployeeWorkingDays;
$EmployeeUtilitiesBills = round($Utilities);
} else {
$EmployeeUtilitiesBills = 0;
}

$EmployeeGrossSalary = $EmployeeBasicSalaryDetail + $EmployeeHouseRent + $EmployeeUtilitiesBills;

//Advance Salary Checker
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("DATEFILTER", "YES");
$objQayaduser->setProperty("STARTDATE", SALARY_START_DATE);
$objQayaduser->setProperty("ENDDATE", SALARY_END_DATE);
$objQayaduser->setProperty("payback_status", 1);
$objQayaduser->lstUserAdvanceSalaryPayBack();
$EmployeeAdvanceSalary = $objQayaduser->dbFetchArray(1);
//print_r($EmployeeAdvanceSalary);
//die();

//Employee Bonus
//lstBonus
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("bonus_status", 1);
$objQayaduser->lstBonus();
$EmployeeBonusSalary = $objQayaduser->dbFetchArray(1);

//Pending Task...........

?>