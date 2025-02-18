<?php
/**
*
* This is a class Qayadsms
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class Qayadsms extends Database{
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
	* This is the function to the Check Contact Mobile Number
	* @author Numan Tahir
	*/
	public function CheckContactMobile(){
		$Sql = "SELECT 
					contact_id,
					customer_number
				FROM
					rs_tbl_sms_nr_contact_list
				WHERE 
					1=1";
		if($this->isPropertySet("customer_number", "V"))
			$Sql .= " AND customer_number='" . $this->getProperty("customer_number") . "'";
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the SMS Template
	* @author Numan Tahir
	*/
	public function lstSMSTemplate(){
		$Sql = "SELECT 
					sms_template_id,
					user_id,
					sms_title,
					sms_content,
					sms_type_id,
					entery_date,
					isActive
				FROM
					rs_tbl_sms_template
				WHERE 
					1=1";
		
		if($this->isPropertySet("sms_template_id", "V"))
			$Sql .= " AND sms_template_id=" . $this->getProperty("sms_template_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("sms_type_id", "V"))
			$Sql .= " AND sms_type_id='" . $this->getProperty("sms_type_id") . "'";
		
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the SMS Short Code
	* @author Numan Tahir
	*/
	public function lstSMSShortCode(){
		$Sql = "SELECT 
					short_code_id,
					short_code,
					short_code_detail,
					entery_date,
					isActive
				FROM
					rs_tbl_sms_short_codes 
				WHERE 
					1=1";
		
		if($this->isPropertySet("short_code_id", "V"))
			$Sql .= " AND short_code_id=" . $this->getProperty("short_code_id");
		
		if($this->getProperty("short_code", "V"))
			$Sql .= " AND short_code='" . $this->getProperty("short_code") . "'";
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Non Register Contact SMS Sending List
	* @author Numan Tahir
	*/
	public function lstSMSNRContactSendingList(){
		$Sql = "SELECT 
					nr_sending_id,
					user_id,
					customer_number,
					sms_template_id,
					ready_sms_content,
					sending_status,
					sending_time,
					entery_date,
					isActive
				FROM
					rs_tbl_sms_nr_contact_sending_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("nr_sending_id", "V"))
			$Sql .= " AND nr_sending_id=" . $this->getProperty("nr_sending_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("sending_status", "V"))
			$Sql .= " AND sending_status=" . $this->getProperty("sending_status");
				
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Non Register Contact List
	* @author Numan Tahir
	*/
	public function lstSMSNRContactList(){
		$Sql = "SELECT
					rs_tbl_sms_nr_contact_list.contact_id
					, rs_tbl_sms_nr_contact_list.user_id
					, rs_tbl_sms_nr_contact_list.customer_name
					, rs_tbl_sms_nr_contact_list.customer_number
					, rs_tbl_sms_nr_contact_list.customer_cnic
					, rs_tbl_sms_nr_contact_list.customer_note
					, rs_tbl_sms_nr_contact_list.location_id
					, rs_tbl_sms_nr_contact_list.entery_date
					, rs_tbl_sms_nr_contact_list.isActive
					, rs_tbl_users.user_fname
					, rs_tbl_users.user_lname
					, rs_tbl_location.location_name
				FROM
					rs_tbl_sms_nr_contact_list
					INNER JOIN rs_tbl_users 
						ON (rs_tbl_sms_nr_contact_list.user_id = rs_tbl_users.user_id)
					INNER JOIN rs_tbl_location 
						ON (rs_tbl_sms_nr_contact_list.location_id = rs_tbl_location.location_id) 
				WHERE 
					1=1";
		
		if($this->isPropertySet("contact_id", "V"))
			$Sql .= " AND rs_tbl_sms_nr_contact_list.contact_id=" . $this->getProperty("contact_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND rs_tbl_sms_nr_contact_list.user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND rs_tbl_sms_nr_contact_list.isActive=" . $this->getProperty("isActive");
		
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND rs_tbl_sms_nr_contact_list.location_id=" . $this->getProperty("location_id");
		
		if($this->getProperty("data_selection", "V"))
			$Sql .= " AND date(rs_tbl_sms_nr_contact_list.entery_date)=" . $this->getProperty("data_selection");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Register Contact SMS Sending List
	* @author Numan Tahir
	*/
	public function lstSMSContactSendingList(){
		$Sql = "SELECT 
					sending_id,
					customer_id,
					customer_number,
					sms_template_id,
					ready_sms_content,
					transaction_id,
					sending_status,
					sending_time,
					entery_date,
					isActive
				FROM
					rs_tbl_sms_contact_sending_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("sending_id", "V"))
			$Sql .= " AND sending_id=" . $this->getProperty("sending_id");
		
		if($this->getProperty("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->getProperty("sms_template_id", "V"))
			$Sql .= " AND sms_template_id=" . $this->getProperty("sms_template_id");
		
		if($this->getProperty("transaction_id", "V"))
			$Sql .= " AND transaction_id=" . $this->getProperty("transaction_id");
		
		if($this->getProperty("sending_status", "V"))
			$Sql .= " AND sending_status=" . $this->getProperty("sending_status");
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Comment Contact SMS Sending List
	* @author Numan Tahir
	*/
	public function lstSMSContactCommentList(){
		$Sql = "SELECT 
					contact_comment_id,
					contact_id,
					user_id,
					contact_comment,
					contact_status,
					recheck_date,
					entery_date,
					isActive
				FROM
					rs_tbl_sms_contact_comments
				WHERE 
					1=1";
		
		if($this->isPropertySet("contact_id", "V"))
			$Sql .= " AND contact_id=" . $this->getProperty("contact_id");
		
		if($this->isPropertySet("contact_comment_id", "V"))
			$Sql .= " AND contact_comment_id=" . $this->getProperty("contact_comment_id");
			
		if($this->getProperty("contact_status", "V"))
			$Sql .= " AND contact_status=" . $this->getProperty("contact_status");
		
		if($this->getProperty("recheck_date", "V"))
			$Sql .= " AND recheck_date='" . $this->getProperty("recheck_date") . "'";
			
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
	* This function is used to list the SMS Configuration
	* @author Numan Tahir
	*/
	public function lstSMSConfiguration(){
		$Sql = "SELECT 
					setting_id,
					setting_type,
					setting_status,
					entery_date,
					isActive
				FROM
					rs_tbl_sms_configuration
				WHERE 
					1=1";
		
		if($this->isPropertySet("setting_id", "V"))
			$Sql .= " AND setting_id=" . $this->getProperty("setting_id");
		
		if($this->getProperty("setting_type", "V"))
			$Sql .= " AND setting_type=" . $this->getProperty("setting_type");
		
		if($this->getProperty("setting_status", "V"))
			$Sql .= " AND setting_status=" . $this->getProperty("setting_status");
		
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the SMS Log
	* @author Numan Tahir
	*/
	public function lstSMSLog(){
		$Sql = "SELECT 
					sms_log_id,
					sending_id,
					contact_id,
					nr_sending_id,
					sms_template_id,
					user_id,
					type_of_log,
					log_detail,
					entery_date,
					isActive,
					location_id
				FROM
					rs_tbl_sms_log
				WHERE 
					1=1";
		
		if($this->isPropertySet("sms_log_id", "V"))
			$Sql .= " AND sms_log_id=" . $this->getProperty("sms_log_id");
		
		if($this->getProperty("type_of_log", "V"))
			$Sql .= " AND type_of_log=" . $this->getProperty("type_of_log");
		
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the SMS Sending Request
	* @author Numan Tahir
	*/
	public function lstSMSSendingRequest(){
		$Sql = "SELECT 
					sms_request_id,
					user_id,
					sms_template_id,
					sending_option,
					request_status,
					entery_date,
					isActive
				FROM
					rs_tbl_sms_sending_request
				WHERE 
					1=1";
		
		if($this->isPropertySet("sms_request_id", "V"))
			$Sql .= " AND sms_request_id=" . $this->getProperty("sms_request_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("sms_template_id", "V"))
			$Sql .= " AND sms_template_id=" . $this->getProperty("sms_template_id");
		
		if($this->getProperty("sending_option", "V"))
			$Sql .= " AND sending_option=" . $this->getProperty("sending_option");
		
		if($this->getProperty("request_status", "V"))
			$Sql .= " AND request_status=" . $this->getProperty("request_status");
	
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the SMS Sending Request Detail
	* @author Numan Tahir
	*/
	public function lstSMSSendingRequestDetail(){
		$Sql = "SELECT 
					request_detail_id,
					sms_request_id,
					contact_id
				FROM
					rs_tbl_sms_sending_request_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("sms_request_id", "V"))
			$Sql .= " AND sms_request_id=" . $this->getProperty("sms_request_id");
		
		if($this->getProperty("request_detail_id", "V"))
			$Sql .= " AND request_detail_id=" . $this->getProperty("request_detail_id");
		
		if($this->getProperty("contact_id", "V"))
			$Sql .= " AND contact_id=" . $this->getProperty("contact_id");
	
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the SMS Sending Request Detail
	* @author Numan Tahir
	*/
	public function lstSMSSendingLog(){
		$Sql = "SELECT 
					sms_send_log_id,
					sending_option,
					login_user_id,
					sms_send_user_id,
					sms_send_type,
					sms_send_for,
					sms_send_to,
					sms_text_msg,
					sms_send_at
				FROM
					rs_tbl_sms_sending_log
				WHERE 
					1=1";
		
		if($this->isPropertySet("sms_send_log_id", "V"))
			$Sql .= " AND sms_send_log_id=" . $this->getProperty("sms_send_log_id");
	
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
	* This function is SMS Template (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSTemplate($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_template(
							sms_template_id,
							user_id,
							sms_title,
							sms_content,
							sms_type_id,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("sms_template_id", "V") ? $this->getProperty("sms_template_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_title", "V") ? "'" . $this->getProperty("sms_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_content", "V") ? "'" . $this->getProperty("sms_content") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_type_id", "V") ? "'" . $this->getProperty("sms_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_template SET ";
				
				if($this->isPropertySet("sms_title", "K")){
					$Sql .= "$con sms_title='" . $this->getProperty("sms_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sms_content", "K")){
					$Sql .= "$con sms_content='" . $this->getProperty("sms_content") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sms_type_id", "K")){
					$Sql .= "$con sms_type_id='" . $this->getProperty("sms_type_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("sms_template_id", "V"))
					$Sql .= " AND sms_template_id='" . $this->getProperty("sms_template_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_template SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND sms_template_id=" . $this->getProperty("sms_template_id");
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
	public function actSMSShortCode($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_short_codes(
							short_code_id,
							short_code,
							short_code_detail,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("short_code_id", "V") ? $this->getProperty("short_code_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("short_code", "V") ? "'" . $this->getProperty("short_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("short_code_detail", "V") ? "'" . $this->getProperty("short_code_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_short_codes SET ";
				
				if($this->isPropertySet("short_code", "K")){
					$Sql .= "$con short_code='" . $this->getProperty("short_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("short_code_detail", "K")){
					$Sql .= "$con short_code_detail='" . $this->getProperty("short_code_detail") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("short_code_id", "V"))
					$Sql .= " AND short_code_id='" . $this->getProperty("short_code_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_short_codes SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND short_code_id=" . $this->getProperty("short_code_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Non Register Contact Sending List (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSNRContactSendingList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_nr_contact_sending_list(
							nr_sending_id,
							user_id,
							customer_number,
							sms_template_id,
							ready_sms_content,
							sending_status,
							sending_time,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("nr_sending_id", "V") ? $this->getProperty("nr_sending_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_number", "V") ? "'" . $this->getProperty("customer_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_template_id", "V") ? "'" . $this->getProperty("sms_template_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ready_sms_content", "V") ? "'" . $this->getProperty("ready_sms_content") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sending_status", "V") ? "'" . $this->getProperty("sending_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sending_time", "V") ? "'" . $this->getProperty("sending_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_nr_contact_sending_list SET ";
				
				if($this->isPropertySet("customer_number", "K")){
					$Sql .= "$con customer_number='" . $this->getProperty("customer_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sms_template_id", "K")){
					$Sql .= "$con sms_template_id='" . $this->getProperty("sms_template_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sending_status", "K")){
					$Sql .= "$con sending_status='" . $this->getProperty("sending_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sending_time", "K")){
					$Sql .= "$con sending_time='" . $this->getProperty("sending_time") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("nr_sending_id", "V"))
					$Sql .= " AND nr_sending_id='" . $this->getProperty("nr_sending_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_nr_contact_sending_list SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND nr_sending_id=" . $this->getProperty("nr_sending_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Non Register Contact List (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSNRContactList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_nr_contact_list(
							contact_id,
							user_id,
							customer_name,
							customer_number,
							customer_cnic,
							customer_note,
							entery_date,
							isActive,
							location_id) 
							VALUES(";
				$Sql .= $this->isPropertySet("contact_id", "V") ? $this->getProperty("contact_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_name", "V") ? "'" . $this->getProperty("customer_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_number", "V") ? "'" . $this->getProperty("customer_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_cnic", "V") ? "'" . $this->getProperty("customer_cnic") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_note", "V") ? "'" . $this->getProperty("customer_note") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_nr_contact_list SET ";
				
				if($this->isPropertySet("customer_name", "K")){
					$Sql .= "$con customer_name='" . $this->getProperty("customer_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_number", "K")){
					$Sql .= "$con customer_number='" . $this->getProperty("customer_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_note", "K")){
					$Sql .= "$con customer_note='" . $this->getProperty("customer_note") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_cnic", "K")){
					$Sql .= "$con customer_cnic='" . $this->getProperty("customer_cnic") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("contact_id", "V"))
					$Sql .= " AND contact_id='" . $this->getProperty("contact_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_nr_contact_list SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND contact_id=" . $this->getProperty("contact_id");
				break;
			default:
				break;
		}
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Contact Sending List (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actAccountTransaction($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_contact_sending_list(
							sending_id,
							customer_id,
							customer_number,
							sms_template_id,
							ready_sms_content,
							transaction_id,
							sending_status,
							sending_time,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("sending_id", "V") ? $this->getProperty("sending_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_number", "V") ? "'" . $this->getProperty("customer_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_template_id", "V") ? "'" . $this->getProperty("sms_template_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ready_sms_content", "V") ? "'" . $this->getProperty("ready_sms_content") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transaction_id", "V") ? "'" . $this->getProperty("transaction_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sending_status", "V") ? "'" . $this->getProperty("sending_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sending_time", "V") ? "'" . $this->getProperty("sending_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_contact_sending_list SET ";
				
				if($this->isPropertySet("sending_status", "K")){
					$Sql .= "$con sending_status='" . $this->getProperty("sending_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sending_time", "K")){
					$Sql .= "$con sending_time='" . $this->getProperty("sending_time") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("sending_id", "V"))
					$Sql .= " AND sending_id='" . $this->getProperty("sending_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_contact_sending_list SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND sending_id=" . $this->getProperty("sending_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Configuration (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSConfiguration($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_configuration(
							setting_id,
							setting_type,
							setting_status,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("setting_id", "V") ? $this->getProperty("setting_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("setting_type", "V") ? $this->getProperty("setting_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("setting_status", "V") ? "'" . $this->getProperty("setting_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_configuration SET ";
				
				if($this->isPropertySet("setting_status", "K")){
					$Sql .= "$con setting_status='" . $this->getProperty("setting_status") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("setting_id", "V"))
					$Sql .= " AND setting_id='" . $this->getProperty("setting_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_configuration SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND setting_id=" . $this->getProperty("setting_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Log (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_log(
							sending_id,
							contact_id,
							nr_sending_id,
							sms_template_id,
							user_id,
							type_of_log,
							log_detail,
							entery_date,
							isActive,
							location_id) 
							VALUES(";
				$Sql .= $this->isPropertySet("sending_id", "V") ? $this->getProperty("sending_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_id", "V") ? $this->getProperty("contact_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("nr_sending_id", "V") ? $this->getProperty("nr_sending_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_template_id", "V") ? $this->getProperty("sms_template_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_of_log", "V") ? $this->getProperty("type_of_log") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("log_detail", "V") ? "'" . $this->getProperty("log_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_log SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND sms_log_id=" . $this->getProperty("sms_log_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Sending Request (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSSendingRequest($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_sending_request(
							sms_request_id,
							user_id,
							sms_template_id,
							sending_option,
							request_status,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("sms_request_id", "V") ? $this->getProperty("sms_request_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_template_id", "V") ? "'" . $this->getProperty("sms_template_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sending_option", "V") ? "'" . $this->getProperty("sending_option") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_status", "V") ? "'" . $this->getProperty("request_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_sending_request SET ";
				
				if($this->isPropertySet("sending_option", "K")){
					$Sql .= "$con sending_option='" . $this->getProperty("sending_option") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_status", "K")){
					$Sql .= "$con request_status='" . $this->getProperty("request_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("setting_id", "V"))
					$Sql .= " AND setting_id='" . $this->getProperty("setting_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_sending_request SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND sms_request_id=" . $this->getProperty("sms_request_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Comment (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSContactComment($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_contact_comments(
							contact_comment_id,
							contact_id,
							user_id,
							contact_comment,
							contact_status,
							recheck_date,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("contact_comment_id", "V") ? $this->getProperty("contact_comment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_id", "V") ? $this->getProperty("contact_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_comment", "V") ? "'" . $this->getProperty("contact_comment") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_status", "V") ? "'" . $this->getProperty("contact_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("recheck_date", "V") ? "'" . $this->getProperty("recheck_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_sms_contact_comments SET ";
				
				if($this->isPropertySet("contact_comment", "K")){
					$Sql .= "$con contact_comment='" . $this->getProperty("contact_comment") . "'";
					$con = ",";
				}
				if($this->isPropertySet("contact_status", "K")){
					$Sql .= "$con contact_status='" . $this->getProperty("contact_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("contact_comment_id", "V"))
					$Sql .= " AND contact_comment_id='" . $this->getProperty("contact_comment_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_contact_comments SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND contact_comment_id=" . $this->getProperty("contact_comment_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Sending Request Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSSendingRequestDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_sending_request_detail(
							request_detail_id,
							sms_request_id,
							contact_id) 
							VALUES(";
				$Sql .= $this->isPropertySet("request_detail_id", "V") ? $this->getProperty("request_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_request_id", "V") ? $this->getProperty("sms_request_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_id", "V") ? "'" . $this->getProperty("contact_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "D":
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is SMS Sending Log (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSMSSendingLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_sms_sending_log(
							sending_option,
							login_user_id,
							sms_send_user_id,
							sms_send_type,
							sms_send_for,
							sms_send_to,
							sms_text_msg,
							sms_send_at,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("sending_option", "V") ? $this->getProperty("sending_option") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("login_user_id", "V") ? $this->getProperty("login_user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_send_user_id", "V") ? $this->getProperty("sms_send_user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_send_type", "V") ? $this->getProperty("sms_send_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_send_for", "V") ? "'" . $this->getProperty("sms_send_for") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_send_to", "V") ? "'" . $this->getProperty("sms_send_to") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_text_msg", "V") ? "'" . $this->getProperty("sms_text_msg") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_send_at", "V") ? "'" . $this->getProperty("sms_send_at") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_sms_sending_log SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND sms_send_log_id=" . $this->getProperty("sms_send_log_id");
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