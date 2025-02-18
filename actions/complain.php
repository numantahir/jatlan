<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$property_id			= trim($_POST['property_id']);
	$category_id			= trim($_POST['category_id']);
	$complain_text			= trim($_POST['complain_text']);
	$assign_to_id			= trim($_POST['assign_to_id']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("property_id", 'Property Select' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("category_id", 'Category Select' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				//complain_picture
				
				/*if(is_uploaded_file($_FILES['complain_picture']['tmp_name'])){
				$objSSSinventory->resetProperty();
				$applicant_profile_image = $objSSSinventory->getImagename($_FILES['complain_picture']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['complain_picture']['tmp_name'], CUSTOMER_PROFILE_PATH . $applicant_profile_image)){			
				}
				} */
				
				$objSSSinventory->resetProperty();
				$complain_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['complain_id'], 1, ENCRYPTION_KEY)) : $objSSSinventory->genCode("rs_tbl_inv_complain_detail", "complain_id");
				$GetComplainNumber = CreateInvoiceNumber($complain_id);
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("complain_id", $complain_id);
				$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("property_id", $property_id);
				$objSSSinventory->setProperty("category_id", $category_id);
				$objSSSinventory->setProperty("complain_text", $complain_text);
				
				
				$objSSSinventory->setProperty("complain_reg_date", $entery_date);
				$objSSSinventory->setProperty("complain_number", $GetComplainNumber);
				$objSSSinventory->setProperty("complain_status", 2);
				$objSSSinventory->setProperty("entery_date", $entery_date);
				$objSSSinventory->setProperty("isActive", $isActive);
				if($objSSSinventory->actComplain($mode)){
						
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("isAcitve", 1);
						$objSSSinventory->setProperty("complain_id", $complain_id);
						$objSSSinventory->lstComplainAssign();
						$ComplainAssignTo = $objSSSinventory->dbFetchArray(1);
						
						if($_POST['mode'] == "U" && $ComplainAssignTo["assign_to_id"] != $assign_to_id){	
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("complain_id", $complain_id);
						$objSSSinventory->setProperty("isAcitve", 3);
						$objSSSinventory->actComplainAssign('U');
						
						$objSSSinventory->resetProperty();
						$complain_assign_id = $objSSSinventory->genCode("rs_tbl_inv_complain_assign", "complain_assign_id");
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("complain_assign_id", $complain_assign_id);
						$objSSSinventory->setProperty("complain_id", $complain_id);
						$objSSSinventory->setProperty("assign_to_id", $assign_to_id);
						$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("assign_from_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("assign_date", $entery_date);
						$objSSSinventory->setProperty("entery_date", $entery_date);
						$objSSSinventory->setProperty("isActive", $isActive);
						$objSSSinventory->actComplainAssign('I');
						
						} elseif($_POST['mode'] == "I") {
						$objSSSinventory->resetProperty();
						$complain_assign_id = $objSSSinventory->genCode("rs_tbl_inv_complain_assign", "complain_assign_id");
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("complain_assign_id", $complain_assign_id);
						$objSSSinventory->setProperty("complain_id", $complain_id);
						$objSSSinventory->setProperty("assign_to_id", $assign_to_id);
						$objSSSinventory->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("assign_from_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objSSSinventory->setProperty("assign_date", $entery_date);
						$objSSSinventory->setProperty("entery_date", $entery_date);
						$objSSSinventory->setProperty("isActive", $isActive);
						$objSSSinventory->actComplainAssign('I');
						}
						
				
				
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayaduser->setProperty("activity_detail", "Add New Complain by ".$LoginUserInfo["fullname"]." -> (".$GetComplainNumber .")");
				} else {
				$objQayaduser->setProperty("activity_detail", $LoginUserInfo["fullname"]." Edit Complain info -> (".$GetComplainNumber .")");
				}
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Complain information detail has been saved successfully.', 'Info');
						$link = Route::_('show=complain');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$complain_id = $_GET['i'];
	else if(isset($_POST['complain_id']) && !empty($_POST['complain_id']))
		$complain_id = $_POST['complain_id'];
	if(isset($complain_id) && !empty($complain_id)){
		$objSSSinventory->resetProperty();
		$objSSSinventory->setProperty("complain_id", trim($objBF->decrypt($complain_id, 1, ENCRYPTION_KEY)));
		$objSSSinventory->lstComplain();
		$data = $objSSSinventory->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
		
		$objSSSinventory->resetProperty();
		$objSSSinventory->setProperty("isAcitve", 1);
		$objSSSinventory->setProperty("complain_id", $complain_id);
		$objSSSinventory->lstComplainAssign();
		$ComplainAssignTo = $objSSSinventory->dbFetchArray(1);
		$assign_to_id = $ComplainAssignTo["assign_to_id"];
		$complain_assign_id = $ComplainAssignTo["complain_assign_id"];
	}
}