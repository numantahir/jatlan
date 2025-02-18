<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php 
		  if(trim(DecData($_GET["rt"], 1, $objBF)) == 'yes' && trim(DecData($_GET["ati"], 1, $objBF)) != ''){ 
		  		$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("attendance_id", trim(DecData($_GET["ati"], 1, $objBF)));
				$objQayadAttendance->lstAttendance();
				$AttendanceDetail = $objQayadAttendance->dbFetchArray(1);
				
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("device_uid", $AttendanceDetail["device_uid"]);
				$objQayaduser->VwUserDetail();
				$GetEmployeeDetail = $objQayaduser->dbFetchArray(1);
		  ?>
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Attendance Detail of <strong><?php echo $GetEmployeeDetail["fullname"]; ?></strong></h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=attendancemodification&rt='.EncData('modify', 2, $objBF).'&ati='.EncData($AttendanceDetail["attendance_id"], 2, $objBF));?>" class="btn btn-primary">Modifiy</a> </div>
            <hr>
            <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  <tr>
                    <td><strong>Employee Name</strong></td>
                    <td><?php echo $GetEmployeeDetail["fullname"]; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Company</strong></td>
                    <td><?php echo $GetEmployeeDetail["company_name"]; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Department</strong></td>
                    <td><?php echo $GetEmployeeDetail["department_name"]; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Location</strong></td>
                    <td><?php echo $GetEmployeeDetail["location_name"]; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Job Title</strong></td>
                    <td><?php echo $GetEmployeeDetail["job_title"]; ?></td>
                  </tr>
                  <tr>
                    <td><strong>Attendance Date</strong></td>
                    <td><?php echo dateFormate_3($AttendanceDetail["att_date"]); ?></td>
                  </tr>
                  <tr>
                    <td><strong>Attendance In Time</strong></td>
                    <td>
					<?php 
					if($AttendanceDetail["att_in"] != ''){
					echo date("h.i A", strtotime($AttendanceDetail["att_date"]. " " . $AttendanceDetail["att_in"])); 
					} else { echo 'In Time Missing'; }
					?>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Attendance Out Time</strong></td>
                    <td>
					<?php 
					if($AttendanceDetail["att_out"] != ''){
					echo date("h.i A", strtotime($AttendanceDetail["att_date"]. " " . $AttendanceDetail["att_out"])); 
					} else { echo 'Out Time Missing'; }
					?>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <?php } elseif(trim(DecData($_GET["rt"], 1, $objBF)) == 'modify' && trim(DecData($_GET["ati"], 1, $objBF)) != ''){
			  	$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("attendance_id", trim(DecData($_GET["ati"], 1, $objBF)));
				$objQayadAttendance->lstAttendance();
				$AttendanceDetail = $objQayadAttendance->dbFetchArray(1);
			?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="ST-2">
            <input type="hidden" name="att_mode" value="2">
            <input type="hidden" name="attendance_id" value="<?php echo EncData(trim(DecData($_GET["ati"], 1, $objBF)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Attendance Modification</h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=holidays');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Attendance In Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'att_in');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="att_in" tabindex="1" value="<?php echo $AttendanceDetail["att_in"];?>" />
                  <small><?php echo $vResult["att_in"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Attendance Out Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'att_out');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="att_out" tabindex="2" value="<?php echo $AttendanceDetail["att_out"];?>" />
                  <small><?php echo $vResult["att_out"];?></small> </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } else { ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="ST-1">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Attendance Modification</h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=holidays');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'holiday_sd');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="modification_date" required tabindex="1" />
                  <small><?php echo $vResult["holiday_sd"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Employee</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="employee_id" required title="List of All Employee" tabindex="2">
                    <?php $objQayaduser->resetProperty(); echo $objQayaduser->EmployeeCombo();?>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } ?>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>