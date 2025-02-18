<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$block_id		= $_POST['block_id'];
	$employee_id		= trim($_POST['employee_id']);
	$reg_date		= date('Y-m-d H:i:s');
	

	for($li=0;$li<=count($block_id);$li++){
		if($block_id[$li] != ''){
			
			$objSSSInsertInventory = new SSSinventory;
			$objSSSinventory->resetProperty();
			$objSSSinventory->setProperty("block_id", $block_id[$li]);
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

				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("block_id", $block_id[$li]);
				$objSSSinventory->setProperty("block_assign_status", 2);
				$objSSSinventory->actBlocks('U');
		}
	}
	
	
			$objCommon->setMessage('Selected block property has been assigned successfully.', 'Info');
			$link = Route::_('show=lstassigntoemp');
			redirect($link);
}
?>