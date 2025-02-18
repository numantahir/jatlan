<style>
.card-title-customize {
	font-size: 16px !important;
	padding-bottom: 0px !important;
}
</style>
<?php 
if(trim(DecData($_GET["sd"], 1, $objBF))!=''){
	$ReturnStartDate = trim(DecData($_GET["sd"], 1, $objBF));
} else {
	$ReturnStartDate = '';
}

if(trim(DecData($_GET["ed"], 1, $objBF))!=''){
	$ReturnEndDate = trim(DecData($_GET["ed"], 1, $objBF));
} else {
	$ReturnEndDate = '';
}

if(trim(DecData($_GET["ts"], 1, $objBF))!=''){
	$ReturnTransactionStatus = trim(DecData($_GET["ts"], 1, $objBF));
} else {
	$ReturnTransactionStatus = 0;
}

if(trim(DecData($_GET["ii"], 1, $objBF))!=''){
	$ReturnItemId = trim(DecData($_GET["ii"], 1, $objBF));
} else {
	$ReturnItemId = 0;
}
if(trim(DecData($_GET["lii"], 1, $objBF))!=''){
	$ReturnLinkItemId = trim(DecData($_GET["lii"], 1, $objBF));
} else {
	$ReturnLinkItemId = 0;
}
if(trim(DecData($_GET["lhi"], 1, $objBF))!=''){
	$ReturnLinkHeadId = trim(DecData($_GET["lhi"], 1, $objBF));
} else {
	$ReturnLinkHeadId = 0;
}

