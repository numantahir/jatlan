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
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">book</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Daybook Debit/Credit :: <span style="color:#900"><?php echo date("jS M, Y", strtotime(date("d-m-Y")));?></span></h4>
            <div class="toolbar text-right"> <!--<a href="<?php echo Route::_('show=transactionmode');?>" class="btn btn-primary">New Transaction</a>--> </div>
            <div class="col-md-12" style="display:none;">
              <hr>
              <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="mode" value="search">
                <div class="col-md-3">
                  <div class="card-content">
                    <h4 class="card-title">Start Date</h4>
                    <div class="form-group">
                      <input type="text" class="form-control datepicker" name="start_date" value="<?php echo date("m-d-Y");?>" tabindex="1" />
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card-content">
                    <h4 class="card-title">End Date</h4>
                    <div class="form-group">
                      <input type="text" class="form-control datepicker" name="end_date" value="<?php echo date("m-d-Y");?>" tabindex="2" />
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card-content">
                    <h4 class="card-title">Transaction Status</h4>
                    <div class="form-group">
                      <select class="selectpicker" data-style="select-with-transition" name="trans_status" title="Transaction Status" tabindex="3">
                        <option value="0"selected>All</option>
                        <option value="1">Debit</option>
                        <option value="2">Credit</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="card-content">
                    <div class="form-group" style="text-align:center;">
                      <button type="submit" class="btn btn-success btn-round" tabindex="4">Filter Now</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <hr>
            <h4 class="card-title CardWidth" style="width:100% !important;"> Debit Transactions </h4>
            <div class="material-datatables">
              <table data-order="[[ 0, &quot;desc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Date</th>
                    <th>Transaction#</th>
                    <th>Head</th>
                    <th>Item/Head</th>
                    <th>Description</th>
                    <!--<th>Pay Mode</th>-->
                    <th>Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$objQayadaccountHead	= new Qayadaccount;
					$objQayadaccountTHead	= new Qayadaccount;
					$objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("ORDERBY", 'transaction_id DESC');
					 $objQayadaccount->setProperty("GROUPBY", 'transaction_number');
					//DATEFILTER
					//STARTDATE
					//ENDDATE
					$objQayadaccount->setProperty("trans_date", date("Y-m-d"));
					//$objQayadaccount->setProperty("trans_date", '2023-07-23');
					$objQayadaccount->setProperty("trans_position", 1);
					//$objQayadaccount->setProperty("pay_mode", 1);
					$objQayadaccount->setProperty("daybook_filter", "YES");
					
					$objQayadaccount->setProperty("trans_mode", 1);
					$objQayadaccount->setProperty("pay_mode_array", '1,2,3,4,5,6,9');
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstAccountTransaction();
                    while($ListOfTransaction = $objQayadaccount->dbFetchArray(1)){
						
						
						
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$TransferHeadDetail = $objQayadaccountHead->dbFetchArray(1);
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						
						if($ListOfTransaction["transfer_item_id"] != ''){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("item_id", $ListOfTransaction["transfer_item_id"]);
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
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$TransactionHeadDetail = $objQayadaccountHead->dbFetchArray(1);	
						$TransferHeadItem = $TransactionHeadDetail["head_title"];
						}
						
						if($TransferHeadDetail["head_type_id"] == 2){
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountHead->lstHead();
						$TransferHeadDetail = $objQayadaccountHead->dbFetchArray(1);
						$TransactionHeadTypeTitle = AccountHeadType($TransferHeadDetail["head_type_id"]);
						
						if($ListOfTransaction["item_id"] != ''){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("item_id", $ListOfTransaction["item_id"]);
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
                  <td><?php echo $ListOfTransaction["trans_date"];?></td>
                    <td><?php echo $ListOfTransaction["transaction_number"];?></td>
                    <td><?php echo $TransactionHeadTypeTitle;//echo $TransferHeadDetail["head_title"];?></td>
                    <td><?php echo $TransferHeadItem;?></td>
                    <td><?php echo $ListOfTransaction["trans_title"];?> <small><br>
                      <?php echo ' '.$ListOfTransaction["trans_note"];?>
                      </small></td>
                    <!--<td><?php //echo PaymentOption($ListOfTransaction["pay_mode"]);?></td>-->
                    
                    <td><?php echo ($ListOfTransaction["trans_amount"]);?></td>
                  </tr>
                  <?php } //} ?>
                </tbody>
              </table>
            </div>
            
            <hr />
            
            <h4 class="card-title CardWidth" style="width:100% !important;">Credit Transactions </h4>
            <div class="material-datatables">
              <table  data-order="[[ 0, &quot;desc&quot; ]]" class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th align="center">Date</th>
                    <th align="center">Transaction#</th>
                    <th align="center">Head</th>
                    <th align="center">Item/Head</th>
                    <th align="center">Description</th>
                    <!--<th align="center">Pay Mode</th>-->
                    <th align="center">Amount</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php
					$objQayadaccountHead	= new Qayadaccount;
					$objQayadaccountTHead	= new Qayadaccount;
					$objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("ORDERBY", 'transaction_id DESC');
					 $objQayadaccount->setProperty("GROUPBY", 'transaction_number');
					//DATEFILTER
					//STARTDATE
					//ENDDATE
					$objQayadaccount->setProperty("trans_date", date("Y-m-d"));
					//$objQayadaccount->setProperty("trans_date", '2023-05-04');
					$objQayadaccount->setProperty("trans_position", 1);
					//$objQayadaccount->setProperty("pay_mode", 1);
					$objQayadaccount->setProperty("daybook_filter", "YES");
					$objQayadaccount->setProperty("trans_mode", 2);
					$objQayadaccount->setProperty("pay_mode_array", '1,2,3,4,5,6');
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstAccountTransaction();
                    while($ListOfTransaction = $objQayadaccount->dbFetchArray(1)){
						
						
						
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountHead->lstHead();
						$MainHeadTitle = $objQayadaccountHead->dbFetchArray(1);
						$MainTransactionType = AccountHeadType($MainHeadTitle["head_type_id"]);
						
						if($ListOfTransaction["item_id"] != ''){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("item_id", $ListOfTransaction["item_id"]);
						$objQayadaccountTHead->lstHeadItems();
						$TransferHeadDetailItem = $objQayadaccountTHead->dbFetchArray(1);
						$MainHeadItemTitle = $TransferHeadDetailItem["item_title"];
						if($TransferHeadDetail["head_type_id"] != 7){
						$TransactionHeadTypeTitle = $TransferHeadDetail["head_title"];	
						} else {
						$TransactionHeadTypeTitle = $TransactionHeadTypeTitle;
						}
						} else {
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountTHead->lstHead();
						$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
						$MainHeadItemTitle = $TransferHeadDetail["head_title"];
						}
						
						if($ListOfTransaction["aplic_mode"] == 4){
						/*$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountHead->lstHead();
						$MainHeadTitle = $objQayadaccountHead->dbFetchArray(1);
						$MainTransactionType = 'Drawing Accounts';*/
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$MainHeadTitle = $objQayadaccountHead->dbFetchArray(1);
						//$MainTransactionType = AccountHeadType($MainHeadTitle["head_type_id"]);
						if($MainHeadTitle["head_type_id"] >= 2 && $MainHeadTitle["head_type_id"] <= 3){
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountHead->lstHead();
						$MainHeadTitle = $objQayadaccountHead->dbFetchArray(1);	
						$MainTransactionType = AccountHeadType($MainHeadTitle["head_type_id"]);
						} else {
						$MainTransactionType = AccountHeadType($MainHeadTitle["head_type_id"]);
						}
						
						
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("head_id", $ListOfTransaction["transfer_head_id"]);
						$objQayadaccountTHead->lstHead();
						$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
						
						if($TransferHeadDetail["head_type_id"] >= 2 && $TransferHeadDetail["head_type_id"] <= 3){
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountTHead->lstHead();
						$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
						$MainHeadItemTitle = $TransferHeadDetail["head_title"];
						} else {
						$MainHeadItemTitle = $TransferHeadDetail["head_title"];
						}
						
						
						} else {
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountHead->lstHead();
						$MainHeadTitle = $objQayadaccountHead->dbFetchArray(1);
						$MainTransactionType = AccountHeadType($MainHeadTitle["head_type_id"]);
						
						$objQayadaccountTHead->resetProperty();
						$objQayadaccountTHead->setProperty("head_id", $ListOfTransaction["head_id"]);
						$objQayadaccountTHead->lstHead();
						$TransferHeadDetail = $objQayadaccountTHead->dbFetchArray(1);
						$MainHeadItemTitle = $TransferHeadDetail["head_title"];	
						}
						
						if($ListOfTransaction["aplic_mode"] == 8){
						$objQayadaccountHead->resetProperty();
						$objQayadaccountHead->setProperty("head_id", $ListOfTransaction["transfer_head_id"]);
						$objQayadaccountHead->lstHead();
						$MainHeadTitle = $objQayadaccountHead->dbFetchArray(1);
						$MainTransactionType = AccountHeadType($MainHeadTitle["head_type_id"]);
						$MainHeadItemTitle = $MainHeadTitle["head_title"];	
							
							
						}
                    ?>
                  <tr>
                  <td><?php echo dateFormate_3($ListOfTransaction["trans_date"]).' -- '.$ListOfTransaction["aplic_mode"];?></td>
                    <td><?php echo $ListOfTransaction["transaction_number"];?></td>
                    <td><?php echo $MainTransactionType;?></td>
                    <td><?php echo $MainHeadItemTitle;?></td>
                    <td><?php echo $ListOfTransaction["trans_title"];?> <small><br>
                      <?php echo ' '.$ListOfTransaction["trans_note"];?>
                      </small></td>
                    <!--<td><?php //echo PaymentOption($ListOfTransaction["pay_mode"]);?></td>-->
                    
                    <td><?php echo ($ListOfTransaction["trans_amount"]);?></td>
                  </tr>
                  <?php } //} ?>
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
