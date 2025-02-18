<?php 
if($objCheckLogin->user_type == 1){
$objQayadaccount->resetProperty();
$objQayadaccount->setProperty("isActive", 1);
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->setProperty("head_type_id", 2);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotalCredit"] - $CashHeadStatus["TotaDebit"];
//echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
 ?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="orange"> <i class="material-icons">money</i> </div>
          <div class="card-content">
            <p class="category">Cash In-Hand</p>
            <h3 class="card-title"><?php echo Numberformt($CashHeadTotal); //echo $TotalCashHandCredit  . ' - '. $TotalCashHandDebit;?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="orange"> <i class="material-icons">money_off</i> </div>
          <div class="card-content">
            <p class="category">Debit</p>
            <h3 class="card-title"><?php echo Numberformt($CashHeadStatus["TotaDebit"]);?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="orange"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <p class="category">Credit</p>
            <h3 class="card-title"><?php echo Numberformt($CashHeadStatus["TotalCredit"]);?></h3>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="row" style="border-bottom:solid 1px #DFDFDF; margin-bottom:20px;">
      
      <div class="col-md-12">
        <div class="card" style="min-height:275px;">
          <div class="col-md-12">
            <div class="card-header card-header-icon" data-background-color="green"> <i class="material-icons">subtitles</i> </div>
            <div class="card-content">
              <h4 class="card-title">List of Bank Account's & Balance</h4>
              <div class="row">
                <div class="table-responsive table-sales text-right">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-left">Title</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					  $objQayadaccountCounter = new Qayadaccount;
                    $objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 3);
					$objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
						
						$objQayadaccountCounter->resetProperty();
						$objQayadaccountCounter->setProperty("isActive", 1);
						$objQayadaccountCounter->setProperty("head_id", $AccountHeadList['head_id']);
						$objQayadaccountCounter->setProperty("head_type_id", 3);
						$objQayadaccountCounter->OverAllAccountStatus();
						$CashHeadStatus = $objQayadaccountCounter->dbFetchArray(1);
						$CashHeadTotal = $CashHeadStatus["TotalCredit"] - $CashHeadStatus["TotaDebit"];

                    ?>
                      <tr>
                        <td class="text-left"><?php echo $AccountHeadList["head_title"];?></td>
                        <td class="text-right"><?php echo Numberformt($CashHeadTotal);

						?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
} elseif($objCheckLogin->user_type == 3){ 
$objQayadaccount->resetProperty();
$objQayadaccount->setProperty("isActive", 1);
//$objQayadaccount->setProperty("head_id", $GetHeadInfo['head_id']);
$objQayadaccount->setProperty("head_type_id", 2);
$objQayadaccount->OverAllAccountStatus();
$CashHeadStatus = $objQayadaccount->dbFetchArray(1);
$CashHeadTotal = $CashHeadStatus["TotalCredit"] - $CashHeadStatus["TotaDebit"];
//echo '<code>Current Balance: '.Numberformt($CashHeadTotal).'</code>';
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="orange"> <i class="material-icons">money</i> </div>
          <div class="card-content">
            <p class="category">Cash In-Hand</p>
            <h3 class="card-title"><?php echo Numberformt($CashHeadTotal); //echo $TotalCashHandCredit  . ' - '. $TotalCashHandDebit;?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="orange"> <i class="material-icons">money_off</i> </div>
          <div class="card-content">
            <p class="category">Debit</p>
            <h3 class="card-title"><?php echo Numberformt($CashHeadStatus["TotaDebit"]);?></h3>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header" data-background-color="orange"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <p class="category">Credit</p>
            <h3 class="card-title"><?php echo Numberformt($CashHeadStatus["TotalCredit"]);?></h3>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="row" style="border-bottom:solid 1px #DFDFDF; margin-bottom:20px;">
      
      <div class="col-md-12">
        <div class="card" style="min-height:275px;">
          <div class="col-md-12">
            <div class="card-header card-header-icon" data-background-color="green"> <i class="material-icons">subtitles</i> </div>
            <div class="card-content">
              <h4 class="card-title">List of Bank Account's & Balance</h4>
              <div class="row">
                <div class="table-responsive table-sales text-right">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-left">Title</th>
                        <th class="text-right">Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
					  $objQayadaccountCounter = new Qayadaccount;
                    $objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id", 3);
					$objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
						
						$objQayadaccountCounter->resetProperty();
						$objQayadaccountCounter->setProperty("isActive", 1);
						$objQayadaccountCounter->setProperty("head_id", $AccountHeadList['head_id']);
						$objQayadaccountCounter->setProperty("head_type_id", 3);
						$objQayadaccountCounter->OverAllAccountStatus();
						$CashHeadStatus = $objQayadaccountCounter->dbFetchArray(1);
						$CashHeadTotal = $CashHeadStatus["TotalCredit"] - $CashHeadStatus["TotaDebit"];

                    ?>
                      <tr>
                        <td class="text-left"><?php echo $AccountHeadList["head_title"];?></td>
                        <td class="text-right"><?php echo Numberformt($CashHeadTotal);

						?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
} else { ?>
<div class="content">
  <div class="container-fluid">
    
    <div class="row" style="border-bottom:solid 1px #DFDFDF; margin-bottom:20px;">
      <div class="col-md-12">
        <div class="card" style="min-height:275px;">
          <div class="col-md-12">
            <div class="card-header card-header-icon" data-background-color="green"> <i class="material-icons">subtitles</i> </div>
            <div class="card-content">
              <h4 class="card-title">&nbsp;</h4>
              <div class="row">
                <div class="table-responsive table-sales text-right">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
  </div>
</div>
<?php } ?>