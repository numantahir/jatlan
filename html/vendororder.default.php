<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Supplier Order Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=vendororderform');?>" class="btn btn-primary">Create Order</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" data-order="[[ 0, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Order#</th>
                  	<th>Order Date</th>
                    <th>Vehicle</th>
                    <th>Vendor</th>
                    <th>Item</th>
                    <th>Destination</th>
					<th>COF</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>D/Charges</th>
                    <th>U/Charges</th>
                    <th>Final Amount</th>
                    <th>Expense</th>
                    <th>Done</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehcil = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_request_type", 2);
					$objSSSjatlan->setProperty("order_process_status", 1);
					$objSSSjatlan->setProperty("order_status", 1);
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
                    ?>
                  <tr>
                  <td><?php echo $OrderRequest["tran_code"];?></td>
                  <td><?php echo dateFormate_4($OrderRequest["d_date"]);?></td>
                   <td><?php echo $VehicleInformation["vehicle_number"];?></td>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                    <td><?php echo $ProductInfo["product_name"];?></td>
                    <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderRequest["cof_no"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo $OrderRequest["per_item_amount"];?></td>
                    <td><?php echo $OrderRequest["delivery_chagres"];?></td>
                    <td><?php echo $OrderRequest["unloading_price"];?></td>
                    <td><?php echo $OrderRequest["final_amount"];?></td>
                    <td><a href="<?php echo Route::_('show=vendorexpns&i='.EncData($OrderRequest["order_request_id"], 2, $objBF));?>">Expense</a></td>
                    <td><a href="<?php echo Route::_('show=vendororderform&i='.EncData($OrderRequest["order_request_id"], 2, $objBF).'&ac='.EncData("ordercomplete", 2, $objBF));?>" class="CompleteOrder">Done</a></td>
                    
                    
                   
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