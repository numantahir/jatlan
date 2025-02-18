<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="generate_bill_id" value="<?php echo $objBF->encrypt($generate_bill_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Generate Bill';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=getbillrequest');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            
             <div class="row">
              <label class="col-sm-2 label-on-left">Generated Month</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="current_month" required title="Generated Month" tabindex="1">
                    <option value="1" <?php echo StaticDDSelection(1, $NextMonth);?>>1 - JAN</option>
                    <option value="2" <?php echo StaticDDSelection(2, $NextMonth);?>>2 - FEB</option>
                    <option value="3" <?php echo StaticDDSelection(3, $NextMonth);?>>3 - MAR</option>
                    <option value="4" <?php echo StaticDDSelection(4, $NextMonth);?>>4 - APR</option>
                    <option value="5" <?php echo StaticDDSelection(5, $NextMonth);?>>5 - MAY</option>
                    <option value="6" <?php echo StaticDDSelection(6, $NextMonth);?>>6 - JUN</option>
                    <option value="7" <?php echo StaticDDSelection(7, $NextMonth);?>>7 - JUL</option>
                    <option value="8" <?php echo StaticDDSelection(8, $NextMonth);?>>8 - AUG</option>
                    <option value="9" <?php echo StaticDDSelection(9, $NextMonth);?>>9 - SEP</option>
                    <option value="10" <?php echo StaticDDSelection(10, $NextMonth);?>>10 - OCT</option>
                    <option value="11" <?php echo StaticDDSelection(11, $NextMonth);?>>11 - NOV</option>
                    <option value="12" <?php echo StaticDDSelection(12, $NextMonth);?>>12 - DEC</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Generated Year</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="current_year" required title="Generated Year" tabindex="2">
                    <option value="2020" <?php echo StaticDDSelection(2022, date('Y'));?>>2020</option>
                    <option value="2021" <?php echo StaticDDSelection(2021, date('Y'));?>>2021</option>
                    <option value="2022" <?php echo StaticDDSelection(2022, date('Y'));?>>2022</option>
                    <option value="2023" <?php echo StaticDDSelection(2023, date('Y'));?>>2023</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Due Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'due_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="due_date" required value="<?php echo $due_date;?>" tabindex="3" />
                  <small><?php echo $vResult["due_date"];?></small> </div>
              </div>
            </div>


            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isAcitve" required title="Status" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $isAcitve);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isAcitve);?>>InActive</option>
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
