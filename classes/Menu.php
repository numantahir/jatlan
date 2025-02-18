<?php

/**
*
* This is a class Menu
* @version 0.01
* @author Numan Tahir  <numan_tahir1@live.com>
*
**/
class Menu extends Database{
	/*
	* This is the constructor of the class Menu
	* @author Numan Tahir  <numan_tahir1@live.com>
	*/
	public function __construct(){
		parent::__construct();
	}

	/*
	* This method is used to list the menus
	* @author Numan Tahir
	*/
	function lstMenu(){
		$Sql = "SELECT
					menu_id,
					parent_id,
					menu_title,
					menu_link,
					user_access
				FROM
					rs_tbl_app_menu
				WHERE
					1=1";
		if($this->isPropertySet("menu_id", "V"))
			$Sql .= " AND menu_id=" . $this->getProperty("menu_id");
		if($this->isPropertySet("menu_link", "V"))
			$Sql .= " AND menu_link='" . $this->getProperty("menu_link") . "'";
		if($this->isPropertySet("parent_id", "V"))
			$Sql .= " AND parent_id=" . $this->getProperty("parent_id");
		if($this->isPropertySet("user_access", "V"))
			$Sql .= " AND user_access=" . $this->getProperty("user_access");
		if($this->isPropertySet("Mparent_id", "V"))
			$Sql .= " AND parent_id=0";
		if($this->isPropertySet("ORDERBY", "V"))
			$Sql .= " ORDER BY " . $this->getProperty("ORDERBY");
		//$Sql .= " ORDER BY menu_order ASC";		
		return $this->dbQuery($Sql);
	}
}
?>