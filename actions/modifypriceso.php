<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["mode"] == "search"){
	
	$start_date			= trim($_POST["start_date"]);
	$end_date			= trim($_POST["end_date"]);
	$by_vendor			= trim($_POST["by_vendor"]);
	
	$link = Route::_('show=modifypriceso&d=r&sd='.EncData($start_date, 2, $objBF).'&ed='.EncData($end_date, 2, $objBF).'&bvd='.EncData($by_vendor, 2, $objBF));
    redirect($link);
}

if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST["upval"] == "yes"){

    $GetRequestedOrderId    = $_POST["ordi"];
    
    for($i=0;$i<=count($GetRequestedOrderId);$i++){
        if($GetRequestedOrderId[$i] != ''){
        

            $objSSSjatlan->resetProperty();
            $objSSSjatlan->setProperty("order_request_id", $GetRequestedOrderId[$i]);
            $objSSSjatlan->lstOrderRequestDetail();
            $GetOrderRequest = $objSSSjatlan->dbFetchArray(1);

            $objQayadaccount->resetProperty();
            $objQayadaccount->setProperty("entery_id", $GetRequestedOrderId[$i]);
            $objQayadaccount->setProperty("tran_code", $GetOrderRequest["tran_code"]);
            $objQayadaccount->lstAccountTransaction();
            $Getranscode = $objQayadaccount->dbFetchArray(1);

            $NewFinallAmount = $_POST["pia_".$GetRequestedOrderId[$i]] * $GetOrderRequest["no_of_items"];

            echo $GetRequestedOrderId[$i]. '  -- '. $_POST["pia_".$GetRequestedOrderId[$i]].' > '.$GetOrderRequest["no_of_items"].' > '.$GetOrderRequest["tran_code"].'='.$Getranscode["tran_code"].'-'.$Getranscode["trans_amount"].'+'.$NewFinallAmount.'<br>';

                if($GetRequestedOrderId[$i]!=''){
                $objSSSjatlan->resetProperty();
                $objSSSjatlan->setProperty("order_request_id", $GetRequestedOrderId[$i]);
                $objSSSjatlan->setProperty("per_item_amount", $_POST["pia_".$GetRequestedOrderId[$i]]);
                $objSSSjatlan->setProperty("final_amount", $NewFinallAmount);
                $objSSSjatlan->actOrderRequestDetail('U');
                }
                if($Getranscode["transaction_id"]!=''){
                $objQayadaccount->resetProperty();
                $objQayadaccount->setProperty("transaction_id", $Getranscode["transaction_id"]);
                $objQayadaccount->setProperty("trans_amount", $NewFinallAmount);
                $objQayadaccount->actAccountTransaction('U');
                }
        }
    }


    $objCommon->setMessage('Order Per Item Amount has been updated successfully.', 'Info');
    $link = Route::_('show=modifypriceso');
    // $link = Route::_('show=vendororder');
    redirect($link);

// print_r($_POST);
// die();

}
if($_GET['d'] == 'r'){

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
}