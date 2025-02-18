<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	//print_r($_POST);
	//die();
	$tenant_id				= trim($_POST['t']);
	$total_pending_amount	= trim($_POST['total_pending_amount']);
	$discount_apply			= trim($_POST['discount_apply']);
	$discount_type			= trim($_POST['discount_type']);
	$discount_value			= trim($_POST['discount_value']);
	$pending_amount			= trim($_POST['pending_amount']);
	$no_of_installment		= trim($_POST['no_of_installment']);
	$installment_amount		= trim($_POST['installment_amount']);
	$monthly_rent_id		= trim($_POST["mi"]);
	$LastInstallmentId		= trim($_POST["tii"]);
	$isActive				= 1;
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	$currentMonth			= date('Y-m');
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("pending_amount", 'Pending amount' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				if($LastInstallmentId != ''){
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("tenant_installment_id", $LastInstallmentId);
				$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("isActive", 3);
				$objSSSinventory->actInstallmentPlan('U');
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("tenant_installment_id", $LastInstallmentId);
				$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("isActive", 3);
				$objSSSinventory->actInstallmentList('U');
				}
				
				$objSSSinventory->resetProperty();
				$tenant_installment_id = $objSSSinventory->genCode("rs_tbl_inv_tenant_installment_plan", "tenant_installment_id");		
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("tenant_installment_id", $tenant_installment_id);
				$objSSSinventory->setProperty("user_id", 1);
				$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("total_pending_amount", $total_pending_amount);
				$objSSSinventory->setProperty("pending_amount", $pending_amount);
				$objSSSinventory->setProperty("installment_amount", $installment_amount);
				$objSSSinventory->setProperty("discount_apply", $discount_apply);
				$objSSSinventory->setProperty("discount_type", $discount_type);
				$objSSSinventory->setProperty("discount_value", $discount_value);
				$objSSSinventory->setProperty("no_of_installment", $no_of_installment);
				$objSSSinventory->setProperty("installment_status", 2);
				$objSSSinventory->setProperty("installment_option", 2);
				$objSSSinventory->setProperty("enter_date", date('Y-m-d H:i:s'));
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->actInstallmentPlan('I');
				
				for($i=1;$i<=trim($no_of_installment);$i++){
					$InstallmentMonthYear = date('m-y', strtotime($currentMonth.' + '.$i.' Months'));
					list($PaymentMonth,$PaymentYear)= explode('-', $InstallmentMonthYear);
					$objSSSinventory->resetProperty();
					$installment_list_id = $objSSSinventory->genCode("rs_tbl_inv_tenant_installment_list", "installment_list_id");		
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("installment_list_id", $installment_list_id);
					$objSSSinventory->setProperty("tenant_installment_id", $tenant_installment_id);
					$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
					$objSSSinventory->setProperty("monthly_payment", $installment_amount);
					$objSSSinventory->setProperty("installment_option", 2);
					$objSSSinventory->setProperty("installment_month", $PaymentMonth);
					$objSSSinventory->setProperty("installment_year", $PaymentYear);
					
					$objSSSinventory->setProperty("installment_status", 2);
					$objSSSinventory->setProperty("entery_date", date('Y-m-d H:i:s'));
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->actInstallmentList('I');
				}
				
				
				
				
				/*********************************************************************************************************************************/			
				/*********************************************************************************************************************************/			
				/*********************************************************************************************************************************/			
				
						$objSSSInstallmentPlan = new SSSinventory;
						$objSSSInstallmentList = new SSSinventory;
						$objSSSInstallmentPlan->resetProperty();
						$objSSSInstallmentPlan->setProperty("isActive", 1);
						$objSSSInstallmentPlan->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
						$objSSSInstallmentPlan->setProperty("installment_status", 2);
						$objSSSInstallmentList->setProperty("ORDERBY", "tenant_installment_id DESC");
						$objSSSInstallmentPlan->lstInstallmentPlan();
						if($objSSSInstallmentPlan->totalRecords() > 0){
						$InstallmentPlanDetail = $objSSSInstallmentPlan->dbFetchArray(1);
						$MainInstallmentID = $InstallmentPlanDetail["tenant_installment_id"];
						$InstallmentOption = 1;
								/*************************************************************************************/
								$objSSSInstallmentList->resetProperty();
								$objSSSInstallmentList->setProperty("isActive", 1);
								$objSSSInstallmentList->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
								$objSSSInstallmentList->setProperty("tenant_installment_id", $MainInstallmentID);
								$objSSSInstallmentList->setProperty("installment_status", 2);
								$objSSSInstallmentList->setProperty("installment_option", 2);
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
					/*********************************************************************************************************************************/			
					/*********************************************************************************************************************************/			
					/*********************************************************************************************************************************/					
						
						$AfterDueDatePayment = $installment_amount + 500;
						/**/$objSSSinventory->resetProperty();				
						/**/$objSSSinventory->setProperty("monthly_rent_id", trim($objBF->decrypt($monthly_rent_id, 1, ENCRYPTION_KEY)));
						/**/$objSSSinventory->setProperty("installment_id", $MainInstallmentID);
						/**/$objSSSinventory->setProperty("installment_list_id", $InstallmentListID);
						/**/$objSSSinventory->setProperty("installment_status", 1);
						/**/$objSSSinventory->setProperty("installment_amount", $installment_amount);
						/**/$objSSSinventory->setProperty("total_rent_amount", $installment_amount);
						
						/**/$objSSSinventory->setProperty("within_monthly_rent", $installment_amount);
						/**/$objSSSinventory->setProperty("after_monthly_rent", $AfterDueDatePayment);
						
						/**/$objSSSinventory->actMonthlyRent('U');
						
							
							$objSSSUpdateInstallmentList = new SSSinventory;
							$objSSSinventory->resetProperty();
							$objSSSinventory->setProperty("isActive", 1);
							$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
							$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($monthly_rent_id, 1, ENCRYPTION_KEY)));
							$objSSSinventory->setProperty("ORDERBY", 'installment_list_id DESC');
							$objSSSinventory->lstInstallmentList();
							while($MonthlyInstallmentList = $objSSSinventory->dbFetchArray(1)){
									
									////////////////////////////////////////////////////////////////////////////////////
									////////////////////////////////////////////////////////////////////////////////////
									/**/$objSSSUpdateInstallmentList->resetProperty();				
									/**/$objSSSUpdateInstallmentList->setProperty("rent_amount_id", $MonthlyInstallmentList["rent_amount_id"]);
									/**/$objSSSUpdateInstallmentList->setProperty("monthly_rent_id", $MonthlyInstallmentList["monthly_rent_id"]);
									/**/$objSSSUpdateInstallmentList->setProperty("installment_id", $InstallmentListID);
									/**/$objSSSUpdateInstallmentList->setProperty("installment_amount", $installment_amount);
									/**/$objSSSUpdateInstallmentList->actMonthlyRentAmount('U');
									////////////////////////////////////////////////////////////////////////////////////
									////////////////////////////////////////////////////////////////////////////////////
									
							}
						
						
						$objCommon->setMessage('Tenant customize new installment has been updated successfully.', 'Info');
						$link = Route::_('show=installmentform&i='.EncData(trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)), 2, $objBF));
						redirect($link);
				
			}
						
	} 
	