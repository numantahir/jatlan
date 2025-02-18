<?php
if(trim(DecData($_GET["mode"], 1, $objBF)) == "Delete" && trim(DecData($_GET["tn"], 1, $objBF)) != "" && trim(DecData($_GET["i"], 1, $objBF)) != ""){

	$objQayadaccountUpdate = new Qayadaccount;
	$objQayadaccount->resetProperty();
	$objQayadaccount->setProperty("transaction_number", trim(DecData($_GET["tn"], 1, $objBF)));
	$objQayadaccount->lstAccountTransaction();
	if($objQayadaccount->totalRecords() > 0){
	
	while($GetTransacrtionList = $objQayadaccount->dbFetchArray(1)){
		if($GetTransacrtionList["transaction_id"] != "" ){
			$objQayadaccountUpdate->resetProperty();
			$objQayadaccountUpdate->setProperty("transaction_id", $GetTransacrtionList["transaction_id"]);
			$objQayadaccountUpdate->setProperty("isActive", 3);
			$objQayadaccountUpdate->actAccountTransaction('U');
		}		
	}
	
	$objCommon->setMessage('Transaction status has been updated successfully.', 'Info');
	} else {
	$objCommon->setMessage('Transaction number not found.', 'Info');
	}
	
	$link = Route::_('show=ledgerheaddetail');
	redirect($link);
	
}
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "search"){



	$start_date			= trim($_POST["start_date"]);

	$end_date			= trim($_POST["end_date"]);

	$trans_status		= trim($_POST["trans_status"]);

	$item_id			= trim($_POST["item_id"]);

	$i					= trim($_POST["i"]);

	$t					= trim($_POST["t"]);

	$link_item_id		= trim($_POST["link_item_id"]);

	$link_head_id		= trim($_POST["link_head_id"]);
	
	$vehivle_head_id	= trim($_POST["vehivle_head_id"]);
	if($vehivle_head_id == ''){
		$PassVehicleID = 'NULL';	
	} else {
		$PassVehicleID = $vehivle_head_id;
	}
	//EncData(trim(DecData($_GET["i"], 1, $objBF)), 1, $objBF)
	$link = Route::_('show=ledgerheaddetail&md='.EncData('search', 2, $objBF).'&i='.EncData(trim(DecData($i, 1, $objBF)), 2, $objBF).'&t='.EncData(trim(DecData($t, 1, $objBF)), 2, $objBF).'&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&ts='.EncData($trans_status, 2, $objBF).'&ii='.EncData($item_id, 2, $objBF).'&lii='.EncData($link_item_id, 2, $objBF).'&lhi='.EncData($link_head_id, 2, $objBF).'&vhi='.EncData($PassVehicleID, 2, $objBF));
	
	redirect($link);

}

$objSSSVehicleNo = new SSSjatlan;
$objQayadaccount->resetProperty();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadaccount->setProperty("ORDERBY", 'head_title');
$objQayadaccount->lstHead();
$GetHeadInfo = $objQayadaccount->dbFetchArray(1);
$MainHeadTitle = $GetHeadInfo["head_title"].' &nbsp; ['.$GetHeadInfo["head_code"].'] ';
//1=>General, 2=>Cash, 3=>Back Account, 4=>Property

if($_GET["sd"] != ""){ $Filter_sd = EncData(trim(DecData($_GET["sd"], 1, $objBF)), 2, $objBF); } else { $Filter_sd = '';}

if($_GET["ed"] != ""){ $Filter_ed = EncData(trim(DecData($_GET["ed"], 1, $objBF)), 2, $objBF); } else { $Filter_ed = '';}

if($_GET["ts"] != ""){ $Filter_ts = EncData(trim(DecData($_GET["ts"], 1, $objBF)), 2, $objBF); } else { $Filter_ts = '';}

if($_GET["ii"] != ""){ $Filter_ii = EncData(trim(DecData($_GET["ii"], 1, $objBF)), 2, $objBF); } else { $Filter_ii = '';}

if($_GET["lii"] != ""){ $Filter_lii = EncData(trim(DecData($_GET["lii"], 1, $objBF)), 2, $objBF); } else { $Filter_lii = '';}

if($_GET["lhi"] != ""){ $Filter_lhi = EncData(trim(DecData($_GET["lhi"], 1, $objBF)), 2, $objBF); } else { $Filter_lhi = '';}

if($_GET["vhi"] != ""){ $Filter_vhi = EncData(trim(DecData($_GET["vhi"], 1, $objBF)), 2, $objBF); } else { $Filter_vhi = '';}

if(trim(DecData($_GET["t"], 1, $objBF)) == 7){
$MakeLinkForPrint =  Route::_('show=print&md='.EncData(trim(DecData($_GET["md"], 1, $objBF)), 2, $objBF).'&vi='.EncData($GetHeadInfo["entity_id"], 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&t='.EncData(trim(DecData($_GET["t"], 1, $objBF)), 2, $objBF).'&sd='.$Filter_sd.'&ed='.$Filter_ed.'&ts='.$Filter_ts.'&ii='.$Filter_ii.'&lii='.$Filter_lii.'&lhi='.$Filter_lhi.'&vhi='.$Filter_vhi);	
} else {
$MakeLinkForPrint =  Route::_('show=print&md='.EncData(trim(DecData($_GET["md"], 1, $objBF)), 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&t='.EncData(trim(DecData($_GET["t"], 1, $objBF)), 2, $objBF).'&sd='.$Filter_sd.'&ed='.$Filter_ed.'&ts='.$Filter_ts.'&ii='.$Filter_ii.'&lii='.$Filter_lii.'&lhi='.$Filter_lhi.'&vhi='.$Filter_vhi);
}

?>