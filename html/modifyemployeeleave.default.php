<?php if(trim(DecData($_GET["ld"], 1, $objBF)) == ""){?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
            <input type="hidden" name="mode" value="<?php echo EncData('SecOne', 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Modify Leave Request</h4>
            </div>
            <div class="toolbar back-btn text-right"> </div>
            <div class="card-content">
            <div class="col-md-12">
              <div class="row">
                <label class="col-sm-2 label-on-left">Select Employee <small>*</small></label>
                <div class="col-sm-9">
                  <div class="form-group label-floating">
                    <select class="selectpicker" data-style="select-with-transition" name="employee_id" required title="Employee List" tabindex="3">
                      <option value="">Select Employee</option>
                      <?php echo $objQayaduser->EmployeeCombo();?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill">Submit</button>
                <button type="reset" class="btn btn-fill">Reset</button>
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
<?php } elseif(trim(DecData($_GET["ld"], 1, $objBF)) == "List" && trim(DecData($_GET["i"], 1, $objBF)) != ""){ ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Modify Employee Leave Request</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=modifyemployeeleave');?>" class="btn">Back</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Reason</th>
                    <th>Stage</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					$objQayadGetUser = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("user_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objQayaduser->setProperty("isActive_not", 3);
                    $objQayaduser->lstUserLeaveRequest();
                    while($MyLeaveRequest = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $objQayadGetUser->GetUserFullName($MyLeaveRequest["user_id"]);?></td>
                    <td><?php echo $MyLeaveRequest["leave_name"];?></td>
                    <td><?php echo $MyLeaveRequest["leave_sd"];?></td>
                    <td><?php echo $MyLeaveRequest["leave_ed"];?></td>
                    <td><?php echo LeaveOf($MyLeaveRequest["leave_of"]);?></td>
                    <td><?php echo $MyLeaveRequest["leave_reason"];?></td>
                    <td><?php echo ForwardDirectorStatus($MyLeaveRequest["forward_director"]);?></td>
                    <td><?php echo LeaveStatus($MyLeaveRequest["leave_status"]);?></td>
                    <td align="center"><a href="<?php echo Route::_('show=modifyemployeeleave&ld='.EncData("FormLoad", 2, $objBF).'&i='.EncData($MyLeaveRequest["leave_request_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
<?php } elseif(trim(DecData($_GET["ld"], 1, $objBF)) == "FormLoad" && trim(DecData($_GET["i"], 1, $objBF)) != ""){ ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
            <input type="hidden" name="mode" value="<?php echo EncData('TwoOne', 1, $objBF);?>">
            <input type="hidden" name="leave_request_id" value="<?php echo EncData($MyLeaveRequest["leave_request_id"], 1, $objBF);?>">
            <input type="hidden" name="ui" value="<?php echo $MyLeaveRequest["user_id"];?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Modify Leave Request</h4>
            </div>
            <div class="toolbar back-btn text-right"> <a href="<?php echo Route::_('show=modifyemployeeleave&ld='.EncData("List", 2, $objBF).'&i='.EncData($MyLeaveRequest["user_id"], 2, $objBF));?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12">
              
              <div class="card-content">
            <h5 class="card-title CardWidth">Employee Attendance Detail (<?php echo $objQayaduser->GetUserFullName($MyLeaveRequest["user_id"]);?>)</h5>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>IN</th>
                    <th>OUT</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
				  	$objQayaduser->resetProperty();
					$objQayadAttendance->resetProperty();
                    $objQayadAttendance->setProperty("device_uid", $objQayaduser->GetUserDeviceId($MyLeaveRequest["user_id"]));
					$objQayadAttendance->setProperty("DATEFILTER", "YES");
					$objQayadAttendance->setProperty("STARTDATE", $MyLeaveRequest["leave_sd"]);
					$objQayadAttendance->setProperty("ENDDATE", $MyLeaveRequest["leave_ed"]);
                    $objQayadAttendance->lstAttendance();
                    while($EmployeeAttendance = $objQayadAttendance->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $EmployeeAttendance["att_in"];?></td>
                    <td><?php echo $EmployeeAttendance["att_out"];?></td>
                    <td><?php echo $EmployeeAttendance["att_date"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
              <hr>
              <div class="row">
                <label class="col-sm-2 label-on-left">Start Date</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating">
                    <label class="control-label"></label>
                    <input class="form-control datepicker" type="text" name="leave_sd" value="<?php echo dateFormate_11($MyLeaveRequest["leave_sd"]);?>" tabindex="16" />
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">End Date</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating">
                    <label class="control-label"></label>
                    <input class="form-control datepicker" type="text" name="leave_ed" value="<?php echo dateFormate_11($MyLeaveRequest["leave_ed"]);?>" tabindex="16" />
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Full / Half</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating">
                    <select class="selectpicker" data-style="select-with-transition" name="leave_of" title="Leave Duration" tabindex="5">
                      <option value="1" <?php echo StaticDDSelection(1, $MyLeaveRequest["leave_of"]);?> selected>Full Day</option>
                      <option value="2" <?php echo StaticDDSelection(2, $MyLeaveRequest["leave_of"]);?>>Half Day (First Half)</option>
                      <option value="3" <?php echo StaticDDSelection(3, $MyLeaveRequest["leave_of"]);?>>Half Day (Second Half)</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill">Submit</button>
                <button type="reset" class="btn btn-fill">Reset</button>
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
<?php } ?>
