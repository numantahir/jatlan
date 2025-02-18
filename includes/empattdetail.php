<?php 
	//////////////////////////////////////////////////
	/********Add Empty Box with Day counter**********/
	echo $ReturnEmptyBox;
	$count = 0 + $DayNumberFLop;
	//////////////////////////////////////////////////
	
	// Required Month Days loops START #01
	for($i=0;$i<=count($ReturnDaysList);$i++){ 
	
	// START #02
	if($ReturnDaysList[$i]!=''){

	// Convert Day Number to Day Name
	$GetThisDayName = GetCurrentDayName($ReturnDaysList[$i],1);
		
		// Get Today Day Name by Today Date
		if($ReturnDaysList[$i] == date("Y-m-d")){
			$PassTodayDayName .= $GetThisDayName;	
		} else {
			$PassTodayDayName .= '';
		}
		
		/***********************************************************************/
		/***********************************************************************/
		/***********************************************************************/
		include_once("filter_cond.php");
		/***********************************************************************/
		/***********************************************************************/
		/***********************************************************************/
		// Employee Shift Detail Assign by Admin
		/*if($GetUserShifts[$GetThisDayName]["day_status"] == 1){
			$ThisShiftTotalMinutes = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_st"],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
			$TodayShiftHours = MinutesConvertHours($ThisShiftTotalMinutes);
			//echo $GetUserShifts[$GetThisDayName]["day_status"].' - '.$GetThisDayName.'<br>';
		} else {
			$PassShiftDetail = '';
			$TodayShiftHours = '0';
		}*/
		
		//echo $ReturnDaysList[$i].'-'.$GetUserAttendance[$ReturnDaysList[$i]]['day_status'].'->IN:'.$GetUserAttendance[$ReturnDaysList[$i]]['att_in'].'->OUT:'.$GetUserAttendance[$ReturnDaysList[$i]]['att_out'].'<br>';
		if($GetUserAttendance[$ReturnDaysList[$i]]['day_status'] == 1){
			//$ThisShiftTotalMinutes = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_st"],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
			$ThisShiftTotalMinutes = CountTimeMinutes($ReturnDaysList[$i]." ".$ReturnStartTime,$ReturnDaysList[$i]." ".$ReturnEndTime);
			$TodayShiftHours = MinutesConvertHours($ThisShiftTotalMinutes);
			//echo $GetUserShifts[$GetThisDayName]["day_status"].' - '.$GetThisDayName.' - '.$ReturnDaysList[$i].'<br>';
		} elseif($GetUserAttendance[$ReturnDaysList[$i]]['day_status'] == '' && $GetUserShifts[$GetThisDayName]["day_status"] == 2){
			$PassShiftDetail = '';
			$TodayShiftHours = '0';
		} else {
			//$ThisShiftTotalMinutes = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_st"],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
			$ThisShiftTotalMinutes = CountTimeMinutes($ReturnDaysList[$i]." ".$ReturnStartTime,$ReturnDaysList[$i]." ".$ReturnEndTime);
			$TodayShiftHours = MinutesConvertHours($ThisShiftTotalMinutes);
			//echo $GetUserShifts[$GetThisDayName]["day_status"].' - '.$GetThisDayName.' - '.$ReturnDaysList[$i].'<br>';
		}
		
		
	$count++;
		
		
		if(array_key_exists($ReturnDaysList[$i],$GetUserAttendance)){
			$ChangeBgColor = ' class="present"';
			$PassText = 'Present';
		} else {
			if(date("Y-m-d") >= $ReturnDaysList[$i]){
			$ChangeBgColor = ' class="absent"';
			$PassText = '<span>Absent</span>';	
			} else {
			$ChangeBgColor = ' class="blank"';
			$PassText = '';
			}
		}
		
		if($GetUserAttendance[$ReturnDaysList[$i]]['day_status'] == 1){
			$RtBGColor = $ChangeBgColor;
		} elseif($GetUserAttendance[$ReturnDaysList[$i]]['day_status'] == '' && $GetUserShifts[$GetThisDayName]["day_status"] == 2){
			$RtBGColor = ' class="sunday"';
		} else {
			$RtBGColor = $ChangeBgColor;
		}
		//die();
		/*
		if($GetUserShifts[$GetThisDayName]["day_status"] == 2){
			$RtBGColor = ' class="sunday"';
		} else {
			$RtBGColor = $ChangeBgColor;
		}
	*/
		if(array_key_exists($ReturnDaysList[$i],$GetHlidays)){
			$RtBGColor_sec = ' class="holiday"';
		} else {
			$RtBGColor_sec = $RtBGColor;
		}
	
		/**************************************************************************************/
		////////////////////////////////////////////////////////////////////////////////////////
		/**************************************************************************************/
		if(array_key_exists($ReturnDaysList[$i],$GetLeaveRequest)){
			$LeaveDetail .= '<div class="time">'.
			$GetLeaveRequest[$ReturnDaysList[$i]]["leave_name"].'</div>';
			$p_LeaveDetail .= '1|'.$GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"]
			.'|'.$GetLeaveRequest[$ReturnDaysList[$i]]["leave_name"];
			if($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] ==1){
			$tdBGColor = ' class="leave"';
			$TotalNumberofLeave += 1;
			$LeaveCheckerPerDay = 1;
			} elseif($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] ==2){
			$tdBGColor = ' class="present"';
			$HalfDayLeaveShow .= '<div class="half-leave-f"></div>';
			$TotalNumberofLeave += 0.5;
			$LeaveCheckerPerDay = 0.5;
			} elseif($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] ==3){
			$tdBGColor = ' class="present"';
			$HalfDayLeaveShow .= '<div class="half-leave-s"></div>';
			$TotalNumberofLeave += 0.5;
			$LeaveCheckerPerDay = 0.5;
			}
		} else {
			$tdBGColor = $RtBGColor_sec;
			$LeaveTextPass = '';
		}
		/**************************************************************************************/
		////////////////////////////////////////////////////////////////////////////////////////
		/**************************************************************************************/

		///////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////
		if($count == 7){ $AddCTrAndOTr = '</tr><tr>'; $count = 0; } else { $AddCTrAndOTr = ''; }
		if($i==count($ReturnDaysList) - 1){ $AddLastClose = '</tr>'; } else { $AddLastClose = '';}
		///////////////////////////////////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////////////////////////////////

 
	if(array_key_exists($ReturnDaysList[$i],$GetHlidays) && $GetUserAttendance[$ReturnDaysList[$i]]['att_in'] == ""){
		//Holiday Print (Date + Name )
		$HolidayArray .= '<span class="HolidayModifiy">'.$GetHlidays[$ReturnDaysList[$i]]['holiday_name'].'</span>';
		$p_HolidayArray .= '1|'.$GetHlidays[$ReturnDaysList[$i]]['holiday_name'];
		
	} elseif(array_key_exists($ReturnDaysList[$i],$GetHlidays) && $GetUserAttendance[$ReturnDaysList[$i]]['att_in'] != ""){
	/****************************************************************************************************************************/
	/****************************************************************************************************************************/
	/****************************************************************************************************************************/
		
		$HolidayArray .= '<span class="HolidayModifiy">'.$GetHlidays[$ReturnDaysList[$i]]['holiday_name'].'</span>';
		$p_HolidayArray .= '1|'.$GetHlidays[$ReturnDaysList[$i]]['holiday_name'];
		$EmpInTime .= 'In:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],3);
		$p_EmpInTime .= '1|'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],3);
		$EmpOutTime .= 'OT:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],3);
		$p_EmpOutTime .= '1|'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],3);
		
		if(date("a", strtotime($GetUserAttendance[$ReturnDaysList[$i]]['att_out'])) == 'am' && date("h", strtotime($GetUserAttendance[$ReturnDaysList[$i]]['att_out'])) >= '12'){
			$ReturnDateforHours = date('Y-m-d', strtotime("+1 day", strtotime($ReturnDaysList[$i])));
		}  else {
			$ReturnDateforHours = $ReturnDaysList[$i];
		}
		
		$TotalHourdCount = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_in'],$ReturnDateforHours." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out']);
		$p_TNoOfHoursToday .= MinutesConvertHours($TotalHourdCount);
		$OverTimeThirdShiftCount += $TotalHourdCount;
		
			/****************************************************************/
			$GetTotalNoOfOT = 
			CountTimeMinutes($ReturnDaysList[$i]." ".substr($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],0,-3),$ReturnDaysList[$i]." ".
			substr($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],0,-3));
			/****************************************************************/
			//if($GetUserAttendance[$ReturnDaysList[$i]]['ligt_status'] == 1 && $GetUserAttendance[$ReturnDaysList[$i]]['eogt_status'] == 1){
			$MakeLinkPassStage =  base64_encode($GetTotalNoOfOT.'|0');
			if($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 1){
				/****************************************************************/
				$p_OverTimePass_request .= 1;
				//$p_attendance_id .= Route::_('show=otrequestform&otmode='.EncData('hd', 2, $objBF).'&ot='.$GetTotalNoOfOT.'&ati='.EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF));
				$p_attendance_id .= Route::_('show=otrequestform&otmode='.EncData('hd', 2, $objBF).'&ot='.$GetTotalNoOfOT.'&ati='.EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF).'&otp='.$MakeLinkPassStage);
				$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
				/****************************************************************/
			} elseif($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 2){
				/****************************************************************/
				$p_OverTimePass_request .= 2;
				$p_attendance_id .= EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF);
				$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
				/****************************************************************/
			} elseif($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 3){
				/****************************************************************/
				$p_OverTimePass_request .= 3;
				$p_attendance_id .= EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF);
				$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
				$OverTimePass .= '<div class="time-over"></div>';

				$OverTimeThirdShiftCount += $GetTotalNoOfOT;
			
				/****************************************************************/
			} elseif($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 4){
				/****************************************************************/
				$p_OverTimePass_request .= 4;
				$p_attendance_id .= '';
				$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
				/****************************************************************/
			}
			//}
		
	
	/****************************************************************************************************************************/
	/****************************************************************************************************************************/
	/****************************************************************************************************************************/
	} else {
		
		$IFAttnTStorValue = '';
		if(array_key_exists($ReturnDaysList[$i],$GetUserAttendance)){
			
			// Add 1 Day If employee out after 12AM
			
			//echo $ReturnDaysList[$i].'--'.date("h", strtotime($GetUserAttendance[$ReturnDaysList[$i]]['att_out'])).'<br>';
			if(date("a", strtotime($GetUserAttendance[$ReturnDaysList[$i]]['att_out'])) == 'am' && date("h", strtotime($GetUserAttendance[$ReturnDaysList[$i]]['att_out'])) >= '12'){
				$ReturnDateforHours = date('Y-m-d', strtotime("+1 day", strtotime($ReturnDaysList[$i])));
				//echo $ReturnDaysList[$i].'--'.$GetUserAttendance[$ReturnDaysList[$i]]['att_out'].' --- '.date("a", strtotime($GetUserAttendance[$ReturnDaysList[$i]]['att_out'])).'<br>';
			}  else {
				$ReturnDateforHours = $ReturnDaysList[$i];
			}
			
			/***********************************************************/
			/////////////////////////////////////////////////////////////
			/*					  IF Attendance Mark				   */
			/////////////////////////////////////////////////////////////
			/***********************************************************/

			$EmpInTime .= 'In:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],3);
			$p_EmpInTime .= '1|'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],3);
			
				if($ReturnDaysList[$i] == date("Y-m-d")){
					$PassTodayInTime .= RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_in'],3);	
				} else {
					$PassTodayInTime .= '';
				}
	
				if($ReturnDaysList[$i] == date("Y-m-d") && $GetUserAttendance[$ReturnDaysList[$i]]['att_out'] == ''){
					// Im in Office Print.
					$EmpOutTime .= 'I\'m in Office';
					$p_EmpOutTime .= '1|Im in Office';
					$p_TNoOfHoursToday .= 'Im in Office';
					if($ReturnDaysList[$i] == date("Y-m-d")){
					$PassTodayOutTime .= 'I\'m in Office';	
					} else {
					$PassTodayOutTime .= '';
					}
					if($ReturnDaysList[$i] == date("Y-m-d")){
							$PassTodayNumberofHours .= 'I\'m in Office';	
						} else {
							$PassTodayNumberofHours .= '';
						}
				} else {
					if($GetUserAttendance[$ReturnDaysList[$i]]['att_out'] !=''){
						// Attendance OUT Time Print
						$EmpOutTime .= 'OT:'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],3);
						if($ReturnDaysList[$i] == date("Y-m-d")){
						$PassTodayOutTime .= RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],3);	
						} else {
						$PassTodayOutTime .= '';
						}
						$p_EmpOutTime .= '1|'.RemoveLastDig($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],3);
						$TotalHourdCount = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_in'],$ReturnDateforHours." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out']);
						/*************************************************************************************/
						// Total Number of Hours spend in office
						$p_TNoOfHoursToday .= MinutesConvertHours($TotalHourdCount);
						if($ReturnDaysList[$i] == date("Y-m-d")){
							$PassTodayNumberofHours .= MinutesConvertHours($TotalHourdCount);	
						} else {
							$PassTodayNumberofHours .= '';
						}
						/*************************************************************************************/
						
						////////////////////////////////////////////////////////////////////
						// OverTime Checker
						////////////////////////////////////////////////////////////////////
						$NumberofShiftMinutes = $ThisShiftTotalMinutes;
						//$NumberofLOGTMinutes = $GetUserShifts[$GetThisDayName]["shift_logt"];
						$NumberofLOGTMinutes = $ReturnShiftLOGT;
						//$NumberofLIGTMinutes = $GetUserShifts[$GetThisDayName]["shift_ligt"];
						$NumberofLIGTMinutes = $ReturnShiftLIGT;
						$NumberofWorkingMinutes = $TotalHourdCount;

						//$LatInTimeCounter = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_in'],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_st"]);
						$LatInTimeCounter = CountTimeMinutes($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_in'],$ReturnDaysList[$i]." ".$ReturnStartTime);
						$LateInMinCountWithLIGT = $LatInTimeCounter - $NumberofLIGTMinutes;
						/* Below code for Checking */
						/**//************************************************************************/
						/**/ //echo '('.$ReturnDaysList[$i].') - ';
						/**/ //echo $Tstt = $NumberofShiftMinutes + $NumberofLOGTMinutes.' - ';
						/**/ //echo $NumberofWorkingMinutes.' - ';
						/**/ //echo $Tst_2 = $NumberofWorkingMinutes - $Tstt.' - ';
						/**//************************************************************************/
						$TotalShiftMintues = $NumberofShiftMinutes + $NumberofLOGTMinutes;
						//$PassFinalTime = $GetUserShifts[$GetThisDayName]["shift_et"];
						$PassFinalTime = $ReturnEndTime;
						$EndTimeConvert24Hrs = date("H:i", strtotime($PassFinalTime));
						$OverTimeStartAfert = date("H:i", strtotime($EndTimeConvert24Hrs)+(60*$NumberofLOGTMinutes));
						if(substr($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],0,-3) > $OverTimeStartAfert){
							/****************************************************************/
							$GetTotalNoOfOT = 
							CountTimeMinutes($ReturnDaysList[$i]." ".$OverTimeStartAfert,$ReturnDaysList[$i]." ".
							substr($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],0,-3));
							//echo '---'.$GetTotalNoOfOT.'---'.MinutesConvertHours($GetTotalNoOfOT).'---<br>';
							/****************************************************************/
							$GetTodayLateInMintus = round($LateInMinCountWithLIGT);
							//$p_totalnof_mint_ot .= $GetTotalNoOfOT;
							$GetRemainingMinOverTime = $GetTotalNoOfOT - $GetTodayLateInMintus;
							if($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 1){
								/****************************************************************/
								$p_OverTimePass_request .= 1;
								$MakeLinkPassStage =  base64_encode($GetTotalNoOfOT.'|'.$GetTodayLateInMintus);
								//$p_attendance_id .= Route::_('show=otrequestform&ati='.EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF));
								$p_attendance_id .= Route::_('show=otrequestform&otmode='.EncData('hd', 2, $objBF).'&ot='.$GetTotalNoOfOT.'&ati='.EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF).'&otp='.$MakeLinkPassStage);
								$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
								/****************************************************************/
							} elseif($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 2){
								/****************************************************************/
								$p_OverTimePass_request .= 2;
								$p_attendance_id .= EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF);
								$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
								/****************************************************************/
							} elseif($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 3){
								/****************************************************************/
								$p_OverTimePass_request .= 3;
								$p_attendance_id .= EncData($GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'], 2, $objBF);
								$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
								$OverTimePass .= '<div class="time-over"></div>';
								
										if($GetTodayLateInMintus > 0){
											/****************************************************************/
											$OverTimeFirstShiftCount += $GetTodayLateInMintus;
											/****************************************************************/
										} else {
											/****************************************************************/
											if($GetRemainingMinOverTime <= 180){
											/****************************************************************/
											$OverTimeSecondShiftCount += $GetRemainingMinOverTime;
											/****************************************************************/
											} elseif($GetRemainingMinOverTime > 180){
											/****************************************************************/
											$OverTimeSecondShiftCount += $GetRemainingMinOverTime;
											$OverTimeThirdShiftCount += $GetRemainingMinOverTime - 180;
											/****************************************************************/
											}
											/****************************************************************/
										}
							
								/****************************************************************/
							} elseif($GetUserAttendance[$ReturnDaysList[$i]]['overtime_status'] == 4){
								/****************************************************************/
								$p_OverTimePass_request .= 4;
								$p_attendance_id .= '';
								$p_totalnof_mint_ot .= MinutesConvertHours($GetTotalNoOfOT);
								/****************************************************************/
							}
						} else {
							echo '';
						}
						////////////////////////////////////////////////////////////////////
						// Early leaving Checker
						////////////////////////////////////////////////////////////////////
						//$ShiftEoGTAddOne = $GetUserShifts[$GetThisDayName]["shift_eogt"] + 1;
						$ShiftEoGTAddOne = $ReturnShiftEOGT + 1;
						
						if(date("H:i", strtotime(substr($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],0,-3))+(60*$ShiftEoGTAddOne)) < $PassFinalTime && $GetUserAttendance[$ReturnDaysList[$i]]['eogt_status'] == 1){
						//if(date("H:i", strtotime(substr($GetUserAttendance[$ReturnDaysList[$i]]['att_out'],0,-3))+(60*$ShiftEoGTAddOne)) < $PassFinalTime){
						////////////////////////////////////////////////////////////////////
						// Below 100% Leave Apply                      	  /*     100%     */
						////////////////////////////////////////////////////////////////////
						//$_FullLeaveBefore = $GetUserShifts[$GetThisDayName]["full_off_bef"];
						$_FullLeaveBefore = $ReturnShiftFullOffBefore;
						//$_HalfLeaveBeforeStart = $GetUserShifts[$GetThisDayName]["half_off_bef_start"];
						$_HalfLeaveBeforeStart = $ReturnShiftHalfOffBeforeStart;
						//$_HalfLeaveBeforeEnd = $GetUserShifts[$GetThisDayName]["half_off_bef_end"];
						$_HalfLeaveBeforeEnd = $ReturnShiftHalfOffBeforeEnd;
						//$_QtrLeaveBeforeStart = $GetUserShifts[$GetThisDayName]["qutr_off_bef_start"];
						$_QtrLeaveBeforeStart = $ReturnShiftQutrOffBeforeStart;
						//$_QtrLeaveBeforeEnd = $GetUserShifts[$GetThisDayName]["qutr_off_bef_end"];
						$_QtrLeaveBeforeEnd = $ReturnShiftQutrOffBeforeEnd;
						//$_TenLeaveBeforeStart = $GetUserShifts[$GetThisDayName]["ten_off_bef_start"];
						$_TenLeaveBeforeStart = $ReturnShiftTenOffBeforeStart;
						//$_TenLeaveBeforeEnd = $GetUserShifts[$GetThisDayName]["ten_off_bef_end"];
						$_TenLeaveBeforeEnd = $ReturnShiftTenOffBeforeEnd;
						
						
						if($GetUserAttendance[$ReturnDaysList[$i]]['att_out'] < $_FullLeaveBefore && $TotalHourdCount < 480){
							///////////////////////////////////////////////////////////////////////
							// If Employee on Half Day Leave in Second Shift Case Apply Below Start
							///////////////////////////////////////////////////////////////////////
							if(array_key_exists($ReturnDaysList[$i],$GetLeaveRequest)){
								///////////////////////////////////////////////////////////////////////
								// Apply two Case in Employee Leave Case That below
								///////////////////////////////////////////////////////////////////////
								if($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] == 3){
									///////////////////////////////////////////////////////////////////////
									// If Employee Back office on time Case Apply Below Start
									///////////////////////////////////////////////////////////////////////
									$ShortTimeCutting = '';
									$ShortTimeCuttingValue += 0;
									$EarlyOut_100 = '';
									//$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
									$p_EarlyOut .= 0;
									///////////////////////////////////////////////////////////////////////
									// If Employee Back office on time Case Apply Below End
									///////////////////////////////////////////////////////////////////////
								} else {
									///////////////////////////////////////////////////////////////////////
									// Full Day Leave 100% Case Apply Below Start
									///////////////////////////////////////////////////////////////////////
									//$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
									$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$ReturnEndTime);
									$MultiplyHours = $Countmint->h * 60;
									$NumberOfTotalMintus = $MultiplyHours + $Countmint->i;
									$ShortTimeCutting = '1.00';
									$ShortTimeCuttingValue += '1.00';
									$EarlyOut_100 = '<div class="early-out-100">'.$TotalHourdCount.'</div>';
									$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
									///////////////////////////////////////////////////////////////////////
									// Full Day Leave 100% Case Apply Below End
									///////////////////////////////////////////////////////////////////////
								}
							///////////////////////////////////////////////////////////////////////
							// If Employee on Half Day Leave in First Shift Case Apply Below End
							///////////////////////////////////////////////////////////////////////
							} else {
							///////////////////////////////////////////////////////////////////////
							// Full Day Leave 100% Case Apply Below Start
							///////////////////////////////////////////////////////////////////////
								if($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] == 3){
									///////////////////////////////////////////////////////////////////////
									// If Employee Back office on time Case Apply Below Start
									///////////////////////////////////////////////////////////////////////
									$ShortTimeCutting = '';
									$ShortTimeCuttingValue += 0;
									$EarlyOut_100 = '';
									//$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
									$p_EarlyOut .= 0;
									///////////////////////////////////////////////////////////////////////
									// If Employee Back office on time Case Apply Below End
									///////////////////////////////////////////////////////////////////////
								} else {
								//$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
								$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$ReturnEndTime);
								$MultiplyHours = $Countmint->h * 60;
								$NumberOfTotalMintus = $MultiplyHours + $Countmint->i;
								$ShortTimeCutting = '1.00';
								$ShortTimeCuttingValue += '1.00';
								$EarlyOut_100 = '<div class="early-out-100">'.$TotalHourdCount.'</div>';
								$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
								}
							///////////////////////////////////////////////////////////////////////
							// Full Day Leave 100% Case Apply Below End
							///////////////////////////////////////////////////////////////////////
							}
						} elseif($GetUserAttendance[$ReturnDaysList[$i]]['att_out'] > $_HalfLeaveBeforeStart && $GetUserAttendance[$ReturnDaysList[$i]]['att_out'] < $_HalfLeaveBeforeEnd){
							///////////////////////////////////////////////////////////////////////
							// Half Day Leave 50% Case Apply Below Start
							///////////////////////////////////////////////////////////////////////
								if($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] == 3){
									///////////////////////////////////////////////////////////////////////
									// If Employee Back office on time Case Apply Below Start
									///////////////////////////////////////////////////////////////////////
									$ShortTimeCutting = '';
									$ShortTimeCuttingValue += 0;
									$EarlyOut_100 = '';
									//$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
									$p_EarlyOut .= 0;
									///////////////////////////////////////////////////////////////////////
									// If Employee Back office on time Case Apply Below End
									///////////////////////////////////////////////////////////////////////
								} else {
								//$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
								$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$ReturnEndTime);
								$MultiplyHours = $Countmint->h * 60;
								$NumberOfTotalMintus = $MultiplyHours + $Countmint->i;
								$ShortTimeCutting = '0.50';
								$ShortTimeCuttingValue += '0.50';
								$EarlyOut_50 = '<div class="early-out-50"></div>';
								$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
								}
							///////////////////////////////////////////////////////////////////////
							// Half Day Leave 50% Case Apply Below End
							///////////////////////////////////////////////////////////////////////
						} elseif($GetUserAttendance[$ReturnDaysList[$i]]['att_out'] > $_QtrLeaveBeforeStart && $GetUserAttendance[$ReturnDaysList[$i]]['att_out'] < $_QtrLeaveBeforeEnd){
							///////////////////////////////////////////////////////////////////////
							// Quarter Day Leave 25% Case Apply Below Start
							///////////////////////////////////////////////////////////////////////
							//$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
							$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$ReturnEndTime);
							$MultiplyHours = $Countmint->h * 60;
							$NumberOfTotalMintus = $MultiplyHours + $Countmint->i;
							$ShortTimeCutting = '0.25';
							$ShortTimeCuttingValue += '0.25';
							$EarlyOut_25 = '<div class="early-out-25"></div>';
							$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
							///////////////////////////////////////////////////////////////////////
							// Quarter Day Leave 25% Case Apply Below End
							///////////////////////////////////////////////////////////////////////
						} elseif($GetUserAttendance[$ReturnDaysList[$i]]['att_out'] > $_TenLeaveBeforeStart && $GetUserAttendance[$ReturnDaysList[$i]]['att_out'] < $_TenLeaveBeforeEnd){
							///////////////////////////////////////////////////////////////////////
							// Sami-Quarter Day Leave 10% Case Apply Below Start
							///////////////////////////////////////////////////////////////////////
							//$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$GetUserShifts[$GetThisDayName]["shift_et"]);
							$Countmint = GetLeadAssignTime($ReturnDaysList[$i]." ".$GetUserAttendance[$ReturnDaysList[$i]]['att_out'],$ReturnDaysList[$i]." ".$ReturnEndTime);
							$MultiplyHours = $Countmint->h * 60;
							$NumberOfTotalMintus = $MultiplyHours + $Countmint->i;
							$ShortTimeCutting = '0.10';
							$ShortTimeCuttingValue += '0.10';
							$EarlyOut_10 = '<div class="early-out-10"></div>';
							$p_EarlyOut .= MinutesConvertHours($NumberOfTotalMintus);
							///////////////////////////////////////////////////////////////////////
							// Sami-Quarter Leave 10% Case Apply Below End
							///////////////////////////////////////////////////////////////////////
						}
							
						} else {
							echo '';
						}
					
					
					} else {
						$EmpOutTime .= 'Out time missing';	
						$p_EmpOutTime .= '1|Out time missing';	
						$p_TNoOfHoursToday .= 'OTM';
						
					}
				}
			

			/***********************************************************************************************************************/
			// Below Code For Late IN Checking.............
			/***********************************************************************************************************************/
			//$GetInDif = GetTimeCal($ReturnDaysList[$i],date("H:i", strtotime($GetUserShifts[$GetThisDayName]["shift_st"])+(60*$GetUserShifts[$GetThisDayName]["shift_ligt"])), $GetUserAttendance[$ReturnDaysList[$i]]['att_in']);
	
			$GetInDif = GetTimeCal($ReturnDaysList[$i],date("H:i", strtotime($ReturnStartTime)+(60*$ReturnShiftLIGT)), $GetUserAttendance[$ReturnDaysList[$i]]['att_in']);
			/***********************************************************************************************************************/
			/***********************************************************************************************************************/
			// If Employee Late in after Shift Start Time...
			//echo $GetUserShifts[$GetThisDayName]["full_late_in"].' - '.$GetUserShifts[$GetThisDayName]["half_late_in"].' - '.$GetUserShifts[$GetThisDayName]["qutr_late_in"];
			//if($GetUserAttendance[$ReturnDaysList[$i]]['att_in'] > date("H:i", strtotime($GetUserShifts[$GetThisDayName]["shift_st"])+(60*$GetUserShifts[$GetThisDayName]["shift_ligt"]))){
			//if($GetUserAttendance[$ReturnDaysList[$i]]['ligt_status'] == 1 && $GetUserAttendance[$ReturnDaysList[$i]]['eogt_status'] == 1){
			if($GetUserAttendance[$ReturnDaysList[$i]]['att_in'] > date("H:i", strtotime($ReturnStartTime)+(60*$ReturnShiftLIGT)) && $GetUserAttendance[$ReturnDaysList[$i]]['ligt_status'] == 1){
			//if($GetUserAttendance[$ReturnDaysList[$i]]['att_in'] > date("H:i", strtotime($ReturnStartTime)+(60*$ReturnShiftLIGT))){
		
				// Convert Hours into mintues and count total number of mintues
				$GetHouesTimeDiffInMint = trim($GetInDif->h) * 60;
				$GetTotalTimeDiffMint = $GetHouesTimeDiffInMint + $GetInDif->i;
						
						// Get Today Date Total number of Mintues Late
						if($ReturnDaysList[$i] == date("Y-m-d")){
							$TodayLateInTimePass .= $GetTotalTimeDiffMint;	
						} else {
							$TodayLateInTimePass .= '';
						}
					
					// Sum of Total Number of Mintues late IN
					$LateInTotalTimeMint += $GetTotalTimeDiffMint;
				
					////////////////////////////////////////////////////////////////////
					// Below Apply Condition of Late IN 
					////////////////////////////////////////////////////////////////////
					//if($GetTotalTimeDiffMint >= 1 && $GetTotalTimeDiffMint <= trim($GetUserShifts[$GetThisDayName]["qutr_late_in"])){
					if($GetTotalTimeDiffMint >= 1 && $GetTotalTimeDiffMint <= trim($ReturnShiftQutrLateIn)){
						///////////////////////////////////////////////////////////////////////
						// Quarter Day Leave 25% Case Apply Below Start
						///////////////////////////////////////////////////////////////////////
						$LateComingCutting += '0.25';
						$LateIn .= '<div class="late-in-25">'.$GetTotalTimeDiffMint.'</div>';
						$p_LateIn .= '1|'.$GetTotalTimeDiffMint.' Mins';
						///////////////////////////////////////////////////////////////////////
						// Quarter Day Leave 25% Case Apply Below End
						///////////////////////////////////////////////////////////////////////
					//} elseif($GetTotalTimeDiffMint > trim($GetUserShifts[$GetThisDayName]["qutr_late_in"]) && $GetTotalTimeDiffMint <= trim($GetUserShifts[$GetThisDayName]["half_late_in"])){
					} elseif($GetTotalTimeDiffMint > trim($ReturnShiftQutrLateIn) && $GetTotalTimeDiffMint <= trim($ReturnShiftHalfLateIn)){
						///////////////////////////////////////////////////////////////////////
						// Half Day Leave 50% Case Apply Below Start
						///////////////////////////////////////////////////////////////////////
						$LateComingCutting += '0.50';
						$LateIn .= '<div class="late-in-50">'.$GetTotalTimeDiffMint.'</div>';
						$p_LateIn .= '1|'.MinutesConvertHours($GetTotalTimeDiffMint);
						///////////////////////////////////////////////////////////////////////
						// Half Day Leave 50% Case Apply Below End
						///////////////////////////////////////////////////////////////////////
					//} elseif($GetTotalTimeDiffMint > trim($GetUserShifts[$GetThisDayName]["full_late_in"])) {
					} elseif($GetTotalTimeDiffMint > trim($ReturnShiftFullLateIn)) {
						///////////////////////////////////////////////////////////////////////
						// If Employee on Half Day Leave in First Shift Case Apply Below Start
						///////////////////////////////////////////////////////////////////////
						if(array_key_exists($ReturnDaysList[$i],$GetLeaveRequest)){
							///////////////////////////////////////////////////////////////////////
							// Apply two Case in Employee Leave Case That below
							///////////////////////////////////////////////////////////////////////
							if($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] == 2 && $GetTotalTimeDiffMint <= 270){
								///////////////////////////////////////////////////////////////////////
								// If Employee Back office on time Case Apply Below Start
								///////////////////////////////////////////////////////////////////////
								$LateComingCutting += 0;
								$LateIn .= '';
								$p_LateIn .= '';
								///////////////////////////////////////////////////////////////////////
								// If Employee Back office on time Case Apply Below End
								///////////////////////////////////////////////////////////////////////
							} elseif($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] == 2 && $GetTotalTimeDiffMint > 270){
								///////////////////////////////////////////////////////////////////////
								// If Employee late Back office After leave time Case Apply Below Start
								///////////////////////////////////////////////////////////////////////
								$LateComingCutting += '1';
								$LateIn .= '<div class="late-in-100">'.$GetTotalTimeDiffMint.'</div>';
								$p_LateIn .= '1|'.MinutesConvertHours($GetTotalTimeDiffMint);					
								///////////////////////////////////////////////////////////////////////
								// If Employee late Back office After leave time Case Apply Below End
								///////////////////////////////////////////////////////////////////////
							}
						///////////////////////////////////////////////////////////////////////
						// If Employee on Half Day Leave in First Shift Case Apply Below End
						///////////////////////////////////////////////////////////////////////
						} else {
						///////////////////////////////////////////////////////////////////////
						// Full Day Leave 100% Case Apply Below Start
						///////////////////////////////////////////////////////////////////////
						$LateComingCutting += '1';
						$LateIn .= '<div class="late-in-100">'.$GetTotalTimeDiffMint.'</div>';
						$p_LateIn .= '1|'.MinutesConvertHours($GetTotalTimeDiffMint);					
						///////////////////////////////////////////////////////////////////////
						// Full Day Leave 100% Case Apply Below End
						///////////////////////////////////////////////////////////////////////
						}
						
					}
			/***********************************************************************************************************************/
			/***********************************************************************************************************************/
			/***********************************************************************************************************************/	
			} else {
				// Early In Case below (Disable for Now)
				/*if($GetInDif->h == 0){
					if($GetInDif->i > $GetUserShifts[$GetThisDayName]["shift_eigt"]){
					//echo '<br>EI:'.RemaingMinutes($GetInDif->i, $GetUserShifts[$GetThisDayName]["shift_eigt"]).'M<br>';
					}
				} else {
					//echo '<br>EI'.$GetInDif->h.'/'.$GetInDif->i.'<br>';
				}*/
			}
			
			if(array_key_exists($ReturnDaysList[$i],$GetLeaveRequest)){
					$LeaveTextPass = $GetLeaveRequest[$ReturnDaysList[$i]]["leave_name"];
						if($GetLeaveRequest[$ReturnDaysList[$i]]["leave_of"] ==2){
							//Print Half Day Leave
							$TDPrintArrayData .= '&nbsp;<code>Half Day Leave</code>';
						}	
				} else {
				$TDPrintArrayData .= $IFAttnTStorValue;	
				}
			
		} else {
			if($GetUserShifts[$GetThisDayName]["day_status"] == 2){
				if($ReturnDaysList[$i] > date("Y-m-d")){
					$TDPrintArrayData .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
				} else {
					$TDPrintArrayData .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					$TDPrintArrayData .= 'Off Day';
				}
			} else {
				if($ReturnDaysList[$i] > date("Y-m-d")){
					$TDPrintArrayData .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					$TDPrintArrayData .= $LeaveTextPass;
				} else {
					$TDPrintArrayData .= date("jS M, Y", strtotime($ReturnDaysList[$i])).'<br>';
					$AbsentDetail .= $PassText;	
					$p_AbsentDetail .= '1|'.$PassText;
					$TDPrintArrayData .= $LeaveTextPass;
					if($LeaveCheckerPerDay == 0 ){
					$TotalNumberofAbsent += 1.0;
					} else {
					$TotalNumberofAbsent += 0;
					}
				}
			
			}
		}
}
?>


