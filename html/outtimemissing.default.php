<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Out Time Missing List</h4>
            <div class="toolbar text-right"> <a href="javascript:void();" onClick="openRequestedPopup('<?php echo SITE_URL;?>epmlist.php', 2);" class="btn btn-primary">View Employee List in Device</a> </div>
            <hr>
            <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
                    <thead>
                      <tr>
                        <th>Employee Name</th>
                        <th>Employee Device ID</th>
                        <th>Date</th>
                        <th>In-Time</th>
                        <th>Location & Status</th>
                        <th>Modify</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					$objQayadAttendance->resetProperty();
					$objQayadAttendance->setProperty("ORDERBY", "attendance_id DESC");
					$objQayadAttendance->setProperty("less_att_date", date("Y-m-d"));
					$objQayadAttendance->setProperty("outtime_missing", 'YES');
                    $objQayadAttendance->lstAttendance();
                    while($OutTimeMissing = $objQayadAttendance->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td><?php echo $objQayaduser->GetUserFullNameByDeviceId($OutTimeMissing["device_uid"]);?></td>
                        <td><?php echo $OutTimeMissing["device_uid"];?></td>
                        <td><?php echo $OutTimeMissing["att_date"];?></td>
                        <td><?php echo $OutTimeMissing["att_in"];?></td>
                        <td><?php echo $objQayaddevice->GetDeviceLocation($OutTimeMissing["device_id"]);?></td>
                        <td><a href="<?php echo Route::_('show=attendancemodification&rt='.EncData('yes', 2, $objBF).'&ati='.EncData($OutTimeMissing["attendance_id"], 2, $objBF));?>">Modify</a></td>
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