<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">access_time</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">OverTime Request List <?php echo $LoginUserInfo["department_id"];?></h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
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
                  	<th>Name</th>
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
					$GetHlidays = array();
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "holiday_id DESC");
					$objQayaduser->setProperty("limit", 10);
					$objQayaduser->lstHolidays();
					while($GetHolidaysList = $objQayaduser->dbFetchArray(2)){
						if($GetHolidaysList["holiday_sd"] == $GetHolidaysList["holiday_ed"]){
						$GetHlidays[$GetHolidaysList["holiday_sd"]] = $GetHolidaysList;
						} else {
						$GetHlidays[$GetHolidaysList["holiday_sd"]] = $GetHolidaysList;	
						$earlier = new DateTime($GetHolidaysList["holiday_sd"]);
						$later = new DateTime($GetHolidaysList["holiday_ed"]);
						$diff = $later->diff($earlier)->format("%a"); 
							for($hd=1;$hd<=$diff;$hd++){
								$GetHlidays[date('Y-m-d', strtotime($GetHolidaysList["holiday_sd"]. ' + '.$hd.' days'))] = $GetHolidaysList;	
							}	
						}
					}
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
					if($LoginUserInfo["user_type_id"] != 8){
					$objQayadAttendance->setProperty("teamlead_status", 1);
					}
					$objQayadAttendance->setProperty("department_id", $LoginUserInfo["department_id"]);
                    $objQayadAttendance->lstOvertimeRequest();
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
                  <td><?php echo $OrverTimeRequestDetail["user_fname"] . ' ' . $OrverTimeRequestDetail["user_lname"]; ?></td>
                    <td><?php echo dateFormate_3($OrverTimeRequestDetail["att_date"]); ?></td>
                    <td><?php echo date("h.i A", strtotime($OrverTimeRequestDetail["att_date"]. " " . $OrverTimeRequestDetail["att_in"])); ?></td>
                    <td><?php echo date("h.i A", strtotime($OrverTimeRequestDetail["att_date"]. " " . $OrverTimeRequestDetail["att_out"])); ?></td>
                    <td><?php
					$TotalShiftHours = $NumberofShiftMinutes + $NumberofLOGTMinutes;
					if($NumberofWorkingMinutes > $TotalShiftHours){
					$GetOverTimeMinutes = $NumberofWorkingMinutes - $TotalShiftHours;
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
					
					if(array_key_exists($OrverTimeRequestDetail["att_date"],$GetHlidays) && $OrverTimeRequestDetail["att_in"] != ""){
						$GetTotalNoOfOT = 
						CountTimeMinutes($OrverTimeRequestDetail["att_date"]." ".substr($OrverTimeRequestDetail["att_in"],0,-3),$OrverTimeRequestDetail["att_date"]." ".
						substr($OrverTimeRequestDetail["att_out"],0,-3));
						echo MinutesConvertHours($GetTotalNoOfOT);
					}
					
					
					 ?>
                     </td>
                    <td><?php echo $OrverTimeRequestDetail["reason_overtime"];?></td>
                    <td><a href="<?php echo Route::_('show=overtimerequest&rq='.EncData('Approved', 2, $objBF).'&ati='.EncData($OrverTimeRequestDetail["attendance_id"], 2, $objBF).'&ui='.EncData($OrverTimeRequestDetail["user_id"], 2, $objBF));?>">Approve</a> &nbsp; | &nbsp; <a href="<?php echo Route::_('show=overtimerequest&rq='.EncData('Reject', 2, $objBF).'&ati='.EncData($OrverTimeRequestDetail["attendance_id"], 2, $objBF).'&ui='.EncData($OrverTimeRequestDetail["user_id"], 2, $objBF));?>">Reject</a></td>
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