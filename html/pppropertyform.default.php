<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="project_id" value="<?php echo EncData($GetProjectDetail["project_id"], 1, $objBF);?>">
            <input type="hidden" name="floor_id" value="<?php echo EncData($GetFloorDetail["propety_floor_id"], 1, $objBF);?>">
            <input type="hidden" name="floor_payment_id" value="<?php echo EncData($floor_payment_id, 1, $objBF);?>">
            
            <input type="hidden" name="project_name" value="<?php echo $GetProjectDetail["project_id"];?>">
            <input type="hidden" name="floor_name" value="<?php echo $GetFloorDetail["floor_id"];?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Payment Plan of ('.$GetProjectDetail["project_name"].' >> '.$GetFloorDetail["floor_name"].')', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=ppproperties&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&fi='.EncData(trim(DecData($_GET["fi"], 1, $objBF)), 2, $objBF));?>" class="btn">Back</a> </div>
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
            <div class="row">
              <label class="col-sm-2 label-on-left">Payback Amount Cutting Mode</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="payback_cutting" id="payback_cutting" title="Choose option" tabindex="4">
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
                  <input class="form-control" type="number" name="pb_cutting_value" value="<?php echo $pb_cutting_value;?>" tabindex="5" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Ownership Transfer Fee</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="unit_transfer_fee" value="<?php echo $unit_transfer_fee;?>" tabindex="6" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Registration Process Fee</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="registration_fee" value="<?php echo $registration_fee;?>" tabindex="7" />
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
