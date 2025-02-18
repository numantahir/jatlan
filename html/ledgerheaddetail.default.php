<?php
/*echo trim(DecData($_GET["t"], 1, $objBF)).'<br>';
echo trim(DecData($_GET["i"], 1, $objBF)).'<br>';
echo $GetHeadInfo["head_type_id"];
die();*/

?>
<div style="display:none;"><?php echo trim(DecData($_GET["t"], 1, $objBF)) . '  ---  '.$GetHeadInfo["head_type_id"]; ?></div>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=ledgerhead&t='.EncData(trim(DecData($_GET["t"], 1, $objBF)), 2, $objBF));?>" class="btn">Back</a> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><?php echo $MainHeadTitle;?> </h4>
            <div class="toolbar text-right"><a href="#" onClick="openRequestedPopup('<?php echo $MakeLinkForPrint;?>');"><i class="material-icons">printer</i></a></div>
            <?php include(HTML_PATH."ledgerfilter.php");?>
            <hr>
            <div class="material-datatables">
            <?php if(trim(DecData($_GET["t"], 1, $objBF)) == 'CD'){ ?>
				<table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
<th width="6%" align="left">Date</th>
<th width="6%" align="left">Txn#</th>
<th width="13%" align="left">Description</th>
<th width="7%" align="left">Vehicle#</th>
<th width="5%" align="left">Qty</th>
<th width="7%" align="left">Rate</th>
<th width="9%" align="left">L/Charges</th>
<th width="8%" align="left">D/Charges</th>
<th width="11%" align="left">Location</th>
<th width="9%" align="left">Debit</th>
<th width="9%" align="left">Credit</th>
<th width="10%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSLocationGet = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    $objQayadaccountDetail->setProperty("pay_mode", '9');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}
							
							if($LedgerHeadDetails["pay_mode"] != 1){
								if($LedgerHeadDetails["transfer_head_id"] != ''){
									$objQayadaccountLinkHead->resetProperty();
									$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
									$objQayadaccountLinkHead->lstHead();
									$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
									$TransferHeadTitle = $TransferHeadDetail["head_title"];
								} else {
									$TransferHeadTitle = '';
								}
							}
							
							
							
							/*if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = '>>'.$TransferHeadTitle;
								$TransferHeadName = '';
							}*/

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSLocationGet->resetProperty();
								$objSSSLocationGet->setProperty("location_id", $OrderRequestLocation["destination_id"]);
								$objSSSLocationGet->setProperty("isActive", 1);
								$objSSSLocationGet->lstLocation();
								$GetLocation = $objSSSLocationGet->dbFetchArray(1);
								$LinkHeadTitle = $GetLocation["location_name"];
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							if($LedgerHeadDetails["aplic_mode"] == 4){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("cc_order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstCustomerContraOrderDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);

								$ShowExtraTextoption = 1;
								$VehicleNo = $OrderRequest["vehicle_id"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
								
							} elseif($LedgerHeadDetails["aplic_mode"] == 5){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("cc_order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstCustomerContraOrderDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);

								$ShowExtraTextoption = 1;
								$VehicleNo = $OrderRequest["vehicle_id"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["to_per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);	
							} elseif($LedgerHeadDetails["entery_id"] != '' && $LedgerHeadDetails["trans_type"] == 9){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstOrderRequestDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);
							
							//$objSSSVehicleNo
							//lstVehicle
							$objSSSVehicleNo->resetProperty();
							$objSSSVehicleNo->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehicleNo->setProperty("isActive", 1);
							$objSSSVehicleNo->lstVehicle();
							$GetVehicleNumber = $objSSSVehicleNo->dbFetchArray(1);
								$ShowExtraTextoption = 1;
								$VehicleNo = $GetVehicleNumber["vehicle_number"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
							} else {
								$ShowExtraTextoption = 0;	
								$VehicleNo = "-";
								$TotalOrderQty = "-";
								$PerItemRateCharge = "-";
								$LaberCharges  = "-";
								$DeliverCharges  = "-";
								$TotalAmount = "-";
							}
							if($LedgerHeadDetails["trans_mode"] == 1){
								$LaberCharges  = "-";
							} else {
								$LaberCharges  = $OrderRequest["unloading_price"];
							}
                    ?>
                  <tr>
                    <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php 
					if($LedgerHeadDetails["pay_mode"] == 1){
						echo $LedgerHeadDetails["trans_title"].$TransferHeadName;
					
					if($LedgerHeadDetails["trans_note"] != ''){
						echo '<br>'.$LedgerHeadDetails["trans_note"];	
					}
					
					if($LedgerHeadDetails["pay_mode"] != 1){
						
						echo '<br> '.$TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					} elseif($LedgerHeadDetails["pay_mode"] == 2 or $LedgerHeadDetails["pay_mode"] == 3  or $LedgerHeadDetails["pay_mode"] == 4 or $LedgerHeadDetails["pay_mode"] ==5 or $LedgerHeadDetails["pay_mode"] ==6){
						echo $TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					} else {
					echo $LedgerHeadDetails["trans_title"].$TransferHeadName;
					
					if($LedgerHeadDetails["trans_note"] != ''){
						echo '<br>'.$LedgerHeadDetails["trans_note"];	
					}
					
					if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["pay_mode"] != 9 && $LedgerHeadDetails["pay_mode"] != 8){
						
						echo '<br> '.$TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					} 
					}
					?></td>
                    
                    <td><?php echo $VehicleNo;?></td>
                    <td><?php if($LedgerHeadDetails["aplic_mode"] !=3){ echo $TotalOrderQty;} else { echo '-'; }?></td>
                    <td><?php if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["aplic_mode"] !=9 && $LedgerHeadDetails["aplic_mode"] !=4){ echo $PerItemRateCharge;} else { echo '-'; }?></td>
                    <td><?php if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["aplic_mode"] !=4){ echo $LaberCharges;} else { echo '-'; }?></td>
                    <td><?php if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["aplic_mode"] !=9 && $LedgerHeadDetails["aplic_mode"] !=4){ echo $DeliverCharges;} else { echo '-'; }?></td>
                    
                    <td><?php 
					if($LedgerHeadDetails["pay_mode"] == 8){
						echo $LinkHeadTitle;
					} else {
					echo PaymentOption($LedgerHeadDetails["pay_mode"]);
					
					}?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                   <?php } ?>
                  
                  
                </tbody>
</table>
			<?php } elseif(trim(DecData($_GET["t"], 1, $objBF)) == 'SD'){ ?>
            <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
            <th align="left">Date</th>
            <th align="left">Inv#</th>
            <th align="left">COF#</th>
            <th align="left">Vehicle#</th>
            <th align="left">Area</th>
            <th align="left">Qty</th>
            <th align="left">Rate</th>
            <th align="left">Debit</th>
            <th align="left">Credit</th>
            <th align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSDestination = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    $objQayadaccountDetail->setProperty("pay_mode", '9');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}
							
							if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["transfer_head_id"] != ''){
									$objQayadaccountLinkHead->resetProperty();
									$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
									$objQayadaccountLinkHead->lstHead();
									$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
									$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}
							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							if($LedgerHeadDetails["entery_id"] != '' && $LedgerHeadDetails["trans_type"] == 9){
								
								
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstOrderRequestDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);
							
							
							//$objSSSVehicleNo
							//lstVehicle
							$objSSSVehicleNo->resetProperty();
							$objSSSVehicleNo->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehicleNo->setProperty("isActive", 1);
							$objSSSVehicleNo->lstVehicle();
							$GetVehicleNumber = $objSSSVehicleNo->dbFetchArray(1);
							
							//Destination Detail
							//$objSSSDestination
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->setProperty("isActive", 1);
							$objSSSDestination->lstLocation();
							$GetDestinationDetail = $objSSSDestination->dbFetchArray(1);
							
							
							
								$ShowExtraTextoption = 1;
								$VehicleNo = $GetVehicleNumber["vehicle_number"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
								$FinalDestinaitonDetail = $GetDestinationDetail["location_name"];
								$TransactionInvoiceNo = $OrderRequest["d_invoice_no"];
								$cof_no = '>>'.$OrderRequest["cof_no"];
								
							} else {
								$ShowExtraTextoption = 0;	
								$VehicleNo = "-";
								$TotalOrderQty = "-";
								$PerItemRateCharge = "-";
								$LaberCharges  = "-";
								$DeliverCharges  = "-";
								$TotalAmount = "-";
								$FinalDestinaitonDetail = "-";
								$TransactionInvoiceNo = $LedgerHeadDetails["transaction_number"];
								
								if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["pay_mode"] != 9){
						
								$cof_no = $TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
								} elseif($LedgerHeadDetails["pay_mode"] == 9){
								$cof_no = "Discount";
								} else {
								$cof_no = "-";
								}
							}
                    ?>
                  <tr>
                    <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                    <td><?php echo $TransactionInvoiceNo;?></td>
                    <td><?php echo $cof_no;?></td>
                    <td><?php echo $VehicleNo;?></td>
                    <td><?php echo $FinalDestinaitonDetail; ?></td>
                    <td><?php echo $TotalOrderQty;?></td>
                    <td><?php echo $PerItemRateCharge;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                   <?php } ?>
                
                  
                </tbody>
