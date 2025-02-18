<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="property_type_id" value="<?php echo $_GET["i"];?>">
            <input type="hidden" name="property_area" value="<?php echo $GetPropertyInfo["property_area"];?>">
            
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Payment Plan ('.$GetPropertyInfo["property_section"].', '.$GetPropertyInfo["floor_name"].', '.$GetPropertyInfo["property_number"].') -  [Area:'.$GetPropertyInfo["property_area"].']'.')', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=ppproperties&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt">
            <div class="row">
              <label class="col-sm-2 label-on-left">Rate / SQ-FT</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'rate_per_sq_ft');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="rate_per_sq_ft" required value="<?php echo $rate_per_sq_ft;?>" tabindex="1" />
                  <small><?php echo $vResult["rate_per_sq_ft"];?></small> </div>
              </div>
            </div>
            <div class="row" style="display:none;">
              <label class="col-sm-2 label-on-left">Discount (Down Payment)</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="dp_discount" value="<?php echo $dp_discount;?>" tabindex="2" />
                </div>
              </div>
            </div>
            <div class="row" style="display:none;">
              <label class="col-sm-2 label-on-left">Discount (Total Amount)</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="total_discount" value="<?php echo $total_discount;?>" tabindex="3" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Payback Amount Cutting Mode</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="payback_cutting" title="Choose option" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $payback_cutting);?>>% Base</option>
                    <option value="2" <?php echo StaticDDSelection(2, $payback_cutting);?>>Fix Amount</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Payback Amount Value <small>Base on cutting mode</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="pb_cutting_value" value="<?php echo $pb_cutting_value;?>" tabindex="5" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Ownership Transfer Fee</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="property_transfer_fee" value="<?php echo $property_transfer_fee;?>" tabindex="6" />
                </div>
              </div>
            </div>
            <div class="row" style="display:none;">
              <label class="col-sm-2 label-on-left">Monthly Rent <small>Per Month</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="property_rent_value" value="<?php echo $property_rent_value;?>" tabindex="7" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Choose Status" required tabindex="8">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?>>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
