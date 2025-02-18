<?php
/**
*
* This is a class SSSinventory
* @version 0.01
* @author Numan Tahir <numan_tahir1@yahoo.com>
*
**/
class SSSinventory extends Database{
	public $property_id;
	public $block_id;
	public $building_id;
	public $floor_id;
	public $user_id;
	public $property_type;
	public $property_number;

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
	* This method is used to the Projects combo
	* @author Numan Tahir
	*/
	public function ComplainCategoryCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					complain_category_id,
					category_title
				FROM
					rs_tbl_inv_complain_category
				WHERE
					1=1 
					AND isActive=1 ORDER BY category_title";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['complain_category_id'] == $sel)
				$opt .= "<option value=\"" . $rows['complain_category_id'] . "\" selected>" . $rows['category_title'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['complain_category_id'] . "\">" . $rows['category_title'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Projects combo
	* @author Numan Tahir
	*/
	public function BlockCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT 
					block_id,
					block_name
				FROM
					rs_tbl_inv_block
				WHERE
					1=1 
					AND isActive=1 ORDER BY block_name";
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['block_id'] == $sel)
				$opt .= "<option value=\"" . $rows['block_id'] . "\" selected>" . $rows['block_name'] . "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['block_id'] . "\">" . $rows['block_name'] . "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Projects combo
	* @author Numan Tahir
	*/
	public function BlockBuildingCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					rs_tbl_inv_block.block_name
					, rs_tbl_inv_building.building_no
					, rs_tbl_inv_block.block_id
					, rs_tbl_inv_building.building_id
				FROM
						rs_tbl_inv_block
					INNER JOIN rs_tbl_inv_building 
						ON (rs_tbl_inv_block.block_id = rs_tbl_inv_building.block_id) AND rs_tbl_inv_building.isActive=1";
						
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['building_id'] == $sel)
				$opt .= "<option value=\"" . $rows['block_id'].'-'.$rows['building_id'] . "\" selected>" . $rows['building_no'] .' ('.$rows['block_name'].')'. "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['block_id'].'-'.$rows['building_id'] . "\">" . $rows['building_no'] .' ('.$rows['block_name'].')'. "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Projects combo
	* @author Numan Tahir
	*/
	public function FloorBuildingBlockCombo($sel = ""){
		$opt = "";
		$Sql = "SELECT
					rs_tbl_inv_floor.floor_id
					, rs_tbl_inv_floor.block_id
					, rs_tbl_inv_floor.building_id
					, rs_tbl_inv_floor.floor_name
					, rs_tbl_inv_building.building_no
					, rs_tbl_inv_block.block_name
				FROM
					rs_tbl_inv_floor
					INNER JOIN rs_tbl_inv_building 
						ON (rs_tbl_inv_floor.building_id = rs_tbl_inv_building.building_id)
					INNER JOIN rs_tbl_inv_block 
						ON (rs_tbl_inv_floor.block_id = rs_tbl_inv_block.block_id) AND rs_tbl_inv_floor.isActive=1 ORDER BY block_name, building_no, floor_name";
						
		$this->dbQuery($Sql);
		while($rows = $this->dbFetchArray(1)){
			if($rows['floor_id'] == $sel)
				$opt .= "<option value=\"" . $rows['floor_id'].'-'.$rows['building_id'].'-'.$rows['block_id'] . "\" selected>" . $rows['block_name'] . '-'.$rows['building_no'] .'-'.$rows['floor_name']. "</option>\n";
			else
				$opt .= "<option value=\"" . $rows['floor_id'].'-'.$rows['building_id'].'-'.$rows['block_id'] . "\">" . $rows['block_name'] . '-'.$rows['building_no'] .'-'.$rows['floor_name']. "</option>\n";
		}
		return $opt;
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetTenantFullName($tenant_id){
		$Sql = "SELECT 
					tenant_id,
					tenant_name
				FROM
					rs_tbl_inv_tenant_info
				WHERE
					1=1 
					 AND tenant_id='".$tenant_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['tenant_name'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetTenantShopName($tenant_id){
		$Sql = "SELECT 
					tenant_shop_name
				FROM
					rs_tbl_inv_tenant_info
				WHERE
					1=1 
					 AND tenant_id='".$tenant_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['tenant_shop_name'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetPropertyCode($Property_id){
		$Sql = "SELECT 
					property_code
				FROM
					rs_tbl_inv_property
				WHERE
					1=1 
					 AND property_id='".$Property_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['property_code'];
	}
	
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetBlockName($id){
		$Sql = "SELECT 
					block_name
				FROM
					rs_tbl_inv_block
				WHERE
					1=1 
					 AND block_id='".$id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['block_name'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetBuildingNumber($id){
		$Sql = "SELECT 
					building_no
				FROM
					rs_tbl_inv_building
				WHERE
					1=1 
					 AND building_id='".$id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['building_no'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetFloorName($id){
		$Sql = "SELECT 
					floor_name
				FROM
					rs_tbl_inv_floor
				WHERE
					1=1 
					 AND floor_id='".$id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['floor_name'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetEmployeeID($property_id){
		$Sql = "SELECT 
					employee_id
				FROM
					rs_tbl_inv_assign_to_employee
				WHERE
					1=1 
					 AND property_id='".$property_id."'";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['employee_id'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetTotalUnitCounter($id){
		$Sql = "SELECT 
					count(block_id) as count_block_id
				FROM
					rs_tbl_inv_property
				WHERE
					1=1 
					 AND block_id='".$id."' GROUP BY block_id";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['count_block_id'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetTenantUnitCounter($id){
		$Sql = "SELECT 
					count(property_id) as count_property_id
				FROM
					rs_tbl_inv_tenant_assign_property
				WHERE
					1=1 
					 AND tenant_id='".$id."' AND tenant_status=1 AND isActive=1";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['count_property_id'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetTotalOcpdUnitCounter($id){
		$Sql = "SELECT 
					count(block_id) as count_block_id
				FROM
					rs_tbl_inv_property
				WHERE
					1=1 
					 AND block_id='".$id."' AND tenant_status=1 GROUP BY block_id";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['count_block_id'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetTotalVcntUnitCounter($id){
		$Sql = "SELECT 
					count(block_id) as count_block_id
				FROM
					rs_tbl_inv_property
				WHERE
					1=1 
					 AND block_id='".$id."' AND tenant_status=2 GROUP BY block_id";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['count_block_id'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetBillNo($id){
		$Sql = "SELECT 
					bill_no
				FROM
					rs_tbl_inv_monthly_rent
				WHERE
					1=1 
					 AND monthly_rent_id='".$id."' AND isAcitve=1";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['bill_no'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetGeneratedMonthId($id){
		$Sql = "SELECT 
					generate_bill_id
				FROM
					rs_tbl_inv_monthly_rent
				WHERE
					1=1 
					 AND monthly_rent_id='".$id."' AND isAcitve=1";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['generate_bill_id'];
	}
	
	/**
	* This method is used to the Get User fullname
	* @author Numan Tahir
	*/
	public function GetComplainCategoryTitle($id){
		$Sql = "SELECT 
					category_title
				FROM
					rs_tbl_inv_complain_category
				WHERE
					1=1 
					 AND complain_category_id='".$id."' AND isActive=1";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['category_title'];
	}
	
	//
	
	/**
	* This function is used to list the Properties Expected Revenue
	* @author Numan Tahir
	*/
	public function lstExpectedRevenue(){
		$Sql = "SELECT 
					SUM(monthly_maint) as expected_incom
				FROM
					rs_tbl_inv_property
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("building_id", "V"))
			$Sql .= " AND building_id=" . $this->getProperty("building_id");
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND floor_id=" . $this->getProperty("floor_id");
			
		if($this->isPropertySet("property_type", "V"))
			$Sql .= " AND property_type=" . $this->getProperty("property_type");
		
		if($this->isPropertySet("property_number", "V"))
			$Sql .= " AND property_number='" . $this->getProperty("property_number") . "'";
		
		if($this->isPropertySet("property_code", "V"))
			$Sql .= " AND property_code='" . $this->getProperty("property_code") . "'";
		
		if($this->isPropertySet("tenant_status", "V"))
			$Sql .= " AND tenant_status=" . $this->getProperty("tenant_status");
					
		if($this->isPropertySet("service_required", "V"))
			$Sql .= " AND service_required=" . $this->getProperty("service_required");
		
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
	public function SumBillAmount(){
		$Sql = "SELECT
					sum(total_rent_amount) as total_sum_amount
				FROM
					rs_tbl_inv_monthly_rent
				WHERE
					1=1";
		
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
		
		if($this->isPropertySet("generate_bill_id", "V"))
			$Sql .= " AND generate_bill_id=" . $this->getProperty("generate_bill_id");
			
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("rent_of_month", "V"))
			$Sql .= " AND rent_of_month=" . $this->getProperty("rent_of_month");
		
		if($this->isPropertySet("installment_status", "V"))
			$Sql .= " AND installment_status=" . $this->getProperty("installment_status");
		
		if($this->isPropertySet("installment_id", "V"))
			$Sql .= " AND installment_id=" . $this->getProperty("installment_id");
		
		if($this->isPropertySet("installment_list_id", "V"))
			$Sql .= " AND installment_list_id=" . $this->getProperty("installment_list_id");
		
		if($this->isPropertySet("extra_amount_status", "V"))
			$Sql .= " AND extra_amount_status=" . $this->getProperty("extra_amount_status");
		
		if($this->isPropertySet("extra_amount_id", "V"))
			$Sql .= " AND extra_amount_id=" . $this->getProperty("extra_amount_id");
						
		if($this->isPropertySet("rent_year", "V"))
			$Sql .= " AND rent_year=" . $this->getProperty("rent_year");
				
		if($this->isPropertySet("rent_status", "V"))
			$Sql .= " AND rent_status=" . $this->getProperty("rent_status");
			
		if($this->isPropertySet("due_date", "V"))
			$Sql .= " AND due_date='" . $this->getProperty("due_date") . "'";
		
		if($this->isPropertySet("bill_no", "V"))
			$Sql .= " AND bill_no='" . $this->getProperty("bill_no") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isAcitve", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isAcitve") . "'";
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isAcitve!=" . $this->getProperty("isNot");
			
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
	public function GetBatchSum($id){
		$Sql = "SELECT 
					sum(received_amount) as received_amount
				FROM
					rs_tbl_inv_batch_detail
				WHERE
					1=1 
					 AND batch_id='".$id."' AND isActive=1";
		$this->dbQuery($Sql);
			$rows = $this->dbFetchArray(1);
		return $rows['received_amount'];
	}
	
