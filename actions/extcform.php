<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$tenant_id				= trim($_POST['tenant_id']);
	$extra_title			= trim($_POST['extra_title']);
	$extra_charges			= trim($_POST['extra_charges']);
	$extra_type			= trim($_POST['extra_type']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("tenant_id", 'Tenant' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				if($_POST['mode'] == "U"){
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("extra_charges_id", trim($objBF->decrypt($_POST['extra_charges_id'], 1, ENCRYPTION_KEY)));
				$objSSSinventory->lstTenantInformation();
				$GetTenantExtraCharges = $objSSSinventory->dbFetchArray(1);
				}
				$objSSSinventory->resetProperty();
				$extra_charges_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['extra_charges_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_tenant_extra_charges", "extra_charges_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("extra_charges_id", $extra_charges_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("tenant_id", $tenant_id);
				$objSSSinventory->setProperty("extra_title", $extra_title);
				$objSSSinventory->setProperty("extra_charges", $extra_charges);
				$objSSSinventory->setProperty("extra_type", $extra_type);
				$objSSSinventory->setProperty("type_status", 1);
				$objSSSinventory->setProperty("isActive", $isActive);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				if($objSSSinventory->actTenantExtraCharges($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Tenant Extra Charges by ".$LoginUserInfo["fullname"]." -> (".$tenant_id .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Tenant Extra Charges info -> (".$tenant_id.") OLD Amount ->".$GetTenantExtraCharges["extra_charges"]);
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Tenant extra charges information has been saved successfully.', 'Info');
						$link = Route::_('show=extracharges');
						redirect($link);
				}
				
			}
	} else {
if(isset($_GET['i']) && !empty($_GET['i']))
		$extra_charges_id = $_GET['i'];
	else if(isset($_POST['extra_charges_id']) && !empty($_POST['extra_charges_id']))
		$extra_charges_id = $_POST['extra_charges_id'];
	if(isset($extra_charges_id) && !empty($extra_charges_id)){
		$objSSSinventory->setProperty("extra_charges_id", trim($objBF->decrypt($extra_charges_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstTenantExtraCharges();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}