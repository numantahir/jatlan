<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'User Requested Flow Structure Modification';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=emprequestflow');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <input type="hidden" name="request_flow_id" value="<?php echo $objBF->encrypt($request_flow_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            
            <div class="row">
              <label class="col-sm-3 label-on-left">Select Employee</label>
              <div class="col-sm-8">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="employee_id" title="Select Employee">
                    <option value="0">Select Employee</option>
                    <?php echo $objQayaduser->customerCombo($employee_id);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-3 label-on-left">Leave Request Forward To</label>
              <div class="col-sm-8">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="leave_request_to" title="Select Employee">
                    <option value="0">Select Employee</option>
                    <?php echo $objQayaduser->customerCombo($leave_request_to);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-3 label-on-left">OverTime Request Forward To</label>
              <div class="col-sm-8">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="overtime_request_to" title="Select Employee">
                    <option value="0">Select Employee</option>
                    <?php echo $objQayaduser->customerCombo($overtime_request_to);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-3 label-on-left">Status</label>
              <div class="col-sm-8">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="7">Submit</button>
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
