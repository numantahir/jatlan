<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon payment" data-background-color="purple"> <img src="../assets/img/c-payment.png"> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Customer Payment Request Management</h4>
            <div class="toolbar text-right"></div>
            <hr>
            <div class="material-datatables">
            <?php if($_GET['i']==''){?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Transfer Mode</th>
                    <th>Customer Name</th>
                    <th>Application #</th>
                    <th>Transfer Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Transfer Mode</th>
                    <th>Customer Name</th>
                    <th>Application #</th>
                    <th>Transfer Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>View</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayadapplication->resetProperty();
                    $objQayadapplication->setProperty("ORDERBY", 'entery_date DESC');
                    $objQayadapplication->lstAplicCustomerPaymentTransfer();
                    while($PaymentTransferList = $objQayadapplication->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo PaymentModeType($PaymentTransferList["transfer_mode"]);?></td>
                    <td><?php echo $PaymentTransferList["fullname"];?></td>
                    <td><?php echo $PaymentTransferList["reg_number"];?></td>
                    <td><?php echo dateFormate_3($PaymentTransferList["transfer_date"]);?></td>
                    <td><?php echo $PaymentTransferList["transfer_amount"];?></td>
                    <td><?php echo PaymentTransferStatus($PaymentTransferList["transfer_status"]);?></td>
                    <td><a href="<?php echo Route::_('show=paymentrequest&i='.EncData($PaymentTransferList["cpt_id"], 2, $objBF));?>"><i class="material-icons">visibility</i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
             <?php } else {
				$objQayadapplication->resetProperty();
				$objQayadapplication->setProperty("cpt_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadapplication->lstAplicCustomerPaymentTransfer();
				$PaymentTransferList = $objQayadapplication->dbFetchArray(1);
			 ?>
             <table class="table table-bordered" cellspacing="0" width="100%" style="width:100%">
             	  <tr>
                  	<td>Current Request Status: <strong><?php echo PaymentTransferStatus($PaymentTransferList["transfer_status"]);?></strong></td>
                    <td class="text-right">
                    <?php if($PaymentTransferList["transfer_status"] == 1){ ?>
                    <a href="<?php echo Route::_('show=paymentrequest&i='.EncData($PaymentTransferList["cpt_id"], 2, $objBF).'&c='.EncData('m', 2, $objBF).'&d='.EncData('Accept', 2, $objBF));?>" class="btn btn-primary">Request Accept</a> &nbsp; &nbsp; &nbsp; <?php } ?>
                    <?php if($PaymentTransferList["transfer_status"] == 2){ ?>
                    <a href="<?php echo Route::_('show=paymentrequest&api='.EncData($PaymentTransferList["aplic_id"], 2, $objBF).'&ini='.EncData($PaymentTransferList["instalment_id"], 2, $objBF).'&i='.EncData($PaymentTransferList["cpt_id"], 2, $objBF).'&c='.EncData('m', 2, $objBF).'&d='.EncData('Process', 2, $objBF));?>" class="btn btn-primary">Process Request</a> &nbsp; &nbsp; &nbsp; <?php } ?>
                    
                    <?php if($PaymentTransferList["transfer_status"] != 4){ ?>
                    <a href="<?php echo Route::_('show=paymentrequest&i='.EncData($PaymentTransferList["cpt_id"], 2, $objBF).'&c='.EncData('m', 2, $objBF).'&d='.EncData('Reject', 2, $objBF));?>" class="btn btn-primary">Request Reject</a><?php } ?></td>
                  </tr>
                <tbody>
                  <tr>
                    <td>Transfer Mode</td>
                    <td><?php echo PaymentModeType($PaymentTransferList["transfer_mode"]);?></td>
                  </tr>
                  <tr>
                    <td>Application #</td>
                    <td><?php echo $PaymentTransferList["reg_number"];?></td>
                  </tr>
                  <tr>
                    <td>Customer Full Name</td>
                    <td><?php echo $PaymentTransferList["fullname"];?></td>
                  </tr>
                  <tr>
                    <td>Customer Contact Number</td>
                    <td><?php echo $PaymentTransferList["customer_mobile"];?></td>
                  </tr>
                  <tr>
                    <td>Transfer From Name</td>
                    <td><?php echo $PaymentTransferList["transfer_from_name"];?></td>
                  </tr>
                  <tr>
                    <td>Transfer From Country</td>
                    <td><?php echo $objCommon->getCountryName($PaymentTransferList["transfer_from_country"]);?></td>
                  </tr>
                  <?php if($PaymentTransferList["transfer_mode"] == 1 && $PaymentTransferList["transfer_mode"]== 2){?>
                  <tr>
                    <td>Transfer From Bank</td>
                    <td><?php echo $PaymentTransferList["transfer_from_bank"];?></td>
                  </tr>
                  <tr>
                    <td>Transfer From Bank Branch</td>
                    <td><?php echo $PaymentTransferList["transfer_from_branch"];?></td>
                  </tr>
                  <tr>
                    <td>Transaction/Bank Ac Number</td>
                    <td><?php echo $PaymentTransferList["transfer_from_number"];?></td>
                  </tr>
                  <tr>
                    <td>Transfer to Bank</td>
                    <td><?php 
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("item_id", $PaymentTransferList["transfer_to_bank"]);
						$objQayadaccount->lstHeadItems();
						$HeadITemName = $objQayadaccount->dbFetchArray(1);
						echo $HeadITemName["item_title"];
					?></td>
                  </tr>
                  <?php } else { ?>
                  <tr>
                    <td>Transaction Number</td>
                    <td><?php echo $PaymentTransferList["transfer_from_number"];?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td>Transfer Amount</td>
                    <td><?php echo Numberformt($PaymentTransferList["transfer_amount"]);?></td>
                  </tr>
                  <tr>
                    <td>Transfer Note/Detail</td>
                    <td><?php echo $PaymentTransferList["transfer_from_note"];?></td>
                  </tr>
                  <tr>
                    <td>Transfer Attachement</td>
                    <td><a href="<?php echo CLIENT_SITE_URL.'dn.php?di='.base64_encode(CUSTOMER_DOCUMENT_URL.$PaymentTransferList["transfer_from_filename"]);?>" target="new">Download</a></td>
                  </tr>
                </tbody>
              </table>
             <?php } ?>
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