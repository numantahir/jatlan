<?php include_once(ACTION_PATH.'script.php'); ?>
<style>
html, body {
	overflow-x: inherit;
}
body {
	margin: auto;
	padding: 0px;
	margin-top: 0px;
	border: 0px solid #eee;
	font-size: 12px;
	/*font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;*/
	font-family: system-ui;
	color: #000;
}
h4 {
	font-size: 20px;
	letter-spacing: 1px;
	font-weight: 600;
	margin-bottom: 5px;
}
.customer_ledgerTable{
	width: 100%;
	font-size: 10px;
}
.customer_ledgerTable th {
	font-size: 10px;
	font-weight: 600;
	background-color: #EBEBEB;
	line-height: 20px;
	border-bottom: solid 1px #999999;
}
.customer_ledgerTable td {
	font-size: 09px;
	line-height:normal;
	border-bottom: solid 1px #CCCCCC;
}
.ledgerTable {
	width: 100%;
	font-size: 12px;
}
.ledgerTable th {
	font-size: 12px;
	font-weight: 700;
	background-color: #EBEBEB;
	line-height: 20px;
	border-bottom: solid 1px #999999;
}
.ledgerTable td {
	font-size: 11px;
	line-height: 20px;
	border-bottom: solid 1px #CCCCCC;
}
.RightBorder {
	border-right: solid 1px #EEEEEE;
}
.titlefontsize {
	font-size: 10px !important;
	padding-left: 5px !important;
}
.btheading {
	font-weight: 600 !important;
	background-color: #CCC;
}
.btheading_last {
	font-weight: 600 !important;
	background-color: #999;
	color: #FFF !important;
}
</style>
<?php 
// echo 't->'.trim(DecData($_GET["t"], 1, $objBF)).'<br>';
// echo 'vi->'.trim(DecData($_GET["vi"], 1, $objBF)).'<br>';
// echo 'i->'.trim(DecData($_GET["i"], 1, $objBF));
//die();

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


function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
        'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
    );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
        'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
        'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
    );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . ucfirst($list1[$hundreds]) . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . ucfirst($list1[$tens]) . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    return implode(' ', $words);
}
$objSSSVehicleNo = new SSSjatlan;
$objQayadaccount->resetProperty();
$objQayadaccount->setProperty("isActive", 1);
$objQayadaccount->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadaccount->setProperty("ORDERBY", 'head_title');
$objQayadaccount->lstHead();
$GetHeadInfo = $objQayadaccount->dbFetchArray(1);
$MainHeadTitle = $GetHeadInfo["head_title"];

//$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
// echo $GetHeadInfo["head_type_id"];
// die();
//1=>General, 2=>Cash, 3=>Back Account, 4=>Customer, 5=>Employee, 6=>Vendors, 7=>Vehicle, 8=>Unloading
?>
<?php
if($GetHeadInfo["head_type_id"] == 4 or $GetHeadInfo["head_type_id"] == 6){
  $objSSSjatlan->resetProperty();
  // $objSSSjatlan->setProperty("isActive", 1);
  $objSSSjatlan->setProperty("customer_id", $GetHeadInfo["entity_id"]);
  $objSSSjatlan->lstCustomers();
  $LedgerHeadDetail = $objSSSjatlan->dbFetchArray(1);
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4" align="center"><img src="../assets_ig/img/app-logo-print.png" width="200" /><br /></td>
  </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  <?php if($GetHeadInfo["head_type_id"] == 4 or $GetHeadInfo["head_type_id"] == 6){ ?>
  <tr>
    <td width="12%" align="right"><code>Business:&nbsp;</code><br />
      <code>Full Name:&nbsp;</code><br>
      <code>Address:&nbsp;</code><br>
      <code>Number:&nbsp;</code><br>
      <code>Phone:&nbsp;</code><br>
	</td>
    <td width="54%" align="left"><code><?php echo $MainHeadTitle;?><br />
       <?php echo $LedgerHeadDetail["customer_name"];?><br>
	   <?php echo $LedgerHeadDetail["customer_address"];?><br>
	   <?php echo $LedgerHeadDetail["customer_phone"];?><br>
	   <?php echo $LedgerHeadDetail["customer_mobile"];?><br>
	
	</code></td>
    <td width="15%" align="right">
	<code>Code:&nbsp;</code><br>	
	<code>Print Date:&nbsp;</code><br />
      <code>&nbsp;&nbsp;Print By:&nbsp; </code></td>
    <td width="19%" align="left"><code><?php echo $GetHeadInfo["head_code"];?><br><?php echo date("d-M-Y");?><br />
      <?php echo $objQayaduser->fullname;?></code></td>
  </tr>

  <?php } else { ?>
	<tr>
    <td width="12%" align="right"><code>Business:&nbsp;</code><br />
      <code>Code:&nbsp;</code>
	</td>
    <td width="54%" align="left"><code><?php echo $MainHeadTitle;?><br />
	<?php echo $GetHeadInfo["head_code"];?>
	</code></td>
    <td width="15%" align="right">
	<code>Print Date:&nbsp;</code><br />
      <code>&nbsp;&nbsp;Print By:&nbsp; </code></td>
    <td width="19%" align="left"><code><?php echo date("d-M-Y");?><br />
      <?php echo $objQayaduser->fullname;?></code></td>
  </tr>
  <?php } if(trim(DecData($_GET["md"], 1, $objBF)) == 'search'){ 
  		
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
  <tr>
    <td align="right"><code>Txn Status:&nbsp;</code><br />
      <code>Link Head:&nbsp;</code></td>
    <td align="left"><code>
      <?php 
  						if($ReturnTransactionStatus == 0){
							echo 'All';
						} elseif($ReturnTransactionStatus == 1){
							echo 'Debit';
							} elseif($ReturnTransactionStatus == 2){
								echo 'Credit';
						}?>
      </code><code><br />
      <?php echo $ListofLinkHead["head_title"];?></code><br /></td>
    <td align="right"><code>Start Date:</code><code>&nbsp;</code><br />
      <code>End Date:&nbsp; </code></td>
    <td align="left"><code><?php echo $ReturnStartDate;?></code><br />
      <code><?php echo $ReturnEndDate;?></code></td>
  </tr>
  <?php } ?>
  <?php
  $objQayadaccountDetail = new Qayadaccount;
if($GetHeadInfo["head_type_id"] == 4){
$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();
					$GetOpendingBalance = $objQayadaccountDetail->dbFetchArray(1);
					$FilterBase_Trans_amount = $GetOpendingBalance["trans_amount"];
						$LastTransaction_id = $GetOpendingBalance["transaction_id"];



						$objQayadaccountDetail->resetProperty();
						if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
						$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
						}
						if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
						$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
						}
						if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
						$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
						}
						if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
						$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
						}
						//ReturnLinkHeadId
						$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
						//}
						$objQayadaccountDetail->setProperty("last_transaction", $LastTransaction_id);
						$objQayadaccountDetail->setProperty("isActive", 1);
						$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date DESC');
						$Last_TransactionAmount = 0;
						$objQayadaccountDetail->lstAccountTransaction();
						while($GetLastTransactionAmount = $objQayadaccountDetail->dbFetchArray(1)){
							//echo $GetLastTransactionAmount["trans_amount"];
						if($GetHeadInfo["head_type_id"] == 2){
						
							if($GetLastTransactionAmount["trans_mode"] == 2){
								$Last_TransactionAmount = $Last_TransactionAmount + $GetLastTransactionAmount["trans_amount"];
							} else {
								$Last_TransactionAmount = $Last_TransactionAmount - $GetLastTransactionAmount["trans_amount"];
							}
								
							} elseif($GetHeadInfo["head_type_id"] == 3){
							
							if($GetLastTransactionAmount["trans_mode"] == 2){
								$Last_TransactionAmount = $Last_TransactionAmount + $GetLastTransactionAmount["trans_amount"];
							} else {
								$Last_TransactionAmount = $Last_TransactionAmount - $GetLastTransactionAmount["trans_amount"];
							}
								
							} else {
								
							if($GetLastTransactionAmount["trans_mode"] == 2){
								$Last_TransactionAmount = $Last_TransactionAmount - $GetLastTransactionAmount["trans_amount"];
							} else {
								$Last_TransactionAmount = $Last_TransactionAmount + $GetLastTransactionAmount["trans_amount"];
							}
							
							}

						//$Last_TransactionAmount = $GetLastTransactionAmount["trans_amount"];
					}
				} elseif($GetHeadInfo["head_type_id"] == 6){
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
						$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
						$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
						$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
						}
						if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
						$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
						}
						if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
						$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
						}
						if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
						$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
						}
						if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
						$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
						}
						//ReturnLinkHeadId
						$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
						//}
						//$objQayadaccountDetail->setProperty("limit", '2');
						$objQayadaccountDetail->setProperty("isActive", 1);
						$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
	
						$objQayadaccountDetail->lstAccountTransaction();
						$GetOpendingBalance = $objQayadaccountDetail->dbFetchArray(1);
						$FilterBase_Trans_amount = $GetOpendingBalance["trans_amount"];
						$LastTransaction_id = $GetOpendingBalance["transaction_id"];



						$objQayadaccountDetail->resetProperty();
						if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
						$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
						}
						if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
						$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
						}
						if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
						$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
						}
						if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
						$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
						}
						//ReturnLinkHeadId
						$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
						//}
						$objQayadaccountDetail->setProperty("last_transaction", $LastTransaction_id);
						$objQayadaccountDetail->setProperty("isActive", 1);
						$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date DESC');
	
						$objQayadaccountDetail->lstAccountTransaction();
						while($GetLastTransactionAmount = $objQayadaccountDetail->dbFetchArray(1)){
							//echo $GetLastTransactionAmount["trans_amount"];
						if($GetHeadInfo["head_type_id"] == 2){
						
							if($GetLastTransactionAmount["trans_mode"] == 2){
								$Last_TransactionAmount = $Last_TransactionAmount + $GetLastTransactionAmount["trans_amount"];
							} else {
								$Last_TransactionAmount = $Last_TransactionAmount - $GetLastTransactionAmount["trans_amount"];
							}
								
							} elseif($GetHeadInfo["head_type_id"] == 3){
							
							if($GetLastTransactionAmount["trans_mode"] == 2){
								$Last_TransactionAmount = $Last_TransactionAmount + $GetLastTransactionAmount["trans_amount"];
							} else {
								$Last_TransactionAmount = $Last_TransactionAmount - $GetLastTransactionAmount["trans_amount"];
							}
								
							} else {
								
							if($GetLastTransactionAmount["trans_mode"] == 2){
								$Last_TransactionAmount = $Last_TransactionAmount - $GetLastTransactionAmount["trans_amount"];
							} else {
								$Last_TransactionAmount = $Last_TransactionAmount + $GetLastTransactionAmount["trans_amount"];
							}
							
							}
						}

				}

  ?>
  <tr>
    <td align="right"></td>
    <td align="left"></td>
    <td align="right"><code>Opening Balance:</code></td>
	<td align="left">  <code><?php echo Numberformt($Last_TransactionAmount);?></code></td>
  </tr>

  <tr>
    <td colspan="4"><hr /></td>
  </tr>
