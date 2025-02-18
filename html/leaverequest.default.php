<div class="content">
  <div class="container-fluid">
<?php
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("request_flow_type", 2);
				$objQayaduser->lstUserRequestFlow();
				if($objQayaduser->totalRecords() > 0){
					$GetEmpDetail_section_a = $objQayaduser->dbFetchArray(1);
						//print_r($GetEmpDetail_section_a);
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("user_id", $GetEmpDetail_section_a["leave_request_to"]);
						$objQayaduser->lstUsers();
						$ReceiverLeaveEmpDetail_section_a = $objQayaduser->dbFetchArray(1);
						$RequestFlowType = 2;
						$leave_request_to = $ReceiverLeaveEmpDetail_section_a["fullname"];
						/******************************************************/
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("user_id", $ReceiverLeaveEmpDetail_section_a["user_id"]);
						$objQayaduser->lstUserJobDetail();
						$RequestLeaveUserDepartment = $objQayaduser->dbFetchArray(1);
						/******************************************************/
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("user_id", $GetEmpDetail_section_a["overtime_request_to"]);
						$objQayaduser->lstUsers();
						$ReceiverOverTimeEmpDetail = $objQayaduser->dbFetchArray(1);
						$overtime_request_to = $ReceiverOverTimeEmpDetail_section_a["fullname"];
				} else {	
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("company_id", $LoginUserInfo["company_id"]);
					$objQayaduser->setProperty("department_id", $LoginUserInfo["department_id"]);
					$objQayaduser->setProperty("request_flow_type", 1);
					$objQayaduser->lstUserRequestFlow();
					if($objQayaduser->totalRecords() > 0){
						$GetEmpDetail_section_b = $objQayaduser->dbFetchArray(1);
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("user_id", $GetEmpDetail_section_b["leave_request_to"]);
							$objQayaduser->lstUsers();
							$ReceiverLeaveEmpDetail_section_b = $objQayaduser->dbFetchArray(1);
							$leave_request_to = $ReceiverLeaveEmpDetail_section_b["fullname"];
							$RequestFlowType = 1;
							/******************************************************/
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("user_id", $ReceiverLeaveEmpDetail_section_b["user_id"]);
							$objQayaduser->lstUserJobDetail();
							$RequestLeaveUserDepartment = $objQayaduser->dbFetchArray(1);
							/******************************************************/
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("user_id", $GetEmpDetail_section_b["overtime_request_to"]);
							$objQayaduser->lstUsers();
							$ReceiverOverTimeEmpDetail_section_b = $objQayaduser->dbFetchArray(1);
							$overtime_request_to = $ReceiverOverTimeEmpDetail_section_b["fullname"];
					} else {
							$objQayaduser->resetProperty();
							$objQayaduser->setProperty("user_id", 48);
							$objQayaduser->lstUsers();
							$ReceiverLeaveEmpDetail_section_c = $objQayaduser->dbFetchArray(1);
							$leave_request_to = $ReceiverLeaveEmpDetail_section_c["fullname"];
							$overtime_request_to = $ReceiverLeaveEmpDetail_section_c["fullname"];
					}
				}
	?>
	<div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-content" style="text-align:left">
            <p class="category">Leave Request Forwarding:</p>
            <h3 class="card-title"><?php echo $leave_request_to;?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-content" style="text-align:left;">
            <p class="category">Payment Request Forwarding:</p>
            <h3 class="card-title"><?php echo $overtime_request_to;?></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">My Leave Requests</h4>
            <div class="toolbar text-right">
            <?php if($LoginUserInfo["company_id"]!=''){?>
             <a href="<?php echo Route::_('show=leaverequestform&rfi='.EncData($RequestFlowType, 2, $objBF).'&rt='.EncData($RequestLeaveUserDepartment["department_id"], 2, $objBF));?>" class="btn btn-primary">Add New</a> 
             <?php } ?>
             </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
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
                <tfoot>
                  <tr>
                  	<th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Duration</th>
                    <th>Reason</th>
                    <th>Stage</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
                    $objQayaduser->lstUserLeaveRequest();
                    while($MyLeaveRequest = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $MyLeaveRequest["leave_name"];?></td>
                    <td><?php echo $MyLeaveRequest["leave_sd"];?></td>
                    <td><?php echo $MyLeaveRequest["leave_ed"];?></td>
                    <td><?php echo LeaveOf($MyLeaveRequest["leave_of"]);?></td>
                    <td><?php echo $MyLeaveRequest["leave_reason"];?></td>
                    <td><?php echo ForwardDirectorStatus($MyLeaveRequest["forward_director"]);?></td>
                    <td><?php echo LeaveStatus($MyLeaveRequest["leave_status"]);?></td>
                    <td>
                    <?php if($MyLeaveRequest["leave_status"] == 1){?>
                    <a href="<?php echo Route::_('show=leaverequest&rq='.EncData('Delete', 2, $objBF).'&i='.EncData($MyLeaveRequest["leave_request_id"], 2, $objBF));?>"><i class="material-icons">delete</i></a>
                    <?php } else { }?>
                    </td>
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