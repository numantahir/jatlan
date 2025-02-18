<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">access_time</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Approved Leave List</h4>
            <div class="toolbar text-right">  </div>
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
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Employee Name</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Reason</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayadGetUser = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("department_id_array", substr($MakeLeaveDepartmentArray,0,-1));
					$objQayaduser->setProperty("forward_director", 2);
					//$objQayaduser->setProperty("user_id_not", $LoginUserInfo["user_id"]);
                    $objQayaduser->lstUserLeaveRequest();
                    while($MyLeaveRequest = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                  	<td><?php echo $objQayadGetUser->GetUserFullName($MyLeaveRequest["user_id"]);?></td>
                  	<td><?php echo $MyLeaveRequest["leave_name"];?></td>
                    <td><?php echo dateFormate_3($MyLeaveRequest["leave_sd"]);?></td>
                    <td><?php echo dateFormate_3($MyLeaveRequest["leave_ed"]);?></td>
                    <td><?php echo LeaveOf($MyLeaveRequest["leave_of"]);?></td>
                    <td><?php echo $MyLeaveRequest["leave_reason"];?></td>
                    <td><?php echo LeaveStatus($MyLeaveRequest["leave_status"]);?></td>
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