</table>

<?php
if($GetHeadInfo["head_type_id"] == 4){?>
<table class="customer_ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
<th width="6%" align="left">Date</th>
<th width="6%" align="left">Txn#</th>
<th width="13%" align="left">Description</th>
<th width="7%" align="left">Vehicle#</th>
<th width="5%" align="left">Qty</th>
<th width="7%" align="left">Rate</th>
<th width="9%" align="left">L/Charges</th>
<th width="8%" align="left">D/Charges</th>
<th width="11%" align="left">Location</th>
<th width="9%" align="left">Debit</th>
<th width="9%" align="left">Credit</th>
<th width="10%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>

  <tr>
                  
                    
                    <td>-</td>
					<td>-</td>
                    <td>Opening Balance</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
                    <td><?php echo Numberformt($Last_TransactionAmount);?></td>
                  </tr>
                  <?php
				  //$Last_TransactionAmount
					$BalanceAmount = $Last_TransactionAmount;
					
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSLocationGet = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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
							/*
							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							} */
							
							if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["transfer_head_id"] != ''){
									$objQayadaccountLinkHead->resetProperty();
									$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
									$objQayadaccountLinkHead->lstHead();
									$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
									$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}
							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSLocationGet->resetProperty();
								$objSSSLocationGet->setProperty("location_id", $OrderRequestLocation["destination_id"]);
								$objSSSLocationGet->setProperty("isActive", 1);
								$objSSSLocationGet->lstLocation();
								$GetLocation = $objSSSLocationGet->dbFetchArray(1);
								$LinkHeadTitle = $GetLocation["location_name"];
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							if($LedgerHeadDetails["entery_id"] != '' && $LedgerHeadDetails["trans_type"] == 9){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstOrderRequestDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);
							
							//$objSSSVehicleNo
							//lstVehicle
							$objSSSVehicleNo->resetProperty();
							$objSSSVehicleNo->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehicleNo->setProperty("isActive", 1);
							$objSSSVehicleNo->lstVehicle();
							$GetVehicleNumber = $objSSSVehicleNo->dbFetchArray(1);
								$ShowExtraTextoption = 1;
								$VehicleNo = $GetVehicleNumber["vehicle_number"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
							} else {
								$ShowExtraTextoption = 0;	
								$VehicleNo = "-";
								$TotalOrderQty = "-";
								$PerItemRateCharge = "-";
								$LaberCharges  = "-";
								$DeliverCharges  = "-";
								$TotalAmount = "-";
							}
							if($LedgerHeadDetails["trans_mode"] == 1){
								$LaberCharges  = "-";
							} else {
								$LaberCharges  = $OrderRequest["unloading_price"];
							}
                    ?>
                  <tr>
                    <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php 
					
					if($LedgerHeadDetails["pay_mode"] == 1){
						echo $LedgerHeadDetails["trans_title"].$TransferHeadName;
					
					if($LedgerHeadDetails["trans_note"] != ''){
						echo '<br>'.$LedgerHeadDetails["trans_note"];	
					}
					
					if($LedgerHeadDetails["pay_mode"] != 1){
						
						echo '<br> '.$TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					} elseif($LedgerHeadDetails["pay_mode"] == 2 or $LedgerHeadDetails["pay_mode"] == 3  or $LedgerHeadDetails["pay_mode"] == 4 or $LedgerHeadDetails["pay_mode"] ==5 or $LedgerHeadDetails["pay_mode"] ==6){
						echo $TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					} elseif($LedgerHeadDetails["pay_mode"] == 8){
						echo $LedgerHeadDetails["trans_title"].$TransferHeadName;
					} else {
					echo $LedgerHeadDetails["trans_title"].$TransferHeadName;
					
					if($LedgerHeadDetails["trans_note"] != ''){
						echo '<br>'.$LedgerHeadDetails["trans_note"];	
					}
					
					if($LedgerHeadDetails["pay_mode"] != 1){
						
						echo '<br> '.$TransferHeadTitle.' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					}
					
					
					?></td>
                    
                    <td><?php echo $VehicleNo;?></td>
                     <td><?php if($LedgerHeadDetails["aplic_mode"] !=3){ echo $TotalOrderQty;}?></td>
                    <td><?php if($LedgerHeadDetails["aplic_mode"] !=3){ echo $PerItemRateCharge;}?></td>
                    <td><?php if($LedgerHeadDetails["aplic_mode"] !=3 && $LedgerHeadDetails["pay_mode"] != 6){ echo $LaberCharges;}?></td>
                    <td><?php if($LedgerHeadDetails["aplic_mode"] !=3){ echo $DeliverCharges;}?></td>
                    
                    <td><?php 
					if($LedgerHeadDetails["pay_mode"] == 8){
						echo $LinkHeadTitle;
					} else {
					echo PaymentOption($LedgerHeadDetails["pay_mode"]);
					
					}?></td>
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
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                   <?php } ?>
                  <tr>
      <td colspan="13" align="center" class="RightBorder"><hr /></td>
    </tr>
                  <tr>
                    <td colspan="9" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
                    <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
                  </tr>
                    <tr>
      <td colspan="13" align="center" class="RightBorder"><hr /></td>
    </tr>
                 
                  
                  
                </tbody>
</table>
<?php } elseif($GetHeadInfo["head_type_id"] == 6){?>
<table class="customer_ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th align="left">Date</th>
            <th align="left">Inv#</th>
            <th align="left">COF#</th>
            <th align="left">Vehicle#</th>
            <th align="left">Area</th>
            <th align="left">Qty</th>
            <th align="left">Rate</th>
            <th align="left">Debit</th>
            <th align="left">Credit</th>
            <th align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
	<tr>
  <td>-</td>
                     <td>-</td>
                    <td>Opening Balance</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
					<td>-</td>
                    <td><?php echo Numberformt($Last_TransactionAmount);?></td>
                  </tr>
                  <?php
					$BalanceAmount = $Last_TransactionAmount;
					
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSDestination = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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
							/*
							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							} */
							
							if($LedgerHeadDetails["pay_mode"] != 1 && $LedgerHeadDetails["transfer_head_id"] != ''){
									$objQayadaccountLinkHead->resetProperty();
									$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
									$objQayadaccountLinkHead->lstHead();
									$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
									$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}
							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							if($LedgerHeadDetails["entery_id"] != '' && $LedgerHeadDetails["trans_type"] == 9){
							$objSSSjatlan->resetProperty();
							$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["entery_id"]);
							$objSSSjatlan->setProperty("isActive", 1);
							$objSSSjatlan->lstOrderRequestDetail();
							$OrderRequest = $objSSSjatlan->dbFetchArray(1);
							
							
							//$objSSSVehicleNo
							//lstVehicle
							$objSSSVehicleNo->resetProperty();
							$objSSSVehicleNo->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehicleNo->setProperty("isActive", 1);
							$objSSSVehicleNo->lstVehicle();
							$GetVehicleNumber = $objSSSVehicleNo->dbFetchArray(1);
							
							//Destination Detail
							//$objSSSDestination
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->setProperty("isActive", 1);
							$objSSSDestination->lstLocation();
							$GetDestinationDetail = $objSSSDestination->dbFetchArray(1);
							
							
							
								$ShowExtraTextoption = 1;
								$VehicleNo = $GetVehicleNumber["vehicle_number"];
								$TotalOrderQty = $OrderRequest["no_of_items"];
								$PerItemRateCharge = $OrderRequest["per_item_amount"];
								$LaberCharges  = $OrderRequest["unloading_price"];
								$DeliverCharges  = $OrderRequest["delivery_chagres"];
								$TotalAmount = Numberformt($LedgerHeadDetails["trans_amount"]);
								
								$FinalDestinaitonDetail = $GetDestinationDetail["location_name"];
								$TransactionInvoiceNo = $OrderRequest["d_invoice_no"];
								$cof_no = $OrderRequest["cof_no"];
								
							} else {
								$ShowExtraTextoption = 0;	
								$VehicleNo = "-";
								$TotalOrderQty = "-";
								$PerItemRateCharge = "-";
								$LaberCharges  = "-";
								$DeliverCharges  = "-";
								$TotalAmount = "-";
								$FinalDestinaitonDetail = "-";
								$TransactionInvoiceNo = $LedgerHeadDetails["transaction_number"];
								$cof_no = "-";
							}
                    ?>
                  <tr>
                    <td><?php echo dateFormate_13($LedgerHeadDetails["trans_date"]);?></td>
                    <td><?php echo $TransactionInvoiceNo;?></td>
                    <td><?php echo $cof_no;?></td>
                    <td><?php echo $VehicleNo;?></td>
                    <td><?php echo $FinalDestinaitonDetail; ?></td>
                    <td><?php echo $TotalOrderQty;?></td>
                    <td><?php echo $PerItemRateCharge;?></td>
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
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                   <?php } ?>
                  <tr>
      <td colspan="10" align="center" class="RightBorder"><hr /></td>
    </tr>
                  <tr>
                    <td colspan="7" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
                    <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
                  </tr>
                    <tr>
      <td colspan="10" align="center" class="RightBorder"><hr /></td>
    </tr>
                 
                  
                  
                </tbody>
