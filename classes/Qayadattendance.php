<?php
/**
*
* This is a class Qayadattendance
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class Qayadattendance extends Database{
	public $attendance_id;

	/**
	* This is the constructor of the class SMS
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	*/
	public function __construct(){
		parent::__construct();
	}
	
	/**
	* This function is used to Attendance
	* @author Numan Tahir
	*/
	public function lstAttendance(){
		$Sql = "SELECT 
					attendance_id,
					user_id,
					device_uid,
					att_in,
					att_out,
					att_date,
					day_id,
					day_status,
					att_mode,
					shift_st,
					shift_et,
					shift_ligt,
					shift_logt,
					shift_eogt,
					full_late_in,
					half_late_in,
					qutr_late_in,
					full_off_bef,
					half_off_bef_start,
					half_off_bef_end,
					qutr_off_bef_start,
					qutr_off_bef_end,
					ten_off_bef_start,
					ten_off_bef_end,
					device_id,
					shift_process,
					att_process,
					entery_date,
					reason_overtime,
					overtime_status,
					ligt_status,
					eogt_status
				FROM
					rs_tbl_attendance
				WHERE 
					1=1";
		
		if($this->isPropertySet("attendance_id", "V"))
			$Sql .= " AND attendance_id=" . $this->getProperty("attendance_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("device_uid", "V"))
			$Sql .= " AND device_uid=" . $this->getProperty("device_uid");
				
		if($this->getProperty("device_id", "V"))
			$Sql .= " AND device_id=" . $this->getProperty("device_id");
		
		if($this->getProperty("att_mode", "V"))
			$Sql .= " AND att_mode=" . $this->getProperty("att_mode");
		
		if($this->getProperty("att_process", "V"))
			$Sql .= " AND att_process=" . $this->getProperty("att_process");
		
		if($this->getProperty("day_status", "V"))
			$Sql .= " AND day_status=" . $this->getProperty("day_status");
			
		if($this->getProperty("shift_process", "V"))
			$Sql .= " AND shift_process=" . $this->getProperty("shift_process");
			
		if($this->getProperty("overtime_status", "V"))
			$Sql .= " AND overtime_status=" . $this->getProperty("overtime_status");
		
		if($this->getProperty("overtime_status_not", "V"))
			$Sql .= " AND overtime_status!=" . $this->getProperty("overtime_status_not");
					
		if($this->getProperty("att_date", "V"))
			$Sql .= " AND att_date='" . $this->getProperty("att_date") . "'";
		
		if($this->getProperty("less_att_date", "V"))
			$Sql .= " AND att_date < '" . $this->getProperty("less_att_date") . "'";
			
		if($this->getProperty("outtime_missing", "V"))
			$Sql .= " AND (att_out IS NULL or att_out='00:00:00')";
			
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND att_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
			
		if($this->getProperty("att_in_not", "V"))
			$Sql .= " AND att_in!='" . $this->getProperty("att_in_not") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to User Attendance Leaves
	* @author Numan Tahir
	*/
	public function lstUserAttLeaves(){
		$Sql = "SELECT 
					att_leave_id,
					user_id,
					att_id,
					device_id,
					att_date,
					att_leave_mode,
					att_leave_cutting,
					att_leave_cutting_value,
					entery_date,
					isActive
				FROM
					rs_tbl_user_attendance_leave
				WHERE 
					1=1";
		
		if($this->isPropertySet("att_leave_id", "V"))
			$Sql .= " AND att_leave_id=" . $this->getProperty("att_leave_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("device_id", "V"))
			$Sql .= " AND device_id=" . $this->getProperty("device_id");
			
		if($this->getProperty("att_id", "V"))
			$Sql .= " AND att_id=" . $this->getProperty("att_id");
				
		if($this->getProperty("att_leave_cutting", "V"))
			$Sql .= " AND att_leave_cutting=" . $this->getProperty("att_leave_cutting");
		
		if($this->getProperty("att_leave_cutting_not", "V"))
			$Sql .= " AND att_leave_cutting!=" . $this->getProperty("att_leave_cutting_not");
			
		if($this->getProperty("att_leave_mode", "V"))
			$Sql .= " AND att_leave_mode=" . $this->getProperty("att_leave_mode");
		
		if($this->getProperty("att_date", "V"))
			$Sql .= " AND att_date='" . $this->getProperty("att_date") . "'";
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND att_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
			
		if($this->getProperty("att_id_not", "V"))
			$Sql .= " AND att_id!='" . $this->getProperty("att_id_not") . "'";
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to User Overtime Attendance Request
	* @author Numan Tahir
	*/
	public function lstOvertimeRequest(){
		$Sql = "SELECT 
					attendance_id,
					att_in,
					att_out,
					att_date,
					reason_overtime,
					overtime_status,
					user_id,
					user_fname,
					user_lname,
					company_id,
					department_id,
					location_id,
					teamlead_status,
					job_title_id,
					job_description,
					department_name,
					company_name,
					job_title
				FROM
					vw_overtime_request_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("attendance_id", "V"))
			$Sql .= " AND attendance_id=" . $this->getProperty("attendance_id");
		
		if($this->getProperty("company_id", "V"))
			$Sql .= " AND company_id=" . $this->getProperty("company_id");
		
		if($this->getProperty("department_id", "V"))
			$Sql .= " AND department_id=" . $this->getProperty("department_id");
				
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->getProperty("teamlead_status", "V"))
			$Sql .= " AND teamlead_status=" . $this->getProperty("teamlead_status");
		
		if($this->getProperty("job_title_id", "V"))
			$Sql .= " AND job_title_id=" . $this->getProperty("job_title_id");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to User Approved Overtime List
	* @author Numan Tahir
	*/
	public function lstApprovedOvertimeList(){
		$Sql = "SELECT 
					attendance_id,
					att_in,
					att_out,
					att_date,
					reason_overtime,
					overtime_status,
					user_id,
					user_fname,
					user_lname,
					company_id,
					department_id,
					location_id,
					teamlead_status,
					job_title_id,
					job_description,
					department_name,
					company_name,
					job_title
				FROM
					vw_approved_overtime_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("attendance_id", "V"))
			$Sql .= " AND attendance_id=" . $this->getProperty("attendance_id");
		
		if($this->getProperty("company_id", "V"))
			$Sql .= " AND company_id=" . $this->getProperty("company_id");
		
		if($this->getProperty("department_id", "V"))
			$Sql .= " AND department_id=" . $this->getProperty("department_id");
				
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->getProperty("teamlead_status", "V"))
			$Sql .= " AND teamlead_status=" . $this->getProperty("teamlead_status");
		
		if($this->getProperty("job_title_id", "V"))
			$Sql .= " AND job_title_id=" . $this->getProperty("job_title_id");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to User Manual Attendance Modify
	* @author Numan Tahir
	*/
	public function lstManualAttendance(){
		$Sql = "SELECT 
					manual_attendance_id,
					user_id,
					device_uid,
					att_in,
					att_out,
					att_date,
					day_id,
					modify_by_id,
					isActive,
					entery_date
				FROM
					rs_tbl_attendance_manual
				WHERE 
					1=1";
		
		if($this->isPropertySet("manual_attendance_id", "V"))
			$Sql .= " AND manual_attendance_id=" . $this->getProperty("manual_attendance_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("device_uid", "V"))
			$Sql .= " AND device_uid=" . $this->getProperty("device_uid");
			
		if($this->getProperty("att_date", "V"))
			$Sql .= " AND att_date=" . $this->getProperty("att_date");
				
		if($this->getProperty("day_id", "V"))
			$Sql .= " AND day_id=" . $this->getProperty("day_id");
		
		if($this->getProperty("modify_by_id", "V"))
			$Sql .= " AND modify_by_id=" . $this->getProperty("modify_by_id");
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND att_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/****************************************************************************************************
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	/////////////////////////////////////////////////////////////////////////////////////////////////////
	****************************************************************************************************/
	
	/**
	* This function is Attendance (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actAttendance($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_attendance(
							user_id,
							device_uid,
							att_in,
							att_out,
							att_date,
							day_id,
							att_mode,
							device_id,
							att_process,
							entery_date) 
							VALUES(";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_uid", "V") ? $this->getProperty("device_uid") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_in", "V") ? "'" . $this->getProperty("att_in") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_out", "V") ? "'" . $this->getProperty("att_out") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_date", "V") ? "'" . $this->getProperty("att_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("day_id", "V") ? "'" . $this->getProperty("day_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_mode", "V") ? "'" . $this->getProperty("att_mode") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_id", "V") ? "'" . $this->getProperty("device_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_process", "V") ? "'" . $this->getProperty("att_process") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_attendance SET ";
				
				if($this->isPropertySet("att_in", "K")){
					$Sql .= "$con att_in='" . $this->getProperty("att_in") . "'";
					$con = ",";
				}
				if($this->isPropertySet("att_out", "K")){
					$Sql .= "$con att_out='" . $this->getProperty("att_out") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_st", "K")){
					$Sql .= "$con shift_st='" . $this->getProperty("shift_st") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_et", "K")){
					$Sql .= "$con shift_et='" . $this->getProperty("shift_et") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_ligt", "K")){
					$Sql .= "$con shift_ligt='" . $this->getProperty("shift_ligt") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_logt", "K")){
					$Sql .= "$con shift_logt='" . $this->getProperty("shift_logt") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_eogt", "K")){
					$Sql .= "$con shift_eogt='" . $this->getProperty("shift_eogt") . "'";
					$con = ",";
				}
				if($this->isPropertySet("full_late_in", "K")){
					$Sql .= "$con full_late_in='" . $this->getProperty("full_late_in") . "'";
					$con = ",";
				}
				if($this->isPropertySet("half_late_in", "K")){
					$Sql .= "$con half_late_in='" . $this->getProperty("half_late_in") . "'";
					$con = ",";
				}
				if($this->isPropertySet("qutr_late_in", "K")){
					$Sql .= "$con qutr_late_in='" . $this->getProperty("qutr_late_in") . "'";
					$con = ",";
				}
				if($this->isPropertySet("full_off_bef", "K")){
					$Sql .= "$con full_off_bef='" . $this->getProperty("full_off_bef") . "'";
					$con = ",";
				}
				if($this->isPropertySet("half_off_bef_start", "K")){
					$Sql .= "$con half_off_bef_start='" . $this->getProperty("half_off_bef_start") . "'";
					$con = ",";
				}
				if($this->isPropertySet("half_off_bef_end", "K")){
					$Sql .= "$con half_off_bef_end='" . $this->getProperty("half_off_bef_end") . "'";
					$con = ",";
				}
				if($this->isPropertySet("qutr_off_bef_start", "K")){
					$Sql .= "$con qutr_off_bef_start='" . $this->getProperty("qutr_off_bef_start") . "'";
					$con = ",";
				}
				if($this->isPropertySet("qutr_off_bef_end", "K")){
					$Sql .= "$con qutr_off_bef_end='" . $this->getProperty("qutr_off_bef_end") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ten_off_bef_start", "K")){
					$Sql .= "$con ten_off_bef_start='" . $this->getProperty("ten_off_bef_start") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ten_off_bef_end", "K")){
					$Sql .= "$con ten_off_bef_end='" . $this->getProperty("ten_off_bef_end") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_process", "K")){
					$Sql .= "$con shift_process='" . $this->getProperty("shift_process") . "'";
					$con = ",";
				}
				if($this->isPropertySet("att_mode", "K")){
					$Sql .= "$con att_mode='" . $this->getProperty("att_mode") . "'";
					$con = ",";
				}
				if($this->isPropertySet("att_process", "K")){
					$Sql .= "$con att_process='" . $this->getProperty("att_process") . "'";
					$con = ",";
				}
				if($this->isPropertySet("reason_overtime", "K")){
					$Sql .= "$con reason_overtime='" . $this->getProperty("reason_overtime") . "'";
					$con = ",";
				}
				if($this->isPropertySet("overtime_status", "K")){
					$Sql .= "$con overtime_status='" . $this->getProperty("overtime_status") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("day_status", "K")){
					$Sql .= "$con day_status='" . $this->getProperty("day_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ligt_status", "K")){
					$Sql .= "$con ligt_status='" . $this->getProperty("ligt_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("eogt_status", "K")){
					$Sql .= "$con eogt_status='" . $this->getProperty("eogt_status") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("attendance_id", "V"))
					$Sql .= " AND attendance_id='" . $this->getProperty("attendance_id") . "'";
					
				break;
			case "D":
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Attendance (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserAttLeavs($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_attendance_leave(
							att_leave_id,
							user_id,
							att_id,
							device_id,
							att_date,
							att_leave_mode,
							att_leave_cutting,
							att_leave_cutting_value,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("att_leave_id", "V") ? $this->getProperty("att_leave_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_id", "V") ? "'" . $this->getProperty("att_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_id", "V") ? $this->getProperty("device_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_date", "V") ? "'" . $this->getProperty("att_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_leave_mode", "V") ? "'" . $this->getProperty("att_leave_mode") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_leave_cutting", "V") ? "'" . $this->getProperty("att_leave_cutting") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_leave_cutting_value", "V") ? "'" . $this->getProperty("att_leave_cutting_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_attendance_leave SET ";
				
				if($this->isPropertySet("att_leave_mode", "K")){
					$Sql .= "$con att_leave_mode='" . $this->getProperty("att_leave_mode") . "'";
					$con = ",";
				}
				if($this->isPropertySet("att_leave_cutting", "K")){
					$Sql .= "$con att_leave_cutting='" . $this->getProperty("att_leave_cutting") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}

				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("att_leave_id", "V"))
					$Sql .= " AND att_leave_id='" . $this->getProperty("att_leave_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_user_attendance_leave SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND att_leave_id=" . $this->getProperty("att_leave_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Manual Attendance (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actManualAttendance($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_attendance_manual(
							manual_attendance_id,
							user_id,
							device_uid,
							att_in,
							att_out,
							att_date,
							day_id,
							modify_by_id,
							isActive,
							entery_date) 
							VALUES(";
				$Sql .= $this->isPropertySet("manual_attendance_id", "V") ? $this->getProperty("manual_attendance_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_uid", "V") ? "'" . $this->getProperty("device_uid") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_in", "V") ? "'" . $this->getProperty("att_in") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_out", "V") ? "'" . $this->getProperty("att_out") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_date", "V") ? "'" . $this->getProperty("att_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("day_id", "V") ? "'" . $this->getProperty("day_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("modify_by_id", "V") ? "'" . $this->getProperty("modify_by_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_attendance_manual SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}

				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("manual_attendance_id", "V"))
					$Sql .= " AND manual_attendance_id='" . $this->getProperty("manual_attendance_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_attendance_manual SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND manual_attendance_id=" . $this->getProperty("manual_attendance_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the new code/id for the table.
	* @author Numan Tahir
	* @Date : 29 Oct, 2018
	*/
	public function genCode($table, $field){
		$Sql = "SELECT 
					MAX(" . $field . ") + 1 AS MaxValueR
				FROM 
					" . $table . "
				WHERE
					1=1";
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
		if($rows['MaxValueR'] != NULL && $rows['MaxValueR'] != "")
			return $rows['MaxValueR'];
		else
			return 1;
	}
}
?>