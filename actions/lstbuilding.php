<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$building_no			= trim($_POST['building_no']);
	$block_id				= trim($_POST['block_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("building_no", 'Block name' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objSSSinventory->resetProperty();
				$building_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['building_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_building", "building_id");
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("building_id", $building_id);
				$objSSSinventory->setProperty("block_id", $block_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("building_no", $building_no);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isActive", $isActive);
				if($objSSSinventory->actBuilding($mode)){
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Building by ".$LoginUserInfo["fullname"]." -> (".$building_no .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Building info -> (".$building_no .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Building information detail has been saved successfully.', 'Info');
						$link = Route::_('show=lstbuilding');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$building_id = $_GET['i'];
	else if(isset($_POST['building_id']) && !empty($_POST['building_id']))
		$building_id = $_POST['building_id'];
	if(isset($building_id) && !empty($building_id)){
		$objSSSinventory->setProperty("building_id", trim($objBF->decrypt($building_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstBuildings();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}