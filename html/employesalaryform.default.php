<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="user_salary_id" value="<?php echo $objBF->encrypt($user_salary_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <input type="hidden" name="salary_mode" value="1">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Employee Salary', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=employesalary&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Salary Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'salary_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="salary_amount" required value="<?php echo trim($objBF->decrypt($salary_amount, 1, ENCRYPTION_KEY));?>" tabindex="1" />
                  <small><?php echo $vResult["salary_amount"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Salary Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="salary_type" id="salary_type" title="Select Salary Type" tabindex="2">
                    <option value="1" <?php echo StaticDDSelection(1, $salary_type);?> selected>Basic Salary</option>
                    <option value="2" <?php echo StaticDDSelection(2, $salary_type);?>>Increment</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row" style="display:none;" id="apply_from_div">
              <label class="col-sm-2 label-on-left">Apply From</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'apply_from');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="apply_from" value="<?php echo $apply_from;?>" tabindex="4" />
                  <small><?php echo $vResult["apply_from"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Cutting Mode</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="cutting_mode" title="Salary Cutting Mode" tabindex="5">
                    <option value="1" <?php echo StaticDDSelection(1, $cutting_mode);?> selected>Yes</option>
                    <option value="2" <?php echo StaticDDSelection(2, $cutting_mode);?>>No</option>
                  </select>
                </div>
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
