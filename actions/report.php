<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "search"){
	
	$start_date			= trim($_POST["start_date"]);
	$end_date			= trim($_POST["end_date"]);
	$by_vendor			= trim($_POST["by_vendor"]);
	$by_customer		= trim($_POST["by_customer"]);
	$by_location		= trim($_POST["by_location"]);
	$by_vehicle			= trim($_POST["by_vehicle"]);
	$by_area			= trim($_POST["by_area"]);
	$sec				= trim($_POST["sec"]);
	$by_invoice			= trim($_POST["by_invoice"]);
	$by_customer_type	= trim($_POST["by_customer_type"]);
	$filter_option		= trim($_POST["filter_option"]);
	
	if(trim(DecData($sec, 1, $objBF)) == "A"){
	$link = Route::_('show=report&gen='.EncData('report', 2, $objBF).'&sec='.EncData(trim(DecData($sec, 1, $objBF)), 2, $objBF).'&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&bvd='.EncData($by_vendor, 2, $objBF).'&bve='.EncData($by_vehicle, 2, $objBF).'&ba='.EncData($by_area, 2, $objBF).'&bi='.EncData($by_invoice, 2, $objBF));
	} elseif(trim(DecData($sec, 1, $objBF)) == "B"){
	$link = Route::_('show=report&gen='.EncData('report', 2, $objBF).'&sec='.EncData(trim(DecData($sec, 1, $objBF)), 2, $objBF).'&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&bc='.EncData($by_customer, 2, $objBF).'&bve='.EncData($by_vehicle, 2, $objBF).'&ba='.EncData($by_area, 2, $objBF).'&bi='.EncData($by_invoice, 2, $objBF));
	} elseif(trim(DecData($sec, 1, $objBF)) == "C"){
	$link = Route::_('show=report&gen='.EncData('report', 2, $objBF).'&sec='.EncData(trim(DecData($sec, 1, $objBF)), 2, $objBF).'&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&bc='.EncData($by_customer, 2, $objBF));
	} elseif(trim(DecData($sec, 1, $objBF)) == "E"){
	$link = Route::_('show=report&gen='.EncData('report', 2, $objBF).'&sec='.EncData(trim(DecData($sec, 1, $objBF)), 2, $objBF).'&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&bc='.EncData($by_customer, 2, $objBF).'&bl='.EncData($by_location, 2, $objBF).'&bct='.EncData($by_customer_type, 2, $objBF));
	} elseif(trim(DecData($sec, 1, $objBF)) == "F"){
	$link = Route::_('show=report&gen='.EncData('report', 2, $objBF).'&sec='.EncData(trim(DecData($sec, 1, $objBF)), 2, $objBF).'&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&fo='.EncData($filter_option, 2, $objBF).'&bc='.EncData($by_customer, 2, $objBF));
	} elseif(trim(DecData($sec, 1, $objBF)) == "H"){
	$link = Route::_('show=report&gen='.EncData('report', 2, $objBF).'&sec='.EncData(trim(DecData($sec, 1, $objBF)), 2, $objBF).'&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&bc='.EncData($by_customer, 2, $objBF));
	} 
	redirect($link);

}

