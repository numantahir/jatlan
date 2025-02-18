<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$objRoute 			= new Route;
	$objQayadProerty->resetProperty();
	$property_type_id		= trim($_POST["property_type_id"]);
	$propty_payment_id		= trim($_POST['propty_payment_id']);
	$property_id			= trim($_POST['property_id']);
	$user_id				= trim($_POST['user_id']);
	////////////////////////////////////////////////////////////
	$property_area			= trim($_POST['property_area']);
	/*--------------------------------------------------------*/
	$property_section_text	= trim($_POST['property_section_text']);
	$floor_name_text		= trim($_POST['floor_name_text']);
	$property_number_text	= trim($_POST['property_number_text']);
	////////////////////////////////////////////////////////////
	$rate_per_sq_ft			= trim($_POST['rate_per_sq_ft']);
	$dp_discount			= trim($_POST['dp_discount']);
	$total_discount	 		= trim($_POST['total_discount']);
	$payback_cutting		= trim($_POST['payback_cutting']);
	$pb_cutting_value		= trim($_POST['pb_cutting_value']);
	$property_transfer_fee	= trim($_POST['property_transfer_fee']);
	$property_rent_value	= trim($_POST['property_rent_value']);
	$isActive				= trim($_POST['isActive']);
	$mode 					= trim($_POST['mode']);
	$entery_date 			= date('Y-m-d H:i:s');

	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("rate_per_sq_ft", _PROPERTY_SQFT_RATE . _IS_REQUIRED_FLD, "S");
	//echo trim($objBF->decrypt($propty_payment_id, 1, ENCRYPTION_KEY));
	//echo trim(DecData($propty_payment_id, 1, $objBF));
	//die();
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				$PropertyTotalAmount 		= $property_area * $rate_per_sq_ft;
				$PropertyDownPayment 		= $PropertyTotalAmount / 100 * 20;
				$PropertyRemainingAmount	= $PropertyTotalAmount - $PropertyDownPayment;
				$instalment_per_month		= $PropertyRemainingAmount / 10;
				
				
				$objQayadProerties 	= new Qayadproperty;
				$objQayadProerties->setProperty("property_type_id", $property_type_id);
				$objQayadProerties->lstProperties();
				while($GetPropertyInfo = $objQayadProerties->dbFetchArray(1)){
				
				$objQayadProerty->resetProperty();
				$propty_payment_id = $objQayadProerty->genCode("rs_tbl_property_payment_detail", "propty_payment_id");
				$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("propty_payment_id", $propty_payment_id);
				$objQayadProerty->setProperty("property_id", $GetPropertyInfo["property_id"]);
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("down_payment", $PropertyDownPayment);
				$objQayadProerty->setProperty("instalment_per_month", $instalment_per_month);
				$objQayadProerty->setProperty("rate_per_sq_ft", $rate_per_sq_ft);
				$objQayadProerty->setProperty("dp_discount", $dp_discount);
				$objQayadProerty->setProperty("total_discount", $total_discount);
				$objQayadProerty->setProperty("payback_cutting", $payback_cutting);
				$objQayadProerty->setProperty("pb_cutting_value", $pb_cutting_value);
				$objQayadProerty->setProperty("property_transfer_fee", $property_transfer_fee);
				$objQayadProerty->setProperty("property_rent_value", $property_rent_value);
				$objQayadProerty->setProperty("entery_date", $entery_date);
				$objQayadProerty->setProperty("isActive", $isActive);
				if($objQayadProerty->actPropertyPaymentDetail('I')){
						
					/*$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("propty_payment_id_not", $propty_payment_id);
					$objQayadProerty->setProperty("property_id", trim($objBF->decrypt($property_id, 1, ENCRYPTION_KEY)));
					$objQayadProerty->setProperty("isActive", 2);
					$objQayadProerty->actPropertyPaymentDetail('U');*/
				}
				}
				/*$objQayadProerty->resetProperty();
				$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("property_id", trim($objBF->decrypt($property_id, 1, ENCRYPTION_KEY)));
				$objQayadProerty->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($mode == 'I'){
				$objQayadProerty->setProperty("log_desc", "Add New ".$property_section_text.', Floor:'.$floor_name_text.', P#:'.$property_number_text." Price & Plan Detail by Admin");
				} else {
				$objQayadProerty->setProperty("log_desc", "Edit ".$property_section_text.', Floor:'.$floor_name_text.', P#:'.$property_number_text." Price & Plan Detail by Admin");
				}
				$objQayadProerty->actPropertyLog("I");*/
				$proptyid = trim($objBF->decrypt($property_id, 1, ENCRYPTION_KEY));
				$link = Route::_('show=propertytype');
				redirect($link);
				//}
				
			}
	} else {
			
if(isset($_GET['pi']) && !empty($_GET['pi']))
		$propty_payment_id = $_GET['pi'];
	else if(isset($_POST['propty_payment_id']) && !empty($_POST['propty_payment_id']))
		$propty_payment_id = $_POST['propty_payment_id'];
	if(isset($propty_payment_id) && !empty($propty_payment_id)){
		$objQayadProerty->setProperty("propty_payment_id", trim(DecData($propty_payment_id, 1, $objBF)));
		$objQayadProerty->lstPropertyPaymentDetail();
		$data = $objQayadProerty->dbFetchArray(1);
		$mode	= "U";
		extract($data);
	}


}