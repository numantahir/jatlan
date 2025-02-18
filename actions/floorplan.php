<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$objRoute 			= new Route;
	$objQayadProerty->resetProperty();

	$propety_floor_id		= trim($_POST['propety_floor_id']);
	$project_id				= trim($_POST['project_id']);
	$project_type_id		= trim($_POST['project_type_id']);
	$floor_name				= trim($_POST['floor_name']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("project_id", _PROPERTY_PROJECT . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("project_type_id", _PROPERTY_PROJECT_TYPE . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("floor_name", _PROPERTY_FLOOR_NAME . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$objQayadProerty->resetProperty();
				$propety_floor_id = ($_POST['mode'] == "U") ? trim($objBF->decrypt($_POST['propety_floor_id'], 1, ENCRYPTION_KEY)) : $objQayadProerty->genCode("rs_tbl_property_floor_plan", "propety_floor_id");
				
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("propety_floor_id", $propety_floor_id);
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("project_id", $project_id);
				$objQayadProerty->setProperty("project_type_id", $project_type_id);
				$objQayadProerty->setProperty("floor_name", $floor_name);
				$objQayadProerty->setProperty("entery_date", $entery_date);
				if($objQayadProerty->actPropertyFloorPlan($mode)){
						
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", $project_id);
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadProerty->setProperty("log_desc", "Add New Property Floor Plan -> (Floor#". $floor_name .")");
				} else {
				$objQayadProerty->setProperty("log_desc", "Admin Edit Property Floor Plan -> (Floor#". $floor_name .")");
				}
				$objQayadProerty->actPropertyLog("I");
						
						$link = Route::_('show=floorplan');
						redirect($link);
				}
				
			}
	} else {
			
if(isset($_GET['i']) && !empty($_GET['i']))
		$propety_floor_id = $_GET['i'];
	else if(isset($_POST['propety_floor_id']) && !empty($_POST['propety_floor_id']))
		$propety_floor_id = $_POST['propety_floor_id'];
	if(isset($propety_floor_id) && !empty($propety_floor_id)){
		$objQayadProerty->setProperty("propety_floor_id", trim($objBF->decrypt($propety_floor_id, 1, ENCRYPTION_KEY)));
		$objQayadProerty->lstPropertyFloorPlan();
		$data = $objQayadProerty->dbFetchArray(1);
		$mode	= "U";
		extract($data);	
	}
}