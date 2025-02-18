<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="contact_id" value="<?php echo EncData($contact_id, 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Non Register Contact', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=smscontactlist');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Contact Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="customer_name" required value="<?php echo $customer_name;?>" tabindex="1" />
                  <small><?php echo $vResult["customer_name"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Contact Number</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'customer_number');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="customer_number" required value="<?php echo $customer_number;?>" minLength="11" maxLength="17" tabindex="2" />
                  <small><?php echo $vResult["customer_number"];?></small> <label><small>Note: Contact Number format Example: 03214641174 (without +92 or 0092 Simple mobile number)</small></label></div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Customer CNIC</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="customer_cnic" value="<?php echo $customer_cnic;?>" minLength="13" maxLength="13" tabindex="3" />
                  </div>
              </div>
            </div>
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Message/Note</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <textarea class="form-control" rows="5" name="customer_note" tabindex="4"><?php echo $customer_note;?></textarea>
                  </div>
              </div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="3">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
