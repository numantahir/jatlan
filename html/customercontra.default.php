<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Customer Contra Order Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=customercontraform');?>" class="btn btn-primary">Request Order</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" data-order="[[ 0, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  <th>Order #</th>
                  	<th>Order Date</th>
                    <th>From Customer</th>
                    <th>To Customer</th>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>T-Rate</th>
                    <th>F-Rate</th>
                    <th>D/Charges</th>
                    <th>U/Charges</th>
                    <th>T-Final Amount</th>
                    <th>F-Final Amount</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSToCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'cc_order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_request_type", 1);
					$objSSSjatlan->setProperty("order_process_status", 1);
                    $objSSSjatlan->lstCustomerContraOrderDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderRequest["from_customer_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);

							$objSSSToCustomers->resetProperty();
							$objSSSToCustomers->setProperty("customer_id", $OrderRequest["to_customer_id"]);
							$objSSSToCustomers->lstCustomers();
							$ToCustomerInfo = $objSSSToCustomers->dbFetchArray(1);
							
													
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							/*$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);*/
						
                    ?>
                  <tr>
                  <td><?php echo $OrderRequest["tran_code"];?></td>
                  <td><?php echo $OrderRequest["entery_date"];?></td>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                    <td><?php echo $ToCustomerInfo["customer_name"];?></td>
                    <td><?php echo $ProductInfo["product_name"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo $OrderRequest["per_item_amount"];?></td>
                    <td><?php echo $OrderRequest["to_per_item_amount"];?></td>
                    <td><?php echo $OrderRequest["delivery_chagres"];?></td>
                    <td><?php echo $OrderRequest["unloading_price"];?></td>
                    <td><?php echo $OrderRequest["final_amount"];?></td>
                    <td><?php echo $OrderRequest["to_final_amount"];?></td>
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