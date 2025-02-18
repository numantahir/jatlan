<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="vehicle_exp_id" value="<?php echo $objBF->encrypt($vehicle_exp_id, ENCRYPTION_KEY);?>">
            <?php $TranMode = 0;?>
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Diesel', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=lstdiesel');?>" class="btn">Back</a> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Title</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'exp_title');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="exp_title" required value="<?php echo $exp_title;?>" tabindex="1" />
                      <small><?php echo $vResult["exp_title"];?></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Supplier Person Name</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'supplier_name');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="supplier_name" value="<?php echo $supplier_name;?>" tabindex="2" />
                      <small><?php echo $vResult["supplier_name"];?></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Contact No.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'supplier_contact_no');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="supplier_contact_no" value="<?php echo $supplier_contact_no;?>" tabindex="3" />
                      <small><?php echo $vResult["supplier_contact_no"];?></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Location</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'supplier_location');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="supplier_location" value="<?php echo $supplier_location;?>" tabindex="4" />
                      <small><?php echo $vResult["supplier_location"];?></small> </div>
                  </div>
                </div>
                <?php if($mode == 'I'){?>
                <hr />
                <div class="row">
                  <label class="col-sm-2 label-on-left">Opening Balance</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'opening_balance');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="number" min="0" name="opening_balance" required tabindex="5" />
                      <small><?php echo $vResult["opening_balance"];?></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Balance As</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" name="trans_mode" title="Balance AS" tabindex="6">
                        <option value="1" <?php echo StaticDDSelection(1, $isActive);?> >Debit (Advance from Client Side)</option>
                        <option value="2" <?php echo StaticDDSelection(2, $isActive);?> selected>Credit (Pending Payment)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <hr />
                <?php } ?>
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
