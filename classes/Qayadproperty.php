<?php
/**
*
* This is a class Qayadproperty
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class Qayadproperty extends Database{
	public $property_id;
	public $user_id;
	public $property_type;
	public $InfoDetail;

	/**
	* This is the constructor of the class User
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	*/
	public function __construct(){
		parent::__construct();		
		$this->reg_pro 		= $_SESSION['reg_pro'];
	}

	/**
	* This is the function to set the Register Project Session ID
	* @author Numan Tahir
	*/
	public function setRegisterProject(){
		
		#Register Project Id
		if($this->isPropertySet("reg_pro", "V"))
			$_SESSION['reg_pro'] = $this->getProperty("reg_pro");
		
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
	* This is the function to set the Temp Request Info
	* @author Numan Tahir
	*/
	public function SetTempInfo(){
		
		if($this->isPropertySet("InfoDetail", "V"))
			$_SESSION['InfoDetail'] 		= $this->getProperty("InfoDetail");
	}
	
	/**
	* This is the function to set the Temp Request Un-Register
	* @author Numan Tahir
	*/
	public function UnRegTmp(){
		unset($_SESSION['InfoDetail']);
	}
	
	/**
	* This method is used to get image extension
	* @author Numan Tahir
	* @Date : 27 Oct, 2018
	* @return : bool
	*/
	function getExtention($type){
		if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg")
			return "jpg";
		elseif($type == "image/png")
			return "png";
		elseif($type == "image/gif")
			return "gif";
	}
	
	/**
 	* Product::getImagename()	
	* This method is used to get image name
	* @author Numan Tahir
	* @Date : 27 Oct, 2018
	* @return : bool
	*/

	/*public function getImagename($type, $user_id = ''){
		$md5 		= md5(time());
		$filename 	=  substr($md5, rand(5, 25), 5);
		if($user_id != ''){
			$filename = $filename . '-' . $user_id . "." . $this->getExtention($type);
		}
		else{
			$filename = $filename . "." . $this->getExtention($type);
		}
		return $filename;
	}*/
	public function getImagename($type, $user_id = ''){
		$md5 		= md5(microtime());
		$filename_1	=  substr($md5, rand(5, 15), 10);
		$filename_2	=  substr($md5, rand(5, 25), 10);
		if($user_id != ''){
			$filename = substr(time(), rand(1, 8), 10) . $user_id . trim(uniqid()) . $user_id . $filename_1 . $user_id . $filename_2 . $user_id .  "." . $this->getExtention($type);
		}
		else{
			$filename = substr(time(), rand(1, 8), 10).trim(uniqid()) . $filename_1 . $filename_2 . "." . $this->getExtention($type);
		}
		return $filename;
	}
	
	/**
 	* Product::getImagename()	
	* This method is used to Check Image Extention
	* @author Numan Tahir
	* @Date : 27 Oct, 2018
	* @return : bool
	*/
	public function getExtentionValidate($type){
		if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg" || $type=="image/png" || $type=="image/gif")
			return 1;
		else
			return 0;
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
	* This method is used to Get Project Name
	* @author Numan Tahir
	*/
	public function ProjectName($project_id){
		$Sql = "SELECT 
					project_name
				FROM
					rs_tbl_projects
				WHERE
					1=1 
					AND project_id=".$project_id;
		$this->dbQuery($Sql);		
		$rows = $this->dbFetchArray(1);
		return $rows["project_name"];
	}
	
	/**
	* This method is used to Get Property Number
	* @author Numan Tahir
	*/
	public function PropertyNumber($property_id){
		$Sql = "SELECT 
					property_number
				FROM
					rs_tbl_property_detail
				WHERE
					1=1 
					AND property_id=".$property_id;
		$this->dbQuery($Sql);		
		$rows = $this->dbFetchArray(1);
		return $rows["property_number"];
	}
	
	/**
	* This method is used to Get Property Basic Info
	* @author Numan Tahir
	*/
	public function PropertyInfo($property_id){
		$Sql = "SELECT
					pd.property_number,
					pt.property_section,
					pfp.floor_name
				FROM
					rs_tbl_property_detail as pd
					INNER JOIN rs_tbl_property_type as pt
						ON (pd.property_type_id = pt.property_type_id)
					INNER JOIN rs_tbl_property_floor_plan as pfp
						ON (pd.propety_floor_id = pfp.propety_floor_id)
				WHERE
					1=1 
					AND pd.property_id=".$property_id;
		$this->dbQuery($Sql);		
		$rows = $this->dbFetchArray(1);
		return $rows["floor_name"].'/'.$rows["property_section"].'/'.$rows["property_number"];
	}
	
	/**
	* This method is used to the Projects combo
	* @author Numan Tahir
	*/
	public function ProjectCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					project_id,
					project_name
				FROM
					rs_tbl_projects
				WHERE
					1=1 
					AND isActive=1 ORDER BY project_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['project_id'] == $sel)
				$opt .= "<option value=\"" . $rows['project_id'] . "\" selected>" . $rows['project_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['project_id'] . "\">" . $rows['project_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Projects combo
	* @author Numan Tahir
	*/
	public function SelectedProjectCombo($sel, $selectedproject){
		$opt = "";
		$Sql = "SELECT 
					project_id,
					project_name
				FROM
					rs_tbl_projects
				WHERE
					1=1 
					AND isActive=1 AND project_id=".$selectedproject." ORDER BY project_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['project_id'] == $sel)
				$opt .= "<option value=\"" . $rows['project_id'] . "\" selected>" . $rows['project_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['project_id'] . "\">" . $rows['project_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Property Counter
	* @author Numan Tahir
	*/
	public function PropertyCounter($Prop_Status){
		$Sql = "SELECT 
					count(property_id) as PropertyCounter
				FROM
					rs_tbl_property_detail
				WHERE
					1=1 
					AND property_status=".$Prop_Status;
		$this->dbQuery($Sql);		
		$rows = $this->dbFetchArray(1);
		return $rows["PropertyCounter"];
	}
	
	/**
	* This method is used to the Floor Current Price
	* @author Numan Tahir
	*/
	public function FloorCurrentPrice($floor_id){
		$Sql = "SELECT 
					rate_per_sq_ft
				FROM
					rs_tbl_projects_floor_payment_detail
				WHERE
					1=1 
					AND isActive=1 AND floor_id=".$floor_id;
		$this->dbQuery($Sql);		
		$rows = $this->dbFetchArray(1);
		return $rows["rate_per_sq_ft"];
	}
	
	/**
	* This function is used to list the Properties
	* @author Numan Tahir
	*/
	public function lstProperties(){
		$Sql = "SELECT
					pd.property_id
					, pd.project_id
					, pd.property_registered_id
					, pfp.floor_name
					, pt.property_section
					, pt.property_area
					, pt.property_image
					, pd.property_type_id
					, pd.propety_floor_id
					, pd.property_number
					, pd.property_img_title
					, pd.property_img_cord
					, pd.poperty_img_shap
					, pd.property_status
					, pd.total_no_of_shares
					, pd.no_of_sold_shares
					, pd.book_duration
					, pd.property_desc
					, pd.entery_date
					, pt.property_rent_sqft
					, pd.isActive
					, pd.share_5
					, pd.share_10
					, pd.share_20
				FROM
					rs_tbl_property_detail as pd
					INNER JOIN rs_tbl_property_type as pt
						ON (pd.property_type_id = pt.property_type_id)
					INNER JOIN rs_tbl_property_floor_plan as pfp 
						ON (pd.propety_floor_id = pfp.propety_floor_id) 
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND pd.property_id=" . $this->getProperty("property_id");
			
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND pd.project_id=" . $this->getProperty("project_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND pd.user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("property_registered_id", "V"))
			$Sql .= " AND pd.property_registered_id=" . $this->getProperty("property_registered_id");
		
		if($this->getProperty("property_type_id", "V"))
			$Sql .= " AND pd.property_type_id=" . $this->getProperty("property_type_id");
		
		if($this->getProperty("propety_floor_id", "V"))
			$Sql .= " AND pd.propety_floor_id='" . $this->getProperty("propety_floor_id") ."'";
		
		if($this->getProperty("property_number", "V"))
			$Sql .= " AND pd.property_number='" . $this->getProperty("property_number") ."'";
		
		if($this->getProperty("property_img_title", "V"))
			$Sql .= " AND pd.property_img_title='" . $this->getProperty("property_img_title") ."'";
		
		if($this->getProperty("property_img_cord", "V"))
			$Sql .= " AND pd.property_img_cord='" . $this->getProperty("property_img_cord") ."'";
		
		if($this->getProperty("poperty_img_shap", "V"))
			$Sql .= " AND pd.poperty_img_shap='" . $this->getProperty("poperty_img_shap") ."'";
		
		if($this->getProperty("property_status", "V"))
			$Sql .= " AND pd.property_status=" . $this->getProperty("property_status");
		
		if($this->getProperty("total_no_of_shares", "V"))
			$Sql .= " AND pd.total_no_of_shares=" . $this->getProperty("total_no_of_shares");
		
		if($this->getProperty("no_of_sold_shares", "V"))
			$Sql .= " AND pd.no_of_sold_shares=" . $this->getProperty("no_of_sold_shares");
		
		if($this->getProperty("book_duration", "V"))
			$Sql .= " AND pd.book_duration=" . $this->getProperty("book_duration");
		
		if($this->getProperty("entery_date", "V"))
			$Sql .= " AND pd.entery_date='" . $this->getProperty("entery_date") ."'";
		
		if($this->getProperty("property_rent_sqft", "V"))
			$Sql .= " AND pd.property_rent_sqft='" . $this->getProperty("property_rent_sqft") ."'";
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND pd.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Property Gallery
	* @author Numan Tahir
	*/
	public function lstPropertyGallery(){
		$Sql = "SELECT 
					property_gallery_id,
					property_id,
					user_id,
					file_type,
					file_name,
					isActive,
					entery_date
				FROM
					rs_tbl_property_gallery 
				WHERE 
					1=1";
		
		if($this->getProperty("property_gallery_id", "V"))
			$Sql .= " AND property_gallery_id=" . $this->getProperty("property_gallery_id");
		
		if($this->getProperty("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("file_type", "V"))
			$Sql .= " AND file_type='" . $this->getProperty("file_type") . "'";	
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Log
	* @author Numan Tahir
	*/
	public function lstPropertyLog(){
		$Sql = "SELECT
				   lg.property_log_id,
				   CONCAT(ur.user_fname,' ',ur.user_lname) AS fullname,
				   lg.log_desc,
				   lg.property_id,
				   lg.user_id,
				   lg.entery_date,
				   lg.isActive
				FROM
					rs_tbl_property_log as lg
					INNER JOIN rs_tbl_users as ur
						ON (lg.user_id = ur.user_id) 
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_log_id", "V"))
			$Sql .= " AND lg.property_log_id=" . $this->getProperty("property_log_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND lg.property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND lg.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND lg.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("stat_date", "V"))
			$Sql .= " AND lg.entery_date >='" . $this->getProperty("stat_date") . "'";	

		if($this->isPropertySet("end_date", "V"))
			$Sql .= " AND lg.entery_date <='" . $this->getProperty("end_date") . "'";	
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Payment Detail
	* @author Numan Tahir
	*/
	public function lstPropertyPaymentDetail(){
		$Sql = "SELECT 
					propty_payment_id,
					property_id,
					user_id,
					down_payment,
					instalment_per_month,
					instalment_per_month_24,
					instalment_per_month_36,
					rate_per_sq_ft,
					dp_discount,
					total_discount,
					payback_cutting,
					pb_cutting_value,
					property_transfer_fee,
					property_rent_value,
					entery_date,
					isActive
				FROM
					rs_tbl_property_payment_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("propty_payment_id", "V"))
			$Sql .= " AND propty_payment_id=" . $this->getProperty("propty_payment_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Project Floor Payment Detail
	* @author Numan Tahir
	*/
	public function lstFloorPaymentDetail(){
		$Sql = "SELECT 
					floor_payment_id,
					project_id,
					floor_id,
					user_id,
					rate_per_sq_ft,
					payback_cutting,
					pb_cutting_value,
					unit_transfer_fee,
					unit_rent_value,
					registration_fee,
					entery_date,
					isActive
				FROM
					rs_tbl_projects_floor_payment_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("floor_payment_id", "V"))
			$Sql .= " AND floor_payment_id=" . $this->getProperty("floor_payment_id");
		
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND project_id=" . $this->getProperty("project_id");
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND floor_id=" . $this->getProperty("floor_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Temp Lock Detail
	* @author Numan Tahir
	*/
	public function lstPropertyTempLock(){
		$Sql = "SELECT 
					temp_lock_id,
					property_id,
					user_id,
					customer_old_id,
					customer_fname,
					customer_lname,
					customer_father,
					customer_cnic,
					customer_passport,
					customer_email,
					customer_c_address,
					customer_p_address,
					customer_phone,
					customer_mobile,
					customer_mobile_2,
					received_amount,
					adjustment_code,
					adjustment_status,
					ledger_code,
					adjustment_date,
					till_lock_duration,
					lock_status,
					entery_date
				FROM
					rs_tbl_property_temp_lock
				WHERE 
					1=1";
		
		if($this->isPropertySet("temp_lock_id", "V"))
			$Sql .= " AND temp_lock_id=" . $this->getProperty("temp_lock_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("customer_old_id", "V"))
			$Sql .= " AND customer_old_id=" . $this->getProperty("customer_old_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_mobile", "V"))
			$Sql .= " AND customer_mobile='" . $this->getProperty("customer_mobile") . "'";
		
		if($this->isPropertySet("customer_cnic", "V"))
			$Sql .= " AND customer_cnic='" . $this->getProperty("customer_cnic") . "'";
		
		if($this->isPropertySet("adjustment_code", "V"))
			$Sql .= " AND adjustment_code='" . $this->getProperty("adjustment_code") . "'";
			
		if($this->isPropertySet("adjustment_status", "V"))
			$Sql .= " AND adjustment_status='" . $this->getProperty("adjustment_status") . "'";
			
		if($this->isPropertySet("lock_status", "V"))
			$Sql .= " AND lock_status='" . $this->getProperty("lock_status") . "'";
		
		if($this->isPropertySet("ledger_code", "V"))
			$Sql .= " AND ledger_code='" . $this->getProperty("ledger_code") . "'";
					
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Unit Temp Lock Detail
	* @author Numan Tahir
	*/
	public function lstUnitTempLock(){
		$Sql = "SELECT 
					temp_lock_id,
					property_share_id,
					aplic_id,
					user_id,
					customer_old_id,
					customer_fname,
					customer_lname,
					customer_father,
					customer_cnic,
					customer_email,
					customer_c_address,
					customer_p_address,
					customer_phone,
					customer_mobile,
					customer_mobile_2,
					received_amount,
					adjustment_code,
					adjustment_status,
					ledger_code,
					adjustment_date,
					till_lock_duration,
					lock_status,
					entery_date
				FROM
					rs_tbl_unit_temp_lock
				WHERE 
					1=1";
		
		if($this->isPropertySet("temp_lock_id", "V"))
			$Sql .= " AND temp_lock_id=" . $this->getProperty("temp_lock_id");
		
		if($this->isPropertySet("property_share_id", "V"))
			$Sql .= " AND property_share_id=" . $this->getProperty("property_share_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
			
		if($this->isPropertySet("customer_old_id", "V"))
			$Sql .= " AND customer_old_id=" . $this->getProperty("customer_old_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_mobile", "V"))
			$Sql .= " AND customer_mobile='" . $this->getProperty("customer_mobile") . "'";
		
		if($this->isPropertySet("customer_cnic", "V"))
			$Sql .= " AND customer_cnic='" . $this->getProperty("customer_cnic") . "'";
		
		if($this->isPropertySet("adjustment_code", "V"))
			$Sql .= " AND adjustment_code='" . $this->getProperty("adjustment_code") . "'";
			
		if($this->isPropertySet("adjustment_status", "V"))
			$Sql .= " AND adjustment_status='" . $this->getProperty("adjustment_status") . "'";
			
		if($this->isPropertySet("lock_status", "V"))
			$Sql .= " AND lock_status='" . $this->getProperty("lock_status") . "'";
		
		if($this->getProperty("lock_status_array", "V"))
			//$Sql .= " AND user_type_id IN (" . implode(',', $this->getProperty("user_type_id_array")) . ")'";
			$Sql .= " AND lock_status IN (".$this->getProperty("lock_status_array"). ")";
			
		if($this->isPropertySet("ledger_code", "V"))
			$Sql .= " AND ledger_code='" . $this->getProperty("ledger_code") . "'";
					
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Floor Plan Detail
	* @author Numan Tahir
	*/
	public function lstPropertyFloorPlan(){
		$Sql = "SELECT 
					propety_floor_id,
					project_id,
					project_type_id,
					floor_name,
					user_id,
					entery_date
				FROM
					rs_tbl_property_floor_plan
				WHERE 
					1=1";
		
		if($this->isPropertySet("propety_floor_id", "V"))
			$Sql .= " AND propety_floor_id=" . $this->getProperty("propety_floor_id");
		
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND project_id=" . $this->getProperty("project_id");
		
		if($this->isPropertySet("project_type_id", "V"))
			$Sql .= " AND project_type_id=" . $this->getProperty("project_type_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Type
	* @author Numan Tahir
	*/
	public function lstPropertyType(){
		$Sql = "SELECT 
					property_type_id,
					project_id,
					project_type_id,
					user_id,
					propety_floor_id,
					property_section,
					property_area,
					property_rent_sqft,
					property_image,
					property_banner,
					entery_date
				FROM
					rs_tbl_property_type
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_type_id", "V"))
			$Sql .= " AND property_type_id=" . $this->getProperty("property_type_id");
		
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND project_id=" . $this->getProperty("project_id");
		
		if($this->isPropertySet("project_type_id", "V"))
			$Sql .= " AND project_type_id=" . $this->getProperty("project_type_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("propety_floor_id", "V"))
			$Sql .= " AND propety_floor_id=" . $this->getProperty("propety_floor_id");
		
		if($this->isPropertySet("property_section", "V"))
			$Sql .= " AND property_section='" . $this->getProperty("property_section") . "'";
		
		if($this->isPropertySet("property_area", "V"))
			$Sql .= " AND property_area='" . $this->getProperty("property_area") . "'";
		
		if($this->isPropertySet("property_rent_sqft", "V"))
			$Sql .= " AND property_rent_sqft='" . $this->getProperty("property_rent_sqft") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Type
	* @author Numan Tahir
	*/
	public function VwLockedPropertyDetail(){
		$Sql = "SELECT 
					temp_lock_id,
					property_id,
					aplic_id,
					user_id,
					customer_fname,
					customer_lname,
					customer_father,
					customer_cnic,
					customer_passport,
					customer_email,
					customer_c_address,
					customer_p_address,
					customer_phone,
					customer_mobile,				
					customer_mobile_2,
					received_amount,
					adjustment_code,
					ledger_code,
					adjustment_status,
					adjustment_date,
					till_lock_duration,
					lock_status,
					entery_date,
					property_registered_id,
					property_type_id,
					propety_floor_id,
					property_number,
					property_status,
					book_duration,
					property_section,
					property_area,
					property_rent_sqft,
					floor_name,
					user_fname,
					user_lname,
					user_mobile,
					user_type_id,
					user_designation
				FROM
					vw_locked_property_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("temp_lock_id", "V"))
			$Sql .= " AND temp_lock_id=" . $this->getProperty("temp_lock_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("aplic_id", "V"))
			$Sql .= " AND aplic_id=" . $this->getProperty("aplic_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("adjustment_code", "V"))
			$Sql .= " AND adjustment_code='" . $this->getProperty("adjustment_code") . "'";
		
		if($this->isPropertySet("ledger_code", "V"))
			$Sql .= " AND ledger_code='" . $this->getProperty("ledger_code") . "'";
		
		if($this->getProperty("lock_status_array", "V"))
			//$Sql .= " AND user_type_id IN (" . implode(',', $this->getProperty("user_type_id_array")) . ")'";
			$Sql .= " AND lock_status IN (".$this->getProperty("lock_status_array"). ")";
					
		if($this->isPropertySet("adjustment_status", "V"))
			$Sql .= " AND adjustment_status=" . $this->getProperty("adjustment_status");
		
		if($this->isPropertySet("lock_status", "V"))
			$Sql .= " AND lock_status=" . $this->getProperty("lock_status");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Project Event
	* @author Numan Tahir
	*/
	public function lstPropertyProjectEvent(){
		$Sql = "SELECT 
					project_event_id,
					user_id,
					event_name,
					event_descripton,
					expected_date,
					enter_date,
					isActive
				FROM
					rs_tbl_property_project_event
				WHERE 
					1=1";
		
		if($this->isPropertySet("project_event_id", "V"))
			$Sql .= " AND project_event_id=" . $this->getProperty("project_event_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("expected_date", "V"))
			$Sql .= " AND expected_date='" . $this->getProperty("expected_date") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Shares List
	* @author Numan Tahir
	*/
	public function lstPropertyShares(){
		$Sql = "SELECT 
					property_share_id,
					project_id,
					property_id,
					project_type_id,
					property_floor_id,
					property_share_number,
					property_share_status,
					property_lock_days,
					property_lock_till_date,
					share_unit_size,
					entery_datetime,
					isActive
				FROM
					rs_tbl_property_shares
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_share_id", "V"))
			$Sql .= " AND property_share_id=" . $this->getProperty("property_share_id");
		
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND project_id=" . $this->getProperty("project_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
			
		if($this->isPropertySet("project_type_id", "V"))
			$Sql .= " AND project_type_id=" . $this->getProperty("project_type_id");
		
		if($this->isPropertySet("property_floor_id", "V"))
			$Sql .= " AND property_floor_id=" . $this->getProperty("property_floor_id");
		
		if($this->isPropertySet("share_unit_size", "V"))
			$Sql .= " AND share_unit_size=" . $this->getProperty("share_unit_size");
				
		if($this->isPropertySet("property_share_number", "V"))
			$Sql .= " AND property_share_number='" . $this->getProperty("property_share_number") . "'";
		
		if($this->isPropertySet("property_share_status", "V"))
			$Sql .= " AND property_share_status=" . $this->getProperty("property_share_status");
		
		if($this->isPropertySet("property_lock_till_date", "V"))
			$Sql .= " AND property_lock_till_date='" . $this->getProperty("property_lock_till_date") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
						
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Projects List
	* @author Numan Tahir
	*/
	public function lstProjects(){
		$Sql = "SELECT 
					project_id,
					project_name,
					project_description,
					project_location,
					project_contact_number,
					project_type,
					entery_datetime,
					isActive
				FROM
					rs_tbl_projects
				WHERE 
					1=1";
		
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND project_id=" . $this->getProperty("project_id");
		
		if($this->isPropertySet("project_type", "V"))
			$Sql .= " AND project_type=" . $this->getProperty("project_type");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
						
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Projects Gallery List
	* @author Numan Tahir
	*/
	public function lstProjectGallery(){
		$Sql = "SELECT 
					project_gallery_id,
					project_id,
					user_id,
					file_type,
					file_name,
					isActive,
					entery_date
				FROM
					rs_tbl_projects_gallery
				WHERE 
					1=1";
		
		if($this->isPropertySet("project_gallery_id", "V"))
			$Sql .= " AND project_gallery_id=" . $this->getProperty("project_gallery_id");
		
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND project_id=" . $this->getProperty("project_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
						
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Unit Detail with Join
	* @author Numan Tahir
	*/
	public function lstPropertyUnitDetail(){
		$Sql = "SELECT
					utl.temp_lock_id,
					utl.property_share_id,
					utl.user_id,
					utl.customer_old_id,
					utl.customer_fname,
					utl.customer_lname,
					utl.customer_cnic,
					utl.customer_mobile,
					utl.received_amount,
					utl.till_lock_duration,
					utl.lock_status,
					utl.ledger_code,
					utl.adjustment_code,
					utl.entery_date,
					ps.property_share_number,
					ps.share_unit_size,
					ps.project_id,
					pfp.floor_name,
					pt.property_section,
					pt.property_area,
					pd.property_registered_id,
					pd.property_number,
					pd.property_id,
					pfpd.rate_per_sq_ft
				FROM
					rs_tbl_unit_temp_lock as utl
					INNER JOIN rs_tbl_property_shares as ps
						ON (utl.property_share_id = ps.property_share_id)
					INNER JOIN rs_tbl_property_floor_plan as pfp
						ON (ps.property_floor_id = pfp.propety_floor_id)
					INNER JOIN rs_tbl_property_type as pt
						ON (ps.project_type_id = pt.property_type_id)
					INNER JOIN rs_tbl_property_detail as pd
						ON (ps.property_id = pd.property_id)
					INNER JOIN rs_tbl_projects_floor_payment_detail  as pfpd
						ON (pfp.propety_floor_id = pfpd.floor_id AND pfpd.isActive=1)
				WHERE 
					1=1";
		
		if($this->isPropertySet("temp_lock_id", "V"))
			$Sql .= " AND utl.temp_lock_id=" . $this->getProperty("temp_lock_id");
			
		if($this->isPropertySet("property_share_id", "V"))
			$Sql .= " AND utl.property_share_id=" . $this->getProperty("property_share_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND utl.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("customer_old_id", "V"))
			$Sql .= " AND utl.customer_old_id=" . $this->getProperty("customer_old_id");
			
		if($this->isPropertySet("lock_status", "V"))
			$Sql .= " AND utl.lock_status=" . $this->getProperty("lock_status");
		
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND ps.project_id=" . $this->getProperty("project_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND pd.property_id=" . $this->getProperty("property_id");
			
		if($this->getProperty("lock_status_array", "V"))
			$Sql .= " AND utl.lock_status IN (".$this->getProperty("lock_status_array"). ")";
			
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
/* 										BELOW FOR API 										*/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
/***//////////////////////////////////////////////////////////////////////////////////////***/
	/**
	* This function is used to list the Property Detail
	* @author Numan Tahir
	*/
	public function lstPropertyDetail(){
		$Sql = "SELECT
					pd.property_id,
					pd.project_id,
					pd.property_registered_id,
					pfp.floor_name,
					pt.property_section,
					pt.property_area,
					pt.property_image,
					pt.property_type_id,
					pfp.propety_floor_id,
					pd.property_number,
					pd.property_img_title,
					pd.property_img_cord,
					pd.poperty_img_shap,
					pd.property_status,
					pd.total_no_of_shares,
					pd.no_of_sold_shares,
					pd.book_duration,
					pd.property_desc,
					pd.isActive,
					pd.share_5,
					pd.share_10,
					pd.share_20,
					pt.property_rent_sqft,
					ppd.down_payment,
					ppd.instalment_per_month,
					ppd.instalment_per_month_24,
					ppd.instalment_per_month_36,
					ppd.rate_per_sq_ft,
					ppd.dp_discount,
					ppd.total_discount,
					ppd.payback_cutting,
					ppd.pb_cutting_value,
					ppd.property_transfer_fee,
					ppd.property_rent_value
				FROM
					rs_tbl_property_detail as pd
					LEFT JOIN rs_tbl_property_type as pt
						ON (pd.property_type_id = pt.property_type_id)
					LEFT JOIN rs_tbl_property_floor_plan as pfp
						ON (pd.propety_floor_id = pfp.propety_floor_id)
					LEFT JOIN rs_tbl_property_payment_detail as ppd
						ON (ppd.property_id = pd.property_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND pd.property_id=" . $this->getProperty("property_id");
			
		if($this->isPropertySet("project_id", "V"))
			$Sql .= " AND pd.project_id=" . $this->getProperty("project_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND pd.user_id=" . $this->getProperty("user_id");
		
		if($this->getProperty("property_registered_id", "V"))
			$Sql .= " AND pd.property_registered_id=" . $this->getProperty("property_registered_id");
		
		if($this->getProperty("property_type_id", "V"))
			$Sql .= " AND pd.property_type_id=" . $this->getProperty("property_type_id");
		
		if($this->getProperty("propety_floor_id", "V"))
			$Sql .= " AND pd.propety_floor_id='" . $this->getProperty("propety_floor_id") ."'";
		
		if($this->getProperty("property_number", "V"))
			$Sql .= " AND pd.property_number='" . $this->getProperty("property_number") ."'";
		
		if($this->getProperty("property_img_title", "V"))
			$Sql .= " AND pd.property_img_title='" . $this->getProperty("property_img_title") ."'";
		
		if($this->getProperty("property_img_cord", "V"))
			$Sql .= " AND pd.property_img_cord='" . $this->getProperty("property_img_cord") ."'";
		
		if($this->getProperty("poperty_img_shap", "V"))
			$Sql .= " AND pd.poperty_img_shap='" . $this->getProperty("poperty_img_shap") ."'";
		
		if($this->getProperty("property_status", "V"))
			$Sql .= " AND pd.property_status=" . $this->getProperty("property_status");
		
		if($this->getProperty("total_no_of_shares", "V"))
			$Sql .= " AND pd.total_no_of_shares=" . $this->getProperty("total_no_of_shares");
		
		if($this->getProperty("no_of_sold_shares", "V"))
			$Sql .= " AND pd.no_of_sold_shares=" . $this->getProperty("no_of_sold_shares");
		
		if($this->getProperty("book_duration", "V"))
			$Sql .= " AND pd.book_duration=" . $this->getProperty("book_duration");
		
		if($this->getProperty("entery_date", "V"))
			$Sql .= " AND pd.entery_date='" . $this->getProperty("entery_date") ."'";
		
		if($this->getProperty("property_rent_sqft", "V"))
			$Sql .= " AND pd.property_rent_sqft='" . $this->getProperty("property_rent_sqft") ."'";
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND pd.isActive=" . $this->getProperty("isActive");
		
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
	* This function is Properties to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actProperties($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_detail(
						property_id,
						user_id,
						project_id,
						property_registered_id,
						property_type_id,
						propety_floor_id,
						property_number,
						property_img_title,
						property_img_cord,
						poperty_img_shap,
						property_status,
						total_no_of_shares,
						no_of_sold_shares,
						book_duration,
						property_desc,
						share_5,
						share_10,
						share_20,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_id", "V") ? $this->getProperty("project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_registered_id", "V") ? $this->getProperty("property_registered_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_type_id", "V") ? $this->getProperty("property_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("propety_floor_id", "V") ? "'" . $this->getProperty("propety_floor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_number", "V") ? "'" . $this->getProperty("property_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_img_title", "V") ? "'" . $this->getProperty("property_img_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_img_cord", "V") ? "'" . $this->getProperty("property_img_cord") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("poperty_img_shap", "V") ? "'" . $this->getProperty("poperty_img_shap") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_status", "V") ? $this->getProperty("property_status") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("total_no_of_shares", "V") ? "'" . $this->getProperty("total_no_of_shares") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_sold_shares", "V") ?  "'" . $this->getProperty("no_of_sold_shares") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("book_duration", "V") ? $this->getProperty("book_duration") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_desc", "V") ? "'" . $this->getProperty("property_desc") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("share_5", "V") ? "'" . $this->getProperty("share_5") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("share_10", "V") ? "'" . $this->getProperty("share_10") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("share_20", "V") ? "'" . $this->getProperty("share_20") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_detail SET ";
				if($this->isPropertySet("project_id", "K")){
					$Sql .= "$con project_id=" . $this->getProperty("project_id");
					$con = ",";
				}
				if($this->isPropertySet("property_registered_id", "K")){
					$Sql .= "$con property_registered_id=" . $this->getProperty("property_registered_id");
					$con = ",";
				}
				if($this->isPropertySet("property_type_id", "K")){
					$Sql .= "$con property_type_id=" . $this->getProperty("property_type_id");
					$con = ",";
				}
				if($this->isPropertySet("propety_floor_id", "K")){
					$Sql .= "$con propety_floor_id='" . $this->getProperty("propety_floor_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_number", "K")){
					$Sql .= "$con property_number='" . $this->getProperty("property_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_img_title", "K")){
					$Sql .= "$con property_img_title='" . $this->getProperty("property_img_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_img_cord", "K")){
					$Sql .= "$con property_img_cord='" . $this->getProperty("property_img_cord") . "'";
					$con = ",";
				}
				if($this->isPropertySet("poperty_img_shap", "K")){
					$Sql .= "$con poperty_img_shap='" . $this->getProperty("poperty_img_shap") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_status", "K")){
					$Sql .= "$con property_status=" . $this->getProperty("property_status");
					$con = ",";
				}
				if($this->isPropertySet("total_no_of_shares", "K")){
					$Sql .= "$con total_no_of_shares='" . $this->getProperty("total_no_of_shares") . "'";
					$con = ",";
				}
				if($this->isPropertySet("no_of_sold_shares", "K")){
					$Sql .= "$con no_of_sold_shares='" . $this->getProperty("no_of_sold_shares") . "'";
					$con = ",";
				}
				if($this->isPropertySet("book_duration", "K")){
					$Sql .= "$con book_duration='" . $this->getProperty("book_duration") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_desc", "K")){
					$Sql .= "$con property_desc='" . $this->getProperty("property_desc") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("property_id", "V"))
					$Sql .= " AND property_id='" . $this->getProperty("property_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_property_detail SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND property_id=" . $this->getProperty("property_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Gallery (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyGallery($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_gallery(
						property_gallery_id,
						property_id,
						user_id,
						file_type,
						file_name,
						isActive,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("property_gallery_id", "V") ? $this->getProperty("property_gallery_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("file_type", "V") ? "'" . $this->getProperty("file_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("file_name", "V") ? "'" . $this->getProperty("file_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_gallery SET ";
				if($this->isPropertySet("file_type", "K")){
					$Sql .= "$con file_type='" . $this->getProperty("file_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("file_name", "K")){
					$Sql .= "$con file_name='" . $this->getProperty("file_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("property_gallery_id", "V"))
					$Sql .= " AND property_gallery_id='" . $this->getProperty("property_gallery_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_property_gallery SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("property_gallery_id", "V"))
					$Sql .= " AND property_gallery_id='" . $this->getProperty("property_gallery_id") . "'";
				
				if($this->isPropertySet("property_id", "V"))
					$Sql .= " AND property_id='" . $this->getProperty("property_id") . "'";
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Log (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_log(
						property_id,
						user_id,
						log_desc,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("log_desc", "V") ? "'" . $this->getProperty("log_desc") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_log SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("property_id", "V"))
					$Sql .= " AND property_id=" . $this->getProperty("property_id");
				
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Payment Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyPaymentDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_payment_detail(
						propty_payment_id,
						property_id,
						user_id,
						down_payment,
						instalment_per_month,
						instalment_per_month_24,
						instalment_per_month_36,
						rate_per_sq_ft,
						dp_discount,
						total_discount,
						payback_cutting,
						pb_cutting_value,
						property_transfer_fee,
						property_rent_value,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("propty_payment_id", "V") ? $this->getProperty("propty_payment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("down_payment", "V") ? "'" . $this->getProperty("down_payment") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_per_month", "V") ? "'" . $this->getProperty("instalment_per_month") . "'" : "NULL";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("instalment_per_month_24", "V") ? "'" . $this->getProperty("instalment_per_month_24") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("instalment_per_month_36", "V") ? "'" . $this->getProperty("instalment_per_month_36") . "'" : "NULL";
				$Sql .= ",";
				
				
				$Sql .= $this->isPropertySet("rate_per_sq_ft", "V") ? "'" . $this->getProperty("rate_per_sq_ft") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("dp_discount", "V") ? "'" . $this->getProperty("dp_discount") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("total_discount", "V") ? "'" . $this->getProperty("total_discount") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_cutting", "V") ? "'" . $this->getProperty("payback_cutting") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_cutting_value", "V") ? "'" . $this->getProperty("pb_cutting_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_transfer_fee", "V") ? "'" . $this->getProperty("property_transfer_fee") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_rent_value", "V") ? "'" . $this->getProperty("property_rent_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_payment_detail SET ";
				
				if($this->isPropertySet("down_payment", "K")){
					$Sql .= "$con down_payment='" . $this->getProperty("down_payment") . "'";
					$con = ",";
				}
				if($this->isPropertySet("instalment_per_month", "K")){
					$Sql .= "$con instalment_per_month='" . $this->getProperty("instalment_per_month") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("instalment_per_month_24", "K")){
					$Sql .= "$con instalment_per_month_24='" . $this->getProperty("instalment_per_month_24") . "'";
					$con = ",";
				}
				if($this->isPropertySet("instalment_per_month_36", "K")){
					$Sql .= "$con instalment_per_month_36='" . $this->getProperty("instalment_per_month_36") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("rate_per_sq_ft", "K")){
					$Sql .= "$con rate_per_sq_ft='" . $this->getProperty("rate_per_sq_ft") . "'";
					$con = ",";
				}
				if($this->isPropertySet("dp_discount", "K")){
					$Sql .= "$con dp_discount='" . $this->getProperty("dp_discount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_discount", "K")){
					$Sql .= "$con total_discount='" . $this->getProperty("total_discount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_cutting", "K")){
					$Sql .= "$con payback_cutting=" . $this->getProperty("payback_cutting");
					$con = ",";
				}
				if($this->isPropertySet("pb_cutting_value", "K")){
					$Sql .= "$con pb_cutting_value='" . $this->getProperty("pb_cutting_value") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_transfer_fee", "K")){
					$Sql .= "$con property_transfer_fee='" . $this->getProperty("property_transfer_fee") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_rent_value", "K")){
					$Sql .= "$con property_rent_value='" . $this->getProperty("property_rent_value") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("propty_payment_id", "V"))
					$Sql .= " AND propty_payment_id=" . $this->getProperty("propty_payment_id");
				
				if($this->isPropertySet("property_id", "V"))
					$Sql .= " AND property_id=" . $this->getProperty("property_id");
				
				if($this->isPropertySet("propty_payment_id_not", "V"))
					$Sql .= " AND propty_payment_id!=" . $this->getProperty("propty_payment_id_not");
						
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Temp Lock Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyTempLock($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_temp_lock(
						temp_lock_id,
						property_id,
						user_id,
						customer_old_id,
						customer_fname,
						customer_lname,
						customer_father,
						customer_cnic,
						customer_passport,
						customer_email,
						customer_c_address,
						customer_p_address,
						customer_phone,
						customer_mobile,
						customer_mobile_2,
						received_amount,
						adjustment_code,
						ledger_code,
						adjustment_status,
						adjustment_date,
						till_lock_duration,
						lock_status,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("temp_lock_id", "V") ? $this->getProperty("temp_lock_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_old_id", "V") ? "'" . $this->getProperty("customer_old_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_fname", "V") ? "'" . $this->getProperty("customer_fname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_lname", "V") ? "'" . $this->getProperty("customer_lname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_father", "V") ? "'" . $this->getProperty("customer_father") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_cnic", "V") ? "'" . $this->getProperty("customer_cnic") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_passport", "V") ? "'" . $this->getProperty("customer_passport") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_email", "V") ? "'" . $this->getProperty("customer_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_c_address", "V") ? "'" . $this->getProperty("customer_c_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_p_address", "V") ? "'" . $this->getProperty("customer_p_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_phone", "V") ? "'" . $this->getProperty("customer_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_mobile", "V") ? "'" . $this->getProperty("customer_mobile") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_mobile_2", "V") ? "'" . $this->getProperty("customer_mobile_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_amount", "V") ? "'" . $this->getProperty("received_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("adjustment_code", "V") ? "'" . $this->getProperty("adjustment_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ledger_code", "V") ? "'" . $this->getProperty("ledger_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("adjustment_status", "V") ? "'" . $this->getProperty("adjustment_status") . "'" : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("adjustment_date", "V") ? "'" . $this->getProperty("adjustment_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("till_lock_duration", "V") ? "'" . $this->getProperty("till_lock_duration") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lock_status", "V") ? $this->getProperty("lock_status") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_temp_lock SET ";
				
				if($this->isPropertySet("property_id", "K")){
					$Sql .= "$con property_id='" . $this->getProperty("property_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("adjustment_code", "K")){
					$Sql .= "$con adjustment_code='" . $this->getProperty("adjustment_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("adjustment_status", "K")){
					$Sql .= "$con adjustment_status='" . $this->getProperty("adjustment_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("adjustment_date", "K")){
					$Sql .= "$con adjustment_date='" . $this->getProperty("adjustment_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ledger_code", "K")){
					$Sql .= "$con ledger_code='" . $this->getProperty("ledger_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("lock_status", "K")){
					$Sql .= "$con lock_status='" . $this->getProperty("lock_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("aplic_id", "K")){
					$Sql .= "$con aplic_id='" . $this->getProperty("aplic_id") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("temp_lock_id", "V"))
					$Sql .= " AND temp_lock_id=" . $this->getProperty("temp_lock_id");
				
				/*if($this->isPropertySet("property_id", "V"))
					$Sql .= " AND property_id=" . $this->getProperty("property_id");*/
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Floor Plan Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyFloorPlan($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_floor_plan (
						propety_floor_id,
						project_id,
						project_type_id,
						floor_name,
						user_id,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("propety_floor_id", "V") ? $this->getProperty("propety_floor_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_id", "V") ? $this->getProperty("project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_type_id", "V") ? $this->getProperty("project_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("floor_name", "V") ? "'" . $this->getProperty("floor_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_floor_plan SET ";
				
				if($this->isPropertySet("project_id", "K")){
					$Sql .= "$con project_id='" . $this->getProperty("project_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("project_type_id", "K")){
					$Sql .= "$con project_type_id='" . $this->getProperty("project_type_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("floor_name", "K")){
					$Sql .= "$con floor_name='" . $this->getProperty("floor_name") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("propety_floor_id", "V"))
					$Sql .= " AND propety_floor_id=" . $this->getProperty("propety_floor_id");
				
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Floor Plan Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyType($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_type (
						property_type_id,
						project_id,
						project_type_id,
						user_id,
						propety_floor_id,
						property_section,
						property_area,
						property_rent_sqft,
						property_image,
						property_banner,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("property_type_id", "V") ? $this->getProperty("property_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_id", "V") ? $this->getProperty("project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_type_id", "V") ? $this->getProperty("project_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("propety_floor_id", "V") ? $this->getProperty("propety_floor_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_section", "V") ? "'" . $this->getProperty("property_section") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_area", "V") ? "'" . $this->getProperty("property_area") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_rent_sqft", "V") ? "'" . $this->getProperty("property_rent_sqft") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_image", "V") ? "'" . $this->getProperty("property_image") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_banner", "V") ? "'" . $this->getProperty("property_banner") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_type SET ";
				
				if($this->isPropertySet("project_id", "K")){
					$Sql .= "$con project_id='" . $this->getProperty("project_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("project_type_id", "K")){
					$Sql .= "$con project_type_id='" . $this->getProperty("project_type_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("propety_floor_id", "K")){
					$Sql .= "$con propety_floor_id='" . $this->getProperty("propety_floor_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_section", "K")){
					$Sql .= "$con property_section='" . $this->getProperty("property_section") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_area", "K")){
					$Sql .= "$con property_area='" . $this->getProperty("property_area") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_rent_sqft", "K")){
					$Sql .= "$con property_rent_sqft='" . $this->getProperty("property_rent_sqft") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_image", "K")){
					$Sql .= "$con property_image='" . $this->getProperty("property_image") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_banner", "K")){
					$Sql .= "$con property_banner='" . $this->getProperty("property_banner") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("property_type_id", "V"))
					$Sql .= " AND property_type_id=" . $this->getProperty("property_type_id");
				
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Project Event to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyProjectEvent($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_project_event(
						project_event_id,
						user_id,
						event_name,
						event_descripton,
						expected_date,
						enter_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("project_event_id", "V") ? $this->getProperty("project_event_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("event_name", "V") ? "'" . $this->getProperty("event_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("event_descripton", "V") ? "'" . $this->getProperty("event_descripton") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("expected_date", "V") ? "'" . $this->getProperty("expected_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("enter_date", "V") ? "'" . $this->getProperty("enter_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_project_event SET ";
				
				if($this->isPropertySet("event_name", "K")){
					$Sql .= "$con event_name='" . $this->getProperty("event_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("event_descripton", "K")){
					$Sql .= "$con event_descripton='" . $this->getProperty("event_descripton") . "'";
					$con = ",";
				}
				if($this->isPropertySet("expected_date", "K")){
					$Sql .= "$con expected_date='" . $this->getProperty("expected_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("project_event_id", "V"))
					$Sql .= " AND project_event_id='" . $this->getProperty("project_event_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_property_project_event SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND project_event_id=" . $this->getProperty("project_event_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Property Share List to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPropertyShares($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_property_shares(
						property_share_id,
						project_id,
						property_id,
						project_type_id,
						property_floor_id,
						property_share_number,
						property_share_status,
						property_lock_days,
						property_lock_till_date,
						share_unit_size,
						entery_datetime,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("property_share_id", "V") ? $this->getProperty("property_share_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_id", "V") ? $this->getProperty("project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_type_id", "V") ? $this->getProperty("project_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_floor_id", "V") ? $this->getProperty("property_floor_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_share_number", "V") ? "'" . $this->getProperty("property_share_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_share_status", "V") ? "'" . $this->getProperty("property_share_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_lock_days", "V") ? "'" . $this->getProperty("property_lock_days") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_lock_till_date", "V") ? "'" . $this->getProperty("property_lock_till_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("share_unit_size", "V") ? "'" . $this->getProperty("share_unit_size") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_datetime", "V") ? "'" . $this->getProperty("entery_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_property_shares SET ";
				
				if($this->isPropertySet("property_share_number", "K")){
					$Sql .= "$con property_share_number='" . $this->getProperty("property_share_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_share_status", "K")){
					$Sql .= "$con property_share_status='" . $this->getProperty("property_share_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_lock_days", "K")){
					$Sql .= "$con property_lock_days='" . $this->getProperty("property_lock_days") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_lock_till_date", "K")){
					$Sql .= "$con property_lock_till_date='" . $this->getProperty("property_lock_till_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("property_share_id", "V"))
					$Sql .= " AND property_share_id='" . $this->getProperty("property_share_id") . "'";
				
				if($this->isPropertySet("property_id", "V"))
					$Sql .= " AND property_id='" . $this->getProperty("property_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_property_shares SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND property_share_id=" . $this->getProperty("property_share_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Projects List to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actProjects($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_projects(
						project_id,
						project_name,
						project_description,
						project_location,
						project_contact_number,
						project_type,
						entery_datetime,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("project_id", "V") ? $this->getProperty("project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_name", "V") ? "'" . $this->getProperty("project_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_description", "V") ? "'" . $this->getProperty("project_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_location", "V") ? "'" . $this->getProperty("project_location") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_contact_number", "V") ? "'" . $this->getProperty("project_contact_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_type", "V") ? "'" . $this->getProperty("project_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_datetime", "V") ? "'" . $this->getProperty("entery_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_projects SET ";
				
				if($this->isPropertySet("project_name", "K")){
					$Sql .= "$con project_name='" . $this->getProperty("project_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("project_description", "K")){
					$Sql .= "$con project_description='" . $this->getProperty("project_description") . "'";
					$con = ",";
				}
				if($this->isPropertySet("project_location", "K")){
					$Sql .= "$con project_location='" . $this->getProperty("project_location") . "'";
					$con = ",";
				}
				if($this->isPropertySet("project_contact_number", "K")){
					$Sql .= "$con project_contact_number='" . $this->getProperty("project_contact_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("project_type", "K")){
					$Sql .= "$con project_type='" . $this->getProperty("project_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("project_id", "V"))
					$Sql .= " AND project_id='" . $this->getProperty("project_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_projects SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND project_id=" . $this->getProperty("project_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Projects Gallery to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actProjectGallery($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_projects_gallery(
						project_gallery_id,
						project_id,
						user_id,
						file_type,
						file_name,
						isActive,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("project_gallery_id", "V") ? $this->getProperty("project_gallery_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_id", "V") ? $this->getProperty("project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("file_type", "V") ? $this->getProperty("file_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("file_name", "V") ? "'" . $this->getProperty("file_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_projects SET ";
				
				if($this->isPropertySet("file_name", "K")){
					$Sql .= "$con file_name='" . $this->getProperty("file_name") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("project_gallery_id", "V"))
					$Sql .= " AND project_gallery_id='" . $this->getProperty("project_gallery_id") . "'";
						
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_projects_gallery SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("project_gallery_id", "V")){
					$Sql .= " AND project_gallery_id='" . $this->getProperty("project_gallery_id") . "'";
				}
				
				if($this->isPropertySet("project_id", "V")){
					$Sql .= " AND project_id='" . $this->getProperty("project_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Projects Floor Payment Info to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actFloorPaymentPlan($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_projects_floor_payment_detail(
							floor_payment_id,
							project_id,
							floor_id,
							user_id,
							rate_per_sq_ft,
							payback_cutting,
							pb_cutting_value,
							unit_transfer_fee,
							unit_rent_value,
							registration_fee,
							entery_date,
							isActive) 
							VALUES(";
				$Sql .= $this->isPropertySet("floor_payment_id", "V") ? $this->getProperty("floor_payment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("project_id", "V") ? $this->getProperty("project_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("floor_id", "V") ? $this->getProperty("floor_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rate_per_sq_ft", "V") ? "'" . $this->getProperty("rate_per_sq_ft") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_cutting", "V") ? "'" . $this->getProperty("payback_cutting") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pb_cutting_value", "V") ? "'" . $this->getProperty("pb_cutting_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unit_transfer_fee", "V") ? "'" . $this->getProperty("unit_transfer_fee") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unit_rent_value", "V") ? "'" . $this->getProperty("unit_rent_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("registration_fee", "V") ? "'" . $this->getProperty("registration_fee") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_projects_floor_payment_detail SET ";
				
				if($this->isPropertySet("rate_per_sq_ft", "K")){
					$Sql .= "$con rate_per_sq_ft='" . $this->getProperty("rate_per_sq_ft") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_cutting", "K")){
					$Sql .= "$con payback_cutting='" . $this->getProperty("payback_cutting") . "'";
					$con = ",";
				}
				if($this->isPropertySet("pb_cutting_value", "K")){
					$Sql .= "$con pb_cutting_value='" . $this->getProperty("pb_cutting_value") . "'";
					$con = ",";
				}
				if($this->isPropertySet("unit_transfer_fee", "K")){
					$Sql .= "$con unit_transfer_fee='" . $this->getProperty("unit_transfer_fee") . "'";
					$con = ",";
				}
				if($this->isPropertySet("unit_rent_value", "K")){
					$Sql .= "$con unit_rent_value='" . $this->getProperty("unit_rent_value") . "'";
					$con = ",";
				}
				if($this->isPropertySet("registration_fee", "K")){
					$Sql .= "$con registration_fee='" . $this->getProperty("registration_fee") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("floor_payment_id", "V")){
					$Sql .= " AND floor_payment_id='" . $this->getProperty("floor_payment_id") . "'";
				}
				if($this->isPropertySet("floor_payment_id_not", "V")){
					$Sql .= " AND floor_payment_id!=" . $this->getProperty("floor_payment_id_not");
				}
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_projects_floor_payment_detail SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("floor_payment_id", "V")){
					$Sql .= " AND floor_payment_id='" . $this->getProperty("floor_payment_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Unit Temp Lock Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUnitTempLock($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_unit_temp_lock(
						temp_lock_id,
						property_share_id,
						user_id,
						customer_old_id,
						customer_fname,
						customer_lname,
						customer_father,
						customer_cnic,
						customer_email,
						customer_c_address,
						customer_p_address,
						customer_phone,
						customer_mobile,
						customer_mobile_2,
						received_amount,
						adjustment_code,
						ledger_code,
						adjustment_status,
						adjustment_date,
						till_lock_duration,
						lock_status,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("temp_lock_id", "V") ? $this->getProperty("temp_lock_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_share_id", "V") ? $this->getProperty("property_share_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_old_id", "V") ? "'" . $this->getProperty("customer_old_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_fname", "V") ? "'" . $this->getProperty("customer_fname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_lname", "V") ? "'" . $this->getProperty("customer_lname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_father", "V") ? "'" . $this->getProperty("customer_father") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_cnic", "V") ? "'" . $this->getProperty("customer_cnic") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_email", "V") ? "'" . $this->getProperty("customer_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_c_address", "V") ? "'" . $this->getProperty("customer_c_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_p_address", "V") ? "'" . $this->getProperty("customer_p_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_phone", "V") ? "'" . $this->getProperty("customer_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_mobile", "V") ? "'" . $this->getProperty("customer_mobile") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_mobile_2", "V") ? "'" . $this->getProperty("customer_mobile_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_amount", "V") ? "'" . $this->getProperty("received_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("adjustment_code", "V") ? "'" . $this->getProperty("adjustment_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ledger_code", "V") ? "'" . $this->getProperty("ledger_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("adjustment_status", "V") ? "'" . $this->getProperty("adjustment_status") . "'" : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("adjustment_date", "V") ? "'" . $this->getProperty("adjustment_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("till_lock_duration", "V") ? "'" . $this->getProperty("till_lock_duration") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lock_status", "V") ? $this->getProperty("lock_status") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_unit_temp_lock SET ";
				
				if($this->isPropertySet("property_share_id", "K")){
					$Sql .= "$con property_share_id='" . $this->getProperty("property_share_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("adjustment_code", "K")){
					$Sql .= "$con adjustment_code='" . $this->getProperty("adjustment_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("adjustment_status", "K")){
					$Sql .= "$con adjustment_status='" . $this->getProperty("adjustment_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("adjustment_date", "K")){
					$Sql .= "$con adjustment_date='" . $this->getProperty("adjustment_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("ledger_code", "K")){
					$Sql .= "$con ledger_code='" . $this->getProperty("ledger_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("lock_status", "K")){
					$Sql .= "$con lock_status='" . $this->getProperty("lock_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("aplic_id", "K")){
					$Sql .= "$con aplic_id='" . $this->getProperty("aplic_id") . "'";
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("temp_lock_id", "V"))
					$Sql .= " AND temp_lock_id=" . $this->getProperty("temp_lock_id");
				
				/*if($this->isPropertySet("property_id", "V"))
					$Sql .= " AND property_id=" . $this->getProperty("property_id");*/
					
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