<?php
/**
*
* This is a class Qayadaccount
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class Qayadaccount extends Database{
	public $head_id;

	/**
	* This is the constructor of the class User
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	*/
	public function __construct(){
		parent::__construct();
	}
	
	/**
	* This function is used to list the Heads
	* @author Numan Tahir
	*/
	public function lstHead(){
		$Sql = "SELECT 
					head_id,
					user_id,
					head_code,
					head_title,
					head_group_id,
					head_type_id,
					location_id,
					head_description,
					entity_id,
					head_option,
					entery_date,
					isActive
				FROM
					rs_tbl_account_head 

				WHERE 

					1=1";

		

		if($this->isPropertySet("head_id", "V"))
			$Sql .= " AND head_id=" . $this->getProperty("head_id");		

		if($this->isPropertySet("head_type_id_not", "V"))
			$Sql .= " AND head_type_id!=" . $this->getProperty("head_type_id_not");

		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("head_code", "V"))
			$Sql .= " AND head_code='" . $this->getProperty("head_code") . "'";
		
		if($this->getProperty("head_group_id", "V"))
			$Sql .= " AND head_group_id=" . $this->getProperty("head_group_id");

		if($this->getProperty("head_type_id", "V"))
			$Sql .= " AND head_type_id=" . $this->getProperty("head_type_id");
		
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->getProperty("head_option", "V"))
			$Sql .= " AND head_option=" . $this->getProperty("head_option");
			
		if($this->getProperty("entity_id", "V"))
			$Sql .= " AND entity_id=" . $this->getProperty("entity_id");
	
		if($this->getProperty("head_type_id_array", "V"))
			$Sql .= " AND head_type_id IN (" . $this->getProperty("head_type_id_array") . ")";
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}

	

	/**

	* This function is used to list the Head Group

	* @author Numan Tahir

	*/

	public function lstHeadGroup(){

		$Sql = "SELECT 

					head_group_id,

					user_id,

					group_title,

					entery_date,

					isActive,

					location_id

				FROM

					rs_tbl_account_head_group 

				WHERE 

					1=1";

		

		if($this->isPropertySet("head_group_id", "V"))

			$Sql .= " AND head_group_id=" . $this->getProperty("head_group_id");

		

		if($this->getProperty("user_id", "V"))

			$Sql .= " AND user_id=" . $this->getProperty("user_id");

			

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

	* This function is used to list the Head Items

	* @author Numan Tahir

	*/

	public function lstHeadItems(){

		$Sql = "SELECT 
					item_id,
					user_id,
					head_id,
					head_type,
					item_title,
					item_description,
					entery_date,
					isActive,
					location_id
				FROM
					rs_tbl_account_head_items 
				WHERE 
					1=1";

		if($this->isPropertySet("item_id", "V"))
			$Sql .= " AND item_id=" . $this->getProperty("item_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("head_id", "V"))
			$Sql .= " AND head_id=" . $this->getProperty("head_id");
		
		if($this->getProperty("item_id_array", "V"))
			$Sql .= " AND item_id IN (" . $this->getProperty("item_id_array") . ")";
			
		if($this->getProperty("head_type", "V"))
			$Sql .= " AND head_type=" . $this->getProperty("head_type");
				
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

	* This function is used to list the Account log

	* @author Numan Tahir

	*/

	public function lstAccountLog(){

		$Sql = "SELECT 

					account_log_id,

					entery_id,

					user_id,

					entery_type,

					log_desc,

					location_id,

					entery_date,

					isActive

				FROM

					rs_tbl_account_log

				WHERE 

					1=1";

		

		if($this->isPropertySet("account_log_id", "V"))

			$Sql .= " AND account_log_id=" . $this->getProperty("account_log_id");

		

		if($this->getProperty("user_id", "V"))

			$Sql .= " AND user_id=" . $this->getProperty("user_id");

		

		if($this->getProperty("entery_id", "V"))

			$Sql .= " AND entery_id=" . $this->getProperty("entery_id");

		

		if($this->getProperty("location_id", "V"))

			$Sql .= " AND location_id=" . $this->getProperty("location_id");

			

		if($this->getProperty("entery_type", "V"))

			$Sql .= " AND entery_type=" . $this->getProperty("entery_type");

					

		if($this->getProperty("isActive", "V"))

			$Sql .= " AND isActive=" . $this->getProperty("isActive");

		

		if($this->isPropertySet("ORDERBY", "V"))

			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		

		if($this->isPropertySet("limit", "V"))

			$Sql .= $this->appendLimit($this->getProperty("limit"));

			

		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is used to list the Account Transaction

	* @author Numan Tahir

	*/

	public function lstAccountTransaction(){
		$Sql = "SELECT 
					transaction_id,
					user_id,
					head_id,
					item_id,
					transfer_head_id,
					transfer_item_id,
					transfer_mode,
					transaction_number,
					trans_title,
					trans_note,
					trans_mode,
					trans_type,
					aplic_mode,
					pay_mode,
					entery_id,
					pay_mode_no,
					trans_amount,
					item_qty,
					trans_date,
					trans_status,
					location_id,
					entery_date,
					isActive,
					trans_position,
					tran_code
				FROM
					rs_tbl_account_transaction
				WHERE 
					1=1";
		
		if($this->isPropertySet("transaction_id", "V"))
			$Sql .= " AND transaction_id=" . $this->getProperty("transaction_id");
		
		if($this->isPropertySet("last_transaction", "V"))
			$Sql .= " AND transaction_id < " . $this->getProperty("last_transaction");

		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("head_id", "V"))
			$Sql .= " AND head_id=" . $this->getProperty("head_id");
		
		if($this->getProperty("head_id_array", "V"))
			$Sql .= " AND head_id IN (" . $this->getProperty("head_id_array") . ")";
			
		if($this->getProperty("item_id", "V"))
			$Sql .= " AND item_id=" . $this->getProperty("item_id");
		
		if($this->getProperty("transfer_head_id", "V"))
			$Sql .= " AND transfer_head_id=" . $this->getProperty("transfer_head_id");
			
		if($this->getProperty("transfer_item_id", "V"))
			$Sql .= " AND transfer_item_id=" . $this->getProperty("transfer_item_id");
			
		if($this->getProperty("transaction_number", "V"))
			$Sql .= " AND transaction_number='" . $this->getProperty("transaction_number") . "'";
		
		if($this->getProperty("pay_mode_array", "V"))
			$Sql .= " AND pay_mode IN (" . $this->getProperty("pay_mode_array") . ")";
			
		if($this->getProperty("trans_mode", "V"))
			$Sql .= " AND trans_mode=" . $this->getProperty("trans_mode");
		
		if($this->getProperty("item_qty", "V"))
			$Sql .= " AND item_qty='" . $this->getProperty("item_qty")."'";
		
		if($this->getProperty("trans_title", "V"))
			$Sql .= " AND trans_title='" . $this->getProperty("trans_title")."'";
				
		if($this->getProperty("daybook_filter", "V"))
			$Sql .= " AND (pay_mode=1 or aplic_mode=8)";
			
		if($this->getProperty("trans_type", "V"))
			$Sql .= " AND trans_type=" . $this->getProperty("trans_type");
		
		if($this->getProperty("trans_type_not", "V"))
			$Sql .= " AND trans_type!=" . $this->getProperty("trans_type_not");
			
		if($this->getProperty("aplic_mode", "V"))
			$Sql .= " AND aplic_mode=" . $this->getProperty("aplic_mode");
			
		if($this->getProperty("pay_mode", "V"))
			$Sql .= " AND pay_mode=" . $this->getProperty("pay_mode");
		
		if($this->getProperty("entery_id", "V"))
			$Sql .= " AND entery_id=" . $this->getProperty("entery_id");	
		
		if($this->getProperty("pay_mode_no", "V"))
			$Sql .= " AND pay_mode_no='" . $this->getProperty("pay_mode_no") . "'";
		
		if($this->getProperty("trans_date", "V"))
			$Sql .= " AND trans_date='" . $this->getProperty("trans_date") . "'";	
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND trans_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
		
		if($this->getProperty("trans_status", "V"))
			$Sql .= " AND trans_status=" . $this->getProperty("trans_status");	
		
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");	
		
		if($this->getProperty("trans_position", "V"))
			$Sql .= " AND trans_position=" . $this->getProperty("trans_position");	
							
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->getProperty("tran_code", "V"))
			$Sql .= " AND tran_code=" . $this->getProperty("tran_code");
			
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		

		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		return $this->dbQuery($Sql);
	}

	
	
	/**
	* This function is used to list the Bank Account Status
	* @author Numan Tahir
	*/
	public function OverAllAccountStatus(){
		$Sql = "SELECT
					rs_tbl_account_head.head_type_id
					, rs_tbl_account_head.head_id
					, SUM(IF(rs_tbl_account_transaction.trans_mode = 1, rs_tbl_account_transaction.trans_amount, 0)) AS TotaDebit
					, SUM(IF(rs_tbl_account_transaction.trans_mode = 2, rs_tbl_account_transaction.trans_amount, 0)) AS TotalCredit
				FROM
					rs_tbl_account_transaction
					INNER JOIN rs_tbl_account_head 
						ON (rs_tbl_account_transaction.head_id = rs_tbl_account_head.head_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("head_type_id", "V"))
			$Sql .= " AND rs_tbl_account_head.head_type_id=" . $this->getProperty("head_type_id");
		
		if($this->isPropertySet("entity_id", "V"))
			$Sql .= " AND rs_tbl_account_head.entity_id=" . $this->getProperty("entity_id");
		
		if($this->isPropertySet("pay_mode", "V"))
			$Sql .= " AND rs_tbl_account_transaction.pay_mode=" . $this->getProperty("pay_mode");
				
		if($this->isPropertySet("item_id", "V"))
			$Sql .= " AND rs_tbl_account_transaction.item_id=" . $this->getProperty("item_id");
		
		if($this->isPropertySet("trans_type", "V"))
			$Sql .= " AND rs_tbl_account_transaction.trans_type=" . $this->getProperty("trans_type");
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND rs_tbl_account_transaction.trans_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND rs_tbl_account_transaction.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("head_id", "V"))
			$Sql .= " AND rs_tbl_account_head.head_id=" . $this->getProperty("head_id");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Bank Account Status
	* @author Numan Tahir
	*/
	public function VwBankAccountStatus(){
		$Sql = "SELECT 
					head_id,
					head_code,
					head_title,
					total_debit,
					total_credit
				FROM
					vw_bank_account_status
				WHERE 
					1=1";
		
		if($this->isPropertySet("head_id", "V"))
			$Sql .= " AND head_id=" . $this->getProperty("head_id");
		
		if($this->getProperty("entity_id", "V"))
			$Sql .= " AND entity_id=" . $this->getProperty("entity_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}

	/**
	* This function is used to list the Investor Head Status
	* @author Numan Tahir
	*/
	public function VwInvestorStatus(){
		$Sql = "SELECT 
					head_id,
					head_code,
					head_title,
					entity_id,
					total_debit,
					total_credit
				FROM
				vw_investor_head
				WHERE 
					1=1";
		
		if($this->isPropertySet("head_id", "V"))
			$Sql .= " AND head_id=" . $this->getProperty("head_id");
		
		if($this->getProperty("entity_id", "V"))
			$Sql .= " AND entity_id=" . $this->getProperty("entity_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}

	/**
	* This function is used to list the Project Head Status
	* @author Numan Tahir
	*/
	public function VwProjectStatus(){
		$Sql = "SELECT 
					head_id,
					head_code,
					head_title,
					entity_id,
					total_debit,
					total_credit
				FROM
					vw_project_head
				WHERE 
					1=1";
		
		if($this->isPropertySet("head_id", "V"))
			$Sql .= " AND head_id=" . $this->getProperty("head_id");
		
		if($this->getProperty("entity_id", "V"))
			$Sql .= " AND entity_id=" . $this->getProperty("entity_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}

	

	/**

	* This function is used to list the General Item Status

	* @author Numan Tahir

	*/

	public function VwGeneralItemStatus(){

		$Sql = "SELECT 

					head_id,

					item_id,

					head_code,

					head_title,

					item_title,

					total_debit,

					total_credit

				FROM

					vw_general_item_status

				WHERE 

					1=1";

		

		if($this->isPropertySet("head_id", "V"))

			$Sql .= " AND head_id=" . $this->getProperty("head_id");

		

		if($this->getProperty("item_id", "V"))

			$Sql .= " AND item_id=" . $this->getProperty("item_id");

		

		if($this->isPropertySet("ORDERBY", "V"))

			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		

		if($this->isPropertySet("limit", "V"))

			$Sql .= $this->appendLimit($this->getProperty("limit"));



		return $this->dbQuery($Sql);

	}

	/**
	* This function is used to list the General Item Status
	* @author Numan Tahir
	*/
	public function VwEmployeeHeadStatus(){
		$Sql = "SELECT 
					head_id,
					head_code,
					head_title,
					total_debit,
					total_credit
				FROM
					vw_employee_head
				WHERE 
					1=1";
		
		if($this->isPropertySet("head_id", "V"))
			$Sql .= " AND head_id=" . $this->getProperty("head_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}	

	/**

	* This function is used to list the Property Head Status

	* @author Numan Tahir

	*/

	public function VwPropertyHeadStatus(){

		$Sql = "SELECT 

					head_id,

					head_title,

					head_code,

					total_debit,

					total_credit

				FROM

					vw_property_head_status

				WHERE 

					1=1";

		

		if($this->isPropertySet("head_id", "V"))

			$Sql .= " AND head_id=" . $this->getProperty("head_id");

		

		if($this->isPropertySet("ORDERBY", "V"))

			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		

		if($this->isPropertySet("limit", "V"))

			$Sql .= $this->appendLimit($this->getProperty("limit"));



		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is used to list the Property Head Status

	* @author Numan Tahir

	*/

	public function VwPropertyVsLedger(){

		$Sql = "SELECT 

					property_id,

					property_number,

					property_area,

					property_registered_id,

					property_rent_sqft,

					property_status,

					book_duration,

					property_section,

					floor_name,

					total_amount_received,

					total_down_payment,

					total_installment_amount,

					total_full_amount

				FROM

					vw_property_vs_ledger

				WHERE 

					1=1";

		

		if($this->isPropertySet("property_id", "V"))

			$Sql .= " AND property_id=" . $this->getProperty("property_id");

		

		if($this->isPropertySet("ORDERBY", "V"))

			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		

		if($this->isPropertySet("limit", "V"))

			$Sql .= $this->appendLimit($this->getProperty("limit"));



		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is used to list the Cash Head Status

	* @author Numan Tahir

	*/

	public function VwCashHead(){

		$Sql = "SELECT 

					head_id,

					head_code,

					head_title,

					total_debit,

					total_credit

				FROM

					vw_cash_head

				WHERE 

					1=1";

		

		if($this->isPropertySet("head_id", "V"))

			$Sql .= " AND head_id=" . $this->getProperty("head_id");

		

		if($this->isPropertySet("ORDERBY", "V"))

			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		

		if($this->isPropertySet("limit", "V"))

			$Sql .= $this->appendLimit($this->getProperty("limit"));



		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is used to list the Payment Info Detail

	* @author Numan Tahir

	*/

	public function lstPaymentModeInfo(){

		$Sql = "SELECT 

					pm_info_id,

					user_id,

					pm_mode_id,

					pm_mode_title,

					m_mode_detail,

					entery_date,

					isActive

				FROM

					rs_tbl_account_payment_mode_info

				WHERE 

					1=1";

		

		if($this->isPropertySet("pm_info_id", "V"))

			$Sql .= " AND pm_info_id=" . $this->getProperty("pm_info_id");

		

		if($this->isPropertySet("user_id", "V"))

			$Sql .= " AND user_id=" . $this->getProperty("user_id");

		

		if($this->isPropertySet("pm_mode_id", "V"))

			$Sql .= " AND pm_mode_id=" . $this->getProperty("pm_mode_id");

		

		if($this->isPropertySet("isActive", "V"))

			$Sql .= " AND isActive=" . $this->getProperty("isActive");

			

		if($this->isPropertySet("ORDERBY", "V"))

			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");

		

		if($this->isPropertySet("limit", "V"))

			$Sql .= $this->appendLimit($this->getProperty("limit"));



		return $this->dbQuery($Sql);

	}

	
	/**
	* This function is used to list the Payment Info Detail
	* @author Numan Tahir
	*/
	public function lstWrongTransactions(){
		$Sql = "SELECT 
					wrong_transaction_id,
					user_id,
					transaction_no,
					credit_tran_id,
					debit_tran_id,
					transaction_date,
					wrong_reason,
					wrong_tran_type,
					entery_date,
					isActive
				FROM
					rs_tbl_wrong_tranasction_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("wrong_transaction_id", "V"))
			$Sql .= " AND wrong_transaction_id=" . $this->getProperty("wrong_transaction_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("transaction_no", "V"))
			$Sql .= " AND transaction_no='" . $this->getProperty("transaction_no") . "'";
		
		if($this->isPropertySet("credit_tran_id", "V"))
			$Sql .= " AND credit_tran_id=" . $this->getProperty("credit_tran_id");
			
		if($this->isPropertySet("debit_tran_id", "V"))
			$Sql .= " AND debit_tran_id=" . $this->getProperty("debit_tran_id");
		
		if($this->isPropertySet("wrong_tran_type", "V"))
			$Sql .= " AND wrong_tran_type=" . $this->getProperty("wrong_tran_type");
				
		if($this->isPropertySet("isActive", "V"))
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

	* This function is Account Head (Delete/Update/Add)

	* @author Numan Tahir

	*/

	public function actHead($mode = "I"){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_account_head(
							head_id,
							user_id,
							head_code,
							head_title,
							head_group_id,
							head_type_id,
							location_id,
							head_description,
							entity_id,
							head_option,
							entery_date,

							isActive) 

							VALUES(";

				$Sql .= $this->isPropertySet("head_id", "V") ? $this->getProperty("head_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_code", "V") ? "'" . $this->getProperty("head_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_title", "V") ? "'" . $this->getProperty("head_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_group_id", "V") ? "'" . $this->getProperty("head_group_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_type_id", "V") ? "'" . $this->getProperty("head_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_description", "V") ? "'" . $this->getProperty("head_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entity_id", "V") ? "'" . $this->getProperty("entity_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_option", "V") ? "'" . $this->getProperty("head_option") . "'" : 1;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;

			case "U":

				$Sql = "UPDATE rs_tbl_account_head SET ";

				
				if($this->isPropertySet("head_option", "K")){

					$Sql .= "$con head_option='" . $this->getProperty("head_option") . "'";

					$con = ",";

				}
				if($this->isPropertySet("head_code", "K")){

					$Sql .= "$con head_code='" . $this->getProperty("head_code") . "'";

					$con = ",";

				}

				if($this->isPropertySet("head_group_id", "K")){

					$Sql .= "$con head_group_id='" . $this->getProperty("head_group_id") . "'";

					$con = ",";

				}

				if($this->isPropertySet("head_title", "K")){

					$Sql .= "$con head_title='" . $this->getProperty("head_title") . "'";

					$con = ",";

				}

				if($this->isPropertySet("head_description", "K")){

					$Sql .= "$con head_description='" . $this->getProperty("head_description") . "'";

					$con = ",";

				}

				if($this->isPropertySet("isActive", "K")){

					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";

					$con = ",";

				}

				$Sql .= " WHERE 1=1";

				

				if($this->isPropertySet("head_id", "V"))

					$Sql .= " AND head_id='" . $this->getProperty("head_id") . "'";

					

				break;

			case "D":

				$Sql = "UPDATE rs_tbl_account_head SET 

							isActive=3

						WHERE

							1=1";

				$Sql .= " AND head_id=" . $this->getProperty("head_id");

				break;

			default:

				break;

		}

		

		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is Account Head (Delete/Update/Add)

	* @author Numan Tahir

	*/

	public function actHeadGroup($mode = "I"){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_account_head_group(

							head_group_id,

							user_id,

							group_title,

							entery_date,

							isActive,

							location_id) 

							VALUES(";

				$Sql .= $this->isPropertySet("head_group_id", "V") ? $this->getProperty("head_group_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("group_title", "V") ? "'" . $this->getProperty("group_title") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";

				$Sql .= ")";

				break;

			case "U":

				$Sql = "UPDATE rs_tbl_account_head_group SET ";

				

				if($this->isPropertySet("group_title", "K")){

					$Sql .= "$con group_title='" . $this->getProperty("group_title") . "'";

					$con = ",";

				}

				if($this->isPropertySet("isActive", "K")){

					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";

					$con = ",";

				}

				$Sql .= " WHERE 1=1";

				

				if($this->isPropertySet("head_group_id", "V"))

					$Sql .= " AND head_group_id='" . $this->getProperty("head_group_id") . "'";

					

				break;

			case "D":

				$Sql = "UPDATE rs_tbl_account_head_group SET 

							isActive=3

						WHERE

							1=1";

				$Sql .= " AND head_group_id=" . $this->getProperty("head_group_id");

				break;

			default:

				break;

		}

		

		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is Account Head (Delete/Update/Add)

	* @author Numan Tahir

	*/

	public function actHeadItems($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_account_head_items(
							item_id,
							user_id,
							head_id,
							head_type,
							item_title,
							item_description,
							entery_date,
							isActive,
							location_id) 
							VALUES(";
				$Sql .= $this->isPropertySet("item_id", "V") ? $this->getProperty("item_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_id", "V") ? $this->getProperty("head_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("head_type", "V") ? $this->getProperty("head_type") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("item_title", "V") ? "'" . $this->getProperty("item_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("item_description", "V") ? "'" . $this->getProperty("item_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_account_head_items SET ";
				
				if($this->isPropertySet("head_type", "K")){
					$Sql .= "$con head_type='" . $this->getProperty("head_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("item_title", "K")){
					$Sql .= "$con item_title='" . $this->getProperty("item_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("item_description", "K")){
					$Sql .= "$con item_description='" . $this->getProperty("item_description") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
		
				if($this->isPropertySet("item_id", "V"))
					$Sql .= " AND item_id='" . $this->getProperty("item_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_account_head_items SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND item_id=" . $this->getProperty("item_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	

	/**

	* This function is Account Log (Delete/Update/Add)

	* @author Numan Tahir

	*/

	public function actAccountLog($mode = "I"){

		$mode = strtoupper($mode);

		switch($mode){


			case "I":

				$Sql = "INSERT INTO rs_tbl_account_log(

							entery_id,

							user_id,

							entery_type,

							log_desc,

							entery_date,

							isActive,

							location_id) 

							VALUES(";

				$Sql .= $this->isPropertySet("entery_id", "V") ? $this->getProperty("entery_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("entery_type", "V") ? $this->getProperty("entery_type") : "NULL";

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

				break;

			case "D":

				$Sql = "UPDATE rs_tbl_account_log SET 

							isActive=3

						WHERE

							1=1";

				$Sql .= " AND account_log_id=" . $this->getProperty("account_log_id");

				break;

			default:

				break;

		}

		

		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is Account Transaction (Delete/Update/Add)

	* @author Numan Tahir

	*/

	public function actAccountTransaction($mode = "I"){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_account_transaction(

							transaction_id,

							user_id,

							head_id,

							item_id,

							transfer_head_id,

							transfer_item_id,

							transfer_mode,

							transaction_number,

							trans_title,

							trans_note,

							trans_mode,

							trans_type,

							aplic_mode,

							pay_mode,

							entery_id,

							pay_mode_no,

							trans_amount,

							item_qty,

							trans_date,

							trans_status,

							location_id,

							entery_date,

							isActive,
							trans_position,
							tran_code) 

							VALUES(";

				$Sql .= $this->isPropertySet("transaction_id", "V") ? $this->getProperty("transaction_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("head_id", "V") ? $this->getProperty("head_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("item_id", "V") ? $this->getProperty("item_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("transfer_head_id", "V") ? $this->getProperty("transfer_head_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("transfer_item_id", "V") ? $this->getProperty("transfer_item_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("transfer_mode", "V") ? $this->getProperty("transfer_mode") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("transaction_number", "V") ? "'" . $this->getProperty("transaction_number") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_title", "V") ? "'" . $this->getProperty("trans_title") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_note", "V") ? "'" . $this->getProperty("trans_note") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_mode", "V") ? $this->getProperty("trans_mode") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_type", "V") ? $this->getProperty("trans_type") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("aplic_mode", "V") ? $this->getProperty("aplic_mode") : "0";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("pay_mode", "V") ? $this->getProperty("pay_mode") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("entery_id", "V") ? $this->getProperty("entery_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("pay_mode_no", "V") ? "'" . $this->getProperty("pay_mode_no") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_amount", "V") ? "'" . $this->getProperty("trans_amount") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("item_qty", "V") ? "'" . $this->getProperty("item_qty") . "'" : "0";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_date", "V") ? "'" . $this->getProperty("trans_date") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_status", "V") ? $this->getProperty("trans_status") : "1";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";

				$Sql .= $this->isPropertySet("trans_position", "V") ? "'" . $this->getProperty("trans_position") . "'" : "1";
				$Sql .= ",";

				$Sql .= $this->isPropertySet("tran_code", "V") ? "'" . $this->getProperty("tran_code") . "'" : "NULL";
				$Sql .= ")";

				break;

			case "U":

				$Sql = "UPDATE rs_tbl_account_transaction SET ";
				
				if($this->isPropertySet("trans_title", "K")){
					$Sql .= "$con trans_title='" . $this->getProperty("trans_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("trans_note", "K")){
					$Sql .= "$con trans_note='" . $this->getProperty("trans_note") . "'";
					$con = ",";
				}
				if($this->isPropertySet("trans_status", "K")){
					$Sql .= "$con trans_status='" . $this->getProperty("trans_status") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("trans_amount", "K")){
					$Sql .= "$con trans_amount='" . $this->getProperty("trans_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("trans_mode", "K")){
					$Sql .= "$con trans_mode='" . $this->getProperty("trans_mode") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("transaction_id", "V"))
					$Sql .= " AND transaction_id='" . $this->getProperty("transaction_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_account_transaction SET 
							isActive=3
						WHERE
							1=1";

				$Sql .= " AND transaction_id=" . $this->getProperty("transaction_id");

				break;

			default:

				break;

		}

		//echo $Sql;

		return $this->dbQuery($Sql);

	}

	

	/**

	* This function is Account Payment Mode Info (Delete/Update/Add)

	* @author Numan Tahir

	*/

	public function actAccountPaymentModeInfo($mode = "I"){

		$mode = strtoupper($mode);

		switch($mode){

			case "I":

				$Sql = "INSERT INTO rs_tbl_account_payment_mode_info(

							pm_info_id,

							user_id,

							pm_mode_id,

							pm_mode_title,

							m_mode_detail,

							entery_date,

							isActive) 

							VALUES(";

				$Sql .= $this->isPropertySet("pm_info_id", "V") ? $this->getProperty("pm_info_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("pm_mode_id", "V") ? $this->getProperty("pm_mode_id") : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("pm_mode_title", "V") ? "'" . $this->getProperty("pm_mode_title") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("m_mode_detail", "V") ? "'" . $this->getProperty("m_mode_detail") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";

				$Sql .= ",";

				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";

				$Sql .= ")";

				break;

			case "U":

				$Sql = "UPDATE rs_tbl_account_payment_mode_info SET ";

				

				if($this->isPropertySet("pm_mode_id", "K")){

					$Sql .= "$con pm_mode_id='" . $this->getProperty("pm_mode_id") . "'";

					$con = ",";

				}

				if($this->isPropertySet("pm_mode_title", "K")){

					$Sql .= "$con pm_mode_title='" . $this->getProperty("pm_mode_title") . "'";

					$con = ",";

				}

				if($this->isPropertySet("m_mode_detail", "K")){

					$Sql .= "$con m_mode_detail='" . $this->getProperty("m_mode_detail") . "'";

					$con = ",";

				}

				if($this->isPropertySet("isActive", "K")){

					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";

					$con = ",";

				}

				$Sql .= " WHERE 1=1";

				

				if($this->isPropertySet("pm_info_id", "V"))

					$Sql .= " AND pm_info_id='" . $this->getProperty("pm_info_id") . "'";

					

				break;

			case "D":

				$Sql = "UPDATE rs_tbl_account_payment_mode_info SET 

							isActive=3

						WHERE

							1=1";

				$Sql .= " AND pm_info_id=" . $this->getProperty("pm_info_id");

				break;

			default:

				break;

		}

		

		return $this->dbQuery($Sql);

	}

	

	/**
	* This function is Account Payment Mode Info (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actWrongTransactions($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_wrong_tranasction_detail(
							wrong_transaction_id,
							user_id,
							transaction_no,
							credit_tran_id,
							debit_tran_id,
							transaction_date,
							wrong_reason,
							wrong_tran_type,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("wrong_transaction_id", "V") ? $this->getProperty("wrong_transaction_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transaction_no", "V") ? "'" . $this->getProperty("transaction_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("credit_tran_id", "V") ? $this->getProperty("credit_tran_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("debit_tran_id", "V") ? $this->getProperty("debit_tran_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transaction_date", "V") ? "'" . $this->getProperty("transaction_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("wrong_reason", "V") ? "'" . $this->getProperty("wrong_reason") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("wrong_tran_type", "V") ? "'" . $this->getProperty("wrong_tran_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_wrong_tranasction_detail SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("wrong_transaction_id", "V"))
					$Sql .= " AND wrong_transaction_id='" . $this->getProperty("wrong_transaction_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_wrong_tranasction_detail SET 
							isActive=3
					WHERE
							1=1";
				$Sql .= " AND wrong_transaction_id=" . $this->getProperty("wrong_transaction_id");
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