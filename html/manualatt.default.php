<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Manual Attendance List</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                      <tr>
                        <th>Employee Name</th>
                        <th>ORG-IN</th>
                        <th>ORG-OUT</th>
                        <th>Modify IN</th>
                        <th>Modify OUT</th>
                        <th>Date</th>
                        <th>Modify By</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					$objQayadOrgAttendance	= new Qayadattendance;
					$objQayadAttendance->resetProperty();
					$objQayadAttendance->setProperty("ORDERBY", "manual_attendance_id DESC");
					$objQayadAttendance->setProperty("DATEFILTER", "YES");
					$objQayadAttendance->setProperty("STARTDATE", date('Y-m-d', strtotime(date("Y-m-01"). ' - 2 month')));
					$objQayadAttendance->setProperty("ENDDATE", date("Y-m-d"));
                    $objQayadAttendance->lstManualAttendance();
                    while($ManualAttendance = $objQayadAttendance->dbFetchArray(1)){
						
							$objQayadOrgAttendance->setProperty("attendance_id", $ManualAttendance["manual_attendance_id"]);
							$objQayadOrgAttendance->lstAttendance();
							$MainAttendance = $objQayadOrgAttendance->dbFetchArray(1);
                    ?>
                      <tr>
                        <td><?php echo $objQayaduser->GetUserFullNameByDeviceId($ManualAttendance["device_uid"]);?></td>
                        <td><?php echo $ManualAttendance["att_in"];?></td>
                        <td><?php echo $ManualAttendance["att_out"];?></td>
                        <td><?php echo $MainAttendance["att_in"];?></td>
                        <td><?php echo $MainAttendance["att_out"];?></td>
                        <td><?php echo $ManualAttendance["att_date"];?></td>
                        <td><?php echo $objQayaduser->GetUserFullName($ManualAttendance["modify_by_id"]);?></td>
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