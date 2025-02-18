<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">My Available Leaves</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover available-leaves" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Leave Name</th>
                    <th>Leave Type</th>
                    <th>No. of Leave</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Leave Name</th>
                    <th>Leave Type</th>
                    <th>No. of Leave</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
                    $objQayaduser->lstUserleaves();
                    while($MyLeaveRequest = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $MyLeaveRequest["yearly_leave_name"];?></td>
                    <td><?php echo YearlyLeaveType($MyLeaveRequest["yearly_leave_type"]);?></td>
                    <td><?php echo $MyLeaveRequest["leave_days"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <hr>
              <h4>My Request Leaves</h4>
              <hr>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("leave_status", 2);
					$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
                    $objQayaduser->lstUserLeaveRequest();
                    while($MyLeaveRequest = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $MyLeaveRequest["leave_name"];?></td>
                    <td><?php echo $MyLeaveRequest["leave_sd"];?></td>
                    <td><?php echo $MyLeaveRequest["leave_ed"];?></td> 
                    <td><?php echo LeaveStatus($MyLeaveRequest["leave_status"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <hr>
              <h4>My Attendance Leaves</h4>
              <hr>
              <table id="datatables" class="table table-striped table-no-bordered table-hover datatables_home attendance-leaves" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Leave Mode</th>
                    <th>Cutting</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadAttendance->resetProperty();
					$objQayadAttendance->setProperty("isActive", 1);
					$objQayadAttendance->setProperty("ORDERBY", "att_date DESC");
					$objQayadAttendance->setProperty("user_id", $LoginUserInfo["user_id"]);
                    $objQayadAttendance->lstUserAttLeaves();
					$TotalNoFUserAttLeaves = 0;
                    while($MyAttendanceLeaves = $objQayadAttendance->dbFetchArray(1)){
						$TotalNoFUserAttLeaves += LeaveIntValueLabel($MyAttendanceLeaves["att_leave_cutting"]);
                    ?>
                  <tr>
                    <td data-sort="<?php echo $MyAttendanceLeaves["att_date"];?>"><?php echo dateFormate_3($MyAttendanceLeaves["att_date"]);?></td>
                    <td><?php echo LeaveModes($MyAttendanceLeaves["att_leave_mode"]);?></td>
                    <td><?php echo LeaveIntValueLabel($MyAttendanceLeaves["att_leave_cutting"]);?></td> 
                  </tr>
                  <?php } ?>
                  
                </tbody>
                 <tfoot>
                 <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td><strong><?php echo $TotalNoFUserAttLeaves;?> Days</strong></td> 
                  </tr>
                 </tfoot>
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
