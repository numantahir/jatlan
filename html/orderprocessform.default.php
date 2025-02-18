<div class="content">
  <div class="container-fluid">
    <div class="row">
    <?php if($_GET["oi"]==''){?>
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_id" value="<?php echo $objBF->encrypt($order_id, ENCRYPTION_KEY);?>">
            
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Create New Order';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=orderrequest');?>" class="btn">Back</a> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Select Vehicle</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" required name="vechile_id" id="op_vehicle_selection" title="Select Vehicle" tabindex="1">
                        <?php echo $objSSSjatlan->VehicleOrderProcessCombo($vechile_id);?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Number</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_number" id="op_number" value="<?php echo $no_of_items;?>" tabindex="2" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Name</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_name" id="op_name" value="<?php echo $no_of_items;?>" tabindex="3" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Type</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_type" id="op_type" value="<?php echo $no_of_items;?>" tabindex="4" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Capacity</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_capacity" id="op_capacity" value="<?php echo $no_of_items;?>" tabindex="5" />
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 label-on-left">Source</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_source" id="op_source" value="<?php echo $no_of_items;?>" tabindex="7" />
                    </div>
                  </div>
                </div>
                <hr />
                <div class="row">
                  <label class="col-sm-2 label-on-left">Order Remarks</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="order_remarks" value="<?php echo $order_remarks;?>" tabindex="8" />
                    </div>
                  </div>
                </div>
                
                <div class="row">
                  <label class="col-sm-2 label-on-left">Status</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="9">
                        <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                        <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center col-md-12">
                  <button type="submit" class="btn btn-rose btn-fill" tabindex="10">Create & Next</button>
                  <button type="reset" class="btn btn-fill">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php } else { ?>
      <div class="col-md-12">
        <div class="card">
         <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Final Step';?></h4>
             
            </div> <div class="toolbar btn-back text-right"> <a class="btn btn-danger btn-fill cancel" href="<?php echo Route::_('show=orderprocessform&oi='.EncData($OrderDetail["order_id"], 2, $objBF).'&od='.EncData('canceled', 2, $objBF));?>">Remove Order</a> </div><br /><br />
          <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Order#</th>
                    <th>Vechile#</th>
                    <th>Driver</th>
                    <th>Capacity</th>
                    <th>Create Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                
                <tbody>
                  <tr>
                    <td><?php echo $OrderDetail["order_no"];?></td>
                    <td><?php echo $VehicleDetail["vehicle_number"];?></td>
                    <td><?php echo $VehicleDetail["fullname"];?></td>
                    <td><?php echo $VehicleDetail["loading_capacity"];?></td>
                     <td><?php echo dateFormate_9($OrderDetail["create_date"]);?></td>
                    <td><?php echo OrderProcessingStatus($OrderDetail["order_status"]);?></td>
                    
                  </tr>
                </tbody>
              </table>
        </div>
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_id" value="<?php echo $objBF->encrypt($OrderDetail["order_id"], ENCRYPTION_KEY);?>">
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
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $CustomerInfo["location_id"]);
							$objSSSDestination->lstLocation();
							$CustomerLocationId = $objSSSDestination->dbFetchArray(1);
							
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
                    <td><?php echo $CustomerInfo["customer_name"]. ' ('.$CustomerLocationId["location_name"].')';?></td>
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
      <?php } ?>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
