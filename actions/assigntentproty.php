<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$property_id	= $_POST['property_id'];
	$tenant_id		= trim($_POST['tenant_id']);
	$reg_date		= date('Y-m-d H:i:s');
	

	for($li=0;$li<=count($property_id);$li++){
		if($property_id[$li] != ''){
			
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("property_id", $property_id[$li]);
			$objSSSinventory->lstProperties();
			$RequestedPropertyDetail = $objSSSinventory->dbFetchArray(1);
			
			
			
			$objSSSinventory->resetProperty();
			$assign_property_id = $objSSSinventory->genCode("rs_tbl_inv_tenant_assign_property", "assign_property_id");
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("assign_property_id", $assign_property_id);
			$objSSSinventory->setProperty("tenant_id", $tenant_id);
			$objSSSinventory->setProperty("property_id", $property_id[$li]);
			$objSSSinventory->setProperty("block_id", $RequestedPropertyDetail["block_id"]);
			$objSSSinventory->setProperty("building_id", $RequestedPropertyDetail["building_id"]);
			$objSSSinventory->setProperty("floor_id", $RequestedPropertyDetail["floor_id"]);
			$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
			$objSSSinventory->setProperty("tenant_status", 1);
			$objSSSinventory->setProperty("entery_date", date('Y-m-d H:i:s'));
			$objSSSinventory->setProperty("isActive", 1);
			$objSSSinventory->actTenantAssignProperty('I');
				

					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("property_id", $property_id[$li]);
					$objSSSinventory->setProperty("tenant_status", 1);
					$objSSSinventory->actProperty('U');
		}
	}
	
	
			$objCommon->setMessage('Selected tenant property has been assigned successfully.', 'Info');
			$link = Route::_('show=lsttenants&i='.EncData($tenant_id, 2, $objBF));
			redirect($link);
}
?>