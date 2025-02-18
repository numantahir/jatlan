<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_request_id" value="<?php echo $objBF->encrypt($order_request_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Outside Order', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=outsideorder');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Quantity</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'no_of_items');?>">
                  <label class="control-label"></label>
                  <input class="form-control outside_order_qty item_no_of_item" type="number" min="1" name="no_of_items" required value="<?php echo $no_of_items;?>" tabindex="1" />
                  <small><?php echo $vResult["no_of_items"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Destination</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" data-live-search="true" data-size="5" required name="destination_id" title="Select Destination" tabindex="2">
                    <?php 
					$objSSSjatlan->resetProperty();
					echo $objSSSjatlan->DestinationCombo(15);?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
                  <label class="col-sm-2 label-on-left">Vehicle</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" required name="vechile_id" title="Select Vehicle" tabindex="3">
                        <?php echo $objSSSjatlan->VehicleOrderProcessCombo($vechile_id);?>
                      </select>
                    </div>
                  </div>
                </div>
             
             
             
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Charges <code>/B/I</code></label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'delivery_chagres');?>">
                  <label class="control-label"></label>
                  <input class="form-control outside_order_qty" type="text" min="0" name="delivery_chagres" id="delivery_chagres" value="0" tabindex="4" />
                  <small></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Final Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="final_amount" id="final_amount" value="" readonly="readonly" tabindex="5" />
                  <small><code>Note: This final amount base on Item Price + Unloading Charges + Delivery Charges.</code></small> </div>
              </div>
            </div>
            
            
            <hr />
				
			
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'unloading_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" required="required" name="d_date" tabindex="6" />
                  <small><?php echo $vResult["d_date"];?></small> </div>
              </div>
            </div>
            
            <hr />
            <div class="row">
              <label class="col-sm-2 label-on-left">Note:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'extra_note');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="extra_note" value="<?php echo $extra_note;?>" tabindex="7" />
                  <small><?php echo $vResult["extra_note"];?></small> </div>
              </div>
            </div>
            <hr />
			<h4>Finance Transaction Section</h4>	
				
				
				<hr>
				  <div class="row">
    <label class="col-sm-2 label-on-left">Payment Mode:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
        <select class="selectpicker" data-style="select-with-transition" name="pay_mode" id="pay_mode" title="List of Payment Mode" tabindex="8">
          <option value="1" selected>Cash</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row">
    <label class="col-sm-2 label-on-left">Transfer To:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
        <select class="selectpicker" data-style="select-with-transition" name="transfer_head_id" id="transfer_head_id" title="List of Transfer Head's" required tabindex="9">
          <?php
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 2);
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                    ?>
          <option selected value="<?php echo EncData($AccountHeadList["head_id"], 1, $objBF);?>"> <?php echo $AccountHeadList["head_code"] . ' - ' . $AccountHeadList["head_title"] . ' ';?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>	
				
				
				
  <div class="row">
    <label class="col-sm-2 label-on-left">Title:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_title');?>">
        <label class="control-label"></label>
        <input class="form-control" type="text" name="trans_title" id="trans_title" required value="Outside Trip Transaction" tabindex="10" />
        <small><?php echo $vResult["trans_title"];?></small> </div>
    </div>
  </div>
  <div class="row">
    <label class="col-sm-2 label-on-left">Note / Description:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_note');?>">
        <label class="control-label"></label>
        <input class="form-control" type="text" name="trans_note" value="Outside Trip Transaction" tabindex="11" />
        <small><?php echo $vResult["trans_note"];?></small> </div>
    </div>
  </div>
		
				
			<hr>	
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="12">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="13">Submit</button>
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