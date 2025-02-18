<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$monthly_rent_id		= trim($_POST['monthly_rent_id']);
	$tenant_id				= trim($_POST['tenant_id']);
	$property_id			= trim($_POST['property_id']);
	$bill_no			= trim($_POST['bill_no']);
	$within_monthly_rent			= trim($_POST['within_monthly_rent']);
	
	
	
	
	
	
	$after_monthly_rent			= trim($_POST['after_monthly_rent']);
	$arrears_rent			= trim($_POST['arrears_rent']);
	$total_rent_amount			= trim($_POST['total_rent_amount']);
	$rent_of_month			= trim($_POST['rent_of_month']);
	$rent_year			= trim($_POST['rent_year']);
	$rent_status			= trim($_POST['rent_status']);
	$due_date			= trim($_POST['due_date']);
	$generate_date			= trim($_POST['generate_date']);
	
	
	$isActive				= 1;
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	
	
	$objSSSinventory->resetProperty();
	$objSSSinventory->setProperty("property_id", $property_id);
	$objSSSinventory->lstAssignToEmployeeProperty();
	$GetEmployeeId = $objSSSinventory->dbFetchArray(1);
	
	if($GetEmployeeId["employee_id"] != ''){
	$employee_id		= $GetEmployeeId["employee_id"];
	} else {
	$employee_id		= 1;
	}
	
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("property_id", 'Property selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSinventory->resetProperty();
				$monthly_rent_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['monthly_rent_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_monthly_rent", "monthly_rent_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
				$objSSSinventory->setProperty("property_id", $property_id);
				$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("employee_id", $employee_id);
				$objSSSinventory->setProperty("within_monthly_rent", $within_monthly_rent);
				$objSSSinventory->setProperty("after_monthly_rent", $after_monthly_rent);
				$objSSSinventory->setProperty("arrears_rent", $arrears_rent);
				$objSSSinventory->setProperty("total_rent_amount", $total_rent_amount);
				$objSSSinventory->setProperty("rent_of_month", $rent_of_month);
				$objSSSinventory->setProperty("rent_year", $rent_year);
				$objSSSinventory->setProperty("rent_status", $rent_status);
				$objSSSinventory->setProperty("bill_no", $bill_no);
				$objSSSinventory->setProperty("due_date", $due_date);
				$objSSSinventory->setProperty("generate_date", $generate_date);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isAcitve", $isActive);
				if($objSSSinventory->actMonthlyRent($mode)){
				
				/*$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Property by ".$LoginUserInfo["fullname"]." -> (".$floor_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Property info -> (".$floor_name .")");
				}
				$objQayaduser->actUserLog("I");*/
				
						$objCommon->setMessage('Property Pending Amount information detail has been saved successfully.', 'Info');
						$link = Route::_('show=lsttenants&i='.EncData(trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)), 1, $objBF));
						redirect($link);
				}
				
			}
	} /*else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$property_id = $_GET['i'];
	else if(isset($_POST['property_id']) && !empty($_POST['property_id']))
		$property_id = $_POST['property_id'];
	if(isset($property_id) && !empty($property_id)){
		$objSSSinventory->setProperty("property_id", trim($objBF->decrypt($property_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstProperties();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}*/