</table>
<?php } elseif($GetHeadInfo["head_type_id"] == 3){?>
<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Date</th>
                    <th align="left">Transaction #</th>
                    <th align="left">Particular</th>
                    <th align="left">Description</th>
					<th align="left">Debit</th>
                   	<th align="left">Credit</th>
                    <th align="left">Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objQayadHeadDetail = new Qayadaccount;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
                    while($LedgerHeadDetails = $objQayadaccountDetail->dbFetchArray(1)){
						
						
						//1=>General, 2=>Cash, 3=>Back Account, 4=>Customer, 5=>Employee, 6=>Vendors, 7=>Vehicle, 8=>Unloading, 9=>Vehicle Item Head
						if($LedgerHeadDetails["transfer_head_id"] != ''){
						$objQayadHeadDetail->resetProperty();
						$objQayadHeadDetail->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
						$objQayadHeadDetail->lstHead();
						$TransactionHeadDetail = $objQayadHeadDetail->dbFetchArray(1);
							
							if($TransactionHeadDetail["head_type_id"] == 1){
							// General Item
								if($LedgerHeadDetails["transfer_item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
								$TranTypeMode = 'General Item: '.$TransferHeadName;
							
							} elseif($TransactionHeadDetail["head_type_id"] == 9){
							//Vehicle Item Transfer
							
								if($LedgerHeadDetails["transfer_item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
								$TranTypeMode = 'Vehicle Item: '.$TransferHeadName;
							
							} elseif($TransactionHeadDetail["head_type_id"] == 3){
							//Bank to Bank Transfer
							$TranTypeMode = 'Bank to Bank:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 4){
							//Customer Transfer
							$TranTypeMode = 'Customer:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 5){
							//Employee Transfer
							$TranTypeMode = 'Employee:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 6){
							//Vendor Transfer
							$TranTypeMode = 'Vendor:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 7){
							//Vehicle Transfer
							$TranTypeMode = 'Vehicle:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 8){
							//Unloader Transfer
							$TranTypeMode = 'Unloader:'.$TransactionHeadDetail["head_title"];
							} elseif($TransactionHeadDetail["head_type_id"] == 2){
							//Vehicle Item Transfer
							$TranTypeMode = 'Cash:'.$TransactionHeadDetail["head_title"];
							} else {
							$TranTypeMode = ' - '.$TransactionHeadDetail["head_title"];	
							}
						
						
						}
						
						
						
						
						
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

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $TranTypeMode;?></td>
                    <td><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
<?php } elseif($GetHeadInfo["head_type_id"] == 7){
	
//$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
?>

<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th align="left">Date</th>
      <th align="left">Destination</th>
      <th align="left">Qty</th>
      <th align="left">Freight/Bag</th>
      <th align="left">Feright Amount</th>
	  <th align="left">Diesle</th>
      <th align="left">Mobil Oil</th>
      <!--<th align="left">Tyre</th>-->
      <?php
	  
	  	$objQayadaccountItemsList = new Qayadaccount;
	 	$objQayadaccountItemsList->resetProperty();
		$objQayadaccountItemsList->setProperty("isActive", 1);
		$objQayadaccountItemsList->setProperty("item_id", 1);
		$objQayadaccountItemsList->setProperty("ORDERBY", 'item_id');
		$objQayadaccountItemsList->lstHeadItems();
		while($ListOfVehicleItems = $objQayadaccountItemsList->dbFetchArray(1)){
	  ?>
      <th align="left"><?php echo $ListOfVehicleItems["item_title"];?></th>
      <?php }  ?>
    </tr>
  </thead>
  <tbody>
   <?php   
					$Misc_Exp = 0;
					$Diesel = 0;
					$MobOil = 0;
					$TotalDeliveryCharges = 0;
					$TotalDiesleCharges = 0;
					$TotalMobilOilCharges = 0;
					$TotalTyreCharges = 0;
					$MiscExpensDaily = 0;
					$objSSSDestination = new SSSjatlan;
					$objSSSVehicleNo = new SSSjatlan;
					$objQayadaccountItemsList = new Qayadaccount;
					$objQayadaccountDetail = new Qayadaccount;
					
					$DieselExpenseArray = '';
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 10);
					$objQayadaccount->setProperty("ORDERBY", 'head_title');
					$objQayadaccount->lstHead();
					while($Diesel_ExpenseID = $objQayadaccount->dbFetchArray(1)){
						$DieselExpenseArray .= $Diesel_Comma.$Diesel_ExpenseID['head_id'];
						$Diesel_Comma = ','; 
					}
					//echo $Diesel_ExpenseID["head_id"];
					
					$MobilOilExp_Array = '';
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 11);
					$objQayadaccount->setProperty("ORDERBY", 'head_title');
					$objQayadaccount->lstHead();
					while($MobilOil_ExpenseID = $objQayadaccount->dbFetchArray(1)){
						$MobilOilExp_Array .= $MobilOil_Comma.$MobilOil_ExpenseID['head_id'];
						$MobilOil_Comma = ','; 
					}
					
					$tyreexp_head_id = '';
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 12);
					$objQayadaccount->setProperty("ORDERBY", 'head_title');
					$objQayadaccount->lstHead();
					while($Tyre_ExpenseID = $objQayadaccount->dbFetchArray(1)){
						$tyreexp_head_id .= $comma.$Tyre_ExpenseID['head_id'];
						$comma = ','; 
					}
					
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'd_date');
					$objSSSjatlan->setProperty("isActive", 1);
					if($_GET["sd"] != ''){
					$objSSSjatlan->setProperty("DATEFILTER", 'YES');
					$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					$objSSSjatlan->setProperty("vehicle_id", trim(DecData($_GET["vi"], 1, $objBF)));
					$objSSSjatlan->setProperty("order_request_type_array", '2,3');
					$objSSSjatlan->setProperty("order_process_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
							
							$objSSSDestination->resetProperty();
							$objSSSDestination->setProperty("location_id", $OrderRequest["destination_id"]);
							$objSSSDestination->lstLocation();
							$DestinationInfo = $objSSSDestination->dbFetchArray(1);
							
							$objSSSVehicleNo->resetProperty();
							$objSSSVehicleNo->setProperty("vehicle_id", $OrderRequest["vehicle_id"]);
							$objSSSVehicleNo->lstVehicle();
							$VehicleInfo = $objSSSVehicleNo->dbFetchArray(1);
					
						$TotalDeliveryCharges += $OrderRequest["delivery_chagres"];
						
		$Diesel_Expense_amount = 0;
		$MobilOil_Expense_amount = 0;
		$Tyre_Expense_amount = 0;
		
		/*************************************************************************************************************/
		/*************************************************************************************************************/
		/*************************************************************************************************************/
		//Diesel Expense
		//echo $OrderRequest["order_request_id"].' >> '.trim(DecData($_GET["vi"], 1, $objBF)).' >>> '.$Diesel_ExpenseID["head_id"];
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		} else {
		$objQayadaccountDetail->setProperty("trans_mode", 1);	
		}
		$objQayadaccountDetail->setProperty("location_id", $OrderRequest["order_request_id"]);
		$objQayadaccountDetail->setProperty("entery_id", trim(DecData($_GET["vi"], 1, $objBF)));
		//$objQayadaccountDetail->setProperty("head_id", $Diesel_ExpenseID["head_id"]);
		$objQayadaccountDetail->setProperty("head_id_array", $DieselExpenseArray);
		$objQayadaccountDetail->setProperty("isActive", 1);
		
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($ExpenseDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($ExpenseDetails["trans_mode"] == 1){
				$Diesel_Expense_amount += $ExpenseDetails["trans_amount"];
				$TotalDiesleCharges += $ExpenseDetails["trans_amount"];
			} else {
				$Diesel_Expense_amount += 0;
			}
		}	
        /*************************************************************************************************************/
		/*************************************************************************************************************/
		/*************************************************************************************************************/
		//Mobil Oil Expense
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		} else {
		$objQayadaccountDetail->setProperty("trans_mode", 1);	
		}
		$objQayadaccountDetail->setProperty("location_id", $OrderRequest["order_request_id"]);
		$objQayadaccountDetail->setProperty("entery_id", trim(DecData($_GET["vi"], 1, $objBF)));
		//$objQayadaccountDetail->setProperty("head_id", $MobilOil_ExpenseID["head_id"]);
		$objQayadaccountDetail->setProperty("head_id_array", $MobilOilExp_Array);
		$objQayadaccountDetail->setProperty("isActive", 1);
		
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($MobilOilDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($MobilOilDetails["trans_mode"] == 1){
				$MobilOil_Expense_amount += $MobilOilDetails["trans_amount"];
				$TotalMobilOilCharges += $MobilOilDetails["trans_amount"];
			} else {
				$MobilOil_Expense_amount += 0;
			}
		}	  
		/*************************************************************************************************************/
		/*************************************************************************************************************/
		/*************************************************************************************************************/
		// Tyre Expense
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		} else {
		$objQayadaccountDetail->setProperty("trans_mode", 1);	
		}
		$objQayadaccountDetail->setProperty("location_id", $OrderRequest["order_request_id"]);
		$objQayadaccountDetail->setProperty("entery_id", trim(DecData($_GET["vi"], 1, $objBF)));
		//$objQayadaccountDetail->setProperty("head_id", $Tyre_ExpenseID["head_id"]);
		$objQayadaccountDetail->setProperty("head_id_array", $tyreexp_head_id);
		$objQayadaccountDetail->setProperty("isActive", 1);
		
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($TyreExpDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($TyreExpDetails["trans_mode"] == 1){
				//$MobilOil_Expense_amount += $MobilOilDetails["trans_amount"];
				$TotalTyreCharges += $TyreExpDetails["trans_amount"];
				$Tyre_Expense_amount += $TyreExpDetails["trans_amount"];
			} else {
				//$MobilOil_Expense_amount += 0;
			}
		}	 
		
		            ?>
    <tr>
      <td align="left" class="RightBorder"><?php echo dateFormate_4($OrderRequest["d_date"]);?></td>
      <td align="left" class="RightBorder"><?php echo $DestinationInfo["location_name"];?></td>
      <td align="left" class="RightBorder"><?php echo $OrderRequest["no_of_items"];?></td>
      <td align="left" class="RightBorder"><?php echo Numberformt($OrderRequest["delivery_chagres"] / $OrderRequest["no_of_items"]);?></td>
      <td align="left" class="RightBorder"><?php echo Numberformt($OrderRequest["delivery_chagres"]);?></td>
      
      <td align="left"><?php echo Numberformt($Diesel_Expense_amount);?></td>
      <td align="left"><?php echo Numberformt($MobilOil_Expense_amount);?></td>
      <!--<td align="left" class="RightBorder"><?php //echo Numberformt($Tyre_Expense_amount);?></td>-->
      <?php
	    
	 	$objQayadaccountItemsList->resetProperty();
		$objQayadaccountItemsList->setProperty("isActive", 1);
		$objQayadaccountItemsList->setProperty("item_id", 1);
		$objQayadaccountItemsList->setProperty("ORDERBY", 'item_id');
		$objQayadaccountItemsList->lstHeadItems();
		while($ListOfVehicleItems = $objQayadaccountItemsList->dbFetchArray(1)){
			
		
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		//$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("trans_type", 2);
		$objQayadaccountDetail->setProperty("trans_mode", 1);
		$objQayadaccountDetail->setProperty("isActive", 1);
		//$objQayadaccountDetail->setProperty("trans_date", $OrderRequest["d_date"]);
		$objQayadaccountDetail->setProperty("transfer_head_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("transfer_item_id", $ListOfVehicleItems['item_id']);
		$objQayadaccountDetail->setProperty("location_id", $OrderRequest["order_request_id"]);
		$objQayadaccountDetail->lstAccountTransaction();
		while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
		//echo $LedgerItemList["isActive"];
		if($ListOfVehicleItems['item_id'] ==1){
			$MiscExpensDaily +=  $LedgerItemList["trans_amount"];
			$Misc_Exp += $LedgerItemList["trans_amount"];
		}
		}
	  ?>
      <td align="left" class="RightBorder"><?php echo Numberformt($MiscExpensDaily);?></td>
      <?php }  ?>
    </tr>
    <?php 
	$MiscExpensDaily = 0;
	} ?>
    <tr>
      <th align="left" class="RightBorder" colspan="4">&nbsp;</th>
      <th align="left" class="RightBorder"><?php echo Numberformt($TotalDeliveryCharges);?></th>
      <th align="left" class="RightBorder"><?php echo Numberformt($TotalDiesleCharges);?></th>
      <th align="left" class="RightBorder"><?php echo Numberformt($TotalMobilOilCharges);?></th>
      <th align="left" class="RightBorder"><?php echo Numberformt($Misc_Exp);?></th>
    </tr>
    
    
    
    
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <?php if($GetHeadInfo["head_type_id"] == 7){
		// Unloading Head ID
		/*$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_type_id", 8);
		$objQayadaccount->setProperty("ORDERBY", 'head_title');
		$objQayadaccount->lstHead();
		$UnloadingHeadID = $objQayadaccount->dbFetchArray(1);*/
		
		//Transaction of Unloading This Vehicle		
		$UnloadingAmount = 0;
		$objQayadaccountDetail = new Qayadaccount;
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		}
		if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
		$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
		}
		if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
		$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
		}
		if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
		$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
		}
		//$objQayadaccountDetail->setProperty("location_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("isActive", 1);
		$objQayadaccountDetail->setProperty("aplic_mode", 10);
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($UnloaderDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($UnloaderDetails["trans_mode"] == 1){
				$UnloadingAmount += $UnloaderDetails["trans_amount"];
			} else {
				$UnloadingAmount += 0;
			}
		}
		
		//$UnloadingAmount = 0;
		
		?>
    <tr>
      <td colspan="8" align="center" class="RightBorder">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="3" align="left">SUMMARY P&amp;L</th>
          </tr>
        <tr>
          <th width="25%" align="left" class="RightBorder">Freight Income</th>
          <td colspan="2"><strong><?php echo Numberformt($TotalDeliveryCharges);?></strong></td>
        </tr>
		<tr>
          <th width="25%" align="left" class="RightBorder">Unloading</th>
          <td colspan="2"><strong><?php echo Numberformt($UnloadingAmount);?></strong></td>
        </tr>
        <tr>
          <th width="25%" align="left" class="RightBorder">Total Income</th>
          <td colspan="2"><strong><?php 
		  $FinalTotalAmountWUnloading = $TotalDeliveryCharges + $UnloadingAmount;
		  echo Numberformt($FinalTotalAmountWUnloading);?></strong></td>
        </tr>
        <tr>
          <td colspan="3" align="left"><hr /></td>
          </tr>
         <tr>
          <th align="left" class="RightBorder">Total Diesel Expenses</th>
          <td colspan="2"><strong><?php echo Numberformt($TotalDiesleCharges);?></strong></td>
        </tr>
         <tr>
          <th align="left" class="RightBorder">Total Mobil Oil Expenses</th>
          <td colspan="2"><strong><?php echo Numberformt($TotalMobilOilCharges);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Total Tyre Expenses</th>
          <td colspan="2"><strong><?php echo Numberformt($TotalTyreCharges);?></strong></td>
        </tr>
        
        <?php
		$FinalTotalExpense = 0;
		$objQayadaccountItemsList->resetProperty();
		$objQayadaccountItemsList->setProperty("isActive", 1);
		$objQayadaccountItemsList->setProperty("head_type", 2);
		$objQayadaccountItemsList->setProperty("ORDERBY", 'item_id');
		$objQayadaccountItemsList->lstHeadItems();
		while($ListOfVehicleItems = $objQayadaccountItemsList->dbFetchArray(1)){
			
			$SumTotalExpence = 0;
		$objSSSjatlan->resetProperty();
		$objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
		$objSSSjatlan->setProperty("isActive", 1);
		if($_GET["sd"] != ''){
		$objSSSjatlan->setProperty("DATEFILTER", 'YES');
		$objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		$objSSSjatlan->setProperty("vehicle_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objSSSjatlan->setProperty("order_request_type_array", '2,3');
		$objSSSjatlan->setProperty("order_process_status", 1);
		$objSSSjatlan->lstOrderRequestDetail();
		while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
							
			
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		//$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("trans_type", 2);
		$objQayadaccountDetail->setProperty("trans_mode", 1);
		$objQayadaccountDetail->setProperty("isActive", 1);
		//$objQayadaccountDetail->setProperty("trans_date", $OrderRequest["d_date"]);
		$objQayadaccountDetail->setProperty("transfer_head_id", trim(DecData($_GET["i"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("transfer_item_id", $ListOfVehicleItems['item_id']);
		$objQayadaccountDetail->setProperty("location_id", $OrderRequest["order_request_id"]);
		$objQayadaccountDetail->lstAccountTransaction();
		while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
		//echo $LedgerItemList["transaction_id"] . ' > '. $OrderRequest["d_date"].' > '.$ListOfVehicleItems['item_id'].'  } ' . trim(DecData($_GET["i"], 1, $objBF)).'  | ';
		$SumTotalExpence += $LedgerItemList["trans_amount"];
		$FinalTotalExpense += $LedgerItemList["trans_amount"];
		} 
		}
		?>
        <tr>
          <th align="left" class="RightBorder">Total <?php echo $ListOfVehicleItems["item_title"];?> Expenses</th>
          <td colspan="2"><strong><?php echo Numberformt($SumTotalExpence);?></strong></td>
        </tr>
        
        
        <?php 
		$SumTotalExpence = 0; 
		
		} ?>
        
        
        
        
        
        
        
        
        <tr>
          <td colspan="3" align="left"><hr /></td>
          </tr>
        <tr>
          <th align="left" class="RightBorder">Grand Total Expenses</th>
          <td colspan="2"><strong><?php 
		  $GrandTotalFinalAmount = $FinalTotalExpense + $TotalDiesleCharges + $TotalMobilOilCharges + $TotalTyreCharges;
		  echo Numberformt($GrandTotalFinalAmount);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Monthly Profit of Vehicle</th>
          <td width="11%"><strong><?php 
		  $FInalValue = $FinalTotalAmountWUnloading - $GrandTotalFinalAmount;
		  echo Numberformt($FInalValue);?></strong></td>
          <td width="64%">
          <?php if($FInalValue > 0){
          echo '<code><strong style="color:#0C0;">Profit</strong></code>';
          } else {
			echo '<code><strong style="color:#930;">Loss</strong></code>';  
		  }?> 
          </td>
        </tr>
      </table></td>
    </tr>
   <?php } ?>
   
   
   
  </tbody>
</table>

<?php } elseif($GetHeadInfo["head_type_id"] == 11){?>

<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Date</th>
                    <th align="left">Transaction #</th>
                    <th align="left">Title / Description</th>
                    <th align="left">Link Head</th>
                    <th align="left">Vehicle</th>
					<th align="left">Debit</th>
                   	<th align="left">Credit</th>
                    <th align="left">Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objVehiclhead = new Qayadaccount;	
					$objSSSVehicleDetail = new SSSjatlan;
					// echo $ReturnVehicleHeadId;
					// die();
					if(trim(DecData($_GET["vhi"], 1, $objBF)) != '' && $ReturnVehicleHeadId!=0){
						$objVehiclhead->resetProperty();
						$objVehiclhead->setProperty("head_id", $ReturnVehicleHeadId);
						$objVehiclhead->lstHead();
						$VehicleDetail = $objVehiclhead->dbFetchArray(1);	
						// $TransferHeadTitle = $VehicleDetail["head_title"];
					}
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					if(trim(DecData($_GET["vhi"], 1, $objBF)) != '' && $ReturnVehicleHeadId!=0){
						$objQayadaccountDetail->setProperty("entery_id", $VehicleDetail["entity_id"]);
						}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							
								if($LedgerHeadDetails["location_id"] != ""){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["location_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSVehicleDetail->resetProperty();
								$objSSSVehicleDetail->setProperty("vehicle_id", $OrderRequestLocation["vehicle_id"]);
								$objSSSVehicleDetail->setProperty("isActive", 1);
								$objSSSVehicleDetail->lstVehicle();
								$GetVehicleNumber = $objSSSVehicleDetail->dbFetchArray(1);
								$VehicleNumber = $GetVehicleNumber["vehicle_number"];
								} else {
								$VehicleNumber = '';
								}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumber;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>



			  <?php } elseif($GetHeadInfo["head_type_id"] == 8){?>
             <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th width="10%">Date</th>
      <th width="12%">Transaction #</th>
      <th width="30%" align="left">Description</th>
      <th width="12%" align="left">Operation</th>
      <th width="8%" align="left">Vehicle#</th>
      <th width="12%" align="left">Debit</th>
      <th width="12%" align="left">Credit</th>
      <th width="12%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
				  	$SumDebit = 0;
					$SumCredit = 0;
					$SumBalance = 0;
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

							/*if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}*/

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                  
				  if($LedgerHeadDetails["location_id"] != ''){
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("vehicle_id", $LedgerHeadDetails["location_id"]);
                    $objSSSjatlan->lstVehicle();
                    $GetVehicleDetail = $objSSSjatlan->dbFetchArray(1);
						$VehicleNumberdetail = $GetVehicleDetail["vehicle_number"];
					} else {
						$VehicleNumberdetail = '';
					}
					
				    ?>
    <tr>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["trans_date"];?></td>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["transaction_number"];?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.' '.$LedgerHeadDetails["trans_note"];
					if($LedgerHeadDetails["pay_mode"] != 1){
						echo ' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					
					?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $VehicleNumberdetail;?></td>
      <td align="left" class="RightBorder"><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}
					
					
                    ?></td>
      <td align="left" class="RightBorder"><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');	
					
					}?></td>
      <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
      <td align="left"><?php echo Numberformt($BalanceAmount);?></td>
    </tr>
    <?php 
				  
					//$SumBalance += $BalanceAmount;
				  } ?>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <tr>
      <td colspan="5" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
    </tr>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <?php if($GetHeadInfo["head_type_id"] == 7){
		// Unloading Head ID
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_type_id", 8);
		$objQayadaccount->setProperty("ORDERBY", 'head_title');
		$objQayadaccount->lstHead();
		$UnloadingHeadID = $objQayadaccount->dbFetchArray(1);
		
		//Transaction of Unloading This Vehicle		
		$UnloadingAmount = 0;
		$objQayadaccountDetail = new Qayadaccount;
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		}
		if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
		$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
		}
		if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
		$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
		}
		if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
		$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
		}
		$objQayadaccountDetail->setProperty("location_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("head_id", $UnloadingHeadID["head_id"]);
		$objQayadaccountDetail->setProperty("isActive", 1);
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($UnloaderDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($UnloaderDetails["trans_mode"] == 1){
				$UnloadingAmount += $UnloaderDetails["trans_amount"];
			} else {
				$UnloadingAmount += 0;
			}
		}
		
		
		

		?>
    <tr>
      <td colspan="7" align="center" class="RightBorder">&nbsp;</td>
    </tr>
    <tr>

      <td colspan="7" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="2" align="left">SUMMARY P&amp;L</th>
          </tr>
        <tr>
          <th width="35%" align="left" class="RightBorder">Freight Income</th>
          <td width="65%"><strong><?php echo Numberformt($SumDebit);?></strong></td>
        </tr>
		<!--<tr>
          <th width="35%" align="left" class="RightBorder">Unloading</th>
          <td width="65%"><strong><?php echo Numberformt($UnloadingAmount);?></strong></td>
        </tr>-->
        <tr>
          <th width="35%" align="left" class="RightBorder">Total Income</th>
          <td width="65%"><strong><?php 
		  $FinalTotalAmountWUnloading = $SumDebit + $UnloadingAmount;
		  echo Numberformt($FinalTotalAmountWUnloading);?></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        
        <?php
			$objQayadaccountDetail = new Qayadaccount;
			$objQayadaccountItemSumUp = new Qayadaccount;
			$objQayadaccountDetail->resetProperty();
			if($_GET["sd"] != ''){
			$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
			$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
			$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
			}
			if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
			$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
			}
			if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
			$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
			}
			if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
			$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
			}
			if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
			$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
			}
			$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
			$objQayadaccountDetail->setProperty("trans_type", 2);
			$objQayadaccountDetail->setProperty("isActive", 1);
			$objQayadaccountDetail->setProperty("GROUPBY", 'item_id');
			$objQayadaccountDetail->lstAccountTransaction();
			while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
				
				$objQayadaccountItemSumUp->resetProperty();
				$objQayadaccountItemSumUp->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadaccountItemSumUp->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccountItemSumUp->OverAllAccountStatus();
				$GetItemSumUp = $objQayadaccountItemSumUp->dbFetchArray(1);
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHeadItems();
				$GetItemTitle = $objQayadaccount->dbFetchArray(1);
		?>
        <tr>
          <th align="left" class="RightBorder">Total <?php echo $GetItemTitle["item_title"];?> Expenses</th>
          <td><strong><?php echo Numberformt($GetItemSumUp["TotalCredit"]);?></strong></td>
        </tr>
        
        
        <?php } ?>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        <tr>
          <th align="left" class="RightBorder">Grand Total Expenses</th>
          <td><strong><?php echo Numberformt($SumCredit);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Monthly Profit of Vehicle</th>
          <td><strong><?php echo Numberformt($FinalTotalAmountWUnloading - $SumCredit);?></strong></td>
        </tr>
      </table></td>
    </tr>
   <?php } ?>
  </tbody>