if(trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) != ''){

if(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == "A"){
	
	$MakeLinkForPrint = Route::_('show=printreport&sec='.EncData(trim(DecData($_GET["sec"], 1, $objBF)), 2, $objBF).'&sd='.EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF).'&ed='.EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF).'&bvd='.EncData(trim(DecData($_GET["bvd"], 1, $objBF)), 2, $objBF).'&bve='.EncData(trim(DecData($_GET["bve"], 1, $objBF)), 2, $objBF).'&ba='.EncData(trim(DecData($_GET["ba"], 1, $objBF)), 2, $objBF).'&bi='.EncData(trim(DecData($_GET["bi"], 1, $objBF)), 2, $objBF));

	} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == "B"){
	
	$MakeLinkForPrint = Route::_('show=printreport&sec='.EncData(trim(DecData($_GET["sec"], 1, $objBF)), 2, $objBF).'&sd='.EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF).'&ed='.EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF).'&bc='.EncData(trim(DecData($_GET["bc"], 1, $objBF)), 2, $objBF).'&bve='.EncData(trim(DecData($_GET["bve"], 1, $objBF)), 2, $objBF).'&ba='.EncData(trim(DecData($_GET["ba"], 1, $objBF)), 2, $objBF).'&bi='.EncData(trim(DecData($_GET["bi"], 1, $objBF)), 2, $objBF));
		
	} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == "C"){
	
	$MakeLinkForPrint = Route::_('show=printreport&sec='.EncData(trim(DecData($_GET["sec"], 1, $objBF)), 2, $objBF).'&sd='.EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF).'&ed='.EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF).'&bc='.EncData(trim(DecData($_GET["bc"], 1, $objBF)), 2, $objBF));
	
	
	
	} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == "E"){
	
	$MakeLinkForPrint = Route::_('show=printreport&sec='.EncData(trim(DecData($_GET["sec"], 1, $objBF)), 2, $objBF).'&sd='.EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF).'&ed='.EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF).'&bc='.EncData(trim(DecData($_GET["bc"], 1, $objBF)), 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&bct='.EncData(trim(DecData($_GET["bct"], 1, $objBF)), 2, $objBF));
	
	} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == "G"){
	
	$MakeLinkForPrint = Route::_('show=printreport&sec='.EncData(trim(DecData($_GET["sec"], 1, $objBF)), 2, $objBF).'&sd='.EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF).'&ed='.EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF).'&bc='.EncData(trim(DecData($_GET["bc"], 1, $objBF)), 2, $objBF));
	
	} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == "F"){
	
	$MakeLinkForPrint = Route::_('show=printreport&sec='.EncData(trim(DecData($_GET["sec"], 1, $objBF)), 2, $objBF).'&sd='.EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF).'&ed='.EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF).'&fo='.EncData(trim(DecData($_GET["fo"], 1, $objBF)), 2, $objBF).'&bc='.EncData(trim(DecData($_GET["bc"], 1, $objBF)), 2, $objBF));
	
	} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == "H"){
	
	$MakeLinkForPrint = Route::_('show=printreport&sec='.EncData(trim(DecData($_GET["sec"], 1, $objBF)), 2, $objBF).'&sd='.EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF).'&ed='.EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF).'&bc='.EncData(trim(DecData($_GET["bc"], 1, $objBF)), 2, $objBF));
	
	} 

}

if(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'A'){
$MainHeadTitle = 'Purchasing Report';
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'B'){
$MainHeadTitle = 'Selling Report';
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'C'){
$MainHeadTitle = 'Profit & loss Report';
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'D'){
$MainHeadTitle = '';
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'E'){
$MainHeadTitle = 'Customer Balance Report';
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'F'){
$MainHeadTitle = 'Customer Disc & Other Charges';
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'H'){
$MainHeadTitle = 'Supplier Discount';
}

if(trim(DecData($_GET["sd"], 1, $objBF))!=''){
	$ReturnStartDate = trim(DecData($_GET["sd"], 1, $objBF));
} else {
	$ReturnStartDate = '';
}

if(trim(DecData($_GET["ed"], 1, $objBF))!=''){
	$ReturnEndDate = trim(DecData($_GET["ed"], 1, $objBF));
} else {
	$ReturnEndDate = '';
}

if(trim(DecData($_GET["bvd"], 1, $objBF))!=''){
	$Return_by_vendor = trim(DecData($_GET["bvd"], 1, $objBF));
} else {
	$Return_by_vendor = 0;
}

if(trim(DecData($_GET["bc"], 1, $objBF))!=''){
	$Return_by_customer = trim(DecData($_GET["bc"], 1, $objBF));
} else {
	$Return_by_customer = 0;
}

if(trim(DecData($_GET["bl"], 1, $objBF))!=''){
	$Return_by_location = trim(DecData($_GET["bl"], 1, $objBF));
} else {
	$Return_by_location = 0;
}

if(trim(DecData($_GET["bct"], 1, $objBF))!=''){
	$Return_by_customer_type = trim(DecData($_GET["bct"], 1, $objBF));
} else {
	$Return_by_customer_type = 0;
}

if(trim(DecData($_GET["fo"], 1, $objBF))!=''){
	$Return_filter_option = trim(DecData($_GET["fo"], 1, $objBF));
} else {
	$Return_filter_option = 0;
}

if(trim(DecData($_GET["bve"], 1, $objBF))!=''){
	$Return_by_vehicle = trim(DecData($_GET["bve"], 1, $objBF));
} else {
	$Return_by_vehicle = 0;
}
if(trim(DecData($_GET["ba"], 1, $objBF))!=''){
	$Return_by_area = trim(DecData($_GET["ba"], 1, $objBF));
} else {
	$Return_by_area = 0;
}
if(trim(DecData($_GET["bi"], 1, $objBF))!=''){
	$Return_by_invoice = trim(DecData($_GET["bi"], 1, $objBF));
} else {
	$Return_by_invoice = '';
}
?>