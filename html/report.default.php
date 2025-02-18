<style>
.card-title-customize {
	font-size: 16px !important;
	padding-bottom: 0px !important;
}
</style>
<?php
$CallWSet = 'col-md-2';
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><?php echo $MainHeadTitle;?> </h4>
            <div class="toolbar text-right"><a href="#" onClick="openRequestedPopup('<?php echo $MakeLinkForPrint;?>');"><i class="material-icons">printer</i></a></div>

            <div class="col-md-12">
  <hr>
  <?php if(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'A'){?>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="sec" value="<?php echo EncData(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)), 1, $objBF) ;?>">
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" value="<?php echo $ReturnStartDate;?>" tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" value="<?php echo $ReturnEndDate;?>" tabindex="2" />
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Vendor</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_vendor" title="Select Vendor Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_vendor);?>>All</option>
            <?php
			$objSSSjatlan->resetProperty();
			$objSSSjatlan->setProperty("ORDERBY", 'customer_id DESC');
			$objSSSjatlan->setProperty("customer_type", 2);
			$objSSSjatlan->setProperty("isNot", 3);
			$objSSSjatlan->lstCustomers();
			while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["customer_id"];?>"<?php echo StaticDDSelection($CustomerList["customer_id"], $Return_by_vendor);?>><?php echo $CustomerList["customer_business_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Vehicle</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_vehicle" title="Select Vehicle Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_vehicle);?>>All</option>
            <?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'vehicle_id');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstVehicle();
                    while($VehicleList = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $VehicleList["vehicle_id"];?>"<?php echo StaticDDSelection($VehicleList["vehicle_id"], $Return_by_vehicle);?>><?php echo $VehicleList["vehicle_number"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Area</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_area" title="Select Area Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_area);?>>All</option>
            <?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'location_name');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstLocation();
					//$GetList = $objQayaduser->SQLTestFunc();
					//print_r($GetList);
					//die();
                    while($Location = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $Location["location_id"];?>"<?php echo StaticDDSelection($Location["location_id"], $Return_by_area);?>><?php echo $Location["location_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>By Invoice</code>
        <div class="form-group start">
          <input type="text" class="form-control" name="by_invoice" value="<?php echo $Return_by_invoice;?>" tabindex="2" />
        </div>
      </div>
    </div>
    
    
    
    
    
    
    <div class="col-md-2">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Gen Report</button>
        </div>
      </div>
    </div>
  </form>
  <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'B'){?>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="sec" value="<?php echo EncData(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)), 1, $objBF) ;?>">
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" value="<?php echo $ReturnStartDate;?>" tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" value="<?php echo $ReturnEndDate;?>" tabindex="2" />
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Customer</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_customer" title="Select Customer Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_customer);?>>All</option>
            <?php
			$objSSSjatlan->resetProperty();
			$objSSSjatlan->setProperty("ORDERBY", 'customer_id DESC');
			$objSSSjatlan->setProperty("customer_type", 1);
			$objSSSjatlan->setProperty("isNot", 3);
			$objSSSjatlan->lstCustomers();
			while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["customer_id"];?>"<?php echo StaticDDSelection($CustomerList["customer_id"], $Return_by_customer);?>><?php echo $CustomerList["customer_business_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Vehicle</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_vehicle" title="Select Vehicle Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_vehicle);?>>All</option>
            <?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'vehicle_id');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstVehicle();
                    while($VehicleList = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $VehicleList["vehicle_id"];?>"<?php echo StaticDDSelection($VehicleList["vehicle_id"], $Return_by_vehicle);?>><?php echo $VehicleList["vehicle_number"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Area</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_area" title="Select Area Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_area);?>>All</option>
            <?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'location_name');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstLocation();
					//$GetList = $objQayaduser->SQLTestFunc();
					//print_r($GetList);
					//die();
                    while($Location = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $Location["location_id"];?>"<?php echo StaticDDSelection($Location["location_id"], $Return_by_area);?>><?php echo $Location["location_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    
    
    <div class="col-md-2">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Gen Report</button>
        </div>
      </div>
    </div>
  </form>
  <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'C'){?>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="sec" value="<?php echo EncData(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)), 1, $objBF) ;?>">
    <div class="col-md-3">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" value="<?php echo $ReturnStartDate;?>" tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" value="<?php echo $ReturnEndDate;?>" tabindex="2" />
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-content ledger"> <code>Select Customer</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_customer" title="Select Customer Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_customer);?>>All</option>
            <?php
			$objSSSjatlan->resetProperty();
			$objSSSjatlan->setProperty("ORDERBY", 'customer_name');
			$objSSSjatlan->setProperty("customer_type", 1);
			$objSSSjatlan->setProperty("isNot", 3);
			$objSSSjatlan->lstCustomers();
			while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["customer_id"];?>"<?php echo StaticDDSelection($CustomerList["customer_id"], $Return_by_customer);?>><?php echo $CustomerList["customer_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    
    <div class="col-md-3">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Gen Report</button>
        </div>
      </div>
    </div>
  </form>
   <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'D'){?>
   <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="sec" value="<?php echo EncData(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)), 1, $objBF) ;?>">
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" value="<?php echo $ReturnStartDate;?>" tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" value="<?php echo $ReturnEndDate;?>" tabindex="2" />
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Customer</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="by_customer" title="Select Customer Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_customer);?>>All</option>
            <?php
			$objSSSjatlan->resetProperty();
			$objSSSjatlan->setProperty("ORDERBY", 'customer_id DESC');
			$objSSSjatlan->setProperty("customer_type", 1);
			$objSSSjatlan->setProperty("isNot", 3);
			$objSSSjatlan->lstCustomers();
			while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["customer_id"];?>"<?php echo StaticDDSelection($CustomerList["customer_id"], $Return_by_customer);?>><?php echo $CustomerList["customer_business_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Vehicle</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="by_vehicle" title="Select Vehicle Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_vehicle);?>>All</option>
            <?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'vehicle_id');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstVehicle();
                    while($VehicleList = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $VehicleList["vehicle_id"];?>"<?php echo StaticDDSelection($VehicleList["vehicle_id"], $Return_by_vehicle);?>><?php echo $VehicleList["vehicle_number"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Select Area</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="by_area" title="Select Area Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_area);?>>All</option>
            <?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'location_name');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstLocation();
					//$GetList = $objQayaduser->SQLTestFunc();
					//print_r($GetList);
					//die();
                    while($Location = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $Location["location_id"];?>"<?php echo StaticDDSelection($Location["location_id"], $Return_by_area);?>><?php echo $Location["location_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    
    
    <div class="col-md-2">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Gen Report</button>
        </div>
      </div>
    </div>
  </form>
  <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'E'){?>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="sec" value="<?php echo EncData(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)), 1, $objBF) ;?>">
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" required value="<?php echo $ReturnStartDate;?>" tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" required value="<?php echo $ReturnEndDate;?>" tabindex="2" />
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Select Location</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_location" title="Select Location Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_location);?>>All</option>
            <?php
			$objSSSjatlan->resetProperty();
			echo $objSSSjatlan->CustomerLocation();
			?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Select Customer</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_customer" title="Select Customer Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_vendor);?>>All</option>
            <?php
			$objSSSjatlan->resetProperty();
			$objSSSjatlan->setProperty("ORDERBY", 'customer_name');
			$objSSSjatlan->setProperty("customer_type", 1);
			$objSSSjatlan->setProperty("isNot", 3);
			$objSSSjatlan->lstCustomers();
			while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["customer_id"];?>"<?php echo StaticDDSelection($CustomerList["customer_id"], $Return_by_customer);?>><?php echo $CustomerList["customer_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Select Customer</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="by_customer_type" title="Select Customer Type Or All" tabindex="4">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_customer_type);?>>Both</option>
            <option value="1"<?php echo StaticDDSelection(1, $Return_by_customer_type);?>>Customer</option>
            <option value="2"<?php echo StaticDDSelection(2, $Return_by_customer_type);?>>Contractor</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Gen Report</button>
        </div>
      </div>
    </div>
  </form>
  <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'F'){?>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="sec" value="<?php echo EncData(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)), 1, $objBF) ;?>">
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" required value="<?php echo $ReturnStartDate;?>" tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" required value="<?php echo $ReturnEndDate;?>" tabindex="2" />
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-content ledger"> <code>Select Type</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="filter_option" title="Select Filter Type Or All" tabindex="4">
            <option value="0"<?php echo StaticDDSelection(0, $filter_option);?>>Both</option>
            <option value="9"<?php echo StaticDDSelection(9, $filter_option);?>>Discount</option>
            <option value="10"<?php echo StaticDDSelection(10, $filter_option);?>>Other Charges</option>
          </select>
        </div>
      </div>
    </div>
	  <div class="col-md-3">
      <div class="card-content ledger"> <code>Select Customer</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_customer" title="Select Customer Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_vendor);?>>All</option>
            <?php
			$objQayadaccount->resetProperty();
			$objQayadaccountgroup = new Qayadaccount;
			$objQayadaccount->setProperty("head_type_id", 4);
			$objQayadaccount->setProperty("ORDERBY", 'head_title');
			$objQayadaccount->lstHead();
			while($CustomerList = $objQayadaccount->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["head_id"];?>"<?php echo StaticDDSelection($CustomerList["head_id"], $Return_by_customer);?>><?php echo $CustomerList["head_title"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-2">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Gen Report</button>
        </div>
      </div>
    </div>
  </form>
   <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'H'){?>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="sec" value="<?php echo EncData(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)), 1, $objBF) ;?>">
    <div class="col-md-3">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" required value="<?php echo $ReturnStartDate;?>" tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" required value="<?php echo $ReturnEndDate;?>" tabindex="2" />
        </div>
      </div>
    </div>
	  <div class="col-md-3">
      <div class="card-content ledger"> <code>Select Customer</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_customer" title="Select Customer Or All" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $Return_by_vendor);?>>All</option>
            <?php
			$objQayadaccount->resetProperty();
			$objQayadaccountgroup = new Qayadaccount;
			$objQayadaccount->setProperty("head_type_id", 6);
			$objQayadaccount->setProperty("ORDERBY", 'head_title');
			$objQayadaccount->lstHead();
			while($CustomerList = $objQayadaccount->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["head_id"];?>"<?php echo StaticDDSelection($CustomerList["head_id"], $Return_by_customer);?>><?php echo $CustomerList["head_title"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Gen Report</button>
        </div>
      </div>
    </div>
  </form>
  <?php } ?>
  
  
</div>

<?php //} ?>
            
            
            <?php if(trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) != ''){ ?>
            <hr>
            <div class="material-datatables">
            <?php if(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'A' && trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) == 'report'){?>
            <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Invoice</th>
                    <th>COF</th>
                    <th>Vehicle</th>
                    <th>Area</th>
					<th>Qty</th>
                   	<th>Rate</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
				  $TotalQuantity = 0;
				  $ItemPrice = 0;
				  $TotalSumPrice = 0;
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehcil = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					if($_GET["sd"] != ''){
					$objSSSjatlan->setProperty("DATEFILTER", 'YES');
					$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if(trim(DecData($_GET["bvd"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vendor_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["bve"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vehicle_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["ba"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("destination_id", $Return_by_area);
					}
					if(trim(DecData($_GET["bi"], 1, $objBF)) != ""){
					$objSSSjatlan->setProperty("d_invoice_no", $Return_by_invoice);
					}
					$objSSSjatlan->setProperty("order_request_type", 2);
					$objSSSjatlan->setProperty("order_process_status", 1);
					//$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderRequest["vendor_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							//$objSSSVehcil
							
							$objSSSVehcil->resetProperty();
							$objSSSVehcil->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehcil->lstVehicle();
							$VehicleInformation = $objSSSVehcil->dbFetchArray(1);
							//
							$TotalQuantity += $OrderRequest["no_of_items"];
				  $ItemPrice += $OrderRequest["per_item_amount"];
				  
				  $TotalSumPrice += $OrderRequest["no_of_items"] * $OrderRequest["per_item_amount"];
                    ?>
                  <tr>
                    <td><?php echo dateFormate_4($OrderRequest["d_date"]);?></td>
                    <td><?php echo $OrderRequest["d_invoice_no"];?></td>
                    <td><?php echo $OrderRequest["cof_no"];?></td>
                    <td><?php echo $VehicleInformation["vehicle_number"];?></td>
                    <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo RsAmount($OrderRequest["per_item_amount"]);?></td>
                    <td><?php echo RsAmount($OrderRequest["no_of_items"] * $OrderRequest["per_item_amount"]);?></td>
                    </tr>
                  <?php } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><?php echo $TotalQuantity;?></th>
                    <th><?php echo RsAmount($ItemPrice);?></th>
                    <th><?php echo RsAmount($TotalSumPrice);?></th>
                    </tr>
                    </tfoot>
              </table>
              <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'B' && trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) == 'report'){?>
              <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Vehicle</th>
                    <th>Area</th>
					<th>Qty</th>
                   	<th>Rate</th>
                    <th>D Char</th>
                    <th>L Char</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
				  $TotalQuantity = 0;
				  $ItemPrice = 0;
				  $D_Char = 0;
				  $L_Char = 0;
				  $TotalSumPrice = 0;
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehcil = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					if($_GET["sd"] != ''){
					$objSSSjatlan->setProperty("DATEFILTER", 'YES');
					$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if(trim(DecData($_GET["bc"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("customer_id", $Return_by_customer);
					}
					if(trim(DecData($_GET["bve"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vehicle_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["ba"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("destination_id", $Return_by_area);
					}
					if(trim(DecData($_GET["bi"], 1, $objBF)) != ""){
					$objSSSjatlan->setProperty("d_invoice_no", $Return_by_invoice);
					}
					$objSSSjatlan->setProperty("order_request_type", 1);
					$objSSSjatlan->setProperty("order_process_status", 1);
					//$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderRequest["customer_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							//$objSSSVehcil
							
							$objSSSVehcil->resetProperty();
							$objSSSVehcil->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehcil->lstVehicle();
							$VehicleInformation = $objSSSVehcil->dbFetchArray(1);
							//
							$TotalQuantity += $OrderRequest["no_of_items"];
				  $ItemPrice += $OrderRequest["per_item_amount"];
				  
				  $D_Char += $OrderRequest["delivery_chagres"];
				  $L_Char += $OrderRequest["unloading_price"];
				  
				  $TotalSumPrice += $OrderRequest["final_amount"];
                    ?>
                  <tr>
                    <td><?php echo $OrderRequest["d_date"];?></td>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                   <td><?php echo $VehicleInformation["vehicle_number"];?></td>
                    <td><?php echo $DestinationInfo["location_name"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo RsAmount($OrderRequest["per_item_amount"]);?></td>
                     <td><?php echo RsAmount($OrderRequest["delivery_chagres"]);?></td>
                    <td><?php echo RsAmount($OrderRequest["unloading_price"]);?></td>
                    <td><?php echo RsAmount($OrderRequest["final_amount"]);?></td>
                    </tr>
                  <?php } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><?php echo $TotalQuantity;?></th>
                    <th><?php echo RsAmount($ItemPrice);?></th>
                    <th><?php echo RsAmount($D_Char);?></th>
                    <th><?php echo RsAmount($L_Char);?></th>
                    <th><?php echo RsAmount($TotalSumPrice);?></th>
                    </tr>
                    </tfoot>
              </table>
               <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'C' && trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) == 'report'){?>
               <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Item</th>
                    <th>Qty</th>
					<th>Purchasing<br />
						Rate + L-Char + D-Char</th>
                   	<th>Selling Rate</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
				  $TotalQuantity = 0;
				  $TotalSumPrice = 0;
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSSellingDetail = new SSSjatlan;
					
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					if($_GET["sd"] != ''){
					$objSSSjatlan->setProperty("DATEFILTER", 'YES');
					$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if(trim(DecData($_GET["bc"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("customer_id", $Return_by_customer);
					}
					if(trim(DecData($_GET["bve"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("vehicle_id", $Return_by_vehicle);
					}
					if(trim(DecData($_GET["ba"], 1, $objBF)) != 0){
					$objSSSjatlan->setProperty("destination_id", $Return_by_area);
					}
					if(trim(DecData($_GET["bi"], 1, $objBF)) != ""){
					$objSSSjatlan->setProperty("d_invoice_no", $Return_by_invoice);
					}
					$objSSSjatlan->setProperty("order_request_type", 1);
					$objSSSjatlan->setProperty("order_process_status", 1);
					//$objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
						
							$objSSSCustomers->resetProperty();
							$objSSSCustomers->setProperty("customer_id", $OrderRequest["customer_id"]);
							$objSSSCustomers->lstCustomers();
							$CustomerInfo = $objSSSCustomers->dbFetchArray(1);
						
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							//$objSSSSellingDetail
							
							$objSSSSellingDetail->resetProperty();
							$objSSSSellingDetail->setProperty("order_request_id", $OrderRequest["purchase_id"]);
							$objSSSSellingDetail->lstOrderRequestDetail();
							$SellingDetail = $objSSSSellingDetail->dbFetchArray(1);
							
							//
							
				  $ItemPrice += $OrderRequest["per_item_amount"];
				  
				  $D_Char += $OrderRequest["delivery_chagres"];
				  $L_Char += $OrderRequest["unloading_price"];
				  
				 // $TotalSumPrice += $OrderRequest["final_amount"];
				  if($OrderRequest["purchase_id"] != ''){
					  $TotalQuantity += $OrderRequest["no_of_items"];
                    ?>
                  <tr>
                    <td><?php echo dateFormate_3($OrderRequest["d_date"]);?></td>
                    <td><?php echo $CustomerInfo["customer_name"];?></td>
                   <td><?php echo $ProductInfo["product_name"];?></td>
                   <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php 
					echo '<small>'.$SellingDetail["per_item_amount"] . ' + ' . $OrderRequest["unloading_price"]  .' + '. $SellingDetail["delivery_chagres"] / $SellingDetail["no_of_items"].'</small><code>'.$SellingDetail["no_of_items"].'</code><br>';
				
					//$TotalSum = $SellingDetail["final_amount"] + $SellingDetail["delivery_chagres"] + $OrderRequest["unloading_price"] * $SellingDetail["no_of_items"];
					$DeliveryChagresSellingOrder =  $SellingDetail["delivery_chagres"] / $SellingDetail["no_of_items"];
					$TotalSum = $SellingDetail["per_item_amount"] + $DeliveryChagresSellingOrder + $OrderRequest["unloading_price"];
					//$PerItemCost = $TotalSum / $SellingDetail["no_of_items"];
					$PerItemCost = $TotalSum;
					echo RsAmount($PerItemCost);?></td>
                    
                    <td><?php echo RsAmount($OrderRequest["per_item_amount"]);?></td>
                    <td><?php //echo RsAmount($OrderRequest["final_amount"]);
					$DiffSellBuy = $OrderRequest["per_item_amount"] - $PerItemCost;
					$FinalDffPRice = $DiffSellBuy * $OrderRequest["no_of_items"];
					echo RsAmount($FinalDffPRice);
					$TotalSumPrice += $FinalDffPRice;
					?></td>
                    </tr>
                  <?php } } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th></th>
                    <th></th>
                    <th align="right">Total Qty</th>
                    <th><?php echo $TotalQuantity;?></th>
                    <th><?php //echo $TotalQuantity;?></th>
                    <th align="right">Total Amount</th>
                    <th><?php echo RsAmount($TotalSumPrice);?></th>
                  </tr>
                    </tfoot>
              </table>
              <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'E' && trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) == 'report'){?>
              <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Customer</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Debit</th>
					<th>Credit</th>
                   	<th>Balance</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
				  $TotalCredit=0;
				  $TotalDebit=0;
				  $TotalQuantity = 0;
				  $ItemPrice = 0;
				  $TotalSumPrice = 0;
					$objSSSjatlanLocation = new SSSjatlan;
					$objSSSjatlanCategory = new SSSjatlan;
					$objSSSCounterCustomerOrder = new SSSjatlan;
					$objSSSOrderAmountSUM = new SSSjatlan;
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("ORDERBY", 'customer_name');
					$objSSSjatlan->setProperty("customer_type", 1);
					if($Return_by_customer_type != 0){
					$objSSSjatlan->setProperty("customer_category", $Return_by_customer_type);	
					}
					if($Return_by_customer != 0){
					$objSSSjatlan->setProperty("customer_id", $Return_by_customer);	
					}
					if($Return_by_location != 0){
					$objSSSjatlan->setProperty("location_id", $Return_by_location);	
					}
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->lstCustomers();
					while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
						
						$objSSSjatlanCategory->resetProperty();
						$objSSSjatlanCategory->setProperty("category_id", $CustomerList["customer_category"]);
						$objSSSjatlanCategory->lstCustomerCategory();
						$GetCustomerCategory = $objSSSjatlanCategory->dbFetchArray(1);
						
						$objSSSjatlanLocation->resetProperty();
						$objSSSjatlanLocation->setProperty("location_id", $CustomerList["location_id"]);
						$objSSSjatlanLocation->lstLocation();
						$GetCustomerLocation = $objSSSjatlanLocation->dbFetchArray(1);
						
							/*$objSSSCounterCustomerOrder->resetProperty();
							if($_GET["sd"] != ''){
							$objSSSCounterCustomerOrder->setProperty("DATEFILTER", 'YES');
							$objSSSCounterCustomerOrder->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
							$objSSSCounterCustomerOrder->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
							}
							$objSSSCounterCustomerOrder->setProperty("customer_id", $CustomerList["customer_id"]);
							$objSSSCounterCustomerOrder->setProperty("isActive", 1);
							$objSSSCounterCustomerOrder->setProperty("order_request_type", 1);
							$objSSSCounterCustomerOrder->setProperty("order_process_status", 1);
							$objSSSCounterCustomerOrder->lstOrderRequestDetail();
							$CustomerRequestedOrderCounter = $objSSSCounterCustomerOrder->totalRecords();*/
						
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("isActive", 1);
							if($_GET["sd"] != ''){
							$objQayadaccount->setProperty("DATEFILTER", 'YES');
							$objQayadaccount->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
							$objQayadaccount->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
							}
							$objQayadaccount->setProperty("entity_id", $CustomerList['customer_id']);
							$objQayadaccount->setProperty("head_type_id", 4);
							$objQayadaccount->OverAllAccountStatus();
							$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
							//print_r($CashHeadStatus);
							$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
							//echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
							$TotalCredit +=$CashHeadStatus["TotalCredit"];
				  			$TotalDebit +=$CashHeadStatus["TotaDebit"];
                    ?>
                  <tr>
                    <td><?php echo $CustomerList["customer_name"];?></td>
                    <td><?php echo $GetCustomerLocation["location_name"];?></td>
                    <td><?php echo $GetCustomerCategory["category_name"];?></td>
                    <!--<td><?php //echo $CustomerRequestedOrderCounter;?></td>-->
                    <td><?php echo Numberformt($CashHeadStatus["TotaDebit"]);?></td>
                     <td><?php echo Numberformt($CashHeadStatus["TotalCredit"]);?></td>
                    <td><?php echo Numberformt($CashHeadTotal);?></td>
                    </tr>
                  <?php } ?>
                  
                </tbody>
                <tfoot>
                 <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th><?php echo RsAmount($TotalDebit);?></th>
                    <th><?php echo RsAmount($TotalCredit);?></th>
                    <th><?php 
					$RemainingAmount = $TotalDebit - $TotalCredit;
					echo RsAmount($RemainingAmount);?></th>
                    </tr>
                    </tfoot>
              </table>
              <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'F' && trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) == 'report'){?>
                      <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                          <thead>
                            <tr>
                        <th align="left">Date</th>
                        <th align="left">Txn#</th>
                        <th align="left">Particular</th>
                        <th align="left">Description</th>
                        <th align="left">Discount</th>
                        <th align="left">Other Charges</th>
						<th align="left">Balance</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $BalanceAmount = 0;
                            $objQayadaccountDetail = new Qayadaccount;
                            $objQayadaccountLinkHead = new Qayadaccount;
                            $objQayadaccountTHead = new Qayadaccount;
                            $objSSSLocationGet = new SSSjatlan;
							$objSSSVehicleNo = new SSSjatlan;
                            $objQayadaccountDetail->resetProperty();
                            //$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
                            //if($GetHeadInfo["head_type_id"] == 2){
                            if($_GET["sd"] != ''){
                            $objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
                            $objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
                            $objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
                            }
                            if($_GET["fo"] != '' && $Return_filter_option!=0){
                            $objQayadaccountDetail->setProperty("pay_mode", $Return_filter_option);
                            } else {
							$objQayadaccountDetail->setProperty("pay_mode_array", '9,10');	
							}
                            //
							if($_GET["bc"] != '' && $Return_by_customer!=0){
							$objQayadaccountDetail->setProperty("head_id", $Return_by_customer);
							}
                            //
							$objQayadaccountDetail->setProperty("location_id", 1);
                            $objQayadaccountDetail->setProperty("isActive", 1);
                            $objQayadaccountDetail->setProperty("ORDERBY", 'transaction_id');
                            $objQayadaccountDetail->lstAccountTransaction();
                            while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
                                
                                if($GetHeadInfo["head_type_id"] == 2){
                                
                                if($LedgerHeadDetails["trans_mode"] == 2){
                                    $BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
                                } else {
                                    $BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
                                }
                                    
                                } elseif($GetHeadInfo["head_type_id"] == 3){
                                
                                if($LedgerHeadDetails["trans_mode"] == 2){
                                    $BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
                                } else {
                                    $BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
                                }
                                    
                                } else {
                                    
                                if($LedgerHeadDetails["trans_mode"] == 2){
                                    $BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
                                } else {
                                    $BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
                                }
                                
                                }
                                    
                                    //if($LedgerHeadDetails["pay_mode"] != 1){
                                        if($LedgerHeadDetails["head_id"] != ''){
                                            $objQayadaccountLinkHead->resetProperty();
                                            $objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["head_id"]);
                                            $objQayadaccountLinkHead->lstHead();
                                            $TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
                                            $TransferHeadTitle = $TransferHeadDetail["head_title"];
                                        } else {
                                            $TransferHeadTitle = '';
                                        }
                                   // }
                                  
                            ?>
                          <tr>
                            <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                            <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                            <td><?php echo $TransferHeadTitle; ?></td>
                            
                            
                            <td><?php echo $LedgerHeadDetails["trans_title"] . '/'.$LedgerHeadDetails["trans_note"];?></td>
							  
                            <td><?php 
                            if($LedgerHeadDetails["trans_mode"] == 1){
        
                            echo Numberformt($LedgerHeadDetails["trans_amount"]);
                            $SumDebit+= $LedgerHeadDetails["trans_amount"];
                            } else {
        
                            echo Numberformt('0');
        
                            }
        
                            ?></td>
							  
                            <td><?php if($LedgerHeadDetails["trans_mode"] == 2){
        
                            echo Numberformt($LedgerHeadDetails["trans_amount"]);
                            $SumCredit += $LedgerHeadDetails["trans_amount"];
        
                            } else {
        
                            echo Numberformt('0');	
        
                            }?></td>
                             <td><?php echo Numberformt($BalanceAmount);?></td> 
                          </tr>
                           <?php } ?>
                          
                          
                        </tbody>
        </table>
			  <?php } elseif(trim($objBF->decrypt($_GET["sec"], 1, ENCRYPTION_KEY)) == 'H' && trim($objBF->decrypt($_GET["gen"], 1, ENCRYPTION_KEY)) == 'report'){?>
                      <table data-order="[[ 0, &quot;asc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                          <thead>
                            <tr>
                        <th align="left">Date</th>
                        <th align="left">Txn#</th>
                        <th align="left">Particular</th>
                        <th align="left">Description</th>
                        <th align="left">Discount</th>
								<th align="left">Balance</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $BalanceAmount = 0;
                            $objQayadaccountDetail = new Qayadaccount;
                            $objQayadaccountLinkHead = new Qayadaccount;
                            $objQayadaccountTHead = new Qayadaccount;
                            $objSSSLocationGet = new SSSjatlan;
							$objSSSVehicleNo = new SSSjatlan;
                            $objQayadaccountDetail->resetProperty();
                            //$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
                            //if($GetHeadInfo["head_type_id"] == 2){
                            if($_GET["sd"] != ''){
                            $objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
                            $objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
                            $objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
                            }
                            if($_GET["fo"] != '' && $Return_filter_option!=0){
                            $objQayadaccountDetail->setProperty("pay_mode", $Return_filter_option);
                            } else {
							$objQayadaccountDetail->setProperty("pay_mode_array", 9);	
							}
                            //
							if($_GET["bc"] != '' && $Return_by_customer!=0){
							$objQayadaccountDetail->setProperty("head_id", $Return_by_customer);
							}
                            //
							$objQayadaccountDetail->setProperty("location_id", 2);
                            $objQayadaccountDetail->setProperty("isActive", 1);
                            $objQayadaccountDetail->setProperty("ORDERBY", 'transaction_id');
                            $objQayadaccountDetail->lstAccountTransaction();
                            while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
                                
                                if($GetHeadInfo["head_type_id"] == 2){
                                
                                if($LedgerHeadDetails["trans_mode"] == 2){
                                    $BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
                                } else {
                                    $BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
                                }
                                    
                                } elseif($GetHeadInfo["head_type_id"] == 3){
                                
                                if($LedgerHeadDetails["trans_mode"] == 2){
                                    $BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
                                } else {
                                    $BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
                                }
                                    
                                } else {
                                    
                                if($LedgerHeadDetails["trans_mode"] == 2){
                                    $BalanceAmount = $BalanceAmount - $LedgerHeadDetails["trans_amount"];
                                } else {
                                    $BalanceAmount = $BalanceAmount + $LedgerHeadDetails["trans_amount"];
                                }
                                
                                }
                                    
                                    //if($LedgerHeadDetails["pay_mode"] != 1){
                                        if($LedgerHeadDetails["head_id"] != ''){
                                            $objQayadaccountLinkHead->resetProperty();
                                            $objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["head_id"]);
                                            $objQayadaccountLinkHead->lstHead();
                                            $TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
                                            $TransferHeadTitle = $TransferHeadDetail["head_title"];
                                        } else {
                                            $TransferHeadTitle = '';
                                        }
                                   // }
                                  
                            ?>
                          <tr>
                            <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                            <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                            <td><?php echo $TransferHeadTitle; ?></td>
                            
                            
                            <td><?php echo $LedgerHeadDetails["trans_title"] . '/'.$LedgerHeadDetails["trans_note"];?></td>
							  
                            <td><?php 
                            if($LedgerHeadDetails["trans_mode"] == 2){
        
                            echo Numberformt($LedgerHeadDetails["trans_amount"]);
                            $SumDebit+= $LedgerHeadDetails["trans_amount"];
                            } else {
        
                            echo Numberformt('0');
        
                            }
        
                            ?></td>
							  
                            <!-- <td><?php /* if($LedgerHeadDetails["trans_mode"] == 2){
        
                            echo Numberformt($LedgerHeadDetails["trans_amount"]);
                            $SumCredit += $LedgerHeadDetails["trans_amount"];
        
                            } else {
        
                            echo Numberformt('0');	
        
                            } */?></td> -->
                             <td><?php echo Numberformt($BalanceAmount);?></td> 
                          </tr>
                           <?php } ?>
                          
                          
                        </tbody>
        </table>
              <?php } ?>
            </div>
            <?php } ?>
          </div>
          
          <!-- end content--> 
          
        </div>
        
        <!--  end card  --> 
        
      </div>
      
      <!-- end col-md-12 --> 
      
    </div>
    
    <!-- end row --> 
    
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datatablesbtn').dataTable({
    paging: false
});
});
</script>