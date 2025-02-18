<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$floor_name			= trim($_POST['floor_name']);
	$building_combo				= trim($_POST['building_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	list($block_id,$building_id)= explode('-', $building_combo);
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("floor_name", 'Block name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSinventory->resetProperty();
				$floor_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['floor_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_floor", "floor_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("floor_id", $floor_id);
				$objSSSinventory->setProperty("block_id", $block_id);
				$objSSSinventory->setProperty("building_id", $building_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("floor_name", $floor_name);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isActive", $isActive);
				if($objSSSinventory->actFloor($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Floor by ".$LoginUserInfo["fullname"]." -> (".$floor_name .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Floor info -> (".$floor_name .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Floor information detail has been saved successfully.', 'Info');
						$link = Route::_('show=lstfloor');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$floor_id = $_GET['i'];
	else if(isset($_POST['floor_id']) && !empty($_POST['floor_id']))
		$floor_id = $_POST['floor_id'];
	if(isset($floor_id) && !empty($floor_id)){
		$objSSSinventory->setProperty("floor_id", trim($objBF->decrypt($floor_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstFloors();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}