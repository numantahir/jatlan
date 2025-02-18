<?php
/**
*
* This is a class Qayaduser
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class Qayaduser extends Database{
	public $user_login;
	public $user_id;
	public $user_mobile;
	public $fullname;
	public $user_fname;
	public $login_time;
	public $ProTmpID;
	public $user_type;
	public $profile_img;
	public $location_id;
	public $sd_panel;
	public $sd_code;

	/**
	* This is the constructor of the class User
	* @author Numan Tahir <numan_tahir1@yahoo.com>
	*/
	public function __construct(){
		parent::__construct();

		if($_SESSION['user_login']){
			$this->gen_fir		 	= $_SESSION['gen_fir'];
			$this->user_login 		= $_SESSION['user_login'];
			$this->user_id			= $_SESSION['user_id'];
			$this->user_mobile 		= $_SESSION['user_mobile'];
			$this->fullname			= $_SESSION['fullname'];
			$this->login_time		= $_SESSION['login_time'];
			$this->user_fname		= $_SESSION['user_fname'];
			$this->user_type		= $_SESSION['user_type'];
			$this->profile_img		= $_SESSION['profile_img'];
			$this->location_id		= $_SESSION['location_id'];
			$this->sd_panel			= $_SESSION['sd_panel'];
			$this->sd_code			= $_SESSION['sd_code'];
		}
		if($_SESSION['ProTmpID']){
			$this->ProTmpID			= $_SESSION['ProTmpID'];
		}
	}

	/**
	* This is the function to Generate Unique Code for session.
	* @author Numan Tahir
	*/
	function generate_fingerprint()  {
		//We don't use the ip-adress, because it is subject to change in most cases
		foreach(array('HTTP_HOST', 'HTTP_ACCEPT', 'SERVER_NAME', 'HTTP_USER_AGENT') as $name) {
			$key[] = empty($_SERVER[$name]) ? NULL : $_SERVER[$name];
		}
		
		if($this->user_id != ''){
		$key[] = '/'.SITE_NAME.'/'.SITE_URL.'/'.session_id().'/'.date("Ymd").'/'.$this->user_id;
		} else {
		$key[] = '/'.SITE_NAME.'/'.SITE_URL.'/'.session_id().'/'.date("Ymd").'/'.$this->getProperty("user_id");	
		}
		//Create an MD5 has and return it
		return md5(implode("\0", $key));
	}

	/**
	* This is the function to set the customer logged in
	* @author Numan Tahir
	*/
	public function setLogin(){
		
		$_SESSION['gen_fir'] 		= $this->generate_fingerprint();
		
		$_SESSION['user_login'] 	= true;
		
		# Logged in customer's member code
		if($this->isPropertySet("user_id", "V"))
			$_SESSION['user_id'] = $this->getProperty("user_id");
		
		# Logged in customer's email
		if($this->isPropertySet("user_mobile", "V"))
			$_SESSION['user_mobile'] = $this->getProperty("user_mobile");
		
		# Logged in customer's logged in time
		if($this->isPropertySet("login_time", "V"))
			$_SESSION['login_time'] 	= $this->getProperty("login_time");
		
		# Logged in customer's fullname
		if($this->isPropertySet("fullname", "V"))
			$_SESSION['fullname'] = $this->getProperty("fullname");
		
		# Logged in customer's first name
		if($this->isPropertySet("user_fname", "V"))
			$_SESSION['user_fname'] = $this->getProperty("user_fname");
			
		# Logged in customer's Type
		if($this->isPropertySet("user_type", "V"))
			$_SESSION['user_type'] = $this->getProperty("user_type");
		
		# Logged in User Profile
		if($this->isPropertySet("profile_img", "V"))
			$_SESSION['profile_img'] = $this->getProperty("profile_img");
		
		# Logged in User Location
		if($this->isPropertySet("location_id", "V"))
			$_SESSION['location_id'] = $this->getProperty("location_id");
		
		# Logged in User SD Code
		if($this->isPropertySet("sd_code", "V"))
			$_SESSION['sd_code'] = $this->getProperty("sd_code");
			
		# Logged in User Salary Detail Panel
		$_SESSION['sd_panel'] = "false";
	}
	
	/**
	* This is the function to set the customer logged in
	* @author Numan Tahir
	*/
	public function setSecurityCode(){
		
		$_SESSION['sd_panel'] 	= "true";
		
		# Logged in User SD Code
		if($this->isPropertySet("sd_code", "V"))
			$_SESSION['sd_code'] = $this->getProperty("sd_code");
			
	}
	/**
	* This function is used to check whether the customer has been logged in or not.
	* @author Numan Tahir
	*/
	public function checkLogin(){
		if($this->user_login && $this->gen_fir==$this->generate_fingerprint()){
			return true;
		}
		else{
			return false;
		}
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

	public function getImagename($type, $user_id = ''){
		$md5 		= md5(time());
		$filename 	=  substr($md5, rand(5, 25), 5);
		if($user_id != ''){
			$filename = $filename . '-' . $user_id . "." . $this->getExtention($type);
		}
		else{
			$filename = $filename . "." . $this->getExtention($type);
		}
		return $filename;
	}
	
	/**
 	* Product::getDocumentName()	
	* This method is used to get image name
	* @author Numan Tahir
	* @Date : 27 Oct, 2018
	* @return : bool
	*/

	public function getDocumentName($filanname, $user_id = ''){
		$md5 		= md5(time());
		$filename 	=  substr($md5, rand(5, 25), 5);
		if($user_id != ''){
			$filename = $filename . '-' . $user_id . "." . end(explode('.', $filanname));
		}
		else{
			$filename = $filename . "." . end(explode('.', $filanname));
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
	* This is the function to set the Temp Request Register
	* @author Numan Tahir
	*/
	public function settmpReg(){
		
		# Register Product ID
		if($this->isPropertySet("ProTmpID", "V"))
			$_SESSION['ProTmpID'] 		= $this->getProperty("ProTmpID");
	}
	
	/**
	* This is the function to set the Temp Request Un-Register
	* @author Numan Tahir
	*/
	public function UnRegTmp(){
		unset($_SESSION['ProTmpID']);
	}
	
	/**
	* This is the function to the Check User Email Address
	* @author Numan Tahir
	*/
	public function CheckUserEmail(){
		$Sql = "SELECT 
					user_id,
					user_email
				FROM
					rs_tbl_users
				WHERE 
					1=1";
		if($this->isPropertySet("user_email", "V"))
			$Sql .= " AND user_email='" . $this->getProperty("user_email") . "'";
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This is the function to the Check User Mobile Number
	* @author Numan Tahir
	*/
	public function CheckUserMobile(){
		$Sql = "SELECT 
					user_id,
					user_mobile
				FROM
					rs_tbl_users
				WHERE 
					1=1";
		if($this->isPropertySet("user_mobile", "V"))
			$Sql .= " AND user_mobile='" . $this->getProperty("user_mobile") . "'";
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This is the function to the Check Leads Phone Number
	* @author Numan Tahir
	*/
	public function CheckLeadPhone(){
		$Sql = "SELECT 
					leads_id,
					client_phone_number
				FROM
					rs_tbl_leads
				WHERE 
					1=1";
		if($this->isPropertySet("client_phone_number", "V"))
			$Sql .= " AND client_phone_number='" . $this->getProperty("client_phone_number") . "'";
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to check the user login
	* @author Numan Tahir
	*/
	public function checkUserLogin(){
		$Sql = "SELECT 
					user_id,
					user_email,
					user_mobile,
					user_pass,
					user_fname,
					user_lname,
					CONCAT(user_fname,' ',user_lname) AS fullname,
					user_type_id,
					isActive,
					login_required,
					user_profile_img,
					sms_verification,
					short_code,
					location_id
				FROM
					rs_tbl_users
				WHERE 
					1=1";
		if($this->isPropertySet("user_email", "V"))
			$Sql .= " AND user_email='" . $this->getProperty("user_email") . "'";
		
		if($this->isPropertySet("user_mobile", "V"))
			$Sql .= " AND user_mobile='" . $this->getProperty("user_mobile") . "'";
		
		if($this->isPropertySet("short_code", "V"))
			$Sql .= " AND short_code='" . $this->getProperty("short_code") . "'";
		
		if($this->isPropertySet("login_required", "V"))
			$Sql .= " AND login_required='" . $this->getProperty("login_required") . "'";
				
		if($this->isPropertySet("user_type_id", "V"))
			$Sql .= " AND user_type_id=" . $this->getProperty("user_type_id");
			
		if($this->isPropertySet("user_pass", "V"))
			$Sql .= " AND user_pass='" . $this->getProperty("user_pass") . "'";
		
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to check the user Security Code
	* @author Numan Tahir
	*/
	public function checkUserSecurityCode(){
		$Sql = "SELECT 
					user_id,
					user_security_code
				FROM
					rs_tbl_users
				WHERE 
					1=1";
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id='" . $this->getProperty("user_id") . "'";
		
		if($this->isPropertySet("user_security_code", "V"))
			$Sql .= " AND user_security_code='" . $this->getProperty("user_security_code") . "'";
		
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to Activate user account
	* @author Numan Tahir
	*/
	public function UserActivate(){
		$Sql = "UPDATE rs_tbl_users SET
					isActive=1
				WHERE 
					1=1";
					
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function customerCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname, ' ', user_lname) as fullname
				FROM
					rs_tbl_users
				WHERE
					1=1 
					AND isActive=1 ORDER BY user_fname";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['user_id'] == $sel)
				$opt .= "<option value=\"" . $rows['user_id'] . "\" selected>" . $rows['fullname'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['user_id'] . "\">" . $rows['fullname'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Leave Type Combo
	* @author Numan Tahir
	*/
	public function LeaveTypeCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					leave_type_id,
					leave_name
				FROM
					rs_tbl_leave_type
				WHERE
					1=1 
					AND isActive=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['leave_type_id'] == $sel)
				$opt .= "<option value=\"" . $rows['leave_type_id'] . "\" selected>" . $rows['leave_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['leave_type_id'] . "\">" . $rows['leave_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Yearly Leave Type Combo
	* @author Numan Tahir
	*/
	public function YearlyLeaveTypeCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					yearly_leave_type_id,
					yearly_leave_name
				FROM
					rs_tbl_yearly_leave_type
				WHERE
					1=1 
					AND isActive=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['yearly_leave_type_id'] == $sel)
				$opt .= "<option value=\"" . $rows['yearly_leave_type_id'] . "\" selected>" . $rows['yearly_leave_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['yearly_leave_type_id'] . "\">" . $rows['yearly_leave_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function ComplainTeamCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname, ' ', user_lname) as fullname
				FROM
					rs_tbl_users
				WHERE
					1=1 
					AND isActive=1 AND user_type_id=5 ORDER BY user_fname";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['user_id'] == $sel)
				$opt .= "<option value=\"" . $rows['user_id'] . "\" selected>" . $rows['fullname'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['user_id'] . "\">" . $rows['fullname'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function EmployeeCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname, ' ', user_lname) as fullname
				FROM
					rs_tbl_users
				WHERE
					1=1 
					AND isActive=1 AND user_type_id!=1 AND device_uid!=0 ORDER BY user_fname";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['user_id'] == $sel)
				$opt .= "<option value=\"" . $rows['user_id'] . "\" selected>" . $rows['fullname'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['user_id'] . "\">" . $rows['fullname'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Employee Combo return DeviceId
	* @author Numan Tahir
	*/
	public function EmployeeComboDeviceId($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					device_uid,
					CONCAT(user_fname, ' ', user_lname) as fullname
				FROM
					rs_tbl_users
				WHERE
					1=1 
					AND isActive=1 AND user_type_id!=1 AND device_uid!=0";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['device_uid'] == $sel)
				$opt .= "<option value=\"" . $rows['device_uid'] . "\" selected>" . $rows['fullname'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['device_uid'] . "\">" . $rows['fullname'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Shift Combo
	* @author Numan Tahir
	*/
	public function ShiftCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					shift_id,
					shift_name
				FROM
					rs_tbl_shifts
				WHERE
					1=1 
					AND isActive=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['shift_id'] == $sel)
				$opt .= "<option value=\"" . $rows['shift_id'] . "\" selected>" . $rows['shift_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['shift_id'] . "\">" . $rows['shift_name'] . "</option>\n";
		}
			if($sel != '' && $sel==0){
				$opt .= "<option value=\"0\" selected>Off Day  ".$sel."</option>";
			} else {
				$opt .= "<option value=\"0\">Off Day ".$sel."</option>";
			}
		return $opt;
	}
	
	/**
	* This method is used to the Shift Combo
	* @author Numan Tahir
	*/
	public function GetShiftName($shifid){
		$opt = "";
		$Sql = "SELECT
					shift_id,
					shift_name
				FROM
					rs_tbl_shifts
				WHERE
					1=1 
					AND isActive=1 AND shift_id='".$shifid."'";
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
		return $rows['shift_name'];
	}	
	
	/**
	* This method is used to the Agent's combo
	* @author Numan Tahir
	*/
	public function FinanceEmployeeListCombo(){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname, ' ', user_lname) as fullname,
					user_type_id
				FROM
					rs_tbl_users
				WHERE
					1=1 
					AND isActive=1 AND user_type_id IN (3,19,20)";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['user_id'] == $sel)
				$opt .= "<option value=\"" . $rows['user_id'] . "\" selected>" . $rows['fullname'] . ' => [' . UserType($rows['user_type_id']) . "]</option>\n";
			else
				$opt .= "<option value=\"" . $rows['user_id'] . "\">" . $rows['fullname'] . ' => [' . UserType($rows['user_type_id']) . "]</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Agent's combo
	* @author Numan Tahir
	*/
	public function EmployeeListCombo(){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname, ' ', user_lname) as fullname,
					user_type_id
				FROM
					rs_tbl_users
				WHERE
					1=1 
					AND isActive=1 AND user_type_id!=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['user_id'] == $sel)
				$opt .= "<option value=\"" . $rows['user_id'] . "\" selected>" . $rows['fullname'] . ' => [' . UserType($rows['user_type_id']) . "]</option>\n";
			else
				$opt .= "<option value=\"" . $rows['user_id'] . "\">" . $rows['fullname'] . ' => [' . UserType($rows['user_type_id']) . "]</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Agent's combo
	* @author Numan Tahir
	*/
	public function AgentCombo($location_id,$not_user_type_id){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname, ' ', user_lname) as fullname,
					user_type_id
				FROM
					rs_tbl_users
				WHERE
					1=1 
					AND isActive=1 AND location_id='".$location_id."' AND (user_type_id!='".$not_user_type_id."' and user_type_id!=1)";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['user_id'] == $sel)
				$opt .= "<option value=\"" . $rows['user_id'] . "\" selected>" . $rows['fullname'] . ' => [' . UserType($rows['user_type_id']) . "]</option>\n";
			else
				$opt .= "<option value=\"" . $rows['user_id'] . "\">" . $rows['fullname'] . ' => [' . UserType($rows['user_type_id']) . "]</option>\n";
		}
		return $opt;
	}	
	
	/**
	* This method is used to the Mogration combo
	* @author Numan Tahir
	*/
	public function MogrationCombo(){
		$opt = "";
		$Sql = "SELECT
					loc.location_id,
					loc.location_name,
					loc.isActive,
					comp.company_name
				FROM
					rs_tbl_location as loc
					INNER JOIN rs_tbl_companies as comp
						ON (loc.company_id = comp.company_id)
				WHERE
					1=1 
					AND loc.isActive=1 AND loc.location_id!='".$this->location_id."'";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['location_id'] == $sel)
				$opt .= "<option value=\"" . $rows['location_id'] . "\" selected>" . $rows['company_name'] .'->'. $rows['location_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['location_id'] . "\">" . $rows['company_name'] .'->'. $rows['location_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the location combo
	* @author Numan Tahir
	*/
	public function LocationCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					location_id,
					location_name
				FROM
					rs_tbl_location
				WHERE
					1=1 
					AND isActive=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['location_id'] == $sel)
				$opt .= "<option value=\"" . $rows['location_id'] . "\" selected>" . $rows['location_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['location_id'] . "\">" . $rows['location_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the location combo SelectedBase
	* @author Numan Tahir
	*/
	public function LocationComboWTL($sel = ""){
		$opt = "";
		$Sql = "SELECT
					loc.location_id,
					loc.location_name,
					loc.isActive,
					comp.company_name,
					(SELECT count(user_id) FROM rs_tbl_users as u WHERE u.location_id=loc.location_id AND teamlead_status=2) as nooftl
				FROM
					rs_tbl_location as loc
					INNER JOIN rs_tbl_companies as comp
						ON (loc.company_id = comp.company_id)
				WHERE
					1=1 
					AND loc.isActive=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['location_id'] == $sel)
				$opt .= "<option value=\"" . $rows['location_id'] . "\" selected>" . $rows['company_name'] .'->'. $rows['location_name'] . " (No.of TL ".$rows['nooftl'] . ")" . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['location_id'] . "\">" . $rows['company_name'] .'->'. $rows['location_name'] . " (No.of TL ".$rows['nooftl'] . ")" . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Company combo
	* @author Numan Tahir
	*/
	public function CompanyCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					company_id,
					company_name
				FROM
					rs_tbl_companies
				WHERE
					1=1 
					AND isActive=1";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['company_id'] == $sel)
				$opt .= "<option value=\"" . $rows['company_id'] . "\" selected>" . $rows['company_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['company_id'] . "\">" . $rows['company_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Get location Name
	* @author Numan Tahir
	*/
	public function GetLocation($location_id){
		$Sql = "SELECT
					loc.location_id,
					loc.location_name,
					loc.isActive,
					comp.company_name
				FROM
					rs_tbl_location as loc
					INNER JOIN rs_tbl_companies as comp
						ON (loc.company_id = comp.company_id)
				WHERE
					1=1 
					AND loc.isActive=1 AND loc.location_id='".$location_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['location_name'];
	}
	
	/**
	* This method is used to the Job Title Combo
	* @author Numan Tahir
	*/
	public function JobTitleCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					job_title_id,
					job_title
				FROM
					rs_tbl_job_title
				WHERE
					1=1 
					AND isActive=1 Order By job_title";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['job_title_id'] == $sel)
				$opt .= "<option value=\"" . $rows['job_title_id'] . "\" selected>" . $rows['job_title'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['job_title_id'] . "\">" . $rows['job_title'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Department
	* @author Numan Tahir
	*/
	public function DepartmentCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					dp.department_id,
					dp.user_id,
					dp.company_id,
					dp.department_name,
					dp.isActive,
					cp.company_name
				FROM
					rs_tbl_department as dp
					INNER JOIN rs_tbl_companies cp
						ON (dp.company_id = cp.company_id)
				WHERE
					1=1 
					AND dp.isActive=1 Order By department_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['department_id'] == $sel)
				$opt .= "<option value=\"" . $rows['department_id'] . "\" selected>" .  $rows['department_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['department_id'] . "\">" .  $rows['department_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Get Company & location Name
	* @author Numan Tahir
	*/
	public function GetComLocInfo($location_id){
		$Sql = "SELECT
					loc.location_id,
					loc.location_name,
					loc.isActive,
					comp.company_name
				FROM
					rs_tbl_location as loc
					INNER JOIN rs_tbl_companies as comp
						ON (loc.company_id = comp.company_id)
				WHERE
					1=1 
					AND loc.isActive=1 AND loc.location_id='".$location_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['company_name'].'/'.$rows['location_name'];
	}
	
	/**
	* This method is used to the Get Company & Department Name
	* @author Numan Tahir
	*/
	public function GetComDeptInfo($department_id){
		$Sql = "SELECT
					dept.department_id,
					dept.department_name,
					dept.isActive,
					comp.company_name
				FROM
					rs_tbl_department as dept
					INNER JOIN rs_tbl_companies as comp
						ON (dept.company_id = comp.company_id)
				WHERE
					1=1 
					AND dept.isActive=1 AND dept.department_id='".$department_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['company_name'].'/'.$rows['department_name'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetUserFullName($user_id){
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname,' ',user_lname) AS fullname
				FROM
					rs_tbl_users
				WHERE
					1=1 
					 AND user_id='".$user_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['fullname'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetTeamLeadsCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					user_id,
					CONCAT(user_fname,' ',user_lname) AS fullname
				FROM
					rs_tbl_users
				WHERE
					1=1 
					 AND teamlead_status=2 AND location_id=".$this->location_id. " AND user_id=".$sel;
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
				$opt .= "<option value=\"" . $rows['user_id'] . "\" selected>" . $rows['fullname'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetUserFullNameByDeviceId($Device_Uid){
		$Sql = "SELECT 
					device_uid,
					CONCAT(user_fname,' ',user_lname) AS fullname
				FROM
					rs_tbl_users
				WHERE
					1=1 
					 AND device_uid='".$Device_Uid."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['fullname'];
	}
	
	/**
	* This method is used to the Get User Device ID
	* @author Numan Tahir
	*/
	public function GetUserDeviceId($user_id){
		$Sql = "SELECT 
					device_uid
				FROM
					rs_tbl_users
				WHERE
					1=1 
					 AND user_id='".$user_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['device_uid'];
	}
	
	/**
	* This method is used to the Get User ID By Device ID
	* @author Numan Tahir
	*/
	public function GetUserIdByDeviceId($device_uid){
		$Sql = "SELECT 
					user_id
				FROM
					rs_tbl_users
				WHERE
					1=1 
					 AND device_uid='".$device_uid."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['user_id'];
	}
	
	/**
	* This function is used to list the users
	* @author Numan Tahir
	*/
	public function lstUsers(){
		$Sql = "SELECT 
					user_id,
					enter_user_id,
					device_uid,
					user_email,
					user_mobile,
					user_pass,
					user_fname,
					user_lname,
					CONCAT(user_fname,' ',user_lname) AS fullname,
					user_address,
					user_phone,
					user_cnic,
					user_type_id,
					user_designation,
					user_signature,
					user_profile_img,
					sms_verification,
					short_code,
					location_id,
					login_required,
					isActive,
					reg_date,
					user_code,
					user_gender,
					user_dob,
					user_marital_status,
					blood_group,
					cnic_front_side,
					cnic_back_side,
					user_cv,
					teamlead_status,
					teamlead_date,
					teamlead_id,
					user_security_code,
					DATE_FORMAT(user_dob, '%m-%d') AS upcoming_dob,
					vehicle_id
				FROM
					rs_tbl_users 
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("enter_user_id", "V"))
			$Sql .= " AND enter_user_id=" . $this->getProperty("enter_user_id");
		
		if($this->isPropertySet("device_uid", "V"))
			$Sql .= " AND device_uid=" . $this->getProperty("device_uid");
		
		if($this->isPropertySet("device_uid_not", "V"))
			$Sql .= " AND device_uid!=0";
			
		if($this->isPropertySet("user_id_not", "V"))
			$Sql .= " AND user_id!=" . $this->getProperty("user_id_not");
			
		if($this->isPropertySet("search_user", "V")){
			$Sql .= " AND (LOWER(user_fname) LIKE '%" . $this->getProperty("search_user") . "%' OR LOWER(user_lname) LIKE '%" . $this->getProperty("search_user") . "%')";
		}
		if($this->isPropertySet("user_email", "V"))
			$Sql .= " AND user_email='" . $this->getProperty("user_email") . "'";
		
		if($this->getProperty("user_type_id", "V"))
			$Sql .= " AND user_type_id='" . $this->getProperty("user_type_id") ."'";
		
		if($this->getProperty("user_type_id_not", "V"))
			$Sql .= " AND user_type_id!='" . $this->getProperty("user_type_id_not") ."'";
			
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") ."'";
		
		if($this->getProperty("user_mobile", "V"))
			$Sql .= " AND user_mobile='" . $this->getProperty("user_mobile") ."'";
		
		if($this->getProperty("user_cnic", "V"))
			$Sql .= " AND user_cnic='" . $this->getProperty("user_cnic") ."'";
		
		if($this->getProperty("short_code", "V"))
			$Sql .= " AND short_code='" . $this->getProperty("short_code") ."'";
		
		if($this->getProperty("sms_verification", "V"))
			$Sql .= " AND sms_verification='" . $this->getProperty("sms_verification") ."'";
		
		if($this->getProperty("login_required", "V"))
			$Sql .= " AND login_required='" . $this->getProperty("login_required") ."'";
		
		if($this->getProperty("location_id", "V"))
			$Sql .= " AND location_id='" . $this->getProperty("location_id") ."'";
		
		if($this->getProperty("user_dob_up", "V"))
			$Sql .= " AND DATE_FORMAT(user_dob, '%m-%d') >= '" . $this->getProperty("user_dob_up") ."'";

		if($this->getProperty("isNot", "V"))
			$Sql .= " AND isActive!='" . $this->getProperty("isNot") ."'";
		
		if($this->getProperty("user_type_id_array", "V"))
			$Sql .= " AND user_type_id IN (".$this->getProperty("user_type_id_array"). ")";
		
		if($this->getProperty("teamlead_status", "V"))
			$Sql .= " AND teamlead_status='" . $this->getProperty("teamlead_status") ."'";
		
		if($this->getProperty("teamlead_id", "V"))
			$Sql .= " AND teamlead_id='" . $this->getProperty("teamlead_id") . "'";
		
		if($this->getProperty("vehicle_id", "V"))
			$Sql .= " AND vehicle_id='" . $this->getProperty("vehicle_id") . "'";
			
		if($this->getProperty("teamlead_id_zero", "V"))
			$Sql .= " AND teamlead_id='0'";
		
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
							
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the User Log
	* @author Numan Tahir
	*/
	public function lstUserLog(){
		$Sql = "SELECT 
					log_id,
					user_id,
					activity_detail,
					entity_id,
					isActive,
					entery_date
				FROM
					rs_tbl_user_log 
				WHERE 
					1=1";
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id='" . $this->getProperty("user_id") ."'";
		
		if($this->getProperty("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") ."'";
		
		if($this->getProperty("entity_id", "V"))
			$Sql .= " AND entity_id='" . $this->getProperty("entity_id") ."'";
		
		if($this->getProperty("log_type", "V"))
			$Sql .= " AND log_type='" . $this->getProperty("log_type") ."'";
					
		if($this->isPropertySet("stat_date", "V"))
			$Sql .= " AND entery_date >='" . $this->getProperty("stat_date") . "'";	

		if($this->isPropertySet("end_date", "V"))
			$Sql .= " AND entery_date <='" . $this->getProperty("end_date") . "'";	
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the User Deivce List
	* @author Numan Tahir
	*/
	public function lstUserDeviceList(){
		$Sql = "SELECT 
					verification_id,
					device_id,
					user_id,
					security_code,
					mobile_status,
					verification_date,
					entery_date,
					isActive
				FROM
					rs_tbl_user_device_list
				WHERE 
					1=1";
		
		if($this->getProperty("verification_id", "V"))
			$Sql .= " AND verification_id='" . $this->getProperty("verification_id") ."'";
		
		if($this->getProperty("device_id", "V"))
			$Sql .= " AND device_id='" . $this->getProperty("device_id") ."'";
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id='" . $this->getProperty("user_id") ."'";
		
		if($this->getProperty("security_code", "V"))
			$Sql .= " AND security_code='" . $this->getProperty("security_code") ."'";
		
		if($this->getProperty("mobile_status", "V"))
			$Sql .= " AND mobile_status='" . $this->getProperty("mobile_status") ."'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Messages List
	* @author Numan Tahir
	*/
	public function lstMailbox(){
		$Sql = "SELECT 
					mail_id,
					sender_id,
					receiver_id,
					mail_subject,
					mail_detail,
					mail_isfile,
					is_read,
					read_date,
					sender_del,
					receiver_del,
					is_draft,
					entery_date
				FROM
					rs_tbl_mailbox
				WHERE 
					1=1";
		
		if($this->isPropertySet("mail_id", "V"))
			$Sql .= " AND mail_id=" . $this->getProperty("mail_id");
		
		if($this->isPropertySet("sender_id", "V"))
			$Sql .= " AND sender_id=" . $this->getProperty("sender_id");
		
		if($this->isPropertySet("receiver_id", "V"))
			$Sql .= " AND receiver_id=" . $this->getProperty("receiver_id");
		
		if($this->isPropertySet("mail_isfile", "V"))
			$Sql .= " AND mail_isfile=" . $this->getProperty("mail_isfile");
		
		if($this->isPropertySet("is_read", "V"))
			$Sql .= " AND is_read=" . $this->getProperty("is_read");
		
		if($this->isPropertySet("sender_del", "V"))
			$Sql .= " AND sender_del=" . $this->getProperty("sender_del");
			
		if($this->isPropertySet("receiver_del", "V"))
			$Sql .= " AND receiver_del=" . $this->getProperty("receiver_del");
		
		if($this->isPropertySet("is_draft", "V"))
			$Sql .= " AND is_draft=" . $this->getProperty("is_draft");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Messages Files
	* @author Numan Tahir
	*/
	public function lstMailboxFiles(){
		$Sql = "SELECT 
					mail_file_id,
					mail_id,
					mail_filetype,
					mail_filename,
					isActive,
					entery_date
				FROM
					rs_tbl_mailbox_file
				WHERE 
					1=1";
		
		if($this->isPropertySet("mail_file_id", "V"))
			$Sql .= " AND mail_file_id=" . $this->getProperty("mail_file_id");
		
		if($this->isPropertySet("mail_id", "V"))
			$Sql .= " AND mail_id=" . $this->getProperty("mail_id");
		
		if($this->isPropertySet("mail_filetype", "V"))
			$Sql .= " AND mail_filetype='" . $this->getProperty("mail_filetype") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Customer Messages file type 
	* @author Numan Tahir
	*/
	public function lstMailboxFileType(){
		$Sql = "SELECT 
					filetype_id,
					user_id,
					type_name,
					type_icon,
					isActive,
					entery_date
				FROM
					rs_tbl_mailbox_file_type
				WHERE 
					1=1";
		
		if($this->isPropertySet("filetype_id", "V"))
			$Sql .= " AND filetype_id=" . $this->getProperty("filetype_id");
		
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
	* This function is used to check the email address already exists or not.
	* @author Numan Tahir
	*/
	public function emailExists(){
		$Sql = "SELECT 
					user_id,
					user_email
				FROM
					rs_tbl_users
				WHERE 
					1=1";
		if($this->isPropertySet("user_email", "V"))
			$Sql .= " AND user_email='" . $this->getProperty("user_email") . "'";
			
		if($this->isPropertySet("user_type_id", "V"))
			$Sql .= " AND user_type_id=" . $this->getProperty("user_type_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id!=" . $this->getProperty("user_id");
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to check the mobile number already exists or not.
	* @author Numan Tahir
	*/
	public function MobileExists(){
		$Sql = "SELECT 
					user_id,
					user_mobile
				FROM
					rs_tbl_users
				WHERE 
					1=1";
		if($this->isPropertySet("user_mobile", "V"))
			$Sql .= " AND user_mobile='" . $this->getProperty("user_mobile") . "'";
			
		if($this->isPropertySet("user_type_id", "V"))
			$Sql .= " AND user_type_id=" . $this->getProperty("user_type_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id!=" . $this->getProperty("user_id");
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to check current password in change password
	* @author Numan Tahir
	*/
	public function checkPassword(){
		$Sql = "SELECT
					user_id
				FROM
					rs_tbl_users 
				WHERE 
					1=1";
		$Sql .= " AND user_id='" . $this->getProperty("user_id") . "'";
		
		$Sql .= " AND user_pass='" . $this->getProperty("user_pass") . "'";
		
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1)
			return true;
		else
			return false;
	}
	
	/**
	* This function is used to check current security in change code
	* @author Numan Tahir
	*/
	public function checkSecurityCode(){
		$Sql = "SELECT
					user_id
				FROM
					rs_tbl_users 
				WHERE 
					1=1";
		$Sql .= " AND user_id='" . $this->getProperty("user_id") . "'";
		
		$Sql .= " AND user_security_code='" . $this->getProperty("user_security_code") . "'";
		
		$this->dbQuery($Sql);
		if($this->totalRecords() >= 1)
			return true;
		else
			return false;
	}
	
	/**
	* This function is Top Seller Agent List
	* @author Numan Tahir
	*/
	public function VwTopSellerAgents(){
		$Sql = "SELECT 
					user_id,
					user_fname,
					user_lname,
					aplic_counter
				FROM
					vw_top_agent_seller_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Location Access
	* @author Numan Tahir
	*/
	public function lstLocation(){
		$Sql = "SELECT
					location_id,
					user_id,
					company_id,
					location_name,
					location_address,
					location_phone_1,
					location_phone_2,
					location_phone_3,
					location_fax,
					isActive
				FROM
					rs_tbl_location
				WHERE 
					1=1";
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->isPropertySet("location_id_not", "V"))
			$Sql .= " AND location_id!=" . $this->getProperty("location_id_not");
			
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
	* This function is user for Location Access
	* @author Numan Tahir
	*/
	public function lstUserMigration(){
		$Sql = "SELECT 
					migration_id,
					user_id,
					migration_user_id,
					current_location_id,
					migration_location_id,
					migration_reason,
					migration_date,
					entery_date,
					isActive
				FROM
					rs_tbl_user_migration
				WHERE 
					1=1";
		
		if($this->isPropertySet("migration_id", "V"))
			$Sql .= " AND migration_id=" . $this->getProperty("migration_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("migration_user_id", "V"))
			$Sql .= " AND migration_user_id=" . $this->getProperty("migration_user_id");
		
		if($this->isPropertySet("current_location_id", "V"))
			$Sql .= " AND current_location_id=" . $this->getProperty("current_location_id");
		
		if($this->isPropertySet("migration_location_id", "V"))
			$Sql .= " AND migration_location_id=" . $this->getProperty("migration_location_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Companies
	* @author Numan Tahir
	*/
	public function lstCompanies(){
		$Sql = "SELECT 
					company_id,
					user_id,
					company_name,
					entery_date,
					isActive
				FROM
					rs_tbl_companies
				WHERE 
					1=1";
		
		if($this->isPropertySet("company_id", "V"))
			$Sql .= " AND company_id=" . $this->getProperty("company_id");
		
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
	* This function is user for Departments
	* @author Numan Tahir
	*/
	public function lstDepartments(){
		$Sql = "SELECT
					dp.department_id,
					dp.user_id,
					dp.company_id,
					dp.department_name,
					dp.isActive,
					cp.company_name
				FROM
					rs_tbl_department as dp
					INNER JOIN rs_tbl_companies cp
						ON (dp.company_id = cp.company_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("department_id", "V"))
			$Sql .= " AND dp.department_id=" . $this->getProperty("department_id");
		
		if($this->isPropertySet("company_id", "V"))
			$Sql .= " AND dp.company_id=" . $this->getProperty("company_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND dp.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND dp.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Job Title
	* @author Numan Tahir
	*/
	public function lstJobTitle(){
		$Sql = "SELECT 
					job_title_id,
					user_id,
					job_title,
					entery_date,
					isActive
				FROM
					rs_tbl_job_title
				WHERE 
					1=1";
		
		if($this->isPropertySet("job_title_id", "V"))
			$Sql .= " AND job_title_id=" . $this->getProperty("job_title_id");
		
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
	* This function is user for Shifts
	* @author Numan Tahir
	*/
	public function lstShifts(){
		$Sql = "SELECT 
					shift_id,
					user_id,
					shift_name,
					shift_st,
					shift_et,
					shift_ligt,
					shift_logt,
					shift_eigt,
					shift_eogt,
					shift_bt,
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
					ligt_status,
					eogt_status,
					entery_date,
					isActive
				FROM
					rs_tbl_shifts
				WHERE 
					1=1";
		
		if($this->isPropertySet("shift_id", "V"))
			$Sql .= " AND shift_id=" . $this->getProperty("shift_id");
		
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
	* This function is user for Leave Types
	* @author Numan Tahir
	*/
	public function lstLeaveTypes(){
		$Sql = "SELECT 
					leave_type_id,
					user_id,
					leave_name,
					entery_date,
					isActive
				FROM
					rs_tbl_leave_type
				WHERE 
					1=1";
		
		if($this->isPropertySet("leave_type_id", "V"))
			$Sql .= " AND leave_type_id=" . $this->getProperty("leave_type_id");
		
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
	* This function is user for Holidays
	* @author Numan Tahir
	*/
	public function lstHolidays(){
		$Sql = "SELECT 
					holiday_id,
					user_id,
					holiday_name,
					holiday_sd,
					holiday_ed,
					entery_date,
					isActive
				FROM
					rs_tbl_holidays
				WHERE 
					1=1";
		
		if($this->isPropertySet("holiday_id", "V"))
			$Sql .= " AND holiday_id=" . $this->getProperty("holiday_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		

		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND holiday_sd BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
			
		if($this->isPropertySet("holiday_sd", "V"))
			$Sql .= " AND holiday_sd='" . $this->getProperty("holiday_sd") . "'";
		
		if($this->isPropertySet("holiday_sd_up", "V"))
			$Sql .= " AND holiday_sd >= '" . $this->getProperty("holiday_sd_up") . "'";
			
		if($this->isPropertySet("holiday_ed", "V"))
			$Sql .= " AND holiday_ed='" . $this->getProperty("holiday_ed") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Yearly Leave Type
	* @author Numan Tahir
	*/
	public function lstYearlyLeaveType(){
		$Sql = "SELECT 
					yearly_leave_type_id,
					user_id,
					yearly_leave_name,
					number_of_leave,
					entery_date,
					isActive,
					yearly_leave_type
				FROM
					rs_tbl_yearly_leave_type
				WHERE 
					1=1";
		
		if($this->isPropertySet("yearly_leave_type_id", "V"))
			$Sql .= " AND yearly_leave_type_id=" . $this->getProperty("yearly_leave_type_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("yearly_leave_type", "V"))
			$Sql .= " AND yearly_leave_type=" . $this->getProperty("yearly_leave_type");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for User Leave Request
	* @author Numan Tahir
	*/
	public function lstUserLeaveRequest(){
		$Sql = "SELECT
					ulr.leave_request_id,
					ulr.user_id,
					ulr.location_id,
					ulr.leave_type_id,
					ulr.yearly_leave_id,
					ulr.leave_reason,
					ulr.leave_of,
					ulr.leave_sd,
					ulr.leave_ed,
					ulr.forward_director,
					ulr.company_id,
					ulr.department_id,
					ulr.leave_status,
					ulr.hr_id,
					ulr.entery_date,
					ulr.isActive,
					ulr.noofleave,
					lt.leave_name,
					ylt.yearly_leave_name,
					ylt.yearly_leave_type
				FROM
					rs_tbl_user_leave_request as ulr
					INNER JOIN rs_tbl_leave_type as lt
						ON (ulr.leave_type_id = lt.leave_type_id)
					INNER JOIN rs_tbl_yearly_leave_type as ylt
						ON (ulr.yearly_leave_id = ylt.yearly_leave_type_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("leave_request_id", "V"))
			$Sql .= " AND ulr.leave_request_id=" . $this->getProperty("leave_request_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND ulr.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("user_id_not", "V"))
			$Sql .= " AND ulr.user_id!=" . $this->getProperty("user_id_not");
			
		if($this->isPropertySet("leave_sd_up", "V"))
			$Sql .= " AND ulr.leave_sd >='" . $this->getProperty("leave_sd_up") . "'";
		
		if($this->isPropertySet("leave_ed_dw", "V"))
			$Sql .= " AND ulr.leave_ed <='" . $this->getProperty("leave_ed_dw") . "'";
			
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND ulr.location_id=" . $this->getProperty("location_id");
		
		if($this->isPropertySet("leave_of", "V"))
			$Sql .= " AND ulr.leave_of=" . $this->getProperty("leave_of");
			
		if($this->isPropertySet("leave_type_id", "V"))
			$Sql .= " AND ulr.leave_type_id=" . $this->getProperty("leave_type_id");
		
		if($this->isPropertySet("forward_director", "V"))
			$Sql .= " AND ulr.forward_director=" . $this->getProperty("forward_director");
		
		if($this->isPropertySet("company_id", "V"))
			$Sql .= " AND ulr.company_id=" . $this->getProperty("company_id");
		
		if($this->isPropertySet("department_id", "V"))
			$Sql .= " AND ulr.department_id=" . $this->getProperty("department_id");
		
		if($this->getProperty("department_id_array", "V"))
			$Sql .= " AND ulr.department_id IN (".$this->getProperty("department_id_array"). ")";
				
		if($this->isPropertySet("leave_status", "V"))
			$Sql .= " AND ulr.leave_status=" . $this->getProperty("leave_status");
		
		if($this->isPropertySet("hr_id", "V"))
			$Sql .= " AND ulr.hr_id=" . $this->getProperty("hr_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND ulr.isActive=" . $this->getProperty("isActive");
		
		
		if($this->isPropertySet("isActive_not", "V"))
			$Sql .= " AND ulr.isActive!=" . $this->getProperty("isActive_not");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for User Emergency Contact Detail
	* @author Numan Tahir
	*/
	public function lstUserEmergency(){
		$Sql = "SELECT 
					user_emergency_id,
					user_id,
					person_name,
					contact_number,
					isActive
				FROM
					rs_tbl_user_emergency
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_emergency_id", "V"))
			$Sql .= " AND user_emergency_id=" . $this->getProperty("user_emergency_id");
		
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
	* This function is user for User Emloyment History
	* @author Numan Tahir
	*/
	public function lstUserEmploymentHistory(){
		$Sql = "SELECT 
					user_employment_id,
					user_id,
					company_name,
					job_title,
					from_date,
					end_date,
					isActive
				FROM
					rs_tbl_user_employment
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_employment_id", "V"))
			$Sql .= " AND user_employment_id=" . $this->getProperty("user_employment_id");
		
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
	* This function is user for User Job Detail
	* @author Numan Tahir
	*/
	public function lstUserJobDetail(){
		$Sql = "SELECT 
					user_job_detail_id,
					user_id,
					job_title_id,
					job_description,
					company_id,
					department_id,
					joined_date,
					service_end_date,
					job_type,
					probation_period_end_date,
					probation_period_status,
					dummy_shift_id
				FROM
					rs_tbl_user_job_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_job_detail_id", "V"))
			$Sql .= " AND user_job_detail_id=" . $this->getProperty("user_job_detail_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("job_title_id", "V"))
			$Sql .= " AND job_title_id=" . $this->getProperty("job_title_id");
		
		if($this->isPropertySet("company_id", "V"))
			$Sql .= " AND company_id=" . $this->getProperty("company_id");
			
		if($this->isPropertySet("department_id", "V"))
			$Sql .= " AND department_id=" . $this->getProperty("department_id");
		
		if($this->isPropertySet("job_type", "V"))
			$Sql .= " AND job_type=" . $this->getProperty("job_type");
		
		if($this->isPropertySet("probation_period_end_date", "V"))
			$Sql .= " AND probation_period_end_date='" . $this->getProperty("probation_period_end_date") . "'";
		
		if($this->isPropertySet("probation_period_status", "V"))
			$Sql .= " AND probation_period_status='" . $this->getProperty("probation_period_status") . "'";
					
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for User Leaves Detail
	* @author Numan Tahir
	*/
	public function lstUserleaves(){
		$Sql = "SELECT
					ul.user_leave_id,
					ul.user_id,
					ul.leave_type_id,
					ul.leave_days,
					ul.leave_attempt,
					ul.remaining_leave,
					ul.isActive,
					ylt.yearly_leave_name,
					ylt.yearly_leave_type
				FROM
					rs_tbl_user_leaves as ul
					INNER JOIN rs_tbl_yearly_leave_type as ylt
						ON (ul.leave_type_id = ylt.yearly_leave_type_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_leave_id", "V"))
			$Sql .= " AND ul.user_leave_id=" . $this->getProperty("user_leave_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND ul.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("leave_type_id", "V"))
			$Sql .= " AND ul.leave_type_id=" . $this->getProperty("leave_type_id");
		
		if($this->isPropertySet("leave_days", "V"))
			$Sql .= " AND ul.leave_days=" . $this->getProperty("leave_days");
		
		if($this->isPropertySet("leave_attempt", "V"))
			$Sql .= " AND ul.leave_attempt=" . $this->getProperty("leave_attempt");
		
		if($this->isPropertySet("remaining_leave", "V"))
			$Sql .= " AND ul.remaining_leave=" . $this->getProperty("remaining_leave");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND ul.isActive=" . $this->getProperty("isActive");
					
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for User Reference Detail
	* @author Numan Tahir
	*/
	public function lstUserReference(){
		$Sql = "SELECT 
					user_reference_id,
					user_id,
					person_name,
					contact_no,
					company_name,
					isActive
				FROM
					rs_tbl_user_reference
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_reference_id", "V"))
			$Sql .= " AND user_reference_id=" . $this->getProperty("user_reference_id");
		
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
	* This function is user for User Skills Detail
	* @author Numan Tahir
	*/
	public function lstUserSkills(){
		$Sql = "SELECT 
					user_skills_id,
					user_id,
					skills
				FROM
					rs_tbl_user_skills
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_skills_id", "V"))
			$Sql .= " AND user_skills_id=" . $this->getProperty("user_skills_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for User Shift Detail
	* @author Numan Tahir
	*/

	public function lstUserShifts(){
		$Sql = "SELECT 
					user_shift_id,
					user_id,
					shift_id,
					day_id,
					day_status,
					isActive
				FROM
					rs_tbl_user_shifts
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_shift_id", "V"))
			$Sql .= " AND user_shift_id=" . $this->getProperty("user_shift_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("shift_id", "V"))
			$Sql .= " AND shift_id=" . $this->getProperty("shift_id");
		
		if($this->isPropertySet("day_id", "V"))
			$Sql .= " AND day_id=" . $this->getProperty("day_id");
		
		if($this->isPropertySet("day_status", "V"))
			$Sql .= " AND day_status=" . $this->getProperty("day_status");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for User Education Detail
	* @author Numan Tahir
	*/
	public function lstUserEducationDetail(){
		$Sql = "SELECT 
					user_education_id,
					user_id,
					institute_name,
					major,
					start_date,
					end_date,
					document_file_name,
					document_file,
					other_note,
					isAcitve
				FROM
					rs_tbl_user_education
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_education_id", "V"))
			$Sql .= " AND user_education_id=" . $this->getProperty("user_education_id");
		
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
	* This function is user for Leads List
	* @author Numan Tahir
	*/
	public function lstLeads(){
		$Sql = "SELECT 
					leads_id,
					dmm_user_id,
					client_name,
					client_phone_number,
					client_email,
					client_message,
					lead_date,
					lead_from_id,
					entery_datetime,
					rm_user_id,
					rm_lead_status,
					rm_lead_view_datetime,
					rm_action_datetime,
					rm_lead_fwd_status,
					rm_lead_fwd_datetime,
					assign_location_id,
					assign_team_lead_id,
					assign_teamlead_datetime,
					assign_agent_status,
					assign_datetime,
					isActive,
					lead_status
				FROM
					rs_tbl_leads
				WHERE 
					1=1";
		
		if($this->isPropertySet("leads_id", "V"))
			$Sql .= " AND leads_id=" . $this->getProperty("leads_id");
		
		if($this->isPropertySet("dmm_user_id", "V"))
			$Sql .= " AND dmm_user_id=" . $this->getProperty("dmm_user_id");
		
		if($this->isPropertySet("lead_from_id", "V"))
			$Sql .= " AND lead_from_id=" . $this->getProperty("lead_from_id");
		
		if($this->isPropertySet("rm_user_id", "V"))
			$Sql .= " AND rm_user_id=" . $this->getProperty("rm_user_id");
		
		if($this->isPropertySet("rm_lead_status", "V"))
			$Sql .= " AND rm_lead_status=" . $this->getProperty("rm_lead_status");
		
		if($this->isPropertySet("rm_lead_status_not", "V"))
			$Sql .= " AND rm_lead_status!=" . $this->getProperty("rm_lead_status_not");
			
		if($this->isPropertySet("rm_lead_fwd_status", "V"))
			$Sql .= " AND rm_lead_fwd_status=" . $this->getProperty("rm_lead_fwd_status");
		
		if($this->isPropertySet("assign_location_id", "V"))
			$Sql .= " AND assign_location_id=" . $this->getProperty("assign_location_id");
		
		if($this->isPropertySet("assign_team_lead_id", "V"))
			$Sql .= " AND assign_team_lead_id=" . $this->getProperty("assign_team_lead_id");
			
		if($this->isPropertySet("assign_agent_status", "V"))
			$Sql .= " AND assign_agent_status=" . $this->getProperty("assign_agent_status");
							
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("lead_status", "V"))
			$Sql .= " AND lead_status=" . $this->getProperty("lead_status");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Leads Assign
	* @author Numan Tahir
	*/
	public function lstCountAssigndLeads(){
		$Sql = "SELECT
					rs_tbl_leads.assign_location_id
					, rs_tbl_leads_assign.assign_action_status
					, rs_tbl_leads.isActive
				FROM
					rs_tbl_leads
					INNER JOIN rs_tbl_leads_assign 
						ON (rs_tbl_leads.leads_id = rs_tbl_leads_assign.lead_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("assign_location_id", "V"))
			$Sql .= " AND rs_tbl_leads.assign_location_id=" . $this->getProperty("assign_location_id");
		
		if($this->isPropertySet("assign_action_status", "V"))
			$Sql .= " AND rs_tbl_leads_assign.assign_action_status=" . $this->getProperty("assign_action_status");
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Leads Assign
	* @author Numan Tahir
	*/
	public function lstLeadsAssign(){
		$Sql = "SELECT
					las.assign_lead_id,
					las.lead_id,
					las.assign_user_id,
					las.assign_from_user_id,
					las.assign_by,
					las.assign_date,
					las.assign_time,
					las.assign_lead_status,
					las.entery_date,
					las.isActive,
					las.assign_action_status,
					las.action_date,
					las.action_time,
					la.assign_location_id
				FROM
					rs_tbl_leads_assign as las
					INNER JOIN rs_tbl_leads la
						ON (las.lead_id = la.leads_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("assign_lead_id", "V"))
			$Sql .= " AND las.assign_lead_id=" . $this->getProperty("assign_lead_id");
		
		if($this->isPropertySet("lead_id", "V"))
			$Sql .= " AND las.lead_id=" . $this->getProperty("lead_id");
		
		if($this->isPropertySet("assign_user_id", "V"))
			$Sql .= " AND las.assign_user_id=" . $this->getProperty("assign_user_id");
		
		if($this->isPropertySet("assign_lead_status", "V"))
			$Sql .= " AND las.assign_lead_status=" . $this->getProperty("assign_lead_status");
		
		if($this->isPropertySet("assign_lead_status_not", "V"))
			$Sql .= " AND las.assign_lead_status!=" . $this->getProperty("assign_lead_status_not");
		
		if($this->isPropertySet("assign_from_user_id", "V"))
			$Sql .= " AND las.assign_from_user_id=" . $this->getProperty("assign_from_user_id");
		
		if($this->isPropertySet("assign_by", "V"))
			$Sql .= " AND las.assign_by=" . $this->getProperty("assign_by");
		
		if($this->isPropertySet("assign_date", "V"))
			$Sql .= " AND las.assign_date='" . $this->getProperty("assign_date") . "'";
		
		if($this->isPropertySet("assign_time", "V"))
			$Sql .= " AND las.assign_time='" . $this->getProperty("assign_time") . "'";
							
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND las.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("assign_action_status", "V"))
			$Sql .= " AND las.assign_action_status=" . $this->getProperty("assign_action_status");
		
		if($this->isPropertySet("assign_location_id", "V"))
			$Sql .= " AND la.assign_location_id=" . $this->getProperty("assign_location_id");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Leads Assign
	* @author Numan Tahir
	*/
	public function lstLeadComments(){
		$Sql = "SELECT 
					lead_comment_id,
					leads_id,
					assign_lead_id,
					user_id,
					lead_comment,
					entery_date,
					assign_lead_status,
					isActive
				FROM
					rs_tbl_lead_comments
				WHERE 
					1=1";
		
		if($this->isPropertySet("lead_comment_id", "V"))
			$Sql .= " AND lead_comment_id=" . $this->getProperty("lead_comment_id");
		
		if($this->isPropertySet("leads_id", "V"))
			$Sql .= " AND leads_id=" . $this->getProperty("leads_id");
		
		if($this->isPropertySet("assign_lead_id", "V"))
			$Sql .= " AND assign_lead_id=" . $this->getProperty("assign_lead_id");
		
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
	* This function is user for Agent Assign Leads
	* @author Numan Tahir
	*/
	public function lstAgentAssignLeads(){
		$Sql = "SELECT
					la.assign_lead_id,
					la.lead_id,
					la.assign_user_id,
					la.assign_from_user_id,
					la.assign_by,
					la.assign_date,
					la.assign_time,
					la.assign_lead_status,
					la.entery_date,
					la.isActive,
					la.assign_action_status,
					la.action_date,
					la.action_time,
					l.dmm_user_id,
					l.client_name,
					l.client_phone_number,
					l.client_email,
					l.client_message,
					l.lead_from_id,
					l.rm_user_id,
					l.rm_lead_status,
					l.rm_lead_view_datetime,
					l.rm_action_datetime,
					l.rm_lead_fwd_status,
					l.rm_lead_fwd_datetime,
					l.assign_location_id,
					l.assign_team_lead_id,
					l.assign_agent_status,
					l.assign_datetime,
					l.lead_status
				FROM
					rs_tbl_leads_assign as la
					INNER JOIN rs_tbl_leads l
						ON (la.lead_id = l.leads_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("assign_lead_id", "V"))
			$Sql .= " AND la.assign_lead_id=" . $this->getProperty("assign_lead_id");
		
		if($this->isPropertySet("lead_id", "V"))
			$Sql .= " AND la.lead_id=" . $this->getProperty("lead_id");
		
		if($this->isPropertySet("assign_user_id", "V"))
			$Sql .= " AND la.assign_user_id=" . $this->getProperty("assign_user_id");
		
		if($this->isPropertySet("assign_lead_status", "V"))
			$Sql .= " AND la.assign_lead_status=" . $this->getProperty("assign_lead_status");
		
		if($this->isPropertySet("assign_lead_status_not", "V"))
			$Sql .= " AND la.assign_lead_status!=" . $this->getProperty("assign_lead_status_not");
		
		if($this->isPropertySet("assign_from_user_id", "V"))
			$Sql .= " AND la.assign_from_user_id=" . $this->getProperty("assign_from_user_id");
		
		if($this->isPropertySet("assign_by", "V"))
			$Sql .= " AND la.assign_by=" . $this->getProperty("assign_by");
		
		if($this->isPropertySet("assign_date", "V"))
			$Sql .= " AND la.assign_date='" . $this->getProperty("assign_date") . "'";
		
		if($this->isPropertySet("assign_time", "V"))
			$Sql .= " AND la.assign_time='" . $this->getProperty("assign_time") . "'";
							
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND la.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("assign_lead_status", "V"))
			$Sql .= " AND la.assign_lead_status=" . $this->getProperty("assign_lead_status");
		
		if($this->isPropertySet("assign_action_status", "V"))
			$Sql .= " AND la.assign_action_status=" . $this->getProperty("assign_action_status");
			
		if($this->isPropertySet("dmm_user_id", "V"))
			$Sql .= " AND l.dmm_user_id=" . $this->getProperty("dmm_user_id");
			
		if($this->isPropertySet("lead_from_id", "V"))
			$Sql .= " AND l.lead_from_id=" . $this->getProperty("lead_from_id");
			
		if($this->isPropertySet("rm_user_id", "V"))
			$Sql .= " AND l.rm_user_id=" . $this->getProperty("rm_user_id");
			
		if($this->isPropertySet("rm_lead_status", "V"))
			$Sql .= " AND l.rm_lead_status=" . $this->getProperty("rm_lead_status");
			

		if($this->isPropertySet("rm_lead_fwd_status", "V"))
			$Sql .= " AND l.rm_lead_fwd_status=" . $this->getProperty("rm_lead_fwd_status");
			
		if($this->isPropertySet("assign_location_id", "V"))
			$Sql .= " AND l.assign_location_id=" . $this->getProperty("assign_location_id");
		
		if($this->isPropertySet("assign_team_lead_id", "V"))
			$Sql .= " AND l.assign_team_lead_id=" . $this->getProperty("assign_team_lead_id");
				
		if($this->isPropertySet("assign_agent_status", "V"))
			$Sql .= " AND l.assign_agent_status=" . $this->getProperty("assign_agent_status");
			
		if($this->isPropertySet("lead_status", "V"))
			$Sql .= " AND l.lead_status=" . $this->getProperty("lead_status");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Leads Assign
	* @author Numan Tahir
	*/
	public function lstLeadAssignedCom(){
		$Sql = "SELECT
					ld.rm_lead_status,
					ldas.assign_user_id,
					ldas.assign_lead_id,
					ld.client_name,
					ld.client_phone_number,
					ld.client_email,
					ld.leads_id,
					ld.lead_from_id,
					ld.client_message,
					ldas.assign_date,
					ldas.assign_time,
					ld.assign_datetime,
					ldas.assign_lead_status,
					ldas.assign_action_status
				FROM
					rs_tbl_leads as ld
					INNER JOIN rs_tbl_leads_assign as ldas
						ON (ld.leads_id = ldas.lead_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("rm_lead_status", "V"))
			$Sql .= " AND ld.rm_lead_status=" . $this->getProperty("rm_lead_status");
		
		if($this->isPropertySet("lead_from_id", "V"))
			$Sql .= " AND ld.lead_from_id=" . $this->getProperty("lead_from_id");
			
		if($this->isPropertySet("assign_user_id", "V"))
			$Sql .= " AND ldas.assign_user_id=" . $this->getProperty("assign_user_id");
		
		if($this->isPropertySet("assign_lead_status", "V"))
			$Sql .= " AND ldas.assign_lead_status=" . $this->getProperty("assign_lead_status");
		
		if($this->isPropertySet("assign_action_status", "V"))
			$Sql .= " AND ldas.assign_action_status=" . $this->getProperty("assign_action_status");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Basic Salary Detail
	* @author Numan Tahir
	*/
	public function lstSalary(){
		$Sql = "SELECT 
					user_salary_id,
					user_id,
					salary_amount,
					salary_type,
					salary_mode,
					apply_from,
					cutting_mode,
					entery_date,
					isActive
				FROM
					rs_tbl_user_salary
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_salary_id", "V"))
			$Sql .= " AND user_salary_id=" . $this->getProperty("user_salary_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("salary_amount", "V"))
			$Sql .= " AND salary_amount='" . $this->getProperty("salary_amount") . "'";
		
		if($this->isPropertySet("cutting_mode", "V"))
			$Sql .= " AND cutting_mode='" . $this->getProperty("cutting_mode") . "'";
			
		if($this->isPropertySet("salary_type", "V"))
			$Sql .= " AND salary_type=" . $this->getProperty("salary_type");
		
		if($this->isPropertySet("salary_mode", "V"))
			$Sql .= " AND salary_mode=" . $this->getProperty("salary_mode");
			
		if($this->isPropertySet("apply_from", "V"))
			$Sql .= " AND apply_from='" . $this->getProperty("apply_from") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Salary Bonus Detail
	* @author Numan Tahir
	*/
	public function lstBonus(){
		$Sql = "SELECT 
					user_bonus_id,
					user_id,
					bonus_amount,
					bonus_status,
					entery_date,
					isActive
				FROM
					rs_tbl_user_salary_bonus
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_bonus_id", "V"))
			$Sql .= " AND user_bonus_id=" . $this->getProperty("user_bonus_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("bonus_amount", "V"))
			$Sql .= " AND bonus_amount='" . $this->getProperty("bonus_amount") . "'";
		
		if($this->isPropertySet("bonus_status", "V"))
			$Sql .= " AND bonus_status=" . $this->getProperty("bonus_status");
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for VW User Detail
	* @author Numan Tahir
	*/
	public function VwUserDetail(){
		$Sql = "SELECT 
					u.user_id,
					u.enter_user_id,
					u.device_uid,
					u.user_email,
					u.user_mobile,
					u.user_pass,
					u.user_fname,
					u.user_lname,
					CONCAT(u.user_fname,' ',u.user_lname) AS fullname,
					u.user_address,
					u.user_phone,
					u.user_cnic,
					u.user_type_id,
					u.user_designation,
					u.user_signature,
					u.user_profile_img,
					u.sms_verification,
					u.short_code,
					u.location_id,
					u.login_required,
					u.isActive,
					u.user_code,
					u.user_gender,
					u.user_dob,
					u.user_marital_status,
					u.blood_group,
					u.cnic_front_side,
					u.cnic_back_side,
					u.user_cv,
					u.teamlead_status,
					u.teamlead_date,
					u.user_security_code,
					ujd.job_title_id,
					ujd.job_description,
					ujd.department_id,
					ujd.joined_date,
					ujd.service_end_date,
					ujd.job_type,
					ujd.probation_period_end_date,
					ujd.probation_period_status,
					l.location_name,
					l.location_address,
					d.department_name,
					c.company_id,
					c.company_name,
					jt.job_title
				FROM
					rs_tbl_users as u
						LEFT JOIN rs_tbl_user_job_detail as ujd
							ON (u.user_id = ujd.user_id)
						LEFT JOIN rs_tbl_location as l
							ON (u.location_id = l.location_id)
						LEFT JOIN rs_tbl_department as d
							ON (ujd.department_id = d.department_id)
						LEFT JOIN rs_tbl_job_title as jt
							ON (ujd.job_title_id = jt.job_title_id)
						LEFT JOIN rs_tbl_companies as c
							ON (d.company_id = c.company_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND u.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("device_uid", "V"))
			$Sql .= " AND u.device_uid=" . $this->getProperty("device_uid");
		
		if($this->isPropertySet("company_id", "V"))
			$Sql .= " AND c.company_id=" . $this->getProperty("company_id");
		
		if($this->isPropertySet("department_id", "V"))
			$Sql .= " AND ujd.department_id=" . $this->getProperty("department_id");
		
		if($this->isPropertySet("teamlead_status", "V"))
			$Sql .= " AND u.teamlead_status=" . $this->getProperty("teamlead_status");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND u.isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Prospect Details
	* @author Numan Tahir
	*/
	public function lstProspectDetail(){
		$Sql = "SELECT 
					prospect_id,
					prospect_name,
					prospect_email,
					prospect_phone,
					prospect_msg,
					prospect_formid,
					entery_date,
					isActive
				FROM
					rs_tbl_prospect_details
				WHERE 
					1=1";
		
		if($this->isPropertySet("prospect_id", "V"))
			$Sql .= " AND prospect_id=" . $this->getProperty("prospect_id");
		
		if($this->isPropertySet("prospect_formid", "V"))
			$Sql .= " AND prospect_formid=" . $this->getProperty("prospect_formid");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Advance Salary
	* @author Numan Tahir
	*/
	public function lstUserAdvanceSalary(){
		$Sql = "SELECT 
					advance_salary_id,
					user_id,
					salary_amount,
					paying_date,
					advance_month,
					advance_reason,
					payback_option,
					payback_in_months,
					payback_amount,
					advance_salary_status,
					entery_date,
					isActive
				FROM
					rs_tbl_user_advance_salary
				WHERE 
					1=1";
		
		if($this->isPropertySet("advance_salary_id", "V"))
			$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("paying_date", "V"))
			$Sql .= " AND paying_date='" . $this->getProperty("paying_date") . "'";
		
		if($this->isPropertySet("payback_option", "V"))
			$Sql .= " AND payback_option='" . $this->getProperty("payback_option") . "'";
		
		if($this->isPropertySet("payback_in_months", "V"))
			$Sql .= " AND payback_in_months='" . $this->getProperty("payback_in_months") . "'";
					
		if($this->isPropertySet("advance_month", "V"))
			$Sql .= " AND advance_month=" . $this->getProperty("advance_month");
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND paying_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
			
		if($this->isPropertySet("advance_salary_status", "V"))
			$Sql .= " AND advance_salary_status=" . $this->getProperty("advance_salary_status");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isActive_not", "V"))
			$Sql .= " AND isActive!='" . $this->getProperty("isActive_not") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is user for Advance Salary PayBack Option
	* @author Numan Tahir
	*/
	public function lstUserAdvanceSalaryPayBack(){
		$Sql = "SELECT 
					payback_monthly_id,
					user_id,
					advance_salary_id,
					monthly_amount,
					payback_status,
					payback_date,
					isActive,
					entery_date
				FROM
					rs_tbl_payment_requests_advance_salary_payback
				WHERE 
					1=1";
		
		if($this->isPropertySet("advance_salary_id", "V"))
			$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("payback_date", "V"))
			$Sql .= " AND payback_date='" . $this->getProperty("payback_date") . "'";
		
		if($this->isPropertySet("payback_status", "V"))
			$Sql .= " AND payback_status='" . $this->getProperty("payback_status") . "'";
				
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND payback_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isActive_not", "V"))
			$Sql .= " AND isActive!='" . $this->getProperty("isActive_not") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Agent Leads Overview
	* @author Numan Tahir
	*/
	public function lstAgentLeadsOverView(){
		$Sql = "SELECT 
						user_id,
						user_type_id,
						location_id,
						user_fname,
						user_lname,
						CONCAT(user_fname,' ',user_lname) AS fullname,
						assign_action_status,
						assign_lead_id,
						lead_id,
						pending_leads,
						follow_up_leads,
						not_responding_leads,
						interested_leads,
						not_interested_leads,
						converted_leads,
						SUM(pending_leads) as pending_leads_sum,
						SUM(follow_up_leads) as follow_up_leads_sum,
						SUM(not_responding_leads) as not_responding_leads_sum,
						SUM(interested_leads) as interested_leads_sum,
						SUM(not_interested_leads) as not_interested_leads_sum,
						SUM(converted_leads) as converted_leads_sum
					FROM
						vw_agent_leads_overview
					WHERE 
						1=1";
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("user_type_id", "V"))
			$Sql .= " AND user_type_id=" . $this->getProperty("user_type_id");
		
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->isPropertySet("assign_lead_id", "V"))
			$Sql .= " AND assign_lead_id=" . $this->getProperty("assign_lead_id");
		
		if($this->isPropertySet("assign_action_status", "V"))
			$Sql .= " AND assign_action_status='" . $this->getProperty("assign_action_status") . "'";
		
		if($this->isPropertySet("lead_id", "V"))
			$Sql .= " AND lead_id='" . $this->getProperty("lead_id") . "'";
		
		if($this->isPropertySet("user_id_not", "V"))
			$Sql .= " AND user_id!=" . $this->getProperty("user_id_not");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Employee Overtime Detail
	* @author Numan Tahir
	*/
	public function lstUserOverTimeDetail(){
		$Sql = "SELECT 
						emp_overtime_id,
						user_id,
						att_id,
						att_date,
						no_of_hrs,
						rate_per_hr,
						per_day_salary,
						entery_date,
						isActive
					FROM
						rs_tbl_user_overtime_detail
					WHERE 
						1=1";
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("att_id", "V"))
			$Sql .= " AND att_id=" . $this->getProperty("att_id");
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND att_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Request flow Structure
	* @author Numan Tahir
	*/
	public function lstUserRequestFlow(){
		$Sql = "SELECT 
						request_flow_id,
						user_id,
						company_id,
						department_id,
						request_flow_type,
						employee_id,
						leave_request_to,
						overtime_request_to,
						isActive,
						entery_date
					FROM
						rs_tbl_user_request_flow
					WHERE 
						1=1";
		
		if($this->isPropertySet("request_flow_id", "V"))
			$Sql .= " AND request_flow_id=" . $this->getProperty("request_flow_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("company_id", "V"))
			$Sql .= " AND company_id='" . $this->getProperty("company_id") . "'";
		
		if($this->isPropertySet("department_id", "V"))
			$Sql .= " AND department_id='" . $this->getProperty("department_id") . "'";
		
		if($this->isPropertySet("request_flow_type", "V"))
			$Sql .= " AND request_flow_type='" . $this->getProperty("request_flow_type") . "'";
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id='" . $this->getProperty("employee_id") . "'";
		
		if($this->isPropertySet("leave_request_to", "V"))
			$Sql .= " AND leave_request_to='" . $this->getProperty("leave_request_to") . "'";
		
		if($this->isPropertySet("overtime_request_to", "V"))
			$Sql .= " AND overtime_request_to='" . $this->getProperty("overtime_request_to") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Request flow Structure Log
	* @author Numan Tahir
	*/
	public function lstUserRequestFlowLog(){
		$Sql = "SELECT 
						request_flow_log_id,
						user_id,
						request_flow_id,
						activity_detail,
						isActive,
						entery_date
					FROM
						rs_tbl_user_request_flow_log
					WHERE 
						1=1";
		
		if($this->isPropertySet("request_flow_log_id", "V"))
			$Sql .= " AND request_flow_log_id=" . $this->getProperty("request_flow_log_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("request_flow_id", "V"))
			$Sql .= " AND request_flow_id='" . $this->getProperty("request_flow_id") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Bank Account Detail
	* @author Numan Tahir
	*/
	public function lstUserBankAccountDetail(){
		$Sql = "SELECT 
						employee_bank_id,
						user_id,
						bank_id,
						account_no,
						account_title,
						entery_date,
						isActive
					FROM
						rs_tbl_user_bank_account_detail
					WHERE 
						1=1";
		
		if($this->isPropertySet("employee_bank_id", "V"))
			$Sql .= " AND employee_bank_id=" . $this->getProperty("employee_bank_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("bank_id", "V"))
			$Sql .= " AND bank_id='" . $this->getProperty("bank_id") . "'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Employee Salary Detail
	* @author Numan Tahir
	*/
	public function lstEmployeeSalaryDetail(){
		$Sql = "SELECT
						us.user_fname,
						us.user_lname,
						CONCAT(user_fname, ' ', user_lname) as fullname,
						us.user_id,
						uss.salary_amount,
						us.location_id,
						us.device_uid,
						us.user_type_id,
						uss.cutting_mode,
						ubad.bank_id,
						ubad.account_no,
						ubad.account_title,
						ujd.company_id,
						ujd.department_id
					FROM
						rs_tbl_users as us
						INNER JOIN rs_tbl_user_salary as uss
							ON (us.user_id = uss.user_id)
						LEFT JOIN rs_tbl_user_bank_account_detail as ubad
							ON (us.user_id = ubad.user_id)
						LEFT JOIN rs_tbl_user_job_detail as ujd
							ON (us.user_id = ujd.user_id)
					WHERE 
						1=1";
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND us.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("company_id", "V"))
			$Sql .= " AND ujd.company_id=" . $this->getProperty("company_id");
		
		if($this->isPropertySet("department_id", "V"))
			$Sql .= " AND ujd.department_id=" . $this->getProperty("department_id");
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND us.isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Monthly Paid Salary
	* @author Numan Tahir
	*/
	public function lstUserMonthlyPaidSalary(){
		$Sql = "SELECT 
						monthly_salary_id,
						entery_user_id,
						flt_start_date,
						flt_end_date,
						entery_date,
						isActive
					FROM
						rs_tbl_user_monthly_paid_salary
					WHERE 
						1=1";
		
		if($this->isPropertySet("monthly_salary_id", "V"))
			$Sql .= " AND monthly_salary_id=" . $this->getProperty("monthly_salary_id");
		
		if($this->isPropertySet("entery_user_id", "V"))
			$Sql .= " AND entery_user_id=" . $this->getProperty("entery_user_id");
		
		if($this->isPropertySet("flt_start_date", "V"))
			$Sql .= " AND flt_start_date='" . $this->getProperty("flt_start_date") . "'";
		
		if($this->isPropertySet("flt_end_date", "V"))
			$Sql .= " AND flt_end_date='" . $this->getProperty("flt_end_date") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Monthly Paid Salary Detail
	* @author Numan Tahir
	*/
	public function lstUserMonthlyPaidSalaryDetail(){
		$Sql = "SELECT 
						paid_salary_detail_id,
						monthly_salary_id,
						user_id,
						emp_lieo,
						emp_absent,
						emp_aprv_leaves,
						emp_adv_amount,
						emp_adv_payback_id,
						emp_deduction,
						emp_cutting_mode,
						emp_monthly_salary,
						emp_bonus_id,
						emp_bonus,
						emp_overtime,
						emp_incometax,
						pay_mode,
						transaction_status,
						transaction_number,
						entery_date,
						isActive
					FROM
						rs_tbl_user_monthly_paid_salary_detail
					WHERE 
						1=1";
		
		if($this->isPropertySet("paid_salary_detail_id", "V"))
			$Sql .= " AND paid_salary_detail_id=" . $this->getProperty("paid_salary_detail_id");
		
		if($this->isPropertySet("monthly_salary_id", "V"))
			$Sql .= " AND monthly_salary_id=" . $this->getProperty("monthly_salary_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id='" . $this->getProperty("user_id") . "'";
		
		if($this->isPropertySet("pay_mode", "V"))
			$Sql .= " AND pay_mode='" . $this->getProperty("pay_mode") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("transaction_status", "V"))
			$Sql .= " AND transaction_status='" . $this->getProperty("transaction_status") . "'";
		
		if($this->isPropertySet("transaction_number", "V"))
			$Sql .= " AND transaction_number='" . $this->getProperty("transaction_number") . "'";
					
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Payment Request List
	* @author Numan Tahir
	*/
	public function lstPaymentRequestsList(){
		$Sql = "SELECT 
						payment_request_id,
						user_id,
						requested_amount,
						apply_type_id,
						apply_date,
						request_status,
						request_stage,
						request_stage_status,
						request_fwd_dep_to,
						request_fwd_dep_status,
						request_fwd_finance_to,
						request_fwd_finance_status,
						request_fwd_ceo_to,
						request_fwd_ceo_status,
						entery_date,
						isActive
					FROM
						rs_tbl_payment_requests
					WHERE 
						1=1";
		
		if($this->isPropertySet("payment_request_id", "V"))
			$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("apply_type_id", "V"))
			$Sql .= " AND apply_type_id=" . $this->getProperty("apply_type_id");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("request_status", "V"))
			$Sql .= " AND request_status='" . $this->getProperty("request_status") . "'";
		
		if($this->isPropertySet("request_stage", "V"))
			$Sql .= " AND request_stage=" . $this->getProperty("request_stage");
		
		if($this->isPropertySet("request_stage_status", "V"))
			$Sql .= " AND request_stage_status=" . $this->getProperty("request_stage_status");
		
		if($this->isPropertySet("request_fwd_dep_to", "V"))
			$Sql .= " AND request_fwd_dep_to='" . $this->getProperty("request_fwd_dep_to") . "'";
		
		if($this->isPropertySet("request_fwd_dep_status", "V"))
			$Sql .= " AND request_fwd_dep_status='" . $this->getProperty("request_fwd_dep_status") . "'";
		
		if($this->isPropertySet("request_fwd_dep_status_array", "V"))
			$Sql .= " AND request_fwd_dep_status IN (".$this->getProperty("request_fwd_dep_status_array"). ")";
		
		if($this->isPropertySet("request_fwd_finance_status_array", "V"))
			$Sql .= " AND request_fwd_finance_status IN (".$this->getProperty("request_fwd_finance_status_array"). ")";
					
		if($this->isPropertySet("request_fwd_finance_to", "V"))
			$Sql .= " AND request_fwd_finance_to='" . $this->getProperty("request_fwd_finance_to") . "'";
			
		if($this->isPropertySet("request_fwd_finance_status", "V"))
			$Sql .= " AND request_fwd_finance_status='" . $this->getProperty("request_fwd_finance_status") . "'";
			
		if($this->isPropertySet("request_fwd_ceo_to", "V"))
			$Sql .= " AND request_fwd_ceo_to='" . $this->getProperty("request_fwd_ceo_to") . "'";
			
		if($this->isPropertySet("request_fwd_ceo_status", "V"))
			$Sql .= " AND request_fwd_ceo_status='" . $this->getProperty("request_fwd_ceo_status") . "'";
		
		if($this->isPropertySet("isActive_not", "V"))
			$Sql .= " AND isActive!='" . $this->getProperty("isActive_not") . "'";
		
		if($this->isPropertySet("payment_request_id_not", "V"))
			$Sql .= " AND payment_request_id!='" . $this->getProperty("payment_request_id_not") . "'";

				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Payment Request Advance Salary
	* @author Numan Tahir
	*/
	public function lstPaymentRequestsAdvanceSalary(){
		$Sql = "SELECT 
						advance_salary_id,
						user_id,
						payment_request_id,
						salary_amount,
						paying_date,
						advance_month,
						advance_reason,
						payback_option,
						payback_in_months,
						payback_amount,
						advance_salary_status,
						advance_type,
						entery_date,
						isActive
					FROM
						rs_tbl_payment_requests_advance_salary
					WHERE 
						1=1";
		
		if($this->isPropertySet("advance_salary_id", "V"))
			$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("payment_request_id", "V"))
			$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
		
		if($this->isPropertySet("advance_month", "V"))
			$Sql .= " AND advance_month=" . $this->getProperty("advance_month");
		
		if($this->isPropertySet("payback_option", "V"))
			$Sql .= " AND payback_option=" . $this->getProperty("payback_option");
			
		if($this->isPropertySet("payback_in_months", "V"))
			$Sql .= " AND payback_in_months=" . $this->getProperty("payback_in_months");
			
		if($this->isPropertySet("advance_salary_status", "V"))
			$Sql .= " AND advance_salary_status=" . $this->getProperty("advance_salary_status");
		
		if($this->isPropertySet("advance_type", "V"))
			$Sql .= " AND advance_type='" . $this->getProperty("advance_type") . "'";
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isActive_not", "V"))
			$Sql .= " AND isActive!='" . $this->getProperty("isActive_not") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Payment Request Advance Salary PayBack
	* @author Numan Tahir
	*/
	public function lstPaymentRequestsAdvanceSalaryPayBack(){
		$Sql = "SELECT 
						payback_monthly_id,
						user_id,
						advance_salary_id,
						payment_request_id,
						monthly_amount,
						payback_status,
						payback_date,
						isActive,
						entery_date
					FROM
						rs_tbl_payment_requests_advance_salary_payback
					WHERE 
						1=1";
		
		if($this->isPropertySet("payback_monthly_id", "V"))
			$Sql .= " AND payback_monthly_id=" . $this->getProperty("payback_monthly_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("advance_salary_id", "V"))
			$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
		
		if($this->isPropertySet("payment_request_id", "V"))
			$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
		
		if($this->isPropertySet("payback_date", "V"))
			$Sql .= " AND payback_date='" . $this->getProperty("payback_date") . "'";
		
		if($this->isPropertySet("payback_status", "V"))
			$Sql .= " AND payback_status='" . $this->getProperty("payback_status") . "'";
				
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND payback_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isActive_not", "V"))
			$Sql .= " AND isActive!='" . $this->getProperty("isActive_not") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Payment Request Items List
	* @author Numan Tahir
	*/
	public function lstPaymentRequestsItemsList(){
		$Sql = "SELECT 
						misc_item_req_id,
						payment_request_id,
						user_id,
						item_id,
						item_qty,
						required_amount,
						reason_note,
						item_req_status,
						entery_date,
						isActive
					FROM
						rs_tbl_payment_requests_items
					WHERE 
						1=1";
		
		if($this->isPropertySet("misc_item_req_id", "V"))
			$Sql .= " AND misc_item_req_id=" . $this->getProperty("misc_item_req_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("payment_request_id", "V"))
			$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
		
		if($this->isPropertySet("item_id", "V"))
			$Sql .= " AND item_id=" . $this->getProperty("item_id");
		
		if($this->isPropertySet("item_req_status", "V"))
			$Sql .= " AND item_req_status=" . $this->getProperty("item_req_status");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isActive_not", "V"))
			$Sql .= " AND isActive!='" . $this->getProperty("isActive_not") . "'";
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));

		return $this->dbQuery($Sql);
	}
	
	
	
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*******************************************************************************************************/
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*******************************************************************************************************/
	/////////////////////////////////////////////////////////////////////////////////////////////////////////


	/**
	* This function is User to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUser($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_users(
						user_id,
						enter_user_id,
						device_uid,
						user_email,
						user_mobile,
						user_pass,
						user_fname,
						user_lname,
						user_address,
						user_phone,
						user_cnic,
						user_type_id,
						user_designation,
						user_signature,
						user_profile_img,
						sms_verification,
						short_code,
						location_id,
						login_required,
						isActive,
						reg_date,
						user_code,
						user_gender,
						user_dob,
						user_marital_status,
						blood_group,
						cnic_front_side,
						cnic_back_side,
						user_cv,
						teamlead_status,
						vehicle_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("enter_user_id", "V") ? $this->getProperty("enter_user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_uid", "V") ? $this->getProperty("device_uid") : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_email", "V") ? "'" . $this->getProperty("user_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_mobile", "V") ? "'" . $this->getProperty("user_mobile") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_pass", "V") ? "'" . $this->getProperty("user_pass") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_fname", "V") ? "'" . $this->getProperty("user_fname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_lname", "V") ? "'" . $this->getProperty("user_lname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_address", "V") ? "'" . $this->getProperty("user_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_phone", "V") ? "'" . $this->getProperty("user_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_cnic", "V") ? "'" . $this->getProperty("user_cnic") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_type_id", "V") ? "'" . $this->getProperty("user_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_designation", "V") ? "'" . $this->getProperty("user_designation") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_signature", "V") ? "'" . $this->getProperty("user_signature") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_profile_img", "V") ? "'" . $this->getProperty("user_profile_img") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_verification", "V") ? "'" . $this->getProperty("sms_verification") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("short_code", "V") ? "'" . $this->getProperty("short_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("login_required", "V") ? "'" . $this->getProperty("login_required") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("reg_date", "V") ? "'" . $this->getProperty("reg_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_code", "V") ? "'" . $this->getProperty("user_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_gender", "V") ? "'" . $this->getProperty("user_gender") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_dob", "V") ? "'" . $this->getProperty("user_dob") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_marital_status", "V") ? "'" . $this->getProperty("user_marital_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("blood_group", "V") ? "'" . $this->getProperty("blood_group") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cnic_front_side", "V") ? "'" . $this->getProperty("cnic_front_side") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cnic_back_side", "V") ? "'" . $this->getProperty("cnic_back_side") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_cv", "V") ? "'" . $this->getProperty("user_cv") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("teamlead_status", "V") ? "'" . $this->getProperty("teamlead_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_id", "V") ? "'" . $this->getProperty("vehicle_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_users SET ";
				if($this->isPropertySet("user_email", "K")){
					$Sql .= "$con user_email='" . $this->getProperty("user_email") . "'";
					$con = ",";
				}
				if($this->isPropertySet("device_uid", "K")){
					$Sql .= "$con device_uid='" . $this->getProperty("device_uid") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_pass", "K")){
					$Sql .= "$con user_pass='" . $this->getProperty("user_pass") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_fname", "K")){
					$Sql .= "$con user_fname='" . $this->getProperty("user_fname") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_lname", "K")){
					$Sql .= "$con user_lname='" . $this->getProperty("user_lname") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_address", "K")){
					$Sql .= "$con user_address='" . $this->getProperty("user_address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_phone", "K")){
					$Sql .= "$con user_phone='" . $this->getProperty("user_phone") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_cnic", "K")){
					$Sql .= "$con user_cnic='" . $this->getProperty("user_cnic") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_type_id", "K")){
					$Sql .= "$con user_type_id='" . $this->getProperty("user_type_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_designation", "K")){
					$Sql .= "$con user_designation='" . $this->getProperty("user_designation") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_signature", "K")){
					$Sql .= "$con user_signature='" . $this->getProperty("user_signature") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_profile_img", "K")){
					$Sql .= "$con user_profile_img='" . $this->getProperty("user_profile_img") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sms_verification", "K")){
					$Sql .= "$con sms_verification='" . $this->getProperty("sms_verification") . "'";
					$con = ",";
				}
				if($this->isPropertySet("short_code", "K")){
					$Sql .= "$con short_code='" . $this->getProperty("short_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_id", "K")){
					$Sql .= "$con location_id='" . $this->getProperty("location_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("login_required", "K")){
					$Sql .= "$con login_required='" . $this->getProperty("login_required") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				if($this->isPropertySet("user_code", "K")){
					$Sql .= "$con user_code='" . $this->getProperty("user_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_gender", "K")){
					$Sql .= "$con user_gender='" . $this->getProperty("user_gender") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_dob", "K")){
					$Sql .= "$con user_dob='" . $this->getProperty("user_dob") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_marital_status", "K")){
					$Sql .= "$con user_marital_status='" . $this->getProperty("user_marital_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("blood_group", "K")){
					$Sql .= "$con blood_group='" . $this->getProperty("blood_group") . "'";
					$con = ",";
				}
				if($this->isPropertySet("cnic_front_side", "K")){
					$Sql .= "$con cnic_front_side='" . $this->getProperty("cnic_front_side") . "'";
					$con = ",";
				}
				if($this->isPropertySet("cnic_back_side", "K")){
					$Sql .= "$con cnic_back_side='" . $this->getProperty("cnic_back_side") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_cv", "K")){
					$Sql .= "$con user_cv='" . $this->getProperty("user_cv") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_status", "K")){
					$Sql .= "$con teamlead_status='" . $this->getProperty("teamlead_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_date", "K")){
					$Sql .= "$con teamlead_date='" . $this->getProperty("teamlead_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_id", "K")){
					$Sql .= "$con teamlead_id='" . $this->getProperty("teamlead_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_id_zero", "K")){
					$Sql .= "$con teamlead_id='0'";
					$con = ",";
				}
				if($this->isPropertySet("user_security_code", "K")){
					$Sql .= "$con user_security_code='" . $this->getProperty("user_security_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("vehicle_id", "K")){
					$Sql .= "$con vehicle_id='" . $this->getProperty("vehicle_id") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_mobile", "V"))
					$Sql .= " AND user_mobile='" . $this->getProperty("user_mobile") . "'";
				else
					$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;

			/** ** ** Inactive User ** ** **/
			case "IAU":
				$Sql = "UPDATE rs_tbl_users SET 
							isActive=2
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			/** ** ** Active User ** ** **/
			case "AU":
				$Sql = "UPDATE rs_tbl_users SET 
							isActive=1
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			/** ** ** Delete User ** ** **/
			case "DEL":
				$Sql = "UPDATE rs_tbl_users SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User HR to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUser_HR($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_users(
						user_id,
						enter_user_id,
						device_uid,
						user_email,
						user_mobile,
						user_pass,
						user_fname,
						user_lname,
						user_address,
						user_phone,
						user_cnic,
						user_type_id,
						user_designation,
						user_signature,
						user_profile_img,
						sms_verification,
						short_code,
						location_id,
						login_required,
						isActive,
						reg_date,
						user_code,
						user_gender,
						user_dob,
						user_marital_status,
						blood_group,
						cnic_front_side,
						cnic_back_side,
						user_cv,
						teamlead_status,
						vehicle_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("enter_user_id", "V") ? $this->getProperty("enter_user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_uid", "V") ? $this->getProperty("device_uid") : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_email", "V") ? "'" . $this->getProperty("user_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_mobile", "V") ? "'" . $this->getProperty("user_mobile") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_pass", "V") ? "'" . $this->getProperty("user_pass") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_fname", "V") ? "'" . $this->getProperty("user_fname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_lname", "V") ? "'" . $this->getProperty("user_lname") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_address", "V") ? "'" . $this->getProperty("user_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_phone", "V") ? "'" . $this->getProperty("user_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_cnic", "V") ? "'" . $this->getProperty("user_cnic") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_type_id", "V") ? "'" . $this->getProperty("user_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_designation", "V") ? "'" . $this->getProperty("user_designation") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_signature", "V") ? "'" . $this->getProperty("user_signature") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_profile_img", "V") ? "'" . $this->getProperty("user_profile_img") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sms_verification", "V") ? "'" . $this->getProperty("sms_verification") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("short_code", "V") ? "'" . $this->getProperty("short_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? "'" . $this->getProperty("location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("login_required", "V") ? "'" . $this->getProperty("login_required") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("reg_date", "V") ? "'" . $this->getProperty("reg_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_code", "V") ? "'" . $this->getProperty("user_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_gender", "V") ? "'" . $this->getProperty("user_gender") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_dob", "V") ? "'" . $this->getProperty("user_dob") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_marital_status", "V") ? "'" . $this->getProperty("user_marital_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("blood_group", "V") ? "'" . $this->getProperty("blood_group") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cnic_front_side", "V") ? "'" . $this->getProperty("cnic_front_side") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cnic_back_side", "V") ? "'" . $this->getProperty("cnic_back_side") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_cv", "V") ? "'" . $this->getProperty("user_cv") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("teamlead_status", "V") ? "'" . $this->getProperty("teamlead_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_id", "V") ? "'" . $this->getProperty("vehicle_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_users SET ";
				if($this->isPropertySet("user_email", "K")){
					$Sql .= "$con user_email='" . $this->getProperty("user_email") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_mobile", "K")){
					$Sql .= "$con user_mobile='" . $this->getProperty("user_mobile") . "'";
					$con = ",";
				}
				if($this->isPropertySet("device_uid", "K")){
					$Sql .= "$con device_uid='" . $this->getProperty("device_uid") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_pass", "K")){
					$Sql .= "$con user_pass='" . $this->getProperty("user_pass") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_fname", "K")){
					$Sql .= "$con user_fname='" . $this->getProperty("user_fname") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_lname", "K")){
					$Sql .= "$con user_lname='" . $this->getProperty("user_lname") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_address", "K")){
					$Sql .= "$con user_address='" . $this->getProperty("user_address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_phone", "K")){
					$Sql .= "$con user_phone='" . $this->getProperty("user_phone") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_cnic", "K")){
					$Sql .= "$con user_cnic='" . $this->getProperty("user_cnic") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_type_id", "K")){
					$Sql .= "$con user_type_id='" . $this->getProperty("user_type_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_designation", "K")){
					$Sql .= "$con user_designation='" . $this->getProperty("user_designation") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_signature", "K")){
					$Sql .= "$con user_signature='" . $this->getProperty("user_signature") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_profile_img", "K")){
					$Sql .= "$con user_profile_img='" . $this->getProperty("user_profile_img") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sms_verification", "K")){
					$Sql .= "$con sms_verification='" . $this->getProperty("sms_verification") . "'";
					$con = ",";
				}
				if($this->isPropertySet("short_code", "K")){
					$Sql .= "$con short_code='" . $this->getProperty("short_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_id", "K")){
					$Sql .= "$con location_id='" . $this->getProperty("location_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("login_required", "K")){
					$Sql .= "$con login_required='" . $this->getProperty("login_required") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				if($this->isPropertySet("user_code", "K")){
					$Sql .= "$con user_code='" . $this->getProperty("user_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_gender", "K")){
					$Sql .= "$con user_gender='" . $this->getProperty("user_gender") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_dob", "K")){
					$Sql .= "$con user_dob='" . $this->getProperty("user_dob") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_marital_status", "K")){
					$Sql .= "$con user_marital_status='" . $this->getProperty("user_marital_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("blood_group", "K")){
					$Sql .= "$con blood_group='" . $this->getProperty("blood_group") . "'";
					$con = ",";
				}
				if($this->isPropertySet("cnic_front_side", "K")){
					$Sql .= "$con cnic_front_side='" . $this->getProperty("cnic_front_side") . "'";
					$con = ",";
				}
				if($this->isPropertySet("cnic_back_side", "K")){
					$Sql .= "$con cnic_back_side='" . $this->getProperty("cnic_back_side") . "'";
					$con = ",";
				}
				if($this->isPropertySet("user_cv", "K")){
					$Sql .= "$con user_cv='" . $this->getProperty("user_cv") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_status", "K")){
					$Sql .= "$con teamlead_status='" . $this->getProperty("teamlead_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_date", "K")){
					$Sql .= "$con teamlead_date='" . $this->getProperty("teamlead_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_id", "K")){
					$Sql .= "$con teamlead_id='" . $this->getProperty("teamlead_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("teamlead_id_zero", "K")){
					$Sql .= "$con teamlead_id='0'";
					$con = ",";
				}
				if($this->isPropertySet("vehicle_id", "K")){
					$Sql .= "$con vehicle_id='" . $this->getProperty("vehicle_id") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_id", "V"))
					$Sql .= " AND user_id='" . $this->getProperty("user_id") . "'";
				else
					$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;

			/** ** ** Inactive User ** ** **/
			case "IAU":
				$Sql = "UPDATE rs_tbl_users SET 
							isActive=2
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			/** ** ** Active User ** ** **/
			case "AU":
				$Sql = "UPDATE rs_tbl_users SET 
							isActive=1
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			/** ** ** Delete User ** ** **/
			case "DEL":
				$Sql = "UPDATE rs_tbl_users SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Log (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_log(
						user_id,
						activity_detail,
						isActive,
						entery_date,
						entity_id,
						log_type) 
						VALUES(";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("activity_detail", "V") ? "'" . $this->getProperty("activity_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entity_id", "V") ? "'" . $this->getProperty("entity_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("log_type", "V") ? "'" . $this->getProperty("log_type") . "'" : "1";
				$Sql .= ")";
				break;
			/** ** ** InActive User Activities ** ** **/
			case "AU":
				$Sql = "UPDATE rs_tbl_user_log SET 
							isActive=2
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			/** ** ** Delete User Activities ** ** **/
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_log SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_id=" . $this->getProperty("user_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User MailBox (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actMailBox($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_mailbox(
						mail_id,
						sender_id,
						receiver_id,
						mail_subject,
						mail_detail,
						mail_isfile,
						is_read,
						read_date,
						sender_del,
						receiver_del,
						is_draft,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("mail_id", "V") ? $this->getProperty("mail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sender_id", "V") ? $this->getProperty("sender_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("receiver_id", "V") ? $this->getProperty("receiver_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mail_subject", "V") ? "'" . $this->getProperty("mail_subject") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mail_detail", "V") ? "'" . $this->getProperty("mail_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mail_isfile", "V") ? $this->getProperty("mail_isfile") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_read", "V") ? $this->getProperty("is_read") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("read_date", "V") ? "'" . $this->getProperty("read_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("sender_del", "V") ? $this->getProperty("sender_del") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("receiver_del", "V") ? $this->getProperty("receiver_del") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("is_draft", "V") ? $this->getProperty("is_draft") : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_mailbox SET ";
				
				if($this->isPropertySet("is_read", "K")){
					$Sql .= "$con is_read='" . $this->getProperty("is_read") . "'";
					$con = ",";
				}
				if($this->isPropertySet("read_date", "K")){
					$Sql .= "$con read_date='" . $this->getProperty("read_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("sender_del", "K")){
					$Sql .= "$con sender_del=" . $this->getProperty("sender_del");
					$con = ",";
				}
				if($this->isPropertySet("receiver_del", "K")){
					$Sql .= "$con receiver_del=" . $this->getProperty("receiver_del");
					$con = ",";
				}
				if($this->isPropertySet("is_draft", "K")){
					$Sql .= "$con is_draft=" . $this->getProperty("is_draft");
					$con = ",";
				}
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("mail_id", "V"))
					$Sql .= " AND mail_id=" . $this->getProperty("mail_id");
				
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Mailbox Files (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actMailBoxFile($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_mailbox_file(
						mail_file_id,
						mail_id,
						mail_filetype,
						mail_filename,
						isActive,
						entery_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("mail_file_id", "V") ? $this->getProperty("mail_file_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mail_id", "V") ? $this->getProperty("mail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mail_filetype", "V") ? $this->getProperty("mail_filetype") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mail_filename", "V") ? "'" . $this->getProperty("mail_filename") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_mailbox_file SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("mail_id", "V"))
					$Sql .= " AND mail_id=" . $this->getProperty("mail_id");
				
				if($this->isPropertySet("mail_file_id", "V"))
					$Sql .= " AND mail_file_id=" . $this->getProperty("mail_file_id");
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Mailbox File Type (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actMailBoxFileType($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_mailbox_file_type(
						filetype_id,
						user_id,
						type_name,
						type_icon,
						isActive,
						entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("filetype_id", "V") ? $this->getProperty("filetype_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_name", "V") ? "'" . $this->getProperty("type_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_icon", "V") ? "'" . $this->getProperty("type_icon") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_mailbox_file_type SET ";
				
				if($this->isPropertySet("type_name", "K")){
					$Sql .= "$con type_name='" . $this->getProperty("type_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("type_icon", "K")){
					$Sql .= "$con type_icon='" . $this->getProperty("type_icon") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("filetype_id", "V"))
					$Sql .= " AND filetype_id=" . $this->getProperty("filetype_id");
					
				break;
			case "D":
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Location (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actLocation($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_location(
						location_id,
						user_id,
						company_id,
						location_name,
						location_address,
						location_phone_1,
						location_phone_2,
						location_phone_3,
						location_fax,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("location_id", "V") ? $this->getProperty("location_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_id", "V") ? $this->getProperty("company_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_name", "V") ? "'" . $this->getProperty("location_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_address", "V") ? "'" . $this->getProperty("location_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_phone_1", "V") ? "'" . $this->getProperty("location_phone_1") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_phone_2", "V") ? "'" . $this->getProperty("location_phone_2") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_phone_3", "V") ? "'" . $this->getProperty("location_phone_3") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_fax", "V") ? "'" . $this->getProperty("location_fax") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_location SET ";
				
				if($this->isPropertySet("location_name", "K")){
					$Sql .= "$con location_name='" . $this->getProperty("location_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("company_id", "K")){
					$Sql .= "$con company_id='" . $this->getProperty("company_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_address", "K")){
					$Sql .= "$con location_address='" . $this->getProperty("location_address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_phone_1", "K")){
					$Sql .= "$con location_phone_1='" . $this->getProperty("location_phone_1") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_phone_2", "K")){
					$Sql .= "$con location_phone_2='" . $this->getProperty("location_phone_2") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_phone_3", "K")){
					$Sql .= "$con location_phone_3='" . $this->getProperty("location_phone_3") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_fax", "K")){
					$Sql .= "$con location_fax='" . $this->getProperty("location_fax") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("location_id", "V"))
					$Sql .= " AND location_id=" . $this->getProperty("location_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_location SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND location_id=" . $this->getProperty("location_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Migration (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserMigration($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_migration (
						migration_id,
						user_id,
						migration_user_id,
						current_location_id,
						migration_location_id,
						migration_reason,
						migration_date,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("migration_id", "V") ? $this->getProperty("migration_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("migration_user_id", "V") ? "'" . $this->getProperty("migration_user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_location_id", "V") ? "'" . $this->getProperty("current_location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("migration_location_id", "V") ? "'" . $this->getProperty("migration_location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("migration_reason", "V") ? "'" . $this->getProperty("migration_reason") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("migration_date", "V") ? "'" . $this->getProperty("migration_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":	
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_migration SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND migration_id=" . $this->getProperty("migration_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Companies (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actCompanies($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_companies(
						company_id,
						user_id,
						company_name,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("company_id", "V") ? $this->getProperty("company_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_name", "V") ? "'" . $this->getProperty("company_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_companies SET ";
				
				if($this->isPropertySet("company_name", "K")){
					$Sql .= "$con company_name='" . $this->getProperty("company_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("company_id", "V"))
					$Sql .= " AND company_id=" . $this->getProperty("company_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_companies SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND company_id=" . $this->getProperty("company_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Departments (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actDepartments($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_department(
						department_id,
						user_id,
						company_id,
						department_name,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("department_id", "V") ? $this->getProperty("department_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_id", "V") ? $this->getProperty("company_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("department_name", "V") ? "'" . $this->getProperty("department_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_department SET ";
				
				if($this->isPropertySet("department_name", "K")){
					$Sql .= "$con department_name='" . $this->getProperty("department_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("company_id", "K")){
					$Sql .= "$con company_id='" . $this->getProperty("company_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("department_id", "V"))
					$Sql .= " AND department_id=" . $this->getProperty("department_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_department SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND department_id=" . $this->getProperty("department_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Job Title (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actJobTitle($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_job_title(
						job_title_id,
						user_id,
						job_title,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("job_title_id", "V") ? $this->getProperty("job_title_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_title", "V") ? "'" . $this->getProperty("job_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_job_title SET ";
				
				if($this->isPropertySet("job_title", "K")){
					$Sql .= "$con job_title='" . $this->getProperty("job_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("job_title_id", "V"))
					$Sql .= " AND job_title_id=" . $this->getProperty("job_title_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_job_title SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND job_title_id=" . $this->getProperty("job_title_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Shifts (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actShifts($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_shifts(
						shift_id,
						user_id,
						shift_name,
						shift_st,
						shift_et,
						shift_ligt,
						shift_logt,
						shift_eigt,
						shift_eogt,
						shift_bt,
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
						ligt_status,
						eogt_status,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("shift_id", "V") ? $this->getProperty("shift_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_name", "V") ? "'" . $this->getProperty("shift_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_st", "V") ? "'" . $this->getProperty("shift_st") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_et", "V") ? "'" . $this->getProperty("shift_et") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_ligt", "V") ? "'" . $this->getProperty("shift_ligt") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_logt", "V") ? "'" . $this->getProperty("shift_logt") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_eigt", "V") ? "'" . $this->getProperty("shift_eigt") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_eogt", "V") ? "'" . $this->getProperty("shift_eogt") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_bt", "V") ? "'" . $this->getProperty("shift_bt") . "'" : "NULL";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("full_late_in", "V") ? "'" . $this->getProperty("full_late_in") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("half_late_in", "V") ? "'" . $this->getProperty("half_late_in") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("qutr_late_in", "V") ? "'" . $this->getProperty("qutr_late_in") . "'" : "NULL";
				$Sql .= ",";
				
				
				$Sql .= $this->isPropertySet("full_off_bef", "V") ? "'" . $this->getProperty("full_off_bef") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("half_off_bef_start", "V") ? "'" . $this->getProperty("half_off_bef_start") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("half_off_bef_end", "V") ? "'" . $this->getProperty("half_off_bef_end") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("qutr_off_bef_start", "V") ? "'" . $this->getProperty("qutr_off_bef_start") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("qutr_off_bef_end", "V") ? "'" . $this->getProperty("qutr_off_bef_end") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ten_off_bef_start", "V") ? "'" . $this->getProperty("ten_off_bef_start") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("ten_off_bef_end", "V") ? "'" . $this->getProperty("ten_off_bef_end") . "'" : "NULL";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("ligt_status", "V") ? "'" . $this->getProperty("ligt_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("eogt_status", "V") ? "'" . $this->getProperty("eogt_status") . "'" : "1";
				$Sql .= ",";
				
				
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_shifts SET ";
				
				if($this->isPropertySet("shift_name", "K")){
					$Sql .= "$con shift_name='" . $this->getProperty("shift_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_title", "K")){
					$Sql .= "$con job_title='" . $this->getProperty("job_title") . "'";
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
				if($this->isPropertySet("shift_eigt", "K")){
					$Sql .= "$con shift_eigt='" . $this->getProperty("shift_eigt") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_eogt", "K")){
					$Sql .= "$con shift_eogt='" . $this->getProperty("shift_eogt") . "'";
					$con = ",";
				}
				if($this->isPropertySet("shift_bt", "K")){
					$Sql .= "$con shift_bt='" . $this->getProperty("shift_bt") . "'";
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
				
				if($this->isPropertySet("ligt_status", "K")){
					$Sql .= "$con ligt_status='" . $this->getProperty("ligt_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("eogt_status", "K")){
					$Sql .= "$con eogt_status='" . $this->getProperty("eogt_status") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("shift_id", "V"))
					$Sql .= " AND shift_id=" . $this->getProperty("shift_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_shifts SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND shift_id=" . $this->getProperty("shift_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Leave Type (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actLeaveType($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_leave_type(
						leave_type_id,
						user_id,
						leave_name,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("leave_type_id", "V") ? $this->getProperty("leave_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_name", "V") ? "'" . $this->getProperty("leave_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_leave_type SET ";
				
				if($this->isPropertySet("leave_name", "K")){
					$Sql .= "$con leave_name='" . $this->getProperty("leave_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("leave_type_id", "V"))
					$Sql .= " AND leave_type_id=" . $this->getProperty("leave_type_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_leave_type SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND leave_type_id=" . $this->getProperty("leave_type_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Holidays (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actHolidays($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_holidays(
						holiday_id,
						user_id,
						holiday_name,
						holiday_sd,
						holiday_ed,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("holiday_id", "V") ? $this->getProperty("holiday_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("holiday_name", "V") ? "'" . $this->getProperty("holiday_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("holiday_sd", "V") ? "'" . $this->getProperty("holiday_sd") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("holiday_ed", "V") ? "'" . $this->getProperty("holiday_ed") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_holidays SET ";
				
				if($this->isPropertySet("holiday_name", "K")){
					$Sql .= "$con holiday_name='" . $this->getProperty("holiday_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("holiday_sd", "K")){
					$Sql .= "$con holiday_sd='" . $this->getProperty("holiday_sd") . "'";
					$con = ",";
				}
				if($this->isPropertySet("holiday_ed", "K")){
					$Sql .= "$con holiday_ed='" . $this->getProperty("holiday_ed") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("holiday_id", "V"))
					$Sql .= " AND holiday_id=" . $this->getProperty("holiday_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_holidays SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND holiday_id=" . $this->getProperty("holiday_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Yearly Leave Type (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actYearlyLeaveType($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_yearly_leave_type(
						yearly_leave_type_id,
						user_id,
						yearly_leave_name,
						number_of_leave,
						entery_date,
						isActive,
						yearly_leave_type)
						VALUES(";
				$Sql .= $this->isPropertySet("yearly_leave_type_id", "V") ? $this->getProperty("yearly_leave_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("yearly_leave_name", "V") ? "'" . $this->getProperty("yearly_leave_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("number_of_leave", "V") ? "'" . $this->getProperty("number_of_leave") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("yearly_leave_type", "V") ? "'" . $this->getProperty("yearly_leave_type") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_yearly_leave_type SET ";
				
				if($this->isPropertySet("yearly_leave_name", "K")){
					$Sql .= "$con yearly_leave_name='" . $this->getProperty("yearly_leave_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("number_of_leave", "K")){
					$Sql .= "$con number_of_leave='" . $this->getProperty("number_of_leave") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("yearly_leave_type", "K")){
					$Sql .= "$con yearly_leave_type='" . $this->getProperty("yearly_leave_type") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("yearly_leave_type_id", "V"))
					$Sql .= " AND yearly_leave_type_id=" . $this->getProperty("yearly_leave_type_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_yearly_leave_type SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND yearly_leave_type_id=" . $this->getProperty("yearly_leave_type_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Leave Request (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserLeaveRequest($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_leave_request(
						leave_request_id,
						user_id,
						location_id,
						leave_type_id,
						yearly_leave_id,
						leave_reason,
						leave_of,
						leave_sd,
						leave_ed,
						forward_director,
						company_id,
						department_id,
						leave_status,
						hr_id,
						entery_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("leave_request_id", "V") ? $this->getProperty("leave_request_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? $this->getProperty("location_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_type_id", "V") ? $this->getProperty("leave_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("yearly_leave_id", "V") ? $this->getProperty("yearly_leave_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_reason", "V") ? "'" . $this->getProperty("leave_reason") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_of", "V") ? "'" . $this->getProperty("leave_of") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_sd", "V") ? "'" . $this->getProperty("leave_sd") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_ed", "V") ? "'" . $this->getProperty("leave_ed") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("forward_director", "V") ? "'" . $this->getProperty("forward_director") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_id", "V") ? $this->getProperty("company_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("department_id", "V") ? $this->getProperty("department_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_status", "V") ? "'" . $this->getProperty("leave_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("hr_id", "V") ? $this->getProperty("hr_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_leave_request SET ";
				
				if($this->isPropertySet("forward_director", "K")){
					$Sql .= "$con forward_director='" . $this->getProperty("forward_director") . "'";
					$con = ",";
				}
				if($this->isPropertySet("company_id", "K")){
					$Sql .= "$con company_id='" . $this->getProperty("company_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("leave_sd", "K")){
					$Sql .= "$con leave_sd='" . $this->getProperty("leave_sd") . "'";
					$con = ",";
				}
				if($this->isPropertySet("leave_ed", "K")){
					$Sql .= "$con leave_ed='" . $this->getProperty("leave_ed") . "'";
					$con = ",";
				}
				if($this->isPropertySet("leave_status", "K")){
					$Sql .= "$con leave_status='" . $this->getProperty("leave_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("hr_id", "K")){
					$Sql .= "$con hr_id='" . $this->getProperty("hr_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("leave_of", "K")){
					$Sql .= "$con leave_of='" . $this->getProperty("leave_of") . "'";
					$con = ",";
				}	
				if($this->isPropertySet("noofleave", "K")){
					$Sql .= "$con noofleave='" . $this->getProperty("noofleave") . "'";
					$con = ",";
				}	
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("leave_request_id", "V"))
					$Sql .= " AND leave_request_id=" . $this->getProperty("leave_request_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_leave_request SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND leave_request_id=" . $this->getProperty("leave_request_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Emergency Number (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserEmergencyNumber($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_emergency(
						user_emergency_id,
						user_id,
						person_name,
						contact_number,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("user_emergency_id", "V") ? $this->getProperty("user_emergency_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("person_name", "V") ? "'" . $this->getProperty("person_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_number", "V") ? "'" . $this->getProperty("contact_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_emergency SET ";
				
				if($this->isPropertySet("person_name", "K")){
					$Sql .= "$con person_name='" . $this->getProperty("person_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("contact_number", "K")){
					$Sql .= "$con contact_number='" . $this->getProperty("contact_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_emergency_id", "V"))
					$Sql .= " AND user_emergency_id=" . $this->getProperty("user_emergency_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_emergency SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_emergency_id=" . $this->getProperty("user_emergency_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Job Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserJobDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_job_detail(
						user_job_detail_id,
						user_id,
						job_title_id,
						job_description,
						company_id,
						department_id,
						joined_date,
						service_end_date,
						job_type,
						probation_period_end_date,
						probation_period_status,
						dummy_shift_id)
						VALUES(";
				$Sql .= $this->isPropertySet("user_job_detail_id", "V") ? $this->getProperty("user_job_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_title_id", "V") ? "'" . $this->getProperty("job_title_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_description", "V") ? "'" . $this->getProperty("job_description") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_id", "V") ? "'" . $this->getProperty("company_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("department_id", "V") ? "'" . $this->getProperty("department_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("joined_date", "V") ? "'" . $this->getProperty("joined_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("service_end_date", "V") ? "'" . $this->getProperty("service_end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_type", "V") ? "'" . $this->getProperty("job_type") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("probation_period_end_date", "V") ? "'" . $this->getProperty("probation_period_end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("probation_period_status", "V") ? "'" . $this->getProperty("probation_period_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("dummy_shift_id", "V") ? "'" . $this->getProperty("dummy_shift_id") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_job_detail SET ";
				
				if($this->isPropertySet("job_title_id", "K")){
					$Sql .= "$con job_title_id='" . $this->getProperty("job_title_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("company_id", "K")){
					$Sql .= "$con company_id='" . $this->getProperty("company_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("department_id", "K")){
					$Sql .= "$con department_id='" . $this->getProperty("department_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_description", "K")){
					$Sql .= "$con job_description='" . $this->getProperty("job_description") . "'";
					$con = ",";
				}
				if($this->isPropertySet("joined_date", "K")){
					$Sql .= "$con joined_date='" . $this->getProperty("joined_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("service_end_date", "K")){
					$Sql .= "$con service_end_date='" . $this->getProperty("service_end_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("probation_period_status", "K")){
					$Sql .= "$con probation_period_status='" . $this->getProperty("probation_period_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_type", "K")){
					$Sql .= "$con job_type='" . $this->getProperty("job_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("probation_period_end_date", "K")){
					$Sql .= "$con probation_period_end_date='" . $this->getProperty("probation_period_end_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("dummy_shift_id", "K")){
					$Sql .= "$con dummy_shift_id='" . $this->getProperty("dummy_shift_id") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_job_detail_id", "V"))
					$Sql .= " AND user_job_detail_id=" . $this->getProperty("user_job_detail_id");
					
				break;
			case "DEL":
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Leaves Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserLeaves($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_leaves(
						user_leave_id,
						user_id,
						leave_type_id,
						leave_days,
						leave_attempt,
						remaining_leave,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("user_leave_id", "V") ? $this->getProperty("user_leave_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_type_id", "V") ? "'" . $this->getProperty("leave_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_days", "V") ? "'" . $this->getProperty("leave_days") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_attempt", "V") ? "'" . $this->getProperty("leave_attempt") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("remaining_leave", "V") ? "'" . $this->getProperty("remaining_leave") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_leaves SET ";
				
				if($this->isPropertySet("leave_days", "K")){
					$Sql .= "$con leave_days='" . $this->getProperty("leave_days") . "'";
					$con = ",";
				}
				if($this->isPropertySet("leave_attempt", "K")){
					$Sql .= "$con leave_attempt='" . $this->getProperty("leave_attempt") . "'";
					$con = ",";
				}
				if($this->isPropertySet("remaining_leave", "K")){
					$Sql .= "$con remaining_leave='" . $this->getProperty("remaining_leave") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_leave_id", "V"))
					$Sql .= " AND user_leave_id=" . $this->getProperty("user_leave_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_leaves SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_leave_id=" . $this->getProperty("user_leave_id");
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Reference Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserReference($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_reference(
						user_reference_id,
						user_id,
						person_name,
						contact_no,
						company_name,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("user_reference_id", "V") ? $this->getProperty("user_reference_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("person_name", "V") ? "'" . $this->getProperty("person_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("contact_no", "V") ? "'" . $this->getProperty("contact_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_name", "V") ? "'" . $this->getProperty("company_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_reference SET ";
				
				if($this->isPropertySet("person_name", "K")){
					$Sql .= "$con person_name='" . $this->getProperty("person_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("contact_no", "K")){
					$Sql .= "$con contact_no='" . $this->getProperty("contact_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("company_name", "K")){
					$Sql .= "$con company_name='" . $this->getProperty("company_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_reference_id", "V"))
					$Sql .= " AND user_reference_id=" . $this->getProperty("user_reference_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_reference SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_reference_id=" . $this->getProperty("user_reference_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Skills Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserSkills($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_skills(
						user_skills_id,
						user_id,
						skills)
						VALUES(";
				$Sql .= $this->isPropertySet("user_skills_id", "V") ? $this->getProperty("user_skills_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("skills", "V") ? "'" . $this->getProperty("skills") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_skills SET ";
				
				if($this->isPropertySet("skills", "K")){
					$Sql .= "$con skills='" . $this->getProperty("skills") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_skills_id", "V"))
					$Sql .= " AND user_skills_id=" . $this->getProperty("user_skills_id");
					
				break;
			case "DEL":
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Shifts Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserShifts($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_shifts(
						user_shift_id,
						user_id,
						shift_id,
						day_id,
						day_status,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("user_shift_id", "V") ? $this->getProperty("user_shift_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("shift_id", "V") ? "'" . $this->getProperty("shift_id") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("day_id", "V") ? "'" . $this->getProperty("day_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("day_status", "V") ? "'" . $this->getProperty("day_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_shifts SET ";
				
				if($this->isPropertySet("shift_id", "K")){
					$Sql .= "$con shift_id='" . $this->getProperty("shift_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("day_id", "K")){
					$Sql .= "$con day_id='" . $this->getProperty("day_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("day_status", "K")){
					$Sql .= "$con day_status='" . $this->getProperty("day_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_shift_id", "V"))
					$Sql .= " AND user_shift_id=" . $this->getProperty("user_shift_id");
					
				break;
			case "DEL":
				break;
			default:
				break;
		}
		//echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Education Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserEducation($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_education(
						user_education_id,
						user_id,
						institute_name,
						major,
						start_date,
						end_date,
						document_file_name,
						document_file,
						other_note,
						isAcitve)
						VALUES(";
				$Sql .= $this->isPropertySet("user_education_id", "V") ? $this->getProperty("user_education_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("institute_name", "V") ? "'" . $this->getProperty("institute_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("major", "V") ? "'" . $this->getProperty("major") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("start_date", "V") ? "'" . $this->getProperty("start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("document_file_name", "V") ? "'" . $this->getProperty("document_file_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("document_file", "V") ? "'" . $this->getProperty("document_file") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("other_note", "V") ? "'" . $this->getProperty("other_note") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isAcitve", "V") ? "'" . $this->getProperty("isAcitve") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_education SET ";
				
				if($this->isPropertySet("institute_name", "K")){
					$Sql .= "$con institute_name='" . $this->getProperty("institute_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("major", "K")){
					$Sql .= "$con major='" . $this->getProperty("major") . "'";
					$con = ",";
				}
				if($this->isPropertySet("start_date", "K")){
					$Sql .= "$con start_date='" . $this->getProperty("start_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("end_date", "K")){
					$Sql .= "$con end_date='" . $this->getProperty("end_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("document_file_name", "K")){
					$Sql .= "$con document_file_name='" . $this->getProperty("document_file_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("document_file", "K")){
					$Sql .= "$con document_file='" . $this->getProperty("document_file") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isAcitve", "K")){
					$Sql .= "$con isAcitve='" . $this->getProperty("isAcitve") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_education_id", "V"))
					$Sql .= " AND user_education_id=" . $this->getProperty("user_education_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_education SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_education_id=" . $this->getProperty("user_education_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Employment Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserEmployment($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_employment(
						user_employment_id,
						user_id,
						company_name,
						job_title,
						from_date,
						end_date,
						isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("user_employment_id", "V") ? $this->getProperty("user_employment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_name", "V") ? "'" . $this->getProperty("company_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("job_title", "V") ? "'" . $this->getProperty("job_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("from_date", "V") ? "'" . $this->getProperty("from_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("end_date", "V") ? "'" . $this->getProperty("end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isAcitve", "V") ? "'" . $this->getProperty("isAcitve") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_employment SET ";
				
				if($this->isPropertySet("company_name", "K")){
					$Sql .= "$con company_name='" . $this->getProperty("company_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("job_title", "K")){
					$Sql .= "$con job_title='" . $this->getProperty("job_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("from_date", "K")){
					$Sql .= "$con from_date='" . $this->getProperty("from_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("end_date", "K")){
					$Sql .= "$con end_date='" . $this->getProperty("end_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isAcitve", "K")){
					$Sql .= "$con isAcitve='" . $this->getProperty("isAcitve") . "'";
					$con = ",";
				}
					
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_employment_id", "V"))
					$Sql .= " AND user_employment_id=" . $this->getProperty("user_employment_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_employment SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_employment_id=" . $this->getProperty("user_employment_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Leads Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actLeads($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_leads(
							leads_id,
							dmm_user_id,
							client_name,
							client_phone_number,
							client_email,
							client_message,
							lead_date,
							lead_from_id,
							entery_datetime,
							rm_user_id,
							rm_lead_status,
							rm_lead_view_datetime,
							rm_action_datetime,
							rm_lead_fwd_status,
							rm_lead_fwd_datetime,
							assign_location_id,
							assign_team_lead_id,
							assign_teamlead_datetime,
							assign_agent_status,
							assign_datetime,
							isActive,
							lead_status)
						VALUES(";
				$Sql .= $this->isPropertySet("leads_id", "V") ? $this->getProperty("leads_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("dmm_user_id", "V") ? $this->getProperty("dmm_user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("client_name", "V") ? "'" . $this->getProperty("client_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("client_phone_number", "V") ? "'" . $this->getProperty("client_phone_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("client_email", "V") ? "'" . $this->getProperty("client_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("client_message", "V") ? "'" . $this->getProperty("client_message") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lead_date", "V") ? "'" . $this->getProperty("lead_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lead_from_id", "V") ? "'" . $this->getProperty("lead_from_id") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_datetime", "V") ? "'" . $this->getProperty("entery_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rm_user_id", "V") ? "'" . $this->getProperty("rm_user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rm_lead_status", "V") ? "'" . $this->getProperty("rm_lead_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rm_lead_view_datetime", "V") ? "'" . $this->getProperty("rm_lead_view_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rm_action_datetime", "V") ? "'" . $this->getProperty("rm_action_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rm_lead_fwd_status", "V") ? "'" . $this->getProperty("rm_lead_fwd_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rm_lead_fwd_datetime", "V") ? "'" . $this->getProperty("rm_lead_fwd_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_location_id", "V") ? "'" . $this->getProperty("assign_location_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_team_lead_id", "V") ? "'" . $this->getProperty("assign_team_lead_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_teamlead_datetime", "V") ? "'" . $this->getProperty("assign_teamlead_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_agent_status", "V") ? "'" . $this->getProperty("assign_agent_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_datetime", "V") ? "'" . $this->getProperty("assign_datetime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lead_status", "V") ? "'" . $this->getProperty("lead_status") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_leads SET ";
				
				if($this->isPropertySet("rm_user_id", "K")){
					$Sql .= "$con rm_user_id='" . $this->getProperty("rm_user_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rm_lead_status", "K")){
					$Sql .= "$con rm_lead_status='" . $this->getProperty("rm_lead_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rm_lead_view_datetime", "K")){
					$Sql .= "$con rm_lead_view_datetime='" . $this->getProperty("rm_lead_view_datetime") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rm_action_datetime", "K")){
					$Sql .= "$con rm_action_datetime='" . $this->getProperty("rm_action_datetime") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rm_lead_fwd_status", "K")){
					$Sql .= "$con rm_lead_fwd_status='" . $this->getProperty("rm_lead_fwd_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rm_lead_fwd_datetime", "K")){
					$Sql .= "$con rm_lead_fwd_datetime='" . $this->getProperty("rm_lead_fwd_datetime") . "'";
					$con = ",";
				}
				if($this->isPropertySet("assign_location_id", "K")){
					$Sql .= "$con assign_location_id='" . $this->getProperty("assign_location_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("assign_team_lead_id", "K")){
					$Sql .= "$con assign_team_lead_id='" . $this->getProperty("assign_team_lead_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("assign_teamlead_datetime", "K")){
					$Sql .= "$con assign_teamlead_datetime='" . $this->getProperty("assign_teamlead_datetime") . "'";
					$con = ",";
				}
				if($this->isPropertySet("assign_datetime", "K")){
					$Sql .= "$con assign_datetime='" . $this->getProperty("assign_datetime") . "'";
					$con = ",";
				}
				if($this->isPropertySet("assign_agent_status", "K")){
					$Sql .= "$con assign_agent_status='" . $this->getProperty("assign_agent_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("lead_status", "K")){
					$Sql .= "$con lead_status='" . $this->getProperty("lead_status") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("leads_id", "V"))
					$Sql .= " AND leads_id=" . $this->getProperty("leads_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_leads SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND leads_id=" . $this->getProperty("leads_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Leads Assign Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actLeadsAssign($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_leads_assign(
							assign_lead_id,
							lead_id,
							assign_user_id,
							assign_from_user_id,
							assign_by,
							assign_date,
							assign_time,
							assign_lead_status,
							entery_date,
							isActive,
							assign_action_status,
							action_date,
							action_time)
						VALUES(";
				$Sql .= $this->isPropertySet("assign_lead_id", "V") ? $this->getProperty("assign_lead_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lead_id", "V") ? $this->getProperty("lead_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_user_id", "V") ? "'" . $this->getProperty("assign_user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_from_user_id", "V") ? "'" . $this->getProperty("assign_from_user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_by", "V") ? "'" . $this->getProperty("assign_by") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_date", "V") ? "'" . $this->getProperty("assign_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_time", "V") ? "'" . $this->getProperty("assign_time") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_lead_status", "V") ? "'" . $this->getProperty("assign_lead_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_action_status", "V") ? "'" . $this->getProperty("assign_action_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("action_date", "V") ? "'" . $this->getProperty("action_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("action_time", "V") ? "'" . $this->getProperty("action_time") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_leads_assign SET ";
				
				if($this->isPropertySet("assign_lead_status", "K")){
					$Sql .= "$con assign_lead_status='" . $this->getProperty("assign_lead_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("assign_action_status", "K")){
					$Sql .= "$con assign_action_status='" . $this->getProperty("assign_action_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("action_date", "K")){
					$Sql .= "$con action_date='" . $this->getProperty("action_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("action_time", "K")){
					$Sql .= "$con action_time='" . $this->getProperty("action_time") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("assign_lead_id", "V"))
					$Sql .= " AND assign_lead_id=" . $this->getProperty("assign_lead_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_leads_assign SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND assign_lead_id=" . $this->getProperty("assign_lead_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Leads Assign Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actLeadComments($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_lead_comments(
							lead_comment_id,
							leads_id,
							assign_lead_id,
							user_id,
							lead_comment,
							assign_lead_status,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("lead_comment_id", "V") ? $this->getProperty("lead_comment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leads_id", "V") ? $this->getProperty("leads_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_lead_id", "V") ? "'" . $this->getProperty("assign_lead_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("lead_comment", "V") ? "'" . $this->getProperty("lead_comment") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_lead_status", "V") ? "'" . $this->getProperty("assign_lead_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_lead_comments SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND lead_comment_id=" . $this->getProperty("lead_comment_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Salary Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSalary($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_salary(
							user_salary_id,
							user_id,
							salary_amount,
							salary_type,
							salary_mode,
							apply_from,
							cutting_mode,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("user_salary_id", "V") ? $this->getProperty("user_salary_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("salary_amount", "V") ? "'" . $this->getProperty("salary_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("salary_type", "V") ? "'" . $this->getProperty("salary_type") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("salary_mode", "V") ? "'" . $this->getProperty("salary_mode") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("apply_from", "V") ? "'" . $this->getProperty("apply_from") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cutting_mode", "V") ? "'" . $this->getProperty("cutting_mode") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_salary SET ";
				
				if($this->isPropertySet("salary_amount", "K")){
					$Sql .= "$con salary_amount='" . $this->getProperty("salary_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("apply_from", "K")){
					$Sql .= "$con apply_from='" . $this->getProperty("apply_from") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("cutting_mode", "K")){
					$Sql .= "$con cutting_mode='" . $this->getProperty("cutting_mode") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_salary_id", "V"))
					$Sql .= " AND user_salary_id=" . $this->getProperty("user_salary_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_salary SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_salary_id=" . $this->getProperty("user_salary_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Salary Bonus Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actSalaryBonus($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_salary_bonus(
							user_bonus_id,
							user_id,
							bonus_amount,
							bonus_status,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("user_bonus_id", "V") ? $this->getProperty("user_bonus_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bonus_amount", "V") ? "'" . $this->getProperty("bonus_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bonus_status", "V") ? "'" . $this->getProperty("bonus_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_salary_bonus SET ";
				
				if($this->isPropertySet("bonus_amount", "K")){
					$Sql .= "$con bonus_amount='" . $this->getProperty("bonus_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bonus_status", "K")){
					$Sql .= "$con bonus_status='" . $this->getProperty("bonus_status") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("user_bonus_id", "V"))
					$Sql .= " AND user_bonus_id=" . $this->getProperty("user_bonus_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_salary_bonus SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND user_bonus_id=" . $this->getProperty("user_bonus_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Salary Bonus Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actProspectDetails($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_prospect_details(
							prospect_id,
							prospect_name,
							prospect_email,
							prospect_phone,
							prospect_msg,
							prospect_formid,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("prospect_id", "V") ? $this->getProperty("prospect_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("prospect_name", "V") ? "'" . $this->getProperty("prospect_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("prospect_email", "V") ? "'" . $this->getProperty("prospect_email") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("prospect_phone", "V") ? "'" . $this->getProperty("prospect_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("prospect_msg", "V") ? "'" . $this->getProperty("prospect_msg") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("prospect_formid", "V") ? "'" . $this->getProperty("prospect_formid") . "'" : "4";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_prospect_details SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("prospect_id", "V"))
					$Sql .= " AND prospect_id=" . $this->getProperty("prospect_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_prospect_details SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND prospect_id=" . $this->getProperty("prospect_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Advance Salary Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actAdvanceSalaryDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_advance_salary(
							advance_salary_id,
							user_id,
							salary_amount,
							paying_date,
							advance_month,
							advance_reason,
							payback_option,
							payback_in_months,
							advance_salary_status,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("advance_salary_id", "V") ? $this->getProperty("advance_salary_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("salary_amount", "V") ? "'" . $this->getProperty("salary_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("paying_date", "V") ? "'" . $this->getProperty("paying_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_month", "V") ? "'" . $this->getProperty("advance_month") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_reason", "V") ? "'" . $this->getProperty("advance_reason") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_option", "V") ? "'" . $this->getProperty("payback_option") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_in_months", "V") ? "'" . $this->getProperty("payback_in_months") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_salary_status", "V") ? "'" . $this->getProperty("advance_salary_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_advance_salary SET ";
				
				if($this->isPropertySet("advance_salary_status", "K")){
					$Sql .= "$con advance_salary_status='" . $this->getProperty("advance_salary_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_option", "K")){
					$Sql .= "$con payback_option='" . $this->getProperty("payback_option") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_amount", "K")){
					$Sql .= "$con payback_amount='" . $this->getProperty("payback_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_in_months", "K")){
					$Sql .= "$con payback_in_months='" . $this->getProperty("payback_in_months") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("advance_salary_id", "V"))
					$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_advance_salary SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Advance Salary Payback Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actAdvanceSalaryPayBackDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_advance_salary_payback(
							payback_monthly_id,
							user_id,
							advance_salary_id,
							monthly_amount,
							payback_status,
							payback_date,
							isActive,
							entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("payback_monthly_id", "V") ? $this->getProperty("payback_monthly_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_salary_id", "V") ? "'" . $this->getProperty("advance_salary_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_amount", "V") ? "'" . $this->getProperty("monthly_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_status", "V") ? "'" . $this->getProperty("payback_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_date", "V") ? "'" . $this->getProperty("payback_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_payment_requests_advance_salary_payback SET ";
				
				if($this->isPropertySet("payback_status", "K")){
					$Sql .= "$con payback_status='" . $this->getProperty("payback_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("payback_monthly_id", "V"))
					$Sql .= " AND payback_monthly_id=" . $this->getProperty("payback_monthly_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_advance_salary_payback SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND payback_monthly_id=" . $this->getProperty("payback_monthly_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is User Advance Salary Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actEmployeeOverTimeDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_overtime_detail(
							emp_overtime_id,
							user_id,
							att_id,
							att_date,
							no_of_hrs,
							rate_per_hr,
							per_day_salary,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("emp_overtime_id", "V") ? $this->getProperty("emp_overtime_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_id", "V") ? "'" . $this->getProperty("att_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("att_date", "V") ? "'" . $this->getProperty("att_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_hrs", "V") ? "'" . $this->getProperty("no_of_hrs") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rate_per_hr", "V") ? "'" . $this->getProperty("rate_per_hr") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("per_day_salary", "V") ? "'" . $this->getProperty("per_day_salary") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_overtime_detail SET ";
				
				if($this->isPropertySet("per_day_salary", "K")){
					$Sql .= "$con per_day_salary='" . $this->getProperty("per_day_salary") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("overtime_approved", "K")){
					$Sql .= "$con overtime_approved='" . $this->getProperty("overtime_approved") . "'";
					$con = ",";
				}
				if($this->isPropertySet("overtime_pay", "K")){
					$Sql .= "$con overtime_pay='" . $this->getProperty("overtime_pay") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("emp_overtime_id", "V"))
					$Sql .= " AND emp_overtime_id=" . $this->getProperty("emp_overtime_id");
				
				if($this->isPropertySet("user_id", "V"))
					$Sql .= " AND user_id=" . $this->getProperty("user_id");
				
				if($this->isPropertySet("att_id", "V"))
					$Sql .= " AND att_id=" . $this->getProperty("att_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_overtime_detail SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND emp_overtime_id=" . $this->getProperty("emp_overtime_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Request Flow (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserRequestFlow($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_request_flow(
							request_flow_id,
							user_id,
							company_id,
							department_id,
							request_flow_type,
							employee_id,
							leave_request_to,
							overtime_request_to,
							isActive,
							entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("request_flow_id", "V") ? $this->getProperty("request_flow_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";

				$Sql .= ",";
				$Sql .= $this->isPropertySet("company_id", "V") ? "'" . $this->getProperty("company_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("department_id", "V") ? "'" . $this->getProperty("department_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_flow_type", "V") ? "'" . $this->getProperty("request_flow_type") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? "'" . $this->getProperty("employee_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("leave_request_to", "V") ? "'" . $this->getProperty("leave_request_to") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("overtime_request_to", "V") ? "'" . $this->getProperty("overtime_request_to") . "'" : "0";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_request_flow SET ";
				
				if($this->isPropertySet("leave_request_to", "K")){
					$Sql .= "$con leave_request_to='" . $this->getProperty("leave_request_to") . "'";
					$con = ",";
				}
				if($this->isPropertySet("overtime_request_to", "K")){
					$Sql .= "$con overtime_request_to='" . $this->getProperty("overtime_request_to") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("request_flow_id", "V"))
					$Sql .= " AND request_flow_id=" . $this->getProperty("request_flow_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_request_flow SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND request_flow_id=" . $this->getProperty("request_flow_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Request Flow (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserRequestFlowLog($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_request_flow_log(
							request_flow_log_id,
							user_id,
							request_flow_id,
							activity_detail,
							isActive,
							entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("request_flow_log_id", "V") ? $this->getProperty("request_flow_log_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_flow_id", "V") ? "'" . $this->getProperty("request_flow_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("activity_detail", "V") ? "'" . $this->getProperty("activity_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_request_flow_log SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND request_flow_log_id=" . $this->getProperty("request_flow_log_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Bank Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserBankDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_bank_account_detail(
							employee_bank_id,
							user_id,
							bank_id,
							account_no,
							account_title,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("employee_bank_id", "V") ? $this->getProperty("employee_bank_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bank_id", "V") ? "'" . $this->getProperty("bank_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("account_no", "V") ? "'" . $this->getProperty("account_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("account_title", "V") ? "'" . $this->getProperty("account_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_bank_account_detail SET ";
				
				if($this->isPropertySet("account_no", "K")){
					$Sql .= "$con account_no='" . $this->getProperty("account_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("account_title", "K")){
					$Sql .= "$con account_title='" . $this->getProperty("account_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("employee_bank_id", "V"))
					$Sql .= " AND employee_bank_id=" . $this->getProperty("employee_bank_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_bank_account_detail SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND employee_bank_id=" . $this->getProperty("employee_bank_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Monthly Paid Salary (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserMonthlyPaidSalary($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_monthly_paid_salary(
							monthly_salary_id,
							entery_user_id,
							flt_start_date,
							flt_end_date,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("monthly_salary_id", "V") ? $this->getProperty("monthly_salary_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_user_id", "V") ? "'" . $this->getProperty("entery_user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("flt_start_date", "V") ? "'" . $this->getProperty("flt_start_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("flt_end_date", "V") ? "'" . $this->getProperty("flt_end_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				/*$Sql = "UPDATE rs_tbl_user_bank_account_detail SET ";
				
				if($this->isPropertySet("account_no", "K")){
					$Sql .= "$con account_no='" . $this->getProperty("account_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("account_title", "K")){
					$Sql .= "$con account_title='" . $this->getProperty("account_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("employee_bank_id", "V"))
					$Sql .= " AND employee_bank_id=" . $this->getProperty("employee_bank_id");*/
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_monthly_paid_salary SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND monthly_salary_id=" . $this->getProperty("monthly_salary_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User Monthly Paid Salary Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserMonthlyPaidSalaryDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_monthly_paid_salary_detail(
							paid_salary_detail_id,
							monthly_salary_id,
							user_id,
							emp_lieo,
							emp_absent,
							emp_aprv_leaves,
							emp_adv_amount,
							emp_adv_payback_id,
							emp_deduction,
							emp_cutting_mode,
							emp_monthly_salary,
							emp_bonus_id,
							emp_bonus,
							emp_overtime,
							emp_incometax,
							pay_mode,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("paid_salary_detail_id", "V") ? $this->getProperty("paid_salary_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_salary_id", "V") ? "'" . $this->getProperty("monthly_salary_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_lieo", "V") ? "'" . $this->getProperty("emp_lieo") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_absent", "V") ? "'" . $this->getProperty("emp_absent") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_aprv_leaves", "V") ? "'" . $this->getProperty("emp_aprv_leaves") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_adv_amount", "V") ? "'" . $this->getProperty("emp_adv_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_adv_payback_id", "V") ? "'" . $this->getProperty("emp_adv_payback_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_deduction", "V") ? "'" . $this->getProperty("emp_deduction") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_cutting_mode", "V") ? "'" . $this->getProperty("emp_cutting_mode") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_monthly_salary", "V") ? "'" . $this->getProperty("emp_monthly_salary") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_bonus_id", "V") ? "'" . $this->getProperty("emp_bonus_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_bonus", "V") ? "'" . $this->getProperty("emp_bonus") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_overtime", "V") ? "'" . $this->getProperty("emp_overtime") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("emp_incometax", "V") ? "'" . $this->getProperty("emp_incometax") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pay_mode", "V") ? "'" . $this->getProperty("pay_mode") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_monthly_paid_salary_detail SET ";
				
				if($this->isPropertySet("pay_mode", "K")){
					$Sql .= "$con pay_mode='" . $this->getProperty("pay_mode") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transaction_status", "K")){
					$Sql .= "$con transaction_status='" . $this->getProperty("transaction_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transaction_number", "K")){
					$Sql .= "$con transaction_number='" . $this->getProperty("transaction_number") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("paid_salary_detail_id", "V"))
					$Sql .= " AND paid_salary_detail_id=" . $this->getProperty("paid_salary_detail_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_monthly_paid_salary_detail SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("paid_salary_detail_id", "K")){
					$Sql .= " AND paid_salary_detail_id='" . $this->getProperty("paid_salary_detail_id") . "'";
				}
				if($this->isPropertySet("monthly_salary_id", "K")){
					$Sql .= " AND monthly_salary_id='" . $this->getProperty("monthly_salary_id") . "'";
				}
				break;
			default:
				break;
		}

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is User DEvice List(Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actUserDeviceList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_user_device_list(
							verification_id,
							device_id,
							user_id,
							security_code,
							mobile_status,
							verification_date,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("verification_id", "V") ? $this->getProperty("verification_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("device_id", "V") ? "'" . $this->getProperty("device_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("security_code", "V") ? "'" . $this->getProperty("security_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("mobile_status", "V") ? "'" . $this->getProperty("mobile_status") . "'" : "3";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("verification_date", "V") ? "'" . $this->getProperty("verification_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_user_device_list SET ";
				
				if($this->isPropertySet("security_code", "K")){
					$Sql .= "$con security_code='" . $this->getProperty("security_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("mobile_status", "K")){
					$Sql .= "$con mobile_status='" . $this->getProperty("mobile_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("verification_date", "K")){
					$Sql .= "$con verification_date='" . $this->getProperty("verification_date") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("verification_id", "V"))
					$Sql .= " AND verification_id=" . $this->getProperty("verification_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_user_device_list SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("verification_id", "K")){
					$Sql .= " AND verification_id='" . $this->getProperty("verification_id") . "'";
				}
				break;
			default:
				break;
		}

		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Payment Requests List(Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPaymentRequestsList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_payment_requests(
							payment_request_id,
							user_id,
							requested_amount,
							apply_type_id,
							apply_date,
							request_status,
							request_stage,
							request_stage_status,
							request_fwd_dep_to,
							request_fwd_dep_status,
							request_fwd_finance_to,
							request_fwd_finance_status,
							request_fwd_ceo_to,
							request_fwd_ceo_status,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("payment_request_id", "V") ? $this->getProperty("payment_request_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("requested_amount", "V") ? "'" . $this->getProperty("requested_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("apply_type_id", "V") ? "'" . $this->getProperty("apply_type_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("apply_date", "V") ? "'" . $this->getProperty("apply_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_status", "V") ? "'" . $this->getProperty("request_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_stage", "V") ? "'" . $this->getProperty("request_stage") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_stage_status", "V") ? "'" . $this->getProperty("request_stage_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_fwd_dep_to", "V") ? "'" . $this->getProperty("request_fwd_dep_to") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_fwd_dep_status", "V") ? "'" . $this->getProperty("request_fwd_dep_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_fwd_finance_to", "V") ? "'" . $this->getProperty("request_fwd_finance_to") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_fwd_finance_status", "V") ? "'" . $this->getProperty("request_fwd_finance_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_fwd_ceo_to", "V") ? "'" . $this->getProperty("request_fwd_ceo_to") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_fwd_ceo_status", "V") ? "'" . $this->getProperty("request_fwd_ceo_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_payment_requests SET ";
				
				if($this->isPropertySet("requested_amount", "K")){
					$Sql .= "$con requested_amount='" . $this->getProperty("requested_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_status", "K")){
					$Sql .= "$con request_status='" . $this->getProperty("request_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_stage", "K")){
					$Sql .= "$con request_stage='" . $this->getProperty("request_stage") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_stage_status", "K")){
					$Sql .= "$con request_stage_status='" . $this->getProperty("request_stage_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_fwd_dep_status", "K")){
					$Sql .= "$con request_fwd_dep_status='" . $this->getProperty("request_fwd_dep_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_fwd_finance_to", "K")){
					$Sql .= "$con request_fwd_finance_to='" . $this->getProperty("request_fwd_finance_to") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_fwd_finance_status", "K")){
					$Sql .= "$con request_fwd_finance_status='" . $this->getProperty("request_fwd_finance_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_fwd_ceo_to", "K")){
					$Sql .= "$con request_fwd_ceo_to='" . $this->getProperty("request_fwd_ceo_to") . "'";
					$con = ",";
				}
				if($this->isPropertySet("request_fwd_ceo_status", "K")){
					$Sql .= "$con request_fwd_ceo_status='" . $this->getProperty("request_fwd_ceo_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("payment_request_id", "V"))
					$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_payment_requests SET 
							isActive=3
						WHERE
							1=1";
				if($this->isPropertySet("payment_request_id", "K")){
					$Sql .= " AND payment_request_id='" . $this->getProperty("payment_request_id") . "'";
				}
				break;
			default:
				break;
		}

		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is Payment Requests Advance Salary Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPaymentRequestsAdvanceSalary($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_payment_requests_advance_salary(
							advance_salary_id,
							user_id,
							payment_request_id,
							salary_amount,
							paying_date,
							advance_month,
							advance_reason,
							payback_option,
							payback_in_months,
							advance_salary_status,
							advance_type,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("advance_salary_id", "V") ? $this->getProperty("advance_salary_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_request_id", "V") ? "'" . $this->getProperty("payment_request_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("salary_amount", "V") ? "'" . $this->getProperty("salary_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("paying_date", "V") ? "'" . $this->getProperty("paying_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_month", "V") ? "'" . $this->getProperty("advance_month") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_reason", "V") ? "'" . $this->getProperty("advance_reason") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_option", "V") ? "'" . $this->getProperty("payback_option") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_in_months", "V") ? "'" . $this->getProperty("payback_in_months") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_salary_status", "V") ? "'" . $this->getProperty("advance_salary_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_type", "V") ? "'" . $this->getProperty("advance_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_payment_requests_advance_salary SET ";
				
				if($this->isPropertySet("advance_salary_status", "K")){
					$Sql .= "$con advance_salary_status='" . $this->getProperty("advance_salary_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_option", "K")){
					$Sql .= "$con payback_option='" . $this->getProperty("payback_option") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_amount", "K")){
					$Sql .= "$con payback_amount='" . $this->getProperty("payback_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("payback_in_months", "K")){
					$Sql .= "$con payback_in_months='" . $this->getProperty("payback_in_months") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("advance_salary_id", "V"))
					$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
				
				if($this->isPropertySet("payment_request_id", "V"))
					$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
					
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_payment_requests_advance_salary SET 
							isActive=3
						WHERE
							1=1";
				//$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
				if($this->isPropertySet("advance_salary_id", "V"))
					$Sql .= " AND advance_salary_id=" . $this->getProperty("advance_salary_id");
				
				if($this->isPropertySet("payment_request_id", "V"))
					$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Payment Requests Advance Salary Payback Detail (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPaymentRequestsAdvanceSalaryPayBack($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_payment_requests_advance_salary_payback(
							payback_monthly_id,
							user_id,
							advance_salary_id,
							payment_request_id,
							monthly_amount,
							payback_status,
							payback_date,
							isActive,
							entery_date)
						VALUES(";
				$Sql .= $this->isPropertySet("payback_monthly_id", "V") ? $this->getProperty("payback_monthly_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("advance_salary_id", "V") ? "'" . $this->getProperty("advance_salary_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_request_id", "V") ? "'" . $this->getProperty("payment_request_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_amount", "V") ? "'" . $this->getProperty("monthly_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_status", "V") ? "'" . $this->getProperty("payback_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payback_date", "V") ? "'" . $this->getProperty("payback_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_payment_requests_advance_salary_payback SET ";
				
				if($this->isPropertySet("payback_status", "K")){
					$Sql .= "$con payback_status='" . $this->getProperty("payback_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("payback_monthly_id", "V"))
					$Sql .= " AND payback_monthly_id=" . $this->getProperty("payback_monthly_id");
				
				if($this->isPropertySet("payment_request_id", "V"))
					$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
						
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_payment_requests_advance_salary_payback SET 
							isActive=3
						WHERE
							1=1";
				//$Sql .= " AND payback_monthly_id=" . $this->getProperty("payback_monthly_id");
				if($this->isPropertySet("payback_monthly_id", "V"))
					$Sql .= " AND payback_monthly_id=" . $this->getProperty("payback_monthly_id");
				
				if($this->isPropertySet("payment_request_id", "V"))
					$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Payment Requests Items List (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actPaymentRequestsItemsList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_payment_requests_items(
							misc_item_req_id,
							payment_request_id,
							user_id,
							item_id,
							item_qty,
							required_amount,
							reason_note,
							item_req_status,
							entery_date,
							isActive)
						VALUES(";
				$Sql .= $this->isPropertySet("misc_item_req_id", "V") ? $this->getProperty("misc_item_req_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("payment_request_id", "V") ? "'" . $this->getProperty("payment_request_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("item_id", "V") ? "'" . $this->getProperty("item_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("item_qty", "V") ? "'" . $this->getProperty("item_qty") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("required_amount", "V") ? "'" . $this->getProperty("required_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("reason_note", "V") ? "'" . $this->getProperty("reason_note") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("item_req_status", "V") ? "'" . $this->getProperty("item_req_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_payment_requests_items SET ";
				
				if($this->isPropertySet("item_req_status", "K")){
					$Sql .= "$con item_req_status='" . $this->getProperty("item_req_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
									
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("misc_item_req_id", "V"))
					$Sql .= " AND misc_item_req_id=" . $this->getProperty("misc_item_req_id");
				
				if($this->isPropertySet("payment_request_id", "V"))
					$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
						
				break;
			case "DEL":
				$Sql = "UPDATE rs_tbl_payment_requests_items SET 
							isActive=3
						WHERE
							1=1";
				//$Sql .= " AND payback_monthly_id=" . $this->getProperty("payback_monthly_id");
				if($this->isPropertySet("misc_item_req_id", "V"))
					$Sql .= " AND misc_item_req_id=" . $this->getProperty("misc_item_req_id");
				
				if($this->isPropertySet("payment_request_id", "V"))
					$Sql .= " AND payment_request_id=" . $this->getProperty("payment_request_id");
					
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	
	/**
	* This function is used to change the password
	* @author Numan Tahir
	*/
	public function changePassword(){
		$Sql = "UPDATE rs_tbl_users SET
					user_pass='" . $this->getProperty("user_pass") . "' 
				WHERE 
					1=1";
		$Sql .= " AND user_id='" . $this->getProperty("user_id") . "'";

		return $this->dbQuery($Sql);
	}	
	
	/**
	* This function is used to change the password
	* @author Numan Tahir
	*/
	public function changeSecurityCode(){
		$Sql = "UPDATE rs_tbl_users SET
					user_security_code='" . $this->getProperty("user_security_code") . "' 
				WHERE 
					1=1";
		$Sql .= " AND user_id='" . $this->getProperty("user_id") . "'";

		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to get the new code/id for the table.
	* @author Numan Tahir
	* @Date : 18 July, 2012
	* @modified :  18 July, 2012 by Numan Tahir
	* @return : bool
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