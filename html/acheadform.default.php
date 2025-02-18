<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="head_id" value="<?php echo $objBF->encrypt($head_id, ENCRYPTION_KEY);?>">
            <?php $TranMode = 0;?>
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Account Head', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=achead');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Code</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'head_code');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="head_code" value="<?php echo $head_code;?>" tabindex="1" />
                  <small><?php echo $vResult["head_code"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'head_title');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="head_title" required value="<?php echo $head_title;?>" tabindex="2" />
                  <small><?php echo $vResult["head_title"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Description</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'head_description');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="head_description" value="<?php echo $head_description;?>" tabindex="3" />
                  <small><?php echo $vResult["head_description"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" name="head_type_id" id="head_type_id" title="Head Type" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $head_type_id);?> selected>General</option>
                    <option value="2" <?php echo StaticDDSelection(2, $head_type_id);?>>Cash</option>
                    <option value="3" <?php echo StaticDDSelection(3, $head_type_id);?>>Bank Account</option>
                    <option value="4" <?php echo StaticDDSelection(4, $head_type_id);?>>Customer</option>
                    <option value="5" <?php echo StaticDDSelection(5, $head_type_id);?>>Employee</option>
                    <option value="6" <?php echo StaticDDSelection(6, $head_type_id);?>>Vendors</option>
                    <option value="7" <?php echo StaticDDSelection(7, $head_type_id);?>>Vehicle</option>
                    <option value="8" <?php echo StaticDDSelection(8, $head_type_id);?>>Unloading</option>
                    <option value="9" <?php echo StaticDDSelection(9, $head_type_id);?>>Vehicle Item Head</option>
                    
                    <option value="10" <?php echo StaticDDSelection(10, $head_type_id);?>>Diesel</option>
                    <option value="11" <?php echo StaticDDSelection(11, $head_type_id);?>>Mobil Oil</option>
                    <option value="12" <?php echo StaticDDSelection(12, $head_type_id);?>>Tyre</option>
                    <option value="13" <?php echo StaticDDSelection(13, $head_type_id);?>>Drawing Accounts</option>
                    
                  </select>
                </div>
              </div>
            </div>
            
            <?php if($mode == 'I'){ $TranMode = 1;?>
            <div class="row" id="opnblc" style="display:none;">
              <label class="col-sm-2 label-on-left">Opening Balance</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_balance');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="opening_balance" value="0" />
                  <small><?php echo $vResult["opening_balance"];?></small> </div>
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
            <?php } else {
				if($head_type_id == 2 or $head_type_id == 3 or $head_type_id == 4 or $head_type_id == 6 or $head_type_id == 7 or $head_type_id == 8 or $head_type_id == 10 or $head_type_id == 11 or $head_type_id == 12 or $head_type_id == 13){
						$objQayadaccount->resetProperty();
						$objQayadaccount->setProperty("pay_mode", 7);
						$objQayadaccount->setProperty("head_id", $head_id);
						$objQayadaccount->lstAccountTransaction();
						$CheckOpendingBalance = $objQayadaccount->totalRecords();
						
						if($CheckOpendingBalance == 0){
							$TranMode = 1;
				 ?>
             <div class="row" id="opnblc">
              <label class="col-sm-2 label-on-left">Opening Balance</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_balance');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="opening_balance" value="0" />
                  <small><?php echo $vResult["opening_balance"];?></small> </div>
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
                 <?php } } } ?>
            <input type="hidden" name="actr" value="<?php echo $TranMode;?>" />
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Group</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" name="head_group_id" title="Head Group" tabindex="5">
                  <?php
					$objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("ORDERBY", 'group_title');
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstHeadGroup();
                    while($HeadGroup = $objQayadaccount->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $HeadGroup["head_group_id"];?>" <?php echo StaticDDSelection($HeadGroup["head_group_id"], $head_group_id);?>>
					<?php echo $HeadGroup["group_title"];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Option</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="head_option" title="Head Option" tabindex="6">
                    <option value="1" <?php echo StaticDDSelection(1, $head_option);?> selected>Head Base</option>
                    <option value="2" <?php echo StaticDDSelection(2, $head_option);?>>Item Base</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Property Status" tabindex="7">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
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
