<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

//print_r($_FILE['project_image']);
//die();

	$objRoute 			= new Route;
	$objQayadProerty->resetProperty();

	$project_id				= trim($_POST['project_id']);
	$project_image			= $_FILE['project_image'];
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("project_id", 'Project Selection' . _IS_REQUIRED_FLD, "S");
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				
				if(is_uploaded_file($_FILES['project_image']['tmp_name'])){
					
					include("classes/thumbnail.class.php");
					
					$objQayadProerty->resetProperty();
					$project_gallery_id = $objQayadProerty->genCode("rs_tbl_projects_gallery", "project_gallery_id");
					
					$objQayadProerty->resetProperty();
					$project_image = $objQayadProerty->getImagename($_FILES['project_image']['type'], $project_gallery_id);
					
					if(move_uploaded_file($_FILES['project_image']['tmp_name'], COMPANY_PROJ_PATH . $project_image)){
						$project_image_folder = COMPANY_PROJ_PATH . $project_image;
						$project_imageThumbFolder = COMPANY_PROJ_THUMB_PATH;
						$project_imageThumbPath = COMPANY_PROJ_THUMB_PATH . $project_image;
						copy($project_image_folder, $project_imageThumbPath);
						$ResizeSig = new Thumbnail($project_imageThumbPath, 400, 0, 75);
						$ResizeSig->save($project_imageThumbPath);
					}
						/*****************************************************************/
						/*****************************************************************/
						$objQayadProerty->resetProperty();
						$objQayadProerty->setProperty("project_gallery_id", $project_gallery_id);
						$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
						$objQayadProerty->setProperty("project_id", $project_id);
						$objQayadProerty->setProperty("file_type", 1);
						$objQayadProerty->setProperty("file_name", $project_image);
						$objQayadProerty->setProperty("isActive", 1);
						$objQayadProerty->setProperty("entery_date", $entery_date);
						$objQayadProerty->actProjectGallery('I');
						/*****************************************************************/
						/*****************************************************************/
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", $project_id);
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadProerty->setProperty("log_desc", "Add New Project Image");
				} else {
				$objQayadProerty->setProperty("log_desc", "Edit Project Image");
				}
				$objQayadProerty->actPropertyLog("I");
						
						$objCommon->setMessage('Project image successfully uploaded.', 'Info');
						$link = Route::_('show=projectgallery&i='.EncData($project_id, 2, $objBF));
						redirect($link);
				}
				
			}
}
if($_GET["ac"] != ""){
if(trim($objBF->decrypt($_GET["ac"], 1, $objBF)) == 'DEL' && trim($objBF->decrypt($_GET["i"], 1, $objBF)) != "" && trim($objBF->decrypt($_GET["gi"], 1, $objBF)) != ""){

	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("project_gallery_id", trim($objBF->decrypt($_GET["gi"], 1, $objBF)));
	if($objQayadProerty->actProjectGallery('D')){
		
		$objCommon->setMessage('Project image delete successfully.', 'Info');
		$link = Route::_('show=projectgallery&i='.EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 2, $objBF));
		redirect($link);
							
	}
}
}