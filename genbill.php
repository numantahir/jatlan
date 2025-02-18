<?php
require_once("config/config.php");
$objCommon 				= new Common;
$objSSSinventory		= new SSSinventory;
$objSSSAssignProperty	= new SSSinventory;
$objSSSPropertyInfo		= new SSSinventory;
$objSSSBillEntery		= new SSSinventory;
$objSSSBillDetailEntery	= new SSSinventory;
$objSSSGetEmployeeID	= new SSSinventory;
$objSSSGetArrears		= new SSSinventory;
$objSSSInstallmentPlan	= new SSSinventory;
$objSSSInstallmentList	= new SSSinventory;
$objSSSExtraCharges		= new SSSinventory;
$objSSSUpdateExtraChgs	= new SSSinventory;
$objBF 					= new Crypt_Blowfish('CBC');
$objBF->setKey($cipher_key);

$entery_date			= date('Y-m-d H:i:s');
$AfterPaymentCharges	= 250;

$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("isAcitve", 1);
$objSSSinventory->setProperty("process_status", 3);
$objSSSinventory->lstGenMonthlyBill();
if($objSSSinventory->totalRecords() > 0){
$GetBillRequest = $objSSSinventory->dbFetchArray(1);

$RequestedMonth 				= $GetBillRequest["current_month"];
$requestedYear 					= $GetBillRequest["current_year"];
$requestedDueDate 				= $GetBillRequest["due_date"];
$RequestToGetLastMonthDetails 	= $requestedYear.'-'.$RequestedMonth.'-01';
$LastMonthYear 					= date("Y-m",mktime(0,0,0,date("m", strtotime($RequestToGetLastMonthDetails))-1,1,date("Y", strtotime($RequestToGetLastMonthDetails))));
list($GetLastYear,$GetLastMonth)= explode('-', $LastMonthYear);


$TotalNumberofTenant = 0;
$total_generated_amount = 0;
$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("isActive", 1);
$objSSSinventory->setProperty("ORDERBY", 'tenant_id');
$objSSSinventory->lstTenantInformation();
while($TenantList = $objSSSinventory->dbFetchArray(1)){
	$TotalNumberofTenant++;
	//$i++;
	//echo $i.'---'.$TenantList['tenant_name'].'-'.$TenantList['tenant_id'].'<br>';
	
						$objSSSInstallmentPlan->resetProperty();
						$objSSSInstallmentPlan->setProperty("isActive", 1);
						$objSSSInstallmentPlan->setProperty("tenant_id", $TenantList['tenant_id']);
						$objSSSInstallmentPlan->setProperty("installment_status", 2);
						$objSSSInstallmentPlan->setProperty("installment_option", 2);
						$objSSSInstallmentList->setProperty("ORDERBY", "tenant_installment_id DESC");
						$objSSSInstallmentPlan->lstInstallmentPlan();
						if($objSSSInstallmentPlan->totalRecords() > 0){
						$InstallmentPlanDetail = $objSSSInstallmentPlan->dbFetchArray(1);
						$MainInstallmentID = $InstallmentPlanDetail["tenant_installment_id"];
						$InstallmentOption = 1;
								/*************************************************************************************/
								$objSSSInstallmentList->resetProperty();
								$objSSSInstallmentPlan->setProperty("isActive", 1);
								$objSSSInstallmentList->setProperty("tenant_id", $TenantList['tenant_id']);
								$objSSSInstallmentList->setProperty("tenant_installment_id", $MainInstallmentID);
								$objSSSInstallmentList->setProperty("installment_status", 2);
								$objSSSInstallmentList->setProperty("ORDERBY", "installment_list_id");
								$objSSSInstallmentList->lstInstallmentList();
								$CountNoOfInstallment = $objSSSInstallmentList->totalRecords();
								if($CountNoOfInstallment > 0){
								$InstallmentListDetail = $objSSSInstallmentList->dbFetchArray(1);
								$InstallmentListID = $InstallmentListDetail["installment_list_id"];
								$InstallMentAmount  = $InstallmentListDetail["monthly_payment"];
								$InstallmentListStatus = 1;
								$InstallmentCounter = $CountNoOfInstallment;
								} else {
								$InstallmentListStatus = 0;
								$InstallmentCounter = 0;
								$InstallMentAmount  = 0;
								}
						} else {
						$InstallmentOption = 0;
						}
						
						$objSSSExtraCharges->resetProperty();
						$objSSSExtraCharges->setProperty("isActive", 1);
						$objSSSExtraCharges->setProperty("tenant_id", $TenantList['tenant_id']);
						$objSSSExtraCharges->lstTenantExtraCharges();
						$CountedExtraCharges = $objSSSExtraCharges->totalRecords();
						if($CountedExtraCharges > 0){
						$GetExtraChargesRq = $objSSSExtraCharges->dbFetchArray(1);
						
						if($GetExtraChargesRq["extra_type"]==1){
							$ThisTenantExtraCharges = $GetExtraChargesRq["extra_charges"];
							$ThisTenantExtraChargesID = $GetExtraChargesRq["extra_charges_id"];
							$ThisTenantExtraChargesStatus = 1;
							$ExtraChargesType = 1;
							$ExtraChargesTypeUpdateOpt = 0;
						} elseif($GetExtraChargesRq["extra_type"] == 2 && $GetExtraChargesRq["type_status"] == 1){
							$ThisTenantExtraCharges = $GetExtraChargesRq["extra_charges"];
							$ThisTenantExtraChargesID = $GetExtraChargesRq["extra_charges_id"];
							$ThisTenantExtraChargesStatus = 1;
							$ExtraChargesType = 2;
							$ExtraChargesTypeUpdateOpt = 1;
						} elseif($GetExtraChargesRq["extra_type"] == 2 && $GetExtraChargesRq["type_status"] == 2){
							$ThisTenantExtraCharges = 0;
							$ThisTenantExtraChargesStatus = 2;
							$ThisTenantExtraChargesID = '';
							$ExtraChargesType = 1;
							$ExtraChargesTypeUpdateOpt = 0;
						}
						
						} else {
						$ThisTenantExtraCharges = 0;
						$ThisTenantExtraChargesStatus = 2;
						$ThisTenantExtraChargesID = '';
						$ExtraChargesType = 1;
						$ExtraChargesTypeUpdateOpt = 0;
						}
	
				$MonthlyAmountThisTenant = 0;
				$Total_within_monthly_rent = 0;
				$Total_after_monthly_rent = 0;
				$Total_arrears_rent = 0;
				$Total_total_rent_amount = 0;
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
				/**/$objSSSBillEntery->resetProperty();
				/**/$monthly_rent_id = $objSSSBillEntery->genCode("rs_tbl_inv_monthly_rent", "monthly_rent_id");	
				/**/$objSSSBillEntery->resetProperty();
				/**/$objSSSBillEntery->setProperty("monthly_rent_id", $monthly_rent_id);
				/**/$objSSSBillEntery->setProperty("generate_bill_id", $GetBillRequest['generate_bill_id']);
				/**/$objSSSBillEntery->setProperty("tenant_id", $TenantList['tenant_id']);
				/**/$objSSSBillEntery->setProperty("rent_of_month", $RequestedMonth);
				/**/$objSSSBillEntery->setProperty("rent_year", $requestedYear);
				/**/$objSSSBillEntery->setProperty("rent_status", 2);
				/**/$objSSSBillEntery->setProperty("bill_no", BillNumber($monthly_rent_id));
				/**/$objSSSBillEntery->setProperty("process_status", 3);
				/**/if($InstallmentOption == 1){
				/**/$objSSSBillEntery->setProperty("installment_id", $MainInstallmentID);
				/**/$objSSSBillEntery->setProperty("installment_list_id", $InstallmentListID);
				/**/}
				/**/$objSSSBillEntery->setProperty("installment_status", $TenantList['installment_status']);
				/**/$objSSSBillEntery->setProperty("entery_date", $entery_date);
				/**/$objSSSBillEntery->setProperty("due_date", $requestedDueDate);
				/**/$objSSSBillEntery->setProperty("generate_date", date("Y-m-d"));
				/**/$objSSSBillEntery->setProperty("isAcitve", $isActive);
				/**/$objSSSBillEntery->actMonthlyRent('I');
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/

						
			$objSSSAssignProperty->resetProperty();
			$objSSSAssignProperty->setProperty("tenant_id", $TenantList["tenant_id"]);
			$objSSSAssignProperty->setProperty("tenant_status", 1);
			$objSSSAssignProperty->lstTenantAssignProperty();
			$CheckPropertyCounter = $objSSSAssignProperty->totalRecords();
			//echo ' ((('.$CheckPropertyCounter.')))<br>';
			while($ListofAssignProperties = $objSSSAssignProperty->dbFetchArray(1)){
				
				$objSSSPropertyInfo->resetProperty();
				$objSSSPropertyInfo->setProperty("property_id", $ListofAssignProperties['property_id']);
				$objSSSPropertyInfo->lstProperties();
				$GetPropertyRent = $objSSSPropertyInfo->dbFetchArray(1);
				//echo $GetPropertyRent["property_code"].' - '.$GetPropertyRent["monthly_maint"].'////';
				
						$TempFinalAmount = 0;
						$ReturnArrearThisVal = 0;
						$objSSSGetArrears->resetProperty();
						$objSSSGetArrears->setProperty("property_id", $ListofAssignProperties['property_id']);
						$objSSSGetArrears->setProperty("tenant_id", $TenantList['tenant_id']);
						$objSSSGetArrears->setProperty("rent_month", $GetLastMonth);
						$objSSSGetArrears->setProperty("rent_year", $GetLastYear);
						$objSSSGetArrears->setProperty("rent_status_not", 2);
						$objSSSGetArrears->setProperty("isActive", 1);
						$objSSSGetArrears->lstMonthlyRentAmount();
						if($objSSSAssignProperty->totalRecords() > 0){
						$FineArrearsValue = $objSSSGetArrears->dbFetchArray(1);
						$ReturnArrearThisVal = $FineArrearsValue["pending_amount"];
						} else {
						$ReturnArrearThisVal = 0;	
						}
						
					$MonthlyAmountThisTenant = $GetPropertyRent["monthly_maint"] + $AfterPaymentCharges;
					$TempFinalAmount = $GetPropertyRent["monthly_maint"] + $ReturnArrearThisVal;
					
					
					// Commint this for without arrear
					//$Total_within_monthly_rent += $GetPropertyRent["monthly_maint"] + $ReturnArrearThisVal;
					$Total_within_monthly_rent += $GetPropertyRent["monthly_maint"];
					//$Total_after_monthly_rent += $MonthlyAmountThisTenant + $ReturnArrearThisVal;
					$Total_after_monthly_rent += $MonthlyAmountThisTenant;
					$Total_arrears_rent += $ReturnArrearThisVal;
					//$total_generated_amount += $GetPropertyRent["monthly_maint"] + $ReturnArrearThisVal;
					$total_generated_amount += $GetPropertyRent["monthly_maint"];
					
					//$Total_within_monthly_rent += $GetPropertyRent["monthly_maint"] + $ReturnArrearThisVal;
					//$Total_after_monthly_rent += $MonthlyAmountThisTenant + $ReturnArrearThisVal;
					//$Total_arrears_rent += $ReturnArrearThisVal;
					//$total_generated_amount += $GetPropertyRent["monthly_maint"] + $ReturnArrearThisVal;
					//$Total_total_rent_amount += $TempFinalAmount;
					/***************************************************************************************************/
					/***************************************************************************************************/
					/***************************************************************************************************/
					/**/$objSSSBillEntery->resetProperty();
					/**/$objSSSGetEmployeeID->resetProperty();
					/**/$rent_amount_id = $objSSSBillEntery->genCode("rs_tbl_inv_monthly_rent_amount", "rent_amount_id");	
					/**/$objSSSBillEntery->resetProperty();
					/**/$objSSSBillEntery->setProperty("rent_amount_id", $rent_amount_id);
					/**/$objSSSBillEntery->setProperty("monthly_rent_id", $monthly_rent_id);
					/**/$objSSSBillEntery->setProperty("tenant_id", $TenantList['tenant_id']);
					/**/$objSSSBillEntery->setProperty("employee_id", $objSSSGetEmployeeID->GetEmployeeID($GetPropertyRent['property_id']));
					/**/$objSSSBillEntery->setProperty("property_id", $ListofAssignProperties['property_id']);
					/**/$objSSSBillEntery->setProperty("monthly_amount", $GetPropertyRent["monthly_maint"]);
					/**/$objSSSBillEntery->setProperty("after_due_date", $MonthlyAmountThisTenant);
					/**/$objSSSBillEntery->setProperty("arrears_amount", $ReturnArrearThisVal);
					/**/$objSSSBillEntery->setProperty("total_amount", $TempFinalAmount);
					/**/$objSSSBillEntery->setProperty("received_amount", '0');
					/**/$objSSSBillEntery->setProperty("discount_status", 2);
					/**/if($InstallmentOption == 1){
					/**/$objSSSBillEntery->setProperty("installment_id", $InstallmentListID);	
					/**/$objSSSBillEntery->setProperty("installment_amount", $InstallMentAmount);
					/**/}
					/**/$objSSSBillEntery->setProperty("pending_amount", $GetPropertyRent["monthly_maint"]);
					/**/$objSSSBillEntery->setProperty("rent_status", 1);
					/**/$objSSSBillEntery->setProperty("rent_month", $RequestedMonth);
					/**/$objSSSBillEntery->setProperty("rent_year", $requestedYear);
					/**/$objSSSBillEntery->setProperty("entery_date", $entery_date);
					/**/$objSSSBillEntery->setProperty("isActive", $isActive);
					/**/$objSSSBillEntery->actMonthlyRentAmount('I');
					/***************************************************************************************************/
					/***************************************************************************************************/
					/***************************************************************************************************/
					$ReturnArrearThisVal = 0;
					$TempFinalAmount = 0;
			}
				
				
						$PendingArrearChargesCal = 0;
						$objSSSGetArrears->resetProperty();
						$objSSSGetArrears->setProperty("tenant_id", $TenantList['tenant_id']);
						$objSSSGetArrears->setProperty("rent_of_month", $GetLastMonth);
						$objSSSGetArrears->setProperty("rent_year", $GetLastYear);
						$objSSSGetArrears->setProperty("isActive", 1);
						$objSSSGetArrears->lstMonthlyRent();
						if($objSSSGetArrears->totalRecords() > 0){
						$FineArrearsValue = $objSSSGetArrears->dbFetchArray(1);
						$PendingArrearChargesCal = $FineArrearsValue["total_rent_amount"] - $FineArrearsValue["received_amount"];
						} else {
						$PendingArrearChargesCal = 0;	
						}
						
						//$Total_within_monthly_rent = $Total_within_monthly_rent + $PendingArrearChargesCal;
						//$Total_after_monthly_rent = $Total_after_monthly_rent + $PendingArrearChargesCal;
						//$total_generated_amount = $total_generated_amount + $PendingArrearChargesCal;
						
						$Total_within_monthly_rent += $PendingArrearChargesCal;
						$Total_after_monthly_rent += $PendingArrearChargesCal;
						$total_generated_amount += $PendingArrearChargesCal;
				
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
				/**/$GrandTotalWithinstallmentAmount = $Total_within_monthly_rent + $InstallMentAmount + $ThisTenantExtraCharges;
				
				
				
				/**/$objSSSBillEntery->resetProperty();
				/**/$objSSSBillEntery->setProperty("monthly_rent_id", $monthly_rent_id);
				/**/$objSSSBillEntery->setProperty("within_monthly_rent", $Total_within_monthly_rent);
				/**/$objSSSBillEntery->setProperty("after_monthly_rent", $Total_within_monthly_rent + 250);
				/**/$objSSSBillEntery->setProperty("arrears_rent", $PendingArrearChargesCal);
				/**/if($InstallmentOption == 1){
				/**/$objSSSBillEntery->setProperty("installment_amount", $InstallMentAmount);	
				/**/$objSSSBillEntery->setProperty("installment_status", 1);	
				/**///$objSSSBillEntery->setProperty("installment_id", $MainInstallmentID);
				/**///$objSSSBillEntery->setProperty("installment_list_id", $InstallmentListID);
				/**/}
				/**/if($ThisTenantExtraChargesStatus == 1){
				/**/$objSSSBillEntery->setProperty("extra_amount", $ThisTenantExtraCharges);	
				/**/$objSSSBillEntery->setProperty("extra_amount_status", 1);	
				/**/$objSSSBillEntery->setProperty("extra_amount_id",  $ThisTenantExtraChargesID);	
				/**///$objSSSBillEntery->setProperty("installment_id", $MainInstallmentID);
				/**///$objSSSBillEntery->setProperty("installment_list_id", $InstallmentListID);
				/**/}
				/**/$objSSSBillEntery->setProperty("total_rent_amount", $GrandTotalWithinstallmentAmount);
				/**/$objSSSBillEntery->actMonthlyRent('U');
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
				
					if($InstallmentOption == 1 && $CountNoOfInstallment==1){
						/**/$objSSSBillEntery->resetProperty();
						/**/$objSSSBillEntery->setProperty("tenant_installment_id", $MainInstallmentID);
						/**/$objSSSBillEntery->setProperty("installment_status", 1);
						/**/$objSSSBillEntery->actInstallmentPlan('U');
						//////////////////////////////////////////////////////////////////////////
						/**/$objSSSBillEntery->resetProperty();
						/**/$objSSSBillEntery->setProperty("installment_list_id", $InstallmentListID);
						/**/$objSSSBillEntery->setProperty("installment_status", 3);
						/**/$objSSSBillEntery->actInstallmentList('U');
					} elseif($InstallmentOption == 1 && $CountNoOfInstallment > 1){
						/**/$objSSSBillEntery->resetProperty();
						/**/$objSSSBillEntery->setProperty("installment_list_id", $InstallmentListID);
						/**/$objSSSBillEntery->setProperty("installment_status", 3);
						/**/$objSSSBillEntery->actInstallmentList('U');
					}
					
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
					
					if($ExtraChargesType == 2 && $ExtraChargesTypeUpdateOpt == 1 && $ThisTenantExtraChargesID != ''){
						/**/$objSSSUpdateExtraChgs->resetProperty();
						/**/$objSSSUpdateExtraChgs->setProperty("extra_charges_id", $ThisTenantExtraChargesID);
						/**/$objSSSUpdateExtraChgs->setProperty("type_status", 2);
						/**/$objSSSUpdateExtraChgs->actTenantExtraCharges('U');
					}
					
				/***************************************************************************************************/
				/***************************************************************************************************/
				/***************************************************************************************************/
//echo $Total_within_monthly_rent .'  ---  '. $InstallMentAmount .'  ---  '. $ThisTenantExtraCharges.'<br>';
	//echo $monthly_rent_id.'  -- '.$GrandTotalWithinstallmentAmount;
	/************************************/
	/**/ $MonthlyAmountThisTenant = 0;
	/**/ $TotalMonthlyAmount = 0;
	/**/ $Total_within_monthly_rent = 0;
	/**/ $Total_after_monthly_rent = 0;
	/**/ $Total_arrears_rent = 0;
	/**/ $Total_total_rent_amount = 0;
	/**/ $GrandTotalWithinstallmentAmount = 0;
	/**/ $InstallMentAmount = 0;
	/**/ $ThisTenantExtraCharges = 0;
	/************************************/
	
	//die();
	
}



/***************************************************************************************************/
/***************************************************************************************************/
/***************************************************************************************************/
/**/$objSSSinventory->resetProperty();
/**/$objSSSinventory->setProperty("generate_bill_id", $GetBillRequest["generate_bill_id"]);
/**/$objSSSinventory->setProperty("no_of_tenant", $TotalNumberofTenant);
/**/$objSSSinventory->setProperty("generated_amount", $total_generated_amount);
/**/$objSSSinventory->setProperty("process_status", 2);
/**/$objSSSinventory->actGenMonthlyBill('U');
/***************************************************************************************************/
/***************************************************************************************************/
/***************************************************************************************************/

//


}