	/**
	* This function is used to list the Block
	* @author Numan Tahir
	*/
	public function ReceivedSumBillAmount(){
		$Sql = "SELECT
					sum(received_amount) as total_sum_amount
				FROM
					rs_tbl_inv_monthly_rent
				WHERE
					1=1";
		
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
		
		if($this->isPropertySet("generate_bill_id", "V"))
			$Sql .= " AND generate_bill_id=" . $this->getProperty("generate_bill_id");
			
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("rent_of_month", "V"))
			$Sql .= " AND rent_of_month=" . $this->getProperty("rent_of_month");
		
		if($this->isPropertySet("installment_status", "V"))
			$Sql .= " AND installment_status=" . $this->getProperty("installment_status");
		
		if($this->isPropertySet("installment_id", "V"))
			$Sql .= " AND installment_id=" . $this->getProperty("installment_id");
		
		if($this->isPropertySet("installment_list_id", "V"))
			$Sql .= " AND installment_list_id=" . $this->getProperty("installment_list_id");
		
		if($this->isPropertySet("extra_amount_status", "V"))
			$Sql .= " AND extra_amount_status=" . $this->getProperty("extra_amount_status");
		
		if($this->isPropertySet("extra_amount_id", "V"))
			$Sql .= " AND extra_amount_id=" . $this->getProperty("extra_amount_id");
						
		if($this->isPropertySet("rent_year", "V"))
			$Sql .= " AND rent_year=" . $this->getProperty("rent_year");
				
		if($this->isPropertySet("rent_status", "V"))
			$Sql .= " AND rent_status=" . $this->getProperty("rent_status");
			
		if($this->isPropertySet("due_date", "V"))
			$Sql .= " AND due_date='" . $this->getProperty("due_date") . "'";
		
