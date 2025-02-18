<?php
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
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Advance Salary Request', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=advancesalary');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Advance Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'salary_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="salary_amount" max="<?php echo $UserSalary["salary_amount"];?>" required tabindex="1" />
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
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>Monthly Instalment</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row" id="apply_from_div" style="display:none;">
              <label class="col-sm-2 label-on-left">No of Months</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="payback_in_months" title="Select Advance Return Duration" tabindex="5">
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
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
