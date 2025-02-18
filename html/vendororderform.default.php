<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_request_id" value="<?php echo $objBF->encrypt($order_request_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Supplier Order', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=vendororder');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Item</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" required name="product_id" id="itemselection" title="Select Item" tabindex="2">
                    <?php 
					$objSSSjatlan->resetProperty();
					echo $objSSSjatlan->VendorProductCombo($product_id);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Item Price <code>/Bag</code></label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'selling_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control calculate_item_price" type="number" min="1" name="selling_price" id="selling_price" required value="<?php echo $selling_price;?>" tabindex="3" />
                  <small><?php echo $vResult["selling_price"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Quantity</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'no_of_items');?>">
                  <label class="control-label"></label>
                  <input class="form-control calculate_item_price item_no_of_item" type="number" min="1" name="no_of_items" required value="<?php echo $no_of_items;?>" tabindex="4" />
                  <small><?php echo $vResult["no_of_items"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Destination</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" data-live-search="true" data-size="5" required name="destination_id" title="Select Destination" tabindex="5">
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
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" required name="vechile_id" title="Select Vehicle" tabindex="6">
                        <?php echo $objSSSjatlan->VehicleOrderProcessCombo($vechile_id);?>
                      </select>
                      <small><input type="checkbox" class="transferamountfrom" name="transferamount" value="1" /> <code style="font-size:12px;">Delivery Charges direct transfer to Vehicle Ledger.</code></small>
                    </div>
                    
                  </div>
                </div>
             
             
             
             
             
             <div class="row" id="supplyorder_customer" style="display:none;">
              <label class="col-sm-2 label-on-left">Select Customer</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" name="customer_id" title="Select Customer" tabindex="1">
                    <?php echo $objSSSjatlan->CustomerCombo($customer_id);?>
                  </select>
                </div>
              </div>
            </div>
             
             
             
             
             
             
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Charges <code>/Bag</code></label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'delivery_chagres');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" min="0" name="delivery_chagres" id="delivery_chagres" value="0" tabindex="7" />
                  <small></small> </div>
              </div>
            </div>
            
            <div class="row" style="display:none;">
              <label class="col-sm-2 label-on-left">Unloading Charges <code>/Bag</code></label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'unloading_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" min="0" name="unloading_price" id="unloading_price" value="0" tabindex="8" />
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
            
            
            <hr />
            
            <div class="row">
              <label class="col-sm-2 label-on-left">COF Number</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'cof_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="cof_no" tabindex="10" />
                  <small><?php echo $vResult["cof_no"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Invoice#</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'d_invoice_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="d_invoice_no" tabindex="11" />
                  <small><?php echo $vResult["d_invoice_no"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'unloading_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" required="required" name="d_date" tabindex="12" />
                  <small><?php echo $vResult["d_date"];?></small> </div>
              </div>
            </div>
            
            <hr />
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="10">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="11">Submit</button>
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