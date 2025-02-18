<style>
.btn-group, .btn-group-vertical {
	margin: 3px 1px;
}
</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">money_off</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Wrong Transactions</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=wrongtransactionform');?>" class="btn btn-primary">Wrong Transaction</a> </div>
            <hr>
            
            <div class="material-datatables">
              <table id="datatables" data-order="[[ 0, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Action Date</th>
                    <th>Transaction#</th>
                    <th>Transaction Date</th>
                    <th>Wrong Reason</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$objTransactionDetail	= new Qayadaccount;
					$objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("ORDERBY", 'transaction_date DESC');
					$objQayadaccount->setProperty("wrong_tran_type", 2);
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstWrongTransactions();
                    while($ListOfWrongTransaction = $objQayadaccount->dbFetchArray(1)){
						
						$objTransactionDetail->resetProperty();
						$objTransactionDetail->setProperty("transaction_number", $ListOfWrongTransaction["transaction_no"]);
						$objTransactionDetail->lstAccountTransaction();
						$TransactionDetail = $objTransactionDetail->dbFetchArray(1);
						
                    ?>
                  <tr>
                  <td><?php echo dateFormate_3($ListOfWrongTransaction["transaction_date"]);?></td>
                    <td><?php echo $TransactionDetail["transaction_number"];?></td>
                    <td><?php echo dateFormate_3($TransactionDetail["trans_date"]);?></td>
                     <td><?php echo $ListOfWrongTransaction["wrong_reason"];?></td>
                    <td><?php echo Numberformt($TransactionDetail["trans_amount"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            
      
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
