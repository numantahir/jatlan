<?php
/**
*
* This is a class Qayadapplication
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class Qayadapplication extends Database{
	public $aplic_id;

	/**
	* This is the constructor of the class User
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	*/
	public function __construct(){
		parent::__construct();
	}

	/**
	* This is the function to Generate Unique Code for session.
	* @author Numan Tahir
	*/
	function generate_fingerprint(){
		foreach(array('HTTP_HOST', 'HTTP_ACCEPT', 'REMOTE_ADDR', 'SERVER_NAME') 
		as $name) {
			$key[] = empty($_SERVER[$name]) ? NULL : $_SERVER[$name];
		}
		return md5(implode("\0", $key));
	}

	/**
	* This function is used to prepare the Month List
	* @author Numan Tahir
	*/
	public function MonthList($Month_id){
			$MonthList = '';
			if($Month_id==1){
			$MonthList .= '<option value="1" selected>Jan</option>';
			} else {
			$MonthList .= '<option value="1">Jan</option>';
			}
			if($Month_id==2){
			$MonthList .= '<option value="2" selected>Feb</option>';
			} else {
			$MonthList .= '<option value="2">Feb</option>';
			}
			if($Month_id==3){
			$MonthList .= '<option value="3" selected>Mar</option>';
			} else {
			$MonthList .= '<option value="3">Mar</option>';
			}
			if($Month_id==4){
			$MonthList .= '<option value="4" selected>Apr</option>';
			} else {
			$MonthList .= '<option value="4">Apr</option>';
			}
			if($Month_id==5){
			$MonthList .= '<option value="5" selected>May</option>';
			} else {
			$MonthList .= '<option value="5">May</option>';
			}
			if($Month_id==6){
			$MonthList .= '<option value="6" selected>Jun</option>';
			} else {
			$MonthList .= '<option value="6">Jun</option>';
			}
			if($Month_id==7){
			$MonthList .= '<option value="7" selected>Jul</option>';
			} else {
			$MonthList .= '<option value="7">Jul</option>';
			}
			if($Month_id==8){
			$MonthList .= '<option value="8" selected>Aug</option>';
			} else {
			$MonthList .= '<option value="8">Aug</option>';
			}
			if($Month_id==9){
			$MonthList .= '<option value="9" selected>Sep</option>';
			} else {
			$MonthList .= '<option value="9">Sep</option>';
			}
			if($Month_id==10){
			$MonthList .= '<option value="10" selected>Oct</option>';
			} else {
			$MonthList .= '<option value="10">Oct</option>';
			}
			if($Month_id==11){
			$MonthList .= '<option value="11" selected>Nov</option>';
			} else {
			$MonthList .= '<option value="11">Nov</option>';
			}
			if($Month_id==12){
			$MonthList .= '<option value="12" selected>Dec</option>';
			} else {
			$MonthList .= '<option value="12">Dec</option>';
			}
		return $MonthList;	
	}
	
	/**
	* This function is used to prepare the Days List
	* @author Numan Tahir
	*/
	public function DayList($Day_id){
			$Day_list = '';
			for($i=1; $i<=31; $i++){
			if($i == $Day_id){
			$Day_list .= '<option value="' . $i . '" selected>' . $i . '</option>';
			} else {
			$Day_list .= '<option value="' . $i . '">' . $i . '</option>';
			}
			}
		return $Day_list;
	}
	
	/**
	* This function is used to prepare the Year List
	* @author Numan Tahir
	*/
	public function YearList($Year_id){
			$Year_list = '';
			
			for($y=1905; $y<=2011; $y++){
			if($y == $Year_id){
			$Year_list .= '<option value="' . $y . '" selected>' . $y . '</option>';
			} else {
			$Year_list .= '<option value="' . $y . '">' . $y . '</option>';
			}
			}
		return $Year_list;
	}
	
	/**
	* This method is used to the Application Counter
	* @author Numan Tahir
	*/
	public function ApplicationCounter($Aplic_Status){
		$Sql = "SELECT 
					count(payment_overview_id) as AplicCounter
				FROM
					rs_tbl_aplic_payment_overview
				WHERE
					1=1 
					AND payment_mode=".$Aplic_Status;
		$this->dbQuery($Sql);		
		$rows = $this->dbFetchArray(1);
		return $rows["AplicCounter"];
	}
	
	/**
	* This method is used to the Application Customer Name
	* @author Numan Tahir
	*/
	public function ApplicationCustomer($Aplic_customer_id){
		$Sql = "SELECT 
					CONCAT(customer_fname,' ',customer_lname) AS fullname
				FROM
					rs_tbl_customer
				WHERE
					1=1 
					AND customer_id=".$Aplic_customer_id;
		$this->dbQuery($Sql);		
		$rows = $this->dbFetchArray(1);
		return $rows["fullname"];
	}
	
	/**
	* This function is used to list the Applications
	* @author Numan Tahir
	*/
	public function lstApplication(){
		$Sql = "SELECT 
					aplic_id, 
					reg_number,
					property_id,
					property_share_id,
					customer_id,
					user_id,
					nominee_id,
					joint_aplic_opt,
					joint_aplic_id,
					joint_aplic_nominee_id,
					regsiter_project_id,
					registration_type,
					property_type,
					booking_oficr_sign,
					manager_sign,
					seller_sign,
					declaration_status,
					payback_status,
					aplic_desc text,           
					seller_agent_id,
					aplic_type,
					aplic_stage,
					book_propty_till,
					current_payment_status,
					aplic_date,
					isActive,
					temp_lock_id,
					location_id,
					no_of_shares,
					aplic_reg_type
				FROM
					rs_tbl_application 
				WHERE 
					1=1";
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
			
		if($this->isPropertySet("reg_number", "V"))
			$Sql .= " AND reg_number='" . $this->getProperty("reg_number") . "'";
		
		if($this->isPropertySet("search_property", "V")){
			//$Sql .= " AND (user_fname LIKE '%" . $this->getProperty("search_property") . "%' OR LOWER(user_lname) LIKE '%" . $this->getProperty("search_property") . "%')";
			$Sql .= " AND reg_number LIKE '%" . $this->getProperty("search_property") . "%'";
		}
		
		if($this->getProperty("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->getProperty("property_share_id", "V"))
			$Sql .= " AND property_share_id=" . $this->getProperty("property_share_id");
			
		if($this->getProperty("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("nominee_id", "V"))
			$Sql .= " AND nominee_id=" . $this->getProperty("nominee_id");
		
		if($this->getProperty("joint_aplic_id", "V"))
			$Sql .= " AND joint_aplic_id=" . $this->getProperty("joint_aplic_id");
			
		if($this->getProperty("regsiter_project_id", "V"))
			$Sql .= " AND regsiter_project_id=" . $this->getProperty("regsiter_project_id");
		
		if($this->getProperty("registration_type", "V"))
			$Sql .= " AND registration_type=" . $this->getProperty("registration_type");
			
		if($this->getProperty("property_type", "V"))
			$Sql .= " AND property_type=" . $this->getProperty("property_type");
		
		if($this->getProperty("booking_oficr_sign", "V"))
			$Sql .= " AND booking_oficr_sign=" . $this->getProperty("booking_oficr_sign");
			
		if($this->getProperty("manager_sign", "V"))
			$Sql .= " AND manager_sign=" . $this->getProperty("manager_sign");
		
		if($this->getProperty("seller_sign", "V"))
			$Sql .= " AND seller_sign=" . $this->getProperty("seller_sign");
			
		if($this->getProperty("declaration_status", "V"))
			$Sql .= " AND declaration_status=" . $this->getProperty("declaration_status");
		
		if($this->getProperty("payback_status", "V"))
			$Sql .= " AND payback_status=" . $this->getProperty("payback_status");
		
		if($this->getProperty("aplic_desc", "V"))
			$Sql .= " AND aplic_desc='" . $this->getProperty("payback_status") . "'";
		
		if($this->getProperty("seller_agent_id", "V"))
			$Sql .= " AND seller_agent_id=" . $this->getProperty("seller_agent_id");
		
		if($this->getProperty("aplic_type", "V"))
			$Sql .= " AND aplic_type=" . $this->getProperty("aplic_type");
		
		if($this->getProperty("book_propty_till", "V"))
			$Sql .= " AND book_propty_till='" . $this->getProperty("book_propty_till") . "'";
		
		if($this->getProperty("aplic_date", "V"))
			$Sql .= " AND aplic_date='" . $this->getProperty("aplic_date") . "'";
		
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->getProperty("aplic_stage", "V"))
			$Sql .= " AND aplic_stage=" . $this->getProperty("aplic_stage");
		
		if($this->getProperty("joint_aplic_opt", "V"))
			$Sql .= " AND joint_aplic_opt=" . $this->getProperty("joint_aplic_opt");
		
		if($this->getProperty("current_payment_status", "V"))
			$Sql .= " AND current_payment_status=" . $this->getProperty("current_payment_status");
		
		if($this->getProperty("temp_lock_id", "V"))
			$Sql .= " AND temp_lock_id=" . $this->getProperty("temp_lock_id");
		
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->getProperty("no_of_shares", "V"))
			$Sql .= " AND no_of_shares=" . $this->getProperty("no_of_shares");
		
		if($this->getProperty("aplic_reg_type", "V"))
			$Sql .= " AND aplic_reg_type=" . $this->getProperty("aplic_reg_type");
						
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
					
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Application Transfer Detail
	* @author Numan Tahir
	*/
	public function lstApplicationTransferDetail(){
		$Sql = "SELECT 
					tranf_id,
					aplic_id,
					user_id,
					customer_id,
					transf_customer_id,
					transfer_fee,
					transfer_date,
					transfer_status,
					entery_date
				FROM
					rs_tbl_aplic_transfer_detail
				WHERE 
					1=1";
		
		if($this->getProperty("tranf_id", "V"))
			$Sql .= " AND tranf_id=" . $this->getProperty("tranf_id");
		
		if($this->getProperty("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("transf_customer_id", "V"))
			$Sql .= " AND transf_customer_id=" . $this->getProperty("transf_customer_id");
		
		if($this->isPropertySet("transfer_status", "V"))
			$Sql .= " AND transfer_status=" . $this->getProperty("transfer_status");
				
		if($this->isPropertySet("transfer_fee", "V"))
			$Sql .= " AND transfer_fee='" . $this->getProperty("transfer_fee") . "'";
			
		if($this->isPropertySet("transfer_date", "V"))
			$Sql .= " AND transfer_date='" . $this->getProperty("transfer_date") . "'";	
		
		if($this->isPropertySet("entery_date", "V"))
			$Sql .= " AND entery_date='" . $this->getProperty("entery_date") . "'";	
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Property Rent Detail
	* @author Numan Tahir
	*/
	public function lstApplicationPropertyRentDetail(){
		$Sql = "SELECT 
					rent_detail_id,
					rent_id,
					user_id,
					customer_id,
					this_month,
					rent_value,
					transfer_mode,
					payable_date,
					entery_date,
					rent_note
				FROM
					rs_tbl_aplic_property_rent_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("rent_detail_id", "V"))
			$Sql .= " AND rent_detail_id=" . $this->getProperty("rent_detail_id");
		
		if($this->isPropertySet("rent_id", "V"))
			$Sql .= " AND rent_id=" . $this->getProperty("rent_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("this_month", "V"))
			$Sql .= " AND this_month='" . $this->getProperty("this_month") . "'";
			
		if($this->isPropertySet("rent_value", "V"))
			$Sql .= " AND rent_value='" . $this->getProperty("rent_value") . "'";
			
		if($this->isPropertySet("transfer_mode", "V"))
			$Sql .= " AND transfer_mode=" . $this->getProperty("transfer_mode");
			
		if($this->isPropertySet("payable_date", "V"))
			$Sql .= " AND payable_date='" . $this->getProperty("payable_date") . "'";
		
		if($this->isPropertySet("entery_date", "V"))
			$Sql .= " AND entery_date='" . $this->getProperty("entery_date") . "'";
		
		if($this->isPropertySet("rent_note", "V"))
			$Sql .= " AND rent_note='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Property Rent
	* @author Numan Tahir
	*/
	public function lstApplicationPropertyRent(){
		$Sql = "SELECT 
					rent_id,
					aplic_id,
					user_id,
					customer_id,
					monthly_rent,
					rent_date,
					entery_date,
					rent_note
				FROM
					rs_tbl_aplic_property_rent
				WHERE 
					1=1";
		
		if($this->isPropertySet("rent_id", "V"))
			$Sql .= " AND rent_id=" . $this->getProperty("rent_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
			
		if($this->isPropertySet("monthly_rent", "V"))
			$Sql .= " AND monthly_rent='" . $this->getProperty("monthly_rent") . "'";
			
		if($this->isPropertySet("rent_date", "V"))
			$Sql .= " AND rent_date='" . $this->getProperty("rent_date") . "'";
			
		if($this->isPropertySet("entery_date", "V"))
			$Sql .= " AND entery_date='" . $this->getProperty("entery_date") . "'";
		
		if($this->isPropertySet("rent_note", "V"))
			$Sql .= " AND rent_note='" . $this->getProperty("rent_note") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Payment Detail
	* @author Numan Tahir
	*/
	public function lstApplicationPaymentDetail(){
		$Sql = "SELECT 
					payment_id,
					aplic_id,
					user_id,
					customer_id,
					instalment_id,
					receipt_no,
					payment_mode,
					payment_mode_no,
					name_of,
					bank_detail,
					amount_deposit,
					total_amount,
					payment_type,
					deposit_deta,
					installment_date,
					payment_desc
				FROM
					rs_tbl_aplic_payment_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("payment_id", "V"))
			$Sql .= " AND payment_id=" . $this->getProperty("payment_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("instalment_id", "V"))
			$Sql .= " AND instalment_id=" . $this->getProperty("instalment_id");
			
		if($this->isPropertySet("payment_mode", "V"))
			$Sql .= " AND payment_mode=" . $this->getProperty("payment_mode");
			
		if($this->isPropertySet("name_of", "V"))
			$Sql .= " AND name_of='" . $this->getProperty("name_of") . "'";
			
		if($this->isPropertySet("receipt_no", "V"))
			$Sql .= " AND receipt_no='" . $this->getProperty("receipt_no") . "'";
		
		if($this->isPropertySet("amount_deposit", "V"))
			$Sql .= " AND amount_deposit='" . $this->getProperty("amount_deposit") . "'";
		
		if($this->isPropertySet("total_amount", "V"))
			$Sql .= " AND total_amount='" . $this->getProperty("total_amount") . "'";
			
		if($this->isPropertySet("payment_type", "V"))
			$Sql .= " AND payment_type=" . $this->getProperty("payment_type");
			
		if($this->isPropertySet("amount_deposit", "V"))
			$Sql .= " AND amount_deposit='" . $this->getProperty("amount_deposit") . "'";
		
		if($this->isPropertySet("deposit_deta", "V"))
			$Sql .= " AND deposit_deta='" . $this->getProperty("deposit_deta") . "'";
			
		if($this->isPropertySet("installment_date", "V"))
			$Sql .= " AND installment_date='" . $this->getProperty("installment_date") . "'";
			
		if($this->isPropertySet("payment_desc", "V"))
			$Sql .= " AND payment_desc='" . $this->getProperty("payment_desc") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Payback Detail
	* @author Numan Tahir
	*/
	public function lstApplicationPaybackDetail(){
		$Sql = "SELECT 
					pbd_id,
					pb_id,
					user_id,
					customer_id,
					pb_amount,
					pb_amount_type,
					pb_type_detail,
					pb_transfer_date,
					entery_date
				FROM
					rs_tbl_aplic_payback_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("pbd_id", "V"))
			$Sql .= " AND pbd_id=" . $this->getProperty("pbd_id");
		
		if($this->isPropertySet("pb_id", "V"))
			$Sql .= " AND pb_id=" . $this->getProperty("pb_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
			
		if($this->isPropertySet("pb_amount", "V"))
			$Sql .= " AND pb_amount='" . $this->getProperty("pb_amount") . "'";
			
		if($this->isPropertySet("pb_amount_type", "V"))
			$Sql .= " AND pb_amount_type=" . $this->getProperty("pb_amount_type");
			
		if($this->isPropertySet("pb_type_detail", "V"))
			$Sql .= " AND pb_type_detail='" . $this->getProperty("pb_type_detail") . "'";
		
		if($this->isPropertySet("pb_transfer_date", "V"))
			$Sql .= " AND pb_transfer_date='" . $this->getProperty("pb_transfer_date") . "'";
		
		if($this->isPropertySet("entery_date", "V"))
			$Sql .= " AND entery_date='" . $this->getProperty("entery_date") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Payback
	* @author Numan Tahir
	*/
	public function lstApplicationPayback(){
		$Sql = "SELECT 
					pb_id,
					aplic_id,
					user_id,
					customer_id,
					pb_status,
					pb_type,
					pb_cutting_option,
					pb_cutting_value,
					admin_id,
					pb_admin_approval,
					entery_date
				FROM
					rs_tbl_aplic_payback
				WHERE 
					1=1";
		
		if($this->isPropertySet("pb_id", "V"))
			$Sql .= " AND pb_id=" . $this->getProperty("pb_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
			
		if($this->isPropertySet("pb_status", "V"))
			$Sql .= " AND pb_status=" . $this->getProperty("pb_status");
			
		if($this->isPropertySet("pb_type", "V"))
			$Sql .= " AND pb_type=" . $this->getProperty("pb_type");
			
		if($this->isPropertySet("pb_cutting_option", "V"))
			$Sql .= " AND pb_cutting_option=" . $this->getProperty("pb_cutting_option");
		
		if($this->isPropertySet("pb_cutting_value", "V"))
			$Sql .= " AND pb_cutting_value='" . $this->getProperty("pb_cutting_value") . "'";
		
		if($this->isPropertySet("admin_id", "V"))
			$Sql .= " AND admin_id=" . $this->getProperty("admin_id");
		
		if($this->isPropertySet("pb_admin_approval", "V"))
			$Sql .= " AND pb_admin_approval=" . $this->getProperty("pb_admin_approval");
			
		if($this->isPropertySet("entery_date", "V"))
			$Sql .= " AND entery_date='" . $this->getProperty("entery_date") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Log
	* @author Numan Tahir
	*/
	public function lstApplicationLog(){
		$Sql = "SELECT
					rs_tbl_aplic_log.log_id,
					rs_tbl_aplic_log.location_id,
					rs_tbl_application.reg_number,
					rs_tbl_aplic_log.log_desc,
					rs_tbl_aplic_log.entery_date,
					CONCAT(rs_tbl_customer.customer_fname,' ',rs_tbl_customer.customer_lname) AS customer_fullname,
					CONCAT(rs_tbl_users.user_fname,' ',rs_tbl_users.user_lname) AS user_fullname
					FROM
							rs_tbl_aplic_log
						INNER JOIN rs_tbl_customer 
							ON (rs_tbl_aplic_log.customer_id = rs_tbl_customer.customer_id)
						INNER JOIN rs_tbl_users 
							ON (rs_tbl_aplic_log.user_id = rs_tbl_users.user_id)
						INNER JOIN Qayad.rs_tbl_application 
							ON (rs_tbl_aplic_log.aplic_id = rs_tbl_application.aplic_id)
					WHERE  
						1=1";
		
		if($this->isPropertySet("log_id", "V"))
			$Sql .= " AND log_id=" . $this->getProperty("log_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
			
		if($this->isPropertySet("log_desc", "V"))
			$Sql .= " AND log_desc='" . $this->getProperty("log_desc") . "'";
			
		if($this->isPropertySet("entery_date", "V"))
			$Sql .= " AND entery_date='" . $this->getProperty("entery_date") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Installment Detail
	* @author Numan Tahir
	*/
	public function lstApplicationInstallmentDetail(){
		$Sql = "SELECT 
					instalment_id,
					aplic_id,
					propty_payment_id,
					payment_overview_id,
					user_id,
					customer_id,
					instalment_percentage,
					instalment_date,
					instalment_event_id,
					instalment_desc,
					instalment_amount,
					instalment_pay_as,
					instalment_option,
					deposit_deta,
					this_instalment_status,
					type_of_instalment
				FROM
					rs_tbl_aplic_instalment_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("instalment_id", "V"))
			$Sql .= " AND instalment_id=" . $this->getProperty("instalment_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("instalment_event_id", "V"))
			$Sql .= " AND instalment_event_id=" . $this->getProperty("instalment_event_id");
				
		if($this->isPropertySet("propty_payment_id", "V"))
			$Sql .= " AND propty_payment_id=" . $this->getProperty("propty_payment_id");
		
		if($this->isPropertySet("payment_overview_id", "V"))
			$Sql .= " AND payment_overview_id=" . $this->getProperty("payment_overview_id");
				
		if($this->isPropertySet("instalment_desc", "V"))
			$Sql .= " AND instalment_desc='" . $this->getProperty("instalment_desc") . "'";
		
		if($this->isPropertySet("late_installment_date", "V"))
			$Sql .= " AND instalment_date < '" . $this->getProperty("late_installment_date") . "'";
			
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND instalment_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
			
		if($this->isPropertySet("instalment_amount", "V"))
			$Sql .= " AND instalment_amount='" . $this->getProperty("instalment_amount") . "'";
			
		if($this->isPropertySet("deposit_deta", "V"))
			$Sql .= " AND deposit_deta='" . $this->getProperty("deposit_deta") . "'";
		
		if($this->isPropertySet("this_instalment_status", "V"))
			$Sql .= " AND this_instalment_status=" . $this->getProperty("this_instalment_status");
			
		if($this->isPropertySet("type_of_instalment", "V"))
			$Sql .= " AND type_of_instalment=" . $this->getProperty("type_of_instalment");
		
		if($this->isPropertySet("instalment_pay_as", "V"))
			$Sql .= " AND instalment_pay_as=" . $this->getProperty("instalment_pay_as");
		
		if($this->isPropertySet("instalment_option", "V"))
			$Sql .= " AND instalment_option=" . $this->getProperty("instalment_option");
							
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Customer
	* @author Numan Tahir
	*/
	public function lstApplicationCustomer(){
		$Sql = "SELECT 
					customer_id,
					user_id,
					customer_fname,
					customer_lname,
					CONCAT(customer_fname,' ',customer_lname) AS fullname,
					customer_of,
					customer_father,
					customer_email,
					customer_cnic,
					customer_c_address,
					customer_p_address,
					customer_relation_name,
					customer_phone,
					customer_mobile,
					customer_mobile_2,
					customer_image,
					customer_sign,
					customer_type,
					isActive,
					reg_date,
					customer_desc
				FROM
					rs_tbl_customer
				WHERE 
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_of", "V"))
			$Sql .= " AND customer_of='" . $this->getProperty("customer_of") . "'";
			
		if($this->isPropertySet("customer_cnic", "V"))
			$Sql .= " AND customer_cnic=" . $this->getProperty("customer_cnic");
		
		if($this->isPropertySet("customer_passport", "V"))
			$Sql .= " AND customer_passport=" . $this->getProperty("customer_passport");
		
		if($this->isPropertySet("customer_mobile", "V"))
			$Sql .= " AND customer_mobile=" . $this->getProperty("customer_mobile");
		
		if($this->isPropertySet("search_mobile", "V"))
			$Sql .= " AND customer_mobile LIKE '%" . $this->getProperty("search_mobile") . "%'";
		
		if($this->isPropertySet("customer_phone", "V"))
			$Sql .= " AND customer_phone=" . $this->getProperty("customer_phone");
		
		if($this->isPropertySet("customer_type", "V"))
			$Sql .= " AND customer_type=" . $this->getProperty("customer_type");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("customer_email", "V"))
			$Sql .= " AND customer_email='" . $this->getProperty("customer_email") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is General Document
	* @author Numan Tahir
	*/
	public function lstGeneralDocument(){
		$Sql = "SELECT 
					document_id,
					customer_id,
					user_id,
					aplic_id,
					document_name,
					document_type,
					document_desc,
					url_key,
					document_filename,
					isActive,
					entery_date
				FROM
					rs_tbl_general_document
				WHERE 
					1=1";
		
		if($this->isPropertySet("document_id", "V"))
			$Sql .= " AND document_id=" . $this->getProperty("document_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
				
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
		
		if($this->isPropertySet("document_type", "V"))
			$Sql .= " AND document_type='" . $this->getProperty("document_type") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("url_key", "V"))
			$Sql .= " AND url_key='" . $this->getProperty("url_key") . "'";
		
		if($this->isPropertySet("document_filename", "V"))
			$Sql .= " AND document_filename='" . $this->getProperty("document_filename") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Payment Overview
	* @author Numan Tahir
	*/
	public function lstPaymentOverview(){
		$Sql = "SELECT 
					payment_overview_id,
					aplic_id,
					user_id,
					customer_id,
					propty_payment_id,
					rate_per_sq_ft,
					payment_mode,
					overview_note,
					discount_apply,
					discount_option,
					discount_on,
					discount_value,
					instalment_option,
					no_of_instalment,
					instalment_due_on,
					entery_date,
					isActive
				FROM
					rs_tbl_aplic_payment_overview
				WHERE 
					1=1";
		
		if($this->isPropertySet("payment_overview_id", "V"))
			$Sql .= " AND payment_overview_id=" . $this->getProperty("payment_overview_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
				
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
		
		if($this->isPropertySet("propty_payment_id", "V"))
			$Sql .= " AND propty_payment_id=" . $this->getProperty("propty_payment_id");
			
		if($this->isPropertySet("payment_mode", "V"))
			$Sql .= " AND payment_mode=" . $this->getProperty("payment_mode");
		
		if($this->isPropertySet("discount_apply", "V"))
			$Sql .= " AND discount_apply=" . $this->getProperty("discount_apply");
			
		if($this->isPropertySet("discount_option", "V"))
			$Sql .= " AND discount_option=" . $this->getProperty("discount_option");
			
		if($this->isPropertySet("discount_on", "V"))
			$Sql .= " AND discount_on=" . $this->getProperty("discount_on");
		
		if($this->isPropertySet("instalment_option", "V"))
			$Sql .= " AND instalment_option=" . $this->getProperty("instalment_option");
			
		if($this->isPropertySet("no_of_instalment", "V"))
			$Sql .= " AND no_of_instalment=" . $this->getProperty("no_of_instalment");
			
		if($this->isPropertySet("instalment_due_on", "V"))
			$Sql .= " AND instalment_due_on=" . $this->getProperty("instalment_due_on");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Joints & Nominees
	* @author Numan Tahir
	*/
	public function lstAplicJointNominees(){
		$Sql = "SELECT 
					joint_id,
					user_id,
					aplic_id,
					joint_customer_id,
					joint_nominee_customer_id,
					joint_type,
					share_percentage,
					isActive,
					entery_date
				FROM
					rs_tbl_aplic_joint_applicant
				WHERE 
					1=1";
		
		if($this->isPropertySet("joint_id", "V"))
			$Sql .= " AND joint_id=" . $this->getProperty("joint_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
				
		if($this->isPropertySet("joint_customer_id", "V"))
			$Sql .= " AND joint_customer_id=" . $this->getProperty("joint_customer_id");
		
		if($this->isPropertySet("joint_nominee_customer_id", "V"))
			$Sql .= " AND joint_nominee_customer_id=" . $this->getProperty("joint_nominee_customer_id");
			
		if($this->isPropertySet("joint_type", "V"))
			$Sql .= " AND joint_type=" . $this->getProperty("joint_type");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Customer Payment Transfer Detail
	* @author Numan Tahir
	*/
	public function lstAplicCustomerPaymentTransfer(){
		$Sql = "SELECT
					a.cpt_id,
					a.customer_id,
					a.aplic_id,
					a.instalment_id,
					a.transfer_mode,
					a.transfer_from_name,
					a.transfer_from_country,
					a.transfer_from_number,
					a.transfer_from_bank,
					a.transfer_from_swift,
					a.transfer_from_branch,
					a.transfer_amount,
					a.transfer_date,
					a.transfer_to_bank,
					a.transfer_from_filename,
					a.transfer_from_note,
					a.entery_date,
					a.transfer_status,
					a.isActive,
					c.customer_fname,
					c.customer_lname,
					CONCAT(c.customer_fname, ' ', c.customer_lname) as fullname,
					c.customer_mobile,
					b.reg_number
				FROM
					rs_tbl_aplic_customer_payment_transfer as a
					INNER JOIN rs_tbl_application as b
						ON (a.aplic_id = b.aplic_id)
					INNER JOIN rs_tbl_customer as c
						ON (a.customer_id = c.customer_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("cpt_id", "V"))
			$Sql .= " AND a.cpt_id=" . $this->getProperty("cpt_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND a.customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND a.aplic_id=" . $this->getProperty("aplic_id");
				
		if($this->isPropertySet("instalment_id", "V"))
			$Sql .= " AND a.instalment_id=" . $this->getProperty("instalment_id");
		
		if($this->isPropertySet("transfer_mode", "V"))
			$Sql .= " AND a.transfer_mode=" . $this->getProperty("transfer_mode");
			
		if($this->isPropertySet("transfer_status", "V"))
			$Sql .= " AND a.transfer_status=" . $this->getProperty("transfer_status");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND a.isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Detail With Property Info And Customer Info
	* @author Numan Tahir
	*/
	public function lstAplicCompleteSoldDetail(){
		$Sql = "SELECT
					apl.reg_number,
					apl.customer_id,
					apl.user_id,
					apl.aplic_date,
					apl.aplic_reg_type,
					ps.project_id,
					ps.property_id,
					ps.property_share_number,
					ps.property_share_status,
					ps.share_unit_size,
					ps.property_share_id,
					apd.amount_deposit,
					CONCAT(cust.customer_fname, ' ', cust.customer_lname) as customer_fullname,
					cust.customer_phone,
					cust.customer_mobile,
					cust.customer_mobile_2,
					CONCAT(nomi.customer_fname, ' ', nomi.customer_lname) as nominee_fullname
				FROM
					rs_tbl_application as apl
					INNER JOIN rs_tbl_property_shares as ps
						ON (apl.property_share_id = ps.property_share_id)
					INNER JOIN rs_tbl_aplic_payment_detail as apd
						ON (apd.aplic_id = apl.aplic_id)
					INNER JOIN rs_tbl_customer as cust
						ON (apl.customer_id = cust.customer_id)
					INNER JOIN rs_tbl_customer as nomi
						ON (apl.nominee_id = nomi.customer_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND ps.property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("property_share_status", "V"))
			$Sql .= " AND ps.property_share_status=" . $this->getProperty("property_share_status");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Customer Payment Request Counter
	* @author Numan Tahir
	*/
	public function VwCustomerPaymentRequestCounter(){
		$Sql = "SELECT 
					request_counter
				FROM
					vw_customer_payment_request_counter
				WHERE 
					1=1";	
		$this->dbQuery($Sql);
		$RequestCounter = $this->dbFetchArray(1);
		return $RequestCounter["request_counter"];
	}


/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/* 										BELOW FOR API 										*/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/

	/**
	* This function is Basic Information of Register Application, Customer & Agent
	* @author Numan Tahir
	*/
	public function lstBasicApplicationInfo(){
		$Sql = "SELECT
					app.aplic_id,
					app.property_id,
					app.customer_id,
					app.seller_agent_id,
					app.registration_type,
					app.aplic_type,
					app.current_payment_status,
					cu.customer_fname,
					cu.customer_lname,
					cu.customer_mobile,
					cu.customer_cnic,
					us.user_fname,
					us.user_lname,
					us.user_mobile,
					app.isActive
				FROM
					rs_tbl_application as app 
					INNER JOIN rs_tbl_customer as cu 
						ON (app.customer_id = cu.customer_id)
					INNER JOIN rs_tbl_users as us
						ON (app.seller_agent_id = us.user_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND app.property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND app.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("current_payment_status_not", "V"))
			$Sql .= " AND app.current_payment_status!=" . $this->getProperty("current_payment_status_not");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}

/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/

	/**
	* This function is Application Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplications($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_application(
						aplic_id,
						reg_number,
						property_id,
						property_share_id,
						customer_id,
						user_id,
						nominee_id,
						joint_aplic_opt,
						joint_aplic_id,
						joint_aplic_nominee_id,
						regsiter_project_id,
						registration_type,
						property_type,
						booking_oficr_sign,
						manager_sign,
						seller_sign,
						declaration_status,
						payback_status,
						aplic_desc,
						seller_agent_id,
						aplic_type,
						aplic_stage,
						book_propty_till,
						current_payment_status,
						aplic_date,
						isActive,
						temp_lock_id,
						location_id,
						no_of_shares,
						aplic_reg_type) 
						VALUES(";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("reg_number", "V") ? "'" . $this->getProperty("reg_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_share_id", "V") ? $this->getProperty("property_share_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("nominee_id", "V") ? $this->getProperty("nominee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joint_aplic_opt", "V") ? $this->getProperty("joint_aplic_opt") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joint_aplic_id", "V") ? $this->getProperty("joint_aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joint_aplic_nominee_id", "V") ? $this->getProperty("joint_aplic_nominee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("regsiter_project_id", "V") ? $this->getProperty("regsiter_project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("registration_type", "V") ? $this->getProperty("registration_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_type", "V") ? $this->getProperty("property_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("booking_oficr_sign", "V") ? $this->getProperty("booking_oficr_sign") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("manager_sign", "V") ? $this->getProperty("manager_sign") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("seller_sign", "V") ? $this->getProperty("seller_sign") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("declaration_status", "V") ? $this->getProperty("declaration_status") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_status", "V") ? $this->getProperty("payback_status") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_desc", "V") ? "'" . $this->getProperty("aplic_desc") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("seller_agent_id", "V") ? $this->getProperty("seller_agent_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_type", "V") ? $this->getProperty("aplic_type") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_stage", "V") ? $this->getProperty("aplic_stage") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("book_propty_till", "V") ? "'" . $this->getProperty("book_propty_till") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_payment_status", "V") ? "'" . $this->getProperty("current_payment_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_date", "V") ? "'" . $this->getProperty("aplic_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("temp_lock_id", "V") ? "'" . $this->getProperty("temp_lock_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_shares", "V") ? "'" . $this->getProperty("no_of_shares") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_reg_type", "V") ? "'" . $this->getProperty("aplic_reg_type") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_application SET ";
				
				if($this->isPropertySet("customer_id", "K")){
					$Sql .= "$con customer_id=" . $this->getProperty("customer_id");
					$con = ",";
				}
				if($this->isPropertySet("nominee_id", "K")){
					$Sql .= "$con nominee_id=" . $this->getProperty("nominee_id");
					$con = ",";
				}
				if($this->isPropertySet("joint_aplic_id", "K")){
					$Sql .= "$con joint_aplic_id=" . $this->getProperty("joint_aplic_id");
					$con = ",";
				}
				if($this->isPropertySet("declaration_status", "K")){
					$Sql .= "$con declaration_status=" . $this->getProperty("declaration_status");
					$con = ",";
				}
				if($this->isPropertySet("payback_status", "K")){
					$Sql .= "$con payback_status=" . $this->getProperty("payback_status");
					$con = ",";
				}
				if($this->isPropertySet("aplic_desc", "K")){
					$Sql .= "$con aplic_desc='" . $this->getProperty("aplic_desc") . "'";
					$con = ",";
				}
				if($this->isPropertySet("aplic_type", "K")){
					$Sql .= "$con aplic_type='" . $this->getProperty("aplic_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("aplic_stage", "K")){
					$Sql .= "$con aplic_stage='" . $this->getProperty("aplic_stage") . "'";
					$con = ",";
				}
				if($this->isPropertySet("current_payment_status", "K")){
					$Sql .= "$con current_payment_status='" . $this->getProperty("current_payment_status") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id='" . $this->getProperty("aplic_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_application SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Transfer Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationTransferDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_transfer_detail(
						tranf_id,
						aplic_id,
						user_id,
						customer_id,
						transf_customer_id,
						transfer_fee,
						transfer_date,
						transfer_status,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("tranf_id", "V") ? $this->getProperty("tranf_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transf_customer_id", "V") ? $this->getProperty("transf_customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_fee", "V") ? "'" . $this->getProperty("transfer_fee") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_date", "V") ? "'" . $this->getProperty("transfer_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_status", "V") ? $this->getProperty("transfer_status") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_transfer_detail SET ";
				
				if($this->isPropertySet("transfer_fee", "K")){
					$Sql .= "$con transfer_fee='" . $this->getProperty("transfer_fee") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transfer_status", "K")){
					$Sql .= "$con transfer_status=" . $this->getProperty("transfer_status");
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("tranf_id", "V"))
					$Sql .= " AND tranf_id='" . $this->getProperty("tranf_id") . "'";
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Property Rent Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationPropertyRentDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_property_rent_detail(
						rent_detail_id,
						rent_id,
						user_id,
						customer_id,
						this_month,
						rent_value,
						transfer_mode,
						payable_date,
						entery_date,
						rent_note) 
						VALUES(";
				$Sql .= $this->isPropertySet("rent_detail_id", "V") ? $this->getProperty("rent_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_id", "V") ? $this->getProperty("rent_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("this_month", "V") ? "'" . $this->getProperty("this_month") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_value", "V") ? "'" . $this->getProperty("rent_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_mode", "V") ? $this->getProperty("transfer_mode") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payable_date", "V") ? "'" . $this->getProperty("payable_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_note", "V") ? "'" . $this->getProperty("rent_note") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_property_rent_detail SET ";
				
				if($this->isPropertySet("this_month", "K")){
					$Sql .= "$con this_month='" . $this->getProperty("this_month") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rent_value", "K")){
					$Sql .= "$con rent_value=" . $this->getProperty("rent_value");
					$con = ",";
				}
				if($this->isPropertySet("transfer_mode", "K")){
					$Sql .= "$con transfer_mode=" . $this->getProperty("transfer_mode");
					$con = ",";
				}
				if($this->isPropertySet("payable_date", "K")){
					$Sql .= "$con payable_date=" . $this->getProperty("payable_date");
					$con = ",";
				}
				if($this->isPropertySet("rent_note", "K")){
					$Sql .= "$con rent_note=" . $this->getProperty("rent_note");
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("rent_detail_id", "V"))
					$Sql .= " AND rent_detail_id='" . $this->getProperty("rent_detail_id") . "'";
				
				if($this->isPropertySet("rent_id", "V"))
					$Sql .= " AND rent_id='" . $this->getProperty("rent_id") . "'";
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Property Rent (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationPropertyRent($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_property_rent(
						rent_id,
						aplic_id,
						user_id,
						customer_id,
						monthly_rent,
						rent_date,
						entery_date,
						rent_note)
						VALUES(";
				$Sql .= $this->isPropertySet("rent_id", "V") ? $this->getProperty("rent_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_rent", "V") ? "'" . $this->getProperty("monthly_rent") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_date", "V") ? "'" . $this->getProperty("rent_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_note", "V") ? "'" . $this->getProperty("rent_note") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_property_rent SET ";
				
				if($this->isPropertySet("monthly_rent", "K")){
					$Sql .= "$con monthly_rent='" . $this->getProperty("monthly_rent") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rent_date", "K")){
					$Sql .= "$con rent_date='" . $this->getProperty("rent_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rent_note", "K")){
					$Sql .= "$con rent_note='" . $this->getProperty("rent_note") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("rent_id", "V"))
					$Sql .= " AND rent_id='" . $this->getProperty("rent_id") . "'";
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id='" . $this->getProperty("aplic_id") . "'";
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Payment Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationPaymentDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_payment_detail(
						payment_id,
						aplic_id,
						user_id,
						customer_id,
						instalment_id,
						receipt_no,
						payment_mode,
						payment_mode_no,
						name_of,
						bank_detail,
						amount_deposit,
						total_amount,
						payment_type,
						deposit_deta,
						installment_date,
						payment_desc)
						VALUES(";
				$Sql .= $this->isPropertySet("payment_id", "V") ? $this->getProperty("payment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_id", "V") ? $this->getProperty("instalment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("receipt_no", "V") ? "'" . $this->getProperty("receipt_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_mode", "V") ? $this->getProperty("payment_mode") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_mode_no", "V") ? "'" . $this->getProperty("payment_mode_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("name_of", "V") ? "'" . $this->getProperty("name_of") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bank_detail", "V") ? "'" . $this->getProperty("bank_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("amount_deposit", "V") ? "'" . $this->getProperty("amount_deposit") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("total_amount", "V") ? "'" . $this->getProperty("total_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_type", "V") ? $this->getProperty("payment_type") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("deposit_deta", "V") ? "'" . $this->getProperty("deposit_deta") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_date", "V") ? "'" . $this->getProperty("installment_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_desc", "V") ? "'" . $this->getProperty("payment_desc") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_payment_detail SET ";
				
				if($this->isPropertySet("payment_mode", "K")){
					$Sql .= "$con payment_mode=" . $this->getProperty("payment_mode");
					$con = ",";
				}
				if($this->isPropertySet("name_of", "K")){
					$Sql .= "$con name_of='" . $this->getProperty("name_of") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bank_detail", "K")){
					$Sql .= "$con bank_detail='" . $this->getProperty("bank_detail") . "'";
					$con = ",";
				}
				if($this->isPropertySet("amount_deposit", "K")){
					$Sql .= "$con amount_deposit='" . $this->getProperty("amount_deposit") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_amount", "K")){
					$Sql .= "$con total_amount='" . $this->getProperty("total_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payment_desc", "K")){
					$Sql .= "$con payment_desc='" . $this->getProperty("payment_desc") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payment_type", "K")){
					$Sql .= "$con payment_type='" . $this->getProperty("payment_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("receipt_no", "K")){
					$Sql .= "$con receipt_no='" . $this->getProperty("receipt_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payment_mode_no", "K")){
					$Sql .= "$con payment_mode_no='" . $this->getProperty("payment_mode_no") . "'";
					$con = ",";
				}
								
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("payment_id", "V"))
					$Sql .= " AND payment_id='" . $this->getProperty("payment_id") . "'";
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id='" . $this->getProperty("aplic_id") . "'";
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Payback Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationPaybackDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_payback_detail(
						pbd_id,
						pb_id,
						user_id,
						customer_id,
						pb_amount,
						pb_amount_type,
						pb_type_detail,
						pb_transfer_date,
						entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("pbd_id", "V") ? $this->getProperty("pbd_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_id", "V") ? $this->getProperty("pb_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_amount", "V") ? "'" . $this->getProperty("pb_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_amount_type", "V") ? "'" . $this->getProperty("pb_amount_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_type_detail", "V") ? "'" . $this->getProperty("pb_type_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_transfer_date", "V") ? "'" . $this->getProperty("pb_transfer_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_payback_detail SET ";
				
				if($this->isPropertySet("pb_amount", "K")){
					$Sql .= "$con pb_amount='" . $this->getProperty("pb_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("pb_amount_type", "K")){
					$Sql .= "$con pb_amount_type=" . $this->getProperty("pb_amount_type");
					$con = ",";
				}
				if($this->isPropertySet("pb_type_detail", "K")){
					$Sql .= "$con pb_type_detail='" . $this->getProperty("pb_type_detail") . "'";
					$con = ",";
				}
				if($this->isPropertySet("pb_transfer_date", "K")){
					$Sql .= "$con pb_transfer_date='" . $this->getProperty("pb_transfer_date") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("pbd_id", "V"))
					$Sql .= " AND pbd_id='" . $this->getProperty("pbd_id") . "'";
				
				if($this->isPropertySet("pb_id", "V"))
					$Sql .= " AND pb_id='" . $this->getProperty("pb_id") . "'";
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Payback (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationPayback($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_payback(
						pb_id,
						aplic_id,
						user_id,
						customer_id,
						pb_status,
						pb_type,
						pb_cutting_option,
						pb_cutting_value,
						admin_id,
						pb_admin_approval,
						entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("pb_id", "V") ? $this->getProperty("pb_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_status", "V") ? $this->getProperty("pb_status") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_type", "V") ? $this->getProperty("pb_type") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_cutting_option", "V") ? $this->getProperty("pb_cutting_option") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_cutting_value", "V") ? "'" . $this->getProperty("pb_cutting_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("admin_id", "V") ? $this->getProperty("admin_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_admin_approval", "V") ? $this->getProperty("pb_admin_approval") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_payback SET ";
				
				if($this->isPropertySet("pb_status", "K")){
					$Sql .= "$con pb_status=" . $this->getProperty("pb_status");
					$con = ",";
				}
				if($this->isPropertySet("pb_type", "K")){
					$Sql .= "$con pb_type=" . $this->getProperty("pb_type");
					$con = ",";
				}
				if($this->isPropertySet("pb_cutting_option", "K")){
					$Sql .= "$con pb_cutting_option=" . $this->getProperty("pb_cutting_option");
					$con = ",";
				}
				if($this->isPropertySet("pb_cutting_value", "K")){
					$Sql .= "$con pb_cutting_value='" . $this->getProperty("pb_cutting_value") . "'";
					$con = ",";
				}
				if($this->isPropertySet("pb_admin_approval", "K")){
					$Sql .= "$con pb_admin_approval='" . $this->getProperty("pb_admin_approval") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("pb_id", "V"))
					$Sql .= " AND pb_id=" . $this->getProperty("pb_id");
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Log (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_log(
						aplic_id,
						user_id,
						customer_id,
						log_desc,
						entery_date,
						isActive,
						location_id)
						VALUES(";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("log_desc", "V") ? "'" . $this->getProperty("log_desc") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_log SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("log_id", "V"))
					$Sql .= " AND log_id=" . $this->getProperty("log_id");
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_aplic_log SET 
						isActive=3";
										
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("log_id", "V"))
					$Sql .= " AND log_id=" . $this->getProperty("log_id");
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Instalment Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationInstalmentDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_instalment_detail(
						instalment_id,
						aplic_id,
						propty_payment_id,
						payment_overview_id,
						user_id,
						customer_id,
						instalment_percentage,
						instalment_date,
						instalment_event_id,
						instalment_desc,
						instalment_amount,
						instalment_pay_as,
						instalment_option,
						deposit_deta,
						this_instalment_status,
						type_of_instalment)
						VALUES(";
				$Sql .= $this->isPropertySet("instalment_id", "V") ? $this->getProperty("instalment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("propty_payment_id", "V") ? $this->getProperty("propty_payment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_overview_id", "V") ? $this->getProperty("payment_overview_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_percentage", "V") ? "'" . $this->getProperty("instalment_percentage") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_date", "V") ? "'" . $this->getProperty("instalment_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_event_id", "V") ? "'" . $this->getProperty("instalment_event_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_desc", "V") ? "'" . $this->getProperty("instalment_desc") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_amount", "V") ? "'" . $this->getProperty("instalment_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_pay_as", "V") ? "'" . $this->getProperty("instalment_pay_as") . "'" : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_option", "V") ? "'" . $this->getProperty("instalment_option") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("deposit_deta", "V") ? "'" . $this->getProperty("deposit_deta") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("this_instalment_status", "V") ? $this->getProperty("this_instalment_status") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_of_instalment", "V") ? $this->getProperty("type_of_instalment") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_instalment_detail SET ";
				
				if($this->isPropertySet("instalment_percentage", "K")){
					$Sql .= "$con instalment_percentage='" . $this->getProperty("instalment_percentage") . "'";
					$con = ",";
				}
				if($this->isPropertySet("instalment_date", "K")){
					$Sql .= "$con instalment_date='" . $this->getProperty("instalment_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("instalment_event_id", "K")){
					$Sql .= "$con instalment_event_id='" . $this->getProperty("instalment_event_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("instalment_desc", "K")){
					$Sql .= "$con instalment_desc='" . $this->getProperty("instalment_desc") . "'";
					$con = ",";
				}
				if($this->isPropertySet("this_instalment_status", "K")){
					$Sql .= "$con this_instalment_status=" . $this->getProperty("this_instalment_status");
					$con = ",";
				}
				if($this->isPropertySet("type_of_instalment", "K")){
					$Sql .= "$con type_of_instalment=" . $this->getProperty("type_of_instalment");
					$con = ",";
				}
				if($this->isPropertySet("deposit_deta", "K")){
					$Sql .= "$con deposit_deta='" . $this->getProperty("deposit_deta") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("instalment_id", "V"))
					$Sql .= " AND instalment_id=" . $this->getProperty("instalment_id");
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
				
				if($this->isPropertySet("ini_eventid", "V"))
					$Sql .= " AND instalment_event_id=" . $this->getProperty("ini_eventid");
					
				if($this->isPropertySet("ini_status", "V"))
					$Sql .= " AND this_instalment_status=" . $this->getProperty("ini_status");
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Customer (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actApplicationCustomer($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_customer(
						customer_id,
						user_id,
						customer_fname,
						customer_lname,
						customer_of,
						customer_father,
						customer_email,
						customer_cnic,
						customer_passport,
						customer_c_address,
						customer_p_address,
						customer_relation_name,
						customer_phone,
						customer_mobile,
						customer_mobile_2,
						customer_image,
						customer_sign,
						customer_type,
						isActive,
						reg_date,
						customer_desc)
						VALUES(";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_fname", "V") ? "'" . $this->getProperty("customer_fname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_lname", "V") ? "'" . $this->getProperty("customer_lname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_of", "V") ? "'" . $this->getProperty("customer_of") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_father", "V") ? "'" . $this->getProperty("customer_father") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_email", "V") ? "'" . $this->getProperty("customer_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_cnic", "V") ? "'" . $this->getProperty("customer_cnic") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_passport", "V") ? "'" . $this->getProperty("customer_passport") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_c_address", "V") ? "'" . $this->getProperty("customer_c_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_p_address", "V") ? "'" . $this->getProperty("customer_p_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_relation_name", "V") ? "'" . $this->getProperty("customer_relation_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_phone", "V") ? "'" . $this->getProperty("customer_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_mobile", "V") ? "'" . $this->getProperty("customer_mobile") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_mobile_2", "V") ? "'" . $this->getProperty("customer_mobile_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_image", "V") ? "'" . $this->getProperty("customer_image") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_sign", "V") ? "'" . $this->getProperty("customer_sign") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type", "V") ? $this->getProperty("customer_type") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("reg_date", "V") ? "'" . $this->getProperty("reg_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_desc", "V") ? "'" . $this->getProperty("type_of_instalment") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_customer SET ";
				
				if($this->isPropertySet("customer_fname", "K")){
					$Sql .= "$con customer_fname='" . $this->getProperty("customer_fname") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_lname", "K")){
					$Sql .= "$con customer_lname='" . $this->getProperty("customer_lname") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_father", "K")){
					$Sql .= "$con customer_father='" . $this->getProperty("customer_father") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_of", "K")){
					$Sql .= "$con customer_of='" . $this->getProperty("customer_of") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_email", "K")){
					$Sql .= "$con customer_email='" . $this->getProperty("customer_email") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_passport", "K")){
					$Sql .= "$con customer_passport='" . $this->getProperty("customer_passport") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_cnic", "K")){
					$Sql .= "$con customer_cnic='" . $this->getProperty("customer_cnic") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_c_address", "K")){
					$Sql .= "$con customer_c_address='" . $this->getProperty("customer_c_address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_p_address", "K")){
					$Sql .= "$con customer_p_address='" . $this->getProperty("customer_p_address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_relation_name", "K")){
					$Sql .= "$con customer_relation_name='" . $this->getProperty("customer_relation_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_phone", "K")){
					$Sql .= "$con customer_phone='" . $this->getProperty("customer_phone") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_mobile", "K")){
					$Sql .= "$con customer_mobile='" . $this->getProperty("customer_mobile") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_mobile_2", "K")){
					$Sql .= "$con customer_mobile_2='" . $this->getProperty("customer_mobile_2") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_image", "K")){
					$Sql .= "$con customer_image='" . $this->getProperty("customer_image") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_sign", "K")){
					$Sql .= "$con customer_sign='" . $this->getProperty("customer_sign") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				if($this->isPropertySet("customer_desc", "K")){
					$Sql .= "$con customer_desc='" . $this->getProperty("customer_desc") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("customer_id", "V"))
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_customer SET 
							isActive=3";
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("customer_id", "V"))
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is General Document (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actGeneralDocument($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_general_document(
						document_id,
						customer_id,
						user_id,
						aplic_id,
						document_name,
						document_type,
						document_desc,
						url_key,
						isActive,
						entery_date,
						document_filename)
						VALUES(";
				$Sql .= $this->isPropertySet("document_id", "V") ? $this->getProperty("document_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("document_name", "V") ? "'" . $this->getProperty("document_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("document_type", "V") ? $this->getProperty("document_type") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("document_desc", "V") ? "'" . $this->getProperty("document_desc") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("url_key", "V") ? "'" . $this->getProperty("url_key") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("document_filename", "V") ? "'" . $this->getProperty("document_filename") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_general_document SET ";
				
				if($this->isPropertySet("document_name", "K")){
					$Sql .= "$con document_name='" . $this->getProperty("document_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("document_type", "K")){
					$Sql .= "$con document_type='" . $this->getProperty("document_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("document_desc", "K")){
					$Sql .= "$con document_desc='" . $this->getProperty("document_desc") . "'";
					$con = ",";
				}
				if($this->isPropertySet("document_filename", "K")){
					$Sql .= "$con document_filename='" . $this->getProperty("document_filename") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("document_id", "V"))
					$Sql .= " AND document_id=" . $this->getProperty("document_id");
				
				if($this->isPropertySet("customer_id", "V"))
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
					
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_general_document SET 
							isActive=3";
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("document_id", "V"))
					$Sql .= " AND document_id=" . $this->getProperty("document_id");
				
				if($this->isPropertySet("customer_id", "V"))
					$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
					
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is General Document (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPaymentOverview($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_payment_overview(
						payment_overview_id,
						aplic_id,
						user_id,
						customer_id,
						propty_payment_id,
						rate_per_sq_ft,
						payment_mode,
						overview_note,
						discount_apply,
						discount_option,
						discount_on,
						discount_value,
						instalment_option,
						no_of_instalment,
						instalment_due_on,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("payment_overview_id", "V") ? $this->getProperty("payment_overview_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("propty_payment_id", "V") ? $this->getProperty("propty_payment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rate_per_sq_ft", "V") ? "'" . $this->getProperty("rate_per_sq_ft") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_mode", "V") ? $this->getProperty("payment_mode") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overview_note", "V") ? "'" . $this->getProperty("overview_note") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_apply", "V") ? "'" . $this->getProperty("discount_apply") . "'" : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_option", "V") ? "'" . $this->getProperty("discount_option") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_on", "V") ? "'" . $this->getProperty("discount_on") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_value", "V") ? "'" . $this->getProperty("discount_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_option", "V") ? "'" . $this->getProperty("instalment_option") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_instalment", "V") ? "'" . $this->getProperty("no_of_instalment") . "'" : "10";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_due_on", "V") ? "'" . $this->getProperty("instalment_due_on") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_payment_overview SET ";
				
				if($this->isPropertySet("overview_note", "K")){
					$Sql .= "$con overview_note='" . $this->getProperty("overview_note") . "'";
					$con = ",";
				}
				if($this->isPropertySet("discount_apply", "K")){
					$Sql .= "$con discount_apply='" . $this->getProperty("discount_apply") . "'";
					$con = ",";
				}
				if($this->isPropertySet("discount_option", "K")){
					$Sql .= "$con discount_option='" . $this->getProperty("discount_option") . "'";
					$con = ",";
				}
				if($this->isPropertySet("discount_on", "K")){
					$Sql .= "$con discount_on='" . $this->getProperty("discount_on") . "'";
					$con = ",";
				}
				if($this->isPropertySet("discount_value", "K")){
					$Sql .= "$con discount_value='" . $this->getProperty("discount_value") . "'";
					$con = ",";
				}
				if($this->isPropertySet("instalment_option", "K")){
					$Sql .= "$con instalment_option='" . $this->getProperty("instalment_option") . "'";
					$con = ",";
				}
				if($this->isPropertySet("no_of_instalment", "K")){
					$Sql .= "$con no_of_instalment='" . $this->getProperty("no_of_instalment") . "'";
					$con = ",";
				}
				if($this->isPropertySet("instalment_due_on", "K")){
					$Sql .= "$con instalment_due_on='" . $this->getProperty("instalment_due_on") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("payment_overview_id", "V"))
					$Sql .= " AND payment_overview_id=" . $this->getProperty("payment_overview_id");
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_aplic_payment_overview SET 
							isActive=3";
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("payment_overview_id", "V"))
					$Sql .= " AND payment_overview_id=" . $this->getProperty("payment_overview_id");
				
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Joint Applicant & Nominees (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actJointApplicants($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_joint_applicant(
						joint_id,
						user_id,
						aplic_id,
						joint_customer_id,
						joint_nominee_customer_id,
						joint_type,
						share_percentage,
						isActive,
						entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("joint_id", "V") ? $this->getProperty("joint_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joint_customer_id", "V") ? $this->getProperty("joint_customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joint_nominee_customer_id", "V") ? $this->getProperty("joint_nominee_customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joint_type", "V") ? "'" . $this->getProperty("joint_type") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("share_percentage", "V") ? "'" . $this->getProperty("share_percentage") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_joint_applicant SET ";
				
				if($this->isPropertySet("share_percentage", "K")){
					$Sql .= "$con share_percentage='" . $this->getProperty("share_percentage") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("joint_id", "V"))
					$Sql .= " AND joint_id=" . $this->getProperty("joint_id");
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_aplic_joint_applicant SET 
							isActive=3";
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("joint_id", "V"))
					$Sql .= " AND joint_id=" . $this->getProperty("joint_id");
				
				if($this->isPropertySet("aplic_id", "V"))
					$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
				
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Application Customer Payment Transfer (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actAplicCustomerPaymentTransfer($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_aplic_customer_payment_transfer(
						cpt_id,
						customer_id,
						aplic_id,
						instalment_id,
						transfer_mode,
						transfer_from_name,
						transfer_from_country,
						transfer_from_number,
						transfer_from_bank,
						transfer_from_swift,
						transfer_from_branch,
						transfer_amount,
						transfer_date,
						transfer_to_bank,
						transfer_from_filename,
						transfer_from_note,
						entery_date,
						transfer_status,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("cpt_id", "V") ? $this->getProperty("cpt_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("aplic_id", "V") ? $this->getProperty("aplic_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_id", "V") ? $this->getProperty("instalment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_mode", "V") ? $this->getProperty("transfer_mode") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_name", "V") ? "'" . $this->getProperty("transfer_from_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_country", "V") ? "'" . $this->getProperty("transfer_from_country") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_number", "V") ? "'" . $this->getProperty("transfer_from_number") . "'" : "NUL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_bank", "V") ? "'" . $this->getProperty("transfer_from_bank") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_swift", "V") ? "'" . $this->getProperty("transfer_from_swift") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_branch", "V") ? "'" . $this->getProperty("transfer_from_branch") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_amount", "V") ? "'" . $this->getProperty("transfer_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_date", "V") ? "'" . $this->getProperty("transfer_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_to_bank", "V") ? "'" . $this->getProperty("transfer_to_bank") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_filename", "V") ? "'" . $this->getProperty("transfer_from_filename") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_from_note", "V") ? "'" . $this->getProperty("transfer_from_note") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transfer_status", "V") ? "'" . $this->getProperty("transfer_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_aplic_customer_payment_transfer SET ";
				
				if($this->isPropertySet("transfer_status", "K")){
					$Sql .= "$con transfer_status='" . $this->getProperty("transfer_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("cpt_id", "V"))
					$Sql .= " AND cpt_id=" . $this->getProperty("cpt_id");
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_aplic_customer_payment_transfer SET 
							isActive=3";
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("cpt_id", "V"))
					$Sql .= " AND cpt_id=" . $this->getProperty("cpt_id");
				
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