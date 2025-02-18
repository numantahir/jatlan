<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="department_id" value="<?php echo $objBF->encrypt($department_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Department', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=department');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Company</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" required name="company_id" title="List of Companies" tabindex="1">
                    <?php echo $objQayaduser->CompanyCombo($company_id);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Department Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'department_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="department_name" required value="<?php echo $department_name;?>" tabindex="2" />
                  <small><?php echo $vResult["department_name"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Department Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Department Status" tabindex="3">
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
