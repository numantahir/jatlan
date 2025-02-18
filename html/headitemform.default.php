<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="item_id" value="<?php echo $objBF->encrypt($item_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="head_type_id" id="head_type_id" value="">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Head Item', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=headitem');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Item Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'item_title');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="item_title" value="<?php echo $item_title;?>" tabindex="1" />
                  <small><?php echo $vResult["item_title"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Item Description</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'item_description');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="item_description" value="<?php echo $item_description;?>" tabindex="2" />
                  <small><?php echo $vResult["item_description"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Head Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="head_id" id="itemheadid" title="Account Head" tabindex="3">
                    <?php
					$objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
					$objQayadaccount->setProperty("head_option", 2);
					$objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->lstHead();
                    while($AccountHeads = $objQayadaccount->dbFetchArray(1)){
                    ?>
                    <option id="<?php echo $AccountHeads["head_type_id"];?>" value="<?php echo $AccountHeads["head_id"];?>" <?php echo StaticDDSelection($AccountHeads["head_id"], $head_id);?>>
					<?php echo $AccountHeads["head_title"];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
            <?php if($mode == 'I'){?>
            <div class="row" id="opnblc" style="display:none;">
              <label class="col-sm-2 label-on-left">Opening Balance</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_balance');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="opening_balance" value="0" />
                  <small><?php echo $vResult["opening_balance"];?></small> </div>
              </div>
            </div>
            <?php } ?>
			<div class="row">
              <label class="col-sm-2 label-on-left">Item Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="head_type" title="Item Type" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $head_type);?> selected>General</option>
                    <option value="2" <?php echo StaticDDSelection(2, $head_type);?>>Vehicle</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Item Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="5">
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
