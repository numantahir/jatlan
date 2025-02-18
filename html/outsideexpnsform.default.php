<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="vendor_exp_detail_id" value="<?php echo $objBF->encrypt($vendor_exp_detail_id, ENCRYPTION_KEY);?>">
             <input type="hidden" name="order_request_id" value="<?php echo $objBF->encrypt($OrderRequestID, ENCRYPTION_KEY);?>">
             <input type="hidden" name="vo_date" value="<?php echo date("Y-m-d"); ?>" />
             <input type="hidden" name="option_type" value="<?php echo $objBF->encrypt($VendorExpendOptionType, ENCRYPTION_KEY);?>">
             <input type="hidden" name="hti" value="<?php echo $objBF->encrypt($HeadTypeId, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle($MainTitle, $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=vendorexpns&i='.EncData($OrderRequestID, 2, $objBF));?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Supplier:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="head_id" id="head_id" title="List of Suppliers" data-live-search="true" required tabindex="1">
                    <?php
                                $objQayadaccount->resetProperty();
                                $objQayadaccount->setProperty("isActive", 1);
								$objQayadaccount->setProperty("head_type_id", $HeadTypeId);
                                $objQayadaccount->setProperty("ORDERBY", 'head_title');
                                $objQayadaccount->lstHead();
                                while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                                ?>
                    <option value="<?php echo EncData($AccountHeadList["head_id"], 1, $objBF);?>"> <?php echo $AccountHeadList["head_code"] . ' - ' . $AccountHeadList["head_title"] . ' ';?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'exp_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" min="1" name="exp_amount" id="exp_amount" required value="<?php echo $exp_amount;?>" tabindex="2" />
                  <small><?php echo $vResult["exp_amount"];?></small> </div>
              </div>
            </div>
            
          	<div class="row">
              <label class="col-sm-2 label-on-left">Quantity</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'quantity_detail');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="quantity_detail" tabindex="3" />
                  <small><?php echo $vResult["quantity_detail"];?></small> </div>
              </div>
            </div>
            
          	<div class="row">
              <label class="col-sm-2 label-on-left">Detail/Note</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'exp_detail');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="exp_detail" tabindex="4" />
                  <small><?php echo $vResult["exp_detail"];?></small> </div>
              </div>
            </div>
    
            <div class="row">
              <label class="col-sm-2 label-on-left">Detail/Note</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'vo_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" value="<?php echo date("Y-m-d");?>" name="vo_date" required tabindex="5" />
                  <small><?php echo $vResult["vo_date"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="6">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="7">Submit</button>
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