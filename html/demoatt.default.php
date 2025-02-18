<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
<style>
small{
	color:#FFF;
}
td{
	padding:35px !important;
	text-align:center;
	border:solid 1px #cccccc;
	color:#FFF;
	font-weight:bold;
	letter-spacing:1px;
	font-family:monospace;
	font-size:11px;
	}
th{
	text-align:center;
}
span{
	color:#FFF;
}
@keyframes LI{
50%{opacity: .5;}
100%{opacity: 1;}
}

.LI{
	color:#FFF;
	animation: LI 1s alternate infinite;
}
.card .card-content code{
	background:#FFF;
	color:#c7254e;
}
</style>
<table border="0" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="float: left; margin-right: 10px;">
<tr>
	<th>Sunday</th>
    <th>Monday</th>
    <th>Tuesday</th>
    <th>Wednesday</th>
    <th>Thursday</th>
    <th>Friday</th>
    <th>Saturday</th>
</tr>
<tr>
<?php 
	$ReturnTDValue = '';
	//////////////////////////////////////////////////
	/********Add Empty Box with Day counter**********/
	echo $ReturnEmptyBox;
	$count = 0 + $DayNumberFLop;
	//////////////////////////////////////////////////
	// Required Month Days loops START #01
	for($i=0;$i<=count($ReturnDaysList);$i++){ 
	// START #02
	if($ReturnDaysList[$i]!=''){

	$GetThisDayName = GetCurrentDayName($ReturnDaysList[$i],1);
	
	if($GetUserShifts[$GetThisDayName]["day_status"] == 1){
		$PassShiftDetail = '<small>LIGT: '.$GetUserShifts[$GetThisDayName]["shift_ligt"].' / LOGT: '.$GetUserShifts[$GetThisDayName]["shift_logt"].'<br>Shift '.RemoveLastDig($GetUserShifts[$GetThisDayName]["shift_st"],3).' TO '.RemoveLastDig($GetUserShifts[$GetThisDayName]["shift_et"],3).'</small>';
		$ThisShiftTotalMinutes = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_st"],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
		$TodayShiftHours = MinutesConvertHours($ThisShiftTotalMinutes);
	} else {
		$PassShiftDetail = '';
		$TodayShiftHours = '0';
	}
	$count++;
	//$ChangeBgColor = ' style="background-color:#668c2b;"'; (Approved Leave)
	//$ChangeBgColor = ' style="background-color:#b82929;"'; Adsent
	//$ChangeBgColor = ' style="background-color:#ededed;"'; Upcoming Days
	
	if(array_key_exists($ReturnDaysList[$i],$GetUserAttendance)){
		$ChangeBgColor = ' style="background-color:#090; color:#FFF !important;"';
		$PassText = 'Present';
	} else {
		if(date("Y-m-d") >= $ReturnDaysList[$i]){
		$ChangeBgColor = ' style="background-color:#b82929;"';
		$PassText = 'Absent';	
		} else {
		$ChangeBgColor = ' style="background-color:#ededed; color:#000;"';
		$PassText = '';
		}
	}
	
	if($GetUserShifts[$GetThisDayName]["day_status"] == 2){
		$RtBGColor = ' style="background-color:#94D;"';
	} else {
		$RtBGColor = $ChangeBgColor;
	}
	
	if(array_key_exists($ReturnDaysList[$i],$GetHlidays)){
		$RtBGColor_sec = ' style="background-color:#00989a;"';
	} else {
		$RtBGColor_sec = $RtBGColor;
	}
	
	if(array_key_exists($ReturnDaysList[$i],$GetLeaveRequest)){
		$tdBGColor = ' style="background-color:#668c2b;"';
		$LeaveTextPass = $GetLeaveRequest[$ReturnDaysList[$i]]["leave_name"];
	} else {
		$tdBGColor = $RtBGColor_sec;
		$LeaveTextPass = '';
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////
	if($count == 7){ $AddCTrAndOTr = '</tr><tr>'; $count = 0; } else { $AddCTrAndOTr = ''; }
	if($i==count($ReturnDaysList) - 1){ $AddLastClose = '</tr>'; } else { $AddLastClose = '';}
	///////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////////////////////
	
	if(array_key_exists($ReturnDaysList[$i],$GetHlidays)){
	//echo date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>'.$GetHlidays[$ReturnDaysList[$i]]['holiday_name'];
	$ReturnTDValue .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>'.$GetHlidays[$ReturnDaysList[$i]]['holiday_name'];
} else {
		if(array_key_exists($ReturnDaysList[$i],$GetUserAttendance)){
			//echo $PassShiftDetail.' ['. $TodayShiftHours .']<br>'. date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>'. 'IN:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],3);
			$ReturnTDValue .= $PassShiftDetail.' ['. $TodayShiftHours .']<br>'. date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>'. 'IN:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],3);
				if($ReturnDaysList[$i] == date("Y-m-d") && $GetUserAttendance[$ReturnDaysList[$i]]['att_out'] == ''){
					//echo '<br>I\'m in Office';
					$ReturnTDValue .= '<br>I\'m in Office';
				} else {
					if($GetUserAttendance[$ReturnDaysList[$i]]['att_out'] !=''){
						//echo ' / OT:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],3);
						$ReturnTDValue .= ' / OT:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],3);
						$TotalHourdCount = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_in'],$ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out']);
						//echo '<br><code>'.MinutesConvertHours($TotalHourdCount).'</code>';
						$ReturnTDValue .= '<br><code>'.MinutesConvertHours($TotalHourdCount).'</code>';
						//echo '<br><code>'.$TotalHourdCount.'</code>';
						
						$NumberofShiftMinutes = $ThisShiftTotalMinutes;
						$NumberofLOGTMinutes = $GetUserShifts[$GetThisDayName]["shift_logt"];
						$NumberofWorkingMinutes = $TotalHourdCount;
						/* Below code for Checking */
						//echo '<br><br><code>T:'.$NumberofWorkingMinutes .'<br>ST:'.$NumberofShiftMinutes.'<br>LOGT:'.$NumberofLOGTMinutes.'</code>';	
						
						if($NumberofWorkingMinutes > $NumberofShiftMinutes + $NumberofLOGTMinutes){
							$WorkingHoursWithGraceTime = $NumberofShiftMinutes + $NumberofLOGTMinutes;
							$GetOverTimeMinutes = $NumberofWorkingMinutes - $WorkingHoursWithGraceTime;
							//echo '&nbsp;<code>OT:'.MinutesConvertHours($GetOverTimeMinutes).'</code>';	
							
							$ReturnTDValue .= '&nbsp;<code>OT:'.MinutesConvertHours($GetOverTimeMinutes).'</code>';	
							
								if($GetOverTimeMinutes <= 180){
									$ReturnTDValue .= '<br>USR:1.5';
									} elseif($GetOverTimeMinutes > 180){
											$GetFirstCaseMintues = $GetOverTimeMinutes - 180;
										$ReturnTDValue .= '<br>USR:1.5 (180)';
										$ReturnTDValue .= '<br>USR:2 ('.$GetFirstCaseMintues.')';
										} 
							
						} elseif($NumberofWorkingMinutes < $NumberofShiftMinutes){
							$GetOverTimeMinutes = $NumberofShiftMinutes - $NumberofWorkingMinutes;
							//echo '&nbsp;<code>ST:'.MinutesConvertHours($GetOverTimeMinutes).'</code>';
							$ReturnTDValue .= '&nbsp;<code>ST:'.MinutesConvertHours($GetOverTimeMinutes).'</code>';
							
								if($GetOverTimeMinutes <= 60){
									$ReturnTDValue .= '<br>ESC:0.25';
									} elseif($GetOverTimeMinutes <= 180){
										$ReturnTDValue .= '<br>ESC:0.50';
										} elseif($GetOverTimeMinutes > 180){
											$ReturnTDValue .= '<br>ESC:1';
											}
					
						}
						
					} else {
						//echo '<br>Out attendance<br>missing.';
						$ReturnTDValue .= '<br>Out attendance<br>missing.';
					}
				}
			

			
			$GetInDif = GetTimeCal($ReturnDaysList[$i],$GetUserShifts[$GetThisDayName]["shift_st"],$GetUserAttendance[$ReturnDaysList[$i]]['att_in']);
			
			if($GetUserAttendance[$ReturnDaysList[$i]]['att_in'] > $GetUserShifts[$GetThisDayName]["shift_st"]){
				
				if($GetInDif->h == 0){
					if($GetInDif->i > $GetUserShifts[$GetThisDayName]["shift_ligt"]){
					//echo '<br><span class="LI">LI:'.RemaingMinutes($GetInDif->i, $GetUserShifts[$GetThisDayName]["shift_ligt"]).'M</span>';
					$GetLateIncomingMinutes = RemaingMinutes($GetInDif->i, $GetUserShifts[$GetThisDayName]["shift_ligt"]);
					$ReturnTDValue .= '<br><span class="LI">LI:'.$GetLateIncomingMinutes.'M</span>';
					/*****************************************/
					/*****************************************/
					//1 Hours = 60 M
					//3 Hours = 180 M
					/*if($GetLateIncomingMinutes <= 60){
						$ReturnTDValue .= '<br>SC:0.25';
					} elseif($GetLateIncomingMinutes <= 180){
						$ReturnTDValue .= '<br>SC:0.50';
					} elseif($GetLateIncomingMinutes > 180){
						$ReturnTDValue .= '<br>SC:1';
					}*/
					
					/*****************************************/
					/*****************************************/
					/*if($GetUserAttendance[$ReturnDaysList[$i]]['reason_late_in'] == ''){
					//echo '&nbsp;<a href="#" style="color:#FFF">Submit Reason</a><br>';
					$ReturnTDValue .= '&nbsp;<a href="#" style="color:#FFF">Submit Reason</a><br>';
					} else {
					//echo '&nbsp;<a href="#" style="color:#FFF">View Reason</a><br>';	
					$ReturnTDValue .= '&nbsp;<a href="#" style="color:#FFF">View Reason</a><br>';
					}*/
					}
				} else {
					//echo '<br>LI'.$GetInDif->h.'/'.$GetInDif->i.'<br>';
					$NumberofHoursLate = trim($GetInDif->h) * 60;
					$NumberofMintuesLate = trim($GetInDif->i);
					$GetTotalTimeHoursMinutes = $NumberofHoursLate + $NumberofMintuesLate;
					$GetLateIncomingMinutes = RemaingMinutes($GetTotalTimeHoursMinutes, $GetUserShifts[$GetThisDayName]["shift_ligt"]);
					$ReturnTDValue .= '<br><span class="LI">LI:'.$GetLateIncomingMinutes.'M</span>';
				}
				
					if($GetLateIncomingMinutes <= 60){
						$ReturnTDValue .= '<br>SC:0.25';
					} elseif($GetLateIncomingMinutes <= 180){
						$ReturnTDValue .= '<br>SC:0.50';
					} elseif($GetLateIncomingMinutes > 180){
						$ReturnTDValue .= '<br>SC:1';
					}
				
			} else {
				if($GetInDif->h == 0){
					if($GetInDif->i > $GetUserShifts[$GetThisDayName]["shift_eigt"]){
					//echo '<br>EI:'.RemaingMinutes($GetInDif->i, $GetUserShifts[$GetThisDayName]["shift_eigt"]).'M<br>';
					$ReturnTDValue .= '<br>EI:'.RemaingMinutes($GetInDif->i, $GetUserShifts[$GetThisDayName]["shift_eigt"]).'M<br>';
					}
				} else {
					//echo '<br>EI'.$GetInDif->h.'/'.$GetInDif->i.'<br>';
					$ReturnTDValue .= '<br>EI'.$GetInDif->h.'/'.$GetInDif->i.'<br>';
				}
			}
			
			
			
		} else {
			if($GetUserShifts[$GetThisDayName]["day_status"] == 2){
				if($ReturnDaysList[$i] > date("Y-m-d")){
					//echo date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					$ReturnTDValue .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
				} else {
					//echo date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					$ReturnTDValue .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					//echo 'Off Day';
					$ReturnTDValue .= 'Off Day';
				}
			} else {
				if($ReturnDaysList[$i] > date("Y-m-d")){
					//echo date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					$ReturnTDValue .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					//echo $LeaveTextPass;
					$ReturnTDValue .= $LeaveTextPass;
				} else {
					//echo date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					//echo $PassText;	
					//echo $LeaveTextPass;
					$ReturnTDValue .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					$ReturnTDValue .= $PassText;
					$ReturnTDValue .= $LeaveTextPass;	
				}
			
			}
		}
}
?>


<td<?php echo $tdBGColor;?>><?php echo $ReturnTDValue;?></td>

<?php echo $AddCTrAndOTr;echo $AddLastClose; } 
	// END #02
	$ReturnTDValue = '';
	} 
	// Required Month Days loops END #01
?>

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