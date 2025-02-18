<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="ST-1">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Add New Employee Attendance</h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=attendance');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'att_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="att_date" required tabindex="1" />
                  <small><?php echo $vResult["holiday_sd"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Employee</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="employee_id" required title="List of All Employee" tabindex="2">
                    <?php $objQayaduser->resetProperty(); echo $objQayaduser->EmployeeComboDeviceId();?>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Device</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="device_id" required title="List of All Devices" tabindex="3">
                    <?php $objQayaddevice->resetProperty(); echo $objQayaddevice->EmployeeAttendanceCombo();?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Attendance In Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'att_in');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="att_in" required tabindex="4" value="<?php echo $AttendanceDetail["att_in"];?>" />
                  <small><?php echo $vResult["att_in"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Attendance Out Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'att_out');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="att_out" tabindex="5" value="<?php echo $AttendanceDetail["att_out"];?>" />
                  <small><?php echo $vResult["att_out"];?></small> </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>