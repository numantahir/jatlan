<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
	
	$objQayaduser->resetProperty();
	$block_id		= $_POST['block_id'];
	$employee_id		= trim($_POST['employee_id']);
	$reg_date		= date('Y-m-d H:i:s');
	
				//echo $PropertyList["property_id"].'<br>';
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("employee_id", $employee_id);
				$objSSSinventory->setProperty("block_id", $block_id);
				$objSSSinventory->actAssignToEmployee('U');	
				
	
			$objCommon->setMessage('Selected block property has been reassigned successfully.', 'Info');
			$link = Route::_('show=lstassigntoemp');
			redirect($link);
}
?>