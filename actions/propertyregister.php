<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$objRoute 			= new Route;
	$objQayadProerty->resetProperty();
	$user_id				= trim($_POST['user_id']);
	$property_registered_id	= trim($_POST['property_registered_id']);
	$floor_number			= trim($_POST['floor_number']);
	$property_type_id		= trim($_POST['property_type_id']);
	$property_number		= trim($_POST['property_number']);
	$property_img_title		= trim($_POST['property_img_title']);
	$property_img_cord		= trim($_POST['property_img_cord']);
	$poperty_img_shap		= trim($_POST['poperty_img_shap']);
	$property_status 		= trim($_POST['property_status']);
	$book_duration 			= trim($_POST['book_duration']);
	$isActive 				= trim($_POST['isActive']);
	$property_desc 			= trim($_POST['property_desc']);
	$project_id				= trim($_POST['project_id']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	//////////////////////////////////////////////////////////////////////////////
	$share_20				= trim($_POST['share_20']);
	$share_10				= trim($_POST['share_10']);
	$share_5				= trim($_POST['share_5']);
	//////////////////////////////////////////////////////////////////////////////
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("property_registered_id", _PROPERTY_PROJECT . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("floor_number", _PROPERTY_FLOOR_NUMBER . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("property_type_id", _PROPERTY_AREA . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("property_number", _PROPERTY_NUMBER . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadProerty->resetProperty();
				$property_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['property_id'], 1, ENCRYPTION_KEY)) : $objQayadProerty->genCode("rs_tbl_property_detail", "property_id");
				
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("property_id", $property_id);
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
				$objQayadProerty->setProperty("property_registered_id", $property_registered_id);
				$objQayadProerty->setProperty("property_type_id", $property_type_id);
				$objQayadProerty->setProperty("propety_floor_id", $floor_number);
				$objQayadProerty->setProperty("property_number", $property_number);
				$objQayadProerty->setProperty("project_id", $project_id);
				//$objQayadProerty->setProperty("property_img_cord", $property_img_cord);
				//$objQayadProerty->setProperty("poperty_img_shap", $poperty_img_shap);
				$objQayadProerty->setProperty("property_status", $property_status);
				$objQayadProerty->setProperty("book_duration", $book_duration);
				$objQayadProerty->setProperty("property_desc", $property_desc);
				$objQayadProerty->setProperty("share_5", $share_5);
				$objQayadProerty->setProperty("share_10", $share_10);
				$objQayadProerty->setProperty("share_20", $share_20);
				$objQayadProerty->setProperty("entery_date", $entery_date);
				$objQayadProerty->setProperty("isActive", $isActive);
				if($objQayadProerty->actProperties($mode)){
					
					
					
					if(is_uploaded_file($_FILES['property_image']['tmp_name'])){
					include("classes/thumbnail.class.php");
					$objQayadProerty->resetProperty();
					$property_image = $objQayadProerty->getImagename($_FILES['property_image']['type'], $property_type_id);
					if(move_uploaded_file($_FILES['property_image']['tmp_name'], COMPANY_PROP_PATH . $property_image)){
					$property_image_folder = COMPANY_PROP_PATH . $property_image;
					$property_imageThumbFolder = COMPANY_PROP_THUMB_PATH;
					$property_imageThumbPath = COMPANY_PROP_THUMB_PATH . $property_image;
					copy($property_image_folder, $property_imageThumbPath);
					$ResizeSig = new Thumbnail($property_imageThumbPath, 800, 0, 75);
					$ResizeSig->save($property_imageThumbPath);						
					}
						$objQayadProerty->resetProperty();
						$objQayadProerty->setProperty("property_id", $property_id);
						$objQayadProerty->setProperty("property_img_cord", $property_image);
						$objQayadProerty->actProperties('U');
					}
					
					
					
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("property_type_id", $property_type_id);
				$objQayadProerty->lstPropertyType();
				$GetPropertySectionDetail = $objQayadProerty->dbFetchArray(1);
				
					$PropertyFloorId = $GetPropertySectionDetail["propety_floor_id"];
					
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("propety_floor_id", $PropertyFloorId);
					$objQayadProerty->lstPropertyFloorPlan();
					$FloorListTitle = $objQayadProerty->dbFetchArray(1);
					
					$GetFloorName = $FloorListTitle["floor_name"];
					$project_id = $FloorListTitle["project_id"];
					
					list($FloorFirstName, $FloorLastName)= explode(' ', $GetFloorName);
					
					
				if($share_20 > 0){	
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					for($s=1;$s<=$share_20;$s++){
							/****************************************/
							/****************************************/
							/**/$property_share_number = 
							/**/substr($FloorFirstName,0,1).''.
							/**/substr($FloorLastName,0,1).'.'.
							/**/$property_id.'.20.'.
							/**/str_pad($s, 6, '0', STR_PAD_LEFT);
							/****************************************/
							/****************************************/
							if($mode == 'I'){
							$objQayadProerty->resetProperty();
							$property_share_id = $objQayadProerty->genCode("rs_tbl_property_shares", "property_share_id");
							$objQayadProerty->resetProperty();
							$objQayadProerty->setProperty("property_share_id", $property_share_id);
							$objQayadProerty->setProperty("project_id", $project_id);
							$objQayadProerty->setProperty("property_id", $property_id);
							$objQayadProerty->setProperty("project_type_id", $property_type_id);
							$objQayadProerty->setProperty("property_floor_id", $PropertyFloorId);
							$objQayadProerty->setProperty("property_share_number", $property_share_number);
							$objQayadProerty->setProperty("property_share_status", 1);
							$objQayadProerty->setProperty("share_unit_size", '20');
							$objQayadProerty->setProperty("entery_datetime", $entery_date);
							$objQayadProerty->setProperty("isActive", $isActive);
							$objQayadProerty->actPropertyShares('I');
							}
					}
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
				}
				
				if($share_10 > 0){	
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					for($s=1;$s<=$share_10;$s++){
							/****************************************/
							/****************************************/
							/**/$property_share_number = 
							/**/substr($FloorFirstName,0,1).''.
							/**/substr($FloorLastName,0,1).'.'.
							/**/$property_id.'.10.'.
							/**/str_pad($s, 6, '0', STR_PAD_LEFT);
							/****************************************/
							/****************************************/
							if($mode == 'I'){
							$objQayadProerty->resetProperty();
							$property_share_id = $objQayadProerty->genCode("rs_tbl_property_shares", "property_share_id");
							$objQayadProerty->resetProperty();
							$objQayadProerty->setProperty("property_share_id", $property_share_id);
							$objQayadProerty->setProperty("project_id", $project_id);
							$objQayadProerty->setProperty("property_id", $property_id);
							$objQayadProerty->setProperty("project_type_id", $property_type_id);
							$objQayadProerty->setProperty("property_floor_id", $PropertyFloorId);
							$objQayadProerty->setProperty("property_share_number", $property_share_number);
							$objQayadProerty->setProperty("property_share_status", 1);
							$objQayadProerty->setProperty("share_unit_size", '10');
							$objQayadProerty->setProperty("entery_datetime", $entery_date);
							$objQayadProerty->setProperty("isActive", $isActive);
							$objQayadProerty->actPropertyShares('I');
							}
					}
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
				}
				
				if($share_5 > 0){	
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					for($s=1;$s<=$share_5;$s++){
							/****************************************/
							/****************************************/
							/**/$property_share_number = 
							/**/substr($FloorFirstName,0,1).''.
							/**/substr($FloorLastName,0,1).'.'.
							/**/$property_id.'.05.'.
							/**/str_pad($s, 6, '0', STR_PAD_LEFT);
							/****************************************/
							/****************************************/
							if($mode == 'I'){
							$objQayadProerty->resetProperty();
							$property_share_id = $objQayadProerty->genCode("rs_tbl_property_shares", "property_share_id");
							$objQayadProerty->resetProperty();
							$objQayadProerty->setProperty("property_share_id", $property_share_id);
							$objQayadProerty->setProperty("project_id", $project_id);
							$objQayadProerty->setProperty("property_id", $property_id);
							$objQayadProerty->setProperty("project_type_id", $property_type_id);
							$objQayadProerty->setProperty("property_floor_id", $PropertyFloorId);
							$objQayadProerty->setProperty("property_share_number", $property_share_number);
							$objQayadProerty->setProperty("property_share_status", 1);
							$objQayadProerty->setProperty("share_unit_size", '05');
							$objQayadProerty->setProperty("entery_datetime", $entery_date);
							$objQayadProerty->setProperty("isActive", $isActive);
							$objQayadProerty->actPropertyShares('I');
							}
					}
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
					///////////////////////////////////////////////////////////////
				}
				
				
				if($isActive == 1){
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("property_id", $property_id);
					$objQayadProerty->setProperty("isActive", 1);
					$objQayadProerty->actPropertyShares('U');
				} elseif($isActive == 1){
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("property_id", $property_id);
					$objQayadProerty->setProperty("isActive", 2);
					$objQayadProerty->actPropertyShares('U');
				}
				
				
					
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", $property_id);
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadProerty->setProperty("log_desc", "Create New Property by Admin -> (Floor#". $floor_number ." Property#".$property_number.")");
				} else {
				$objQayadProerty->setProperty("log_desc", "Admin Edit Property -> (Floor#". $floor_number ." Property#".$property_number.")");
				}
				$objQayadProerty->actPropertyLog("I");
						
						//$link = Route::_('show=ppproperties&i='.$objBF->encrypt($property_id, ENCRYPTION_KEY));
						$link = Route::_('show=properties');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$property_id = $_GET['i'];
	else if(isset($_POST['property_id']) && !empty($_POST['property_id']))
		$property_id = $_POST['property_id'];
	if(isset($property_id) && !empty($property_id)){
		$objQayadProerty->setProperty("property_id", trim($objBF->decrypt($property_id, 1, ENCRYPTION_KEY)));
		$objQayadProerty->lstProperties();
		$data = $objQayadProerty->dbFetchArray(1);
		$mode	= "U";
		extract($data);
		
		/*$objQayadProerty->resetProperty();
		$objQayadProerty->setProperty("property_id", $property_id);
		$objQayadProerty->lstPropertyPaymentDetail();
		$PropertyPayment = $objQayadProerty->dbFetchArray(1);*/
		//extract($PropertyPayment);
		
	}


}