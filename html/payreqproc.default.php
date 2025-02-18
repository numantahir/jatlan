<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
           <?php if(trim(DecData($_GET["rq"], 1, $objBF)) == 'View' && trim(DecData($_GET["i"], 1, $objBF)) != ''){?>
           <h4 class="card-title CardWidth"><?php echo $GetRequestedUserName; ?> Apply for <code><?php echo PaymentRequestApplyFor($PaymentRequest["apply_type_id"]);?></code> Payment Request</h4>
           <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=payreqproc');?>" class="btn">Back</a> </div>
		   <?php } else { ?>
            <h4 class="card-title CardWidth">Pending Payment Request List</h4>
            <?php } ?>
             
            <hr>
            <div class="material-datatables">
              <?php if(trim(DecData($_GET["rq"], 1, $objBF)) == 'View' && trim(DecData($_GET["i"], 1, $objBF)) != ''){?>

              <h4 class="card-title CardWidth">Overview</h4>
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Request From</th>
                    <th>Apply For</th>
                    <th>Requested Amount</th>
                    <th>Apply Date</th>
                  </tr>
                </thead>
                <tbody>
					
                  <tr>
                  <td><?php echo $GetRequestedUserName; ?></td>
                    <td><?php echo PaymentRequestApplyFor($PaymentRequest["apply_type_id"]);?></td>
                    <td><?php echo $PaymentRequest["requested_amount"];?></td>
                     <td><?php echo dateFormate_4($PaymentRequest["apply_date"]);?></td>
                  </tr>
                </tbody>
              </table>
              <hr />
              
              <?php if($PaymentRequest["apply_type_id"] == 1){?>
              
              <h4 class="card-title CardWidth">Advance Salry Request Detail</h4>
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Payback</th>
                    <th>Reason</th>
                    <th>Requested Month</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <td><?php echo AdvancePayBackMode($AdvanceSalaryDetail["payback_option"]); ?></td>
                    <td><?php echo $AdvanceSalaryDetail["advance_reason"]; ?></td>
                    <td><?php echo MonthList($AdvanceSalaryDetail["advance_month"]);?></td>
                  </tr>
                </tbody>
              </table>
              <hr />
              <h4 class="card-title CardWidth"><?php echo $GetRequestedUserName; ?> Previous Apply History </h4>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Apply For</th>
                    <th>Amount</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th>Current Stage</th>
                    <th>Current Stage Status</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadItemGet = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("ORDERBY", "payment_request_id DESC");
					$objQayaduser->setProperty("payment_request_id_not", trim(DecData($_GET["i"], 1, $objBF)));
					$objQayaduser->setProperty("user_id", $PaymentRequest["user_id"]);
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
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <hr />
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                  	<td align="center"><a href="<?php echo Route::_('show=payreqproc&s='.EncData('ati_1', 2, $objBF).'&rq='.EncData('1', 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&rd='.EncData(date("Ymd"), 2, $objBF).'&rb='.EncData($LoginUserInfo["user_id"], 2, $objBF));?>" class="payreq_approved btn btn-rose btn-fill">Approved</a>&nbsp;&nbsp; | &nbsp;&nbsp; <a href="<?php echo Route::_('show=payreqproc&s='.EncData('ati_1', 2, $objBF).'&rq='.EncData('2', 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&rb='.EncData($LoginUserInfo["user_id"], 2, $objBF));?>" class="payreq_reject btn btn-fill">Reject</a></td>
                  </tr>
                </tbody>
              </table>
              <?php }elseif($PaymentRequest["apply_type_id"] == 2){?>
              <h4 class="card-title CardWidth">Personal Loan Request Detail</h4>
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Payback</th>
                    <th>Reason</th>
                    <th>Requested Month</th>
                    <th>Payback In</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                  <td><?php echo AdvancePayBackMode($AdvanceSalaryDetail["payback_option"]); ?></td>
                    <td><?php echo $AdvanceSalaryDetail["advance_reason"]; ?></td>
                    <td><?php echo MonthList($AdvanceSalaryDetail["advance_month"]);?></td>
                    <td><?php echo $AdvanceSalaryDetail["payback_in_months"]; ?> Months</td>
                  </tr>
                </tbody>
              </table>
              <hr />
              
              <h4 class="card-title CardWidth">Payback Detail</h4>
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Payback Date</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("isActive_not", 3);
				$objQayaduser->setProperty("payment_request_id", $PaymentRequest["payment_request_id"]);
				$objQayaduser->setProperty("advance_salary_id", $AdvanceSalaryDetail["advance_salary_id"]);
				$objQayaduser->lstPaymentRequestsAdvanceSalaryPayBack();
				while($PayBackDetail = $objQayaduser->dbFetchArray(1)){
				?>
                  <tr>
                  <td><?php echo dateFormate_3($PayBackDetail["payback_date"]); ?></td>
                    <td><?php echo $PayBackDetail["monthly_amount"]; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              
              <hr />
              <h4 class="card-title CardWidth"><?php echo $GetRequestedUserName; ?> Previous Apply History </h4>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Apply For</th>
                    <th>Amount</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th>Current Stage</th>
                    <th>Current Stage Status</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadItemGet = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("ORDERBY", "payment_request_id DESC");
					$objQayaduser->setProperty("payment_request_id_not", trim(DecData($_GET["i"], 1, $objBF)));
					$objQayaduser->setProperty("user_id", $PaymentRequest["user_id"]);
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
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <hr />
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                  	<td align="center"><a href="<?php echo Route::_('show=payreqproc&s='.EncData('ati_2', 2, $objBF).'&rq='.EncData('1', 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&rd='.EncData(date("Ymd"), 2, $objBF).'&rb='.EncData($LoginUserInfo["user_id"], 2, $objBF));?>" class="payreq_approved btn btn-rose btn-fill">Approved</a>&nbsp;&nbsp; | &nbsp;&nbsp; <a href="<?php echo Route::_('show=payreqproc&s='.EncData('ati_2', 2, $objBF).'&rq='.EncData('2', 2, $objBF).'&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&rb='.EncData($LoginUserInfo["user_id"], 2, $objBF));?>" class="payreq_reject btn btn-fill">Reject</a></td>
                  </tr>
                </tbody>
              </table>
              <?php } ?>
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              
              <?php } else { ?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Req From</th>
                    <th>Req For</th>
                    <th>Req Amount</th>
                    <th>Apply Date</th>
                    <th>Status</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadItemGet = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("ORDERBY", "payment_request_id DESC");
					$objQayaduser->setProperty("request_fwd_dep_to", $LoginUserInfo["user_id"]);
					$objQayaduser->setProperty("request_fwd_dep_status_array", '2, 4');
                    $objQayaduser->lstPaymentRequestsList();
                    while($PaymentRequest = $objQayaduser->dbFetchArray(1)){
						$objQayadItemGet->resetProperty();
                    ?>
                  <tr>
                  <td><?php echo $objQayadItemGet->GetUserFullName($PaymentRequest["user_id"]); ?></td>
                    <td><?php echo PaymentRequestApplyFor($PaymentRequest["apply_type_id"]);?></td>
                    <td><?php echo $PaymentRequest["requested_amount"];?></td>
                     <td><?php echo dateFormate_4($PaymentRequest["apply_date"]);?></td>
                    <td><?php echo PaymentRequestStatus($PaymentRequest["request_status"]);?></td>
                    
                    
                    <td><a href="<?php echo Route::_('show=payreqproc&rq='.EncData('View', 2, $objBF).'&i='.EncData($PaymentRequest["payment_request_id"], 2, $objBF));?>">View</a></td>
                  </tr>
                  <?php } ?>
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