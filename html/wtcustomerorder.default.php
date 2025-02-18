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
                  <th>Order #</th>
                  	<th>Order Date</th>
                    <th>Customer</th>
                    
                    <th>Item</th>
                    <th>Destination</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>D/Charges</th>
                    <th>U/Charges</th>
                    <th>Final Amount</th>
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
					$objSSSjatlan->setProperty("order_request_id", $GetOrderRequest["order_request_id"]);
          $objSSSjatlan->lstOrderRequestDetail();
          $OrderRequest = $objSSSjatlan->dbFetchArray(1);
						
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
                  <td><?php echo $OrderRequest["tran_code"];?></td>
                  <td><?php echo dateFormate_4($OrderRequest["entery_date"]);?></td>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                    <td><?php echo $ProductInfo["product_name"];?></td>
                    <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo $OrderRequest["per_item_amount"];?></td>
                    <td><?php echo $OrderRequest["delivery_chagres"];?></td>
                    <td><?php echo $OrderRequest["unloading_price"];?></td>
                    <td><?php echo $OrderRequest["final_amount"];?></td>
                    
                    
                    
                   
                  </tr>
                </tbody>
              </table>
              <input type="hidden" value="<?php echo $GetOrderCenterArea["order_center_id"];?>" name="order_center_id">
				<input type="hidden" value="<?php echo $GetOrderCenterArea["order_tran_id"];?>" name="order_tran_id">	
				<input type="hidden" value="<?php echo $GetOrderCenterArea["unloader_tran_id"];?>" name="unloader_tran_id">
        <input type="hidden" value="<?php echo $GetOrderCenterArea["unloader_option"];?>" name="unloading_option">
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
              <label class="col-sm-2 label-on-left">Unloading Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'unloading_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control calculate_item_price calculate_item_price_mod" type="text" min="0" name="unloading_price" id="unloading_price" value="<?php echo $OrderRequest["unloading_price"];?>" tabindex="8" />
                  <small><?php echo $vResult["unloading_price"];?></small> </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'unloading_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control calculate_item_price calculate_item_price_mod" id="delivery_chagres" type="text" min="0" name="delivery_chagres" value="<?php echo $OrderRequest["delivery_chagres"];?>" tabindex="8" />
                  <small><?php echo $vResult["unloading_price"];?></small> </div>
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

            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="2">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
			<?php } else { ?>
			<form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			  <input type="hidden" name="area" value="search">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Search Customer Order';?></h4>
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