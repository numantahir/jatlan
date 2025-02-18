<?php
$mode = 'I';
$DummyArray = array();
if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 6 && $_POST["typemode"] == 'searchcnic'){
	$GetCustomerCnic = trim($_POST["customer_old_cnic"]);
	$objQayadapplication->resetProperty();
	$objQayadapplication->setProperty("customer_cnic", $GetCustomerCnic);
	$objQayadapplication->lstApplicationCustomer();
	if($objQayadapplication->totalRecords() > 0){
	$data = $objQayadapplication->dbFetchArray(1);
	$customer_old_id = $data["customer_id"];
	$customer_mode = "U";
	$FieldOption = 1;
	extract($data);
	} else {
	$objCommon->setMessage('No record found.', 'Error');
	}
	$customer_nominee_mode = 'I';
}

if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 1){
	
	
	$AppStage 				= trim(DecData($_POST["stage"], 1, $objBF));
	$PropertyRegisterId		= trim($_POST["property_registered_id"]);
	$floor_number			= trim($_POST["floor_number"]);
	$property_type_id		= trim($_POST["property_type_id"]);
							  unset($_SESSION['JointAplicInfo']);
							  unset($_SESSION['InfoDetail']);
	$BuildLink = $PropertyRegisterId.'&'.$floor_number.'&'.$property_type_id;
	$link = Route::_('show=newappreg&stage='.EncData('2', 1, $objBF).'&bl='.EncData($BuildLink, 2, $objBF));
	redirect($link);
}

if(trim(DecData($_GET["stage"], 1, $objBF)) != 1 && trim(DecData($_GET["stage"], 1, $objBF)) !='' && trim(DecData($_GET["stage"], 1, $objBF)) != 6){
	
	$Getbbl = trim(DecData($_GET["bl"], 1, $objBF));
	list($pri,$fn,$pti)= explode('&', $Getbbl);

	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("property_type_id", $pti);
	$objQayadProerty->lstPropertyType();
	$PropertyTypeDetail = $objQayadProerty->dbFetchArray(1);
	
	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("propety_floor_id", $fn);
	$objQayadProerty->lstPropertyFloorPlan();
	$FloorNumber = $objQayadProerty->dbFetchArray(1);
	
	$objQayadProerty->resetProperty();
	$GetPropertyNumber = $objQayadProerty->PropertyNumber($pri);
	if(trim(DecData($_GET["pi"], 1, $objBF)) != ""){
	$objQayadProerty->resetProperty();
	/*$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("property_id", trim(DecData($_GET["pi"], 1, $objBF)));
	$objQayadProerty->lstPropertyUnitDetail();
	$SelectivePropertyDetail = $objQayadProerty->getSQL();
	print_r($SelectivePropertyDetail);
	die();*/
	$CurrentUnitPrice = $objQayadProerty->FloorCurrentPrice($FloorNumber["propety_floor_id"]);
	}
}

