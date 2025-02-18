<?php
//echo trim(DecData($_GET["t"], 1, $objBF)).'<br>';
//echo trim(DecData($_GET["i"], 1, $objBF));
//die();

?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><?php echo $MainHeadTitle;?> </h4>
            <div class="toolbar text-right"><a href="#" onClick="openRequestedPopup('<?php echo $MakeLinkForPrint;?>');"><i class="material-icons">printer</i></a></div>
            <?php include(HTML_PATH."ledgerfilter.php");?>
            <hr>
            <div class="material-datatables">
              <?php if($GetHeadInfo["head_type_id"] == 4){?>
              <table id="datatables" data-order="[[ 1, &quot;asc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Txn#</th>
                    <th>Description</th>
                    <th>Vehicle#</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>L/Charges</th>
                    <th>D/Charges</th>
                    <th>T-Amount</th>
                    <th>Link Head</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					
					
					Date
Description of item
Vehicle no
Quantity 
Rate
Labour charges, if any
Freight charges, if any
Total amount. 
Debit
Credit 
Running balance.
					
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
					$objQayadaccountDetail->setProperty("ORDERBY", 'transaction_id');

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
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    
                    <td><?php echo $VehicleNo;?></td>
                    <td><?php echo $TotalOrderQty;?></td>
                    <td><?php echo $PerItemRateCharge;?></td>
                    <td><?php echo $LaberCharges;?></td>
                    <td><?php echo $DeliverCharges;?></td>
                    <td><?php echo $TotalAmount;?></td>
                    
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
              <?php } elseif($GetHeadInfo["head_type_id"] == 6){?>
              <table id="datatables" data-order="[[ 1, &quot;asc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Txn#</th>
                    <th>Description</th>
                    <th>Vehicle#</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>L/Charges</th>
                    <th>D/Charges</th>
                    <th>T-Amount</th>
                    <th>Link Head</th>
					<th>Debit</th>
                   	<th>Credit</th>
                    <th>Balance</th>
                   <?php 
					/*
					
					
					Date
Description of item
Vehicle no
Quantity 
Rate
Labour charges, if any
Freight charges, if any
Total amount. 
Debit
Credit 
Running balance.
					
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
					$objQayadaccountDetail->setProperty("ORDERBY", 'transaction_id');

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
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    
                    <td><?php echo $VehicleNo;?></td>
                    <td><?php echo $TotalOrderQty;?></td>
                    <td><?php echo $PerItemRateCharge;?></td>
                    <td><?php echo $LaberCharges;?></td>
                    <td><?php echo $DeliverCharges;?></td>
                    <td><?php echo $TotalAmount;?></td>
                    
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
              <?php } else { ?>
              <table id="datatables" data-order="[[ 1, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
					$objQayadaccountDetail->setProperty("ORDERBY", 'transaction_id');

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
              <?php } ?>
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
