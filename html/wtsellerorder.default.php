<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php if($_GET["lod"]=="sec" && trim(DecData($_GET["tr"], 1, $objBF)) != ''){?>
			<form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			  <input type="hidden" name="area" value="act">
				<input type="hidden" name="tr" value="<?php echo trim(DecData($_GET["tr"], 1, $objBF));?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Search Customer Order';?></h4>
            </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
				<br>
			<table id="" data-order="[[ 0, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
					$objSSSjatlan->setProperty("order_request_id", $GetOrderRequest["order_request_id"]);
					$objSSSjatlan->setProperty("order_request_type", 2);
					$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    $OrderRequest = $objSSSjatlan->dbFetchArray(1);
						
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
                  <?php //} ?>
                </tbody>
              </table>
				 
              <input class="form-control" type="hidden" min="0" name="dummy_1" id="delivery_chagres" value="0" />
              <input class="form-control" type="hidden" min="0" name="dummy_2" id="unloading_price" value="0" />
        <input type="hidden" value="<?php echo $GetOrderCenterArea["order_center_id"];?>" name="order_center_id">
				<input type="hidden" value="<?php echo $GetOrderCenterArea["order_tran_id"];?>" name="order_tran_id">	
				<input type="text" value="<?php echo $GetOrderCenterArea["vechile_tran_id"];?>" name="vechile_tran_id">

        <input type="hidden" value="<?php echo $GetOrderCenterArea["transferamount_opt"];?>" name="transferamount_opt">
        <input type="hidden" value="<?php echo $GetOrderCenterArea["trans_id_vehicle_second"];?>" name="trans_id_vehicle_second">
        <input type="hidden" value="<?php echo $GetOrderCenterArea["trans_id_vehicle_one"];?>" name="trans_id_vehicle_one">


				<input type="hidden" value="<?php echo $GetOrderCenterArea["order_id"];?>" name="ord_id">

        
				<input type="hidden" class="item_no_of_item" name="no_of_items" id="no_of_items" value="<?php echo $OrderRequest["no_of_items"];?>">

				<hr>
           <div class="row">
              <label class="col-sm-2 label-on-left">Item Price <code>/Bag</code></label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'selling_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control calculate_item_price calculate_item_price_mod" type="number" min="1" name="selling_price" id="selling_price" required value="<?php echo $OrderRequest["per_item_amount"];?>" tabindex="3" />
                  <small><?php echo $vResult["selling_price"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'delivery_chagres');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" min="0" name="delivery_chagres" value="<?php echo $OrderRequest["delivery_chagres"] / $OrderRequest["no_of_items"];?>" tabindex="8" />
                  <small><?php echo $vResult["delivery_chagres"];?></small> </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 label-on-left">Final Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="final_amount" id="final_amount" value="" readonly="readonly" tabindex="9" />
                  <small><code>Note: This final amount base on Item Price + Unloading Charges + Delivery Charges.</code></small> </div>
              </div>
            </div>

				<hr>
            <div class="row">
              <label class="col-sm-2 label-on-left">COF Number</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'cof_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" value="<?php echo $GetOrderRequest["cof_no"];?>" name="cof_no" tabindex="4" />
                  <small><?php echo $vResult["cof_no"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Invoice#</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'d_invoice_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="d_invoice_no" value="<?php echo $GetOrderRequest["d_invoice_no"];?>" tabindex="5" />
                  <small><?php echo $vResult["d_invoice_no"];?></small> </div>
              </div>
            </div>
 			<div class="row">
              <label class="col-sm-2 label-on-left">Destination</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" data-live-search="true" data-size="5" required name="destination_id" title="Select Destination" tabindex="6">
                    <?php 
					$objSSSjatlan->resetProperty();
					echo $objSSSjatlan->DestinationCombo($GetOrderRequest["destination_id"]);?>
                  </select>
                </div>
              </div>
            </div>
				<hr>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="7">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
			<?php } else { ?>
			<form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			  <input type="hidden" name="area" value="search">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Search Seller Order';?></h4>
            </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <br><br><br>
            <div class="row">
              <label class="col-sm-12 label-on-center">Enter Your Order Transaction Code</label>
              <div class="col-sm-12">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'order_tran_code');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" min="1" name="order_tran_code" required value="<?php echo $order_tran_code;?>" tabindex="1" />
                  <small><?php echo $vResult["order_tran_code"];?></small> </div>
              </div>
            </div>
            

            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="2">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
			<?php } ?>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>