</table>
<?php } elseif($GetHeadInfo["head_type_id"] == 10){?>
	<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Date</th>
                    <th align="left">Transaction #</th>
                    <th align="left">Title / Description</th>
                    <th align="left">Link Head</th>
                    <th align="left">Vehicle</th>
					<th align="left">Debit</th>
                   	<th align="left">Credit</th>
                    <th align="left">Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSVehicleDetail = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							
								if($LedgerHeadDetails["location_id"] != ""){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["location_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSVehicleDetail->resetProperty();
								$objSSSVehicleDetail->setProperty("vehicle_id", $OrderRequestLocation["vehicle_id"]);
								$objSSSVehicleDetail->setProperty("isActive", 1);
								$objSSSVehicleDetail->lstVehicle();
								$GetVehicleNumber = $objSSSVehicleDetail->dbFetchArray(1);
								$VehicleNumber = $GetVehicleNumber["vehicle_number"];
								} else {
								$VehicleNumber = '';
								}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumber;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>



			  <?php } elseif($GetHeadInfo["head_type_id"] == 8){?>
             <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th width="10%">Date</th>
      <th width="12%">Transaction #</th>
      <th width="30%" align="left">Description</th>
      <th width="12%" align="left">Operation</th>
      <th width="8%" align="left">Vehicle#</th>
      <th width="12%" align="left">Debit</th>
      <th width="12%" align="left">Credit</th>
      <th width="12%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
				  	$SumDebit = 0;
					$SumCredit = 0;
					$SumBalance = 0;
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

							/*if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}*/

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                  
				  if($LedgerHeadDetails["location_id"] != ''){
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("vehicle_id", $LedgerHeadDetails["location_id"]);
                    $objSSSjatlan->lstVehicle();
                    $GetVehicleDetail = $objSSSjatlan->dbFetchArray(1);
						$VehicleNumberdetail = $GetVehicleDetail["vehicle_number"];
					} else {
						$VehicleNumberdetail = '';
					}
					
				    ?>
    <tr>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["trans_date"];?></td>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["transaction_number"];?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.' '.$LedgerHeadDetails["trans_note"];
					if($LedgerHeadDetails["pay_mode"] != 1){
						echo ' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					
					?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $VehicleNumberdetail;?></td>
      <td align="left" class="RightBorder"><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}
					
					
                    ?></td>
      <td align="left" class="RightBorder"><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');	
					
					}?></td>
      <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
      <td align="left"><?php echo Numberformt($BalanceAmount);?></td>
    </tr>
    <?php 
				  
					//$SumBalance += $BalanceAmount;
				  } ?>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <tr>
      <td colspan="5" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
    </tr>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <?php if($GetHeadInfo["head_type_id"] == 7){
		// Unloading Head ID
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_type_id", 8);
		$objQayadaccount->setProperty("ORDERBY", 'head_title');
		$objQayadaccount->lstHead();
		$UnloadingHeadID = $objQayadaccount->dbFetchArray(1);
		
		//Transaction of Unloading This Vehicle		
		$UnloadingAmount = 0;
		$objQayadaccountDetail = new Qayadaccount;
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		}
		if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
		$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
		}
		if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
		$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
		}
		if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
		$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
		}
		$objQayadaccountDetail->setProperty("location_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("head_id", $UnloadingHeadID["head_id"]);
		$objQayadaccountDetail->setProperty("isActive", 1);
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($UnloaderDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($UnloaderDetails["trans_mode"] == 1){
				$UnloadingAmount += $UnloaderDetails["trans_amount"];
			} else {
				$UnloadingAmount += 0;
			}
		}
		
		
		

		?>
    <tr>
      <td colspan="7" align="center" class="RightBorder">&nbsp;</td>
    </tr>
    <tr>

      <td colspan="7" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="2" align="left">SUMMARY P&amp;L</th>
          </tr>
        <tr>
          <th width="35%" align="left" class="RightBorder">Freight Income</th>
          <td width="65%"><strong><?php echo Numberformt($SumDebit);?></strong></td>
        </tr>
		<!--<tr>
          <th width="35%" align="left" class="RightBorder">Unloading</th>
          <td width="65%"><strong><?php echo Numberformt($UnloadingAmount);?></strong></td>
        </tr>-->
        <tr>
          <th width="35%" align="left" class="RightBorder">Total Income</th>
          <td width="65%"><strong><?php 
		  $FinalTotalAmountWUnloading = $SumDebit + $UnloadingAmount;
		  echo Numberformt($FinalTotalAmountWUnloading);?></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        
        <?php
			$objQayadaccountDetail = new Qayadaccount;
			$objQayadaccountItemSumUp = new Qayadaccount;
			$objQayadaccountDetail->resetProperty();
			if($_GET["sd"] != ''){
			$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
			$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
			$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
			}
			if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
			$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
			}
			if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
			$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
			}
			if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
			$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
			}
			if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
			$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
			}
			$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
			$objQayadaccountDetail->setProperty("trans_type", 2);
			$objQayadaccountDetail->setProperty("isActive", 1);
			$objQayadaccountDetail->setProperty("GROUPBY", 'item_id');
			$objQayadaccountDetail->lstAccountTransaction();
			while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
				
				$objQayadaccountItemSumUp->resetProperty();
				$objQayadaccountItemSumUp->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadaccountItemSumUp->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccountItemSumUp->OverAllAccountStatus();
				$GetItemSumUp = $objQayadaccountItemSumUp->dbFetchArray(1);
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHeadItems();
				$GetItemTitle = $objQayadaccount->dbFetchArray(1);
		?>
        <tr>
          <th align="left" class="RightBorder">Total <?php echo $GetItemTitle["item_title"];?> Expenses</th>
          <td><strong><?php echo Numberformt($GetItemSumUp["TotalCredit"]);?></strong></td>
        </tr>
        
        
        <?php } ?>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        <tr>
          <th align="left" class="RightBorder">Grand Total Expenses</th>
          <td><strong><?php echo Numberformt($SumCredit);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Monthly Profit of Vehicle</th>
          <td><strong><?php echo Numberformt($FinalTotalAmountWUnloading - $SumCredit);?></strong></td>
        </tr>
      </table></td>
    </tr>
   <?php } ?>
  </tbody>
