<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="customer_id" value="<?php echo $objBF->encrypt($customer_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="customer_type" value="1" />
            <input type="hidden" name="mode" value="<?php echo $mode;?>" />
            <?php $TranMode = 0;?>
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Supplier Information', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=suppliers');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Business Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_business_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="customer_business_name" value="<?php echo $customer_business_name;?>" tabindex="1" />
                  <small><?php echo $vResult["customer_business_name"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Supplier Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="customer_name" required value="<?php echo $customer_name;?>" tabindex="2" />
                  <small><?php echo $vResult["customer_name"];?></small> </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 label-on-left">Phone #</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_phone');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="customer_phone" value="<?php echo $customer_phone;?>" tabindex="3" />
                  <small><?php echo $vResult["customer_phone"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Mobile #</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_mobile');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="customer_mobile" value="<?php echo $customer_mobile;?>" tabindex="4" />
                  <small><?php echo $vResult["customer_mobile"];?></small> </div>
              </div>
            </div>
           <div class="row">
              <label class="col-sm-2 label-on-left">Email Address</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_email');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="customer_email" value="<?php echo $customer_email;?>" tabindex="5" />
                  <small><?php echo $vResult["customer_email"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Supplier Address</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_address');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="customer_address" value="<?php echo $customer_address;?>" tabindex="7" />
                  <small><?php echo $vResult["customer_address"];?></small> </div>
              </div>
            </div>
            
            <?php if($mode == 'I'){
				$TranMode = 1;
				?>
            <hr />
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Opening Balance</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_balance');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" min="0" name="opening_balance" value="0" tabindex="9" />
                  <small><?php echo $vResult["opening_balance"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Opening Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="opening_date" value="<?php echo date("m/d/Y");?>" tabindex="9" />
                  <small><?php echo $vResult["opening_date"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Balance As</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="trans_mode" title="Balance AS" tabindex="10">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Debit (Pending Payment)</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>Credit (Advance from Supplier Side)</option>
                  </select>
                </div>
              </div>
            </div>
           <hr />
            <?php } else {
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("entity_id", $customer_id);
				$objQayadaccount->setProperty("head_type_id", 6);
				$objQayadaccount->setProperty("isActive", 1);
				$objQayadaccount->lstHead();
				$GetCustomerHead = $objQayadaccount->dbFetchArray(1);
				
				$objQayadaccount->resetProperty();
				$objQayadaccount->setProperty("pay_mode", 7);
				$objQayadaccount->setProperty("head_id", $GetCustomerHead["head_id"]);
				$objQayadaccount->lstAccountTransaction();
				$CheckOpendingBalance = $objQayadaccount->totalRecords();
				$CheckLastBalance = $objQayadaccount->dbFetchArray(1);
				if($CheckOpendingBalance == 0){
				$TranMode = 1;
				 ?>
            
             <hr />
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Opening Balance</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_balance');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" min="0" name="opening_balance" value="0" tabindex="9" />
                  <small><?php echo $vResult["opening_balance"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Opening Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="opening_date" value="<?php echo date("m/d/Y");?>" tabindex="9" />
                  <small><?php echo $vResult["opening_date"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Balance As</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="trans_mode" title="Balance AS" tabindex="10">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Debit (Pending Payment)</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>Credit (Advance from Client Side)</option>
                  </select>
                </div>
              </div>
            </div>
           <hr />
           
            <?php } else {
				if($CheckOpendingBalance > 0 && $CheckLastBalance["trans_amount"] == 0){
					$TranMode = 2;
				?>
                <input type="hidden" name="trani" value="<?php echo $CheckLastBalance["transaction_id"];?>" />
                 <hr />
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Opening Balance</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_balance');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" min="0" name="opening_balance" value="<?php echo $CheckLastBalance["trans_amount"];?>" tabindex="9" />
                  <small><?php echo $vResult["opening_balance"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Opening Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="opening_date" value="<?php echo date("m/d/Y");?>" tabindex="9" />
                  <small><?php echo $vResult["opening_date"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Balance As</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="trans_mode" title="Balance AS" tabindex="10">
                    <option value="1" <?php echo StaticDDSelection(1, $CheckLastBalance["trans_mode"]);?> selected>Debit (Pending Payment)</option>
                    <option value="2" <?php echo StaticDDSelection(2, $CheckLastBalance["trans_mode"]);?>>Credit (Advance from Client Side)</option>
                  </select>
                </div>
              </div>
            </div>
           <hr />
                <?php
				
			} } } ?>
             <input type="hidden" name="actr" value="<?php echo $TranMode;?>" />
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="8">Submit</button>
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