if(trim(DecData($_GET["stage"], 1, $objBF)) == 3){
	
	if($_SESSION['InfoDetail']['pi']!=''){
	$property_share_id_get = trim(DecData($_SESSION['InfoDetail']['ui'], 1, $objBF));	
	} else {
	$property_share_id_get = trim(DecData($_GET['ui'], 1, $objBF));
	}
	$objQayadProerty->resetProperty();
	$objQayadProerty->setProperty("property_share_id", $property_share_id_get);
	$objQayadProerty->setProperty("lock_status", 1);
	$objQayadProerty->lstUnitTempLock();
	$CountLockRecord = $objQayadProerty->totalRecords();
	$GetLockedDuration = $objQayadProerty->dbFetchArray(1);
	if($CountLockRecord >= 1){
	$customer_fname 		= $GetLockedDuration["customer_fname"];
	$customer_lname 		= $GetLockedDuration["customer_lname"];
	$customer_of	 		= $GetLockedDuration["customer_of"];
	$customer_father 		= $GetLockedDuration["customer_father"];
	$customer_cnic 			= $GetLockedDuration["customer_cnic"];
	$customer_email 		= $GetLockedDuration["customer_email"];
	$customer_c_address 	= $GetLockedDuration["customer_c_address"];
	$customer_p_address 	= $GetLockedDuration["customer_p_address"];
	$customer_phone 		= $GetLockedDuration["customer_phone"];
	$customer_mobile 		= $GetLockedDuration["customer_mobile"];
	$customer_mobile_2 		= $GetLockedDuration["customer_mobile_2"];
	
	$objQayadapplication->resetProperty();
	$objQayadapplication->setProperty("customer_cnic", $customer_cnic);
	$objQayadapplication->lstApplicationCustomer();
	$CountCNICRec = $objQayadapplication->totalRecords();
	if($CountCNICRec > 0){
	$GetOldCustomerId = $objQayadapplication->dbFetchArray(1);
	$customer_old_id = $GetOldCustomerId["customer_id"];
	$customer_mode = "U";
	$FieldOption = 1;
	} else {
	$customer_mode = "I";	
	}
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 3){
	if($_POST["mode"] == 'I'){
		if($_SESSION['InfoDetail'] !=''){
			unset($_SESSION['InfoDetail']);	
			$_SESSION['InfoDetail'] = $_POST;
		} else {
			$_SESSION['InfoDetail'] = $_POST;	
		}
	} elseif($_POST["mode"] == 'U'){
	
	/**///////////////////////////////////////////////////////////////////////////////////
	/**///////////////////////////////////////////////////////////////////////////////////
	/**/$MainArrayData = $_SESSION['InfoDetail'];
	/**/$MakePostArray = array(
	/**/"registration_type" => $_POST["registration_type"], 
	/**/"customer_fname" => $_POST["customer_fname"], 
	/**/"customer_lname" => $_POST["customer_lname"], 
	/**/"customer_of" => $_POST["customer_of"], 
	/**/"customer_father" => $_POST["customer_father"], 
	/**/"customer_cnic" => $_POST["customer_cnic"], 
	/**/"customer_email" => $_POST["customer_email"], 
	/**/"customer_c_address" => $_POST["customer_c_address"], 
	/**/"customer_p_address" => $_POST["customer_p_address"], 
	/**/"customer_phone" => $_POST["customer_phone"], 
	/**/"customer_mobile" => $_POST["customer_mobile"], 
	/**/"customer_mobile_2" => $_POST["customer_mobile_2"], 
	/**/"n_customer_fname" => $_POST["n_customer_fname"], 
	/**/"n_customer_lname" => $_POST["n_customer_lname"], 
	/**/"n_customer_of" => $_POST["n_customer_of"], 
	/**/"n_customer_father" => $_POST["n_customer_father"], 
	/**/"n_customer_cnic" => $_POST["n_customer_cnic"], 
	/**/"customer_relation_name" => $_POST["customer_relation_name"], 
	/**/"n_customer_c_address" => $_POST["n_customer_c_address"],
	/**/"joint_aplic_opt" => $_POST["joint_aplic_opt"],
	/**/"ja_customer_fname" => $_POST["ja_customer_fname"],
	/**/"ja_customer_lname" => $_POST["ja_customer_lname"],
	/**/"ja_customer_of" => $_POST["ja_customer_of"],
	/**/"ja_customer_father" => $_POST["ja_customer_father"],
	/**/"ja_customer_cnic" => $_POST["ja_customer_cnic"],
	/**/"ja_customer_email" => $_POST["ja_customer_email"],
	/**/"ja_customer_c_address" => $_POST["ja_customer_c_address"],
	/**/"ja_customer_p_address" => $_POST["ja_customer_p_address"],
	/**/"ja_customer_phone" => $_POST["ja_customer_phone"],
	/**/"ja_customer_mobile" => $_POST["ja_customer_mobile"],
	/**/"ja_customer_mobile_2" => $_POST["ja_customer_mobile_2"],
	/**/"ja_n_customer_fname" => $_POST["ja_n_customer_fname"],
	/**/"ja_n_customer_lname" => $_POST["ja_n_customer_lname"],
	/**/"ja_n_customer_of" => $_POST["ja_n_customer_of"],
	/**/"ja_n_customer_father" => $_POST["ja_n_customer_father"],
	/**/"ja_n_customer_cnic" => $_POST["ja_n_customer_cnic"],
	/**/"ja_customer_relation_name" => $_POST["ja_customer_relation_name"],
	/**/"ja_n_customer_c_address" => $_POST["ja_n_customer_c_address"],
	/**/"aplic_desc" => $_POST["aplic_desc"],
	/**/"seller_agent_id" => $_POST["seller_agent_id"],
	/**/"declaration_status" => $_POST["declaration_status"],
	/**/"lkc" => $_POST["lkc"],
	/**/"lk" => $_POST["lk"],
	/**/"customer_mode" => $_POST["customer_mode"],
	/**/"customer_old_id" => $_POST["customer_old_id"],
	/**/"applic_reg_date" => $_POST["applic_reg_date"],
	/**/"payment_mode" => $_POST["payment_mode"],
	/**/"no_of_shares" => $_POST["no_of_shares"],
	/**/"aplic_reg_type" => $_POST["aplic_reg_type"]);
	/**/$NewApplicationValue = array_replace($DummyArray, $MainArrayData, $MakePostArray);
	/**/unset($_SESSION['InfoDetail']);	
	/**/$NewUpdatedValue = array_merge($MainArrayData, $NewApplicationValue);
	/**/$_SESSION['InfoDetail'] = $NewUpdatedValue;
	/**///////////////////////////////////////////////////////////////////////////////////
	/**///////////////////////////////////////////////////////////////////////////////////
	}
	
	$BLValue = trim(DecData($_POST["bl"], 1, $objBF));
	$PIValue = trim(DecData($_POST["pi"], 1, $objBF));
	$UIValue = trim(DecData($_POST["ui"], 1, $objBF));
	$link = Route::_('show=newappreg&stage='.EncData('5', 2, $objBF).'&bl='.EncData($BLValue, 2, $objBF).'&pi='.EncData($PIValue, 2, $objBF).'&ui='.EncData($UIValue, 2, $objBF));
	redirect($link);
}

if((trim(DecData($_GET["stage"], 1, $objBF)) == 4 or trim(DecData($_GET["stage"], 1, $objBF)) == 5) && trim(DecData($_GET["stage"], 1, $objBF)) !=''){
	//print_r($_SESSION['InfoDetail']);
	list($af_pri,$af_fn,$af_pti)= explode('&', trim(DecData($_SESSION['InfoDetail']['bl'], 1, $objBF)));
	$CurrentSValue = $_SESSION['InfoDetail'];
	if($_SESSION['InfoDetail']['customer_mode'] == 'U'){
		$objQayadapplication->resetProperty();
		$objQayadapplication->setProperty("customer_id", $_SESSION['InfoDetail']['customer_old_id']);
		$objQayadapplication->lstApplicationCustomer();
		$GetCustomerDoc = $objQayadapplication->dbFetchArray(1);
		$StoreCustomerDocImgName = array();
		$objQayadapplicationCNIC = new Qayadapplication;
		$objQayadapplicationCNIC->setProperty("customer_id", $_SESSION['InfoDetail']['customer_old_id']);
		$objQayadapplicationCNIC->lstGeneralDocument();
		while($GetCustomerCNICFrontSide = $objQayadapplicationCNIC->dbFetchArray(1)){
		$StoreCustomerDocImgName[$GetCustomerCNICFrontSide["url_key"]] = $GetCustomerCNICFrontSide["document_filename"];
		} if($GetCustomerDoc["customer_image"] !=''){
			$CustomerProfileImageName = $GetCustomerDoc["customer_image"];
		} } if($_SESSION['InfoDetail']['customer_nominee_mode'] == 'U'){
		$StoreNomineeDocImgName = array();
		$objQayadapplicationNomineeCNIC = new Qayadapplication;
		$objQayadapplicationNomineeCNIC->setProperty("customer_id", $_SESSION['InfoDetail']['customer_nominee_old_id']);
		$objQayadapplicationNomineeCNIC->lstGeneralDocument();
		while($GetNomineeCNICFrontSide = $objQayadapplicationNomineeCNIC->dbFetchArray(1)){
		$StoreNomineeDocImgName[$GetNomineeCNICFrontSide["url_key"]] = $GetNomineeCNICFrontSide["document_filename"];
		}
	}
}

if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 4){
	
	include("classes/thumbnail.class.php");
	$MainArrayData = $_SESSION['InfoDetail'];
	
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
					$Var_applicant_profile_image = $applicant_profile_image;
				} else {
					if($MainArrayData['applicant_profile_image'] ==''){
						$Var_applicant_profile_image = '';
					} else {
						$Var_applicant_profile_image = $MainArrayData['applicant_profile_image'];
					}
				}
				
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
					$Var_applicant_cnic_front_side = $applicant_cnic_front_side;
				} else {
					if($MainArrayData['applicant_cnic_front_side'] ==''){
						$Var_applicant_cnic_front_side = '';
					} else {
						$Var_applicant_cnic_front_side = $MainArrayData['applicant_cnic_front_side'];
					}
				}
				
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
					$Var_applicant_cnic_back_side = $applicant_cnic_back_side;
				} else {
					if($MainArrayData['applicant_cnic_back_side'] ==''){
						$Var_applicant_cnic_back_side = '';
					} else {
						$Var_applicant_cnic_back_side = $MainArrayData['applicant_cnic_back_side'];
					}
				}
				
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
					$Var_applicant_signature = $applicant_signature;
				} else {
					if($MainArrayData['applicant_signature'] ==''){
						$Var_applicant_signature = '';
					} else {
						$Var_applicant_signature = $MainArrayData['applicant_signature'];
					}
				}
				
				if(is_uploaded_file($_FILES['applicant_passport_copy']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$applicant_passport_copy = $objQayadProerty->getImagename($_FILES['applicant_passport_copy']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['applicant_passport_copy']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $applicant_passport_copy)){
				$applicant_passport_copy_folder = CUSTOMER_DOCUMENT_PATH . $applicant_passport_copy;
				$applicant_passport_copyThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$applicant_passport_copyThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $applicant_passport_copy;
				copy($applicant_passport_copy_folder, $applicant_passport_copyThumbPath);
				$ResizeSig = new Thumbnail($applicant_passport_copyThumbPath, 250, 0, 100);
				$ResizeSig->save($applicant_passport_copyThumbPath);						
				}
					$Var_applicant_passport_copy = $applicant_passport_copy;
				} else {
					if($MainArrayData['applicant_passport_copy'] ==''){
						$Var_applicant_passport_copy = '';
					} else {
						$Var_applicant_passport_copy = $MainArrayData['applicant_passport_copy'];
					}
				}
				
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
					$Var_nominee_cnic_front_side = $nominee_cnic_front_side;
				} else {
					if($MainArrayData['nominee_cnic_front_side'] ==''){
						$Var_nominee_cnic_front_side = '';
					} else {
						$Var_nominee_cnic_front_side = $MainArrayData['nominee_cnic_front_side'];
					}
				}
				
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
					$Var_nominee_cnic_back_side = $nominee_cnic_back_side;
				} else {
					if($MainArrayData['nominee_cnic_back_side'] ==''){
						$Var_nominee_cnic_back_side = '';
					} else {
						$Var_nominee_cnic_back_side = $MainArrayData['nominee_cnic_back_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['nominee_passport_copy']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$nominee_passport_copy = $objQayadProerty->getImagename($_FILES['nominee_passport_copy']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['nominee_passport_copy']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $nominee_passport_copy)){
				$nominee_passport_copy_folder = CUSTOMER_DOCUMENT_PATH . $nominee_passport_copy;
				$nominee_passport_copyThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$nominee_passport_copyThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $nominee_passport_copy;
				copy($nominee_passport_copy_folder, $nominee_passport_copyThumbPath);
				$ResizeSig = new Thumbnail($nominee_passport_copyThumbPath, 250, 0, 100);
				$ResizeSig->save($nominee_passport_copyThumbPath);						
				}
					$Var_nominee_passport_copy = $nominee_passport_copy;
				} else {
					if($MainArrayData['nominee_passport_copy'] == ''){
						$Var_nominee_passport_copy = '';
					} else {
						$Var_nominee_passport_copy = $MainArrayData['nominee_passport_copy'];
					}
				}
				
		/************************************************************************************/
			/*	if($_SESSION['InfoDetail']["joint_aplic_opt"]==1){
				//////////////////////////////////////////////////
				
				if(is_uploaded_file($_FILES['joint_applicant_profile_image']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_profile_image = $objQayadProerty->getImagename($_FILES['joint_applicant_profile_image']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_profile_image']['tmp_name'], CUSTOMER_PROFILE_PATH . $joint_applicant_profile_image)){
				$joint_applicant_profile_image_folder = CUSTOMER_PROFILE_PATH . $joint_applicant_profile_image;
				$joint_applicant_profile_imageThumbFolder = CUSTOMER_PROFILE_THUMB_PATH;
				$joint_applicant_profile_imageThumbPath = CUSTOMER_PROFILE_THUMB_PATH . $joint_applicant_profile_image;
				copy($joint_applicant_profile_image_folder, $joint_applicant_profile_imageThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_profile_imageThumbPath, 99, 0, 100);
				$joint_ResizeSig->save($joint_applicant_profile_imageThumbPath);						
				}
					$joint_Var_applicant_profile_image = $joint_applicant_profile_image;
				} else {
					if($MainArrayData['joint_applicant_profile_image'] ==''){
						$joint_Var_applicant_profile_image = '';
					} else {
						$joint_Var_applicant_profile_image = $MainArrayData['joint_applicant_profile_image'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_cnic_front_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_cnic_front_side = $objQayadProerty->getImagename($_FILES['joint_applicant_cnic_front_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_cnic_front_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_front_side)){
				$joint_applicant_cnic_front_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_front_side;
				$joint_applicant_cnic_front_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_applicant_cnic_front_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_applicant_cnic_front_side;
				copy($joint_applicant_cnic_front_side_folder, $joint_applicant_cnic_front_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_cnic_front_sideThumbPath, 200, 0, 100);
				$joint_ResizeSig->save($joint_applicant_cnic_front_sideThumbPath);						
				}
					$joint_Var_applicant_cnic_front_side = $joint_applicant_cnic_front_side;
				} else {
					if($MainArrayData['joint_applicant_cnic_front_side'] ==''){
						$joint_Var_applicant_cnic_front_side = '';
					} else {
						$joint_Var_applicant_cnic_front_side = $MainArrayData['joint_applicant_cnic_front_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_cnic_back_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_cnic_back_side = $objQayadProerty->getImagename($_FILES['joint_applicant_cnic_back_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_cnic_back_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_back_side)){
				$joint_applicant_cnic_back_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_back_side;
				$joint_applicant_cnic_back_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_applicant_cnic_back_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_applicant_cnic_back_side;
				copy($joint_applicant_cnic_back_side_folder, $joint_applicant_cnic_back_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_cnic_back_sideThumbPath, 200, 0, 100);
				$joint_ResizeSig->save($joint_applicant_cnic_back_sideThumbPath);						
				}
					$joint_Var_applicant_cnic_back_side = $joint_applicant_cnic_back_side;
				} else {
					if($MainArrayData['joint_applicant_cnic_back_side'] ==''){
						$joint_Var_applicant_cnic_back_side = '';
					} else {
						$joint_Var_applicant_cnic_back_side = $MainArrayData['joint_applicant_cnic_back_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_signature']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_signature = $objQayadProerty->getImagename($_FILES['joint_applicant_signature']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_signature']['tmp_name'], CUSTOMER_SIGNATURE_PATH . $joint_applicant_signature)){
				$joint_applicant_signature_folder = CUSTOMER_SIGNATURE_PATH . $joint_applicant_signature;
				$joint_applicant_signatureThumbFolder = CUSTOMER_SIGNATURE_THUMB_PATH;
				$joint_applicant_signatureThumbPath = CUSTOMER_SIGNATURE_THUMB_PATH . $joint_applicant_signature;
				copy($joint_applicant_signature_folder, $joint_applicant_signatureThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_signatureThumbPath, 200, 0, 100);
				$joint_ResizeSig->save($joint_applicant_signatureThumbPath);						
				}
					$joint_Var_applicant_signature = $joint_applicant_signature;
				} else {
					if($MainArrayData['joint_applicant_signature'] ==''){
						$joint_Var_applicant_signature = '';
					} else {
						$joint_Var_applicant_signature = $MainArrayData['joint_applicant_signature'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_passport_copy']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_passport_copy = $objQayadProerty->getImagename($_FILES['joint_applicant_passport_copy']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_passport_copy']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_applicant_passport_copy)){
				$joint_applicant_passport_copy_folder = CUSTOMER_DOCUMENT_PATH . $joint_applicant_passport_copy;
				$joint_applicant_passport_copyThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_applicant_passport_copyThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_applicant_passport_copy;
				copy($joint_applicant_passport_copy_folder, $joint_applicant_passport_copyThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_passport_copyThumbPath, 200, 0, 100);
				$joint_ResizeSig->save($joint_applicant_passport_copyThumbPath);						
				}
					$joint_Var_applicant_passport_copy = $joint_applicant_passport_copy;
				} else {
					if($MainArrayData['joint_applicant_passport_copy'] ==''){
						$joint_Var_applicant_passport_copy = '';
					} else {
						$joint_Var_applicant_passport_copy = $MainArrayData['joint_applicant_passport_copy'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_nominee_cnic_front_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_nominee_cnic_front_side = $objQayadProerty->getImagename($_FILES['joint_nominee_cnic_front_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_nominee_cnic_front_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_front_side)){
				$joint_nominee_cnic_front_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_front_side;
				$joint_nominee_cnic_front_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_nominee_cnic_front_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_nominee_cnic_front_side;
				copy($joint_nominee_cnic_front_side_folder, $joint_nominee_cnic_front_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_nominee_cnic_front_sideThumbPath, 200, 0, 100);
				$joint_ResizeSig->save($joint_nominee_cnic_front_sideThumbPath);						
				}
					$joint_Var_nominee_cnic_front_side = $joint_nominee_cnic_front_side;
				} else {
					if($MainArrayData['joint_nominee_cnic_front_side'] ==''){
						$joint_Var_nominee_cnic_front_side = '';
					} else {
						$joint_Var_nominee_cnic_front_side = $MainArrayData['joint_nominee_cnic_front_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_nominee_cnic_back_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_nominee_cnic_back_side = $objQayadProerty->getImagename($_FILES['joint_nominee_cnic_back_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_nominee_cnic_back_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_back_side)){
				$joint_nominee_cnic_back_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_back_side;
				$joint_nominee_cnic_back_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_nominee_cnic_back_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_nominee_cnic_back_side;
				copy($joint_nominee_cnic_back_side_folder, $joint_nominee_cnic_back_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_nominee_cnic_back_sideThumbPath, 200, 0, 100);
				$joint_ResizeSig->save($joint_nominee_cnic_back_sideThumbPath);						
				}
					$joint_Var_nominee_cnic_back_side = $joint_nominee_cnic_back_side;
				} else {
					if($MainArrayData['joint_nominee_cnic_back_side'] ==''){
						$joint_Var_nominee_cnic_back_side = '';
					} else {
						$joint_Var_nominee_cnic_back_side = $MainArrayData['joint_nominee_cnic_back_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_nominee_passport_copy']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_nominee_passport_copy = $objQayadProerty->getImagename($_FILES['joint_nominee_passport_copy']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_nominee_passport_copy']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_nominee_passport_copy)){
				$joint_nominee_passport_copy_folder = CUSTOMER_DOCUMENT_PATH . $joint_nominee_passport_copy;
				$joint_nominee_passport_copyThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_nominee_passport_copyThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_nominee_passport_copy;
				copy($joint_nominee_passport_copy_folder, $joint_nominee_passport_copyThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_nominee_passport_copyThumbPath, 200, 0, 100);
				$joint_ResizeSig->save($joint_nominee_passport_copyThumbPath);						
				}
					$joint_Var_nominee_passport_copy = $joint_nominee_passport_copy;
				} else {
					if($MainArrayData['joint_nominee_passport_copy'] == ''){
						$joint_Var_nominee_passport_copy = '';
					} else {
						$joint_Var_nominee_passport_copy = $MainArrayData['joint_nominee_passport_copy'];
					}
				}
				
				//////////////////////////////////////////////////
				}
			*/
		/************************************************************************************/
		/**///////////////////////////////////////////////////////////////////////////////////
		/**///////////////////////////////////////////////////////////////////////////////////
		//**/$MakePostArray = array(
		//**/"applicant_profile_image" => $Var_applicant_profile_image,
		//**/"applicant_cnic_front_side" => $Var_applicant_cnic_front_side, 
		//**/"applicant_cnic_back_side" => $Var_applicant_cnic_back_side, 
		//**/"applicant_signature" => $Var_applicant_signature, 
		//**/"applicant_passport_copy" => $Var_applicant_passport_copy, 
		//**/"nominee_cnic_front_side" => $Var_nominee_cnic_front_side, 
		//**/"nominee_cnic_back_side" => $Var_nominee_cnic_back_side, 
		//**/"nominee_passport_copy" => $Var_nominee_passport_copy,
		//**/"joint_applicant_profile_image" => $joint_Var_applicant_profile_image,
		//**/"joint_applicant_cnic_front_side" => $joint_Var_applicant_cnic_front_side, 
		//**/"joint_applicant_cnic_back_side" => $joint_Var_applicant_cnic_back_side, 
		//**/"joint_applicant_signature" => $joint_Var_applicant_signature, 
		//**/"joint_applicant_passport_copy" => $joint_Var_applicant_passport_copy, 
		//**/"joint_nominee_cnic_front_side" => $joint_Var_nominee_cnic_front_side, 
		//**/"joint_nominee_cnic_back_side" => $joint_Var_nominee_cnic_back_side, 
		//**/"joint_nominee_passport_copy" => $joint_Var_nominee_passport_copy);
		/**/$MakePostArray = array(
		/**/"applicant_profile_image" => $Var_applicant_profile_image,
		/**/"applicant_cnic_front_side" => $Var_applicant_cnic_front_side, 
		/**/"applicant_cnic_back_side" => $Var_applicant_cnic_back_side, 
		/**/"applicant_signature" => $Var_applicant_signature, 
		/**/"applicant_passport_copy" => $Var_applicant_passport_copy, 
		/**/"nominee_cnic_front_side" => $Var_nominee_cnic_front_side, 
		/**/"nominee_cnic_back_side" => $Var_nominee_cnic_back_side, 
		/**/"nominee_passport_copy" => $Var_nominee_passport_copy);
		/**/$NewApplicationValue = array_replace($DummyArray, $MainArrayData, $MakePostArray);
		/**/unset($_SESSION['InfoDetail']);	
		/**/$NewUpdatedValue = array_merge($MainArrayData, $NewApplicationValue);
		/**/$_SESSION['InfoDetail'] = $NewUpdatedValue;
		/**///////////////////////////////////////////////////////////////////////////////////
		/**///////////////////////////////////////////////////////////////////////////////////
		
	$BLValue = trim(DecData($_POST["bl"], 1, $objBF));
	$link = Route::_('show=newappreg&stage='.EncData('8', 2, $objBF).'&bl='.EncData($BLValue, 2, $objBF).'&pi='.EncData($_POST["pi"], 2, $objBF));
	redirect($link);			
}


