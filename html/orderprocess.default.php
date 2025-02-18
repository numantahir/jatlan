<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Customer Order Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=orderprocessform');?>" class="btn btn-primary">Create Order</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Order#</th>
                    <th>Vechile#</th>
                    <th>No. of Items</th>
                    <th>Create Date</th>
                    <th>Delivery Date</th>
                    <th>Amount</th>
                    <th>Order Status</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehicleType = new SSSjatlan;
					
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrders();
                    while($OrderProcess = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("vehicle_id", $OrderProcess["vechile_id"]);
							$objSSSCustomers->lstVehicle();
							$VehicleNumber = $objSSSCustomers->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
						
                    ?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=orderprocessform&oi='.EncData($OrderProcess["order_id"], 2, $objBF));?>"><?php echo $OrderProcess["order_no"];?></a></td>
                    <td><?php echo $VehicleNumber["vehicle_number"];?></td>
                    <td><?php echo $OrderProcess["total_quantity_order"];?></td>
                     <td><?php echo dateFormate_4($OrderProcess["create_date"]);?></td>
                     <td><?php echo dateFormate_4($OrderProcess["deliver_date"]);?></td>
                    <td><?php echo RsAmount($OrderProcess["total_order_cost"]);?></td>
                    <td><?php echo OrderProcessingStatus($OrderRequest["order_status"]);?></td>
                    
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