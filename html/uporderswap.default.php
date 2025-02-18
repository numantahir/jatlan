<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
         <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'SWAP Order Item';?></h4>
            </div><br /><br />
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
                  </tr>
                </thead>
                
                <tbody>
                  <tr>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                    <td><?php echo $ProductInfo["product_name"].' ('.$ProductInfo["product_size"].')';?></td>
                    <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderDetailInfo["order_qty"];?></td>
                    <td><?php 
					if($OrderDetailInfo["delivery_required_date"] != ''){
					echo dateFormate_3($OrderDetailInfo["delivery_required_date"]);} else { echo 'Null';}?></td>
                    <td><?php echo RsAmount($OrderDetailInfo["selling_price"]);?></td>
                    <td><?php echo RsAmount($OrderDetailInfo["freight_price"]);?></td>
                    <td><?php echo RsAmount($OrderDetailInfo["unloading_price"]);?></td>
                    <td>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_id" value="<?php echo $objBF->encrypt($OrderProcess["order_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="order_detail_id" value="<?php echo $objBF->encrypt($OrderDetailInfo["order_detail_id"], ENCRYPTION_KEY);?>">
             <input type="hidden" name="roi" value="<?php echo $objBF->encrypt($OrderDetailInfo["request_order_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="t_cap" id="t_cap" value="<?php echo $VehicleDetail["loading_capacity"];?>" />
            <input type="hidden" name="on" value="<?php echo $OrderDetail["order_no"];?>" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Select Requested Order';?></h4>
            </div>
            
            <div class="col-md-12" id="overcaperror" style="background-color:#9F0004;padding-top: 10px;margin-top: 15px;font-size: 15px;text-align: center;color: #fff; display:none;"><p>Oops...! Your selected order item quantity is more than Vehicle Capacity.</p></div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
               
               
               
               <br />
               <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>&nbsp;</th>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Destination</th>
                    <th>Quantity</th>
                    <th>Created Date</th>
                    <th>Delivery Date</th>
                    <th>Total Amount</th>
                    <th>D/Amount</th>
                    <th>UL/Amount</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSProductPrice = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_process_status", 1);
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
						
							$objSSSProductPrice->resetProperty();
							$objSSSProductPrice->setProperty("product_price_id", $OrderRequest["product_price_id"]);
							$objSSSProductPrice->lstProductPrice();
							$ProductPriceDetail = $objSSSProductPrice->dbFetchArray(1);
                    ?>
                  <tr>
                  <td><input type="checkbox" class="order_rq_c" data-capacity="<?php echo $OrderRequest["no_of_items"];?>" name="order_request_id[]" required value="<?php echo $OrderRequest["order_request_id"];?>">
                  </td>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                    <td><?php echo $ProductInfo["product_name"].' ('.$ProductInfo["product_size"].')';?></td>
                    <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php 
					if($OrderRequest["entery_date"] != ''){
					echo dateFormate_4($OrderRequest["entery_date"]);} else { echo 'Null';}?></td>
                    <td><?php 
					if($OrderRequest["delivery_required_date"] != ''){
					echo dateFormate_3($OrderRequest["delivery_required_date"]);} else { echo 'Null';}?></td>
                    <td><?php echo RsAmount($ProductPriceDetail["selling_price"] * $OrderRequest["no_of_items"]);?></td>
                    <td><?php echo RsAmount($OrderRequest["delivery_chagres"] * $OrderRequest["no_of_items"]);?></td>
                    <td><?php echo RsAmount($OrderRequest["unloading_price"] * $OrderRequest["no_of_items"]);?></td>
                    <td>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
               
               
                <div class="card-footer text-center col-md-12">
                  <button type="submit" class="btn btn-rose btn-fill" tabindex="10">Create & Process Order</button>
                  <button type="reset" class="btn btn-fill">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
