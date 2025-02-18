<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="yearly_leave_type_id" value="<?php echo $objBF->encrypt($yearly_leave_type_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Yearly Leave', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=yearlyleave');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Yearly Leave Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'yearly_leave_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="yearly_leave_name" required value="<?php echo $yearly_leave_name;?>" tabindex="1" />
                  <small><?php echo $vResult["yearly_leave_name"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Number of Leaves</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'number_of_leave');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="number_of_leave" required value="<?php echo $number_of_leave;?>" tabindex="2" />
                  <small><?php echo $vResult["number_of_leave"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Leave Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="yearly_leave_type" title="Leave Type" tabindex="3">
                    <option value="1" <?php echo StaticDDSelection(1, $yearly_leave_type);?> selected>General</option>
                    <option value="2" <?php echo StaticDDSelection(2, $yearly_leave_type);?>>Medical</option>
                    <option value="3" <?php echo StaticDDSelection(3, $yearly_leave_type);?>>Casual</option>
                    <option value="4" <?php echo StaticDDSelection(4, $yearly_leave_type);?>>Sick</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Leave Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Leave Status" tabindex="3">
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
