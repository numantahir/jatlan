<?php 
$GetAPMId = trim(DecData($_GET["apm"], 1, $objBF));
if($GetAPMId == 1){
$WriteTitle = 'Customer Amount';
$HeadTransfer = 'Transfer To';
} elseif($GetAPMId == 2){
$WriteTitle = 'Supplier Payment';
$HeadTransfer = 'Transfer From';
} elseif($GetAPMId == 3){
$WriteTitle = 'General Expense';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 4){
$WriteTitle = 'Expense Item Base';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 5){
$WriteTitle = 'Employees Salaries';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 6){
$WriteTitle = 'Transfer Amount <code>Bank To Bank</code>';
$HeadTransfer = 'Transfer TO';
} elseif($GetAPMId == 7){
$WriteTitle = 'Transfer Amount <code>Cash To Bank</code>';
$HeadTransfer = 'Transfer TO';
} elseif($GetAPMId == 8){
$WriteTitle = 'Transfer Amount <code>Bank To Cash</code>';
$HeadTransfer = 'Transfer TO';
} elseif($GetAPMId == 9){
$WriteTitle = 'Unloader Payment';
$HeadTransfer = 'Transfer From';
} elseif($GetAPMId == 10){
$WriteTitle = 'Customer Cashback <code>Return Amount</code>';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 11){
$WriteTitle = 'Employee Salaries';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 12){
$WriteTitle = 'Advance Salary Request';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 13){
$WriteTitle = 'Vehicle Expense';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 14){
$WriteTitle = 'Diesel Supplier';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 15){
$WriteTitle = 'Mobil Oil Supplier';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 16){
$WriteTitle = 'Tyre Supplier';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 17){
$WriteTitle = 'Contra Transaction';
$HeadTransfer = 'Transfer To ';
} elseif($GetAPMId == 18){
$WriteTitle = 'Drawing Accounts Transaction';
$HeadTransfer = 'Pay From ';
} elseif($GetAPMId == 19){
$WriteTitle = 'Drawing Accounts Transaction';
$HeadTransfer = 'Transfer To ';
} elseif($GetAPMId == 20){
$WriteTitle = 'Customer Contra Transaction';
$HeadTransfer = 'Transfer To ';

} elseif($GetAPMId == 21){
$WriteTitle = 'Customer Discount Transaction';
$HeadTransfer = 'Transfer To ';
} elseif($GetAPMId == 22){
$WriteTitle = 'Customer Other Charges Transaction';
$HeadTransfer = 'Transfer To ';
} elseif($GetAPMId == 23){
$WriteTitle = 'Supplier Discount Transaction';
$HeadTransfer = 'Transfer To ';
} elseif($GetAPMId == 24){
$WriteTitle = 'Supplier Other Charges Transaction';
$HeadTransfer = 'Transfer To ';
} elseif($GetAPMId == 25){
	$WriteTitle = 'Drawing to Supplier Transaction';
	$HeadTransfer = 'Transfer To ';
} elseif($GetAPMId == 26){
	$WriteTitle = 'Profit Transaction';
	$HeadTransfer = 'Transfer From ';
} elseif($GetAPMId == 27){
	$WriteTitle = 'Customer to Drawing Transaction';
	$HeadTransfer = 'Transfer To ';
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="transaction_id" value="<?php echo $objBF->encrypt($transaction_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="apm_id" value="<?php echo $GetAPMId;?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Transaction :: <?php echo $WriteTitle;?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=transaction');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <?php 
				if($GetAPMId == 1){ 
					//Batch Cash Collection
					include(INC_PATH."transaction_mode_1.php");
			 	} elseif($GetAPMId == 2){ 
					//Receive Instalment
					include(INC_PATH."transaction_mode_2.php");
				} elseif($GetAPMId == 3){ 
					//General Expense
					include(INC_PATH."transaction_mode_3.php");
				} elseif($GetAPMId == 6){ 
					//General Expense
					include(INC_PATH."transaction_mode_6.php");
				} elseif($GetAPMId == 7){ 
					include(INC_PATH."transaction_mode_7.php");
				}elseif($GetAPMId == 8){ 
					include(INC_PATH."transaction_mode_8.php");
				} elseif($GetAPMId == 9){ 
					 include(INC_PATH."transaction_mode_9.php");
				} elseif($GetAPMId == 10){ 
					 include(INC_PATH."transaction_mode_10.php");
				} elseif($GetAPMId == 11){
					include(INC_PATH."transaction_mode_11.php");	 
				} elseif($GetAPMId == 12){
					include(INC_PATH."transaction_mode_12.php");	 
				} elseif($GetAPMId == 13){
					include(INC_PATH."transaction_mode_13.php");
				
				
				} elseif($GetAPMId == 14){
					include(INC_PATH."transaction_mode_14.php");
				} elseif($GetAPMId == 15){
					include(INC_PATH."transaction_mode_15.php");
				} elseif($GetAPMId == 16){
					include(INC_PATH."transaction_mode_16.php");
				} elseif($GetAPMId == 17){
				include(INC_PATH."transaction_mode_17.php");
				} elseif($GetAPMId == 18){
				include(INC_PATH."transaction_mode_18.php");
				} elseif($GetAPMId == 19){
				include(INC_PATH."transaction_mode_19.php");
				} elseif($GetAPMId == 20){
				include(INC_PATH."transaction_mode_20.php");
				} elseif($GetAPMId == 21){
				include(INC_PATH."transaction_mode_21.php");
				} elseif($GetAPMId == 22){
				include(INC_PATH."transaction_mode_22.php");
				} elseif($GetAPMId == 23){
				include(INC_PATH."transaction_mode_23.php");
				} elseif($GetAPMId == 24){
				include(INC_PATH."transaction_mode_24.php");
				} elseif($GetAPMId == 25){
				include(INC_PATH."transaction_mode_25.php");
				} elseif($GetAPMId == 26){
				include(INC_PATH."transaction_mode_26.php");
				} elseif($GetAPMId == 27){
				include(INC_PATH."transaction_mode_27.php");
				} 
				 ?>
            <br>
            </div>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
