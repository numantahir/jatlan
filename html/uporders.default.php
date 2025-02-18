<div class="content">
<div class="container-fluid">
  <div class="row">
    <?php if($_GET["i"]==''){?>
    <div class="col-md-12">
      <h3 class="card-title CardWidth">Under Process Orders Management</h3>
      <div class="toolbar add-btn text-right mt-50px"> </div>
      <div class="card">
        <div class="card-content">
          <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
              <thead>
                <tr>
                  <th>Order#</th>
                  <th>Vechile#</th>
                  <th>Driver</th>
                  <th>No. of Items</th>
                  <th>Create Date</th>
                  <th>Amount</th>
                  <th>Order Status</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>
                <?php
					
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehicleType = new SSSjatlan;
					$objSSSOrderCounter = new SSSjatlan;
					
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_status", 2);
                    $objSSSjatlan->lstOrders();
                    while($OrderProcess = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("vehicle_id", $OrderProcess["vechile_id"]);
							$objSSSCustomers->lstVehicle();
							$VehicleNumber = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSVehicleType->resetProperty();
							$objSSSVehicleType->setProperty("driver_id", $OrderProcess["driver_id"]);
							$objSSSVehicleType->setProperty("isActive", 1);
							$objSSSVehicleType->lstVehicleAssignDriver();
							$DriverDetail = $objSSSVehicleType->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							$objSSSOrderCounter->resetProperty();
							$objSSSOrderCounter->setProperty("order_id", $OrderProcess["order_id"]);
							$objSSSOrderCounter->setProperty("isActive", 1);
							$objSSSOrderCounter->setProperty("order_status", 2);
							$objSSSOrderCounter->lstOrderDetail();
							$TotalNoOfOrders = $objSSSOrderCounter->totalRecords();
							//
						
                    ?>
                <tr>
                  <td><a href="<?php echo Route::_('show=uporders&i='.EncData($OrderProcess["order_id"], 2, $objBF));?>"><?php echo $OrderProcess["order_no"];?></a></td>
                  <td><?php echo $VehicleNumber["vehicle_number"];?></td>
                  <td><?php echo $DriverDetail["user_fname"].' '.$DriverDetail["user_lname"];?></td>
                  <td><?php echo '('.$TotalNoOfOrders.') '.$OrderProcess["total_quantity_order"];?></td>
                  <td><?php echo dateFormate_4($OrderProcess["create_date"]);?></td>
                  <td><?php echo RsAmount($OrderProcess["total_order_sell_cost"]);?></td>
                  <td><?php echo OrderProcessingStatus($OrderProcess["order_status"]);?></td>
                  <td><a href="<?php echo Route::_('show=uporders&i='.EncData($OrderProcess["order_id"], 2, $objBF));?>">View</a></td>
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
    <?php } else { ?>
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-text" data-background-color="rose">
          <h4 class="card-title"><?php echo 'Order Detail of &nbsp; <code>'.$OrderProcess["order_no"].'</code>';?></h4>
        </div>
        <br />
        <br />
        <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
          <thead>
            <tr>
              <th>Order#</th>
              <th>Vechile#</th>
              <th>Driver</th>
              <th>No. of Items</th>
              <th>Create Date</th>
              <th>Amount</th>
              <th>Order Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $OrderProcess["order_no"];?></td>
              <td><?php echo $VehicleNumber["vehicle_number"];?></td>
              <td><?php echo $DriverDetail["user_fname"].' '.$DriverDetail["user_lname"];?></td>
              <td><?php echo '('.$TotalNoOfOrders.') '.$OrderProcess["total_quantity_order"];?></td>
              <td><?php echo dateFormate_4($OrderProcess["create_date"]);?></td>
              <td><?php echo RsAmount($OrderProcess["total_order_sell_cost"]);?></td>
              <td><?php echo OrderProcessingStatus($OrderProcess["order_status"]);?></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="card">
        <div class="card-header card-header-text" data-background-color="rose">
          <h4 class="card-title"><?php echo 'Order Items List';?></h4>
        </div>
        <br />
        <br />
        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
          <thead>
            <tr>
              <th>Customer</th>
              <th>Item</th>
              <th>Destination</th>
              <th>Quantity</th>
              <th>Request D/Date</th>
              <th>Total Amount</th>
              <th>D/Amount</th>
              <th>UL/Amount</th>
              <th>SWAP</th>
            </tr>
          </thead>
          <tbody>
            <?php
					
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSProductPrice = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("order_id", $RequestedOrderId);
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_status", 2);
                    $objSSSjatlan->lstOrderDetail();
                    while($OrderDetailLsit = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderDetailLsit["customer_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderDetailLsit["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderDetailLsit["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
						
							$objSSSProductPrice->resetProperty();
							$objSSSProductPrice->setProperty("product_price_id", $OrderDetailLsit["product_price_id"]);
							$objSSSProductPrice->lstProductPrice();
							$ProductPriceDetail = $objSSSProductPrice->dbFetchArray(1);
                    ?>
            <tr>
              <td><?php echo $CustomerInfo["customer_name"];?></td>
              <td><?php echo $ProductInfo["product_name"].' ('.$ProductInfo["product_size"].')';?></td>
              <td><?php echo $DestinationInfo["location_name"];?></td>
              <td><?php echo $OrderDetailLsit["order_qty"];?></td>
              <td><?php 
					if($OrderDetailLsit["delivery_required_date"] != ''){
					echo dateFormate_3($OrderDetailLsit["delivery_required_date"]);} else { echo 'Null';}?></td>
              <td><?php echo RsAmount($OrderDetailLsit["selling_price"]);?></td>
              <td><?php echo RsAmount($OrderDetailLsit["freight_price"]);?></td>
              <td><?php echo RsAmount($OrderDetailLsit["unloading_price"]);?></td>
              <td><a href="<?php echo Route::_('show=uporderswap&i='.EncData($OrderDetailLsit["order_id"], 2, $objBF).'&odi='.EncData($OrderDetailLsit["order_detail_id"], 2, $objBF));?>">SWAP</a></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <div class="card">
        <div class="card-footer text-center col-md-12"> 
        <a href="<?php echo Route::_('show=upodeliverd&i='.EncData($RequestedOrderId, 2, $objBF));?>" class="btn btn-rose btn-fill">Order Deliverd</a> &nbsp; | &nbsp; <a href="<?php echo Route::_('show=cvehicle&i='.EncData($RequestedOrderId, 2, $objBF));?>" class="btn btn-rose btn-fill">Change Vehicle</a><hr />
        <a href="<?php echo Route::_('show=uporders&i='.EncData($RequestedOrderId, 2, $objBF).'&rq='.EncData('cancel', 2, $objBF).'&odn='.EncData($OrderProcess["order_no"], 2, $objBF));?>" class="btn btn-fill cancel">Order Cancel Complete</a> 
        
        </div>
      </div>
      <?php } ?>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
