<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$lead_from_id			= $_POST['lead_from_id'];
	$mode					= $_POST['mode'];
	$entery_date			= date('Y-m-d H:i:s');
	$dfi					= $_POST['dfi'];
	$lfi					= $_POST['lfi'];
	
	if($mode == 'UP'){
		$objValidate->setArray($_POST);
		$objValidate->setCheckField("lead_from_id", 'Leads resource' . _IS_REQUIRED_FLD, "S");
		$vResult = $objValidate->doValidate();
		// See if any error are not returned
		if(!$vResult){
			if(is_uploaded_file($_FILES['document_file']['tmp_name'])){
				$document_file_name = $objQayaduser->getDocumentName($_FILES['document_file']['name'], rand(999,99999));
					if(move_uploaded_file($_FILES['document_file']['tmp_name'], COMPANY_LEAD_PATH . $document_file_name)){
						$objCommon->setMessage(_LEAD_FILE_UPLOADED_SUCCESSFULLY, 'Info');
							$link = Route::_('show=leadform&vm=on&dfi='.EncData($document_file_name, 2, $objBF).'&lfi='.EncData($lead_from_id, 2, $objBF));
						redirect($link);		
					}
			}
		}
	} elseif($mode == 'IL'){
		
		$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_type_id", '13');
		$objQayaduser->setProperty("isActive", 1);
		$objQayaduser->lstUsers();
		$RegionalManager = $objQayaduser->dbFetchArray(1);
			
			if( $xlsx = SimpleXLSX::parse(COMPANY_LEAD_PATH.$dfi) ) {
				$ReadExcelFile = $xlsx->rows();
				for($e=1;$e<=count($ReadExcelFile);$e++){
					if($ReadExcelFile[$e][3] !=''){
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("client_phone_number", $ReadExcelFile[$e][3]);
						$objQayaduser->CheckLeadPhone();
						$CheckPhoneNumber = $objQayaduser->totalRecords();
						if($CheckPhoneNumber == 0){
							if($ReadExcelFile[$e][1] != ''){ $LeadDate = dateFormate_4($ReadExcelFile[$e][1]);}
							$objQayaduser->resetProperty();
							$leads_id = $objQayaduser->genCode("rs_tbl_leads", "leads_id");							
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("leads_id", $leads_id);
							$objQayaduser->setProperty("dmm_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayaduser->setProperty("client_name", trim($ReadExcelFile[$e][2]));
							$objQayaduser->setProperty("client_phone_number", trim($ReadExcelFile[$e][3]));
							$objQayaduser->setProperty("client_email", trim($ReadExcelFile[$e][4]));
							$objQayaduser->setProperty("client_message", trim($ReadExcelFile[$e][5]));
							$objQayaduser->setProperty("lead_date", $LeadDate);
							$objQayaduser->setProperty("lead_from_id", $lfi);
							$objQayaduser->setProperty("entery_datetime", $entery_date);
							$objQayaduser->setProperty("rm_user_id", $RegionalManager["user_id"]);
							$objQayaduser->setProperty("rm_lead_status", 1);
							$objQayaduser->setProperty("rm_lead_fwd_status", 1);
							$objQayaduser->setProperty("assign_location_id", $LoginUserInfo["location_id"]);
							$objQayaduser->setProperty("isActive", 1);
							$objQayaduser->actLeads('I');							
						}
					}
				}
			}
			$objCommon->setMessage(_LEAD_ADDED_SUCCESSFULLY, 'Info');
			$link = Route::_('show=assignleads');
			redirect($link);
	}
}