<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php 
			  	$objQayadAttendance->resetProperty();
				$objQayadAttendance->setProperty("attendance_id", trim(DecData($_GET["ati"], 1, $objBF)));
				$objQayadAttendance->lstAttendance();
				$AttendanceDetail = $objQayadAttendance->dbFetchArray(1);
				
				$objQayaduser->resetProperty();
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("device_uid", $AttendanceDetail["device_uid"]);
				$objQayaduser->VwUserDetail();
				$GetEmployeeDetail = $objQayaduser->dbFetchArray(1);
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
			$objQayaduser->setProperty("user_id", $GetEmployeeDetail["user_id"]);
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
			$GetThisDayName = GetCurrentDayName($AttendanceDetail["att_date"],1);
			$ThisShiftTotalMinutes = CountTimeMinutes($AttendanceDetail["att_date"]." ".$GetUserShifts[$GetThisDayName]["shift_st"],$AttendanceDetail["att_date"]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
			$TodayShiftHours = MinutesConvertHours($ThisShiftTotalMinutes);
			if(date("a", strtotime($AttendanceDetail["att_out"])) == 'am' && date("h", strtotime($AttendanceDetail["att_out"])) >= '12'){
				$ReturnDateforHours = date('Y-m-d', strtotime("+1 day", strtotime($AttendanceDetail["att_date"])));
			}  else {
				$ReturnDateforHours = $AttendanceDetail["att_date"];
			}
			$TotalHourdCount = CountTimeMinutes($AttendanceDetail["att_date"]." ".$AttendanceDetail["att_in"],$ReturnDateforHours." ".$AttendanceDetail["att_out"]);
			$NumberofShiftMinutes = $ThisShiftTotalMinutes;
			$NumberofLOGTMinutes = $GetUserShifts[$GetThisDayName]["shift_logt"];
			$NumberofWorkingMinutes = $TotalHourdCount;
			?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="attendance_id" value="<?php echo EncData(trim(DecData($_GET["ati"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="att_date" value="<?php echo $AttendanceDetail["att_date"];?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Overtime Request</h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=myattendance');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0">
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
                  <tr>
                    <td><strong>Working Hours</strong></td>
                    <td><?php echo MinutesConvertHours($TotalHourdCount); ?></td>
                  </tr>
                  <tr>
                    <td><strong>OverTime</strong></td>
                    <td><?php
					if(trim(DecData($_GET["otmode"], 1, $objBF)) == "hd" && $_GET["ot"] != ""){
						//echo '<br>'.base64_decode($_GET["otp"]);
						//die();
						list($GetTotalNoOfOT,$GetTodayLateInMintus)= explode('|', base64_decode($_GET["otp"]));
						
						$GetRemainingMinOverTime = $GetTotalNoOfOT - $GetTodayLateInMintus;
							echo MinutesConvertHours($GetTotalNoOfOT).'<br>';
							echo '-------------<br>';
							echo '<input type="hidden" name="noofhr" value="'.$GetTotalNoOfOT.'">';
						if($GetTodayLateInMintus > 0){
							/****************************************************************/
							echo MinutesConvertHours($GetTodayLateInMintus).' X 1x <br>';
							echo '<input type="hidden" name="noofone" value="'.$GetTodayLateInMintus.'">';
							/****************************************************************/
						} 
							/****************************************************************/
							if($GetRemainingMinOverTime <= 180){
							/****************************************************************/
							//$OverTimeSecondShiftCount += $GetRemainingMinOverTime;
							echo MinutesConvertHours($GetRemainingMinOverTime).' X 1.5x <br>';
							echo '<input type="hidden" name="noofonepfive" value="'.$GetRemainingMinOverTime.'">';
							/****************************************************************/
							} elseif($GetRemainingMinOverTime > 180){
							/****************************************************************/
							//$OverTimeSecondShiftCount += $GetRemainingMinOverTime;
							echo MinutesConvertHours($GetRemainingMinOverTime).' X 1.5x <br>';
							$RemainingLeft = $GetRemainingMinOverTime - 180;
							echo MinutesConvertHours($RemainingLeft).' X 2.0x <br>';
							echo '<input type="hidden" name="noofonepfive" value="'.$GetRemainingMinOverTime.'">';
							echo '<input type="hidden" name="noofoneptwo" value="'.$RemainingLeft.'">';
							/****************************************************************/
							}
							/****************************************************************/
							
					
					} else {
					echo MinutesConvertHours($_GET["ot"]);
					}
					
					 ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Reason / Note:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'att_in');?>">
                  <label class="control-label"></label>
                  <textarea name="reason_overtime" class="form-control" required rows="8"></textarea>
                   </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>