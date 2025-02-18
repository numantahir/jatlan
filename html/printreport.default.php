<?php include_once(ACTION_PATH.'script.php'); ?>
<style>
html, body {
	overflow-x: inherit;
}
body {
	margin: auto;
	padding: 0px;
	margin-top: 0px;
	border: 0px solid #eee;
	font-size: 12px;
	/*font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;*/
	font-family: system-ui;
	color: #000;
}
h4 {
	font-size: 20px;
	letter-spacing: 1px;
	font-weight: 600;
	margin-bottom: 5px;
}
.customer_ledgerTable{
	width: 100%;
	font-size: 10px;
}
.customer_ledgerTable th {
	font-size: 10px;
	font-weight: 600;
	background-color: #EBEBEB;
	line-height: 20px;
	border-bottom: solid 1px #999999;
}
.customer_ledgerTable td {
	font-size: 09px;
	line-height:normal;
	border-bottom: solid 1px #CCCCCC;
}
.ledgerTable {
	width: 100%;
	font-size: 12px;
}
.ledgerTable th {
	font-size: 12px;
	font-weight: 700;
	background-color: #EBEBEB;
	line-height: 20px;
	border-bottom: solid 1px #999999;
}
.ledgerTable td {
	font-size: 11px;
	line-height: 20px;
	border-bottom: solid 1px #CCCCCC;
}
.RightBorder {
	border-right: solid 1px #EEEEEE;
}
.titlefontsize {
	font-size: 10px !important;
	padding-left: 5px !important;
}
.btheading {
	font-weight: 600 !important;
	background-color: #CCC;
}
.btheading_last {
	font-weight: 600 !important;
	background-color: #999;
	color: #FFF !important;
}
</style>
<?php 
/*echo 't->'.trim(DecData($_GET["sd"], 1, $objBF)).'<br>';
echo 'vi->'.trim(DecData($_GET["ed"], 1, $objBF)).'<br>';
echo 'i->'.trim(DecData($_GET["sec"], 1, $objBF));
die();*/

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
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'G'){
$MainHeadTitle = 'Supplier Balance Report';
} elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'F'){
$MainHeadTitle = 'Customer Disc & Other Charges';
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
if(trim(DecData($_GET["fo"], 1, $objBF))!=''){
	$Return_filter_option = trim(DecData($_GET["fo"], 1, $objBF));
} else {
	$Return_filter_option = 0;
}

//$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
/*echo $GetHeadInfo["head_type_id"];
die();*/
//1=>General, 2=>Cash, 3=>Back Account, 4=>Customer, 5=>Employee, 6=>Vendors, 7=>Vehicle, 8=>Unloading
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center"><img src="../assets_ig/img/app-logo-print.png" width="200" /><br /></td>
  </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  <tr>
    <td width="12%" align="right"><code>Report:&nbsp;</code>
      </td>
    <td width="54%" align="left"><code><?php echo $MainHeadTitle;?></code></td>
    <td width="15%" align="right"><code>Print Date:&nbsp;</code><br />
      <code>&nbsp;&nbsp;Print By:&nbsp; </code></td>
    <td width="19%" align="left"><code><?php echo date("d-M-Y");?><br />
      <?php echo $objQayaduser->fullname;?></code></td>
  </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
</table>
<!--<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">-->
<?php if(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'A'){?>
            <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Date</th>
                    <th align="left">Invoice</th>
                    <th align="left">Item</th>
                    <th align="left">Vehicle</th>
					<th align="left">Area</th>
					<th align="left">Qty</th>
                   	<th align="left">Rate</th>
                    <th align="left">Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
				  $TotalQuantity = 0;
				  $ItemPrice = 0;
				  $TotalSumPrice = 0;
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehcil = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					if($_GET["sd"] != ''){
					$objSSSjatlan->setProperty("DATEFILTER", 'YES');
					$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if(trim(DecData($_GET["bvd"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vendor_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["bve"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vehicle_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["ba"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("destination_id", $Return_by_area);
					}
					if(trim(DecData($_GET["bi"], 1, $objBF)) != ""){
					$objSSSjatlan->setProperty("d_invoice_no", $Return_by_invoice);
					}
					$objSSSjatlan->setProperty("order_request_type", 2);
					$objSSSjatlan->setProperty("order_process_status", 1);
					//$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderRequest["vendor_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							//$objSSSVehcil
							
							$objSSSVehcil->resetProperty();
							$objSSSVehcil->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehcil->lstVehicle();
							$VehicleInformation = $objSSSVehcil->dbFetchArray(1);
							//
							$TotalQuantity += $OrderRequest["no_of_items"];
				  $ItemPrice += $OrderRequest["per_item_amount"];
				  
				  $TotalSumPrice += $OrderRequest["no_of_items"] * $OrderRequest["per_item_amount"];
                    ?>
                  <tr>
                    <td><?php echo dateFormate_4($OrderRequest["d_date"]);?></td>
                    <td><?php echo $OrderRequest["d_invoice_no"];?></td>
                    <td><?php echo $ProductInfo["product_name"];?></td>
                    <td><?php echo $VehicleInformation["vehicle_number"];?></td>
					  <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo RsAmount($OrderRequest["per_item_amount"]);?></td>
                    <td><?php echo RsAmount($OrderRequest["no_of_items"] * $OrderRequest["per_item_amount"]);?></td>
                    </tr>
                  <?php } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th align="left"><?php echo $TotalQuantity;?></th>
                    <th align="left"><?php echo RsAmount($ItemPrice);?></th>
                    <th align="left"><?php echo RsAmount($TotalSumPrice);?></th>
                    </tr>
                    </tfoot>
              </table>
              <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'B'){?>
              <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Date</th>
                    <th align="left">Customer</th>
					<th align="left">Address</th>
                    <th align="left">Vehicle</th>
                    <th align="left">Area</th>
					<th align="left">Qty</th>
                   	<th align="left">Rate</th>
                    <th align="left">L Char</th>
                    <th align="left">Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
				  $TotalQuantity = 0;
				  $ItemPrice = 0;
				  $D_Char = 0;
				  $L_Char = 0;
				  $TotalSumPrice = 0;
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehcil = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					if($_GET["sd"] != ''){
					$objSSSjatlan->setProperty("DATEFILTER", 'YES');
					$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
	
					if(trim(DecData($_GET["bc"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("customer_id", $Return_by_customer);
					}
					if(trim(DecData($_GET["bve"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vehicle_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["ba"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("destination_id", $Return_by_area);
					}
					if(trim(DecData($_GET["bi"], 1, $objBF)) != ""){
					$objSSSjatlan->setProperty("d_invoice_no", $Return_by_invoice);
					}
					$objSSSjatlan->setProperty("order_request_type", 1);
					$objSSSjatlan->setProperty("order_process_status", 1);
					//$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderRequest["customer_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							//$objSSSVehcil
							
							$objSSSVehcil->resetProperty();
							$objSSSVehcil->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehcil->lstVehicle();
							$VehicleInformation = $objSSSVehcil->dbFetchArray(1);
							//
							$TotalQuantity += $OrderRequest["no_of_items"];
				  $ItemPrice += $OrderRequest["per_item_amount"];
				  
				  $D_Char += $OrderRequest["delivery_chagres"];
				  $L_Char += $OrderRequest["unloading_price"];
				  
				  $TotalSumPrice += $OrderRequest["final_amount"];
                    ?>
                  <tr>
                    <td align="left"><?php echo dateFormate_3($OrderRequest["d_date"]);?></td>
                    <td align="left"><?php echo $CustomerInfo["customer_name"];?></td>
					<td align="left"><?php echo $CustomerInfo["customer_address"];?></td>
                   <td align="left"><?php echo $VehicleInformation["vehicle_number"];?></td>
                    <td align="left"><?php echo $DestinationInfo["location_name"];?></td>
                    <td align="left"><?php echo $OrderRequest["no_of_items"];?></td>
                    <td align="left"><?php echo RsAmount($OrderRequest["per_item_amount"]);?></td>
                    <td align="left"><?php echo RsAmount($OrderRequest["unloading_price"]);?></td>
                    <td align="left"><?php echo RsAmount($OrderRequest["final_amount"]);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th align="left"></th>
                    <th align="left"></th>
                    <th align="left"></th>
                    <th align="left"></th>
                    <th align="left"><?php echo $TotalQuantity;?></th>
                    <th align="left"><?php echo RsAmount($ItemPrice);?></th>
                    <th align="left"><?php echo RsAmount($L_Char);?></th>
                    <th align="left"><?php echo RsAmount($TotalSumPrice);?></th>
                  </tr>
                </tfoot>
</table>
               <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'C'){?>
               <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                 <thead>
                  <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Qty</th>
					<th>Purchasing<br />
						Rate + L-Char + D-Char</th>
                   	<th>Selling Rate</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
				  $TotalQuantity = 0;
				  $TotalSumPrice = 0;
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSSellingDetail = new SSSjatlan;
					
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					if($_GET["sd"] != ''){
					$objSSSjatlan->setProperty("DATEFILTER", 'YES');
					$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if(trim(DecData($_GET["bc"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("customer_id", $Return_by_customer);
					}
					if(trim(DecData($_GET["bve"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vehicle_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["ba"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("destination_id", $Return_by_area);
					}
					if(trim(DecData($_GET["bi"], 1, $objBF)) != ""){
					$objSSSjatlan->setProperty("d_invoice_no", $Return_by_invoice);
					}
					$objSSSjatlan->setProperty("order_request_type", 1);
					$objSSSjatlan->setProperty("order_process_status", 1);
					//$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderRequest["customer_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							//$objSSSSellingDetail
							
							$objSSSSellingDetail->resetProperty();
							$objSSSSellingDetail->setProperty("order_request_id", $OrderRequest["purchase_id"]);
							$objSSSSellingDetail->lstOrderRequestDetail();
							$SellingDetail = $objSSSSellingDetail->dbFetchArray(1);
							
							//
							
				  $ItemPrice += $OrderRequest["per_item_amount"];
				  
				  $D_Char += $OrderRequest["delivery_chagres"];
				  $L_Char += $OrderRequest["unloading_price"];
				  
				 // $TotalSumPrice += $OrderRequest["final_amount"];
				  if($OrderRequest["purchase_id"] != ''){
					  $TotalQuantity += $OrderRequest["no_of_items"];
                    ?>
                  <tr>
                    <td><?php echo dateFormate_3($OrderRequest["d_date"]);?></td>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                   <td><?php echo $ProductInfo["product_name"];?></td>
                   <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php 
					echo '<small>'.$SellingDetail["per_item_amount"] . ' + ' . $OrderRequest["unloading_price"]  .' + '. $SellingDetail["delivery_chagres"] / $SellingDetail["no_of_items"].'</small>&nbsp;&nbsp;<code>'.$SellingDetail["no_of_items"].'</code><br>';
				
					//$TotalSum = $SellingDetail["final_amount"] + $SellingDetail["delivery_chagres"] + $OrderRequest["unloading_price"] * $SellingDetail["no_of_items"];
					$DeliveryChagresSellingOrder =  $SellingDetail["delivery_chagres"] / $SellingDetail["no_of_items"];
					$TotalSum = $SellingDetail["per_item_amount"] + $DeliveryChagresSellingOrder + $OrderRequest["unloading_price"];
					//$PerItemCost = $TotalSum / $SellingDetail["no_of_items"];
					$PerItemCost = $TotalSum;
					echo RsAmount($PerItemCost);?></td>
                    
                    <td><?php echo RsAmount($OrderRequest["per_item_amount"]);?></td>
                    <td><?php //echo RsAmount($OrderRequest["final_amount"]);
					$DiffSellBuy = $OrderRequest["per_item_amount"] - $PerItemCost;
					$FinalDffPRice = $DiffSellBuy * $OrderRequest["no_of_items"];
					echo RsAmount($FinalDffPRice);
					$TotalSumPrice += $FinalDffPRice;
					?></td>
                    </tr>
                  <?php } } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th></th>
                    <th></th>
                    <th align="right">Total Qty</th>
                    <th><?php echo $TotalQuantity;?></th>
                    <th><?php //echo $TotalQuantity;?></th>
                    <th align="right">Total Amount</th>
                    <th><?php echo RsAmount($TotalSumPrice);?></th>
                  </tr>
                    </tfoot>
</table>
              <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'E'){?>
              <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Customer</th>
                    <th align="left">Location</th>
                    <th align="left">Type</th>
                    <th align="left">Debit</th>
					<th align="left">Credit</th>
                   	<th align="left">Balance</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
				  $TotalCredit=0;
				  $TotalDebit=0;
				  $TotalQuantity = 0;
				  $ItemPrice = 0;
				  $TotalSumPrice = 0;
					$objSSSjatlanLocation = new SSSjatlan;
					$objSSSjatlanCategory = new SSSjatlan;
					$objSSSCounterCustomerOrder = new SSSjatlan;
					$objSSSOrderAmountSUM = new SSSjatlan;
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("ORDERBY", 'customer_name');
					$objSSSjatlan->setProperty("customer_type", 1);
					if($Return_by_customer_type != 0){
					$objSSSjatlan->setProperty("customer_category", $Return_by_customer_type);	
					}
					if($Return_by_customer != 0){
					$objSSSjatlan->setProperty("customer_id", $Return_by_customer);	
					}
					if($Return_by_location != 0){
					$objSSSjatlan->setProperty("location_id", $Return_by_location);	
					}
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->lstCustomers();
					while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
						
						$objSSSjatlanCategory->resetProperty();
						$objSSSjatlanCategory->setProperty("category_id", $CustomerList["customer_category"]);
						$objSSSjatlanCategory->lstCustomerCategory();
						$GetCustomerCategory = $objSSSjatlanCategory->dbFetchArray(1);
						
						$objSSSjatlanLocation->resetProperty();
						$objSSSjatlanLocation->setProperty("location_id", $CustomerList["location_id"]);
						$objSSSjatlanLocation->lstLocation();
						$GetCustomerLocation = $objSSSjatlanLocation->dbFetchArray(1);
						
							/*$objSSSCounterCustomerOrder->resetProperty();
							if($_GET["sd"] != ''){
							$objSSSCounterCustomerOrder->setProperty("DATEFILTER", 'YES');
							$objSSSCounterCustomerOrder->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
							$objSSSCounterCustomerOrder->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
							}
							$objSSSCounterCustomerOrder->setProperty("customer_id", $CustomerList["customer_id"]);
							$objSSSCounterCustomerOrder->setProperty("isActive", 1);
							$objSSSCounterCustomerOrder->setProperty("order_request_type", 1);
							$objSSSCounterCustomerOrder->setProperty("order_process_status", 1);
							$objSSSCounterCustomerOrder->lstOrderRequestDetail();
							$CustomerRequestedOrderCounter = $objSSSCounterCustomerOrder->totalRecords();*/
						
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("isActive", 1);
							if($_GET["sd"] != ''){
							$objQayadaccount->setProperty("DATEFILTER", 'YES');
							$objQayadaccount->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
							$objQayadaccount->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
							}
							$objQayadaccount->setProperty("entity_id", $CustomerList['customer_id']);
							$objQayadaccount->setProperty("head_type_id", 4);
							$objQayadaccount->OverAllAccountStatus();
							$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
							//print_r($CashHeadStatus);
							$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
							//echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
							
							$TotalCredit +=$CashHeadStatus["TotalCredit"];
				  			$TotalDebit +=$CashHeadStatus["TotaDebit"];
                    ?>
                  <tr>
                    <td><?php echo $CustomerList["customer_name"];?></td>
                    <td><?php echo $GetCustomerLocation["location_name"];?></td>
                    <td><?php echo $GetCustomerCategory["category_name"];?></td>
                    <!--<td><?php //echo $CustomerRequestedOrderCounter;?></td>-->
                    <td><?php echo Numberformt($CashHeadStatus["TotaDebit"]);?></td>
                     <td><?php echo Numberformt($CashHeadStatus["TotalCredit"]);?></td>
                    <td><?php echo Numberformt($CashHeadTotal);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th></th>
                    <th></th>
                   <th></th>
                    <th align="left"><?php echo RsAmount($TotalDebit);?></th>
                    <th align="left"><?php echo RsAmount($TotalCredit);?></th>
                    <th align="left"><?php 
					$RemainingAmount = $TotalDebit - $TotalCredit;
					echo RsAmount($RemainingAmount);?></th>
                  </tr>
                </tfoot>
</table>
              <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'G'){?>
              <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Supplier</th>
                    <th align="left">Debit</th>
					<th align="left">Credit</th>
                   	<th align="left">Balance</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
				  $TotalCredit=0;
				  $TotalDebit=0;
				  $TotalQuantity = 0;
				  $ItemPrice = 0;
				  $TotalSumPrice = 0;
					$objSSSjatlanLocation = new SSSjatlan;
					$objSSSjatlanCategory = new SSSjatlan;
					$objSSSCounterCustomerOrder = new SSSjatlan;
					$objSSSOrderAmountSUM = new SSSjatlan;
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("ORDERBY", 'customer_name');
					$objSSSjatlan->setProperty("customer_type", 2);
					if($Return_by_customer_type != 0){
					$objSSSjatlan->setProperty("customer_category", $Return_by_customer_type);	
					}
					if($Return_by_customer != 0){
					$objSSSjatlan->setProperty("customer_id", $Return_by_customer);	
					}
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->lstCustomers();
					while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
						
						/*$objSSSjatlanCategory->resetProperty();
						$objSSSjatlanCategory->setProperty("category_id", $CustomerList["customer_category"]);
						$objSSSjatlanCategory->lstCustomerCategory();
						$GetCustomerCategory = $objSSSjatlanCategory->dbFetchArray(1);
						
						$objSSSjatlanLocation->resetProperty();
						$objSSSjatlanLocation->setProperty("location_id", $CustomerList["location_id"]);
						$objSSSjatlanLocation->lstLocation();
						$GetCustomerLocation = $objSSSjatlanLocation->dbFetchArray(1);*/
						
							/*$objSSSCounterCustomerOrder->resetProperty();
							if($_GET["sd"] != ''){
							$objSSSCounterCustomerOrder->setProperty("DATEFILTER", 'YES');
							$objSSSCounterCustomerOrder->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
							$objSSSCounterCustomerOrder->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
							}
							$objSSSCounterCustomerOrder->setProperty("customer_id", $CustomerList["customer_id"]);
							$objSSSCounterCustomerOrder->setProperty("isActive", 1);
							$objSSSCounterCustomerOrder->setProperty("order_request_type", 1);
							$objSSSCounterCustomerOrder->setProperty("order_process_status", 1);
							$objSSSCounterCustomerOrder->lstOrderRequestDetail();
							$CustomerRequestedOrderCounter = $objSSSCounterCustomerOrder->totalRecords();*/
						
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("isActive", 1);
							if($_GET["sd"] != ''){
							$objQayadaccount->setProperty("DATEFILTER", 'YES');
							$objQayadaccount->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
							$objQayadaccount->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
							}
							$objQayadaccount->setProperty("entity_id", $CustomerList['customer_id']);
							$objQayadaccount->setProperty("head_type_id", 6);
							$objQayadaccount->OverAllAccountStatus();
							$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
							//print_r($CashHeadStatus);
							$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
							//echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
							$TotalCredit +=$CashHeadStatus["TotalCredit"];
				  			$TotalDebit +=$CashHeadStatus["TotaDebit"];
							
                    ?>
                  <tr>
                    <td><?php echo $CustomerList["customer_name"];?></td>
                    <!--<td><?php //echo $CustomerRequestedOrderCounter;?></td>-->
                    <td><?php echo Numberformt($CashHeadStatus["TotaDebit"]);?></td>
                     <td><?php echo Numberformt($CashHeadStatus["TotalCredit"]);?></td>
                    <td><?php echo Numberformt($CashHeadTotal);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                   <th></th>
                    <th align="left"><?php echo RsAmount($TotalDebit);?></th>
                    <th align="left"><?php echo RsAmount($TotalCredit);?></th>
                    <th align="left"><?php 
					$RemainingAmount = $TotalDebit - $TotalCredit;
					echo RsAmount($RemainingAmount);?></th>
                  </tr>
                </tfoot>
</table>
              <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'F'){?>
                      <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                          <thead>
                            <tr>
                        <th align="left">Date</th>
                        <th align="left">Txn#</th>
                        <th align="left">Particular</th>
                        <th align="left">Description</th>
                        <th align="left">Discount</th>
                        <th align="left">Other Charges</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $BalanceAmount = 0;
                            $objQayadaccountDetail = new Qayadaccount;
                            $objQayadaccountLinkHead = new Qayadaccount;
                            $objQayadaccountTHead = new Qayadaccount;
                            $objSSSLocationGet = new SSSjatlan;
							$objSSSVehicleNo = new SSSjatlan;
                            $objQayadaccountDetail->resetProperty();
                            //$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
                            //if($GetHeadInfo["head_type_id"] == 2){
                            if($_GET["sd"] != ''){
                            $objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
                            $objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
                            $objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
                            }
                            if($_GET["fo"] != '' && $Return_filter_option!=0){
                            $objQayadaccountDetail->setProperty("pay_mode", $Return_filter_option);
                            } else {
							$objQayadaccountDetail->setProperty("pay_mode_array", '9,10');	
							}
                            //
							if($_GET["bc"] != '' && $Return_by_customer!=0){
							$objQayadaccountDetail->setProperty("head_id", $Return_by_customer);
							}
                            $objQayadaccountDetail->setProperty("location_id", 1);
                            $objQayadaccountDetail->setProperty("isActive", 1);
                            $objQayadaccountDetail->setProperty("ORDERBY", 'transaction_id');
                            $objQayadaccountDetail->lstAccountTransaction();
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
                                    
                                    //if($LedgerHeadDetails["pay_mode"] != 1){
                                        if($LedgerHeadDetails["head_id"] != ''){
                                            $objQayadaccountLinkHead->resetProperty();
                                            $objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["head_id"]);
                                            $objQayadaccountLinkHead->lstHead();
                                            $TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
                                            $TransferHeadTitle = $TransferHeadDetail["head_title"];
                                        } else {
                                            $TransferHeadTitle = '';
                                        }
                                   // }
                                  
                            ?>
                          <tr>
                            <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                            <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                            <td><?php echo $TransferHeadTitle; ?></td>
                            
                            
                            <td><?php echo $LedgerHeadDetails["trans_title"] . '/'.$LedgerHeadDetails["trans_note"];?></td>
							  
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
                            <!-- <td><?php //echo Numberformt($BalanceAmount);?></td> -->
                          </tr>
                           <?php } ?>
                          
                          
                        </tbody>
        </table>
              <?php } ?>


































<script type="text/javascript">window.print();</script>