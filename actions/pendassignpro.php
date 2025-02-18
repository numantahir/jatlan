<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$property_id		= $_POST['property_id'];
	$employee_id		= trim($_POST['employee_id']);
	$reg_date		= date('Y-m-d H:i:s');
	

	for($li=0;$li<=count($property_id);$li++){
		if($property_id[$li] != ''){
			
			$objSSSInsertInventory = new SSSinventory;
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("property_id", $property_id[$li]);
			$objSSSinventory->lstProperties();
			while($PropertyList = $objSSSinventory->dbFetchArray(1)){
				//echo $PropertyList["property_id"].'<br>';
				$objSSSInsertInventory->resetProperty();
				$property_assign_id = $objSSSInsertInventory->genCode("rs_tbl_inv_assign_to_employee", "property_assign_id");
				$objSSSInsertInventory->resetProperty();
				$objSSSInsertInventory->setProperty("property_assign_id", $property_assign_id);
				$objSSSInsertInventory->setProperty("employee_id", $employee_id);
				$objSSSInsertInventory->setProperty("block_id", $PropertyList["block_id"]);
				$objSSSInsertInventory->setProperty("building_id", $PropertyList["building_id"]);
				$objSSSInsertInventory->setProperty("floor_id", $PropertyList["floor_id"]);
				$objSSSInsertInventory->setProperty("property_id", $PropertyList["property_id"]);
				$objSSSInsertInventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSInsertInventory->actAssignToEmployee('I');		
			}
		}
	}
	
	
			$objCommon->setMessage('Selected property has been assigned successfully.', 'Info');
			$link = Route::_('show=pendassignpro');
			redirect($link);
}
?>