</table>
	<?php } elseif($GetHeadInfo["head_type_id"] == 12){?>
		<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="left">Date</th>
                    <th align="left">Transaction #</th>
                    <th align="left">Title / Description</th>
                    <th align="left">Link Head</th>
                    <th align="left">Vehicle</th>
					<th align="left">Debit</th>
                   	<th align="left">Credit</th>
                    <th align="left">Balance</th>
                   <?php 
					/*
					if($GetHeadInfo["head_type_id"]==1){
						echo '<th>Amount</th>';
					} elseif($GetHeadInfo["head_type_id"]==2){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==3){
						echo '<th>Balance</th>';
					} elseif($GetHeadInfo["head_type_id"]==4){
						echo '<th>Balance</th>';
					} */
					?>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objSSSVehicleDetail = new SSSjatlan;
					$objQayadaccountDetail->resetProperty();
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');

                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->resetProperty();
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} elseif($LedgerHeadDetails["trans_type"] == 9){
								$LinkHeadTitle = 'Invoice';
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
							
							
								if($LedgerHeadDetails["location_id"] != ""){
								$objSSSjatlan->resetProperty();
								$objSSSjatlan->setProperty("order_request_id", $LedgerHeadDetails["location_id"]);
								$objSSSjatlan->setProperty("isActive", 1);
								$objSSSjatlan->lstOrderRequestDetail();
								$OrderRequestLocation = $objSSSjatlan->dbFetchArray(1);
								
								$objSSSVehicleDetail->resetProperty();
								$objSSSVehicleDetail->setProperty("vehicle_id", $OrderRequestLocation["vehicle_id"]);
								$objSSSVehicleDetail->setProperty("isActive", 1);
								$objSSSVehicleDetail->lstVehicle();
								$GetVehicleNumber = $objSSSVehicleDetail->dbFetchArray(1);
								$VehicleNumber = $GetVehicleNumber["vehicle_number"];
								} else {
								$VehicleNumber = '';
								}
                    ?>
                  <tr>
                    <td><?php echo $LedgerHeadDetails["trans_date"];?></td>
                    <?php /*<td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'td.php?i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF);?>');"><?php echo $LedgerHeadDetails["transaction_number"];?></a></td> */ ?>
                    <td><?php echo $LedgerHeadDetails["transaction_number"];?></td>
                    <td><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.'<br>'.$LedgerHeadDetails["trans_note"];?></td>
                    <td><?php echo $LinkHeadTitle;?></td>
                    <td><?php echo $VehicleNumber;?></td>
                    <td><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');

					}

                    ?></td>
                    <td><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);

					} else {

					echo Numberformt('0');	

					}?></td>
                    <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
                    <td><?php echo Numberformt($BalanceAmount);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>



			  <?php } elseif($GetHeadInfo["head_type_id"] == 8){?>
             <table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th width="10%">Date</th>
      <th width="12%">Transaction #</th>
      <th width="30%" align="left">Description</th>
      <th width="12%" align="left">Operation</th>
      <th width="8%" align="left">Vehicle#</th>
      <th width="12%" align="left">Debit</th>
      <th width="12%" align="left">Credit</th>
      <th width="12%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
				  	$SumDebit = 0;
					$SumCredit = 0;
					$SumBalance = 0;
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

							/*if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}*/

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                  
				  if($LedgerHeadDetails["location_id"] != ''){
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("vehicle_id", $LedgerHeadDetails["location_id"]);
                    $objSSSjatlan->lstVehicle();
                    $GetVehicleDetail = $objSSSjatlan->dbFetchArray(1);
						$VehicleNumberdetail = $GetVehicleDetail["vehicle_number"];
					} else {
						$VehicleNumberdetail = '';
					}
					
				    ?>
    <tr>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["trans_date"];?></td>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["transaction_number"];?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.' '.$LedgerHeadDetails["trans_note"];
					if($LedgerHeadDetails["pay_mode"] != 1){
						echo ' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					
					?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $VehicleNumberdetail;?></td>
      <td align="left" class="RightBorder"><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}
					
					
                    ?></td>
      <td align="left" class="RightBorder"><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');	
					
					}?></td>
      <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
      <td align="left"><?php echo Numberformt($BalanceAmount);?></td>
    </tr>
    <?php 
				  
					//$SumBalance += $BalanceAmount;
				  } ?>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <tr>
      <td colspan="5" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
    </tr>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <?php if($GetHeadInfo["head_type_id"] == 7){
		// Unloading Head ID
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_type_id", 8);
		$objQayadaccount->setProperty("ORDERBY", 'head_title');
		$objQayadaccount->lstHead();
		$UnloadingHeadID = $objQayadaccount->dbFetchArray(1);
		
		//Transaction of Unloading This Vehicle		
		$UnloadingAmount = 0;
		$objQayadaccountDetail = new Qayadaccount;
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		}
		if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
		$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
		}
		if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
		$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
		}
		if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
		$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
		}
		$objQayadaccountDetail->setProperty("location_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("head_id", $UnloadingHeadID["head_id"]);
		$objQayadaccountDetail->setProperty("isActive", 1);
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($UnloaderDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($UnloaderDetails["trans_mode"] == 1){
				$UnloadingAmount += $UnloaderDetails["trans_amount"];
			} else {
				$UnloadingAmount += 0;
			}
		}
		
		
		

		?>
    <tr>
      <td colspan="7" align="center" class="RightBorder">&nbsp;</td>
    </tr>
    <tr>

      <td colspan="7" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="2" align="left">SUMMARY P&amp;L</th>
          </tr>
        <tr>
          <th width="35%" align="left" class="RightBorder">Freight Income</th>
          <td width="65%"><strong><?php echo Numberformt($SumDebit);?></strong></td>
        </tr>
		<!--<tr>
          <th width="35%" align="left" class="RightBorder">Unloading</th>
          <td width="65%"><strong><?php echo Numberformt($UnloadingAmount);?></strong></td>
        </tr>-->
        <tr>
          <th width="35%" align="left" class="RightBorder">Total Income</th>
          <td width="65%"><strong><?php 
		  $FinalTotalAmountWUnloading = $SumDebit + $UnloadingAmount;
		  echo Numberformt($FinalTotalAmountWUnloading);?></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        
        <?php
			$objQayadaccountDetail = new Qayadaccount;
			$objQayadaccountItemSumUp = new Qayadaccount;
			$objQayadaccountDetail->resetProperty();
			if($_GET["sd"] != ''){
			$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
			$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
			$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
			}
			if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
			$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
			}
			if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
			$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
			}
			if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
			$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
			}
			if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
			$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
			}
			$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
			$objQayadaccountDetail->setProperty("trans_type", 2);
			$objQayadaccountDetail->setProperty("isActive", 1);
			$objQayadaccountDetail->setProperty("GROUPBY", 'item_id');
			$objQayadaccountDetail->lstAccountTransaction();
			while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
				
				$objQayadaccountItemSumUp->resetProperty();
				$objQayadaccountItemSumUp->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadaccountItemSumUp->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccountItemSumUp->OverAllAccountStatus();
				$GetItemSumUp = $objQayadaccountItemSumUp->dbFetchArray(1);
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHeadItems();
				$GetItemTitle = $objQayadaccount->dbFetchArray(1);
		?>
        <tr>
          <th align="left" class="RightBorder">Total <?php echo $GetItemTitle["item_title"];?> Expenses</th>
          <td><strong><?php echo Numberformt($GetItemSumUp["TotalCredit"]);?></strong></td>
        </tr>
        
        
        <?php } ?>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        <tr>
          <th align="left" class="RightBorder">Grand Total Expenses</th>
          <td><strong><?php echo Numberformt($SumCredit);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Monthly Profit of Vehicle</th>
          <td><strong><?php echo Numberformt($FinalTotalAmountWUnloading - $SumCredit);?></strong></td>
        </tr>
      </table></td>
    </tr>
   <?php } ?>
  </tbody>
