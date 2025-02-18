<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["stg"] == 4 && trim(DecData($_POST["ai"], 1, $objBF)) != ""){
	
	$isActive			= 1;
	$aplic_date			= date('Y-m-d H:i:s');
	$aplic_id			= trim(DecData($_POST["ai"], 1, $objBF));
	$applicant_id		= trim(DecData($_POST["ci"], 1, $objBF));
	$nominee_id			= trim(DecData($_POST["ni"], 1, $objBF));
	
	include("classes/thumbnail.class.php");
		
				/*
				if($_POST['applicant_propfile_image_data'] != ''){
				$objQayadProerty->resetProperty();
				$applicant_profile_image = $objQayadProerty->getImagename('image/jpeg', rand(999,9999));
				
				$ApplicantPropfileImg = str_replace('data:image/jpeg;base64,', '', $_POST['applicant_propfile_image_data']);
				$ApplicantPropfileImg = str_replace(' ', '+', $ApplicantPropfileImg);
				$ApplicantPropfileImgDataFinal = base64_decode($ApplicantPropfileImg);
				if(file_put_contents(CUSTOMER_PROFILE_PATH.$applicant_profile_image, $ApplicantPropfileImgDataFinal)){
				//if(move_uploaded_file($_FILES['applicant_profile_image']['tmp_name'], CUSTOMER_PROFILE_PATH . $applicant_profile_image)){
				$applicant_profile_image_folder = CUSTOMER_PROFILE_PATH . $applicant_profile_image;
				$applicant_profile_imageThumbFolder = CUSTOMER_PROFILE_THUMB_PATH;
				$applicant_profile_imageThumbPath = CUSTOMER_PROFILE_THUMB_PATH . $applicant_profile_image;
				copy($applicant_profile_image_folder, $applicant_profile_imageThumbPath);
				$ResizeSig = new Thumbnail($applicant_profile_imageThumbPath, 250, 0, 100);
				$ResizeSig->save($applicant_profile_imageThumbPath);						
				}
				
					$Var_applicant_profile_image = $applicant_profile_image;
				} else {
					if($MainArrayData['applicant_profile_image'] ==''){
						$Var_applicant_profile_image = '';
					} else {
						$Var_applicant_profile_image = $MainArrayData['applicant_profile_image'];
					}
				}
				*/
				
				if(is_uploaded_file($_FILES['applicant_profile_image']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$applicant_profile_image = $objQayadProerty->getImagename($_FILES['applicant_profile_image']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['applicant_profile_image']['tmp_name'], CUSTOMER_PROFILE_PATH . $applicant_profile_image)){
				$applicant_profile_image_folder = CUSTOMER_PROFILE_PATH . $applicant_profile_image;
				$applicant_profile_imageThumbFolder = CUSTOMER_PROFILE_THUMB_PATH;
				$applicant_profile_imageThumbPath = CUSTOMER_PROFILE_THUMB_PATH . $applicant_profile_image;
				copy($applicant_profile_image_folder, $applicant_profile_imageThumbPath);
				$ResizeSig = new Thumbnail($applicant_profile_imageThumbPath, 250, 0, 100);
				$ResizeSig->save($applicant_profile_imageThumbPath);						
				}
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("customer_image", $applicant_profile_image);
					$objQayadapplication->actApplicationCustomer('U');
				} else { }
				
				if(is_uploaded_file($_FILES['applicant_cnic_front_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$applicant_cnic_front_side = $objQayadProerty->getImagename($_FILES['applicant_cnic_front_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['applicant_cnic_front_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $applicant_cnic_front_side)){
				$applicant_cnic_front_side_folder = CUSTOMER_DOCUMENT_PATH . $applicant_cnic_front_side;
				$applicant_cnic_front_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$applicant_cnic_front_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $applicant_cnic_front_side;
				copy($applicant_cnic_front_side_folder, $applicant_cnic_front_sideThumbPath);
				$ResizeSig = new Thumbnail($applicant_cnic_front_sideThumbPath, 250, 0, 100);
				$ResizeSig->save($applicant_cnic_front_sideThumbPath);						
				}
					$objQayadapplication->resetProperty();
					$applicant_cnic_front_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $applicant_cnic_front_side_id);
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Applicant CNIC Front-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Applicant cnic front-side copy attached.');
					$objQayadapplication->setProperty("url_key", 'applicant_cnic_front_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $applicant_cnic_front_side);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
				} else { }
				
				if(is_uploaded_file($_FILES['applicant_cnic_back_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$applicant_cnic_back_side = $objQayadProerty->getImagename($_FILES['applicant_cnic_back_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['applicant_cnic_back_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $applicant_cnic_back_side)){
				$applicant_cnic_back_side_folder = CUSTOMER_DOCUMENT_PATH . $applicant_cnic_back_side;
				$applicant_cnic_back_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$applicant_cnic_back_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $applicant_cnic_back_side;
				copy($applicant_cnic_back_side_folder, $applicant_cnic_back_sideThumbPath);
				$ResizeSig = new Thumbnail($applicant_cnic_back_sideThumbPath, 250, 0, 100);
				$ResizeSig->save($applicant_cnic_back_sideThumbPath);						
				}
					$objQayadapplication->resetProperty();
					$applicant_cnic_back_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $applicant_cnic_back_side_id);
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Applicant CNIC Back-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Applicant cnic Back-Side copy attached.');
					$objQayadapplication->setProperty("url_key", 'applicant_cnic_back_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $applicant_cnic_back_side);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
				} else { }
				
				if(is_uploaded_file($_FILES['applicant_signature']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$applicant_signature = $objQayadProerty->getImagename($_FILES['applicant_signature']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['applicant_signature']['tmp_name'], CUSTOMER_SIGNATURE_PATH . $applicant_signature)){
				$applicant_signature_folder = CUSTOMER_SIGNATURE_PATH . $applicant_signature;
				$applicant_signatureThumbFolder = CUSTOMER_SIGNATURE_THUMB_PATH;
				$applicant_signatureThumbPath = CUSTOMER_SIGNATURE_THUMB_PATH . $applicant_signature;
				copy($applicant_signature_folder, $applicant_signatureThumbPath);
				$ResizeSig = new Thumbnail($applicant_signatureThumbPath, 250, 0, 100);
				$ResizeSig->save($applicant_signatureThumbPath);						
				}
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("customer_sign", $applicant_signature);
					$objQayadapplication->actApplicationCustomer('U');
				} else { }
								
				if(is_uploaded_file($_FILES['nominee_cnic_front_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$nominee_cnic_front_side = $objQayadProerty->getImagename($_FILES['nominee_cnic_front_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['nominee_cnic_front_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $nominee_cnic_front_side)){
				$nominee_cnic_front_side_folder = CUSTOMER_DOCUMENT_PATH . $nominee_cnic_front_side;
				$nominee_cnic_front_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$nominee_cnic_front_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $nominee_cnic_front_side;
				copy($nominee_cnic_front_side_folder, $nominee_cnic_front_sideThumbPath);
				$ResizeSig = new Thumbnail($nominee_cnic_front_sideThumbPath, 250, 0, 100);
				$ResizeSig->save($nominee_cnic_front_sideThumbPath);						
				}
					$objQayadapplication->resetProperty();
					$nominee_cnic_front_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $nominee_cnic_front_side_id);
					$objQayadapplication->setProperty("customer_id", $nominee_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Nominee CNIC Front-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Nominee CNIC Front-Side Copy attached.');
					$objQayadapplication->setProperty("url_key", 'nominee_cnic_front_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $nominee_cnic_front_side);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
				} else { }
				
				if(is_uploaded_file($_FILES['nominee_cnic_back_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$nominee_cnic_back_side = $objQayadProerty->getImagename($_FILES['nominee_cnic_back_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['nominee_cnic_back_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $nominee_cnic_back_side)){
				$nominee_cnic_back_side_folder = CUSTOMER_DOCUMENT_PATH . $nominee_cnic_back_side;
				$nominee_cnic_back_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$nominee_cnic_back_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $nominee_cnic_back_side;
				copy($nominee_cnic_back_side_folder, $nominee_cnic_back_sideThumbPath);
				$ResizeSig = new Thumbnail($nominee_cnic_back_sideThumbPath, 250, 0, 100);
				$ResizeSig->save($nominee_cnic_back_sideThumbPath);						
				}
					$objQayadapplication->resetProperty();
					$nominee_cnic_back_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $nominee_cnic_back_side_id);
					$objQayadapplication->setProperty("customer_id", $nominee_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Nominee CNIC Back-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Nominee CNIC Back-Side Copy attached.');
					$objQayadapplication->setProperty("url_key", 'nominee_cnic_back_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $nominee_cnic_back_side);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
				} else { }
				
			//$objCommon->setMessage('Document uploaded and request forward to finance department successfully.', 'Info');
			$link = Route::_('show=lstaplicdoc');
			redirect($link);
}
?>