</table>
            <?php
			} else {
			if($GetHeadInfo["head_type_id"] == 1){ ?>
            <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction #</th>
                    <th>Item</th>
                    <th>Title / Description</th>
                    <th>Link Head</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}
							$objQayadaccountLinkHead->resetProperty();
							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							} else {
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
							}
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadItemTitle = $TransferHeadDetail["item_title"];
							
							
							//$TransferHeadTitle
							
							
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							
							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'SA4-'.'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $TransferHeadItemTitle;?></td>
                    
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } elseif($GetHeadInfo["head_type_id"] == 2){?>
              <table data-order="[[ 0, &quot;desc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction#</th>
                    <th>Head</th>
                    <th>Item/Head</th>
                    <th>Description</th>
                    <!--<th>Pay Mode</th>-->
                    <th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
				  $BalanceAmount = 0;
					$objQayadaccountHead	= new Qayadaccount;
					$objQayadaccountTHead	= new Qayadaccount;
					$objQayadaccount->resetProperty();
                    if($_GET["sd"] != ''){
					$objQayadaccount->setProperty("DATEFILTER", 'YES');
					$objQayadaccount->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccount->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccount->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccount->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccount->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccount->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccount->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccount->lstAccountTransaction();

                    while($ListOfTransaction = $objQayadaccount->dbFetchArray(1)){
						
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($ListOfTransaction["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $ListOfTransaction["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $ListOfTransaction["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($ListOfTransaction["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $ListOfTransaction["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $ListOfTransaction["trans_amount"];
						}
							
						} else {
							
						if($ListOfTransaction["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $ListOfTransaction["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $ListOfTransaction["trans_amount"];
						}
						
						}
						
						
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$TransferHeadDetail = $objQayadaccountHead->dbFetchArray(1);
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						
						if($ListOfTransaction["transfer_item_id"] != ''){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("item_id", $ListOfTransaction["transfer_item_id"]);
						$objQayadaccountTHead->lstHeadItems();
						$TransferHeadDetailItem = $objQayadaccountTHead->dbFetchArray(1);
						$TransferHeadItem = $TransferHeadDetailItem["item_title"];
						if($TransferHeadDetail["head_type_id"] != 7){
						$TransactionHeadTypeTitle = $TransferHeadDetail["head_title"];	
						
						} else {
						$TransactionHeadTypeTitle = $TransactionHeadTypeTitle;
						}
						//
						} else {
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$TransactionHeadDetail = $objQayadaccountHead->dbFetchArray(1);	
						$TransferHeadItem = $TransactionHeadDetail["head_title"];
						}
						
						if($TransferHeadDetail["head_type_id"] == 2){
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountHead->lstHead();
						$TransferHeadDetail = $objQayadaccountHead->dbFetchArray(1);
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						
						if($ListOfTransaction["item_id"] != ''){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("item_id", $ListOfTransaction["item_id"]);
						$objQayadaccountTHead->lstHeadItems();
						$TransferHeadDetailItem = $objQayadaccountTHead->dbFetchArray(1);
						$TransferHeadItem = $TransferHeadDetailItem["item_title"];	
						$TransactionHeadTypeTitle = $TransferHeadDetail["head_title"];
						} else {
						$TransferHeadItem = $TransferHeadDetail["head_title"];	
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						}
						}
                    ?>
                  <tr>
                  <td><?php echo $ListOfTransaction["trans_date"];?></td>
                    <td><?php echo $ListOfTransaction["transaction_number"];?></td>
                    <td><?php echo $TransactionHeadTypeTitle;//echo $TransferHeadDetail["head_title"];?></td>
                    <td><?php echo $TransferHeadItem;?></td>
                    <td><?php echo $ListOfTransaction["trans_title"];?> <small><br>
                      <?php echo ' '.$ListOfTransaction["trans_note"];?>
                      </small></td>
                    <!--<td><?php //echo PaymentOption($ListOfTransaction["pay_mode"]);?></td>-->
                    
                     <td><?php 
					if($ListOfTransaction["trans_mode"] == 1){

					echo Numberformt($ListOfTransaction["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($ListOfTransaction["trans_mode"] == 2){

					echo Numberformt($ListOfTransaction["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } //} ?>
                </tbody>
              </table>
              <?php } elseif($GetHeadInfo["head_type_id"] == 4){?>
               <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
<th width="6%" align="left">Date</th>
<th width="6%" align="left">Txn#</th>
<th width="13%" align="left">Description</th>
<th width="7%" align="left">Vehicle#</th>
<th width="5%" align="left">Qty</th>
<th width="7%" align="left">Rate</th>
<th width="9%" align="left">L/Charges</th>
<th width="8%" align="left">D/Charges</th>
<th width="11%" align="left">Location</th>
<th width="9%" align="left">Debit</th>
<th width="9%" align="left">Credit</th>
<th width="10%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSLocationGet = new SSSjatlan;
					$objSSSContracOrdeDEtailAccess = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}
							
							if($LedgerHeadDetails["pay_mode"] != 1){
								if($LedgerHeadDetails["transfer_head_id"] != ''){
									$objQayadaccountLinkHead->resetProperty();
									$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
									$objQayadaccountLinkHead->lstHead();
									$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
									$TransferHeadTitle = $TransferHeadDetail["head_title"];
								} else {
									$TransferHeadTitle = '';
								}
							}
							
							
							
							/*if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = '>>'.$TransferHeadTitle;
								$TransferHeadName = '';
							}*/

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSLocationGet->resetProperty();
								$objSSSLocationGet->setProperty("location_id", $OrderRequestLocation["destination_id"]);
								$objSSSLocationGet->setProperty("isActive", 1);
								$objSSSLocationGet->lstLocation();
								$GetLocation = $objSSSLocationGet->dbFetchArray(1);
								$LinkHeadTitle = $GetLocation["location_name"];
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							if($LedgerHeadDetails["aplic_mode"] == 4){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("cc_order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstCustomerContraOrderDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);

								$ShowExtraTextoption = 1;
								//$VehicleNo = $OrderRequest["vehicle_id"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
								
							} elseif($LedgerHeadDetails["aplic_mode"] == 5){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("cc_order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstCustomerContraOrderDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);

								$ShowExtraTextoption = 1;
								//$VehicleNo = $OrderRequest["vehicle_id"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["to_per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);	
							} elseif($LedgerHeadDetails["entery_id"] != '' && $LedgerHeadDetails["trans_type"] == 9){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstOrderRequestDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);
							
							//$objSSSVehicleNo
							//lstVehicle
							//echo $OrderRequest["vehicle_id"].'<br>';
							if($OrderRequest["vehicle_id"]!= ''){
							$objSSSVehicleNo->resetProperty();
							$objSSSVehicleNo->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehicleNo->setProperty("isActive", 1);
							$objSSSVehicleNo->lstVehicle();
							$GetVehicleNumber = $objSSSVehicleNo->dbFetchArray(1);
							$VValPass = $GetVehicleNumber["vehicle_number"];
							} else {
								$VValPass = "-";
							}
							
								$ShowExtraTextoption = 1;
								$VehicleNo = $VValPass;
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
							} else {
								
								
								$ShowExtraTextoption = 0;	
								$VehicleNo = "-";
								$TotalOrderQty = "-";
								$PerItemRateCharge = "-";
								$LaberCharges  = "-";
								$DeliverCharges  = "-";
								$TotalAmount = "-";
								
							}
							if($LedgerHeadDetails["trans_mode"] == 1){
								$LaberCharges  = "-";

							} else {
								$LaberCharges  = $OrderRequest["unloading_price"];
							}
						if($LedgerHeadDetails["aplic_mode"] >= 4 && $LedgerHeadDetails["aplic_mode"] <= 5){
							if($LedgerHeadDetails["tran_code"] != ''){
							$objSSSContracOrdeDEtailAccess->resetProperty();
							//$objSSSContracOrdeDEtailAccess->setProperty("cc_order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSContracOrdeDEtailAccess->setProperty("tran_code", $LedgerHeadDetails["tran_code"]);
							$objSSSContracOrdeDEtailAccess->setProperty("isActive", 1);
							$objSSSContracOrdeDEtailAccess->lstCustomerContraOrderDetail();
							$CheckCounterCC_Count = $objSSSContracOrdeDEtailAccess->totalRecords();
						} else {
							$CheckCounterCC_Count = 0;
						
						}
							//echo $CheckCounterCC_Count.'-';
							if($CheckCounterCC_Count > 0){
								$GetContraOrderDetail = $objSSSContracOrdeDEtailAccess->dbFetchArray(1);	
								
								if($GetContraOrderDetail["vehicle_id"] != ''){
								/*$objSSSVehicleNo->resetProperty();
								$objSSSVehicleNo->setProperty("vehicle_id", $GetContraOrderDetail["vehicle_id"]);
								$objSSSVehicleNo->setProperty("isActive", 1);
								$objSSSVehicleNo->lstVehicle();
								$GetContraVehicleNumber = $objSSSVehicleNo->dbFetchArray(1);*/
									//die('This iSssue->'.$GetContraOrderDetail["vehicle_id"]);
								$PassContraVehicle = $GetContraOrderDetail["vehicle_id"];
								} else {
									$PassContraVehicle = '-';
								}
								$ShowExtraTextoption = 1;
								$Contra_VehicleNo = $PassContraVehicle;
								$Contra_TotalOrderQty = $GetContraOrderDetail["no_of_items"];
								$Contra_PerItemRateCharge = $GetContraOrderDetail["per_item_amount"];
								$Contra_LaberCharges  = $GetContraOrderDetail["unloading_price"];
								$Contra_DeliverCharges  = $GetContraOrderDetail["delivery_chagres"];
								//$Contra_TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
								
							} else {
								$ShowExtraTextoption = 0;
								$Contra_VehicleNo = '-';
								$Contra_TotalOrderQty = '-';
								$Contra_PerItemRateCharge = '-';
								$Contra_LaberCharges = '-';
									$Contra_DeliverCharges = '-';
								
								
							}
							
							//	
						} else {
							$$CheckCounterCC_Count == 0;
								}
						
						
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <td><?php echo $LedgerHeadDetails["transaction_id"];?></td>
                    <td><?php 
					if($LedgerHeadDetails["pay_mode"] == 1){
						echo $LedgerHeadDetails["trans_title"].$TransferHeadName;
					
					if($LedgerHeadDetails["trans_note"] != ''){
						echo '<br>'.$LedgerHeadDetails["trans_note"];	
					}
					
					if($LedgerHeadDetails["pay_mode"] != 1){
						
						echo '<br> '.$TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					} elseif($LedgerHeadDetails["pay_mode"] == 2 or $LedgerHeadDetails["pay_mode"] == 3  or $LedgerHeadDetails["pay_mode"] == 4 or $LedgerHeadDetails["pay_mode"] ==5 or $LedgerHeadDetails["pay_mode"] ==6){
						echo $TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					} else {
					echo $LedgerHeadDetails["trans_title"].$TransferHeadName;
					
					if($LedgerHeadDetails["trans_note"] != ''){
						echo '<br>'.$LedgerHeadDetails["trans_note"];	
					}
					
					if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["pay_mode"] != 9 && $LedgerHeadDetails["pay_mode"] != 8){
						
						echo '<br> '.$TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					} 
					}
					?></td>
                    
                    <td><?php 
						if($CheckCounterCC_Count > 0){
							echo $Contra_VehicleNo;
						} else {
					if($LedgerHeadDetails["pay_mode"] == 8){
					echo $VehicleNo; } else { echo '-'; }
						}
						?></td>
                    <td><?php 
						if($CheckCounterCC_Count > 0){
							echo $Contra_TotalOrderQty;
						} else {
						if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["aplic_mode"] !=9 && $LedgerHeadDetails["aplic_mode"] !=4){ echo $TotalOrderQty;} else { echo '-'; }
						}?></td>
					  
                    <td><?php 
						if($CheckCounterCC_Count > 0){
							echo $Contra_PerItemRateCharge;
						} else {
						
						if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["aplic_mode"] !=9 && $LedgerHeadDetails["aplic_mode"] !=4){ echo $PerItemRateCharge;} else { echo '-'; } }?></td>
                    <td><?php 
						if($CheckCounterCC_Count > 0){
							echo $Contra_LaberCharges;
						} else {
						if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["aplic_mode"] !=4){ echo $LaberCharges;} else { echo '-'; } }?></td>
                    <td><?php 
						if($CheckCounterCC_Count > 0){
							echo $Contra_DeliverCharges;
						} else {
						if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["aplic_mode"] !=9 && $LedgerHeadDetails["aplic_mode"] !=4){ echo $DeliverCharges;} else { echo '-'; } }?></td>
                    
                    <td><?php 
					if($LedgerHeadDetails["pay_mode"] == 8){
						echo $LinkHeadTitle;
					} else {
					echo PaymentOption($LedgerHeadDetails["pay_mode"]);
					
					}?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
             
					
					<?php }  ?>
                  
                  
                </tbody>
</table>
              <?php } elseif($GetHeadInfo["head_type_id"] == 6){?>
              <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
            <th align="left">Date</th>
            <th align="left">Inv#</th>
            <th align="left">COF#</th>
            <th align="left">Vehicle#</th>
            <th align="left">Area</th>
            <th align="left">Qty</th>
            <th align="left">Rate</th>
            <th align="left">Debit</th>
            <th align="left">Credit</th>
            <th align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSDestination = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}
							
							if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["transfer_head_id"] != ''){
									$objQayadaccountLinkHead->resetProperty();
									$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
									$objQayadaccountLinkHead->lstHead();
									$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
									$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}
							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							if($LedgerHeadDetails["entery_id"] != '' && $LedgerHeadDetails["trans_type"] == 9){
								
								
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstOrderRequestDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);
							
							
							//$objSSSVehicleNo
							//lstVehicle
							$objSSSVehicleNo->resetProperty();
							$objSSSVehicleNo->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehicleNo->setProperty("isActive", 1);
							$objSSSVehicleNo->lstVehicle();
							$GetVehicleNumber = $objSSSVehicleNo->dbFetchArray(1);
							
							//Destination Detail
							//$objSSSDestination
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->setProperty("isActive", 1);
							$objSSSDestination->lstLocation();
							$GetDestinationDetail = $objSSSDestination->dbFetchArray(1);
							
							
							
								$ShowExtraTextoption = 1;
								$VehicleNo = $GetVehicleNumber["vehicle_number"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
								$FinalDestinaitonDetail = $GetDestinationDetail["location_name"];
								$TransactionInvoiceNo = $OrderRequest["d_invoice_no"];
								$cof_no = '>>'.$OrderRequest["cof_no"];
								
							} else {
								$ShowExtraTextoption = 0;	
								$VehicleNo = "-";
								$TotalOrderQty = "-";
								$PerItemRateCharge = "-";
								$LaberCharges  = "-";
								$DeliverCharges  = "-";
								$TotalAmount = "-";
								$FinalDestinaitonDetail = "-";
								$TransactionInvoiceNo = $LedgerHeadDetails["transaction_number"];
								
								if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["pay_mode"] != 9){
						
								$cof_no = $TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
								} elseif($LedgerHeadDetails["pay_mode"] == 9){
								$cof_no = "Discount";
								} else {
								$cof_no = "-";
								}
							}
                    ?>
                  <tr>
                    <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                    <td><?php echo $TransactionInvoiceNo;?></td>
                    <td><?php echo $cof_no;?></td>
                    <td><?php echo $VehicleNo;?></td>
                    <td><?php echo $FinalDestinaitonDetail; ?></td>
                    <td><?php echo $TotalOrderQty;?></td>
                    <td><?php echo $PerItemRateCharge;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                   <?php } ?>
                
                  
                </tbody>
</table>
			  <?php } elseif($GetHeadInfo["head_type_id"] == 3){?>
               <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction #</th>
                    <th>Particular</th>
                    <th>Description</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objQayadHeadDetail = new Qayadaccount;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						
						//1=>General, 2=>Cash, 3=>Back Account, 4=>Customer, 5=>Employee, 6=>Vendors, 7=>Vehicle, 8=>Unloading, 9=>Vehicle Item Head
						if($LedgerHeadDetails["transfer_head_id"] != ''){
						$objQayadHeadDetail->resetProperty();
						$objQayadHeadDetail->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
						$objQayadHeadDetail->lstHead();
						$TransactionHeadDetail = $objQayadHeadDetail->dbFetchArray(1);
							
							if($TransactionHeadDetail["head_type_id"] == 1){
							// General Item
								if($LedgerHeadDetails["transfer_item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
								$TranTypeMode = 'General Item: '.$TransferHeadName;
							
							} elseif($TransactionHeadDetail["head_type_id"] == 9){
							//Vehicle Item Transfer
							
								if($LedgerHeadDetails["transfer_item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
								$TranTypeMode = 'Vehicle Item: '.$TransferHeadName;
							
							} elseif($TransactionHeadDetail["head_type_id"] == 3){
							//Bank to Bank Transfer
							$TranTypeMode = 'Bank to Bank:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 4){
							//Customer Transfer
							$TranTypeMode = 'Customer:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 5){
							//Employee Transfer
							$TranTypeMode = 'Employee:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 6){
							//Vendor Transfer
							$TranTypeMode = 'Vendor:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 7){
							//Vehicle Transfer
							$TranTypeMode = 'Vehicle:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 8){
							//Unloader Transfer
							$TranTypeMode = 'Unloader:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 2){
							//Vehicle Item Transfer
							$TranTypeMode = 'Cash:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 13){
							//Vehicle Item Transfer
							$TranTypeMode = 'Drawing Account:'.$TransactionHeadDetail["head_title"];
							} else {
							$TranTypeMode = ' - '.$TransactionHeadDetail["head_title"];	
							}
						
						
						}
						
						
						
						
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $TranTypeMode;?></td>
                    <td><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } elseif($GetHeadInfo["head_type_id"] == 10){?>
               <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction #</th>
                    <th>Title / Description</th>
                    <th>Link Head</th>
                    <th>Vehicle</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSVehicleDetail = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							
								if($LedgerHeadDetails["location_id"] != ""){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["location_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSVehicleDetail->resetProperty();
								$objSSSVehicleDetail->setProperty("vehicle_id", $OrderRequestLocation["vehicle_id"]);
								$objSSSVehicleDetail->setProperty("isActive", 1);
								$objSSSVehicleDetail->lstVehicle();
								$GetVehicleNumber = $objSSSVehicleDetail->dbFetchArray(1);
								$VehicleNumber = $GetVehicleNumber["vehicle_number"];
								} else {
								$VehicleNumber = '';
								}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumber;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
			  <?php } elseif($GetHeadInfo["head_type_id"] == 11){?>
				<table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction #</th>
                    <th>Title / Description</th>
                    <th>Link Head</th>
                    <th>Vehicle</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSVehicleDetail = new SSSjatlan;
					$objVehiclhead = new Qayadaccount;
					if(trim(DecData($_GET["vhi"], 1, $objBF)) != '' && $ReturnVehicleHeadId!=0){
						$objVehiclhead->resetProperty();
						$objVehiclhead->setProperty("head_id", $ReturnVehicleHeadId);
						$objVehiclhead->lstHead();
						$VehicleDetail = $objVehiclhead->dbFetchArray(1);	
						// $TransferHeadTitle = $VehicleDetail["head_title"];
					}
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					if(trim(DecData($_GET["vhi"], 1, $objBF)) != '' && $ReturnVehicleHeadId!=0){
					$objQayadaccountDetail->setProperty("entery_id", $VehicleDetail["entity_id"]);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							
								if($LedgerHeadDetails["location_id"] != ""){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["location_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSVehicleDetail->resetProperty();
								$objSSSVehicleDetail->setProperty("vehicle_id", $OrderRequestLocation["vehicle_id"]);
								$objSSSVehicleDetail->setProperty("isActive", 1);
								$objSSSVehicleDetail->lstVehicle();
								$GetVehicleNumber = $objSSSVehicleDetail->dbFetchArray(1);
								$VehicleNumber = $GetVehicleNumber["vehicle_number"];
								} else {
								$VehicleNumber = '';
								}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumber;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } elseif($GetHeadInfo["head_type_id"] == 12){?>
              <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction #</th>
                    <th>Title / Description</th>
                    <th>Link Head</th>
                    <th>Vehicle</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadGetVehicleEntityID = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSVehicleDetail = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
					/*if(trim(DecData($_GET["vhi"], 1, $objBF)) != '' && $ReturnVehicleHeadId!=0){
					$objQayadaccountDetail->setProperty("entery_id", $ReturnVehicleHeadId);
					}*/
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							
								if($LedgerHeadDetails["location_id"] != ""){
								$ShowAllRecords = 1;
								//echo $ReturnVehicleHeadId.'<br>';
								$objSSSjatlan->resetProperty();
								if(trim(DecData($_GET["vhi"], 1, $objBF)) != '' && $ReturnVehicleHeadId!=0){
								$objQayadGetVehicleEntityID->resetProperty();
								$objQayadGetVehicleEntityID->setProperty("head_id", $ReturnVehicleHeadId);
								$objQayadGetVehicleEntityID->lstHead();
								$GetVehicleEntityId = $objQayadGetVehicleEntityID->dbFetchArray(1);	
								$objSSSjatlan->setProperty("vehicle_id", $GetVehicleEntityId["entity_id"]);
								$ShowAllRecords = 2;
								}
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["location_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								if($ShowAllRecords == 2){
								$CheckThisRecord = $objSSSjatlan->totalRecords();
								}
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSVehicleDetail->resetProperty();
								$objSSSVehicleDetail->setProperty("vehicle_id", $OrderRequestLocation["vehicle_id"]);
								$objSSSVehicleDetail->setProperty("isActive", 1);
								$objSSSVehicleDetail->lstVehicle();
								$GetVehicleNumber = $objSSSVehicleDetail->dbFetchArray(1);
								$VehicleNumber = $GetVehicleNumber["vehicle_number"];
								} else {
								$VehicleNumber = '';
								}
								if($ShowAllRecords == 1){
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumber;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  				<?php } elseif($ShowAllRecords == 2 && $CheckThisRecord >0){ ?>
                                <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumber;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } } ?>
                </tbody>
              </table>
              <?php } elseif($GetHeadInfo["head_type_id"] == 8){?>
               <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction #</th>
                    <th>Title / Description</th>
                    <th>Link Head</th>
                    <th>Vehicle#</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
					
					if($LedgerHeadDetails["location_id"] != ''){
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("vehicle_id", $LedgerHeadDetails["location_id"]);
                    $objSSSjatlan->lstVehicle();
                    $GetVehicleDetail = $objSSSjatlan->dbFetchArray(1);
						$VehicleNumberdetail = $GetVehicleDetail["vehicle_number"];
					} else {
						$VehicleNumberdetail = '';
					}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumberdetail;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else { ?>
              <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction #</th>
                    <th>Title / Description</th>
                    <th>Link Head</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						if($GetHeadInfo["head_type_id"] == 2){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} elseif($GetHeadInfo["head_type_id"] == 3){
						
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						}
							
						} else {
							
						if($LedgerHeadDetails["trans_mode"] == 2){
							$BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
						} else {
							$BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
						}
						
						}

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } } ?>
            </div>
          </div>
          
          <!-- end content--> 
          
        </div>
        
        <!--  end card  --> 
        
      </div>
      
      <!-- end col-md-12 --> 
      
    </div>
    
    <!-- end row --> 
    
  </div>
</div>
