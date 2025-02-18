<?php
/**
*
* This is a class SSSjatlan
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class SSSjatlan extends Database{
	
	public $user_id;

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
			
			for($y=1905; $y<=2015; $y++){
			if($y == $Year_id){
			$Year_list .= '<option value="' . $y . '" selected>' . $y . '</option>';
			} else {
			$Year_list .= '<option value="' . $y . '">' . $y . '</option>';
			}
			}
		return $Year_list;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function CustomerType($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					category_id,
					category_name
				FROM
					rs_tbl_jt_customer_category
				WHERE
					1=1 
					AND isActive=1 AND category_type=1 ORDER BY category_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['category_id'] == $sel)
				$opt .= "<option value=\"" . $rows['category_id'] . "\" selected>" . $rows['category_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['category_id'] . "\">" . $rows['category_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function CustomerLocation($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					location_id,
					location_name
				FROM
					rs_tbl_jt_location
				WHERE
					1=1 
					AND isActive=1 ORDER BY location_name";
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
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function SupplierCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					customer_id,
					customer_business_name
				FROM
					rs_tbl_jt_customers
				WHERE
					1=1 
					AND isActive=1 AND customer_type=2 ORDER BY customer_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['customer_id'] == $sel)
				$opt .= "<option value=\"" . $rows['customer_id'] . "\" selected>" . $rows['customer_business_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['customer_id'] . "\">" . $rows['customer_business_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function CustomerCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					rs_tbl_jt_customers.customer_id
					, rs_tbl_jt_customers.customer_name
					, rs_tbl_jt_customers.customer_address
					, rs_tbl_jt_location.location_name
				FROM
					rs_tbl_jt_customers
					INNER JOIN rs_tbl_jt_location 
						ON (rs_tbl_jt_customers.location_id = rs_tbl_jt_location.location_id)
				WHERE
					1=1 
					AND rs_tbl_jt_customers.isActive=1 AND rs_tbl_jt_customers.customer_type=1 ORDER BY customer_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['customer_id'] == $sel)
				$opt .= "<option value=\"" . $rows['customer_id'] . "\" selected>" . $rows['customer_name'] . ' ('.$rows['location_name'].' -> '.$rows['customer_address'] . ")</option>\n";
			else
				$opt .= "<option value=\"" . $rows['customer_id'] . "\">" . $rows['customer_name'] . ' ('.$rows['location_name'].' -> '. $rows['customer_address'] . ")</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function ProductCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					rs_tbl_jt_products.product_id
					, rs_tbl_jt_products.product_name
					, rs_tbl_jt_products.product_size
					, rs_tbl_jt_products.isActive
					, rs_tbl_jt_product_price.buy_price
					, rs_tbl_jt_product_price.selling_price
					, rs_tbl_jt_product_price.isActive
				FROM
					rs_tbl_jt_products
					INNER JOIN rs_tbl_jt_product_price 
						ON (rs_tbl_jt_products.product_id = rs_tbl_jt_product_price.product_id AND rs_tbl_jt_product_price.isActive=1)
					WHERE 1=1 
					AND rs_tbl_jt_products.isActive=1 ORDER BY product_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['product_id'] == $sel)
				$opt .= "<option data-selling=\"" . $rows['selling_price'] . "\" value=\"" . $rows['product_id'] . "\" selected>" . $rows['product_name']  . "</option>\n";
			else
				$opt .= "<option data-selling=\"" . $rows['selling_price'] . "\" value=\"" . $rows['product_id'] . "\">" . $rows['product_name']  . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function VendorProductCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					rs_tbl_jt_products.product_id
					, rs_tbl_jt_products.product_name
					, rs_tbl_jt_products.product_size
					, rs_tbl_jt_products.isActive
					, rs_tbl_jt_product_price.buy_price
					, rs_tbl_jt_product_price.selling_price
					, rs_tbl_jt_product_price.isActive
				FROM
					rs_tbl_jt_products
					INNER JOIN rs_tbl_jt_product_price 
						ON (rs_tbl_jt_products.product_id = rs_tbl_jt_product_price.product_id AND rs_tbl_jt_product_price.isActive=1)
					WHERE 1=1 
					AND rs_tbl_jt_products.isActive=1 ORDER BY product_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['product_id'] == $sel)
				$opt .= "<option data-selling=\"" . $rows['buy_price'] . "\" value=\"" . $rows['product_id'] . "\" selected>" . $rows['product_name']  . "</option>\n";
			else
				$opt .= "<option data-selling=\"" . $rows['buy_price'] . "\" value=\"" . $rows['product_id'] . "\">" . $rows['product_name']  . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function DestinationCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					location_id,
					location_name,
					deliver_chagres,
					unloading_charges
				FROM
					rs_tbl_jt_location
				WHERE
					1=1 
					AND isActive=1 ORDER BY location_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['location_id'] == $sel)
				$opt .= "<option data-unloading=\"" . $rows['unloading_charges'] . "\" data-deliver=\"" . $rows['deliver_chagres'] . "\" value=\"" . $rows['location_id'] . "\" selected>" . $rows['location_name'] . "</option>\n";
			else
				$opt .= "<option data-unloading=\"" . $rows['unloading_charges'] . "\" data-deliver=\"" . $rows['deliver_chagres'] . "\" value=\"" . $rows['location_id'] . "\">" . $rows['location_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function VehicleTypeCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					vechile_type_id,
					type_name
				FROM
					rs_tbl_jt_vehicle_type
				WHERE
					1=1 
					AND isActive=1 ORDER BY type_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['vechile_type_id'] == $sel)
				$opt .= "<option value=\"" . $rows['vechile_type_id'] . "\" selected>" . $rows['type_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['vechile_type_id'] . "\">" . $rows['type_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function ChangeVehicleInOrderCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					rs_tbl_jt_vehicle.vehicle_id
					, rs_tbl_jt_vehicle.vehicle_number
					, rs_tbl_jt_vehicle.vehicle_name
					, IF(rs_tbl_jt_vehicle.vehicle_source=1, 'In-House', 'Outside') as vehicle_source_title
					, rs_tbl_jt_vehicle.loading_capacity
					, rs_tbl_jt_vehicle_type.type_name
					, rs_tbl_jt_vehicle_assigned.isActive
					, CONCAT(rs_tbl_users.user_fname,'-',rs_tbl_users.user_lname) AS fullname
					, rs_tbl_jt_vehicle_assigned.driver_id
				FROM
					rs_tbl_jt_vehicle
					INNER JOIN rs_tbl_jt_vehicle_type 
						ON (rs_tbl_jt_vehicle.vehicle_type_id = rs_tbl_jt_vehicle_type.vechile_type_id)
					INNER JOIN rs_tbl_jt_vehicle_assigned 
						ON (rs_tbl_jt_vehicle.vehicle_id = rs_tbl_jt_vehicle_assigned.vehicle_id AND rs_tbl_jt_vehicle_assigned.isActive=1)
					INNER JOIN rs_tbl_users 
						ON (rs_tbl_jt_vehicle_assigned.driver_id = rs_tbl_users.user_id)
					WHERE 
						1=1 
					AND rs_tbl_jt_vehicle.isActive=1 ORDER BY vehicle_number";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['vehicle_id'] != $sel)
				$opt .= "<option data-capacity=".$rows['loading_capacity']." data-type=".$rows['type_name']."  data-driver=".$rows['fullname']."  data-source=".$rows['vehicle_source_title']."  data-name=".$rows['vehicle_name']."  data-number=".$rows['vehicle_number']." data-did=".$rows['driver_id']." value=\"" . $rows['vehicle_id'] . "\" >" . $rows['vehicle_number'] . "(".$rows['vehicle_source_title'] . ")</option>\n";
			//else
				//$opt .= "<option data-capacity=".$rows['loading_capacity']." data-type=".$rows['type_name']."  data-driver=".$rows['fullname']."  data-source=".$rows['vehicle_source_title']."  data-name=".$rows['vehicle_name']."  data-number=".$rows['vehicle_number']." data-did=".$rows['driver_id']." value=\"" . $rows['vehicle_id'] . "\">" . $rows['vehicle_number'] . "(".$rows['vehicle_source_title'] . ")</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function VehicleOrderProcessCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					rs_tbl_jt_vehicle.vehicle_id
					, rs_tbl_jt_vehicle.vehicle_number
					, rs_tbl_jt_vehicle.vehicle_name
					, IF(rs_tbl_jt_vehicle.vehicle_source=1, 'In-House', 'Outside') as vehicle_source_title
					, rs_tbl_jt_vehicle.loading_capacity
					, rs_tbl_jt_vehicle_type.type_name
				FROM
					rs_tbl_jt_vehicle
					INNER JOIN rs_tbl_jt_vehicle_type 
						ON (rs_tbl_jt_vehicle.vehicle_type_id = rs_tbl_jt_vehicle_type.vechile_type_id)
					WHERE 
						1=1 
					AND rs_tbl_jt_vehicle.isActive=1 ORDER BY vehicle_number";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['vehicle_id'] == $sel)
				$opt .= "<option data-capacity=".$rows['loading_capacity']." data-type=".$rows['type_name']."  data-source=".$rows['vehicle_source_title']."  data-name=".$rows['vehicle_name']."  data-number=".$rows['vehicle_number']." value=\"" . $rows['vehicle_id'] . "\" selected>" . $rows['vehicle_number'] . "(".$rows['vehicle_source_title'] . ")</option>\n";
			else
				$opt .= "<option data-capacity=".$rows['loading_capacity']." data-type=".$rows['type_name']."  data-source=".$rows['vehicle_source_title']."  data-name=".$rows['vehicle_name']."  data-number=".$rows['vehicle_number']." value=\"" . $rows['vehicle_id'] . "\">" . $rows['vehicle_number'] . "(".$rows['vehicle_source_title'] . ")</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the user's combo
	* @author Numan Tahir
	*/
	public function GetProductName($req_id){
		$opt = "";
		$Sql = "SELECT 
					product_id,
					product_name,
					product_size
				FROM
					rs_tbl_jt_products
				WHERE
					1=1 
					AND isActive=1 AND product_id=".$req_id;
		$this->dbQuery($Sql);
		$rows = $this->dbFetchArray(1);
			if($rows["product_size"] != ''){
				return $rows["product_name"].' ('.$rows["product_size"].')';
			} else {
				return $rows["product_name"];
			}
	}
	
	/**
	* This function is used to list the Properties Expected Revenue
	* @author Numan Tahir
	*/
	public function VehicleOrderProcess(){
		$Sql = "SELECT
					rs_tbl_jt_vehicle.vehicle_id
					, rs_tbl_jt_vehicle.vehicle_number
					, rs_tbl_jt_vehicle.vehicle_name
					, IF(rs_tbl_jt_vehicle.vehicle_source=1, 'In-House', 'Outside') as vehicle_source_title
					, rs_tbl_jt_vehicle.loading_capacity
					, rs_tbl_jt_vehicle_type.type_name
					, rs_tbl_jt_vehicle_assigned.isActive
					, CONCAT(rs_tbl_users.user_fname,' ',rs_tbl_users.user_lname) AS fullname
					, rs_tbl_jt_vehicle_assigned.driver_id
				FROM
					rs_tbl_jt_vehicle
					INNER JOIN rs_tbl_jt_vehicle_type 
						ON (rs_tbl_jt_vehicle.vehicle_type_id = rs_tbl_jt_vehicle_type.vechile_type_id)
					INNER JOIN rs_tbl_jt_vehicle_assigned 
						ON (rs_tbl_jt_vehicle.vehicle_id = rs_tbl_jt_vehicle_assigned.vehicle_id AND rs_tbl_jt_vehicle_assigned.isActive=1)
					INNER JOIN rs_tbl_users 
						ON (rs_tbl_jt_vehicle_assigned.driver_id = rs_tbl_users.user_id)
					WHERE 
						1=1 ";
		
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND rs_tbl_jt_vehicle.vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND rs_tbl_jt_vehicle.isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND rs_tbl_jt_vehicle.isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Properties Expected Revenue
	* @author Numan Tahir
	*/
	public function lstCustomerCategory(){
		$Sql = "SELECT 
					category_id,
					user_id,
					category_name,
					category_type,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_customer_category
				WHERE 
					1=1";
		
		if($this->isPropertySet("category_id", "V"))
			$Sql .= " AND category_id=" . $this->getProperty("category_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("category_type", "V"))
			$Sql .= " AND category_type=" . $this->getProperty("category_type");
		
		if($this->isPropertySet("category_name", "V"))
			$Sql .= " AND category_name='" . $this->getProperty("category_name") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Block
	* @author Numan Tahir
	*/
	public function lstCustomers(){
		$Sql = "SELECT
					customer_id,
					user_id,
					customer_type,
					customer_category,
					customer_name,
					customer_phone,
					customer_mobile,
					customer_email,
					location_id,
					customer_address,
					customer_business_name,
					entery_date,
					isActive,
					c_code
				FROM
					rs_tbl_jt_customers
				WHERE
					1=1";
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("customer_type", "V"))
			$Sql .= " AND customer_type=" . $this->getProperty("customer_type");
		
		if($this->isPropertySet("customer_category", "V"))
			$Sql .= " AND customer_category=" . $this->getProperty("customer_category");
			
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->isPropertySet("c_code", "V"))
			$Sql .= " AND c_code='" . $this->getProperty("c_code") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function lstLocation(){
		$Sql = "SELECT 
					location_id,
					user_id,
					location_name,
					deliver_chagres,
					unloading_charges,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_location
				WHERE
					1=1";
					 
		if($this->isPropertySet("location_id", "V"))
			$Sql .= " AND location_id=" . $this->getProperty("location_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("location_name", "V"))
			$Sql .= " AND location_name='" . $this->getProperty("location_name") . "'";
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Block
	* @author Numan Tahir
	*/
	public function lstOrders(){
		$Sql = "SELECT
					order_id,
					user_id,
					order_no,
					vechile_id,
					driver_id,
					create_date,
					update_date,
					deliver_date,
					total_feright_cost,
					total_unloading_cost,
					total_order_cost,
					total_order_sell_cost,
					total_quantity_order,
					d_invoice_no,
					d_cof_number,
					d_loading_advice_no,
					order_status,
					order_remarks,
					entery_date,
					isActive,
					purchase_trans_id,
					vehicle_trans_id,
					unloader_trans_id
				FROM
					rs_tbl_jt_order
				WHERE
					1=1";
		
		if($this->isPropertySet("order_id", "V"))
			$Sql .= " AND order_id=" . $this->getProperty("order_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("order_no", "V"))
			$Sql .= " AND order_no='" . $this->getProperty("order_no") . "'";
		
		if($this->isPropertySet("vechile_id", "V"))
			$Sql .= " AND vechile_id=" . $this->getProperty("vechile_id");
		
		if($this->isPropertySet("driver_id", "V"))
			$Sql .= " AND driver_id=" . $this->getProperty("driver_id");
		
		if($this->isPropertySet("order_status", "V"))
			$Sql .= " AND order_status=" . $this->getProperty("order_status");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
		
		if($this->isPropertySet("purchase_trans_id", "V"))
			$Sql .= " AND purchase_trans_id=" . $this->getProperty("purchase_trans_id");
		
		if($this->isPropertySet("vehicle_trans_id", "V"))
			$Sql .= " AND vehicle_trans_id=" . $this->getProperty("vehicle_trans_id");
		
		if($this->isPropertySet("unloader_trans_id", "V"))
			$Sql .= " AND unloader_trans_id=" . $this->getProperty("unloader_trans_id");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Block
	* @author Numan Tahir
	*/
	public function lstOrderDetail(){
		$Sql = "SELECT
					order_detail_id,
					order_id,
					user_id,
					request_order_id,
					customer_id,
					product_id,
					product_price_id,
					vendor_id,
					purchase_price,
					selling_price,
					freight_price,
					unloading_price,
					order_qty,
					order_status,
					swap_requested_order_id,
					transaction_no,
					created_date,
					update_date,
					isActive
				FROM
					rs_tbl_jt_order_detail
				WHERE
					1=1";
		
		if($this->isPropertySet("order_detail_id", "V"))
			$Sql .= " AND order_detail_id=" . $this->getProperty("order_detail_id");
			
		if($this->isPropertySet("order_id", "V"))
			$Sql .= " AND order_id=" . $this->getProperty("order_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("request_order_id", "V"))
			$Sql .= " AND request_order_id=" . $this->getProperty("request_order_id");
		
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("vendor_id", "V"))
			$Sql .= " AND vendor_id=" . $this->getProperty("vendor_id");
			
		if($this->isPropertySet("product_price_id", "V"))
			$Sql .= " AND product_price_id=" . $this->getProperty("product_price_id");
		
		if($this->isPropertySet("vendor_id", "V"))
			$Sql .= " AND vendor_id=" . $this->getProperty("vendor_id");
			
		if($this->isPropertySet("order_status", "V"))
			$Sql .= " AND order_status=" . $this->getProperty("order_status");
			
		if($this->isPropertySet("transaction_no", "V"))
			$Sql .= " AND transaction_no='" . $this->getProperty("transaction_no") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Block
	* @author Numan Tahir
	*/
	public function lstOrderTransactionDetail(){
		$Sql = "SELECT
					order_tran_id,
					user_id,
					order_id,
					transaction_id,
					id_type,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_order_transaction_detail
				WHERE
					1=1";
		
		if($this->isPropertySet("order_tran_id", "V"))
			$Sql .= " AND order_tran_id=" . $this->getProperty("order_tran_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("order_id", "V"))
			$Sql .= " AND order_id=" . $this->getProperty("order_id");
		
		if($this->isPropertySet("transaction_id", "V"))
			$Sql .= " AND transaction_id=" . $this->getProperty("transaction_id");
		
		if($this->isPropertySet("id_type", "V"))
			$Sql .= " AND id_type=" . $this->getProperty("id_type");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Block
	* @author Numan Tahir
	*/
	public function lstOrderDetailVehicleSum(){
		$Sql = "SELECT
					sum(freight_price) as vehicle_amount,
					sum(unloading_price) as unloading_amount
				FROM
					rs_tbl_jt_order_detail
				WHERE
					1=1";
		
		if($this->isPropertySet("order_id", "V"))
			$Sql .= " AND order_id=" . $this->getProperty("order_id");
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Buildings
	* @author Numan Tahir
	*/
	public function lstSumOrderRequestQty(){
		$Sql = "SELECT 
					sum(no_of_items) as no_of_items
				FROM
					rs_tbl_jt_order_request_detail 
				WHERE 
					1=1";
		
		if($this->getProperty("order_request_id", "V"))
			$Sql .= " AND order_request_id=" . $this->getProperty("order_request_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("vendor_id", "V"))
			$Sql .= " AND vendor_id=" . $this->getProperty("vendor_id");
				
		if($this->isPropertySet("destination_id", "V"))
			$Sql .= " AND destination_id=" . $this->getProperty("destination_id");	
		
		if($this->isPropertySet("order_status", "V"))
			$Sql .= " AND order_status=" . $this->getProperty("order_status");	
			
		if($this->isPropertySet("order_process_status", "V"))
			$Sql .= " AND order_process_status=" . $this->getProperty("order_process_status");	
			
		if($this->isPropertySet("replace_order_status", "V"))
			$Sql .= " AND replace_order_status=" . $this->getProperty("replace_order_status");	
			
		if($this->isPropertySet("replace_order_id", "V"))
			$Sql .= " AND replace_order_id=" . $this->getProperty("replace_order_id");	
		
		if($this->isPropertySet("order_delivery_status", "V"))
			$Sql .= " AND order_delivery_status=" . $this->getProperty("order_delivery_status");	
		
		if($this->isPropertySet("order_request_type", "V"))
			$Sql .= " AND order_request_type=" . $this->getProperty("order_request_type");
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND d_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");	
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Buildings
	* @author Numan Tahir
	*/
	public function lstOrderRequestDetail(){
		$Sql = "SELECT 
					order_request_id,
					user_id,
					customer_id,
					product_id,
					product_price_id,
					destination_id,
					vendor_id,
					purchase_id,
					unloading_price,
					delivery_chagres,
					no_of_items,
					per_item_amount,
					final_amount,
					vehicle_id,
					delivery_required_date,
					order_process_status,
					replace_order_status,
					replace_order_id,
					order_delivery_status,
					request_order_no,
					order_request_type,
					entery_date,
					isActive,
					cof_no,
					d_invoice_no,
					d_date,
					order_status,
					remaining_item,
					tran_code,
					extra_note
				FROM
					rs_tbl_jt_order_request_detail 
				WHERE 
					1=1";
		
		if($this->getProperty("order_request_id", "V"))
			$Sql .= " AND order_request_id=" . $this->getProperty("order_request_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("purchase_id", "V"))
			$Sql .= " AND purchase_id=" . $this->getProperty("purchase_id");
			
		if($this->isPropertySet("vendor_id", "V"))
			$Sql .= " AND vendor_id=" . $this->getProperty("vendor_id");
		
		if($this->isPropertySet("d_invoice_no", "V"))
			$Sql .= " AND d_invoice_no='" . $this->getProperty("d_invoice_no") . "'";
					
		if($this->isPropertySet("destination_id", "V"))
			$Sql .= " AND destination_id=" . $this->getProperty("destination_id");	
		
		if($this->isPropertySet("order_status", "V"))
			$Sql .= " AND order_status=" . $this->getProperty("order_status");	
			
		if($this->isPropertySet("order_process_status", "V"))
			$Sql .= " AND order_process_status=" . $this->getProperty("order_process_status");	
			
		if($this->isPropertySet("replace_order_status", "V"))
			$Sql .= " AND replace_order_status=" . $this->getProperty("replace_order_status");	
			
		if($this->isPropertySet("replace_order_id", "V"))
			$Sql .= " AND replace_order_id=" . $this->getProperty("replace_order_id");	
		
		if($this->isPropertySet("order_delivery_status", "V"))
			$Sql .= " AND order_delivery_status=" . $this->getProperty("order_delivery_status");	
		
		if($this->isPropertySet("order_request_type", "V"))
			$Sql .= " AND order_request_type=" . $this->getProperty("order_request_type");
		
		if($this->isPropertySet("order_request_type_array", "V"))
			$Sql .= " AND order_request_type IN (".$this->getProperty("order_request_type_array"). ")";
			
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND d_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
		
		if($this->isPropertySet("DATEFILTER_SECOND", "V"))
			$Sql .= " AND date(entery_date) BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
		
		if($this->getProperty("remaining_item", "V"))
			$Sql .= " AND remaining_item=" . $this->getProperty("remaining_item");
					
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");	
		
		if($this->isPropertySet("tran_code", "V"))
			$Sql .= " AND tran_code=" . $this->getProperty("tran_code");	
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
			// echo $Sql;
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Buildings
	* @author Numan Tahir
	*/
	public function lstOrderAmountSum(){
		$Sql = "SELECT 
					sum(final_amount) as order_amount
				FROM
					rs_tbl_jt_order_request_detail 
				WHERE 
					1=1";
		
		if($this->getProperty("order_request_id", "V"))
			$Sql .= " AND order_request_id=" . $this->getProperty("order_request_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("customer_id", "V"))
			$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
		
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("purchase_id", "V"))
			$Sql .= " AND purchase_id=" . $this->getProperty("purchase_id");
			
		if($this->isPropertySet("vendor_id", "V"))
			$Sql .= " AND vendor_id=" . $this->getProperty("vendor_id");
		
		if($this->isPropertySet("d_invoice_no", "V"))
			$Sql .= " AND d_invoice_no='" . $this->getProperty("d_invoice_no") . "'";
					
		if($this->isPropertySet("destination_id", "V"))
			$Sql .= " AND destination_id=" . $this->getProperty("destination_id");	
		
		if($this->isPropertySet("order_status", "V"))
			$Sql .= " AND order_status=" . $this->getProperty("order_status");	
			
		if($this->isPropertySet("order_process_status", "V"))
			$Sql .= " AND order_process_status=" . $this->getProperty("order_process_status");	
			
		if($this->isPropertySet("replace_order_status", "V"))
			$Sql .= " AND replace_order_status=" . $this->getProperty("replace_order_status");	
			
		if($this->isPropertySet("replace_order_id", "V"))
			$Sql .= " AND replace_order_id=" . $this->getProperty("replace_order_id");	
		
		if($this->isPropertySet("order_delivery_status", "V"))
			$Sql .= " AND order_delivery_status=" . $this->getProperty("order_delivery_status");	
		
		if($this->isPropertySet("order_request_type", "V"))
			$Sql .= " AND order_request_type=" . $this->getProperty("order_request_type");
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND d_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
		
		if($this->isPropertySet("DATEFILTER_SECOND", "V"))
			$Sql .= " AND date(entery_date) BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
		
		if($this->getProperty("remaining_item", "V"))
			$Sql .= " AND remaining_item=" . $this->getProperty("remaining_item");
					
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");	
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Buildings
	* @author Numan Tahir
	*/
	public function lstCustomerContraOrderDetail(){
		$Sql = "SELECT 
					cc_order_request_id,
					user_id,
					from_customer_id,
					to_customer_id,
					product_id,
					product_price_id,
					destination_id,
					vendor_id,
					unloading_price,
					delivery_chagres,
					no_of_items,
					per_item_amount,
					to_per_item_amount,
					final_amount,
					to_final_amount,
					vehicle_id,
					delivery_required_date,
					order_process_status,
					replace_order_status,
					replace_order_id,
					order_delivery_status,
					request_order_no,
					order_request_type,
					entery_date,
					isActive,
					cof_no,
					d_invoice_no,
					d_date,
					order_status,
					tran_code
				FROM
					rs_tbl_jt_customer_contra_order_detail 
				WHERE 
					1=1";
		
		if($this->getProperty("cc_order_request_id", "V"))
			$Sql .= " AND cc_order_request_id=" . $this->getProperty("cc_order_request_id");
		
		if($this->getProperty("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("from_customer_id", "V"))
			$Sql .= " AND from_customer_id=" . $this->getProperty("from_customer_id");
		
		if($this->isPropertySet("to_customer_id", "V"))
			$Sql .= " AND to_customer_id=" . $this->getProperty("to_customer_id");
			
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("vendor_id", "V"))
			$Sql .= " AND vendor_id=" . $this->getProperty("vendor_id");
				
		if($this->isPropertySet("destination_id", "V"))
			$Sql .= " AND destination_id=" . $this->getProperty("destination_id");	
		
		if($this->isPropertySet("order_status", "V"))
			$Sql .= " AND order_status=" . $this->getProperty("order_status");	
			
		if($this->isPropertySet("order_process_status", "V"))
			$Sql .= " AND order_process_status=" . $this->getProperty("order_process_status");	
			
		if($this->isPropertySet("replace_order_status", "V"))
			$Sql .= " AND replace_order_status=" . $this->getProperty("replace_order_status");	
			
		if($this->isPropertySet("replace_order_id", "V"))
			$Sql .= " AND replace_order_id=" . $this->getProperty("replace_order_id");	
		
		if($this->isPropertySet("order_delivery_status", "V"))
			$Sql .= " AND order_delivery_status=" . $this->getProperty("order_delivery_status");	
		
		if($this->isPropertySet("order_request_type", "V"))
			$Sql .= " AND order_request_type=" . $this->getProperty("order_request_type");
		
		if($this->isPropertySet("DATEFILTER", "V"))
			$Sql .= " AND d_date BETWEEN '".$this->getProperty("STARTDATE")."' AND '".$this->getProperty("ENDDATE")."'";
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");	
		
		if($this->isPropertySet("tran_code", "V"))
			$Sql .= " AND tran_code=" . $this->getProperty("tran_code");	
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Floors
	* @author Numan Tahir
	*/
	public function lstProductPrice(){
		$Sql = "SELECT 
					product_price_id,
					user_id,
					product_id,
					buy_price,
					selling_price,
					labor_charges,
					delivery_charges,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_product_price
				WHERE 
					1=1";
		
		if($this->isPropertySet("product_price_id", "V"))
			$Sql .= " AND product_price_id=" . $this->getProperty("product_price_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Monthly Rent
	* @author Numan Tahir
	*/
	public function lstProducts(){
		$Sql = "SELECT 
					product_id,
					user_id,
					product_name,
					product_size,
					vendor_id,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_products
				WHERE 
					1=1";
		
		if($this->isPropertySet("product_id", "V"))
			$Sql .= " AND product_id=" . $this->getProperty("product_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("vendor_id", "V"))
			$Sql .= " AND vendor_id=" . $this->getProperty("vendor_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Monthly Rent Amount
	* @author Numan Tahir
	*/
	public function lstVehicle(){
		$Sql = "SELECT 
					vehicle_id,
					user_id,
					vehicle_number,
					vehicle_name,
					vehicle_source,
					vehicle_type_id,
					loading_capacity,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_vehicle
				WHERE 
					1=1";
		
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("vehicle_type_id", "V"))
			$Sql .= " AND vehicle_type_id=" . $this->getProperty("vehicle_type_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Properties
	* @author Numan Tahir
	*/
	public function lstVehicleAssigned(){
		$Sql = "SELECT 
					vehicle_assign_id,
					vehicle_id,
					driver_id,
					user_id,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_vehicle_assigned
				WHERE 
					1=1";
		
		if($this->isPropertySet("vehicle_assign_id", "V"))
			$Sql .= " AND vehicle_assign_id=" . $this->getProperty("vehicle_assign_id");
		
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("driver_id", "V"))
			$Sql .= " AND driver_id=" . $this->getProperty("driver_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Properties
	* @author Numan Tahir
	*/
	public function lstVehicleAssignDriver(){
		$Sql = "SELECT
					rs_tbl_jt_vehicle_assigned.vehicle_assign_id
					, rs_tbl_jt_vehicle_assigned.vehicle_id
					, rs_tbl_jt_vehicle_assigned.driver_id
					, rs_tbl_jt_vehicle_assigned.user_id
					, rs_tbl_jt_vehicle_assigned.entery_date
					, rs_tbl_jt_vehicle_assigned.isActive
					, rs_tbl_users.user_fname
					, rs_tbl_users.user_lname
				FROM
					rs_tbl_jt_vehicle_assigned
					INNER JOIN rs_tbl_users 
						ON (rs_tbl_jt_vehicle_assigned.driver_id = rs_tbl_users.user_id)
					WHERE 1=1";
		
		if($this->isPropertySet("driver_id", "V"))
			$Sql .= " AND rs_tbl_jt_vehicle_assigned.driver_id=" . $this->getProperty("driver_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND  rs_tbl_jt_vehicle_assigned.isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("vehicle_id", "V"))
			$Sql .= " AND rs_tbl_jt_vehicle_assigned.vehicle_id=" . $this->getProperty("vehicle_id");
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND rs_tbl_jt_vehicle_assigned.isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Information
	* @author Numan Tahir
	*/
	public function lstVehicleType(){
		$Sql = "SELECT 
					vechile_type_id,
					user_id,
					type_name,
					entery_date,
					isActive
				FROM
					rs_tbl_jt_vehicle_type
				WHERE 
					1=1";
		
		if($this->isPropertySet("vechile_type_id", "V"))
			$Sql .= " AND vechile_type_id=" . $this->getProperty("vechile_type_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Information
	* @author Numan Tahir
	*/
	public function lstVehicleExpSupplier(){
		$Sql = "SELECT 
					vehicle_exp_id,
					user_id,
					exp_title,
					supplier_name,
					supplier_contact_no,
					supplier_location,
					entery_date,
					isActive,
					option_type
				FROM
					rs_tbl_jt_vehicle_exp_supplier
				WHERE 
					1=1";
		
		if($this->isPropertySet("vehicle_exp_id", "V"))
			$Sql .= " AND vehicle_exp_id=" . $this->getProperty("vehicle_exp_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("option_type", "V"))
			$Sql .= " AND option_type=" . $this->getProperty("option_type");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is used to list the Tenant Information
	* @author Numan Tahir
	*/
	public function lstVehicleExpSupplierTrans(){
		$Sql = "SELECT 
					vendor_exp_detail_id,
					vendor_exp_id,
					user_id,
					option_type,
					order_request_id,
					exp_detail,
					exp_amount,
					exp_date,
					entery_date,
					isActive,
					quantity_detail,
					tran_code
				FROM
					rs_tbl_jt_vehicle_exp_supplier_trans
				WHERE 
					1=1";
		
		if($this->isPropertySet("vendor_exp_detail_id", "V"))
			$Sql .= " AND vendor_exp_detail_id=" . $this->getProperty("vendor_exp_detail_id");
		
		if($this->isPropertySet("vendor_exp_id", "V"))
			$Sql .= " AND vendor_exp_id=" . $this->getProperty("vendor_exp_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("option_type", "V"))
			$Sql .= " AND option_type=" . $this->getProperty("option_type");
		
		if($this->isPropertySet("order_request_id", "V"))
			$Sql .= " AND order_request_id=" . $this->getProperty("order_request_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("tran_code", "V"))
			$Sql .= " AND tran_code=" . $this->getProperty("tran_code");
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Information
	* @author Numan Tahir
	*/
	public function lstOrderCenterArea(){
		$Sql = "SELECT 
					order_center_id,
					order_type,
					order_code,
					order_id,
					purchase_id,
					order_tran_id,
					unloader_option,
					unloader_tran_id,
					vechile_tran_id,
					transferamount_opt,
					trans_id_vehicle_second,
					trans_id_vehicle_one
				FROM
				rs_tbl_order_center
				WHERE 
					1=1";
		
		if($this->isPropertySet("order_center_id", "V"))
			$Sql .= " AND order_center_id=" . $this->getProperty("order_center_id");
		
		if($this->isPropertySet("order_type", "V"))
			$Sql .= " AND order_type=" . $this->getProperty("order_type");
		
		if($this->isPropertySet("order_code", "V"))
			$Sql .= " AND order_code='" . $this->getProperty("order_code") . "'";
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
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
	* This function is Blocks to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actCustomerCategory($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_customer_category(
						category_id,
						user_id,
						category_name,
						category_type,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("category_id", "V") ? $this->getProperty("category_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_name", "V") ? "'" . $this->getProperty("category_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_type", "V") ? "'" . $this->getProperty("category_type") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_customer_category SET ";
				
				if($this->isPropertySet("category_name", "K")){
					$Sql .= "$con category_name='" . $this->getProperty("category_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("category_type", "K")){
					$Sql .= "$con category_type='" . $this->getProperty("category_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("category_id", "V"))
					$Sql .= " AND category_id='" . $this->getProperty("category_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_customer_category SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND category_id=" . $this->getProperty("category_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Building to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actCustomers($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_customers(
						customer_id,
						user_id,
						customer_type,
						customer_category,
						customer_name,
						customer_phone,
						customer_mobile,
						customer_email,
						location_id,
						customer_address,
						customer_business_name,
						entery_date,
						isActive,
						c_code) 
						VALUES(";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_type", "V") ? $this->getProperty("customer_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_category", "V") ? $this->getProperty("customer_category") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_name", "V") ? "'" . $this->getProperty("customer_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_phone", "V") ? "'" . $this->getProperty("customer_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_mobile", "V") ? "'" . $this->getProperty("customer_mobile") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_email", "V") ? "'" . $this->getProperty("customer_email") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_id", "V") ? $this->getProperty("location_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_address", "V") ? "'" . $this->getProperty("customer_address") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_business_name", "V") ? "'" . $this->getProperty("customer_business_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("c_code", "V") ? "'" . $this->getProperty("c_code") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_customers SET ";
				
				if($this->isPropertySet("customer_type", "K")){
					$Sql .= "$con customer_type='" . $this->getProperty("customer_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_category", "K")){
					$Sql .= "$con customer_category='" . $this->getProperty("customer_category") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_name", "K")){
					$Sql .= "$con customer_name='" . $this->getProperty("customer_name") . "'";
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
				if($this->isPropertySet("customer_email", "K")){
					$Sql .= "$con customer_email='" . $this->getProperty("customer_email") . "'";
					$con = ",";
				}
				if($this->isPropertySet("location_id", "K")){
					$Sql .= "$con location_id='" . $this->getProperty("location_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_address", "K")){
					$Sql .= "$con customer_address='" . $this->getProperty("customer_address") . "'";
					$con = ",";
				}
				if($this->isPropertySet("customer_business_name", "K")){
					$Sql .= "$con customer_business_name='" . $this->getProperty("customer_business_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("customer_id", "V"))
					$Sql .= " AND customer_id='" . $this->getProperty("customer_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_customers SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND customer_id=" . $this->getProperty("customer_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Floor to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actLocation($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_location(
						location_id,
						user_id,
						location_name,
						deliver_chagres,
						unloading_charges,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("location_id", "V") ? $this->getProperty("location_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("location_name", "V") ? "'" . $this->getProperty("location_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("deliver_chagres", "V") ? "'" . $this->getProperty("deliver_chagres") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unloading_charges", "V") ? "'" . $this->getProperty("unloading_charges") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_location SET ";
				
				if($this->isPropertySet("location_name", "K")){
					$Sql .= "$con location_name='" . $this->getProperty("location_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("deliver_chagres", "K")){
					$Sql .= "$con deliver_chagres='" . $this->getProperty("deliver_chagres") . "'";
					$con = ",";
				}
				if($this->isPropertySet("unloading_charges", "K")){
					$Sql .= "$con unloading_charges='" . $this->getProperty("unloading_charges") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("location_id", "V"))
					$Sql .= " AND location_id='" . $this->getProperty("location_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_location SET 
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
	* This function is Monthly Rent to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actOrders($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_order(
						order_id,
						user_id,
						order_no,
						vechile_id,
						driver_id,
						create_date,
						order_status,
						order_remarks,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("order_id", "V") ? $this->getProperty("order_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_no", "V") ? "'" . $this->getProperty("order_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vechile_id", "V") ? $this->getProperty("vechile_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("driver_id", "V") ? $this->getProperty("driver_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("create_date", "V") ? "'" . $this->getProperty("create_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_status", "V") ? "'" . $this->getProperty("order_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_remarks", "V") ? "'" . $this->getProperty("order_remarks") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_order SET ";
				
				if($this->isPropertySet("vechile_id", "K")){
					$Sql .= "$con vechile_id='" . $this->getProperty("vechile_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("driver_id", "K")){
					$Sql .= "$con driver_id='" . $this->getProperty("driver_id") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("total_feright_cost", "K")){
					$Sql .= "$con total_feright_cost='" . $this->getProperty("total_feright_cost") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_unloading_cost", "K")){
					$Sql .= "$con total_unloading_cost='" . $this->getProperty("total_unloading_cost") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_order_cost", "K")){
					$Sql .= "$con total_order_cost='" . $this->getProperty("total_order_cost") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_order_sell_cost", "K")){
					$Sql .= "$con total_order_sell_cost='" . $this->getProperty("total_order_sell_cost") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_quantity_order", "K")){
					$Sql .= "$con total_quantity_order='" . $this->getProperty("total_quantity_order") . "'";
					$con = ",";
				}
				if($this->isPropertySet("update_date", "K")){
					$Sql .= "$con update_date='" . $this->getProperty("update_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("deliver_date", "K")){
					$Sql .= "$con deliver_date='" . $this->getProperty("deliver_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("d_invoice_no", "K")){
					$Sql .= "$con d_invoice_no='" . $this->getProperty("d_invoice_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("d_cof_number", "K")){
					$Sql .= "$con d_cof_number='" . $this->getProperty("d_cof_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("d_loading_advice_no", "K")){
					$Sql .= "$con d_loading_advice_no='" . $this->getProperty("d_loading_advice_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("order_status", "K")){
					$Sql .= "$con order_status='" . $this->getProperty("order_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("order_remarks", "K")){
					$Sql .= "$con order_remarks='" . $this->getProperty("order_remarks") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("purchase_trans_id", "K")){
					$Sql .= "$con purchase_trans_id=" . $this->getProperty("purchase_trans_id");
					$con = ",";
				}
				if($this->isPropertySet("vehicle_trans_id", "K")){
					$Sql .= "$con vehicle_trans_id=" . $this->getProperty("vehicle_trans_id");
					$con = ",";
				}
				if($this->isPropertySet("unloader_trans_id", "K")){
					$Sql .= "$con unloader_trans_id=" . $this->getProperty("unloader_trans_id");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_order SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND order_id=" . $this->getProperty("order_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Monthly Rent Amount to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actOrderDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_order_detail(
						order_detail_id,
						order_id,
						user_id,
						request_order_id,
						customer_id,
						product_id,
						product_price_id,
						vendor_id,
						purchase_price,
						selling_price,
						freight_price,
						unloading_price,
						order_qty,
						order_status,
						transaction_no,
						created_date,
						update_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("order_detail_id", "V") ? $this->getProperty("order_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_id", "V") ? $this->getProperty("order_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_order_id", "V") ? $this->getProperty("request_order_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? "'" . $this->getProperty("customer_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_id", "V") ? "'" . $this->getProperty("product_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_price_id", "V") ? "'" . $this->getProperty("product_price_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vendor_id", "V") ? "'" . $this->getProperty("vendor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("purchase_price", "V") ? "'" . $this->getProperty("purchase_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("selling_price", "V") ? "'" . $this->getProperty("selling_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("freight_price", "V") ? "'" . $this->getProperty("freight_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unloading_price", "V") ? "'" . $this->getProperty("unloading_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_qty", "V") ? "'" . $this->getProperty("order_qty") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_status", "V") ? "'" . $this->getProperty("order_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transaction_no", "V") ? "'" . $this->getProperty("transaction_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("created_date", "V") ? "'" . $this->getProperty("created_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("update_date", "V") ? "'" . $this->getProperty("update_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : 1;
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_order_detail SET ";
				
				if($this->isPropertySet("order_status", "K")){
					$Sql .= "$con order_status='" . $this->getProperty("order_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transaction_no", "K")){
					$Sql .= "$con transaction_no='" . $this->getProperty("transaction_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("update_date", "K")){
					$Sql .= "$con update_date='" . $this->getProperty("update_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("order_detail_id", "V")){
					$Sql .= " AND order_detail_id='" . $this->getProperty("order_detail_id") . "'";
				}
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_order_detail SET 
							isActive=3
						WHERE
							1=1";
							
				if($this->isPropertySet("order_detail_id", "V")){
					$Sql .= " AND order_detail_id='" . $this->getProperty("order_detail_id") . "'";
				}
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Monthly Rent Amount to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actOrderTransactionDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_order_transaction_detail(
						order_tran_id,
						user_id,
						order_id,
						transaction_id,
						id_type,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("order_tran_id", "V") ? $this->getProperty("order_tran_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_id", "V") ? $this->getProperty("order_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transaction_id", "V") ? $this->getProperty("transaction_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("id_type", "V") ? $this->getProperty("id_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_order_transaction_detail SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transaction_id", "K")){
					$Sql .= "$con transaction_id='" . $this->getProperty("transaction_id") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("order_tran_id", "V")){
					$Sql .= " AND order_tran_id='" . $this->getProperty("order_tran_id") . "'";
				}
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				if($this->isPropertySet("id_type", "V")){
					$Sql .= " AND id_type='" . $this->getProperty("id_type") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_order_transaction_detail SET 
							isActive=3
						WHERE
							1=1";
							
				if($this->isPropertySet("order_tran_id", "V")){
					$Sql .= " AND order_tran_id='" . $this->getProperty("order_tran_id") . "'";
				}
				
				if($this->isPropertySet("order_id", "V")){
					$Sql .= " AND order_id='" . $this->getProperty("order_id") . "'";
				}
				
				if($this->isPropertySet("id_type", "V")){
					$Sql .= " AND id_type='" . $this->getProperty("id_type") . "'";
				}
				
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is Property to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actOrderRequestDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_order_request_detail(
						order_request_id,
						user_id,
						customer_id,
						product_id,
						product_price_id,
						destination_id,
						vendor_id,
						purchase_id,
						unloading_price,
						delivery_chagres,
						no_of_items,
						per_item_amount,
						final_amount,
						vehicle_id,
						delivery_required_date,
						order_process_status,
						replace_order_status,
						order_delivery_status,
						request_order_no,
						order_request_type,
						entery_date,
						isActive,
						cof_no,
						d_invoice_no,
						d_date,
						order_status,
						remaining_item,
						tran_code,
						extra_note) 
						VALUES(";
				$Sql .= $this->isPropertySet("order_request_id", "V") ? $this->getProperty("order_request_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("customer_id", "V") ? $this->getProperty("customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_id", "V") ? $this->getProperty("product_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_price_id", "V") ? $this->getProperty("product_price_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("destination_id", "V") ? "'" . $this->getProperty("destination_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vendor_id", "V") ? "'" . $this->getProperty("vendor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("purchase_id", "V") ? "'" . $this->getProperty("purchase_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unloading_price", "V") ? "'" . $this->getProperty("unloading_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("delivery_chagres", "V") ? "'" . $this->getProperty("delivery_chagres") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_items", "V") ? "'" . $this->getProperty("no_of_items") . "'" : "NULL";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("per_item_amount", "V") ? "'" . $this->getProperty("per_item_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("final_amount", "V") ? "'" . $this->getProperty("final_amount") . "'" : "NULL";
				$Sql .= ",";
				
				
				$Sql .= $this->isPropertySet("vehicle_id", "V") ? "'" . $this->getProperty("vehicle_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("delivery_required_date", "V") ? "'" . $this->getProperty("delivery_required_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_process_status", "V") ? "'" . $this->getProperty("order_process_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("replace_order_status", "V") ? "'" . $this->getProperty("replace_order_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_delivery_status", "V") ? "'" . $this->getProperty("order_delivery_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_order_no", "V") ? "'" . $this->getProperty("request_order_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_request_type", "V") ? "'" . $this->getProperty("order_request_type") . "'" : 1;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cof_no", "V") ? "'" . $this->getProperty("cof_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("d_invoice_no", "V") ? "'" . $this->getProperty("d_invoice_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("d_date", "V") ? "'" . $this->getProperty("d_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_status", "V") ? $this->getProperty("order_status") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("remaining_item", "V") ? "'" . $this->getProperty("remaining_item") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tran_code", "V") ? "'" . $this->getProperty("tran_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_note", "V") ? "'" . $this->getProperty("extra_note") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_order_request_detail SET ";
				
				if($this->isPropertySet("unloading_price", "K")){
					$Sql .= "$con unloading_price='" . $this->getProperty("unloading_price") . "'";
					$con = ",";
				}
				if($this->isPropertySet("delivery_chagres", "K")){
					$Sql .= "$con delivery_chagres='" . $this->getProperty("delivery_chagres") . "'";
					$con = ",";
				}
				if($this->isPropertySet("delivery_required_date", "K")){
					$Sql .= "$con delivery_required_date='" . $this->getProperty("delivery_required_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("per_item_amount", "K")){
					$Sql .= "$con per_item_amount='" . $this->getProperty("per_item_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("final_amount", "K")){
					$Sql .= "$con final_amount='" . $this->getProperty("final_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("no_of_items", "K")){
					$Sql .= "$con no_of_items='" . $this->getProperty("no_of_items") . "'";
					$con = ",";
				}
				if($this->isPropertySet("d_date", "K")){
					$Sql .= "$con d_date='" . $this->getProperty("d_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("order_process_status", "K")){
					$Sql .= "$con order_process_status='" . $this->getProperty("order_process_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("replace_order_status", "K")){
					$Sql .= "$con replace_order_status='" . $this->getProperty("replace_order_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("replace_order_id", "K")){
					$Sql .= "$con replace_order_id='" . $this->getProperty("replace_order_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("order_delivery_status", "K")){
					$Sql .= "$con order_delivery_status='" . $this->getProperty("order_delivery_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transaction_no", "K")){
					$Sql .= "$con transaction_no='" . $this->getProperty("transaction_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("order_status", "K")){
					$Sql .= "$con order_status='" . $this->getProperty("order_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("remaining_item", "K")){
					$Sql .= "$con remaining_item='" . $this->getProperty("remaining_item") . "'";
					$con = ",";
				}
				if($this->isPropertySet("update_remaining_qty", "K")){
					$Sql .= "$con remaining_item = remaining_item - " . $this->getProperty("update_remaining_qty");
					$con = ",";
				}
				
				if($this->isPropertySet("cof_no", "K")){
					$Sql .= "$con cof_no='" . $this->getProperty("cof_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("d_invoice_no", "K")){
					$Sql .= "$con d_invoice_no='" . $this->getProperty("d_invoice_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("destination_id", "K")){
					$Sql .= "$con destination_id='" . $this->getProperty("destination_id") . "'";
					$con = ",";
				}
				
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("order_request_id", "V")){
					$Sql .= " AND order_request_id='" . $this->getProperty("order_request_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_order_request_detail SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND order_request_id=" . $this->getProperty("order_request_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}

	/**
	* This function is Property to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actCustomerContraOrderDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_customer_contra_order_detail(
						cc_order_request_id,
						user_id,
						from_customer_id,
						to_customer_id,
						product_id,
						product_price_id,
						destination_id,
						vendor_id,
						unloading_price,
						delivery_chagres,
						no_of_items,
						per_item_amount,
						to_per_item_amount,
						final_amount,
						to_final_amount,
						vehicle_id,
						delivery_required_date,
						order_process_status,
						replace_order_status,
						order_delivery_status,
						request_order_no,
						order_request_type,
						entery_date,
						isActive,
						cof_no,
						d_invoice_no,
						d_date,
						order_status,
						tran_code) 
						VALUES(";
				$Sql .= $this->isPropertySet("cc_order_request_id", "V") ? $this->getProperty("cc_order_request_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("from_customer_id", "V") ? $this->getProperty("from_customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("to_customer_id", "V") ? $this->getProperty("to_customer_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_id", "V") ? $this->getProperty("product_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_price_id", "V") ? $this->getProperty("product_price_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("destination_id", "V") ? "'" . $this->getProperty("destination_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vendor_id", "V") ? "'" . $this->getProperty("vendor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unloading_price", "V") ? "'" . $this->getProperty("unloading_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("delivery_chagres", "V") ? "'" . $this->getProperty("delivery_chagres") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_items", "V") ? "'" . $this->getProperty("no_of_items") . "'" : "NULL";
				$Sql .= ",";
				
				$Sql .= $this->isPropertySet("per_item_amount", "V") ? "'" . $this->getProperty("per_item_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("to_per_item_amount", "V") ? "'" . $this->getProperty("to_per_item_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("final_amount", "V") ? "'" . $this->getProperty("final_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("to_final_amount", "V") ? "'" . $this->getProperty("to_final_amount") . "'" : "NULL";
				$Sql .= ",";				
				
				$Sql .= $this->isPropertySet("vehicle_id", "V") ? "'" . $this->getProperty("vehicle_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("delivery_required_date", "V") ? "'" . $this->getProperty("delivery_required_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_process_status", "V") ? "'" . $this->getProperty("order_process_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("replace_order_status", "V") ? "'" . $this->getProperty("replace_order_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_delivery_status", "V") ? "'" . $this->getProperty("order_delivery_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_order_no", "V") ? "'" . $this->getProperty("request_order_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_request_type", "V") ? "'" . $this->getProperty("order_request_type") . "'" : 1;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				
				$Sql .= ",";
				$Sql .= $this->isPropertySet("cof_no", "V") ? "'" . $this->getProperty("cof_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("d_invoice_no", "V") ? "'" . $this->getProperty("d_invoice_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("d_date", "V") ? "'" . $this->getProperty("d_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_status", "V") ? $this->getProperty("order_status") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tran_code", "V") ? $this->getProperty("tran_code") : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_customer_contra_order_detail SET ";
				
				if($this->isPropertySet("unloading_price", "K")){
					$Sql .= "$con unloading_price='" . $this->getProperty("unloading_price") . "'";
					$con = ",";
				}
				if($this->isPropertySet("delivery_chagres", "K")){
					$Sql .= "$con delivery_chagres='" . $this->getProperty("delivery_chagres") . "'";
					$con = ",";
				}
				if($this->isPropertySet("delivery_required_date", "K")){
					$Sql .= "$con delivery_required_date='" . $this->getProperty("delivery_required_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("no_of_items", "K")){
					$Sql .= "$con no_of_items='" . $this->getProperty("no_of_items") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("order_process_status", "K")){
					$Sql .= "$con order_process_status='" . $this->getProperty("order_process_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("replace_order_status", "K")){
					$Sql .= "$con replace_order_status='" . $this->getProperty("replace_order_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("replace_order_id", "K")){
					$Sql .= "$con replace_order_id='" . $this->getProperty("replace_order_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("order_delivery_status", "K")){
					$Sql .= "$con order_delivery_status='" . $this->getProperty("order_delivery_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transaction_no", "K")){
					$Sql .= "$con transaction_no='" . $this->getProperty("transaction_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("order_status", "K")){
					$Sql .= "$con order_status='" . $this->getProperty("order_status") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("cc_order_request_id", "V")){
					$Sql .= " AND cc_order_request_id='" . $this->getProperty("cc_order_request_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_customer_contra_order_detail SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND cc_order_request_id=" . $this->getProperty("cc_order_request_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	
	/**
	* This function is Tenant Assign Property to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actProductPrice($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_product_price(
						product_price_id,
						user_id,
						product_id,
						buy_price,
						selling_price,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("product_price_id", "V") ? $this->getProperty("product_price_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_id", "V") ? $this->getProperty("product_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("buy_price", "V") ? "'" . $this->getProperty("buy_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("selling_price", "V") ? "'" . $this->getProperty("selling_price") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_product_price SET ";
				
				if($this->isPropertySet("buy_price", "K")){
					$Sql .= "$con buy_price='" . $this->getProperty("buy_price") . "'";
					$con = ",";
				}
				if($this->isPropertySet("selling_price", "K")){
					$Sql .= "$con selling_price='" . $this->getProperty("selling_price") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("product_price_id", "V")){
					$Sql .= " AND product_price_id='" . $this->getProperty("product_price_id") . "'";
				}
				
				if($this->isPropertySet("product_id", "V")){
					$Sql .= " AND product_id='" . $this->getProperty("product_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_product_price SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND product_price_id=" . $this->getProperty("product_price_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Tenant Information to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actProducts($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_products(
						product_id,
						user_id,
						product_name,
						product_size,
						vendor_id,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("product_id", "V") ? $this->getProperty("product_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_name", "V") ? "'" . $this->getProperty("product_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("product_size", "V") ? "'" . $this->getProperty("product_size") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vendor_id", "V") ? "'" . $this->getProperty("vendor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_products SET ";
				
				if($this->isPropertySet("product_name", "K")){
					$Sql .= "$con product_name='" . $this->getProperty("product_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("product_size", "K")){
					$Sql .= "$con product_size='" . $this->getProperty("product_size") . "'";
					$con = ",";
				}
				if($this->isPropertySet("vendor_id", "K")){
					$Sql .= "$con vendor_id='" . $this->getProperty("vendor_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("product_id", "V")){
					$Sql .= " AND product_id='" . $this->getProperty("product_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_products SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND product_id=" . $this->getProperty("product_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Assign to employee to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actVehicle($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_vehicle(
						vehicle_id,
						user_id,
						vehicle_number,
						vehicle_name,
						vehicle_source,
						vehicle_type_id,
						loading_capacity,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("vehicle_id", "V") ? $this->getProperty("vehicle_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_number", "V") ? "'" . $this->getProperty("vehicle_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_name", "V") ? "'" . $this->getProperty("vehicle_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_source", "V") ? $this->getProperty("vehicle_source") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_type_id", "V") ? $this->getProperty("vehicle_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("loading_capacity", "V") ? $this->getProperty("loading_capacity") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ?  $this->getProperty("isActive") : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_vehicle SET ";
				
				if($this->isPropertySet("vehicle_number", "K")){
					$Sql .= "$con vehicle_number='" . $this->getProperty("vehicle_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("vehicle_name", "K")){
					$Sql .= "$con vehicle_name='" . $this->getProperty("vehicle_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("vehicle_source", "K")){
					$Sql .= "$con vehicle_source='" . $this->getProperty("vehicle_source") . "'";
					$con = ",";
				}
				if($this->isPropertySet("vehicle_type_id", "K")){
					$Sql .= "$con vehicle_type_id='" . $this->getProperty("vehicle_type_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("loading_capacity", "K")){
					$Sql .= "$con loading_capacity='" . $this->getProperty("loading_capacity") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("vehicle_id", "V")){
					$Sql .= " AND vehicle_id='" . $this->getProperty("vehicle_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_vehicle SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND vehicle_id=" . $this->getProperty("vehicle_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Assign to employee to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actVehicleAssigned($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_vehicle_assigned(
						vehicle_assign_id,
						vehicle_id,
						driver_id,
						user_id,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("vehicle_assign_id", "V") ? $this->getProperty("vehicle_assign_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vehicle_id", "V") ? $this->getProperty("vehicle_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("driver_id", "V") ? $this->getProperty("driver_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_vehicle_assigned SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("vehicle_assign_id", "V")){
					$Sql .= " AND vehicle_assign_id='" . $this->getProperty("vehicle_assign_id") . "'";
				}
				
				break;
			case "D":
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Assign to employee to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actVehicleType($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_vehicle_type(
						vechile_type_id,
						user_id,
						type_name,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("vechile_type_id", "V") ? $this->getProperty("vechile_type_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_name", "V") ? "'" . $this->getProperty("type_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : 1;
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_vehicle_type SET ";
				
				if($this->isPropertySet("type_name", "K")){
					$Sql .= "$con type_name='" . $this->getProperty("type_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("vechile_type_id", "V")){
					$Sql .= " AND vechile_type_id='" . $this->getProperty("vechile_type_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_vehicle_type SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND vechile_type_id=" . $this->getProperty("vechile_type_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Assign to employee to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actVehicleExpSupplier($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_vehicle_exp_supplier(
						vehicle_exp_id,
						user_id,
						exp_title,
						supplier_name,
						supplier_contact_no,
						supplier_location,
						entery_date,
						isActive,
						option_type) 
						VALUES(";
				$Sql .= $this->isPropertySet("vehicle_exp_id", "V") ? $this->getProperty("vehicle_exp_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("exp_title", "V") ? "'" . $this->getProperty("exp_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("supplier_name", "V") ? "'" . $this->getProperty("supplier_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("supplier_contact_no", "V") ? "'" . $this->getProperty("supplier_contact_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("supplier_location", "V") ? "'" . $this->getProperty("supplier_location") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : 1;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("option_type", "V") ? $this->getProperty("option_type") : 1;
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_vehicle_exp_supplier SET ";
				
				if($this->isPropertySet("diesel_title", "K")){
					$Sql .= "$con diesel_title='" . $this->getProperty("diesel_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("exp_title", "K")){
					$Sql .= "$con exp_title='" . $this->getProperty("exp_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("supplier_contact_no", "K")){
					$Sql .= "$con supplier_contact_no='" . $this->getProperty("supplier_contact_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("supplier_location", "K")){
					$Sql .= "$con supplier_location='" . $this->getProperty("supplier_location") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("vehicle_exp_id", "V")){
					$Sql .= " AND vehicle_exp_id='" . $this->getProperty("vehicle_exp_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_vehicle_exp_supplier SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND vehicle_exp_id=" . $this->getProperty("vehicle_exp_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is Assign to employee to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actVehicleExpSupplierTrans($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_jt_vehicle_exp_supplier_trans(
						vendor_exp_detail_id,
						vendor_exp_id,
						user_id,
						option_type,
						order_request_id,
						exp_detail,
						exp_amount,
						exp_date,
						entery_date,
						isActive,
						quantity_detail,
						tran_code) 
						VALUES(";
				$Sql .= $this->isPropertySet("vendor_exp_detail_id", "V") ? $this->getProperty("vendor_exp_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vendor_exp_id", "V") ? $this->getProperty("vendor_exp_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("option_type", "V") ? $this->getProperty("option_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_request_id", "V") ? $this->getProperty("order_request_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("exp_detail", "V") ? "'" . $this->getProperty("exp_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("exp_amount", "V") ? "'" . $this->getProperty("exp_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("exp_date", "V") ? "'" . $this->getProperty("exp_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : 1;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("quantity_detail", "V") ? "'" . $this->getProperty("quantity_detail") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tran_code", "V") ? "'" . $this->getProperty("tran_code") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_jt_vehicle_exp_supplier_trans SET ";
				
				if($this->isPropertySet("exp_detail", "K")){
					$Sql .= "$con exp_detail='" . $this->getProperty("exp_detail") . "'";
					$con = ",";
				}
				if($this->isPropertySet("exp_amount", "K")){
					$Sql .= "$con exp_amount='" . $this->getProperty("exp_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("exp_date", "K")){
					$Sql .= "$con exp_date='" . $this->getProperty("exp_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("quantity_detail", "K")){
					$Sql .= "$con quantity_detail='" . $this->getProperty("quantity_detail") . "'";
					$con = ",";
				}

				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("vendor_exp_detail_id", "V")){
					$Sql .= " AND vendor_exp_detail_id='" . $this->getProperty("vendor_exp_detail_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_jt_vehicle_exp_supplier_trans SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND vendor_exp_detail_id=" . $this->getProperty("vendor_exp_detail_id");
				break;
			default:
				break;
		}
		
		return $this->dbQuery($Sql);
	}

	/**
	* This function is Assign to employee to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actOrderCenterArea($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_order_center(
						order_type,
						order_code,
						order_id,
						purchase_id,
						order_tran_id,
						unloader_option,
						unloader_tran_id,
						vechile_tran_id,
						transferamount_opt,
						trans_id_vehicle_second,
						trans_id_vehicle_one) 
						VALUES(";
				$Sql .= $this->isPropertySet("order_type", "V") ? $this->getProperty("order_type") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_code", "V") ? "'". $this->getProperty("order_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_id", "V") ? $this->getProperty("order_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("purchase_id", "V") ? $this->getProperty("purchase_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("order_tran_id", "V") ? $this->getProperty("order_tran_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unloader_option", "V") ? "'" . $this->getProperty("unloader_option") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("unloader_tran_id", "V") ? "'" . $this->getProperty("unloader_tran_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("vechile_tran_id", "V") ? "'" . $this->getProperty("vechile_tran_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("transferamount_opt", "V") ? "'" . $this->getProperty("transferamount_opt") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("trans_id_vehicle_second", "V") ? $this->getProperty("trans_id_vehicle_second") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("trans_id_vehicle_one", "V") ? "'" . $this->getProperty("trans_id_vehicle_one") . "'" : "NULL";
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