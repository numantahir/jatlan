<?php
$objQayaduser->resetProperty();
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
$objQayaduser->setProperty("request_flow_type", 2);
$objQayaduser->lstUserRequestFlow();
if($objQayaduser->totalRecords() > 0){
	$GetEmpDetail_section_a = $objQayaduser->dbFetchArray(1);
		/******************************************************/
		/*$objQayaduser->resetProperty();
		$objQayaduser->setProperty("user_id", $GetEmpDetail_section_a["overtime_request_to"]);
		$objQayaduser->lstUsers();
		$ReceiverOverTimeEmpDetail = $objQayaduser->dbFetchArray(1);*/
		$overtime_request_stage = 1;
		$Payment_request_to = $GetEmpDetail_section_a["overtime_request_to"];
		/******************************************************/
} else {	
	$objQayaduser->resetProperty();
	$objQayaduser->setProperty("isActive", 1);
	$objQayaduser->setProperty("company_id", $LoginUserInfo["company_id"]);
	$objQayaduser->setProperty("department_id", $LoginUserInfo["department_id"]);
	$objQayaduser->setProperty("request_flow_type", 1);
	$objQayaduser->lstUserRequestFlow();
	if($objQayaduser->totalRecords() > 0){
		$GetEmpDetail_section_b = $objQayaduser->dbFetchArray(1);
			/******************************************************/
			/*$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", $GetEmpDetail_section_b["overtime_request_to"]);
			$objQayaduser->lstUsers();
			$ReceiverOverTimeEmpDetail_section_b = $objQayaduser->dbFetchArray(1);*/
			$overtime_request_stage = 2;
			$Payment_request_to = $GetEmpDetail_section_b["overtime_request_to"];
			/******************************************************/
	} else {
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_type_id", 3);
			$objQayaduser->lstUsers();
			$ReceiverLeaveEmpDetail_section_c = $objQayaduser->dbFetchArray(1);
			$overtime_request_stage = 3;
			$Payment_request_to = $ReceiverLeaveEmpDetail_section_c["user_id"];
	}
}


if(trim($objBF->decrypt($_GET["apm"], 1, ENCRYPTION_KEY)) == 1){

$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
$objQayaduser->setProperty("isActive", 1);
$objQayaduser->setProperty("salary_type", 1);
$objQayaduser->lstSalary();
$UserSalary = $objQayaduser->dbFetchArray(1);
	?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="aplic_mode" value="<?php echo trim($objBF->decrypt($_GET["apm"], 1, ENCRYPTION_KEY));?>">
            <input type="hidden" name="apply_type_id" value="1">
            <input type="hidden" name="pri" value="<?php echo $Payment_request_to;?>" />
            <div class="card-header card-header-text" data-background-color="rose">
            
              <h4 class="card-title"><?php echo 'Advance Salary Request';?></h4>
            
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=payreq');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Advance Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'salary_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="salary_amount" max="<?php echo trim(DecData($UserSalary["salary_amount"], 1, $objBF));?>" required tabindex="1" />
                  <small><?php echo $vResult["salary_amount"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Advance From Month</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'advance_month');?>">
                  <label class="control-label"></label>
                  <input type="hidden" name="advance_month" value="<?php echo date("m");?>" />
                  <input class="form-control" type="text" name="print_name" readonly tabindex="2" value="<?php echo date("M");?>" />
                  <small><?php echo $vResult["advance_month"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Reason/Note.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'advance_reason');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="advance_reason" rows="8" tabindex="3"></textarea>
                  <small><?php echo $vResult["advance_reason"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Advance Return</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="payback_option" id="salary_type" title="Advance Return Option" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>One Time</option>
                  </select>
                </div>
              </div>
            </div>
			
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
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
<?php } elseif(trim($objBF->decrypt($_GET["apm"], 1, ENCRYPTION_KEY)) == 2){?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="aplic_mode" value="<?php echo trim($objBF->decrypt($_GET["apm"], 1, ENCRYPTION_KEY));?>">
            <input type="hidden" name="apply_type_id" value="2">
            <input type="hidden" name="pri" value="<?php echo $Payment_request_to;?>" />
            <div class="card-header card-header-text" data-background-color="rose">
            
              <h4 class="card-title"><?php echo 'Personal Load Request';?></h4>
            
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=payreq');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Loan Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'salary_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="salary_amount" required tabindex="1" />
                  <small><?php echo $vResult["salary_amount"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Loan From Month</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'advance_month');?>">
                  <label class="control-label"></label>
                  <input type="hidden" name="advance_month" value="<?php echo date('m',strtotime('first day of +1 month'));;?>" />
                  <input class="form-control" type="text" name="print_name" readonly tabindex="2" value="<?php echo date('M',strtotime('first day of +1 month'));;?>" />
                  <small><?php echo $vResult["advance_month"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Reason/Note.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'advance_reason');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="advance_reason" rows="8" tabindex="3"></textarea>
                  <small><?php echo $vResult["advance_reason"];?></small> </div>
              </div>
            </div>
            
             <div class="row">
              <label class="col-sm-2 label-on-left">Advance Return</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="payback_option" id="salary_type" title="Advance Return Option" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>One Time</option>
                    <option value="2" <?php //echo StaticDDSelection(2, $isActive);?>>Monthly Instalment</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row" id="apply_from_div" style="display:none;">
              <label class="col-sm-2 label-on-left">No of Months</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="payback_in_months" title="Select Loan Return Duration" tabindex="5">
                    <?php for($i=1;$i<=11;$i++){?>
                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
			
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
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
<?php } elseif(trim($objBF->decrypt($_GET["apm"], 1, ENCRYPTION_KEY)) == 3){?>
<?php } elseif(trim($objBF->decrypt($_GET["apm"], 1, ENCRYPTION_KEY)) == 4){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_type_id", 3);
$objQayaduser->lstUsers();
$DirectAccountPersonDetail = $objQayaduser->dbFetchArray(1);
$PaymentRequestToFD = $DirectAccountPersonDetail["user_id"];	
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="aplic_mode" value="<?php echo trim($objBF->decrypt($_GET["apm"], 1, ENCRYPTION_KEY));?>">
            <input type="hidden" name="apply_type_id" value="4">
            <input type="hidden" name="pri" value="<?php echo $Payment_request_to;?>" />
            <input type="hidden" name="aci" value="<?php echo $PaymentRequestToFD;?>" />
            <div class="card-header card-header-text" data-background-color="rose">
            
              <h4 class="card-title"><?php echo 'Miscellaneous Items Payment Request';?></h4>
            
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=payreq');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Item</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="head_item_id" title="List of items" required tabindex="1">
					<?php
                    $objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("isActive", 1);
                   // $objQayadaccount->setProperty("head_id", 9);
                    $objQayadaccount->setProperty("ORDERBY", 'item_title');
                    $objQayadaccount->lstHeadItems();
					 while($HeadItemList = $objQayadaccount->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $HeadItemList["item_id"];?>"><?php echo $HeadItemList["item_title"];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Qty/ltr</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'item_qty');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="item_qty" required tabindex="1" value="1" />
                  <small><?php echo $vResult["item_qty"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Required Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'requested_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="requested_amount" required tabindex="1" />
                  <small><?php echo $vResult["requested_amount"];?></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Reason/Note.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'reason_note');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="reason_note" rows="8" tabindex="3"></textarea>
                  <small><?php echo $vResult["reason_note"];?></small> </div>
              </div>
            </div>

			
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
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
<?php } ?>