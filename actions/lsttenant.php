<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$tenant_name			= trim($_POST['tenant_name']);
	$tenant_cnic			= trim($_POST['tenant_cnic']);
	$tenant_phone			= trim($_POST['tenant_phone']);
	$tenant_joinin_date			= trim($_POST['tenant_joinin_date']);
	$tenant_shop_name			= trim($_POST['tenant_shop_name']);
	
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("tenant_name", 'Tenant name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("ORDERBY", 'group_id DESC');
				$objSSSinventory->lstTenantInformation();
				$GetLastGroupID = $objSSSinventory->dbFetchArray(1);
				$GenNewGroupID = $GetLastGroupID["group_id"] + 1;
				$objSSSinventory->resetProperty();
				$tenant_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['tenant_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_tenant_info", "tenant_id");
				$GeneratTenatCode = $GenNewGroupID.'-'.$tenant_id;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("tenant_id", $tenant_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("tenant_name", $tenant_name);
				$objSSSinventory->setProperty("tenant_cnic", $tenant_cnic);
				$objSSSinventory->setProperty("group_id", $GenNewGroupID);
				$objSSSinventory->setProperty("tenant_code", TenantCode($GeneratTenatCode));
				$objSSSinventory->setProperty("tenant_phone", $tenant_phone);
				$objSSSinventory->setProperty("tenant_joinin_date", $tenant_joinin_date);
				$objSSSinventory->setProperty("tenant_shop_name", $tenant_shop_name);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isActive", $isActive);
				if($objSSSinventory->actTenantInformation($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Tenant by ".$LoginUserInfo["fullname"]." -> (".$block_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Tenant info -> (".$block_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Tenant information detail has been saved successfully.', 'Info');
						$link = Route::_('show=lsttenants&i='.EncData($tenant_id, 2, $objBF));
						redirect($link);
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
if(isset($_GET['i']) && !empty($_GET['i']))
		$tenant_id = $_GET['i'];
	else if(isset($_POST['tenant_id']) && !empty($_POST['tenant_id']))
		$tenant_id = $_POST['tenant_id'];
	if(isset($tenant_id) && !empty($tenant_id)){
		$objSSSinventory->setProperty("tenant_id", trim($objBF->decrypt($tenant_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstTenantInformation();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
	}
}