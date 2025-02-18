<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
          <input type="hidden" name="mode" value="<?php echo $mode;?>">
          <input type="hidden" name="user_job_detail_id" value="<?php echo EncData($user_job_detail_id, 1, $objBF);?>">
          <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Organization', $mode);?></h4>
            </div>
            <div class="toolbar back-btn text-right"> <a href="<?php echo Route::_('show=employeopt&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Job Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'job_title_id');?>">
                  <label class="control-label"></label>
                  <select class="selectpicker" data-style="select-with-transition" name="job_title_id" required title="List of Job Title's" tabindex="1">
                    <?php $objQayaduser->resetProperty();  echo $objQayaduser->JobTitleCombo($job_title_id);?>
                  </select>
                  <small><?php echo $vResult["job_title_id"];?></small>
                </div>
              </div>
            </div>
            
            
            <div class="row" style="display:none">
              <label class="col-sm-2 label-on-left">Select Company</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'company_id');?>">
                  <label class="control-label"></label>
                  <select class="selectpicker" data-style="select-with-transition" name="company_id" required title="List of Companies" tabindex="2">
                    <?php $objQayaduser->resetProperty(); echo $objQayaduser->CompanyCombo($company_id);?>
                  </select>
                  <small><?php echo $vResult["company_id"];?></small>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Department</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'department_id');?>">
                  <label class="control-label"></label>
                  <select class="selectpicker" data-style="select-with-transition" name="department_id" title="List of Department's" tabindex="2">
                  	<option value="">Select Department</option>
                    <?php $objQayaduser->resetProperty(); echo $objQayaduser->DepartmentCombo($department_id);?>
                  </select>
                  <small><?php echo $vResult["department_id"];?></small>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Job Description</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'job_description');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="job_description" rows="6" tabindex="3"><?php echo $job_description;?></textarea>
                </div>
              </div>
            </div>
            <div class="row" style="display:none;">
            <label class="col-sm-2 label-on-left">Yearly Leave Assign</label>
            <div class="col-xs-9">
                    <div class="card">
                        <div class="card-content">
                        
                        <?php
						$objQayadUserYearlyLeave = new Qayaduser;
                        $objQayaduser->resetProperty();
                        $objQayaduser->setProperty("isActive", 1);
                        $objQayaduser->lstYearlyLeaveType();
                        while($YearlyLeaveList = $objQayaduser->dbFetchArray(1)){
						
								$objQayadUserYearlyLeave->setProperty("user_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
								$objQayadUserYearlyLeave->setProperty("leave_type_id", $YearlyLeaveList["yearly_leave_type_id"]);
								$objQayadUserYearlyLeave->lstUserleaves();
								$CounterofUserLeave = $objQayadUserYearlyLeave->totalRecords();
								if($CounterofUserLeave >0 ){
								$YearlyLeaveList = $objQayadUserYearlyLeave->dbFetchArray(1);
                        ?>
                        		<input type="hidden" name="leavechecker[]" value="1">
                                <input type="hidden" name="user_leave_id[]" value="<?php echo $YearlyLeaveList["user_leave_id"];?>">
                        <?php } else { ?>
                        		<input type="hidden" name="leavechecker[]" value="0">
                        <?php } ?>
                        <label style="width:100%;">
                        <div class="col-sm-1">
                        <input type="checkbox" name="leave_type_id[]" value="<?php echo $YearlyLeaveList["yearly_leave_type_id"];?>" checked>
                        </div>
                        <div class="col-sm-11" style="margin-top:2px;"><code><?php echo $YearlyLeaveList["yearly_leave_name"];?> [<?php echo $YearlyLeaveList["number_of_leave"];?>]</code></div>
                        </label>
                        <hr style="margin-top:5px; margin-bottom:5px;">
						<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Joined date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'device_uid');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="joined_date" required value="<?php echo dateFormate_11($joined_date);?>" tabindex="4" />
                  <small><?php echo $vResult["joined_date"];?></small>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Probation Period Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="probation_period_status" title="Probation Period Status" tabindex="5">
                    <option value="1" <?php echo StaticDDSelection(1, $probation_period_status);?>>Yes</option>
                    <option value="2" <?php echo StaticDDSelection(2, $probation_period_status);?>>No</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Probation Period End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'device_uid');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="probation_period_end_date" value="<?php echo dateFormate_11($probation_period_end_date);?>" tabindex="6" />
                  <small><?php echo $vResult["probation_period_end_date"];?></small>
                </div>
              </div>
            </div>
            
            
            
            

            <div class="row">
              <label class="col-sm-2 label-on-left">Service End date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'service_end_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="service_end_date" value="<?php echo dateFormate_11($service_end_date);?>" tabindex="7" />
                  <small><?php echo $vResult["service_end_date"];?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Job Type #</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'job_type');?>">
                  <label class="control-label"></label>
                  <select class="selectpicker" data-style="select-with-transition" name="job_type" title="Employee Job Type" tabindex="8">
                    <option value="1" <?php echo StaticDDSelection(1, $job_type);?>>Permanent</option>
                    <option value="2" <?php echo StaticDDSelection(2, $job_type);?>>Contract</option>
                    <option value="3" <?php echo StaticDDSelection(3, $job_type);?>>Temporary</option>
                    <option value="4" <?php echo StaticDDSelection(4, $job_type);?>>Part-Time</option>
                  </select>
                  <small><?php echo $vResult["mobile_ext"];?></small>
                </div>
              </div>
            </div>

            </div>
			
            <div class="row">
              <label class="col-sm-2 label-on-left">Assign Shift</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'shift_id');?>">
                  <label class="control-label"></label>
                  <select class="selectpicker" data-style="select-with-transition" name="shift_id" title="Employee Shift" required tabindex="9">
                    <?php echo $objQayaduser->ShiftCombo($dummy_shift_id);?>
                  </select>
                  <small><?php echo $vResult["shift_id"];?></small>
                </div>
              </div>
            </div>



			 <?php 
			for($D=1;$D<=7;$D++){ 
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, $objBF)));
			$objQayaduser->setProperty("day_id", $D);
			$objQayaduser->lstUserShifts();
			if($objQayaduser->totalRecords() > 0){
			$GetShiftID = $objQayaduser->dbFetchArray(1);
				if($GetShiftID["shift_id"] != 0){
					$PassShiftId = $GetShiftID["shift_id"];
				} else {
					$PassShiftId = '0';
				}
				$shift_mode = 'U';
				$ShiftId = EncData($GetShiftID["user_shift_id"], 1, $objBF);
			} else {
				$PassShiftId = '';
				$shift_mode = 'I';
				$ShiftId = '';
			}
			?>
                  <input type="hidden" name="shift_mode[<?php echo $D;?>]" value="<?php echo $shift_mode;?>">
                  <input type="hidden" name="user_shift_id[<?php echo $D;?>]" value="<?php echo $ShiftId;?>">
                  <input type="hidden" name="day_id[<?php echo $D;?>]" value="<?php echo $D;?>">
            <?php } ?>





			
            
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
