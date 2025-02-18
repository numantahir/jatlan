<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_request_id" value="<?php echo $objBF->encrypt($order_request_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Customer Contra Order', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=customercontra');?>" class="btn">Back</a> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Select From Customer</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" required name="from_customer_id" title="Select From Customer" tabindex="1">
                        <?php echo $objSSSjatlan->CustomerCombo($from_customer_id);?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Select Item</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" required name="product_id" id="itemselection" title="Select Item" tabindex="2">
                        <?php 
					$objSSSjatlan->resetProperty();
					echo $objSSSjatlan->ProductCombo($product_id);?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">From Item Price <code>/Bag</code></label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'selling_price');?>">
                      <label class="control-label"></label>
                      <input class="form-control contra_calculate_item_price" type="number" min="1" name="selling_price" id="selling_price" required value="<?php echo $selling_price;?>" tabindex="3" />
                      <small><?php echo $vResult["selling_price"];?></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Quantity</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'no_of_items');?>">
                      <label class="control-label"></label>
                      <input class="form-control contra_calculate_item_price item_no_of_item" type="number" min="1" name="no_of_items" required value="<?php echo $no_of_items;?>" tabindex="4" />
                      <small><?php echo $vResult["no_of_items"];?></small> </div>
                  </div>
                </div>
                <hr />
                <div class="row">
                  <label class="col-sm-2 label-on-left">Select To Customer</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" required name="to_customer_id" title="Select To Customer" tabindex="5">
                        <?php echo $objSSSjatlan->CustomerCombo($to_customer_id);?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">To Item Price <code>/Bag</code></label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'selling_price');?>">
                      <label class="control-label"></label>
                      <input class="form-control contra_calculate_item_price" type="number" min="1" name="to_selling_price" id="to_selling_price" required value="<?php echo $selling_price;?>" tabindex="6" />
                      <small><?php echo $vResult["selling_price"];?></small> </div>
                  </div>
                </div>
                <hr />
                <div class="row">
                  <label class="col-sm-2 label-on-left">Destination</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" data-live-search="true" data-size="5" required name="destination_id" title="Select Destination" tabindex="7">
                        <?php 
					$objSSSjatlan->resetProperty();
					echo $objSSSjatlan->DestinationCombo($destination_id);?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Vehicle</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'selling_price');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="vehicle_id" value="<?php echo $vehicle_id;?>" tabindex="8" />
                      <small><?php echo $vResult["selling_price"];?></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Delivery Charges</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'delivery_chagres');?>">
                      <label class="control-label"></label>
                      <input class="form-control contra_calculate_item_price" type="text" min="0" name="delivery_chagres" id="delivery_chagres" value="0" tabindex="9" />
                      <small></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Unloading Charges</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'unloading_price');?>">
                      <label class="control-label"></label>
                      <input class="form-control contra_calculate_item_price" type="text" min="0" name="unloading_price" id="unloading_price" value="0" tabindex="10" />
                      <small><?php echo $vResult["unloading_price"];?></small> </div>
                  </div>
                </div>
                <hr />
                <div class="row">
                  <label class="col-sm-2 label-on-left">From Final Amount</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="final_amount" id="final_amount" value="" readonly="readonly" tabindex="11" />
                      <small><code>Note: This final amount base on Item Price + Unloading Charges + Delivery Charges.</code></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">To Final Amount</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="to_final_amount" id="to_final_amount" value="" readonly="readonly" tabindex="12" />
                      <small><code>Note: This final amount base on Item Price + Unloading Charges + Delivery Charges.</code></small> </div>
                  </div>
                </div>
                
                
                <div class="row">
                  <label class="col-sm-2 label-on-left">Date</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="date" required name="d_date" value="<?php echo date("Y-m-d");?>" tabindex="13" />
                       </div>
                  </div>
                </div>
                
                
                <div class="row">
                  <label class="col-sm-2 label-on-left">Status</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="14">
                        <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                        <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center col-md-12">
                  <button type="submit" class="btn btn-rose btn-fill" tabindex="14">Submit</button>
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
