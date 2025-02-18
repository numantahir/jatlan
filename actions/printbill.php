<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$objSSSUpdateProperty	= new SSSinventory;
	$gbi					= trim($objBF->decrypt(trim($_POST['gbi']), 1, ENCRYPTION_KEY));
	$tni					= trim($objBF->decrypt(trim($_POST['tni']), 1, ENCRYPTION_KEY));
	$mri					= trim($objBF->decrypt(trim($_POST['mri']), 1, ENCRYPTION_KEY));
	$tnp					= trim($_POST['tnp']);
	$modification_option	= trim($_POST['modification_option']);
	$new_amount				= trim($_POST['new_amount']);

	$entery_date			= date('Y-m-d H:i:s');

	$objValidate->setArray($_POST);
	$objValidate->setCheckField("new_amount", 'New Amount' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$RequestTotalAmount = $new_amount * $tnp;
				$AfterNewMonthPay = 500 * $tnp;
				$AfterNewMonthlyPayment = $RequestTotalAmount + $AfterNewMonthPay;
				if($modification_option == 1){
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("tenant_id", $tni);
					$objSSSinventory->lstTenantExtraCharges();
					if($objSSSinventory->totalRecords() > 0){
					$GetExtraChargesRq = $objSSSinventory->dbFetchArray(1);
					$ThisTenantExtraCharges = $GetExtraChargesRq["extra_charges"];
					} else {
					$ThisTenantExtraCharges = 0;
					}
					/////////////////////////////////////////////////////////////////////
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->lstMonthlyRent();
					$GetMonthlyBill = $objSSSinventory->dbFetchArray(1);
					if($GetMonthlyBill["installment_status"] == 1){
					$InstallmentDetail = $GetMonthlyBill["installment_amount"];
					$GrandTotalAmount = $RequestTotalAmount + $InstallmentDetail + $ThisTenantExtraCharges;
					} else {
					$GrandTotalAmount = $RequestTotalAmount + $ThisTenantExtraCharges;
					}
					////////////////////////////////////////////////////////////////////////////
					
					/***********************************************************************************/
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->setProperty("within_monthly_rent", $RequestTotalAmount);
					$objSSSinventory->setProperty("after_monthly_rent", $AfterNewMonthlyPayment);
					$objSSSinventory->setProperty("total_rent_amount", $GrandTotalAmount);
					$objSSSinventory->actMonthlyRent('U');
					/***********************************************************************************/
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->setProperty("monthly_amount", $new_amount);
					$objSSSinventory->setProperty("total_amount", $new_amount);
					$objSSSinventory->setProperty("pending_amount", $new_amount);
					$objSSSinventory->actMonthlyRentAmount('U');
					/***********************************************************************************/
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->lstMonthlyRentAmount();
					while($EachMonthlyBill = $objSSSinventory->dbFetchArray(1)){
						/***********************************************************************************/
						$objSSSUpdateProperty->resetProperty();
						$objSSSUpdateProperty->setProperty("property_id", $EachMonthlyBill["property_id"]);
						$objSSSUpdateProperty->setProperty("monthly_maint", $new_amount);
						$objSSSUpdateProperty->actProperty('U');
						/***********************************************************************************/
					}
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
				} elseif($modification_option == 2){
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					/***********************************************************************************/
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->lstMonthlyRentAmount();
					while($EachMonthlyBill = $objSSSinventory->dbFetchArray(1)){
						/***********************************************************************************/
						$objSSSUpdateProperty->resetProperty();
						$objSSSUpdateProperty->setProperty("property_id", $EachMonthlyBill["property_id"]);
						$objSSSUpdateProperty->setProperty("monthly_maint", $new_amount);
						$objSSSUpdateProperty->actProperty('U');
						/***********************************************************************************/
					}
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
				} elseif($modification_option == 3){
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("tenant_id", $tni);
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->lstTenantExtraCharges();
					if($objSSSinventory->totalRecords() > 0){
					$GetExtraChargesRq = $objSSSinventory->dbFetchArray(1);
					$ThisTenantExtraCharges = $GetExtraChargesRq["extra_charges"];
					} else {
					$ThisTenantExtraCharges = 0;
					}
					/////////////////////////////////////////////////////////////////////
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->lstMonthlyRent();
					$GetMonthlyBill = $objSSSinventory->dbFetchArray(1);
					if($GetMonthlyBill["installment_status"] == 1){
					$InstallmentDetail = $GetMonthlyBill["installment_amount"];
					$GrandTotalAmount = $RequestTotalAmount + $InstallmentDetail + $ThisTenantExtraCharges;
					} else {
					$GrandTotalAmount = $RequestTotalAmount + $ThisTenantExtraCharges;
					}
					/***********************************************************************************/
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->setProperty("within_monthly_rent", $RequestTotalAmount);
					$objSSSinventory->setProperty("after_monthly_rent", $AfterNewMonthlyPayment);
					$objSSSinventory->setProperty("total_rent_amount", $GrandTotalAmount);
					$objSSSinventory->actMonthlyRent('U');
					/***********************************************************************************/
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $mri);
					$objSSSinventory->setProperty("monthly_amount", $new_amount);
					$objSSSinventory->setProperty("total_amount", $new_amount);
					$objSSSinventory->setProperty("pending_amount", $new_amount);
					$objSSSinventory->actMonthlyRentAmount('U');
					/***********************************************************************************/
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////////////////////////////
				}

				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", "Tenant bill modification by ".$LoginUserInfo["fullname"]." -> (".$mri.")");
				$objQayaduser->setProperty("location_id", $mri);
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Tenant bill modifcation has been updated successfully.', 'Info');
						$link = Route::_('show=printbill&i='.EncData($tni, 2, $objBF));
						redirect($link);
				}
				
			
	} else {
$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
$objSSSinventory->lstTenantInformation();
$GetTenantInfo = $objSSSinventory->dbFetchArray(1);
if(trim(DecData($_GET["v"], 1, $objBF)) == 'modification'){ 

$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("generate_bill_id", trim(DecData($_GET["gbi"], 1, $objBF)));
$objSSSinventory->lstGenMonthlyBill();
$ReqGenBill = $objSSSinventory->dbFetchArray(1);

$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("generate_bill_id", trim(DecData($_GET["gbi"], 1, $objBF)));
$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
$objSSSinventory->lstMonthlyRent();
$MonthlyBillDetail = $objSSSinventory->dbFetchArray(1);


$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("monthly_rent_id", $MonthlyBillDetail["monthly_rent_id"]);
$objSSSinventory->setProperty("tenant_id", $GetTenantInfo["tenant_id"]);
$objSSSinventory->lstMonthlyRentAmount();
$CountNoOfPropertiesInBill = $objSSSinventory->totalRecords();


$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("isActive", 1);
$objSSSinventory->setProperty("tenant_id", $GetTenantInfo["tenant_id"]);
$objSSSinventory->lstTenantExtraCharges();
$GetExtraChargesRq = $objSSSinventory->dbFetchArray(1);

}






	}