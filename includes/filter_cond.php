<?php
//Shift Start Time
		if($GetUserAttendance[$ReturnDaysList[$i]]['shift_st'] != ""){
			$ReturnStartTime = $GetUserAttendance[$ReturnDaysList[$i]]['shift_st'];
		} else {
			$ReturnStartTime = $GetUserShifts[$GetThisDayName]["shift_st"];
		}
		//Shift End Time
		if($GetUserAttendance[$ReturnDaysList[$i]]['shift_et'] != ""){
			$ReturnEndTime = $GetUserAttendance[$ReturnDaysList[$i]]['shift_et'];
		} else {
			$ReturnEndTime = $GetUserShifts[$GetThisDayName]["shift_et"];
		}
		//Shift LOGT
		if($GetUserAttendance[$ReturnDaysList[$i]]['shift_logt'] != ""){
			$ReturnShiftLOGT = $GetUserAttendance[$ReturnDaysList[$i]]['shift_logt'];
		} else {
			$ReturnShiftLOGT = $GetUserShifts[$GetThisDayName]["shift_logt"];
		}
		//Shift LiGT
		if($GetUserAttendance[$ReturnDaysList[$i]]['shift_ligt'] != ""){
			$ReturnShiftLIGT = $GetUserAttendance[$ReturnDaysList[$i]]['shift_ligt'];
		} else {
			$ReturnShiftLIGT = $GetUserShifts[$GetThisDayName]["shift_ligt"];
		}
		//Shift EOGT
		if($GetUserAttendance[$ReturnDaysList[$i]]['shift_eogt'] != ""){
			$ReturnShiftEOGT = $GetUserAttendance[$ReturnDaysList[$i]]['shift_eogt'];
		} else {
			$ReturnShiftEOGT = $GetUserShifts[$GetThisDayName]["shift_eogt"];
		}
		
		//Shift Full of Before
		if($GetUserAttendance[$ReturnDaysList[$i]]['full_off_bef'] != ""){
			$ReturnShiftFullOffBefore = $GetUserAttendance[$ReturnDaysList[$i]]['full_off_bef'];
		} else {
			$ReturnShiftFullOffBefore = $GetUserShifts[$GetThisDayName]["full_off_bef"];
		}
		//Shift Half of Before Start
		if($GetUserAttendance[$ReturnDaysList[$i]]['half_off_bef_start'] != ""){
			$ReturnShiftHalfOffBeforeStart = $GetUserAttendance[$ReturnDaysList[$i]]['half_off_bef_start'];
		} else {
			$ReturnShiftHalfOffBeforeStart = $GetUserShifts[$GetThisDayName]["half_off_bef_start"];
		}
		//Shift Half of Before End
		if($GetUserAttendance[$ReturnDaysList[$i]]['half_off_bef_end'] != ""){
			$ReturnShiftHalfOffBeforeEnd = $GetUserAttendance[$ReturnDaysList[$i]]['half_off_bef_end'];
		} else {
			$ReturnShiftHalfOffBeforeEnd = $GetUserShifts[$GetThisDayName]["half_off_bef_end"];
		}
		//Shift Qutr of Before Start
		if($GetUserAttendance[$ReturnDaysList[$i]]['qutr_off_bef_start'] != ""){
			$ReturnShiftQutrOffBeforeStart = $GetUserAttendance[$ReturnDaysList[$i]]['qutr_off_bef_start'];
		} else {
			$ReturnShiftQutrOffBeforeStart = $GetUserShifts[$GetThisDayName]["qutr_off_bef_start"];
		}
		//Shift Qutr of Before End
		if($GetUserAttendance[$ReturnDaysList[$i]]['qutr_off_bef_end'] != ""){
			$ReturnShiftQutrOffBeforeEnd = $GetUserAttendance[$ReturnDaysList[$i]]['qutr_off_bef_end'];
		} else {
			$ReturnShiftQutrOffBeforeEnd = $GetUserShifts[$GetThisDayName]["qutr_off_bef_end"];
		}
		//Shift Ten of Before Start
		if($GetUserAttendance[$ReturnDaysList[$i]]['ten_off_bef_start'] != ""){
			$ReturnShiftTenOffBeforeStart = $GetUserAttendance[$ReturnDaysList[$i]]['ten_off_bef_start'];
		} else {
			$ReturnShiftTenOffBeforeStart = $GetUserShifts[$GetThisDayName]["ten_off_bef_start"];
		}
		//Shift Ten of Before End
		if($GetUserAttendance[$ReturnDaysList[$i]]['ten_off_bef_end'] != ""){
			$ReturnShiftTenOffBeforeEnd = $GetUserAttendance[$ReturnDaysList[$i]]['ten_off_bef_end'];
		} else {
			$ReturnShiftTenOffBeforeEnd = $GetUserShifts[$GetThisDayName]["ten_off_bef_end"];
		}
		//Shift Qutr Late In
		if($GetUserAttendance[$ReturnDaysList[$i]]['qutr_late_in'] != ""){
			$ReturnShiftQutrLateIn = $GetUserAttendance[$ReturnDaysList[$i]]['qutr_late_in'];
		} else {
			$ReturnShiftQutrLateIn = $GetUserShifts[$GetThisDayName]["qutr_late_in"];
		}
		//Shift Half Late In
		if($GetUserAttendance[$ReturnDaysList[$i]]['half_late_in'] != ""){
			$ReturnShiftHalfLateIn = $GetUserAttendance[$ReturnDaysList[$i]]['half_late_in'];
		} else {
			$ReturnShiftHalfLateIn = $GetUserShifts[$GetThisDayName]["half_late_in"];
		}
		//Shift Full Late In
		if($GetUserAttendance[$ReturnDaysList[$i]]['full_late_in'] != ""){
			$ReturnShiftFullLateIn = $GetUserAttendance[$ReturnDaysList[$i]]['full_late_in'];
		} else {
			$ReturnShiftFullLateIn = $GetUserShifts[$GetThisDayName]["full_late_in"];
		}
?>