</table>
		<?php } elseif($GetHeadInfo["head_type_id"] == 1){?>
<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th width="10%">Date</th>
      <th width="12%">Transaction #</th>
      <th width="20%" align="left">Item</th>
      <th width="30%" align="left">Description</th>
      <th width="12%" align="left">Operation</th>
      <th width="12%" align="left">Debit</th>
      <th width="12%" align="left">Credit</th>
      <th width="12%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
				  	$SumDebit = 0;
					$SumCredit = 0;
					$SumBalance = 0;
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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
						$objQayadaccountLinkHead->resetProperty();
							if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							} else {
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
							}
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadItemTitle = $TransferHeadDetail["item_title"];

							/*if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}*/

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                    ?>
    <tr>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["trans_date"];?></td>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["transaction_number"];?></td>
       <td align="left" class="RightBorder"><?php echo $TransferHeadItemTitle;?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.' '.$LedgerHeadDetails["trans_note"];
					if($LedgerHeadDetails["pay_mode"] != 1){
						echo ' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					
					?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
      <td align="left" class="RightBorder"><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}
					
					
                    ?></td>
      <td align="left" class="RightBorder"><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');	
					
					}?></td>
      <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
      <td align="left"><?php echo Numberformt($BalanceAmount);?></td>
    </tr>
    <?php 
				  
					//$SumBalance += $BalanceAmount;
				  } ?>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <tr>
      <td colspan="5" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
    </tr>
    <tr>
      <td colspan="8" align="center" class="RightBorder"><hr /></td>
    </tr>
    <?php if($GetHeadInfo["head_type_id"] == 7){
		// Unloading Head ID
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_type_id", 8);
		$objQayadaccount->setProperty("ORDERBY", 'head_title');
		$objQayadaccount->lstHead();
		$UnloadingHeadID = $objQayadaccount->dbFetchArray(1);
		
		//Transaction of Unloading This Vehicle		
		$UnloadingAmount = 0;
		$objQayadaccountDetail = new Qayadaccount;
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		}
		if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
		$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
		}
		if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
		$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
		}
		if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
		$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
		}
		$objQayadaccountDetail->setProperty("location_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("head_id", $UnloadingHeadID["head_id"]);
		$objQayadaccountDetail->setProperty("isActive", 1);
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($UnloaderDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($UnloaderDetails["trans_mode"] == 1){
				$UnloadingAmount += $UnloaderDetails["trans_amount"];
			} else {
				$UnloadingAmount += 0;
			}
		}
		
		
		

		?>
    <tr>
      <td colspan="8" align="center" class="RightBorder">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="8" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="3" align="left">SUMMARY P&amp;L</th>
          </tr>
        <tr>
          <th width="35%" align="left" class="RightBorder">Freight Income</th>
          <td width="65%"><strong><?php echo Numberformt($SumDebit);?></strong></td>
        </tr>
		<!--<tr>
          <th width="35%" align="left" class="RightBorder">Unloading</th>
          <td width="65%"><strong><?php echo Numberformt($UnloadingAmount);?></strong></td>
        </tr>-->
        <tr>
          <th width="35%" align="left" class="RightBorder">Total Income</th>
          <td width="65%"><strong><?php 
		  $FinalTotalAmountWUnloading = $SumDebit + $UnloadingAmount;
		  echo Numberformt($FinalTotalAmountWUnloading);?></strong></td>
        </tr>
        <tr>
          <td colspan="3" align="left"><hr /></td>
          </tr>
        
        <?php
			$objQayadaccountDetail = new Qayadaccount;
			$objQayadaccountItemSumUp = new Qayadaccount;
			$objQayadaccountDetail->resetProperty();
			if($_GET["sd"] != ''){
			$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
			$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
			$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
			}
			if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
			$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
			}
			if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
			$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
			}
			if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
			$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
			}
			if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
			$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
			}
			$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
			$objQayadaccountDetail->setProperty("trans_type", 2);
			$objQayadaccountDetail->setProperty("isActive", 1);
			$objQayadaccountDetail->setProperty("GROUPBY", 'item_id');
			$objQayadaccountDetail->lstAccountTransaction();
			while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
				
				$objQayadaccountItemSumUp->resetProperty();
				$objQayadaccountItemSumUp->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadaccountItemSumUp->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccountItemSumUp->OverAllAccountStatus();
				$GetItemSumUp = $objQayadaccountItemSumUp->dbFetchArray(1);
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHeadItems();
				$GetItemTitle = $objQayadaccount->dbFetchArray(1);
		?>
        <tr>
          <th align="left" class="RightBorder">Total <?php echo $GetItemTitle["item_title"];?> Expenses</th>
          <td><strong><?php echo Numberformt($GetItemSumUp["TotalCredit"]);?></strong></td>
        </tr>
        
        
        <?php } ?>
        <tr>
          <td colspan="3" align="left"><hr /></td>
          </tr>
        <tr>
          <th align="left" class="RightBorder">Grand Total Expenses</th>
          <td><strong><?php echo Numberformt($SumCredit);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Monthly Profit of Vehicle</th>
          <td><strong><?php echo Numberformt($FinalTotalAmountWUnloading - $SumCredit);?></strong></td>
        </tr>
      </table></td>
    </tr>
   <?php } ?>
  </tbody>