if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 8){
	
	/**///////////////////////////////////////////////////////////////////////////////////
	/**///////////////////////////////////////////////////////////////////////////////////
	/**/$MainArrayData = $_SESSION['InfoDetail'];
	/**/$MakePostArray = array("joint_aplic_opt" => $_POST["joint_aplic_opt"]);
	/**/$NewApplicationValue = array_replace($DummyArray, $MainArrayData, $MakePostArray);
	/**/unset($_SESSION['InfoDetail']);	
	/**/$NewUpdatedValue = array_merge($MainArrayData, $NewApplicationValue);
	/**/$_SESSION['InfoDetail'] = $NewUpdatedValue;
	/**///////////////////////////////////////////////////////////////////////////////////
	/**///////////////////////////////////////////////////////////////////////////////////
	
	$BLValue = trim(DecData($_POST["bl"], 1, $objBF));
	$link = Route::_('show=newappreg&stage='.EncData('5', 2, $objBF).'&bl='.EncData($BLValue, 2, $objBF).'&pi='.EncData($_POST["pi"], 2, $objBF).'&ui='.EncData($_POST["ui"], 2, $objBF));
	redirect($link);
}

if(trim(DecData($_GET["mode"], 1, $objBF)) == 'edit' && trim(DecData($_GET["stage"], 1, $objBF)) == 3 && trim(DecData($_GET["stage"], 1, $objBF)) !=''){
	extract($_SESSION['InfoDetail']);
	$mode = 'U';
}
if(trim(DecData($_GET["mode"], 1, $objBF)) == 'save' && trim(DecData($_GET["stage"], 1, $objBF)) == 6 && trim(DecData($_GET["stage"], 1, $objBF)) !=''){
	
	$objRoute 					= new Route;
	/*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*/
    /*-----------------------------------------------------------------------------------------------------*/
	/////////////////////////////////////////////////////////////////////////////////////////////////////////

		$BLFromSession 				= $_SESSION['InfoDetail']["bl"];
		$GetBLFromSession 			= trim(DecData($BLFromSession, 1, $objBF));
		//echo $GetBLFromSession;
		//die();
		list($property_registered_id,$propety_floor_id,$property_type_id)= explode('&', $GetBLFromSession);
		
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*----------------------------------------------------------------------------------------------------*/
	/*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*//*-*/
	
	
	$property_id				= $_SESSION['InfoDetail']["pi"];
    $property_share_id			= $_SESSION['InfoDetail']["ui"];
	$registration_type 			= $_SESSION['InfoDetail']["registration_type"];
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
    $customer_fname 			= trim($_SESSION['InfoDetail']["customer_fname"]);
    $customer_lname 			= trim($_SESSION['InfoDetail']["customer_lname"]);
    $customer_father 			= trim($_SESSION['InfoDetail']["customer_father"]);
    $customer_cnic 				= trim($_SESSION['InfoDetail']["customer_cnic"]);
    $customer_passport 			= trim($_SESSION['InfoDetail']["customer_passport"]);
    $customer_email 			= trim($_SESSION['InfoDetail']["customer_email"]);
    $customer_c_address 		= trim($_SESSION['InfoDetail']["customer_c_address"]);
    $customer_p_address 		= trim($_SESSION['InfoDetail']["customer_p_address"]);
    $customer_phone 			= trim($_SESSION['InfoDetail']["customer_phone"]);
    $customer_mobile 			= trim($_SESSION['InfoDetail']["customer_mobile"]);
    $customer_mobile_2 			= trim($_SESSION['InfoDetail']["customer_mobile_2"]);
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
    $n_customer_fname 			= trim($_SESSION['InfoDetail']["n_customer_fname"]);
    $n_customer_lname 			= trim($_SESSION['InfoDetail']["n_customer_lname"]);
    $n_customer_father 			= trim($_SESSION['InfoDetail']["n_customer_father"]);
    $n_customer_cnic 			= trim($_SESSION['InfoDetail']["n_customer_cnic"]);
    $n_customer_passport 		= trim($_SESSION['InfoDetail']["n_customer_passport"]);
    $customer_relation_name 	= trim($_SESSION['InfoDetail']["customer_relation_name"]);
    $n_customer_c_address 		= trim($_SESSION['InfoDetail']["n_customer_c_address"]);
    ///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
    $applicant_profile_image 			= trim($_SESSION['InfoDetail']["applicant_profile_image"]); //This Value Store in rs_tbl_customer Table in [customer_image] filed
    $applicant_cnic_front_side 			= trim($_SESSION['InfoDetail']["applicant_cnic_front_side"]);
    $applicant_cnic_back_side 			= trim($_SESSION['InfoDetail']["applicant_cnic_back_side"]);
    $applicant_signature	 			= trim($_SESSION['InfoDetail']["applicant_signature"]); //This Value Store in rs_tbl_customer Table in [customer_sign] filed
    $applicant_passport_copy 			= trim($_SESSION['InfoDetail']["applicant_passport_copy"]);
    $nominee_cnic_front_side 			= trim($_SESSION['InfoDetail']["nominee_cnic_front_side"]);
    $nominee_cnic_back_side 			= trim($_SESSION['InfoDetail']["nominee_cnic_back_side"]);
    $nominee_passport_copy 				= trim($_SESSION['InfoDetail']["nominee_passport_copy"]);
	/*
	$joint_applicant_profile_image 		= trim($_SESSION['InfoDetail']["joint_applicant_profile_image"]); //This Value Store in rs_tbl_customer Table in [customer_image] filed
    $joint_applicant_cnic_front_side 	= trim($_SESSION['InfoDetail']["joint_applicant_cnic_front_side"]);
    $joint_applicant_cnic_back_side 	= trim($_SESSION['InfoDetail']["joint_applicant_cnic_back_side"]);
    $joint_applicant_signature	 		= trim($_SESSION['InfoDetail']["joint_applicant_signature"]); //This Value Store in rs_tbl_customer Table in [customer_sign] filed
    $joint_applicant_passport_copy 		= trim($_SESSION['InfoDetail']["joint_applicant_passport_copy"]);
    $joint_nominee_cnic_front_side 		= trim($_SESSION['InfoDetail']["joint_nominee_cnic_front_side"]);
    $joint_nominee_cnic_back_side 		= trim($_SESSION['InfoDetail']["joint_nominee_cnic_back_side"]);
    $joint_nominee_passport_copy 		= trim($_SESSION['InfoDetail']["joint_nominee_passport_copy"]); */
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	$joint_aplic_opt			= $_SESSION['InfoDetail']["joint_aplic_opt"];
	///////////////////////////////////////////////////////////////////////////////////////
	/*
	///////////////////////////////////////////////////////////////////////////////////////
	$ja_customer_fname			= trim($_SESSION['InfoDetail']["ja_customer_fname"]);
	$ja_customer_lname			= trim($_SESSION['InfoDetail']["ja_customer_lname"]);
	$ja_customer_father			= trim($_SESSION['InfoDetail']["ja_customer_father"]);
	$ja_customer_cnic			= trim($_SESSION['InfoDetail']["ja_customer_cnic"]);
	$ja_customer_passport		= trim($_SESSION['InfoDetail']["ja_customer_passport"]);
	$ja_customer_email			= trim($_SESSION['InfoDetail']["ja_customer_email"]);
	$ja_customer_c_address		= trim($_SESSION['InfoDetail']["ja_customer_c_address"]);
	$ja_customer_p_address		= trim($_SESSION['InfoDetail']["ja_customer_p_address"]);
	$ja_customer_phone			= trim($_SESSION['InfoDetail']["ja_customer_phone"]);
	$ja_customer_mobile			= trim($_SESSION['InfoDetail']["ja_customer_mobile"]);
	$ja_customer_mobile_2		= trim($_SESSION['InfoDetail']["ja_customer_mobile_2"]);
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	$ja_n_customer_fname		= trim($_SESSION['InfoDetail']["ja_n_customer_fname"]);
	$ja_n_customer_lname		= trim($_SESSION['InfoDetail']["ja_n_customer_lname"]);
	$ja_n_customer_father		= trim($_SESSION['InfoDetail']["ja_n_customer_father"]);
	$ja_n_customer_cnic			= trim($_SESSION['InfoDetail']["ja_n_customer_cnic"]);
	$ja_n_customer_passport		= trim($_SESSION['InfoDetail']["ja_n_customer_passport"]);
	$ja_customer_relation_name	= trim($_SESSION['InfoDetail']["ja_customer_relation_name"]);
	$ja_n_customer_c_address	= trim($_SESSION['InfoDetail']["ja_n_customer_c_address"]);
	///////////////////////////////////////////////////////////////////////////////////////
	*/
	///////////////////////////////////////////////////////////////////////////////////////
	$customer_mode				= trim($_SESSION['InfoDetail']["customer_mode"]);
	$customer_old_id			= trim($_SESSION['InfoDetail']["customer_old_id"]);
	$customer_nominee_mode		= trim($_SESSION['InfoDetail']["customer_nominee_mode"]);
	$customer_nominee_old_id	= trim($_SESSION['InfoDetail']["customer_nominee_old_id"]);
	///////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////
	$aplic_desc					= trim($_SESSION['InfoDetail']["aplic_desc"]);
	$seller_agent_id			= $_SESSION['InfoDetail']["seller_agent_id"];
	$declaration_status			= $_SESSION['InfoDetail']["declaration_status"];
	$payment_mode				= $_SESSION['InfoDetail']["payment_mode"];
	//$no_of_shares				= $_SESSION['InfoDetail']["no_of_shares"];
	$temp_lock_counter			= $_SESSION['InfoDetail']["lkc"];
	$temp_lock_id				= $_SESSION['InfoDetail']["lk"];
	$aplic_reg_type				= $_SESSION['InfoDetail']['aplic_reg_type'];
	
	if(trim($_SESSION['InfoDetail']["applic_reg_date"]) != ""){
	$aplic_date					= dateFormate_10(trim($_SESSION['InfoDetail']["applic_reg_date"])) . ' ' . date('H:i:s');
	} else {
	$aplic_date					= date('Y-m-d H:i:s');
	}
	$isActive					= 1;
	
	/*//print_r($_SESSION['InfoDetail']);
	//print_r($_SESSION['JointAplicInfo']);
	//print_r($_SESSION['JointAplicInfo']['jn1']);
	//print_r($_SESSION['JointAplicInfo']['jnf1']);
	//echo count($_SESSION['JointAplicInfo']) / 2 .'<br>';
	
	for($j=1;$j<=count($_SESSION['JointAplicInfo']) / 2;$j++){
		echo '-----------------------------------------------------';
		echo print_r($_SESSION['JointAplicInfo']['jn'.$j]);
		echo '====================================================--';
		echo print_r($_SESSION['JointAplicInfo']['jnf'.$j]);
	}
	die();*/
				/////////////////////////////////////////////////////////////////////////////////////////
				/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
				/*		  				Register New Application From Information					  */
				/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
				/////////////////////////////////////////////////////////////////////////////////////////
				$objQayadapplication->resetProperty();
				$aplic_id = $objQayadapplication->genCode("rs_tbl_application", "aplic_id");
				$objQayadapplication->resetProperty();
				$objQayadapplication->setProperty("aplic_id", $aplic_id);
				$objQayadapplication->setProperty("reg_number", CreateInvoiceNumber($aplic_id));
				$objQayadapplication->setProperty("property_id", trim(DecData($property_id, 1, $objBF)));
				$objQayadapplication->setProperty("property_share_id", trim(DecData($property_share_id, 1, $objBF)));
				$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadapplication->setProperty("joint_aplic_opt", $joint_aplic_opt);
				$objQayadapplication->setProperty("regsiter_project_id", $property_registered_id);
				$objQayadapplication->setProperty("registration_type", $registration_type);
				$objQayadapplication->setProperty("property_type", $property_type_id);
				$objQayadapplication->setProperty("booking_oficr_sign", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadapplication->setProperty("declaration_status", $reg_number);
				$objQayadapplication->setProperty("aplic_desc", $aplic_desc);
				$objQayadapplication->setProperty("seller_agent_id", $seller_agent_id);
				$objQayadapplication->setProperty("aplic_type", 1);
				$objQayadapplication->setProperty("aplic_stage", 4);
				$objQayadapplication->setProperty("current_payment_status", 1);
				$objQayadapplication->setProperty("aplic_date", $aplic_date);
				$objQayadapplication->setProperty("isActive", $isActive);
				$objQayadapplication->setProperty("location_id", $objQayaduser->location_id);
				$objQayadapplication->setProperty("no_of_shares", $no_of_shares);
				$objQayadapplication->setProperty("aplic_reg_type", $aplic_reg_type);
				if($temp_lock_counter == 1 && $temp_lock_id != ''){
				$objQayadapplication->setProperty("temp_lock_id", $temp_lock_id);
				}
				if($objQayadapplication->actApplications('I')){
					/////////////////////////////////////////////////////////////////////////////////////////
					//			Register New Main Applicant Information	[This Customer Type	=> 1		 
					/////////////////////////////////////////////////////////////////////////////////////////
					if($customer_mode == 'U'){
					$applicant_id = $customer_old_id;
					} else {
					$objQayadapplication->resetProperty();
					$applicant_id = $objQayadapplication->genCode("rs_tbl_customer", "customer_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					//$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("customer_fname", $customer_fname);
					$objQayadapplication->setProperty("customer_lname", $customer_lname);
					$objQayadapplication->setProperty("customer_father", $customer_father);
					$objQayadapplication->setProperty("customer_email", $customer_email);
					$objQayadapplication->setProperty("customer_cnic", $customer_cnic);
					$objQayadapplication->setProperty("customer_c_address", $customer_c_address);
					$objQayadapplication->setProperty("customer_p_address", $customer_p_address);
					$objQayadapplication->setProperty("customer_phone", $customer_phone);
					$objQayadapplication->setProperty("customer_mobile", $customer_mobile);
					$objQayadapplication->setProperty("customer_mobile_2", $customer_mobile_2);
					$objQayadapplication->setProperty("customer_image", $applicant_profile_image);
					$objQayadapplication->setProperty("customer_sign", $applicant_signature);
					$objQayadapplication->setProperty("customer_type", 1);
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("reg_date", $aplic_date);
					$objQayadapplication->actApplicationCustomer('I');
					}
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					//			Register Nominee Applicant Information	[This Customer Type	=> 2		  
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					if($customer_nominee_mode == 'U'){
					$nominee_id = $customer_nominee_old_id;
					} else {
					$objQayadapplication->resetProperty();
					$nominee_id = $objQayadapplication->genCode("rs_tbl_customer", "customer_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("customer_id", $nominee_id);
					//$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("customer_fname", $n_customer_fname);
					$objQayadapplication->setProperty("customer_lname", $n_customer_lname);
					$objQayadapplication->setProperty("customer_father", $n_customer_father);
					$objQayadapplication->setProperty("customer_cnic", $n_customer_cnic);
					$objQayadapplication->setProperty("customer_c_address", $n_customer_c_address);
					$objQayadapplication->setProperty("customer_relation_name", $customer_relation_name);
					$objQayadapplication->setProperty("customer_type", 2);
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("reg_date", $aplic_date);
					$objQayadapplication->actApplicationCustomer('I');
					}
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					//			Register Joint Applicant Information	[This Customer Type	=> 3]
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					/*
					if($joint_aplic_opt == 1) { // Start $joint_aplic_opt Condition
					for($j=1;$j<=count($_SESSION['JointAplicInfo']) / 2;$j++){ // Start For Loop
					if($_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_fname'] != ''){
					$objQayadapplication->resetProperty();
					$JointApplicant_id = $objQayadapplication->genCode("rs_tbl_customer", "customer_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("customer_id", $JointApplicant_id);
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("customer_fname", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_fname']);
					$objQayadapplication->setProperty("customer_lname", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_lname']);
					$objQayadapplication->setProperty("customer_father", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_father']);
					$objQayadapplication->setProperty("customer_email", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_email']);
					$objQayadapplication->setProperty("customer_cnic", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_cnic']);
					$objQayadapplication->setProperty("customer_passport", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_passport']);
					$objQayadapplication->setProperty("customer_c_address", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_c_address']);
					$objQayadapplication->setProperty("customer_p_address", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_p_address']);
					$objQayadapplication->setProperty("customer_phone", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_phone']);
					$objQayadapplication->setProperty("customer_mobile", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_mobile']);
					$objQayadapplication->setProperty("customer_mobile_2", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_mobile_2']);
					$objQayadapplication->setProperty("customer_image", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_profile_image']);
					$objQayadapplication->setProperty("customer_sign", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_signature']);
					$objQayadapplication->setProperty("customer_type", 3);
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("reg_date", $aplic_date);
					$objQayadapplication->actApplicationCustomer('I');
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					//		Register Joint Applicant Nominee Information	[This Customer Type	=> 5]
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					$objQayadapplication->resetProperty();
					$JointNomineeApplicant_id = $objQayadapplication->genCode("rs_tbl_customer", "customer_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("customer_id", $JointNomineeApplicant_id);
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("customer_fname", $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_fname']);
					$objQayadapplication->setProperty("customer_lname", $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_lname']);
					$objQayadapplication->setProperty("customer_father", $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_father']);
					$objQayadapplication->setProperty("customer_cnic", $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_cnic']);
					$objQayadapplication->setProperty("customer_passport", $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_passport']);
					$objQayadapplication->setProperty("customer_c_address", $_SESSION['JointAplicInfo']['jn'.$j]['ja_n_customer_c_address']);
					$objQayadapplication->setProperty("customer_relation_name", $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_relation_name']);
					$objQayadapplication->setProperty("customer_type", 5);
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("reg_date", $aplic_date);
					$objQayadapplication->actApplicationCustomer('I');
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					//			  Add Joint Applicant ID in rs_tbl_aplic_joint_applicant Table			 
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					$objQayadapplication->resetProperty();
					$joint_id = $objQayadapplication->genCode("rs_tbl_aplic_joint_applicant", "joint_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("joint_id", $joint_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("joint_customer_id", $JointApplicant_id);
					$objQayadapplication->setProperty("joint_nominee_customer_id", $JointNomineeApplicant_id);
					$objQayadapplication->setProperty("joint_type", 1);
					$objQayadapplication->setProperty("share_percentage", $_SESSION['JointAplicInfo']['jn'.$j]['share_percentage']);
					$objQayadapplication->setProperty("isActive", 1);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actJointApplicants('I');
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					//							Customer Attached Document Saved						  
					/////////////////////////////////////////////////////////////////////////////////////////
					/////////////////////////////////////////////////////////////////////////////////////////
					if($_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_cnic_front_side'] != ''){
					///////////////////////Below Section for Joint Applicant CNIC Front-Side---------------------
					$objQayadapplication->resetProperty();
					$joint_applicant_cnic_front_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $joint_applicant_cnic_front_side_id);
					$objQayadapplication->setProperty("customer_id", $JointApplicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Join Applicant CNIC Front-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Join Applicant CNIC Front-Side Copy Attached.');
					$objQayadapplication->setProperty("url_key", 'joint_applicant_cnic_front_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_cnic_front_side']);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
					if($_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_cnic_back_side'] != ''){
					///////////////////////Below Section for Joint Applicant CNIC Back-Side---------------------
					$objQayadapplication->resetProperty();
					$joint_applicant_cnic_back_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $joint_applicant_cnic_back_side_id);
					$objQayadapplication->setProperty("customer_id", $JointApplicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Join Applicant CNIC Back-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Join Applicant CNIC Back-Side Copy Attached.');
					$objQayadapplication->setProperty("url_key", 'joint_applicant_cnic_back_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_cnic_back_side']);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
					if($_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_passport_copy'] != ''){
					///////////////////////Below Section for Joint Applicant Passport---------------------
					$objQayadapplication->resetProperty();
					$joint_applicant_passport_copy_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $joint_applicant_passport_copy_id);
					$objQayadapplication->setProperty("customer_id", $JointApplicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Join Applicant Passport Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Join Applicant Passport Copy Attached.');
					$objQayadapplication->setProperty("url_key", 'joint_applicant_passport_copy');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_applicant_passport_copy']);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
					if($_SESSION['JointAplicInfo']['jnf'.$j]['joint_nominee_cnic_front_side'] != ''){
					///////////////////////Below Section for Joint Nominee CNIC Front-Side---------------------
					$objQayadapplication->resetProperty();
					$joint_nominee_cnic_front_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $joint_nominee_cnic_front_side_id);
					$objQayadapplication->setProperty("customer_id", $JointNomineeApplicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Join Nominee CNIC Front-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Join Nominee CNIC Front-Side Copy Attached.');
					$objQayadapplication->setProperty("url_key", 'joint_nominee_cnic_front_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_nominee_cnic_front_side']);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
					if($_SESSION['JointAplicInfo']['jnf'.$j]['joint_nominee_cnic_back_side'] != ''){
					///////////////////////Below Section for Joint Nominee CNIC Back-Side---------------------
					$objQayadapplication->resetProperty();
					$joint_nominee_cnic_back_side_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $joint_nominee_cnic_back_side_id);
					$objQayadapplication->setProperty("customer_id", $JointNomineeApplicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Join Nominee CNIC Back-Side Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Join Nominee CNIC Back-Side Copy Attached.');
					$objQayadapplication->setProperty("url_key", 'joint_nominee_cnic_back_side');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_nominee_cnic_back_side']);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
					if($_SESSION['JointAplicInfo']['jnf'.$j]['joint_nominee_passport_copy'] != ''){
					///////////////////////Below Section for Joint Nominee Passport---------------------
					$objQayadapplication->resetProperty();
					$joint_nominee_passport_copy_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $joint_nominee_passport_copy_id);
					$objQayadapplication->setProperty("customer_id", $JointNomineeApplicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Join Nominee Passport Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Join Nominee Passport Copy Attached.');
					$objQayadapplication->setProperty("url_key", 'joint_nominee_passport_copy');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $_SESSION['JointAplicInfo']['jnf'.$j]['joint_nominee_passport_copy']);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
							}// End $_SESSION['JointAplicInfo']['jn'.$j]['ja_customer_fname']
						}// End For Loop
					}// End $joint_aplic_opt Condition
					*/
					/***************************************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					/////////////////////////////////////////////////////////////////////////////////////////
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/*		Update Applicant, Nominee, Joint Applicant Customer ID in Application form	  */
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/////////////////////////////////////////////////////////////////////////////////////////
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("nominee_id", $nominee_id);
					if($joint_aplic_opt == 1) {
					//$objQayadapplication->setProperty("joint_aplic_id", $JointApplicant_id);
					//$objQayadapplication->setProperty("joint_aplic_nominee_id", $JointNomineeApplicant_id);
					}
					$objQayadapplication->actApplications('U');
					/***************************************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					/////////////////////////////////////////////////////////////////////////////////////////
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/*					Application Property Current Payment Plan Save					  */
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/////////////////////////////////////////////////////////////////////////////////////////
					/***************************************************************************************/
				/**//*******************************Get Property Unit Floor ID******************************/
				/**/$objQayadProertyPaymentID = new Qayadproperty;
				/**/$objQayadProertyPaymentID->setProperty("property_share_id", trim(DecData($property_share_id, 1, $objBF)));
				/**/$objQayadProertyPaymentID->setProperty("isActive", 1);
				/**/$objQayadProertyPaymentID->lstPropertyShares();
				/**/$PropertyUnitID = $objQayadProertyPaymentID->dbFetchArray(1);
				/**//***************************Get Property Unit Floor Payment ID***************************/
				/**/$objQayadProertyPaymentID = new Qayadproperty;
				/**/$objQayadProertyPaymentID->setProperty("floor_id", $PropertyUnitID["property_floor_id"]);
				/**/$objQayadProertyPaymentID->setProperty("isActive", 1);
				/**/$objQayadProertyPaymentID->lstFloorPaymentDetail();
				/**/$PropertyUnitPaymentID = $objQayadProertyPaymentID->dbFetchArray(1);
				/**//***************************************************************************************/
					$objQayadapplication->resetProperty();
					$payment_overview_id = $objQayadapplication->genCode("rs_tbl_aplic_payment_overview", "payment_overview_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("payment_overview_id", $payment_overview_id);
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("propty_payment_id", $PropertyUnitPaymentID["floor_payment_id"]);
					$objQayadapplication->setProperty("rate_per_sq_ft", $PropertyUnitPaymentID["rate_per_sq_ft"]);
					$objQayadapplication->setProperty("payment_mode", $payment_mode);
					$objQayadapplication->setProperty("overview_note", ApplicationPaymentMode($payment_mode)." base plan selected.");
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->actPaymentOverview('I');
					/***************************************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					/////////////////////////////////////////////////////////////////////////////////////////
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/*				Chnage Temp Lock Property Status Locked to Expire				  */
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/////////////////////////////////////////////////////////////////////////////////////////
					/***************************************************************************************/
					if($temp_lock_counter == 1){
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("temp_lock_id", trim(DecData($temp_lock_id, 1, $objBF)));
					$objQayadProerty->setProperty("aplic_id", $aplic_id);
					$objQayadProerty->actPropertyTempLock('U');
					}
					/***************************************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					/////////////////////////////////////////////////////////////////////////////////////////
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/*					Chnage Property Status Available to Under Process				  */
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/////////////////////////////////////////////////////////////////////////////////////////
					/***************************************************************************************/
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("property_share_id", trim(DecData($property_share_id, 1, $objBF)));
					$objQayadProerty->setProperty("property_share_status", 5);
					$objQayadProerty->actPropertyShares('U');
					/***************************************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					/////////////////////////////////////////////////////////////////////////////////////////
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/*							Customer Attached Document Saved						  */
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/////////////////////////////////////////////////////////////////////////////////////////
					/*
					if($applicant_cnic_front_side != ''){
					//---------------------Below Section for Applicant CNIC Front Side---------------------
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
					}
					if($applicant_cnic_back_side != ''){
					//---------------------Below Section for Applicant CNIC Back Side---------------------
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
					}
					if($applicant_passport_copy != ''){
					//---------------------Below Section for Applicant Passport---------------------
					$objQayadapplication->resetProperty();
					$applicant_passport_copy_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $applicant_passport_copy_id);
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Applicant Passport Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Applicant Passport copy attached.');
					$objQayadapplication->setProperty("url_key", 'applicant_passport_copy');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $applicant_passport_copy);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
					if($nominee_cnic_front_side != ''){
					//---------------------Below Section for Nominee CNIC Front-Side---------------------
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
					}
					if($nominee_cnic_back_side != ''){
					//---------------------Below Section for Nominee CNIC Back-Side---------------------
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
					}
					if($nominee_passport_copy != ''){
					//---------------------Below Section for Nominee Passport---------------------
					$objQayadapplication->resetProperty();
					$nominee_passport_copy_id = $objQayadapplication->genCode("rs_tbl_general_document", "document_id");
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("document_id", $nominee_passport_copy_id);
					$objQayadapplication->setProperty("customer_id", $nominee_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("document_name", 'Nominee Passport Copy');
					$objQayadapplication->setProperty("document_type", 1);
					$objQayadapplication->setProperty("document_desc", 'Nominee Passport Copy attached.');
					$objQayadapplication->setProperty("url_key", 'nominee_passport_copy');
					$objQayadapplication->setProperty("isActive", $isActive);
					$objQayadapplication->setProperty("document_filename", $nominee_passport_copy);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					$objQayadapplication->actGeneralDocument('I');
					}
					*/
					/***************************************************************************************
					\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
					/////////////////////////////////////////////////////////////////////////////////////////
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/*							  Insert Activity Log Detail							  */
					/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/
					/////////////////////////////////////////////////////////////////////////////////////////
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("aplic_id", $aplic_id);
					$objQayadapplication->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadapplication->setProperty("customer_id", $applicant_id);
					$objQayadapplication->setProperty("entery_date", $aplic_date);
					if($mode == 'I'){
					$objQayadapplication->setProperty("log_desc", "New Application Form Register for -> (".$customer_fname ." ".$customer_lname.")");
					} else {
					$objQayadapplication->setProperty("log_desc", "Application form edit for -> (".$customer_fname ." ".$customer_lname.")");
					}
					$objQayadapplication->setProperty("isActive", 1);
					$objQayadapplication->actApplicationLog("I");
					/**********************************************************************/
				}
	$objCommon->setMessage(_PROPERTY_APPLICATION_MSG_SUCCESS, 'Info');			
	$link = Route::_('');
	redirect($link);	

}

if($_GET["rm"] == 'n' && trim(DecData($_GET["stage"], 1, $objBF)) == 3){
	$GetCustomerCnic = trim(DecData($_GET["coi"], 1, $objBF));
	$objQayadapplication->resetProperty();
	$objQayadapplication->setProperty("customer_id", $GetCustomerCnic);
	$objQayadapplication->lstApplicationCustomer();
	if($objQayadapplication->totalRecords() > 0){
	$data = $objQayadapplication->dbFetchArray(1);
	$customer_old_id = $data["customer_id"];
	$customer_mode = "U";
	$FieldOption = 1;
	extract($data);
	}
	$customer_nominee_mode = 'I';
}
if($_GET["up"] == 'cncoi' && trim(DecData($_GET["stage"], 1, $objBF)) == 3){
	$GetCustomerCnic = trim(DecData($_GET["coi"], 1, $objBF));
	$objQayadapplication->resetProperty();
	$objQayadapplication->setProperty("customer_id", $GetCustomerCnic);
	$objQayadapplication->lstApplicationCustomer();
	if($objQayadapplication->totalRecords() > 0){
	$data = $objQayadapplication->dbFetchArray(1);
	$customer_old_id = $data["customer_id"];
	$customer_mode = "U";
	$FieldOption = 1;
	extract($data);
	}
	
	$objQayadapplicationNominee = new Qayadapplication;
	$objQayadapplicationNominee->setProperty("customer_id", trim(DecData($_GET["cnoi"], 1, $objBF)));
	$objQayadapplicationNominee->lstApplicationCustomer();
	$FetchNomineeInfo = $objQayadapplicationNominee->dbFetchArray(1);
	$n_customer_fname 		= $FetchNomineeInfo["customer_fname"];
	$n_customer_lname 		= $FetchNomineeInfo["customer_lname"];
	$n_customer_of 			= $FetchNomineeInfo["customer_of"];
	$n_customer_father 		= $FetchNomineeInfo["customer_father"];
	$n_customer_cnic 		= $FetchNomineeInfo["customer_cnic"];
	$n_customer_passport 	= $FetchNomineeInfo["customer_passport"];
	$customer_relation_name = $FetchNomineeInfo["customer_relation_name"];
	$n_customer_c_address 	= $FetchNomineeInfo["customer_c_address"];
	$customer_nominee_mode 	= 'U';
	$NomineeFieldOption 	= 1;
}

if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["stage"], 1, $objBF)) == 7){
	$JointNumber = trim(DecData($_POST["jn"], 1, $objBF));
	include("classes/thumbnail.class.php");
	
	if($JointNumber == 1){
	$MainArrayData = $_SESSION['JointAplicInfo']['jnf1'];
	} elseif($JointNumber == 2){
	$MainArrayData = $_SESSION['JointAplicInfo']['jnf2'];
	} elseif($JointNumber == 3){
	$MainArrayData = $_SESSION['JointAplicInfo']['jnf3'];
	} elseif($JointNumber == 4){
	$MainArrayData = $_SESSION['JointAplicInfo']['jnf4'];
	} elseif($JointNumber == 5){
	$MainArrayData = $_SESSION['JointAplicInfo']['jnf5'];
	}
				//////////////////////////////////////////////////
				
				if(is_uploaded_file($_FILES['joint_applicant_profile_image']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_profile_image = $objQayadProerty->getImagename($_FILES['joint_applicant_profile_image']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_profile_image']['tmp_name'], CUSTOMER_PROFILE_PATH . $joint_applicant_profile_image)){
				$joint_applicant_profile_image_folder = CUSTOMER_PROFILE_PATH . $joint_applicant_profile_image;
				$joint_applicant_profile_imageThumbFolder = CUSTOMER_PROFILE_THUMB_PATH;
				$joint_applicant_profile_imageThumbPath = CUSTOMER_PROFILE_THUMB_PATH . $joint_applicant_profile_image;
				copy($joint_applicant_profile_image_folder, $joint_applicant_profile_imageThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_profile_imageThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_applicant_profile_imageThumbPath);						
				}
					$joint_Var_applicant_profile_image = $joint_applicant_profile_image;
				} else {
					if($MainArrayData['joint_applicant_profile_image'] ==''){
						$joint_Var_applicant_profile_image = '';
					} else {
						$joint_Var_applicant_profile_image = $MainArrayData['joint_applicant_profile_image'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_cnic_front_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_cnic_front_side = $objQayadProerty->getImagename($_FILES['joint_applicant_cnic_front_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_cnic_front_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_front_side)){
				$joint_applicant_cnic_front_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_front_side;
				$joint_applicant_cnic_front_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_applicant_cnic_front_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_applicant_cnic_front_side;
				copy($joint_applicant_cnic_front_side_folder, $joint_applicant_cnic_front_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_cnic_front_sideThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_applicant_cnic_front_sideThumbPath);						
				}
					$joint_Var_applicant_cnic_front_side = $joint_applicant_cnic_front_side;
				} else {
					if($MainArrayData['joint_applicant_cnic_front_side'] ==''){
						$joint_Var_applicant_cnic_front_side = '';
					} else {
						$joint_Var_applicant_cnic_front_side = $MainArrayData['joint_applicant_cnic_front_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_cnic_back_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_cnic_back_side = $objQayadProerty->getImagename($_FILES['joint_applicant_cnic_back_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_cnic_back_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_back_side)){
				$joint_applicant_cnic_back_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_applicant_cnic_back_side;
				$joint_applicant_cnic_back_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_applicant_cnic_back_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_applicant_cnic_back_side;
				copy($joint_applicant_cnic_back_side_folder, $joint_applicant_cnic_back_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_cnic_back_sideThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_applicant_cnic_back_sideThumbPath);						
				}
					$joint_Var_applicant_cnic_back_side = $joint_applicant_cnic_back_side;
				} else {
					if($MainArrayData['joint_applicant_cnic_back_side'] ==''){
						$joint_Var_applicant_cnic_back_side = '';
					} else {
						$joint_Var_applicant_cnic_back_side = $MainArrayData['joint_applicant_cnic_back_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_signature']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_signature = $objQayadProerty->getImagename($_FILES['joint_applicant_signature']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_signature']['tmp_name'], CUSTOMER_SIGNATURE_PATH . $joint_applicant_signature)){
				$joint_applicant_signature_folder = CUSTOMER_SIGNATURE_PATH . $joint_applicant_signature;
				$joint_applicant_signatureThumbFolder = CUSTOMER_SIGNATURE_THUMB_PATH;
				$joint_applicant_signatureThumbPath = CUSTOMER_SIGNATURE_THUMB_PATH . $joint_applicant_signature;
				copy($joint_applicant_signature_folder, $joint_applicant_signatureThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_signatureThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_applicant_signatureThumbPath);						
				}
					$joint_Var_applicant_signature = $joint_applicant_signature;
				} else {
					if($MainArrayData['joint_applicant_signature'] ==''){
						$joint_Var_applicant_signature = '';
					} else {
						$joint_Var_applicant_signature = $MainArrayData['joint_applicant_signature'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_applicant_passport_copy']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_applicant_passport_copy = $objQayadProerty->getImagename($_FILES['joint_applicant_passport_copy']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_applicant_passport_copy']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_applicant_passport_copy)){
				$joint_applicant_passport_copy_folder = CUSTOMER_DOCUMENT_PATH . $joint_applicant_passport_copy;
				$joint_applicant_passport_copyThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_applicant_passport_copyThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_applicant_passport_copy;
				copy($joint_applicant_passport_copy_folder, $joint_applicant_passport_copyThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_applicant_passport_copyThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_applicant_passport_copyThumbPath);						
				}
					$joint_Var_applicant_passport_copy = $joint_applicant_passport_copy;
				} else {
					if($MainArrayData['joint_applicant_passport_copy'] ==''){
						$joint_Var_applicant_passport_copy = '';
					} else {
						$joint_Var_applicant_passport_copy = $MainArrayData['joint_applicant_passport_copy'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_nominee_cnic_front_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_nominee_cnic_front_side = $objQayadProerty->getImagename($_FILES['joint_nominee_cnic_front_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_nominee_cnic_front_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_front_side)){
				$joint_nominee_cnic_front_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_front_side;
				$joint_nominee_cnic_front_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_nominee_cnic_front_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_nominee_cnic_front_side;
				copy($joint_nominee_cnic_front_side_folder, $joint_nominee_cnic_front_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_nominee_cnic_front_sideThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_nominee_cnic_front_sideThumbPath);						
				}
					$joint_Var_nominee_cnic_front_side = $joint_nominee_cnic_front_side;
				} else {
					if($MainArrayData['joint_nominee_cnic_front_side'] ==''){
						$joint_Var_nominee_cnic_front_side = '';
					} else {
						$joint_Var_nominee_cnic_front_side = $MainArrayData['joint_nominee_cnic_front_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_nominee_cnic_back_side']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_nominee_cnic_back_side = $objQayadProerty->getImagename($_FILES['joint_nominee_cnic_back_side']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_nominee_cnic_back_side']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_back_side)){
				$joint_nominee_cnic_back_side_folder = CUSTOMER_DOCUMENT_PATH . $joint_nominee_cnic_back_side;
				$joint_nominee_cnic_back_sideThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_nominee_cnic_back_sideThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_nominee_cnic_back_side;
				copy($joint_nominee_cnic_back_side_folder, $joint_nominee_cnic_back_sideThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_nominee_cnic_back_sideThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_nominee_cnic_back_sideThumbPath);						
				}
					$joint_Var_nominee_cnic_back_side = $joint_nominee_cnic_back_side;
				} else {
					if($MainArrayData['joint_nominee_cnic_back_side'] ==''){
						$joint_Var_nominee_cnic_back_side = '';
					} else {
						$joint_Var_nominee_cnic_back_side = $MainArrayData['joint_nominee_cnic_back_side'];
					}
				}
				
				if(is_uploaded_file($_FILES['joint_nominee_passport_copy']['tmp_name'])){
				$objQayadProerty->resetProperty();
				$joint_nominee_passport_copy = $objQayadProerty->getImagename($_FILES['joint_nominee_passport_copy']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['joint_nominee_passport_copy']['tmp_name'], CUSTOMER_DOCUMENT_PATH . $joint_nominee_passport_copy)){
				$joint_nominee_passport_copy_folder = CUSTOMER_DOCUMENT_PATH . $joint_nominee_passport_copy;
				$joint_nominee_passport_copyThumbFolder = CUSTOMER_DOCUMENT_THUMB_PATH;
				$joint_nominee_passport_copyThumbPath = CUSTOMER_DOCUMENT_THUMB_PATH . $joint_nominee_passport_copy;
				copy($joint_nominee_passport_copy_folder, $joint_nominee_passport_copyThumbPath);
				$joint_ResizeSig = new Thumbnail($joint_nominee_passport_copyThumbPath, 250, 0, 100);
				$joint_ResizeSig->save($joint_nominee_passport_copyThumbPath);						
				}
					$joint_Var_nominee_passport_copy = $joint_nominee_passport_copy;
				} else {
					if($MainArrayData['joint_nominee_passport_copy'] == ''){
						$joint_Var_nominee_passport_copy = '';
					} else {
						$joint_Var_nominee_passport_copy = $MainArrayData['joint_nominee_passport_copy'];
					}
				}
				
				//////////////////////////////////////////////////

		/************************************************************************************/
		/**///////////////////////////////////////////////////////////////////////////////////
		/**///////////////////////////////////////////////////////////////////////////////////
		/**/$MakePostArray = array(
		/**/"joint_applicant_profile_image" => $joint_Var_applicant_profile_image,
		/**/"joint_applicant_cnic_front_side" => $joint_Var_applicant_cnic_front_side, 
		/**/"joint_applicant_cnic_back_side" => $joint_Var_applicant_cnic_back_side, 
		/**/"joint_applicant_signature" => $joint_Var_applicant_signature, 
		/**/"joint_applicant_passport_copy" => $joint_Var_applicant_passport_copy, 
		/**/"joint_nominee_cnic_front_side" => $joint_Var_nominee_cnic_front_side, 
		/**/"joint_nominee_cnic_back_side" => $joint_Var_nominee_cnic_back_side, 
		/**/"joint_nominee_passport_copy" => $joint_Var_nominee_passport_copy);
		/**///////////////////////////////////////////////////////////////////////////////////
		/**///////////////////////////////////////////////////////////////////////////////////
		
	/*************************************************************************************/
	/*************************************************************************************/
	/*************************************************************************************/
	$StoreArrayData = array();
	if($JointNumber == 1){
	$StoreArrayData = array('jn1' => $_POST, 'jnf1' => $MakePostArray);
	} elseif($JointNumber == 2){
	$StoreArrayData = array('jn2' => $_POST, 'jnf2' => $MakePostArray);
	} elseif($JointNumber == 3){
	$StoreArrayData = array('jn3' => $_POST, 'jnf3' => $MakePostArray);
	} elseif($JointNumber == 4){
	$StoreArrayData = array('jn4' => $_POST, 'jnf4' => $MakePostArray);
	} elseif($JointNumber == 5){
	$StoreArrayData = array('jn5' => $_POST, 'jnf5' => $MakePostArray);
	}
	if($_SESSION['JointAplicInfo']!= ''){
	$MainArrayData_sec = $_SESSION['JointAplicInfo'];
	$NewJointApplicanArray = array_replace($DummyArray, $MainArrayData_sec, $StoreArrayData);	
	unset($_SESSION['JointAplicInfo']);
	$_SESSION['JointAplicInfo'] = $NewJointApplicanArray;
	} else {
	$_SESSION['JointAplicInfo'] = $StoreArrayData;	
	}
	$objCommon->setMessage(_JOINT_ACCOUNT_MSG_SUCCESS, 'Info');
	$link = Route::_('show=newappregjoint&ja='.EncData(trim(DecData($_GET["ja"], 1, $objBF)), 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&jn='.EncData(trim(DecData($_GET["jn"], 1, $objBF)), 2, $objBF));
	redirect($link);
	//print_r($_SESSION['JointAplicInfo']);
	//die();
	
	/*************************************************************************************/
	/*************************************************************************************/
	/*************************************************************************************/
}

if(trim(DecData($_GET["ja"], 1, $objBF)) == 'form'){
	$GetJointStage = trim(DecData($_GET["jn"], 1, $objBF));
	if($GetJointStage == 1){
		$MainHeadTitle = 'Add First Joint Applicant & Joint Nominee From';
		$GetFormInfo = $_SESSION['JointAplicInfo']['jn1'];
		$GetFilesInfo = $_SESSION['JointAplicInfo']['jnf1'];
			if($_SESSION['JointAplicInfo']['jn1']!=''){ extract($GetFormInfo); }
			if($_SESSION['JointAplicInfo']['jnf1']!=''){ extract($GetFilesInfo); }	
	} elseif($GetJointStage == 2){
		$MainHeadTitle = 'Add Second Joint Applicant & Joint Nominee From';
		$GetFormInfo = $_SESSION['JointAplicInfo']['jn2'];
		$GetFilesInfo = $_SESSION['JointAplicInfo']['jnf2'];
			if($_SESSION['JointAplicInfo']['jn2']!=''){ extract($GetFormInfo); }
			if($_SESSION['JointAplicInfo']['jnf2']!=''){ extract($GetFilesInfo); }
	} elseif($GetJointStage == 3){
		$MainHeadTitle = 'Add Third Joint Applicant & Joint Nominee From';
		$GetFormInfo = $_SESSION['JointAplicInfo']['jn3'];
		$GetFilesInfo = $_SESSION['JointAplicInfo']['jnf3'];
			if($_SESSION['JointAplicInfo']['jn3']!=''){ extract($GetFormInfo); }
			if($_SESSION['JointAplicInfo']['jnf3']!=''){ extract($GetFilesInfo); }
	} elseif($GetJointStage == 4){
		$MainHeadTitle = 'Add Fourth Joint Applicant & Joint Nominee From';
		$GetFormInfo = $_SESSION['JointAplicInfo']['jn4'];
		$GetFilesInfo = $_SESSION['JointAplicInfo']['jnf4'];
			if($_SESSION['JointAplicInfo']['jn4']!=''){ extract($GetFormInfo); }
			if($_SESSION['JointAplicInfo']['jnf4']!=''){ extract($GetFilesInfo); }
	} elseif($GetJointStage == 5){
		$MainHeadTitle = 'Add Fifth Joint Applicant & Joint Nominee From';
		$GetFormInfo = $_SESSION['JointAplicInfo']['jn5'];
		$GetFilesInfo = $_SESSION['JointAplicInfo']['jnf5'];
			if($_SESSION['JointAplicInfo']['jn5']!=''){ extract($GetFormInfo); }
			if($_SESSION['JointAplicInfo']['jnf5']!=''){ extract($GetFilesInfo); }
	}
}

if(trim(DecData($_GET["mode"], 1, $objBF)) == 'reset' && trim(DecData($_GET["sec"], 1, $objBF)) == 'joint'){
	$GetJointStage = trim(DecData($_GET["jn"], 1, $objBF));
	if($GetJointStage == 1){
		unset($_SESSION['JointAplicInfo']['jn1']);
		unset($_SESSION['JointAplicInfo']['jnf1']);
	} elseif($GetJointStage == 2){
		unset($_SESSION['JointAplicInfo']['jn2']);
		unset($_SESSION['JointAplicInfo']['jnf2']);
	} elseif($GetJointStage == 3){
		unset($_SESSION['JointAplicInfo']['jn3']);
		unset($_SESSION['JointAplicInfo']['jnf3']);
	} elseif($GetJointStage == 4){
		unset($_SESSION['JointAplicInfo']['jn4']);
		unset($_SESSION['JointAplicInfo']['jnf4']);
	} elseif($GetJointStage == 5){
		unset($_SESSION['JointAplicInfo']['jn5']);
		unset($_SESSION['JointAplicInfo']['jnf5']);
	}
	//newappregjoint/?
	$link = Route::_('show=newappregjoint&ja='.EncData(trim(DecData($_GET["ja"], 1, $objBF)), 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&jn='.EncData(trim(DecData($_GET["jn"], 1, $objBF)), 2, $objBF));
	redirect($link);
}
?>