		if($this->isPropertySet("bill_no", "V"))
			$Sql .= " AND bill_no='" . $this->getProperty("bill_no") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isAcitve", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isAcitve") . "'";
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isAcitve!=" . $this->getProperty("isNot");
			
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
	public function lstBlocks(){
		$Sql = "SELECT
					block_id,
					user_id,
					block_name,
					block_assign_status,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_block
				WHERE
					1=1";
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND block_id=" . $this->getProperty("block_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("block_name", "V"))
			$Sql .= " AND block_name='" . $this->getProperty("block_name") . "'";
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("block_assign_status", "V"))
			$Sql .= " AND block_assign_status=" . $this->getProperty("block_assign_status");
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Buildings
	* @author Numan Tahir
	*/
	public function lstBuildings(){
		$Sql = "SELECT 
					building_id,
					block_id,
					user_id,
					building_no,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_building 
				WHERE 
					1=1";
		
		if($this->getProperty("building_id", "V"))
			$Sql .= " AND building_id=" . $this->getProperty("building_id");
		
		if($this->getProperty("block_id", "V"))
			$Sql .= " AND block_id=" . $this->getProperty("block_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
		if($this->isPropertySet("building_no", "V"))
			$Sql .= " AND building_no='" . $this->getProperty("building_no") . "'";	
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Floors
	* @author Numan Tahir
	*/
	public function lstFloors(){
		$Sql = "SELECT 
					floor_id,
					block_id,
					building_id,
					user_id,
					floor_name,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_floor
				WHERE 
					1=1";
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND floor_id=" . $this->getProperty("floor_id");
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("building_id", "V"))
			$Sql .= " AND building_id=" . $this->getProperty("building_id");
		
		if($this->isPropertySet("floor_name", "V"))
			$Sql .= " AND floor_name='" . $this->getProperty("floor_name") . "'";
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
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
	public function lstMonthlyRent(){
		$Sql = "SELECT 
					monthly_rent_id,
					generate_bill_id,
					tenant_id,
					within_monthly_rent,
					after_monthly_rent,
					arrears_rent,
					installment_status,
					installment_amount,
					installment_id,
					installment_list_id,
					extra_amount_status,
					extra_amount,
					extra_amount_id,
					total_rent_amount,
					received_amount,
					rent_of_month,
					rent_year,
					rent_status,
					bill_no,
					due_date,
					generate_date,
					entery_date,
					isAcitve,
					received_by
				FROM
					rs_tbl_inv_monthly_rent
				WHERE 
					1=1";
		
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
		
		if($this->isPropertySet("generate_bill_id", "V"))
			$Sql .= " AND generate_bill_id=" . $this->getProperty("generate_bill_id");
		
		if($this->isPropertySet("monthly_rent_id_IN", "V"))
			$Sql .= " AND monthly_rent_id IN(" . $this->getProperty("monthly_rent_id_IN").")";
			
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("rent_of_month", "V"))
			$Sql .= " AND rent_of_month=" . $this->getProperty("rent_of_month");
		
		if($this->isPropertySet("installment_status", "V"))
			$Sql .= " AND installment_status=" . $this->getProperty("installment_status");
		
		if($this->isPropertySet("installment_id", "V"))
			$Sql .= " AND installment_id=" . $this->getProperty("installment_id");
		
		if($this->isPropertySet("installment_list_id", "V"))
			$Sql .= " AND installment_list_id=" . $this->getProperty("installment_list_id");
		
		if($this->isPropertySet("extra_amount_status", "V"))
			$Sql .= " AND extra_amount_status=" . $this->getProperty("extra_amount_status");
		
		if($this->isPropertySet("extra_amount_id", "V"))
			$Sql .= " AND extra_amount_id=" . $this->getProperty("extra_amount_id");
						
		if($this->isPropertySet("rent_year", "V"))
			$Sql .= " AND rent_year=" . $this->getProperty("rent_year");
				
		if($this->isPropertySet("rent_status", "V"))
			$Sql .= " AND rent_status=" . $this->getProperty("rent_status");
			
		if($this->isPropertySet("due_date", "V"))
			$Sql .= " AND due_date='" . $this->getProperty("due_date") . "'";
		
		if($this->isPropertySet("bill_no", "V"))
			$Sql .= " AND bill_no='" . $this->getProperty("bill_no") . "'";
		
		if($this->isPropertySet("received_by", "V"))
			$Sql .= " AND received_by='" . $this->getProperty("received_by") . "'";
				
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isAcitve", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isAcitve") . "'";
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isAcitve!=" . $this->getProperty("isNot");
			
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
	public function lstMonthlyRentAmount(){
		$Sql = "SELECT 
					rent_amount_id,
					monthly_rent_id,
					employee_id,
					tenant_id,
					property_id,
					monthly_amount,
					after_due_date,
					arrears_amount,
					total_amount,
					received_amount,
					pending_amount,
					rent_status,
					installment_id,
					installment_amount,
					discount_amount,
					discount_status,
					rent_month,
					rent_year,
					received_date,
					pending_received_date,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_monthly_rent_amount
				WHERE 
					1=1";
		
		if($this->isPropertySet("rent_amount_id", "V"))
			$Sql .= " AND rent_amount_id=" . $this->getProperty("rent_amount_id");
		
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
		
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("installment_id", "V"))
			$Sql .= " AND installment_id=" . $this->getProperty("installment_id");
			
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
			
		if($this->isPropertySet("rent_status", "V"))
			$Sql .= " AND rent_status=" . $this->getProperty("rent_status");
		
		if($this->isPropertySet("rent_status_not", "V"))
			$Sql .= " AND rent_status!=" . $this->getProperty("rent_status_not");
			
		if($this->isPropertySet("discount_status", "V"))
			$Sql .= " AND discount_status=" . $this->getProperty("discount_status");
			
		if($this->isPropertySet("rent_month", "V"))
			$Sql .= " AND rent_month=" . $this->getProperty("rent_month");
			
		if($this->isPropertySet("rent_year", "V"))
			$Sql .= " AND rent_year=" . $this->getProperty("rent_year");
		
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
	* This function is used to list the Properties
	* @author Numan Tahir
	*/
	public function lstProperties(){
		$Sql = "SELECT 
					property_id,
					user_id,
					block_id,
					building_id,
					floor_id,
					property_type,
					property_number,
					property_code,
					monthly_maint,
					tenant_status,
					service_required,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_property
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("building_id", "V"))
			$Sql .= " AND building_id=" . $this->getProperty("building_id");
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND floor_id=" . $this->getProperty("floor_id");
			
		if($this->isPropertySet("property_type", "V"))
			$Sql .= " AND property_type=" . $this->getProperty("property_type");
		
		if($this->isPropertySet("property_number", "V"))
			$Sql .= " AND property_number='" . $this->getProperty("property_number") . "'";
		
		if($this->isPropertySet("property_code", "V"))
			$Sql .= " AND property_code='" . $this->getProperty("property_code") . "'";
		
		if($this->isPropertySet("tenant_status", "V"))
			$Sql .= " AND tenant_status=" . $this->getProperty("tenant_status");
					
		if($this->isPropertySet("service_required", "V"))
			$Sql .= " AND service_required=" . $this->getProperty("service_required");
		
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
	* This function is used to list the Assign tenant List
	* @author Numan Tahir
	*/
	public function lstAssignTenantList(){
		$Sql = "SELECT
					rs_tbl_inv_tenant_assign_property.tenant_status
					, rs_tbl_inv_tenant_assign_property.property_id
					, rs_tbl_inv_tenant_info.tenant_name
					, rs_tbl_inv_tenant_info.tenant_phone
					, rs_tbl_inv_tenant_info.tenant_shop_name
				FROM
					rs_tbl_inv_tenant_assign_property
					INNER JOIN rs_tbl_inv_tenant_info 
						ON (rs_tbl_inv_tenant_assign_property.tenant_id = rs_tbl_inv_tenant_info.tenant_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("tenant_status", "V"))
			$Sql .= " AND rs_tbl_inv_tenant_assign_property.tenant_status=" . $this->getProperty("tenant_status");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND rs_tbl_inv_tenant_assign_property.property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND rs_tbl_inv_tenant_assign_property.isActive=" . $this->getProperty("isActive");
			
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
	public function lstPropertyBundle(){
		$Sql = "SELECT
					rs_tbl_inv_property.property_id
					, rs_tbl_inv_property.property_type
					, rs_tbl_inv_property.property_number
					, rs_tbl_inv_property.property_code
					, rs_tbl_inv_property.monthly_maint
					, rs_tbl_inv_property.tenant_status
					, rs_tbl_inv_property.service_required
					, rs_tbl_inv_property.isActive
					, rs_tbl_inv_block.block_name
					, rs_tbl_inv_building.building_no
					, rs_tbl_inv_floor.floor_name
				FROM
					rs_tbl_inv_property
					INNER JOIN rs_tbl_inv_block 
						ON (rs_tbl_inv_property.block_id = rs_tbl_inv_block.block_id)
					INNER JOIN rs_tbl_inv_building 
						ON (rs_tbl_inv_property.building_id = rs_tbl_inv_building.building_id)
					INNER JOIN rs_tbl_inv_floor 
						ON (rs_tbl_inv_property.floor_id = rs_tbl_inv_floor.floor_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("building_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.building_id=" . $this->getProperty("building_id");
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.floor_id=" . $this->getProperty("floor_id");
			
		if($this->isPropertySet("property_type", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_type=" . $this->getProperty("property_type");
		
		if($this->isPropertySet("property_number", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_number='" . $this->getProperty("property_number") . "'";
		
		if($this->isPropertySet("property_code", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_code='" . $this->getProperty("property_code") . "'";
		
		if($this->isPropertySet("tenant_status", "V"))
			$Sql .= " AND rs_tbl_inv_property.tenant_status=" . $this->getProperty("tenant_status");
					
		if($this->isPropertySet("service_required", "V"))
			$Sql .= " AND rs_tbl_inv_property.service_required=" . $this->getProperty("service_required");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND rs_tbl_inv_property.isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND rs_tbl_inv_property.isActive!=" . $this->getProperty("isNot");
			
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
	public function lstOccupiedProperties(){
		$Sql = "SELECT
					rs_tbl_inv_block.block_name
					, rs_tbl_inv_building.building_no
					, rs_tbl_inv_floor.floor_name
					, rs_tbl_inv_property.property_type
					, rs_tbl_inv_property.property_number
					, rs_tbl_inv_property.property_code
					, rs_tbl_inv_property.monthly_maint
					, rs_tbl_inv_property.tenant_status
					, rs_tbl_inv_property.property_id
					, rs_tbl_inv_assign_to_employee.employee_id
				FROM
					rs_tbl_inv_assign_to_employee
					INNER JOIN rs_tbl_inv_block 
						ON (rs_tbl_inv_assign_to_employee.block_id = rs_tbl_inv_block.block_id)
					INNER JOIN rs_tbl_inv_building 
						ON (rs_tbl_inv_assign_to_employee.building_id = rs_tbl_inv_building.building_id)
					INNER JOIN rs_tbl_inv_floor 
						ON (rs_tbl_inv_assign_to_employee.floor_id = rs_tbl_inv_floor.floor_id)
					INNER JOIN rs_tbl_inv_property 
						ON (rs_tbl_inv_assign_to_employee.property_id = rs_tbl_inv_property.property_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND rs_tbl_inv_assign_to_employee.employee_id='" . $this->getProperty("employee_id") . "'";
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("building_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.building_id=" . $this->getProperty("building_id");
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.floor_id=" . $this->getProperty("floor_id");
			
		if($this->isPropertySet("property_type", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_type=" . $this->getProperty("property_type");
		
		if($this->isPropertySet("property_number", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_number='" . $this->getProperty("property_number") . "'";
		
		if($this->isPropertySet("property_code", "V"))
			$Sql .= " AND rs_tbl_inv_property.property_code='" . $this->getProperty("property_code") . "'";
		
		if($this->isPropertySet("tenant_status", "V"))
			$Sql .= " AND rs_tbl_inv_property.tenant_status=" . $this->getProperty("tenant_status");
					
		if($this->isPropertySet("service_required", "V"))
			$Sql .= " AND rs_tbl_inv_property.service_required=" . $this->getProperty("service_required");
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND rs_tbl_inv_property.isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND rs_tbl_inv_property.isActive!=" . $this->getProperty("isNot");
			
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
	public function lstTenantInformation(){
		$Sql = "SELECT 
					tenant_id,
					user_id,
					group_id,
					tenant_code,
					tenant_name,
					tenant_cnic,
					tenant_phone,
					tenant_joinin_date,
					tenant_shop_name,
					installment_status,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_tenant_info
				WHERE 
					1=1";
		
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("group_id", "V"))
			$Sql .= " AND group_id=" . $this->getProperty("group_id");
		
		if($this->isPropertySet("installment_status", "V"))
			$Sql .= " AND installment_status=" . $this->getProperty("installment_status");
			
		if($this->isPropertySet("tenant_code", "V"))
			$Sql .= " AND tenant_code='" . $this->getProperty("tenant_code") . "'";
				
		if($this->isPropertySet("tenant_cnic", "V"))
			$Sql .= " AND tenant_cnic='" . $this->getProperty("tenant_cnic") . "'";
		
		if($this->isPropertySet("tenant_phone", "V"))
			$Sql .= " AND tenant_phone='" . $this->getProperty("tenant_phone") . "'";
		
		if($this->isPropertySet("search_by_shop_name", "V"))
			$Sql .= " AND tenant_shop_name LIKE '%" . $this->getProperty("search_by_shop_name") . "%'";
		
		if($this->isPropertySet("search_by_name", "V"))
			$Sql .= " AND tenant_name LIKE '%" . $this->getProperty("search_by_name") . "%'";
			
		
		
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstTenantAssignProperty(){
		$Sql = "SELECT 
					assign_property_id,
					tenant_id,
					property_id,
					block_id,
					building_id,
					floor_id,
					user_id,
					tenant_status,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_tenant_assign_property
				WHERE 
					1=1";
		
		if($this->isPropertySet("assign_property_id", "V"))
			$Sql .= " AND assign_property_id=" . $this->getProperty("assign_property_id");
		
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("building_id", "V"))
			$Sql .= " AND building_id=" . $this->getProperty("building_id");
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND floor_id=" . $this->getProperty("floor_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("tenant_status", "V"))
			$Sql .= " AND tenant_status=" . $this->getProperty("tenant_status");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstAssignToEmployeeProperty(){
		$Sql = "SELECT 
					property_assign_id,
					user_id,
					block_id,
					building_id,
					floor_id,
					property_id,
					employee_id
				FROM
					rs_tbl_inv_assign_to_employee
				WHERE 
					1=1";
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("floor_id", "V"))
			$Sql .= " AND floor_id=" . $this->getProperty("floor_id");
		
		if($this->isPropertySet("building_id", "V"))
			$Sql .= " AND building_id=" . $this->getProperty("building_id");
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("property_assign_id", "V"))
			$Sql .= " AND property_assign_id=" . $this->getProperty("property_assign_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstGenMonthlyBill(){
		$Sql = "SELECT 
					generate_bill_id,
					user_id,
					current_month,
					current_year,
					no_of_tenant,
					generated_amount,
					due_date,
					process_status,
					entery_date,
					isAcitve
				FROM
					rs_tbl_inv_monthly_bill_generate
				WHERE 
					1=1";
		
		if($this->isPropertySet("generate_bill_id", "V"))
			$Sql .= " AND generate_bill_id=" . $this->getProperty("generate_bill_id");
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("current_month", "V"))
			$Sql .= " AND current_month=" . $this->getProperty("current_month");
		
		if($this->isPropertySet("current_year", "V"))
			$Sql .= " AND current_year=" . $this->getProperty("current_year");
		
		if($this->isPropertySet("process_status", "V"))
			$Sql .= " AND process_status=" . $this->getProperty("process_status");
		
		if($this->isPropertySet("isAcitve", "V"))
			$Sql .= " AND isAcitve=" . $this->getProperty("isAcitve");
		
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isAcitve!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Assign Tenant Group List
	* @author Numan Tahir
	*/
	public function lstAssignGroupTenantList(){
		$Sql = "SELECT
					rs_tbl_inv_property.block_id
					, rs_tbl_inv_monthly_rent_amount.monthly_rent_id
					, rs_tbl_inv_monthly_rent.generate_bill_id
				FROM
						rs_tbl_inv_monthly_rent_amount
					INNER JOIN rs_tbl_inv_property 
						ON (rs_tbl_inv_monthly_rent_amount.property_id = rs_tbl_inv_property.property_id)
					INNER JOIN rs_tbl_inv_monthly_rent 
						ON (rs_tbl_inv_monthly_rent_amount.monthly_rent_id = rs_tbl_inv_monthly_rent.monthly_rent_id) 
				WHERE 1=1 ";
		
		if($this->isPropertySet("block_id", "V"))
			$Sql .= " AND rs_tbl_inv_property.block_id=" . $this->getProperty("block_id");
		
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND rs_tbl_inv_monthly_rent_amount.monthly_rent_id=" . $this->getProperty("monthly_rent_id");
		
		if($this->isPropertySet("generate_bill_id", "V"))
			$Sql .= " AND rs_tbl_inv_monthly_rent.generate_bill_id=" . $this->getProperty("generate_bill_id");
				
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstBatchList(){
		$Sql = "SELECT 
					batch_id,
					employee_id,
					batch_code,
					no_of_bills,
					received_amount,
					batch_date,
					batch_status,
					batch_fwd_date,
					batch_fwd_rec_date,
					transaction_code
				FROM
					rs_tbl_inv_batch
				WHERE 
					1=1";
		
		if($this->isPropertySet("batch_id", "V"))
			$Sql .= " AND batch_id=" . $this->getProperty("batch_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
		
		if($this->isPropertySet("batch_code", "V"))
			$Sql .= " AND batch_code='" . $this->getProperty("batch_code") . "'";
				
		if($this->isPropertySet("batch_status", "V"))
			$Sql .= " AND batch_status=" . $this->getProperty("batch_status");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstBatchDetailList(){
		$Sql = "SELECT 
					batch_detail_id,
					batch_id,
					employee_id,
					rent_amount_id,
					monthly_rent_id,
					received_amount,
					entery_date,
					property_id,
					tenant_id,
					isActive,
					extra_note
				FROM
					rs_tbl_inv_batch_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("batch_detail_id", "V"))
			$Sql .= " AND batch_detail_id=" . $this->getProperty("batch_detail_id");
			
		if($this->isPropertySet("batch_id", "V"))
			$Sql .= " AND batch_id=" . $this->getProperty("batch_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
			
		if($this->isPropertySet("rent_amount_id", "V"))
			$Sql .= " AND rent_amount_id=" . $this->getProperty("rent_amount_id");
		
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
			
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
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
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstInstallmentPlan(){
		$Sql = "SELECT 
					tenant_installment_id,
					user_id,
					tenant_id,
					pending_amount,
					installment_amount,
					discount_apply,
					discount_type,
					discount_value,
					no_of_installment,
					installment_status,
					installment_option,
					enter_date,
					isActive
				FROM
					rs_tbl_inv_tenant_installment_plan
				WHERE 
					1=1";
		
		if($this->isPropertySet("tenant_installment_id", "V"))
			$Sql .= " AND tenant_installment_id=" . $this->getProperty("tenant_installment_id");
			
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("discount_apply", "V"))
			$Sql .= " AND discount_apply=" . $this->getProperty("discount_apply");
			
		if($this->isPropertySet("discount_type", "V"))
			$Sql .= " AND discount_type=" . $this->getProperty("discount_type");
		
		if($this->isPropertySet("installment_status", "V"))
			$Sql .= " AND installment_status=" . $this->getProperty("installment_status");
		
		if($this->isPropertySet("installment_option", "V"))
			$Sql .= " AND installment_option=" . $this->getProperty("installment_option");
				
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
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstInstallmentList(){
		$Sql = "SELECT 
					installment_list_id,
					tenant_installment_id,
					tenant_id,
					monthly_payment,
					installment_status,
					installment_option,
					bill_no,
					paid_amount,
					paid_date,
					installment_month,
					installment_year,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_tenant_installment_list
				WHERE 
					1=1";
		
		if($this->isPropertySet("installment_list_id", "V"))
			$Sql .= " AND installment_list_id=" . $this->getProperty("installment_list_id");
		
		if($this->isPropertySet("tenant_installment_id", "V"))
			$Sql .= " AND tenant_installment_id=" . $this->getProperty("tenant_installment_id");
				
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("installment_status", "V"))
			$Sql .= " AND installment_status=" . $this->getProperty("installment_status");
		
		if($this->isPropertySet("installment_option", "V"))
			$Sql .= " AND installment_option=" . $this->getProperty("installment_option");
			
		if($this->isPropertySet("bill_no", "V"))
			$Sql .= " AND bill_no='" . $this->getProperty("bill_no") . "'";
		
		if($this->isPropertySet("installment_month", "V"))
			$Sql .= " AND installment_month='" . $this->getProperty("installment_month") . "'";
			
		if($this->isPropertySet("installment_year", "V"))
			$Sql .= " AND installment_year='" . $this->getProperty("installment_year") . "'";
					
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
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstReminingList(){
		$Sql = "SELECT 
					remaining_id,
					block_id,
					building_id,
					floor_id,
					property_id,
					tenant_id,
					remaining_amount,
					per_month,
					no_of_installment
				FROM
					rs_tbl_inv_remaining_list
				WHERE 
					1=1";
				
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");

		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstTenantExtraCharges(){
		$Sql = "SELECT 
					extra_charges_id,
					user_id,
					tenant_id,
					extra_title,
					extra_charges,
					extra_type,
					type_status,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_tenant_extra_charges
				WHERE 
					1=1";
		
		if($this->isPropertySet("extra_charges_id", "V"))
			$Sql .= " AND extra_charges_id=" . $this->getProperty("extra_charges_id");
			
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
					
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("extra_type", "V"))
			$Sql .= " AND extra_type=" . $this->getProperty("extra_type");
		
		if($this->isPropertySet("type_status", "V"))
			$Sql .= " AND type_status=" . $this->getProperty("type_status");
				
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isActive!=" . $this->getProperty("isNot");
			
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function VwCollectionTeamDetail(){
		$Sql = "SELECT 
					block_id,
					building_id,
					floor_id,
					property_id,
					employee_id,
					monthly_rent_id,
					rent_status,
					total_rent_amount,
					received_amount,
					rent_of_month,
					rent_year
				FROM
					vw_collection_team_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
			
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
		
		if($this->isPropertySet("rent_status", "V"))
			$Sql .= " AND rent_status=" . $this->getProperty("rent_status");
					
		if($this->isPropertySet("rent_of_month", "V"))
			$Sql .= " AND rent_of_month='" . $this->getProperty("rent_of_month") . "'";
		
		if($this->isPropertySet("rent_year", "V"))
			$Sql .= " AND rent_year='" . $this->getProperty("rent_year") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function VwCollectionTeamAmountSum(){
		$Sql = "SELECT 
					user_id,
					isActive,
					totalamount,
					recevidamount,
					rent_of_month,
					rent_year
				FROM
					vw_collection_team_sum
				WHERE 
					1=1";
		
		if($this->isPropertySet("user_id", "V"))
			$Sql .= " AND user_id=" . $this->getProperty("user_id");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
		
		if($this->isPropertySet("rent_of_month", "V"))
			$Sql .= " AND rent_of_month='" . $this->getProperty("rent_of_month") . "'";
		
		if($this->isPropertySet("rent_year", "V"))
			$Sql .= " AND rent_year='" . $this->getProperty("rent_year") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstComplainAssign(){
		$Sql = "SELECT 
					complain_assign_id,
					user_id,
					complain_id,
					assign_to_id,
					assign_from_id,
					assign_date,
					entery_date,
					isAcitve
				FROM
						rs_tbl_inv_complain_assign
				WHERE 
					1=1";
		
		if($this->isPropertySet("complain_assign_id", "V"))
			$Sql .= " AND complain_assign_id=" . $this->getProperty("complain_assign_id");
			
		if($this->isPropertySet("complain_id", "V"))
			$Sql .= " AND complain_id=" . $this->getProperty("complain_id");
		
		if($this->isPropertySet("assign_to_id", "V"))
			$Sql .= " AND assign_to_id=" . $this->getProperty("assign_to_id");
			
		if($this->isPropertySet("assign_from_id", "V"))
			$Sql .= " AND assign_from_id=" . $this->getProperty("assign_from_id");
					
		if($this->isPropertySet("assign_date", "V"))
			$Sql .= " AND assign_date='" . $this->getProperty("assign_date") . "'";
		
		if($this->isPropertySet("isAcitve", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isAcitve") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstComplainCategory(){
		$Sql = "SELECT 
					complain_category_id,
					user_id,
					category_title,
					entery_date,
					isActive
				FROM
						rs_tbl_inv_complain_category
				WHERE 
					1=1";
		
		if($this->isPropertySet("complain_category_id", "V"))
			$Sql .= " AND complain_category_id=" . $this->getProperty("complain_category_id");
			
		if($this->isPropertySet("isAcitve", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isAcitve") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstComplain(){
		$Sql = "SELECT 
					complain_id,
					user_id,
					property_id,
					complain_number,
					category_id,
					complain_text,
					complain_reg_date,
					complain_resolved_date,
					complain_status,
					entery_date,
					isActive
				FROM
						rs_tbl_inv_complain_detail
				WHERE 
					1=1";
		
		if($this->isPropertySet("complain_id", "V"))
			$Sql .= " AND complain_id=" . $this->getProperty("complain_id");
		
		if($this->isPropertySet("property_id", "V"))
			$Sql .= " AND property_id=" . $this->getProperty("property_id");
		
		if($this->isPropertySet("category_id", "V"))
			$Sql .= " AND category_id=" . $this->getProperty("category_id");
		
		if($this->isPropertySet("complain_status", "V"))
			$Sql .= " AND complain_status=" . $this->getProperty("complain_status");
		
		if($this->isPropertySet("complain_number", "V"))
			$Sql .= " AND complain_number='" . $this->getProperty("complain_number") . "'";
					
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstComplainComment(){
		$Sql = "SELECT 
					complain_comment_id,
					complain_id,
					employee_id,
					comment_text,
					comment_picture,
					comment_date
				FROM
					rs_tbl_inv_complain_comment
				WHERE 
					1=1";
		
		if($this->isPropertySet("complain_comment_id", "V"))
			$Sql .= " AND complain_comment_id=" . $this->getProperty("complain_comment_id");
		
		if($this->isPropertySet("complain_id", "V"))
			$Sql .= " AND complain_id=" . $this->getProperty("complain_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
		
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
	public function lstMCOMonthlyRent(){
		$Sql = "SELECT
					rs_tbl_inv_monthly_rent_amount.employee_id
					, rs_tbl_inv_monthly_rent_amount.property_id
					, rs_tbl_inv_monthly_rent.monthly_rent_id
					, rs_tbl_inv_monthly_rent.generate_bill_id
					, rs_tbl_inv_monthly_rent.generate_bill_id
					, rs_tbl_inv_monthly_rent.tenant_id
					, rs_tbl_inv_monthly_rent.rent_of_month
					, rs_tbl_inv_monthly_rent.rent_year
					, rs_tbl_inv_monthly_rent.due_date
					, rs_tbl_inv_monthly_rent.within_monthly_rent
					, rs_tbl_inv_monthly_rent.arrears_rent
					, rs_tbl_inv_monthly_rent.rent_status
					, rs_tbl_inv_monthly_rent.isAcitve
					, rs_tbl_inv_monthly_rent.total_rent_amount
					, rs_tbl_inv_monthly_rent.received_amount
					, rs_tbl_inv_monthly_rent.bill_no
					, rs_tbl_inv_monthly_rent.received_by
				FROM
						rs_tbl_inv_monthly_rent
					INNER JOIN rs_tbl_inv_monthly_rent_amount 
						ON (rs_tbl_inv_monthly_rent.monthly_rent_id = rs_tbl_inv_monthly_rent_amount.monthly_rent_id)
				WHERE 
					1=1";
		
		if($this->isPropertySet("monthly_rent_id", "V"))
			$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
		
		if($this->isPropertySet("generate_bill_id", "V"))
			$Sql .= " AND generate_bill_id=" . $this->getProperty("generate_bill_id");
			
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
		
		if($this->isPropertySet("rent_of_month", "V"))
			$Sql .= " AND rent_of_month=" . $this->getProperty("rent_of_month");
		
		if($this->isPropertySet("installment_status", "V"))
			$Sql .= " AND installment_status=" . $this->getProperty("installment_status");
		
		if($this->isPropertySet("installment_id", "V"))
			$Sql .= " AND installment_id=" . $this->getProperty("installment_id");
		
		if($this->isPropertySet("installment_list_id", "V"))
			$Sql .= " AND installment_list_id=" . $this->getProperty("installment_list_id");
		
		if($this->isPropertySet("extra_amount_status", "V"))
			$Sql .= " AND extra_amount_status=" . $this->getProperty("extra_amount_status");
		
		if($this->isPropertySet("extra_amount_id", "V"))
			$Sql .= " AND extra_amount_id=" . $this->getProperty("extra_amount_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND rs_tbl_inv_monthly_rent_amount.employee_id=" . $this->getProperty("employee_id");
							
		if($this->isPropertySet("rent_year", "V"))
			$Sql .= " AND rent_year=" . $this->getProperty("rent_year");
				
		if($this->isPropertySet("rent_status", "V"))
			$Sql .= " AND rs_tbl_inv_monthly_rent.rent_status=" . $this->getProperty("rent_status");
			
		if($this->isPropertySet("due_date", "V"))
			$Sql .= " AND due_date='" . $this->getProperty("due_date") . "'";
		
		if($this->isPropertySet("bill_no", "V"))
			$Sql .= " AND bill_no='" . $this->getProperty("bill_no") . "'";
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isActive") . "'";
		
		if($this->isPropertySet("isAcitve", "V"))
			$Sql .= " AND isAcitve='" . $this->getProperty("isAcitve") . "'";
			
		if($this->isPropertySet("isNot", "V"))
			$Sql .= " AND isAcitve!=" . $this->getProperty("isNot");
		
		if($this->isPropertySet("GROUPBY", "V"))
			$Sql .= " GROUP BY " . $this->getProperty("GROUPBY");
				
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstRequestBasePropertyList(){
		$Sql = "SELECT
					rs_tbl_inv_property.block_id
					, rs_tbl_inv_property.building_id
					, rs_tbl_inv_property.floor_id
					, rs_tbl_inv_property.property_id
					, rs_tbl_inv_property.tenant_status
					, rs_tbl_inv_property.isActive
					,rs_tbl_inv_monthly_rent.tenant_id
					,rs_tbl_inv_monthly_rent.monthly_rent_id
					,rs_tbl_inv_monthly_rent.isAcitve
					,rs_tbl_inv_monthly_rent.generate_bill_id
				FROM
					rs_tbl_inv_property 
					INNER JOIN rs_tbl_inv_monthly_rent_amount
					ON (rs_tbl_inv_property.property_id = rs_tbl_inv_monthly_rent_amount.property_id)
					INNER JOIN rs_tbl_inv_monthly_rent
					ON (rs_tbl_inv_monthly_rent_amount.monthly_rent_id = rs_tbl_inv_monthly_rent.monthly_rent_id)
				
				WHERE 
					1=1";
		
		if($this->isPropertySet("complain_comment_id", "V"))
			$Sql .= " AND complain_comment_id=" . $this->getProperty("complain_comment_id");
		
		if($this->isPropertySet("complain_id", "V"))
			$Sql .= " AND complain_id=" . $this->getProperty("complain_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
		
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		
		if($this->isPropertySet("limit", "V"))
			$Sql .= $this->appendLimit($this->getProperty("limit"));
			
		return $this->dbQuery($Sql);
	}
	
	/**
	* This function is used to list the Tenant Assign properties
	* @author Numan Tahir
	*/
	public function lstBillModificationRequest(){
		$Sql = "SELECT 
					bill_modify_req_id,
					employee_id,
					monthly_bill_id,
					request_code,
					request_date,
					resolved_date,
					request_type,
					request_status,
					extra_note,
					resolved_by,
					original_bill_no,
					arrear_amount_remove,
					original_amount,
					tenant_id,
					request_extra_note,
					entery_date,
					isActive
				FROM
					rs_tbl_inv_bill_modification_request
				WHERE 
					1=1";
		
		if($this->isPropertySet("bill_modify_req_id", "V"))
			$Sql .= " AND bill_modify_req_id=" . $this->getProperty("bill_modify_req_id");
		
		if($this->isPropertySet("employee_id", "V"))
			$Sql .= " AND employee_id=" . $this->getProperty("employee_id");
		
		if($this->isPropertySet("monthly_bill_id", "V"))
			$Sql .= " AND monthly_bill_id=" . $this->getProperty("monthly_bill_id");
		
		if($this->isPropertySet("tenant_id", "V"))
			$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
			
		if($this->isPropertySet("request_code", "V"))
			$Sql .= " AND request_code='" . $this->getProperty("request_code") . "'";
			
		if($this->isPropertySet("request_type", "V"))
			$Sql .= " AND request_type=" . $this->getProperty("request_type");
		
		if($this->isPropertySet("request_status", "V"))
			$Sql .= " AND request_status=" . $this->getProperty("request_status");
		
		if($this->isPropertySet("request_status_not", "V"))
			$Sql .= " AND request_status!=" . $this->getProperty("request_status_not");
			
		if($this->isPropertySet("isActive", "V"))
			$Sql .= " AND isActive=" . $this->getProperty("isActive");
			
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
	public function actBlocks($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_block(
						block_id,
						user_id,
						block_name,
						block_assign_status,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("block_id", "V") ? $this->getProperty("block_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_name", "V") ? "'" . $this->getProperty("block_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_assign_status", "V") ? "'" . $this->getProperty("block_assign_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_block SET ";
				
				if($this->isPropertySet("block_name", "K")){
					$Sql .= "$con block_name='" . $this->getProperty("block_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("block_assign_status", "K")){
					$Sql .= "$con block_assign_status='" . $this->getProperty("block_assign_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("block_id", "V"))
					$Sql .= " AND block_id='" . $this->getProperty("block_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_block SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND block_id=" . $this->getProperty("block_id");
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
	public function actBuilding($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_building(
						building_id,
						block_id,
						user_id,
						building_no,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("building_id", "V") ? $this->getProperty("building_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_id", "V") ? $this->getProperty("block_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("building_no", "V") ? "'" . $this->getProperty("building_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_building SET ";
				
				if($this->isPropertySet("block_id", "K")){
					$Sql .= "$con block_id='" . $this->getProperty("block_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("building_no", "K")){
					$Sql .= "$con building_no='" . $this->getProperty("building_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("building_id", "V"))
					$Sql .= " AND building_id='" . $this->getProperty("building_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_building SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND building_id=" . $this->getProperty("building_id");
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
	public function actFloor($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_floor(
						floor_id,
						block_id,
						building_id,
						user_id,
						floor_name,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("floor_id", "V") ? $this->getProperty("floor_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_id", "V") ? $this->getProperty("block_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("building_id", "V") ? $this->getProperty("building_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("floor_name", "V") ? "'" . $this->getProperty("floor_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_floor SET ";
				
				if($this->isPropertySet("block_id", "K")){
					$Sql .= "$con block_id='" . $this->getProperty("block_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("building_id", "K")){
					$Sql .= "$con building_id='" . $this->getProperty("building_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("floor_name", "K")){
					$Sql .= "$con floor_name='" . $this->getProperty("floor_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive=" . $this->getProperty("isActive");
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("floor_id", "V"))
					$Sql .= " AND floor_id='" . $this->getProperty("floor_id") . "'";
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_floor SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND floor_id=" . $this->getProperty("floor_id");
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
	public function actMonthlyRent($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_monthly_rent(
						monthly_rent_id,
						generate_bill_id,
						tenant_id,
						within_monthly_rent,
						after_monthly_rent,
						arrears_rent,
						installment_status,
						
						extra_amount_status,
						extra_amount,
						extra_amount_id,
						
						total_rent_amount,
						installment_id,
						installment_list_id,
						received_amount,
						rent_of_month,
						rent_year,
						rent_status,
						bill_no,
						due_date,
						generate_date,
						entery_date,
						isAcitve,
						received_by) 
						VALUES(";
				$Sql .= $this->isPropertySet("monthly_rent_id", "V") ? $this->getProperty("monthly_rent_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("generate_bill_id", "V") ? $this->getProperty("generate_bill_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("within_monthly_rent", "V") ? "'" . $this->getProperty("within_monthly_rent") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("after_monthly_rent", "V") ? "'" . $this->getProperty("after_monthly_rent") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("arrears_rent", "V") ? "'" . $this->getProperty("arrears_rent") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_status", "V") ? "'" . $this->getProperty("installment_status") . "'" : 2;
				
				
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_amount_status", "V") ? "'" . $this->getProperty("extra_amount_status") . "'" : 2;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_amount", "V") ? "'" . $this->getProperty("extra_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_amount_id", "V") ? "'" . $this->getProperty("extra_amount_id") . "'" : "NULL";
				
				
				
				
				
				
				$Sql .= ",";
				$Sql .= $this->isPropertySet("total_rent_amount", "V") ? "'" . $this->getProperty("total_rent_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_id", "V") ? "'" . $this->getProperty("installment_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_list_id", "V") ? "'" . $this->getProperty("installment_list_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_amount", "V") ? "'" . $this->getProperty("received_amount") . "'" : 0;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_of_month", "V") ? "'" . $this->getProperty("rent_of_month") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_year", "V") ? "'" . $this->getProperty("rent_year") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_status", "V") ? "'" . $this->getProperty("rent_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bill_no", "V") ? "'" . $this->getProperty("bill_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("due_date", "V") ? "'" . $this->getProperty("due_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("generate_date", "V") ? "'" . $this->getProperty("generate_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isAcitve", "V") ? $this->getProperty("isAcitve") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_by", "V") ? $this->getProperty("received_by") : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_monthly_rent SET ";
				
				if($this->isPropertySet("within_monthly_rent", "K")){
					$Sql .= "$con within_monthly_rent='" . $this->getProperty("within_monthly_rent") . "'";
					$con = ",";
				}
				if($this->isPropertySet("after_monthly_rent", "K")){
					$Sql .= "$con after_monthly_rent='" . $this->getProperty("after_monthly_rent") . "'";
					$con = ",";
				}
				if($this->isPropertySet("arrears_rent", "K")){
					$Sql .= "$con arrears_rent='" . $this->getProperty("arrears_rent") . "'";
					$con = ",";
				}
				if($this->isPropertySet("received_amount", "K")){
					$Sql .= "$con received_amount='" . $this->getProperty("received_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("installment_status", "K")){
					$Sql .= "$con installment_status='" . $this->getProperty("installment_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("installment_amount", "K")){
					$Sql .= "$con installment_amount='" . $this->getProperty("installment_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("installment_id", "K")){
					$Sql .= "$con installment_id='" . $this->getProperty("installment_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("installment_list_id", "K")){
					$Sql .= "$con installment_list_id='" . $this->getProperty("installment_list_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("extra_amount_status", "K")){
					$Sql .= "$con extra_amount_status='" . $this->getProperty("extra_amount_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("extra_amount", "K")){
					$Sql .= "$con extra_amount='" . $this->getProperty("extra_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("extra_amount_id", "K")){
					$Sql .= "$con extra_amount_id='" . $this->getProperty("extra_amount_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_rent_amount", "K")){
					$Sql .= "$con total_rent_amount='" . $this->getProperty("total_rent_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("rent_status", "K")){
					$Sql .= "$con rent_status='" . $this->getProperty("rent_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isAcitve", "K")){
					$Sql .= "$con isAcitve='" . $this->getProperty("isAcitve") . "'";
					$con = ",";
				}
				if($this->isPropertySet("received_by", "K")){
					$Sql .= "$con received_by='" . $this->getProperty("received_by") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("monthly_rent_id", "V")){
					$Sql .= " AND monthly_rent_id='" . $this->getProperty("monthly_rent_id") . "'";
				}
				
					
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_monthly_rent SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
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
	public function actMonthlyRentAmount($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_monthly_rent_amount(
						rent_amount_id,
						monthly_rent_id,
						employee_id,
						tenant_id,
						property_id,
						monthly_amount,
						after_due_date,
						arrears_amount,
						total_amount,
						received_amount,
						pending_amount,
						rent_status,
						installment_id,
						installment_amount,
						discount_amount,
						discount_status,
						rent_month,
						rent_year,
						received_date,
						pending_received_date,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("rent_amount_id", "V") ? $this->getProperty("rent_amount_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_rent_id", "V") ? $this->getProperty("monthly_rent_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? $this->getProperty("employee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? "'" . $this->getProperty("property_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_amount", "V") ? "'" . $this->getProperty("monthly_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("after_due_date", "V") ? "'" . $this->getProperty("after_due_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("arrears_amount", "V") ? "'" . $this->getProperty("arrears_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("total_amount", "V") ? "'" . $this->getProperty("total_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_amount", "V") ? "'" . $this->getProperty("received_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pending_amount", "V") ? "'" . $this->getProperty("pending_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_status", "V") ? "'" . $this->getProperty("rent_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_id", "V") ? "'" . $this->getProperty("installment_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_amount", "V") ? "'" . $this->getProperty("installment_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_amount", "V") ? "'" . $this->getProperty("discount_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_status", "V") ? "'" . $this->getProperty("discount_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_month", "V") ? "'" . $this->getProperty("rent_month") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_year", "V") ? "'" . $this->getProperty("rent_year") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_date", "V") ? "'" . $this->getProperty("received_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pending_received_date", "V") ? "'" . $this->getProperty("pending_received_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_monthly_rent_amount SET ";
				
				if($this->isPropertySet("monthly_amount", "K")){
					$Sql .= "$con monthly_amount='" . $this->getProperty("monthly_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("after_due_date", "K")){
					$Sql .= "$con after_due_date='" . $this->getProperty("after_due_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("arrears_amount", "K")){
					$Sql .= "$con arrears_amount='" . $this->getProperty("arrears_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("total_amount", "K")){
					$Sql .= "$con total_amount='" . $this->getProperty("total_amount") . "'";
					$con = ",";
				}
				
				
				if($this->isPropertySet("rent_status", "K")){
					$Sql .= "$con rent_status='" . $this->getProperty("rent_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("received_date", "K")){
					$Sql .= "$con received_date='" . $this->getProperty("received_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("pending_received_date", "K")){
					$Sql .= "$con pending_received_date='" . $this->getProperty("pending_received_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("received_amount", "K")){
					$Sql .= "$con received_amount='" . $this->getProperty("received_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("pending_amount", "K")){
					$Sql .= "$con pending_amount='" . $this->getProperty("pending_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("rent_amount_id", "V")){
					$Sql .= " AND rent_amount_id='" . $this->getProperty("rent_amount_id") . "'";
				}
				if($this->isPropertySet("monthly_rent_id", "V")){
					$Sql .= " AND monthly_rent_id='" . $this->getProperty("monthly_rent_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_monthly_rent_amount SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND monthly_rent_id=" . $this->getProperty("monthly_rent_id");
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
	public function actProperty($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_property(
						property_id,
						user_id,
						block_id,
						building_id,
						floor_id,
						property_type,
						property_number,
						property_code,
						monthly_maint,
						tenant_status,
						service_required,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_id", "V") ? $this->getProperty("block_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("building_id", "V") ? $this->getProperty("building_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("floor_id", "V") ? "'" . $this->getProperty("floor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_type", "V") ? "'" . $this->getProperty("property_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_number", "V") ? "'" . $this->getProperty("property_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_code", "V") ? "'" . $this->getProperty("property_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_maint", "V") ? "'" . $this->getProperty("monthly_maint") . "'" : "2000";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_status", "V") ? "'" . $this->getProperty("tenant_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("service_required", "V") ? "'" . $this->getProperty("service_required") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_property SET ";
				
				if($this->isPropertySet("block_id", "K")){
					$Sql .= "$con block_id='" . $this->getProperty("block_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("building_id", "K")){
					$Sql .= "$con building_id='" . $this->getProperty("building_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("floor_id", "K")){
					$Sql .= "$con floor_id='" . $this->getProperty("floor_id") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_type", "K")){
					$Sql .= "$con property_type='" . $this->getProperty("property_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_number", "K")){
					$Sql .= "$con property_number='" . $this->getProperty("property_number") . "'";
					$con = ",";
				}
				if($this->isPropertySet("property_code", "K")){
					$Sql .= "$con property_code='" . $this->getProperty("property_code") . "'";
					$con = ",";
				}
				if($this->isPropertySet("monthly_maint", "K")){
					$Sql .= "$con monthly_maint='" . $this->getProperty("monthly_maint") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tenant_status", "K")){
					$Sql .= "$con tenant_status='" . $this->getProperty("tenant_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("service_required", "K")){
					$Sql .= "$con service_required='" . $this->getProperty("service_required") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("property_id", "V")){
					$Sql .= " AND property_id='" . $this->getProperty("property_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_property SET 
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
	* This function is Tenant Assign Property to perform DML (Delete/Update/Add)
	* @author Numan Tahir
	*/
	public function actTenantAssignProperty($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_tenant_assign_property(
						assign_property_id,
						tenant_id,
						property_id,
						block_id,
						building_id,
						floor_id,
						user_id,
						tenant_status,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("assign_property_id", "V") ? $this->getProperty("assign_property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_id", "V") ? $this->getProperty("block_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("building_id", "V") ? "'" . $this->getProperty("building_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("floor_id", "V") ? "'" . $this->getProperty("floor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? "'" . $this->getProperty("user_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_status", "V") ? "'" . $this->getProperty("tenant_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_tenant_assign_property SET ";
				
				if($this->isPropertySet("tenant_status", "K")){
					$Sql .= "$con tenant_status='" . $this->getProperty("tenant_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("leave_date", "K")){
					$Sql .= "$con leave_date='" . $this->getProperty("leave_date") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("assign_property_id", "V")){
					$Sql .= " AND assign_property_id='" . $this->getProperty("assign_property_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_tenant_assign_property SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND assign_property_id=" . $this->getProperty("assign_property_id");
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
	public function actTenantInformation($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_tenant_info(
						tenant_id,
						user_id,
						group_id,
						tenant_code,
						tenant_name,
						tenant_cnic,
						tenant_phone,
						tenant_joinin_date,
						tenant_shop_name,
						installment_status,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("group_id", "V") ? $this->getProperty("group_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_code", "V") ? "'" . $this->getProperty("tenant_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_name", "V") ? "'" . $this->getProperty("tenant_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_cnic", "V") ? "'" . $this->getProperty("tenant_cnic") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_phone", "V") ? "'" . $this->getProperty("tenant_phone") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_joinin_date", "V") ? "'" . $this->getProperty("tenant_joinin_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_shop_name", "V") ? "'" . $this->getProperty("tenant_shop_name") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_status", "V") ? "'" . $this->getProperty("installment_status") . "'" : 2;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_tenant_info SET ";
				
				if($this->isPropertySet("tenant_name", "K")){
					$Sql .= "$con tenant_name='" . $this->getProperty("tenant_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tenant_cnic", "K")){
					$Sql .= "$con tenant_cnic='" . $this->getProperty("tenant_cnic") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tenant_phone", "K")){
					$Sql .= "$con tenant_phone='" . $this->getProperty("tenant_phone") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tenant_joinin_date", "K")){
					$Sql .= "$con tenant_joinin_date='" . $this->getProperty("tenant_joinin_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("tenant_shop_name", "K")){
					$Sql .= "$con tenant_shop_name='" . $this->getProperty("tenant_shop_name") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("tenant_id", "V")){
					$Sql .= " AND tenant_id='" . $this->getProperty("tenant_id") . "'";
				}
				
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_tenant_info SET 
							isActive=3
						WHERE
							1=1";
				$Sql .= " AND tenant_id=" . $this->getProperty("tenant_id");
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
	public function actAssignToEmployee($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_assign_to_employee(
						property_assign_id,
						user_id,
						block_id,
						building_id,
						floor_id,
						property_id,
						employee_id) 
						VALUES(";
				$Sql .= $this->isPropertySet("property_assign_id", "V") ? $this->getProperty("property_assign_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_id", "V") ? $this->getProperty("block_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("building_id", "V") ? $this->getProperty("building_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("floor_id", "V") ? $this->getProperty("floor_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? $this->getProperty("employee_id") : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_assign_to_employee SET ";
				
				if($this->isPropertySet("employee_id", "K")){
					$Sql .= "$con employee_id='" . $this->getProperty("employee_id") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("block_id", "V")){
					$Sql .= " AND block_id='" . $this->getProperty("block_id") . "'";
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
	public function actGenMonthlyBill($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_monthly_bill_generate(
						generate_bill_id,
						user_id,
						current_month,
						current_year,
						no_of_tenant,
						generated_amount,
						process_status,
						due_date,
						entery_date,
						isAcitve) 
						VALUES(";
				$Sql .= $this->isPropertySet("generate_bill_id", "V") ? $this->getProperty("generate_bill_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_month", "V") ? $this->getProperty("current_month") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("current_year", "V") ? $this->getProperty("current_year") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_tenant", "V") ? $this->getProperty("no_of_tenant") : 0;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("generated_amount", "V") ? $this->getProperty("generated_amount") : 0;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("process_status", "V") ? $this->getProperty("process_status") : 3;
				$Sql .= ",";
				$Sql .= $this->isPropertySet("due_date", "V") ? "'" . $this->getProperty("due_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isAcitve", "V") ? $this->getProperty("isAcitve") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_monthly_bill_generate SET ";
				
				if($this->isPropertySet("no_of_tenant", "K")){
					$Sql .= "$con no_of_tenant='" . $this->getProperty("no_of_tenant") . "'";
					$con = ",";
				}
				if($this->isPropertySet("generated_amount", "K")){
					$Sql .= "$con generated_amount='" . $this->getProperty("generated_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("process_status", "K")){
					$Sql .= "$con process_status='" . $this->getProperty("process_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isAcitve", "K")){
					$Sql .= "$con isAcitve='" . $this->getProperty("isAcitve") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("generate_bill_id", "V")){
					$Sql .= " AND generate_bill_id='" . $this->getProperty("generate_bill_id") . "'";
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
	public function actBatch($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_batch(
						batch_id,
						employee_id,
						batch_code,
						no_of_bills,
						received_amount,
						batch_date,
						batch_status,
						batch_fwd_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("batch_id", "V") ? $this->getProperty("batch_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? $this->getProperty("employee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("batch_code", "V") ? "'" . $this->getProperty("batch_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_bills", "V") ? "'" . $this->getProperty("no_of_bills") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_amount", "V") ? "'" . $this->getProperty("received_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("batch_date", "V") ? "'" . $this->getProperty("batch_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("batch_status", "V") ? $this->getProperty("batch_status") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("batch_fwd_date", "V") ? "'" . $this->getProperty("batch_fwd_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_batch SET ";
				
				if($this->isPropertySet("no_of_bills", "K")){
					$Sql .= "$con no_of_bills='" . $this->getProperty("no_of_bills") . "'";
					$con = ",";
				}
				if($this->isPropertySet("received_amount", "K")){
					$Sql .= "$con received_amount='" . $this->getProperty("received_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("batch_status", "K")){
					$Sql .= "$con batch_status='" . $this->getProperty("batch_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("batch_fwd_date", "K")){
					$Sql .= "$con batch_fwd_date='" . $this->getProperty("batch_fwd_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("batch_fwd_rec_date", "K")){
					$Sql .= "$con batch_fwd_rec_date='" . $this->getProperty("batch_fwd_rec_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("transaction_code", "K")){
					$Sql .= "$con transaction_code='" . $this->getProperty("transaction_code") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("batch_id", "V")){
					$Sql .= " AND batch_id='" . $this->getProperty("batch_id") . "'";
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
	public function actBatchDetail($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_batch_detail(
						batch_detail_id,
						batch_id,
						employee_id,
						rent_amount_id,
						monthly_rent_id,
						received_amount,
						entery_date,
						property_id,
						tenant_id,
						isActive,
						extra_note) 
						VALUES(";
				$Sql .= $this->isPropertySet("batch_detail_id", "V") ? $this->getProperty("batch_detail_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("batch_id", "V") ? $this->getProperty("batch_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? $this->getProperty("employee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("rent_amount_id", "V") ? $this->getProperty("rent_amount_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_rent_id", "V") ? $this->getProperty("monthly_rent_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("received_amount", "V") ? "'" . $this->getProperty("received_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_note", "V") ? "'" . $this->getProperty("extra_note") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_batch_detail SET ";
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				if($this->isPropertySet("extra_note", "K")){
					$Sql .= "$con extra_note='" . $this->getProperty("extra_note") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("batch_detail_id", "V")){
					$Sql .= " AND batch_detail_id='" . $this->getProperty("batch_detail_id") . "'";
				}
				
				if($this->isPropertySet("monthly_rent_id", "V")){
					$Sql .= " AND monthly_rent_id='" . $this->getProperty("monthly_rent_id") . "'";
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
	public function actInstallmentPlan($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_tenant_installment_plan(
						tenant_installment_id,
						user_id,
						tenant_id,
						pending_amount,
						installment_amount,
						discount_apply,
						discount_type,
						discount_value,
						no_of_installment,
						installment_status,
						installment_option,
						enter_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("tenant_installment_id", "V") ? $this->getProperty("tenant_installment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("pending_amount", "V") ? "'" . $this->getProperty("pending_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_amount", "V") ? "'" . $this->getProperty("installment_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_apply", "V") ? "'" . $this->getProperty("discount_apply") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_type", "V") ? "'" . $this->getProperty("discount_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("discount_value", "V") ? "'" . $this->getProperty("discount_value") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_installment", "V") ? "'" . $this->getProperty("no_of_installment") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_status", "V") ? "'" . $this->getProperty("installment_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_option", "V") ? "'" . $this->getProperty("installment_option") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("enter_date", "V") ? "'" . $this->getProperty("enter_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_tenant_installment_plan SET ";
				
				if($this->isPropertySet("installment_status", "K")){
					$Sql .= "$con installment_status='" . $this->getProperty("installment_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("tenant_installment_id", "V")){
					$Sql .= " AND tenant_installment_id='" . $this->getProperty("tenant_installment_id") . "'";
				}
				
				if($this->isPropertySet("tenant_id", "V")){
					$Sql .= " AND tenant_id='" . $this->getProperty("tenant_id") . "'";
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
	public function actInstallmentList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_tenant_installment_list(
						installment_list_id,
						tenant_installment_id,
						tenant_id,
						monthly_payment,
						installment_status,
						installment_option,
						bill_no,
						paid_amount,
						paid_date,
						installment_month,
						installment_year,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("installment_list_id", "V") ? $this->getProperty("installment_list_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_installment_id", "V") ? $this->getProperty("tenant_installment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_payment", "V") ? "'" . $this->getProperty("monthly_payment") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_status", "V") ? "'" . $this->getProperty("installment_status") . "'" : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_option", "V") ? "'" . $this->getProperty("installment_option") . "'" : "2";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("bill_no", "V") ? "'" . $this->getProperty("bill_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("paid_amount", "V") ? "'" . $this->getProperty("paid_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("paid_date", "V") ? "'" . $this->getProperty("paid_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_month", "V") ? "'" . $this->getProperty("installment_month") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("installment_year", "V") ? "'" . $this->getProperty("installment_year") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? $this->getProperty("isActive") : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_tenant_installment_list SET ";
				
				if($this->isPropertySet("installment_status", "K")){
					$Sql .= "$con installment_status='" . $this->getProperty("installment_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("paid_amount", "K")){
					$Sql .= "$con paid_amount='" . $this->getProperty("paid_amount") . "'";
					$con = ",";
				}
				if($this->isPropertySet("paid_date", "K")){
					$Sql .= "$con paid_date='" . $this->getProperty("paid_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("installment_month", "K")){
					$Sql .= "$con installment_month='" . $this->getProperty("installment_month") . "'";
					$con = ",";
				}
				if($this->isPropertySet("installment_year", "K")){
					$Sql .= "$con installment_year='" . $this->getProperty("installment_year") . "'";
					$con = ",";
				}
				if($this->isPropertySet("bill_no", "K")){
					$Sql .= "$con bill_no='" . $this->getProperty("bill_no") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("installment_list_id", "V")){
					$Sql .= " AND installment_list_id='" . $this->getProperty("installment_list_id") . "'";
				}
				
				if($this->isPropertySet("tenant_installment_id", "V")){
					$Sql .= " AND tenant_installment_id='" . $this->getProperty("tenant_installment_id") . "'";
				}
				
				if($this->isPropertySet("tenant_id", "V")){
					$Sql .= " AND tenant_id='" . $this->getProperty("tenant_id") . "'";
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
	public function actRemainingList($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_remaining_list(
						remaining_id,
						block_id,
						building_id,
						floor_id,
						property_id,
						remaining_amount,
						per_month,
						no_of_installment) 
						VALUES(";
				$Sql .= $this->isPropertySet("remaining_id", "V") ? $this->getProperty("remaining_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("block_id", "V") ? $this->getProperty("block_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("building_id", "V") ? $this->getProperty("building_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("floor_id", "V") ? "'" . $this->getProperty("floor_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? "'" . $this->getProperty("property_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("remaining_amount", "V") ? "'" . $this->getProperty("remaining_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("per_month", "V") ? "'" . $this->getProperty("per_month") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("no_of_installment", "V") ? "'" . $this->getProperty("no_of_installment") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_remaining_list SET ";
				
				if($this->isPropertySet("tenant_id", "K")){
					$Sql .= "$con tenant_id='" . $this->getProperty("tenant_id") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("remaining_id", "V")){
					$Sql .= " AND remaining_id='" . $this->getProperty("remaining_id") . "'";
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
	public function actTenantExtraCharges($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_tenant_extra_charges(
						extra_charges_id,
						user_id,
						tenant_id,
						extra_title,
						extra_charges,
						extra_type,
						type_status,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("extra_charges_id", "V") ? $this->getProperty("extra_charges_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("tenant_id", "V") ? $this->getProperty("tenant_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_title", "V") ? "'" . $this->getProperty("extra_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_charges", "V") ? "'" . $this->getProperty("extra_charges") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_type", "V") ? "'" . $this->getProperty("extra_type") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("type_status", "V") ? "'" . $this->getProperty("type_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_tenant_extra_charges SET ";
				
				if($this->isPropertySet("extra_charges", "K")){
					$Sql .= "$con extra_charges='" . $this->getProperty("extra_charges") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("extra_title", "K")){
					$Sql .= "$con extra_title='" . $this->getProperty("extra_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("extra_type", "K")){
					$Sql .= "$con extra_type='" . $this->getProperty("extra_type") . "'";
					$con = ",";
				}
				if($this->isPropertySet("type_status", "K")){
					$Sql .= "$con type_status='" . $this->getProperty("type_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("extra_charges_id", "V")){
					$Sql .= " AND extra_charges_id='" . $this->getProperty("extra_charges_id") . "'";
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
	public function actComplain($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_complain_detail(
						complain_id,
						user_id,
						complain_number,
						property_id,
						category_id,
						complain_text,
						complain_reg_date,
						complain_status,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("complain_id", "V") ? $this->getProperty("complain_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("complain_number", "V") ? "'" . $this->getProperty("complain_number") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("property_id", "V") ? $this->getProperty("property_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_id", "V") ? "'" . $this->getProperty("category_id") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("complain_text", "V") ? "'" . $this->getProperty("complain_text") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("complain_reg_date", "V") ? "'" . $this->getProperty("complain_reg_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("complain_status", "V") ? "'" . $this->getProperty("complain_status") . "'" : "1";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_complain_detail SET ";
				
				if($this->isPropertySet("complain_resolved_date", "K")){
					$Sql .= "$con complain_resolved_date='" . $this->getProperty("complain_resolved_date") . "'";
					$con = ",";
				}
				if($this->isPropertySet("complain_status", "K")){
					$Sql .= "$con complain_status='" . $this->getProperty("complain_status") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("complain_id", "V")){
					$Sql .= " AND complain_id='" . $this->getProperty("complain_id") . "'";
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
	public function actComplainCategory($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_complain_category(
						complain_category_id,
						user_id,
						category_title,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("complain_category_id", "V") ? $this->getProperty("complain_category_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("category_title", "V") ? "'" . $this->getProperty("category_title") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_complain_category SET ";
				
				if($this->isPropertySet("category_title", "K")){
					$Sql .= "$con category_title='" . $this->getProperty("category_title") . "'";
					$con = ",";
				}
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("complain_category_id", "V")){
					$Sql .= " AND complain_category_id='" . $this->getProperty("complain_category_id") . "'";
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
	public function actComplainAssign($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_complain_assign(
						complain_assign_id,
						user_id,
						complain_id,
						assign_to_id,
						assign_from_id,
						assign_date,
						entery_date,
						isAcitve) 
						VALUES(";
				$Sql .= $this->isPropertySet("complain_assign_id", "V") ? $this->getProperty("complain_assign_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("user_id", "V") ? $this->getProperty("user_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("complain_id", "V") ? $this->getProperty("complain_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_to_id", "V") ? $this->getProperty("assign_to_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_from_id", "V") ? $this->getProperty("assign_from_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("assign_date", "V") ? "'" . $this->getProperty("assign_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isAcitve", "V") ? "'" . $this->getProperty("isAcitve") . "'" : "1";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_complain_assign SET ";

				if($this->isPropertySet("isAcitve", "K")){
					$Sql .= "$con isAcitve='" . $this->getProperty("isAcitve") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("complain_assign_id", "V")){
					$Sql .= " AND complain_assign_id='" . $this->getProperty("complain_assign_id") . "'";
				}
				if($this->isPropertySet("complain_id", "V")){
					$Sql .= " AND complain_id='" . $this->getProperty("complain_id") . "'";
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
	public function actComplainComment($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_complain_comment(
						complain_comment_id,
						complain_id,
						employee_id,
						comment_text,
						comment_picture,
						comment_date) 
						VALUES(";
				$Sql .= $this->isPropertySet("complain_comment_id", "V") ? $this->getProperty("complain_comment_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("complain_id", "V") ? $this->getProperty("complain_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? $this->getProperty("employee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("comment_text", "V") ? "'" . $this->getProperty("comment_text") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("comment_picture", "V") ? "'" . $this->getProperty("comment_picture") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("comment_date", "V") ? "'" . $this->getProperty("comment_date") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_complain_comment SET ";

				if($this->isPropertySet("comment_picture", "K")){
					$Sql .= "$con comment_picture='" . $this->getProperty("comment_picture") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("complain_comment_id", "V")){
					$Sql .= " AND complain_comment_id='" . $this->getProperty("complain_comment_id") . "'";
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
	public function actBillModificationRequest($mode = "I"){
		$mode = strtoupper($mode);
		switch($mode){
			case "I":
				$Sql = "INSERT INTO rs_tbl_inv_bill_modification_request(
						bill_modify_req_id,
						employee_id,
						monthly_bill_id,
						request_code,
						request_date,
						request_type,
						request_status,
						extra_note,
						original_bill_no,
						arrear_amount_remove,
						original_amount,
						request_extra_note,
						entery_date,
						isActive) 
						VALUES(";
				$Sql .= $this->isPropertySet("bill_modify_req_id", "V") ? $this->getProperty("bill_modify_req_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("employee_id", "V") ? $this->getProperty("employee_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("monthly_bill_id", "V") ? $this->getProperty("monthly_bill_id") : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_code", "V") ? "'" . $this->getProperty("request_code") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_date", "V") ? "'" . $this->getProperty("request_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_type", "V") ? "'" . $this->getProperty("request_type") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_status", "V") ? "'" . $this->getProperty("request_status") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("extra_note", "V") ? "'" . $this->getProperty("extra_note") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("original_bill_no", "V") ? "'" . $this->getProperty("original_bill_no") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("arrear_amount_remove", "V") ? "'" . $this->getProperty("arrear_amount_remove") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("original_amount", "V") ? "'" . $this->getProperty("original_amount") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("request_extra_note", "V") ? "'" . $this->getProperty("request_extra_note") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("entery_date", "V") ? "'" . $this->getProperty("entery_date") . "'" : "NULL";
				$Sql .= ",";
				$Sql .= $this->isPropertySet("isActive", "V") ? "'" . $this->getProperty("isActive") . "'" : "NULL";
				$Sql .= ")";
				break;
			case "U":
				$Sql = "UPDATE rs_tbl_inv_bill_modification_request SET ";

				if($this->isPropertySet("resolved_date", "K")){
					$Sql .= "$con resolved_date='" . $this->getProperty("resolved_date") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("extra_note", "K")){
					$Sql .= "$con extra_note='" . $this->getProperty("extra_note") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("request_status", "K")){
					$Sql .= "$con request_status='" . $this->getProperty("request_status") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("resolved_by", "K")){
					$Sql .= "$con resolved_by='" . $this->getProperty("resolved_by") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("tenant_id", "K")){
					$Sql .= "$con tenant_id='" . $this->getProperty("tenant_id") . "'";
					$con = ",";
				}
				
				if($this->isPropertySet("isActive", "K")){
					$Sql .= "$con isActive='" . $this->getProperty("isActive") . "'";
					$con = ",";
				}
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("bill_modify_req_id", "V")){
					$Sql .= " AND bill_modify_req_id='" . $this->getProperty("bill_modify_req_id") . "'";
				}
				break;
			case "D":
				$Sql = "UPDATE rs_tbl_inv_bill_modification_request SET isActive=3";
				
				$Sql .= " WHERE 1=1";
				
				if($this->isPropertySet("bill_modify_req_id", "V")){
					$Sql .= " AND bill_modify_req_id='" . $this->getProperty("bill_modify_req_id") . "'";
				}
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