</table>
<?php } elseif($GetHeadInfo["head_type_id"] == 2){?>
	<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th width="10%">Date</th>
      <th width="12%">Transaction #</th>
	  <th width="30%" align="left">Head</th>
	  <th width="30%" align="left">Item/Head</th> 
	  <th width="30%" align="left">Description</th>
      <th width="12%" align="left">Operation</th>
      <th width="12%" align="left">Debit</th>
      <th width="12%" align="left">Credit</th>
      <th width="12%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
				  	$SumDebit = 0;
					$SumCredit = 0;
					$SumBalance = 0;
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					$objQayadaccountHead	= new Qayadaccount;
					$objQayadaccountTHead	= new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

						

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}



							$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$TransferHeadDetail = $objQayadaccountHead->dbFetchArray(1);
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						
						if($LedgerHeadDetails["transfer_item_id"] != ''){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
						$objQayadaccountTHead->lstHeadItems();
						$TransferHeadDetailItem = $objQayadaccountTHead->dbFetchArray(1);
						$TransferHeadItem = $TransferHeadDetailItem["item_title"];
						if($TransferHeadDetail["head_type_id"] != 7){
						$TransactionHeadTypeTitle = $TransferHeadDetail["head_title"];	
						
						} else {
						$TransactionHeadTypeTitle = $TransactionHeadTypeTitle;
						}
						//
						} else {
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$TransactionHeadDetail = $objQayadaccountHead->dbFetchArray(1);	
						$TransferHeadItem = $TransactionHeadDetail["head_title"];
						}
						
						if($TransferHeadDetail["head_type_id"] == 2){
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $LedgerHeadDetails["head_id"]);
						$objQayadaccountHead->lstHead();
						$TransferHeadDetail = $objQayadaccountHead->dbFetchArray(1);
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						
						if($LedgerHeadDetails["item_id"] != ''){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
						$objQayadaccountTHead->lstHeadItems();
						$TransferHeadDetailItem = $objQayadaccountTHead->dbFetchArray(1);
						$TransferHeadItem = $TransferHeadDetailItem["item_title"];	
						$TransactionHeadTypeTitle = $TransferHeadDetail["head_title"];
						} else {
						$TransferHeadItem = $TransferHeadDetail["head_title"];	
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						}
						}
                    ?>
    <tr>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["trans_date"];?></td>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["transaction_number"];?></td>
	  <td align="center" class="RightBorder"><?php echo $TransactionHeadTypeTitle;?></td>
                    <td align="center" class="RightBorder"><?php echo $TransferHeadItem;?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.' '.$LedgerHeadDetails["trans_note"];
					if($LedgerHeadDetails["pay_mode"] != 1){
						echo ' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					
					?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
      <td align="left" class="RightBorder"><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}
					
					
                    ?></td>
      <td align="left" class="RightBorder"><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');	
					
					}?></td>
      <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
      <td align="left"><?php echo Numberformt($BalanceAmount);?></td>
    </tr>
    <?php 
				  
					//$SumBalance += $BalanceAmount;
				  } ?>
    <tr>
      <td colspan="7" align="center" class="RightBorder"><hr /></td>
    </tr>
    <tr>
      <td colspan="4" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
    </tr>
    <tr>
      <td colspan="7" align="center" class="RightBorder"><hr /></td>
    </tr>
    <?php if($GetHeadInfo["head_type_id"] == 7){
		// Unloading Head ID
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_type_id", 8);
		$objQayadaccount->setProperty("ORDERBY", 'head_title');
		$objQayadaccount->lstHead();
		$UnloadingHeadID = $objQayadaccount->dbFetchArray(1);
		
		//Transaction of Unloading This Vehicle		
		$UnloadingAmount = 0;
		$objQayadaccountDetail = new Qayadaccount;
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		}
		if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
		$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
		}
		if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
		$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
		}
		if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
		$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
		}
		$objQayadaccountDetail->setProperty("location_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("head_id", $UnloadingHeadID["head_id"]);
		$objQayadaccountDetail->setProperty("isActive", 1);
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($UnloaderDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($UnloaderDetails["trans_mode"] == 1){
				$UnloadingAmount += $UnloaderDetails["trans_amount"];
			} else {
				$UnloadingAmount += 0;
			}
		}
		
		
		

		?>
    <tr>
      <td colspan="7" align="center" class="RightBorder">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="2" align="left">SUMMARY P&amp;L</th>
          </tr>
        <tr>
          <th width="35%" align="left" class="RightBorder">Freight Income</th>
          <td width="65%"><strong><?php echo Numberformt($SumDebit);?></strong></td>
        </tr>
		<!--<tr>
          <th width="35%" align="left" class="RightBorder">Unloading</th>
          <td width="65%"><strong><?php echo Numberformt($UnloadingAmount);?></strong></td>
        </tr>-->
        <tr>
          <th width="35%" align="left" class="RightBorder">Total Income</th>
          <td width="65%"><strong><?php 
		  $FinalTotalAmountWUnloading = $SumDebit + $UnloadingAmount;
		  echo Numberformt($FinalTotalAmountWUnloading);?></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        
        <?php
			$objQayadaccountDetail = new Qayadaccount;
			$objQayadaccountItemSumUp = new Qayadaccount;
			$objQayadaccountDetail->resetProperty();
			if($_GET["sd"] != ''){
			$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
			$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
			$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
			}
			if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
			$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
			}
			if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
			$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
			}
			if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
			$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
			}
			if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
			$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
			}
			$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
			$objQayadaccountDetail->setProperty("trans_type", 2);
			$objQayadaccountDetail->setProperty("isActive", 1);
			$objQayadaccountDetail->setProperty("GROUPBY", 'item_id');
			$objQayadaccountDetail->lstAccountTransaction();
			while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
				
				$objQayadaccountItemSumUp->resetProperty();
				$objQayadaccountItemSumUp->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadaccountItemSumUp->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccountItemSumUp->OverAllAccountStatus();
				$GetItemSumUp = $objQayadaccountItemSumUp->dbFetchArray(1);
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHeadItems();
				$GetItemTitle = $objQayadaccount->dbFetchArray(1);
		?>
        <tr>
          <th align="left" class="RightBorder">Total <?php echo $GetItemTitle["item_title"];?> Expenses</th>
          <td><strong><?php echo Numberformt($GetItemSumUp["TotalCredit"]);?></strong></td>
        </tr>
        
        
        <?php } ?>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        <tr>
          <th align="left" class="RightBorder">Grand Total Expenses</th>
          <td><strong><?php echo Numberformt($SumCredit);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Monthly Profit of Vehicle</th>
          <td><strong><?php echo Numberformt($FinalTotalAmountWUnloading - $SumCredit);?></strong></td>
        </tr>
      </table></td>
    </tr>
   <?php } ?>
  </tbody>
