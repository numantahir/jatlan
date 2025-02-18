<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$floor_combo			= trim($_POST['floor_id']);
	$property_type			= trim($_POST['property_type']);
	$property_number		= trim($_POST['property_number']);
	$property_code			= trim($_POST['property_code']);
	$monthly_maint			= trim($_POST['monthly_maint']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	list($floor_id,$building_id,$block_id)= explode('-', $floor_combo);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("floor_id", 'Floor selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				$objSSSinventory->resetProperty();
				$GetBlockName = $objSSSinventory->GetBlockName($block_id);
				$objSSSinventory->resetProperty();
				$GetBuildingNo = $objSSSinventory->GetBuildingNumber($building_id);
				$objSSSinventory->resetProperty();
				$GetFloorName = $objSSSinventory->GetFloorName($floor_id);
				//
				$GeneratePropertyCode = $GetBlockName.'-'.sprintf("%03d", trim($GetBuildingNo)).'-'.$GetFloorName.'-'.$property_number.'-'.PropertyTypeShortCodeById($property_type);
				$objSSSinventory->resetProperty();
				$property_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['property_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_property", "property_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("property_id", $property_id);
				$objSSSinventory->setProperty("block_id", $block_id);
				$objSSSinventory->setProperty("building_id", $building_id);
				$objSSSinventory->setProperty("floor_id", $floor_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("property_type", $property_type);
				$objSSSinventory->setProperty("property_number", $property_number);
				$objSSSinventory->setProperty("property_code", $GeneratePropertyCode);
				$objSSSinventory->setProperty("monthly_maint", $monthly_maint);
				if($mode == 'I'){
				$objSSSinventory->setProperty("tenant_status", 2);
				}
				$objSSSinventory->setProperty("service_required", 2);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isActive", $isActive);
				if($objSSSinventory->actProperty($mode)){
				
				
				if($mode == 'I'){
				$objSSSInsertInventory = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("block_id", $block_id);
				$objSSSinventory->lstAssignToEmployeeProperty();
				$PreAssignPropertDetail = $objSSSinventory->dbFetchArray(1);
				
				$objSSSInsertInventory->resetProperty();
				$property_assign_id = $objSSSInsertInventory->genCode("rs_tbl_inv_assign_to_employee", "property_assign_id");
				$objSSSInsertInventory->resetProperty();
				$objSSSInsertInventory->setProperty("property_assign_id", $property_assign_id);
				$objSSSInsertInventory->setProperty("employee_id", $PreAssignPropertDetail["employee_id"]);
				$objSSSInsertInventory->setProperty("block_id", $block_id);
				$objSSSInsertInventory->setProperty("building_id", $building_id);
				$objSSSInsertInventory->setProperty("floor_id", $floor_id);
				$objSSSInsertInventory->setProperty("property_id", $property_id);
				$objSSSInsertInventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSInsertInventory->actAssignToEmployee('I');	
				}
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Property by ".$LoginUserInfo["fullname"]." -> (".$floor_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Property info -> (".$floor_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Property information detail has been saved successfully.', 'Info');
						$link = Route::_('show=lstproperty');
						redirect($link);
				}
				
			}
	} else {
			
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
}