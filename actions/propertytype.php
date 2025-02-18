<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$objRoute 			= new Route;
	$objQayadProerty->resetProperty();

	$project_id				= trim($_POST['project_id']);
	$property_type_id		= trim($_POST['property_type_id']);
	$propety_floor_id		= trim($_POST['propety_floor_id']);
	$property_section		= trim($_POST['property_section']);
	$property_area			= trim($_POST['property_area']);
//	$property_rent_sqft		= trim($_POST['property_rent_sqft']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("propety_floor_id", $propety_floor_id);
	$objQayadProerty->lstPropertyFloorPlan();
	$GetProjectId = $objQayadProerty->dbFetchArray(1);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("project_id", _PROPERTY_PROJECT . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("propety_floor_id", _PROPERTY_FLOOR_NAME . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("property_section", _PROPERTY_NUMBER . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("property_area", _PROPERTY_AREA . _IS_REQUIRED_FLD, "S");
//	$objValidate->setCheckField("property_rent_sqft", _PROPERTY_SQFT_RATE . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadProerty->resetProperty();
				$property_type_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['property_type_id'], 1, ENCRYPTION_KEY)) : $objQayadProerty->genCode("rs_tbl_property_type", "property_type_id");
				
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("property_type_id", $property_type_id);
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("project_id", $project_id);
				$objQayadProerty->setProperty("project_type_id", $GetProjectId["project_type_id"]);
				$objQayadProerty->setProperty("propety_floor_id", $propety_floor_id);
				$objQayadProerty->setProperty("property_section", $property_section);
				$objQayadProerty->setProperty("property_area", $property_area);
//				$objQayadProerty->setProperty("property_rent_sqft", $property_rent_sqft);
				$objQayadProerty->setProperty("entery_date", $entery_date);
				if($objQayadProerty->actPropertyType($mode)){
				
				
				
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
					$objQayadProerty->setProperty("property_type_id", $property_type_id);
					$objQayadProerty->setProperty("property_image", $property_image);
					$objQayadProerty->actPropertyType('U');
				}
				
				if(is_uploaded_file($_FILES['property_banner']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$property_banner = $objQayadProerty->getImagename($_FILES['property_banner']['type'], $property_type_id);
				if(move_uploaded_file($_FILES['property_banner']['tmp_name'], COMPANY_PROP_PATH . $property_banner)){
				
				}
				
					$objQayadProertyBanner = new Qayadproperty;
					$objQayadProertyBanner->setProperty("property_type_id", $property_type_id);
					$objQayadProertyBanner->setProperty("property_banner", $property_banner);
					$objQayadProertyBanner->actPropertyType('U');	
									
				} 
								
				
				
				
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", $property_type_id);
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadProerty->setProperty("log_desc", "Add New Property Type -> (Floor# ". $GetProjectId["floor_name"] . ", Property#". $property_section . ", Property Area". $property_area .")");
				} else {
				$objQayadProerty->setProperty("log_desc", "Edit Property Type -> (Floor# ". $GetProjectId["floor_name"] . ", Property#". $property_section . ", Property Area". $property_area .")");
				}
				$objQayadProerty->actPropertyLog("I");
						
						$link = Route::_('show=propertytype');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$property_type_id = $_GET['i'];
	else if(isset($_POST['property_type_id']) && !empty($_POST['property_type_id']))
		$property_type_id = $_POST['propety_floor_id'];
	if(isset($property_type_id) && !empty($property_type_id)){
		$objQayadProerty->setProperty("property_type_id", trim($objBF->decrypt($property_type_id, 1, ENCRYPTION_KEY)));
		$objQayadProerty->lstPropertyType();
		$data = $objQayadProerty->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}