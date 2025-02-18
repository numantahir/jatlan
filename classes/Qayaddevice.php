<?php
/**
*
* This is a class Qayaddevice
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class Qayaddevice extends Database{
	public $sms_template_id;
	public $sms_type_id;

	/**
	* This is the constructor of the class SMS
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	*/
	public function __construct(){
		parent::__construct();
	}
	
	/**
	* This method is used to the Get Device Location Name
	* @author Numan Tahir
	*/
	public function GetDeviceLocation($device_id){
		$Sql = "SELECT
					device_id,
					device_location,
					isActive
				FROM
					rs_tbl_device
				WHERE
					1=1 
					AND device_id='".$device_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['device_location'] . " (" . StatusName($rows['isActive']). ")";
	}
	
	/**
	* This method is used to the Attendance Device Combo
	* @author Numan Tahir
	*/
	public function EmployeeAttendanceCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					device_id,
					device_location
				FROM
					rs_tbl_device
				WHERE
					1=1 
					AND isActive=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['device_id'] == $sel)
				$opt .= "<option value=\"" . $rows['device_id'] . "\" selected>" . $rows['device_location'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['device_id'] . "\">" . $rows['device_location'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This function is used to list the Device
	* @author Numan Tahir
	*/
	public function lstDevice(){
		$Sql = "SELECT 
					device_id,
					user_id,
					device_name,
					device_location,
					device_ip,
					device_port,
					entery_date,
					isActive,
					last_emp_id
				FROM
					rs_tbl_device
				WHERE 
					1=1";
		
		if($this->isPropertySet("device_id", "V"))
			$Sql .= " AND device_id=" . $this->getProperty("device_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the User Device UID
	* @author Numan Tahir
	*/
	public function lstUserDeviceUId(){
		$Sql = "SELECT 
					device_uid,
					employee_name,
					device_id,
					entery_date,
					isActive,
					sync_status,
					push_status
				FROM
					rs_tbl_user_device_uid
				WHERE 
					1=1";
		
		if($this->isPropertySet("device_uid", "V"))
			$Sql .= " AND device_uid=" . $this->getProperty("device_uid");
		
		if($this->getProperty("device_id", "V"))
			$Sql .= " AND device_id=" . $this->getProperty("device_id");
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->getProperty("sync_status", "V"))
			$Sql .= " AND sync_status=" . $this->getProperty("sync_status");
		
		if($this->getProperty("push_status", "V"))
			$Sql .= " AND push_status=" . $this->getProperty("push_status");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Device Log
	* @author Numan Tahir
	*/
	public function lstDeviceLog(){
		$Sql = "SELECT 
					device_log_id,
					device_id,
					device_log,
					fetch_status,
					entery_date,
					isActive
				FROM
					rs_tbl_device_log 
				WHERE 
					1=1";
		
		if($this->isPropertySet("device_log_id", "V"))
			$Sql .= " AND device_log_id=" . $this->getProperty("device_log_id");
		
		if($this->getProperty("device_id", "V"))
			$Sql .= " AND device_id='" . $this->getProperty("device_id") . "'";
		
		if($this->getProperty("fetch_status", "V"))
			$Sql .= " AND fetch_status='" . $this->getProperty("fetch_status") . "'";
				
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
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
	* This function is Device (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actDevice($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_device(
							device_id,
							user_id,
							device_name,
							device_location,
							device_ip,
							device_port,
							entery_date,
							isActive,
							last_emp_id) 
							VALUES(";
				$Sql .= $this->isPropertySet("device_id", "V") ? $this->getProperty("device_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_name", "V") ? "'" . $this->getProperty("device_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_location", "V") ? "'" . $this->getProperty("device_location") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_ip", "V") ? "'" . $this->getProperty("device_ip") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_port", "V") ? "'" . $this->getProperty("device_port") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("last_emp_id", "V") ? $this->getProperty("last_emp_id") : "0";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_device SET ";
				
				if($this->isPropertySet("device_name", "K")){
					$Sql .= "$con device_name='" . $this->getProperty("device_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("device_location", "K")){
					$Sql .= "$con device_location='" . $this->getProperty("device_location") . "'";
					$con = ",";
				}
				if($this->isPropertySet("device_ip", "K")){
					$Sql .= "$con device_ip='" . $this->getProperty("device_ip") . "'";
					$con = ",";
				}
				if($this->isPropertySet("device_port", "K")){
					$Sql .= "$con device_port='" . $this->getProperty("device_port") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("last_emp_id", "K")){
					$Sql .= "$con last_emp_id='" . $this->getProperty("last_emp_id") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("device_id", "V"))
					$Sql .= " AND device_id='" . $this->getProperty("device_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_device SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND device_id=" . $this->getProperty("device_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Short Code (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actDeviceLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_device_log(
							device_id,
							device_log,
							fetch_status,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("device_id", "V") ? "'" . $this->getProperty("device_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_log", "V") ? "'" . $this->getProperty("device_log") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("fetch_status", "V") ? "'" . $this->getProperty("fetch_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_device_log SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("device_log_id", "V"))
					$Sql .= " AND device_log_id='" . $this->getProperty("device_log_id") . "'";
					
				if($this->isPropertySet("device_id", "V"))
					$Sql .= " AND device_id='" . $this->getProperty("device_id") . "'";
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_device_log SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("device_log_id", "V"))
					$Sql .= " AND device_log_id='" . $this->getProperty("device_log_id") . "'";
					
				if($this->isPropertySet("device_id", "V"))
					$Sql .= " AND device_id='" . $this->getProperty("device_id") . "'";
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Device UID (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserDeviceUId($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_device_uid(
							device_uid,
							employee_name,
							device_id,
							entery_date,
							isActive,
							sync_status,
							push_status) 
							VALUES(";
				$Sql .= $this->isPropertySet("device_uid", "V") ? "'" . $this->getProperty("device_uid") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_name", "V") ? "'" . $this->getProperty("employee_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_id", "V") ? "'" . $this->getProperty("device_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sync_status", "V") ? $this->getProperty("sync_status") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("push_status", "V") ? $this->getProperty("push_status") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_device_uid SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sync_status", "K")){
					$Sql .= "$con sync_status='" . $this->getProperty("sync_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("push_status", "K")){
					$Sql .= "$con push_status='" . $this->getProperty("push_status") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("device_uid", "V"))
					$Sql .= " AND device_uid='" . $this->getProperty("device_uid") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_user_device_uid SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("isActive", "V"))
					$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
					
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