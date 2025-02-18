<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php if(trim($objBF->decrypt($_GET['rc'], 1, ENCRYPTION_KEY)) == 'get' && trim($objBF->decrypt($_GET['ti'], 1, ENCRYPTION_KEY)) != '' && trim($objBF->decrypt($_GET['tn'], 1, ENCRYPTION_KEY)) != ""){?>
        
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">money_off</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Wrong Transactions</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=wrongtransactionform');?>" class="btn btn-primary">Back</a> </div>
            <hr>
            
             <h4 class="card-title CardWidth" style="width:100% !important;"> Debit Transactions </h4>
           
              <table data-order="[[ 0, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
					//$objQayadaccount->setProperty("trans_position", 1);
					$objQayadaccount->setProperty("transaction_number", trim($objBF->decrypt($_GET['tn'], 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("trans_mode", 1);
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstAccountTransaction();
					if($objQayadaccount->totalRecords() > 0){
                    $ListOfTransaction = $objQayadaccount->dbFetchArray(1);
						
						$DebitEntityID = $ListOfTransaction["entery_id"];
						$DebitTransactionId = $ListOfTransaction["transaction_id"];
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
                  <td><?php echo dateFormate_3($ListOfTransaction["trans_date"]);?></td>
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
        
           <br /><br />
            <h4 class="card-title CardWidth" style="width:100% !important;">Credit Transactions </h4>
              <table  data-order="[[ 0, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
					//$objQayadaccount->setProperty("trans_position", 1);
					$objQayadaccount->setProperty("trans_mode", 2);
					$objQayadaccount->setProperty("transaction_number", trim($objBF->decrypt($_GET['tn'], 1, ENCRYPTION_KEY)));
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstAccountTransaction();
					if($objQayadaccount->totalRecords() > 0){
                    $ListOfTransaction = $objQayadaccount->dbFetchArray(1);
						
						
						$CreditTransactionId = $ListOfTransaction["transaction_id"];
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
                  <td><?php echo dateFormate_3($ListOfTransaction["trans_date"]);?></td>
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
            
      
      		<?php 
			if($DebitTransactionId != 0 && $DebitTransactionId !=''){
				$objQayadaccount->resetProperty();
				//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayadaccount->setProperty("head_id", $DebitTransactionId);
				$objQayadaccount->lstHead();
				$GetHeadDetail = $objQayadaccount->dbFetchArray(1);	
				if($GetHeadDetail["head_type_id"] == 6){
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_request_id", $DebitEntityID);
					$objSSSjatlan->lstOrderRequestDetail();
					$GetOrderDetail_id = $objSSSjatlan->dbFetchArray(1);
					$OrderRequested_id = $GetOrderDetail_id['order_request_id'];
					$GetOrderRequestType = $GetOrderDetail_id['order_request_id'];
				} elseif($GetHeadDetail["head_type_id"] == 4){
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("order_request_id", $DebitEntityID);
					$objSSSjatlan->lstOrderRequestDetail();
					$GetOrderDetail_id = $objSSSjatlan->dbFetchArray(1);
					$OrderRequested_id = $GetOrderDetail_id['order_request_id'];
				} else {
					$OrderRequested_id = 0;
				}
			} else {
					$OrderRequested_id = 0;	
			}
			
			if($OrderRequested_id != 0){
				
			}
			?>
            
          </div>
          
          <!-- end content--> 
          
          <hr /><br />
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo 'Remove';?>">
            
            <input type="hidden" name="dti" value="<?php echo $objBF->encrypt($OrderRequested_id, ENCRYPTION_KEY);?>" />
            
 			<input type="hidden" name="cti" value="<?php 
			if($CreditTransactionId != ''){
			echo $objBF->encrypt($CreditTransactionId, ENCRYPTION_KEY);
			} else {
			echo $objBF->encrypt('0', ENCRYPTION_KEY);	
			}
			?>" />
            <input type="hidden" name="dti" value="<?php 
			if($DebitTransactionId != ''){
			echo $objBF->encrypt($DebitTransactionId, ENCRYPTION_KEY);
			} else {
			echo $objBF->encrypt('0', ENCRYPTION_KEY);	 	
			}
			?>" />
            <input type="hidden" name="tn" value="<?php echo $objBF->encrypt(trim($objBF->decrypt($_GET['tn'], 1, ENCRYPTION_KEY)), ENCRYPTION_KEY);?>" />
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Write Reason:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'wrong_reason');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="wrong_reason" required tabindex="1" />
                  <small><?php echo $vResult["wrong_reason"];?></small> </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill remove" tabindex="2">Remove</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
        </div>
        
        <?php } else { ?>
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo 'S';?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Wrong Transaction';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=wrongtransaction');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <?php if(trim($objBF->decrypt($_GET['e'], 1, ENCRYPTION_KEY)) == 'wrong'){?>
            <div class="row"><div class="col-sm-12" style="text-align:center; color:#F00; border-bottom:dotted 2px #990000;"><h4>System unable to find your entered Transaction Number. <code><?php echo trim($objBF->decrypt($_GET['tn'], 1, ENCRYPTION_KEY));?></code></h4></div></div>
            <?php } ?>
            <div class="row">
              <label class="col-sm-2 label-on-left">Enter Transaction #</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'location_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="wrong_tran_no" required value="<?php echo trim($objBF->decrypt($_GET['tn'], 1, ENCRYPTION_KEY));?>" tabindex="1" />
                  <small><?php echo $vResult["wrong_tran_no"];?></small> </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="2">Search</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
        </div>
        <?php } ?>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>