</table>
<?php } else { ?>
<table class="ledgerTable" cellspacing="0" width="100%" style="width:100%">
  <thead>
    <tr>
      <th width="10%">Date</th>
      <th width="12%">Transaction #</th>
      <th width="30%" align="left">Description</th>
      <th width="12%" align="left">Operation</th>
      <th width="12%" align="left">Debit</th>
      <th width="12%" align="left">Credit</th>
      <th width="12%" align="left">Balance</th>
    </tr>
  </thead>
  <tbody>
    <?php
				  	$SumDebit = 0;
					$SumCredit = 0;
					$SumBalance = 0;
					$BalanceAmount = 0;
					$objQayadaccountDetail = new Qayadaccount;
					$objQayadaccountLinkHead = new Qayadaccount;
					$objQayadaccountTHead = new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//if($GetHeadInfo["head_type_id"] == 2){
					$objQayadaccountDetail->resetProperty();
					if($_GET["sd"] != ''){
					$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
					$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
					$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
					}
					if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
					$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
					}
					if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
					$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
					}
					if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
					$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
					}
					if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
					$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
					}
					//ReturnLinkHeadId
					$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
					//}
                    //$objQayadaccountDetail->setProperty("limit", '2');
					$objQayadaccountDetail->setProperty("isActive", 1);
					$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
                    $objQayadaccountDetail->lstAccountTransaction();

					//print_r($LedgerHeadDetails);
					//die();
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

							/*if($LedgerHeadDetails["transfer_item_id"] != ''){
							$objQayadaccountLinkHead->setProperty("item_id", $LedgerHeadDetails["transfer_item_id"]);
							$objQayadaccountLinkHead->lstHeadItems();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);
							$TransferHeadTitle = $TransferHeadDetail["item_title"];
							} else {
							$objQayadaccountLinkHead->setProperty("head_id", $LedgerHeadDetails["transfer_head_id"]);
							$objQayadaccountLinkHead->lstHead();
							$TransferHeadDetail = $objQayadaccountLinkHead->dbFetchArray(1);	
							$TransferHeadTitle = $TransferHeadDetail["head_title"];
							}*/

							if($LedgerHeadDetails["trans_type"] == 8){
								$LinkHeadTitle = 'Opening Balance';
								if($LedgerHeadDetails["item_id"] != ""){
								$objQayadaccountTHead->resetProperty();
								$objQayadaccountTHead->setProperty("item_id", $LedgerHeadDetails["item_id"]);
								$objQayadaccountTHead->lstHeadItems();
								$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
								$TransferHeadName = ' [<b>'.$TransferHeadDetail["item_title"].'</b>]';
								}
							} else {
								$LinkHeadTitle = $TransferHeadTitle;
								$TransferHeadName = '';
							}
                    ?>
    <tr>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["trans_date"];?></td>
      <td align="center" class="RightBorder"><?php echo $LedgerHeadDetails["transaction_number"];?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo $LedgerHeadDetails["trans_title"].$TransferHeadName.' '.$LedgerHeadDetails["trans_note"];
					if($LedgerHeadDetails["pay_mode"] != 1){
						echo ' ['.$LedgerHeadDetails["pay_mode_no"].']';
					}
					
					?></td>
      <td align="left" class="RightBorder titlefontsize"><?php echo PaymentOption($LedgerHeadDetails["pay_mode"]);?></td>
      <td align="left" class="RightBorder"><?php 
					if($LedgerHeadDetails["trans_mode"] == 1){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumDebit+= $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');

					}
					
					
                    ?></td>
      <td align="left" class="RightBorder"><?php if($LedgerHeadDetails["trans_mode"] == 2){

					echo Numberformt($LedgerHeadDetails["trans_amount"]);
					$SumCredit += $LedgerHeadDetails["trans_amount"];
					} else {

					echo Numberformt('0');	
					
					}?></td>
      <?php /*<td><a href="<?php echo Route::_('show=ledgerheaddetail&mode='.EncData("Delete", 2, $objBF).'&tn='.EncData($LedgerHeadDetails["transaction_number"], 2, $objBF).'&i='.EncData($LedgerHeadDetails["transaction_id"], 2, $objBF));?>"> <i class="material-icons">delete</i> </a></td> */ ?>
      <td align="left"><?php echo Numberformt($BalanceAmount);?></td>
    </tr>
    <?php 
				  
					//$SumBalance += $BalanceAmount;
				  } ?>
    <tr>
      <td colspan="7" align="center" class="RightBorder"><hr /></td>
    </tr>
    <tr>
      <td colspan="4" align="right" class="RightBorder btheading">Transaction Total: &nbsp;</td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumDebit);?></td>
      <td align="left" class="RightBorder btheading"><?php echo Numberformt($SumCredit);?></td>
      <td align="left" class=" btheading"><?php 
					if($GetHeadInfo["head_type_id"] == 2){
					echo Numberformt($SumCredit - $SumDebit);	
					} elseif($GetHeadInfo["head_type_id"] == 3){
					echo Numberformt($SumCredit - $SumDebit);
					} else {
					echo Numberformt($SumDebit - $SumCredit);	
					}
					?></td>
    </tr>
    <tr>
      <td colspan="7" align="center" class="RightBorder"><hr /></td>
    </tr>
    <?php if($GetHeadInfo["head_type_id"] == 7){
		// Unloading Head ID
		$objQayadaccount->resetProperty();
		$objQayadaccount->setProperty("isActive", 1);
		$objQayadaccount->setProperty("head_type_id", 8);
		$objQayadaccount->setProperty("ORDERBY", 'head_title');
		$objQayadaccount->lstHead();
		$UnloadingHeadID = $objQayadaccount->dbFetchArray(1);
		
		//Transaction of Unloading This Vehicle		
		$UnloadingAmount = 0;
		$objQayadaccountDetail = new Qayadaccount;
		$objQayadaccountDetail->resetProperty();
		if($_GET["sd"] != ''){
		$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
		$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
		$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
		}
		if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
		$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
		}
		if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
		$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
		}
		if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
		$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
		}
		if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
		$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
		}
		$objQayadaccountDetail->setProperty("location_id", trim(DecData($_GET["vi"], 1, $objBF)));
		$objQayadaccountDetail->setProperty("head_id", $UnloadingHeadID["head_id"]);
		$objQayadaccountDetail->setProperty("isActive", 1);
		$objQayadaccountDetail->setProperty("ORDERBY", 'trans_date');
		$objQayadaccountDetail->lstAccountTransaction();
		while($UnloaderDetails = $objQayadaccountDetail->dbFetchArray(1)){
			
			if($UnloaderDetails["trans_mode"] == 1){
				$UnloadingAmount += $UnloaderDetails["trans_amount"];
			} else {
				$UnloadingAmount += 0;
			}
		}
		
		
		

		?>
    <tr>
      <td colspan="7" align="center" class="RightBorder">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="7" align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <th colspan="2" align="left">SUMMARY P&amp;L</th>
          </tr>
        <tr>
          <th width="35%" align="left" class="RightBorder">Freight Income</th>
          <td width="65%"><strong><?php echo Numberformt($SumDebit);?></strong></td>
        </tr>
		<!--<tr>
          <th width="35%" align="left" class="RightBorder">Unloading</th>
          <td width="65%"><strong><?php echo Numberformt($UnloadingAmount);?></strong></td>
        </tr>-->
        <tr>
          <th width="35%" align="left" class="RightBorder">Total Income</th>
          <td width="65%"><strong><?php 
		  $FinalTotalAmountWUnloading = $SumDebit + $UnloadingAmount;
		  echo Numberformt($FinalTotalAmountWUnloading);?></strong></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        
        <?php
			$objQayadaccountDetail = new Qayadaccount;
			$objQayadaccountItemSumUp = new Qayadaccount;
			$objQayadaccountDetail->resetProperty();
			if($_GET["sd"] != ''){
			$objQayadaccountDetail->setProperty("DATEFILTER", 'YES');
			$objQayadaccountDetail->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
			$objQayadaccountDetail->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
			}
			if($_GET["ts"] != '' && $ReturnTransactionStatus!=0){
			$objQayadaccountDetail->setProperty("trans_mode", $ReturnTransactionStatus);
			}
			if(trim(DecData($_GET["ii"], 1, $objBF)) != '' && $ReturnItemId!=0){
			$objQayadaccountDetail->setProperty("item_id", $ReturnItemId);
			}
			if(trim(DecData($_GET["lii"], 1, $objBF)) != '' && $ReturnLinkItemId!=0){
			$objQayadaccountDetail->setProperty("transfer_item_id", $ReturnLinkItemId);
			}
			if(trim(DecData($_GET["lhi"], 1, $objBF)) != '' && $ReturnLinkHeadId!=0){
			$objQayadaccountDetail->setProperty("transfer_head_id", $ReturnLinkHeadId);
			}
			$objQayadaccountDetail->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
			$objQayadaccountDetail->setProperty("trans_type", 2);
			$objQayadaccountDetail->setProperty("isActive", 1);
			$objQayadaccountDetail->setProperty("GROUPBY", 'item_id');
			$objQayadaccountDetail->lstAccountTransaction();
			while($LedgerItemList = $objQayadaccountDetail->dbFetchArray(1)){
				
				$objQayadaccountItemSumUp->resetProperty();
				$objQayadaccountItemSumUp->setProperty("head_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadaccountItemSumUp->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccountItemSumUp->OverAllAccountStatus();
				$GetItemSumUp = $objQayadaccountItemSumUp->dbFetchArray(1);
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("item_id", $LedgerItemList["item_id"]);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHeadItems();
				$GetItemTitle = $objQayadaccount->dbFetchArray(1);
		?>
        <tr>
          <th align="left" class="RightBorder">Total <?php echo $GetItemTitle["item_title"];?> Expenses</th>
          <td><strong><?php echo Numberformt($GetItemSumUp["TotalCredit"]);?></strong></td>
        </tr>
        
        
        <?php } ?>
        <tr>
          <td colspan="2" align="left"><hr /></td>
          </tr>
        <tr>
          <th align="left" class="RightBorder">Grand Total Expenses</th>
          <td><strong><?php echo Numberformt($SumCredit);?></strong></td>
        </tr>
        <tr>
          <th align="left" class="RightBorder">Monthly Profit of Vehicle</th>
          <td><strong><?php echo Numberformt($FinalTotalAmountWUnloading - $SumCredit);?></strong></td>
        </tr>
      </table></td>
    </tr>
   <?php } ?>
  </tbody>
</table>
<?php } ?>
<script type="text/javascript">window.print();</script>