<td<?php echo $tdBGColor;?> id="at<?php echo $GetUserAttendance[$ReturnDaysList[$i]]['attendance_id'];?>ti" title="<?php echo date("D jS M, Y", strtotime($ReturnDaysList[$i]));?>" 
onClick="AttendanceDetailEmp('<?php echo $ReturnDaysList[$i];?>','<?php echo $p_HolidayArray;?>','<?php echo $p_LateIn; ?>','<?php echo $p_LateIn_50; ?>','<?php echo $p_LeaveDetail; ?>','<?php echo $p_AbsentDetail; ?>','<?php echo $p_EarlyOut; ?>','<?php echo date("jS M, Y", strtotime($ReturnDaysList[$i]));?>','<?php echo $GetThisDayName;?>','<?php echo $p_EmpInTime;?>','<?php echo $p_EmpOutTime;?>','<?php echo $p_TNoOfHoursToday;?>','<?php echo $p_OverTimePass_request;?>','<?php echo $p_attendance_id;?>','<?php echo $p_totalnof_mint_ot;?>');">
<?php 
echo $HolidayArray;
echo '<div class="time">'.$EmpInTime.'<br>'.$EmpOutTime.'</div>';
//echo $LateIn_25;
//echo $LateIn_50;
echo $LateIn;
echo $HalfDayLeaveShow;
echo $LeaveDetail;
//echo $AbsentDetail;
if($LeaveCheckerPerDay == 0 ){
echo $AbsentDetail;
}
echo $OverTimePass;
echo $EarlyOut_10;
echo $EarlyOut_25;
echo $EarlyOut_50;
echo $EarlyOut_100;
echo '<div class="cal-date">'.dateFormate_12($ReturnDaysList[$i]).'</div>';
?>
</td>

<?php echo $AddCTrAndOTr;echo $AddLastClose; }
	// END #02
	$HolidayArray = '';
	$EmpInTime = '';
	$EmpOutTime = '';
	$LateIn = '';
	$LateIn_25 = '';
	$LateIn_50 = '';
	$LeaveDetail = '';
	$AbsentDetail = '';
	$EarlyOut_10 = '';
	$EarlyOut_25 = '';
	$EarlyOut_50 = '';
	$EarlyOut_100 = '';
	$OverTimePass = '';
	$HalfDayLeaveShow = '';
	
	$p_HolidayArray = '';
	$p_EmpInTime = '';
	$p_EmpOutTime = '';
	$p_LateIn = '';
	$p_LateIn_25 = '';
	$p_LateIn_50 = '';
	$p_LeaveDetail = '';
	$p_AbsentDetail = '';
	$p_EarlyOut = '';
	$p_TNoOfHoursToday = '';
	$p_OverTimePass_request = '';
	$p_attendance_id = '';
	$p_totalnof_mint_ot = '';
	$LeaveCheckerPerDay = 0;
	}
	// Required Month Days loops END #01
?>