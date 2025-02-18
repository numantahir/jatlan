<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Payment Request</h4>
            <div class="toolbar text-right"> <a href="#" data-toggle="modal" data-target="#receivedpaymentpopup" class="btn btn-primary">Apply New</a> </div>
            
            <div class="modal fade transaction" id="receivedpaymentpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog transaction">
                                    <div class="modal-content transaction">
                                        <div class="modal-header transaction">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
											<div class="pop-heading">
                                            	<h4 class="modal-title">Payment Request Apply For</h4>
											</div>
                                        </div>
                                        <div class="modal-body transaction">
                                        
                                        <br />
                                        
                                        
                                        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=payreqform&apm='.EncData('1', 2, $objBF));?>">Advance Salary</a></td>
                  </tr>
                  <!-- <tr>
                    <td align="center"><a href="<?php echo Route::_('show=payreqform&apm='.EncData('2', 2, $objBF));?>">Personal Loan</a></td>
                  </tr>-->
                  <!-- <tr>
                    <td align="center"><a href="<?php echo Route::_('show=payreqform&apm='.EncData('4', 2, $objBF));?>">Other Miscellaneous Items</a></td>
                  </tr>-->
                </tbody>
              </table>
                                            <div class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Apply For</th>
                    <th>Amount</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th>Current Stage</th>
                    <th>Current Stage Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadItemGet = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("ORDERBY", "payment_request_id DESC");
					$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
                    $objQayaduser->lstPaymentRequestsList();
                    while($PaymentRequest = $objQayaduser->dbFetchArray(1)){
						if($PaymentRequest["apply_type_id"] == 4){
							
							//
							$objQayadItemGet->resetProperty();
							$objQayadItemGet->setProperty("payment_request_id", $PaymentRequest["payment_request_id"]);
							$objQayadItemGet->lstPaymentRequestsItemsList();
							$GetItemDetail = $objQayadItemGet->dbFetchArray(1);
							
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("item_id", $GetItemDetail["item_id"]);
							$objQayadaccount->lstHeadItems();
							$GetItemName = $objQayadaccount->dbFetchArray(1);
							$ReturnItemName = ' - <code>'.$GetItemName["item_title"] . ' Request</code>';
						} else {
							$ReturnItemName = '';
						}
                    ?>
                  <tr>
                  	<td><?php echo PaymentRequestApplyFor($PaymentRequest["apply_type_id"]).$ReturnItemName;?></td>
                    <td><?php echo $PaymentRequest["requested_amount"];?></td>
                    <td><?php echo dateFormate_4($PaymentRequest["apply_date"]);?></td>
                    <td><?php echo PaymentRequestStatus($PaymentRequest["request_status"]);?></td>
                    <td><?php echo PaymentRequestCurrentStage($PaymentRequest["request_stage"]);?></td>
                    <td><?php echo PaymentRequestStatus($PaymentRequest["request_stage_status"]);?></td>
                    <td>
                    <?php if($PaymentRequest["request_status"] == 2){?>
                    <a class="confirm" href="<?php echo Route::_('show=payreq&rq='.EncData('Delete', 2, $objBF).'&i='.EncData($PaymentRequest["payment_request_id"], 2, $objBF).'&t='.EncData($PaymentRequest["apply_type_id"], 2, $objBF));?>"><i class="material-icons">delete</i></a>
                    <?php } else { }?>
                    </td>
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