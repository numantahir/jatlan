<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$block_name			= trim($_POST['block_name']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("block_name", 'Block name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSinventory->resetProperty();
				$block_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['block_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_block", "block_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("block_id", $block_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("block_name", $block_name);
				$objSSSinventory->setProperty("block_assign_status", 1);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isActive", $isActive);
				if($objSSSinventory->actBlocks($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Block by ".$LoginUserInfo["fullname"]." -> (".$block_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Block info -> (".$block_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Block information detail has been saved successfully.', 'Info');
						$link = Route::_('show=lstblock');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$block_id = $_GET['i'];
	else if(isset($_POST['block_id']) && !empty($_POST['block_id']))
		$block_id = $_POST['block_id'];
	if(isset($block_id) && !empty($block_id)){
		$objSSSinventory->setProperty("block_id", trim($objBF->decrypt($block_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstBlocks();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}