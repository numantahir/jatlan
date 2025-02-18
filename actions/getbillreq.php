<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$current_month			= trim($_POST['current_month']);
	$current_year			= trim($_POST['current_year']);
	$due_date				= trim($_POST['due_date']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("current_month", 'Current Month' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("current_month", $current_month);
					$objSSSinventory->setProperty("current_year", $current_year);
					$objSSSinventory->lstGenMonthlyBill();
					if($objSSSinventory->totalRecords() > 0){

					
						$objCommon->setMessage('Selected month and year bill already generated.', 'error');
						$link = Route::_('show=getbillreqfrm');
						redirect($link);
						
						
					} else {
				
				
				$objSSSinventory->resetProperty();
				$generate_bill_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['generate_bill_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_monthly_bill_generate", "generate_bill_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("generate_bill_id", $generate_bill_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("current_month", $current_month);
				$objSSSinventory->setProperty("current_year", $current_year);
				$objSSSinventory->setProperty("no_of_tenant", '0');
				$objSSSinventory->setProperty("generated_amount", '0');
				$objSSSinventory->setProperty("due_date", $due_date);
				$objSSSinventory->setProperty("process_status", 3);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isAcitve", $isActive);
				if($objSSSinventory->actGenMonthlyBill($mode)){
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Tenant by ".$LoginUserInfo["fullname"]." -> (".$block_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Tenant info -> (".$block_name .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage('New month bill generating request has been submited successfully.', 'Info');
						$link = Route::_('show=getbillrequest');
						redirect($link);
				}
					}
				
			}
	} else {
	if($_GET['i'] != '' && trim(DecData($_GET["ac"], 1, $objBF)) == 'leave' && trim(DecData($_GET["emp"], 1, $objBF)) == 'yes' && trim(DecData($_GET["p"], 1, $objBF)) && trim(DecData($_GET["t"], 1, $objBF))){
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("assign_property_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->setProperty("leave_date", date("Y-m-d"));
				$objSSSinventory->setProperty("tenant_status", 2);
				$objSSSinventory->actTenantAssignProperty('U');
				/***********************************************************************************************/
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("property_id", trim(DecData($_GET["p"], 1, $objBF)));
				$objSSSinventory->setProperty("leave_date", date("Y-m-d"));
				$objSSSinventory->setProperty("tenant_status", 2);
				$objSSSinventory->actProperty('U');
				/***********************************************************************************************/
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." remove property from tenant Property ID -> (".trim(DecData($_GET["p"], 1, $objBF)).")");
				$objQayaduser->actUserLog("I");
				
				$objCommon->setMessage('Selected tenant property has been removed successfully.', 'Info');
				$link = Route::_('show=lsttenants&i='.EncData(trim(DecData($_GET["t"], 1, $objBF)), 2, $objBF));
				redirect($link);		
		
	} else {
	$NextMonth = date('m', strtotime('+1 month'));
	}
	 }/* else {
if(isset($_GET['i']) && !empty($_GET['i']))
		$generate_bill_id = $_GET['i'];
	else if(isset($_POST['generate_bill_id']) && !empty($_POST['generate_bill_id']))
		$generate_bill_id = $_POST['generate_bill_id'];
	if(isset($generate_bill_id) && !empty($generate_bill_id)){
		$objSSSinventory->setProperty("generate_bill_id", trim($objBF->decrypt($generate_bill_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstTenantInformation();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
	}
}*/