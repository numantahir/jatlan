<?php
$RequestOption = DecData($_GET["opt"], 1, $objBF);
if($RequestOption == 1){
	$PGTitle = 'Customer Order Process Request';
	$OrderRequestType_id = 2;	
} else {
	$PGTitle = 'Customer Order Complete Request';
	$OrderRequestType_id = 3;
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth"><?php echo $PGTitle;?></h3>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Destination</th>
                    <th>Quantity</th>
                    <th>Delivery Date</th>
                    <th>D/Status</th>
                    <th>P/Status</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_process_status", $OrderRequestType_id);
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
						
                    ?>
                  <tr>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                    <td><?php echo $ProductInfo["product_name"].' ('.$ProductInfo["product_size"].')';?></td>
                    <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo dateFormate_3($OrderRequest["delivery_required_date"]);?></td>
                    <td><?php echo OrderDeliveryStatus($OrderRequest["order_delivery_status"]);?></td>
                    <td><?php echo OrderProcessStatus($OrderRequest["order_process_status"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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