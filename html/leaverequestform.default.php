<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="location_id" value="<?php echo $LoginUserInfo["location_id"];?>">
            <input type="hidden" name="company_id" value="<?php echo $LoginUserInfo["company_id"];?>">
            <?php if(trim(DecData($_GET["rfi"], 1, $objBF)) == 1){?>
            <input type="hidden" name="department_id" value="<?php echo $LoginUserInfo["department_id"];?>">
            <?php } else { ?>
            <input type="hidden" name="department_id" value="<?php echo trim(DecData($_GET["rt"], 1, $objBF));?>" />
            <?php } ?>
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Leave Request', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=leaverequest');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Assign Yearly Leave From </label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" required name="yearly_leave_id" title="List of Yearly Leaves" tabindex="1">
                    <?php echo $objQayaduser->YearlyLeaveTypeCombo();?>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Issue</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" required name="leave_type_id" title="List of Leave Type" tabindex="1">
                    <?php echo $objQayaduser->LeaveTypeCombo();?>
                  </select>
                </div>
              </div>
            </div>
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Leave Reason</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'leave_reason');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="leave_reason" rows="8" required tabindex="2"></textarea>
                  <small><?php echo $vResult["leave_reason"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Start Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'leave_sd');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="leave_sd" required tabindex="3" />
                  <small><?php echo $vResult["leave_sd"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'leave_ed');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="leave_ed" required tabindex="4" />
                  <small><?php echo $vResult["leave_ed"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Full / Half</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" required name="leave_of" title="Leave Duration" tabindex="5">
                    <option value="1" <?php echo StaticDDSelection(1, $leave_of);?> selected>Full Day</option>
                    <option value="2" <?php echo StaticDDSelection(2, $leave_of);?>>Half Day (First Half)</option>
                    <option value="3" <?php echo StaticDDSelection(3, $leave_of);?>>Half Day (Second Half)</option>
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
