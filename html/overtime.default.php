<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">access_time</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">My OverTime</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>In-Time</th>
                    <th>Out-Time</th>
                    <th>Overtime</th>
                    <th>Reason</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Date</th>
                    <th>In-Time</th>
                    <th>Out-Time</th>
                    <th>Overtime</th>
                    <th>Reason</th>
                    <th>Status</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					/************************************************************************/	
					$GetShifts = array();
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("isActive", '1');
					$objQayaduser->lstShifts();
					while($GetShiftsList = $objQayaduser->dbFetchArray(2)){
						$GetShifts[$GetShiftsList["shift_id"]] = $GetShiftsList;
					}
					/************************************************************************/	
					$GetUserShifts = array();
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
					$objQayaduser->lstUserShifts();
					while($GetUserShiftsList = $objQayaduser->dbFetchArray(2)){
						if($GetUserShiftsList["day_status"] == 1){
							$GetUserShifts[GetDayName($GetUserShiftsList["day_id"])] = array(
								'day_status' => $GetUserShiftsList["day_status"], 
								'shift_st' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_st"], 
								'shift_et' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_et"], 
								'shift_ligt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_ligt"], 
								'shift_logt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_logt"], 
								'shift_eigt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_eigt"], 
								'shift_eogt' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_eogt"], 
								'shift_name' => $GetShifts[$GetUserShiftsList["shift_id"]]["shift_name"]);
						} else {
							$GetUserShifts[GetDayName($GetUserShiftsList["day_id"])] = array('day_status' => $GetUserShiftsList["day_status"]);
						}
					}
					/************************************************************************/
					
					$objQayadAttendance->resetProperty();
                    $objQayadAttendance->setProperty("device_uid", $LoginUserInfo["device_uid"]);
					$objQayadAttendance->setProperty("overtime_status_not", 1);
                    $objQayadAttendance->lstAttendance();
                    while($OrverTimeRequestDetail = $objQayadAttendance->dbFetchArray(1)){
						
					$GetThisDayName = GetCurrentDayName($OrverTimeRequestDetail["att_date"],1);
					$ThisShiftTotalMinutes = CountTimeMinutes($OrverTimeRequestDetail["att_date"]." ".$GetUserShifts[$GetThisDayName]["shift_st"],$OrverTimeRequestDetail["att_date"]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
					$TodayShiftHours = MinutesConvertHours($ThisShiftTotalMinutes);
					if(date("a", strtotime($OrverTimeRequestDetail["att_out"])) == 'am' && date("h", strtotime($OrverTimeRequestDetail["att_out"])) >= '12'){
						$ReturnDateforHours = date('Y-m-d', strtotime("+1 day", strtotime($OrverTimeRequestDetail["att_date"])));
					}  else {
						$ReturnDateforHours = $OrverTimeRequestDetail["att_date"];
					}
					$TotalHourdCount = CountTimeMinutes($OrverTimeRequestDetail["att_date"]." ".$OrverTimeRequestDetail["att_in"],$ReturnDateforHours." ".$OrverTimeRequestDetail["att_out"]);
					$NumberofShiftMinutes = $ThisShiftTotalMinutes;
					$NumberofLOGTMinutes = $GetUserShifts[$GetThisDayName]["shift_logt"];
					$NumberofWorkingMinutes = $TotalHourdCount;
						
						
                    ?>
                  <tr>
                    <td><?php echo dateFormate_3($OrverTimeRequestDetail["att_date"]); ?></td>
                    <td><?php echo date("h.i A", strtotime($OrverTimeRequestDetail["att_date"]. " " . $OrverTimeRequestDetail["att_in"])); ?></td>
                    <td><?php echo date("h.i A", strtotime($OrverTimeRequestDetail["att_date"]. " " . $OrverTimeRequestDetail["att_out"])); ?></td>
                    <td><?php
					if($NumberofWorkingMinutes > $NumberofShiftMinutes + $NumberofLOGTMinutes){
					$GetOverTimeMinutes = $NumberofWorkingMinutes - $NumberofShiftMinutes + $NumberofLOGTMinutes;
					if($GetOverTimeMinutes <= 180){
						$OverTimeCalculate = '1.5';	
						$OverTimeFirstShiftCount += $GetOverTimeMinutes;
						$OverTimeCalculate = '180 x 1.5 ['.$GetOverTimeMinutes.']';
					} else {
						$SecondOverTimeShift = $GetOverTimeMinutes - 180;
						$OverTimeFirstShiftCount += 180;
						$OverTimeSecondShiftCount += $SecondOverTimeShift;
						$OverTimeCalculate = '180 x 1.5 & '.$SecondOverTimeShift.' x 2 ['.$GetOverTimeMinutes.']';
					}
					echo MinutesConvertHours($GetOverTimeMinutes);
				}			
					
					 ?></td>
                    <td><?php echo $OrverTimeRequestDetail["reason_overtime"];?></td>
                    <td><?php echo OverTimeRequestStatus($OrverTimeRequestDetail["overtime_status"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end content--> 
        </div>
        
        
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">access_time</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">My Holiday OverTime</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>In-Time</th>
                    <th>Out-Time</th>
                    <th>Overtime</th>
                    <th>Rate Per/Hr</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Date</th>
                    <th>In-Time</th>
                    <th>Out-Time</th>
                    <th>Overtime</th>
                    <th>Rate Per/Hr</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
					$objQayaduser->setProperty("isActive", 1);
                    $objQayaduser->lstUserOverTimeDetail();
                    while($HolidayOverTime = $objQayaduser->dbFetchArray(1)){
						$objQayadAttendance->resetProperty();
						$objQayadAttendance->setProperty("attendance_id", $HolidayOverTime["att_id"]);
						$objQayadAttendance->lstAttendance();
						$EmpAttendance = $objQayadAttendance->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo dateFormate_3($HolidayOverTime["att_date"]);?></td>
                    <td><?php echo RemoveLastDig($EmpAttendance["att_in"],3);?></td>
                    <td><?php echo RemoveLastDig($EmpAttendance["att_out"],3);?></td>
                    <td><?php echo MinutesConvertHours($HolidayOverTime["no_of_hrs"]);?></td>
                    <td><small>Per HR Salary x</small> <code><?php echo OverTimeRateCounter($HolidayOverTime["rate_per_hr"]);?></code></td>
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