if(trim(DecData($_GET["vhi"], 1, $objBF))!='NULL'){
	$ReturnVehicleHeadId = trim(DecData($_GET["vhi"], 1, $objBF));
} else {
	$ReturnVehicleHeadId = 0;
}
/*echo $ReturnVehicleHeadId;
die();*/
//
if($GetHeadInfo["head_type_id"] == 1){
	$CallWSet = 'col-md-2';
} elseif($GetHeadInfo["head_type_id"] == 12){
	$CallWSet = 'col-md-2';
} elseif($GetHeadInfo["head_type_id"] == 11){
	$CallWSet = 'col-md-2';
} else {
	$CallWSet = 'col-md-3';
}
?>
<?php
if($GetHeadInfo["head_type_id"] == 4 or $GetHeadInfo["head_type_id"] == 6){
  $objSSSjatlan->resetProperty();
  // $objSSSjatlan->setProperty("isActive", 1);
  $objSSSjatlan->setProperty("customer_id", $GetHeadInfo["entity_id"]);
  $objSSSjatlan->lstCustomers();
  $LedgerHeadDetail = $objSSSjatlan->dbFetchArray(1);
  //
?>
<div class="col-md-12">
              
<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
<th align="left">Full Name</th>
<th align="left">Address</th>
<th align="left">Number</th>
<th align="left">Phone</th>
<th align="left">Business</th>
    </tr>
  </thead>
  <tbody>
                  <tr>
                    <td><?php echo $LedgerHeadDetail["customer_name"];?></td>
                    <td><?php echo $LedgerHeadDetail["customer_address"];?></td>
                    <td><?php echo $LedgerHeadDetail["customer_phone"];?></td>
                    <td><?php echo $LedgerHeadDetail["customer_mobile"];?></td>
                    <td><?php echo $LedgerHeadDetail["customer_business_name"];?></td>
                  </tr>
                </tbody>
</table>


</div>




<?php } ?>
<div class="col-md-12">
  <hr>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <input type="hidden" name="i" value="<?php echo EncData(trim(DecData($_GET["i"], 1, $objBF)), 1, $objBF) ;?>">
    <input type="hidden" name="t" value="<?php echo EncData(trim(DecData($_GET["t"], 1, $objBF)), 1, $objBF) ;?>">
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
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Transaction Status</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="trans_status" title="Transaction Status" tabindex="3">
            <option value="0"<?php echo StaticDDSelection(0, $ReturnTransactionStatus);?>>All</option>
            <option value="1"<?php echo StaticDDSelection(1, $ReturnTransactionStatus);?>>Debit</option>
            <option value="2"<?php echo StaticDDSelection(2, $ReturnTransactionStatus);?>>Credit</option>
          </select>
        </div>
      </div>
    </div>
    <div class="<?php echo $CallWSet;?>">
      <div class="card-content ledger"> <code>Link Head's</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="link_head_id" title="List of Link Head's" tabindex="4">
            <option value="0"<?php echo StaticDDSelection(0, $ReturnLinkHeadId);?>>All</option>
            <?php
            $objQayadaccount->resetProperty();
            $objQayadaccount->setProperty("isActive", 1);
			$objQayadaccount->setProperty("head_type_id_array", '2,3');
            $objQayadaccount->setProperty("ORDERBY", 'head_title');
            $objQayadaccount->lstHead();
            while($ListofLinkHead = $objQayadaccount->dbFetchArray(1)){
            ?>
            <option value="<?php echo $ListofLinkHead["head_id"];?>"<?php echo StaticDDSelection($ListofLinkHead["head_id"], $ReturnLinkHeadId);?>><?php echo $ListofLinkHead["head_title"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <?php if($GetHeadInfo["head_type_id"] == 12){ ?>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Vehicle#</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="vehivle_head_id" title="List of Vehicle Head's" tabindex="4">
            <option value="0"<?php echo StaticDDSelection(0, $ReturnLinkHeadId);?>>All</option>
            <?php
            $objQayadaccount->resetProperty();
            $objQayadaccount->setProperty("isActive", 1);
			$objQayadaccount->setProperty("head_type_id", 7);
            $objQayadaccount->setProperty("ORDERBY", 'head_title');
            $objQayadaccount->lstHead();
            while($ListofLinkHead = $objQayadaccount->dbFetchArray(1)){
            ?>
            <option value="<?php echo $ListofLinkHead["head_id"];?>"<?php echo StaticDDSelection($ListofLinkHead["head_id"], $ReturnLinkHeadId);?>><?php echo $ListofLinkHead["head_title"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <?php } if($GetHeadInfo["head_type_id"] == 11){ ?>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Vehicle#</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" name="vehivle_head_id" title="List of Vehicle Head's" tabindex="4">
            <option value="0"<?php echo StaticDDSelection(0, $ReturnVehicleHeadId);?>>All</option>
            <?php
            $objQayadaccount->resetProperty();
            $objQayadaccount->setProperty("isActive", 1);
			$objQayadaccount->setProperty("head_type_id", 7);
            $objQayadaccount->setProperty("ORDERBY", 'head_title');
            $objQayadaccount->lstHead();
            while($ListofLinkHead = $objQayadaccount->dbFetchArray(1)){
            ?>
            <option value="<?php echo $ListofLinkHead["head_id"];?>"<?php echo StaticDDSelection($ListofLinkHead["head_id"], $ReturnVehicleHeadId);?>><?php echo $ListofLinkHead["head_title"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>
    <?php }if($GetHeadInfo["head_option"] == 2){ ?>
    <div class="col-md-2">
      <div class="card-content ledger"> <code>Link Item's</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" name="link_item_id" title="List of Link Head Item's" tabindex="5">
            <option value="0"<?php echo StaticDDSelection(0, $ReturnLinkItemId);?>>All</option>
            <?php
			$objQayadaccountHeadItems = new Qayadaccount;
           /* $objQayadaccount->resetProperty();
			$objQayadaccount->setProperty("isActive", 1);
            $objQayadaccount->setProperty("head_option", 2);
            $objQayadaccount->setProperty("ORDERBY", 'head_title');
            $objQayadaccount->lstHead();
            while($ListofMainHeads = $objQayadaccount->dbFetchArray(1)){*/
				
				$objQayadaccountHeadItems->setProperty("isActive", 1);
				$objQayadaccountHeadItems->setProperty("head_id", $GetHeadInfo["head_id"]);
				$objQayadaccountHeadItems->setProperty("ORDERBY", 'item_title');
				$objQayadaccountHeadItems->lstHeadItems();
				while($ListofHeadItems = $objQayadaccountHeadItems->dbFetchArray(1)){
            ?>
            <option value="<?php echo $ListofHeadItems["item_id"];?>"<?php echo StaticDDSelection($ListofHeadItems["item_id"], $ReturnLinkItemId);?>><?php echo $ListofHeadItems["item_title"];?></option>
            <?php } //}?>
          </select>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="col-md-2">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Filter Now</button>
        </div>
      </div>
    </div>
  </form>
  
  
  <?php if(trim(DecData($_GET["md"], 1, $objBF)) == 'search'){

	  if($ReturnLinkHeadId != 0){
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_id", $ReturnLinkHeadId);
		$objQayadaccount->lstHead();
		$ListofLinkHead = $objQayadaccount->dbFetchArray(1);
	  }
	  if($ReturnLinkItemId != 0){
	  	$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("item_id", $ReturnLinkItemId);
		$objQayadaccount->lstHeadItems();
		$ListofHeadItems = $objQayadaccount->dbFetchArray(1);
	  }
	  ?>
  <div class="col-md-12">
  <hr />
  <h4 class="card-title CardWidth"><code>Selected Filter</code></h4>
   <div class="col-md-12">
    <div class="card-content ledger"> 
    
    <div class="col-md-2"><code>Start Date</code><br /><?php echo $ReturnStartDate;?></div>  
    
    <div class="col-md-2"><code>End Date</code><br /><?php echo $ReturnEndDate;?></div>  
    
    <div class="col-md-2"><code>Transaction Status</code><br /><?php 
  						if($ReturnTransactionStatus == 0){
							echo 'All';
						} elseif($ReturnTransactionStatus == 1){
							echo 'Debit';
							} elseif($ReturnTransactionStatus == 2){
								echo 'Credit';
						}?></div>  
    
    <div class="col-md-2"><code>Link Head's</code><br /><?php echo $ListofLinkHead["head_title"];?></div>  
    
    <div class="col-md-2"><code>Link Item's</code><br /><?php echo $ListofHeadItems["item_title"];?></div>  
    
    <div class="col-md-2"><a href="<?php echo Route::_('show=ledgerheaddetail&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&t='.EncData(trim(DecData($_GET["t"], 1, $objBF)), 2, $objBF));?>" class="btn btn-success btn-round" style="margin-top:0px !important; padding:10px;">Reset</a></div>  
    
    
    </div>
    </div>
  </div>
  
  <?php } ?>
  
  
</div>
<?php 
if(trim(DecData($_GET["t"], 1, $objBF)) == 'CD'){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->setProperty("head_type_id", 4);
$objQayadaccount->setProperty("pay_mode", 9);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
//print_r($CashHeadStatus);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 'SD'){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 6);
$objQayadaccount->setProperty("pay_mode", 9);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} else {
if($GetHeadInfo["head_type_id"] == 1){
$objQayadaccount->resetProperty();
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->VwGeneralItemStatus();
$TotalAmount = 0;
while($GeneralAccountStatus = $objQayadaccount->dbFetchArray(1)){
	$CashHeadTotal += $GeneralAccountStatus["total_credit"] - $GeneralAccountStatus["total_debit"];
}
echo '<code>Total Amount: '.Numberformt($CashHeadTotal).'</code>';
} elseif($GetHeadInfo["head_type_id"] == 2){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->setProperty("head_type_id", 2);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotalCredit"] - $CashHeadStatus["TotaDebit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 3){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->setProperty("head_type_id", 3);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotalCredit"] - $CashHeadStatus["TotaDebit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 4){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->setProperty("head_type_id", 4);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
//print_r($CashHeadStatus);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 5){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 5);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 6){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 6);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 7){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 7);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 8){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 8);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 10){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 10);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 11){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 11);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 12){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 12);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/
} elseif($GetHeadInfo["head_type_id"] == 13){
/*********************************************************************************/
/*********************************************************************************/
$objQayadaccount->resetProperty();
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
//$objQayadaccount->VwCashHead();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_type_id", 13);
$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotaDebit"] - $CashHeadStatus["TotalCredit"];
echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
/*********************************************************************************/
/*********************************************************************************/}

}
?>
