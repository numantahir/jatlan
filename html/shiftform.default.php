<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="shift_id" value="<?php echo $objBF->encrypt($shift_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Shift', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=shift');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Shift Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'shift_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="shift_name" required value="<?php echo $shift_name;?>" tabindex="1" />
                  <small><?php echo $vResult["shift_name"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Start Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'shift_st');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="shift_st" required value="<?php echo $shift_st;?>" tabindex="2" />
                  <small><?php echo $vResult["shift_st"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">End Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'shift_et');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="shift_et" required value="<?php echo $shift_et;?>" tabindex="3" />
                  <small><?php echo $vResult["shift_et"];?></small> </div>
              </div>
            </div>
            
            <hr>
             <div class="row">
              <label class="col-sm-2 label-on-left">Late In Condition</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="ligt_status" id="ligt_status" title="Late In Condition" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $ligt_status);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $ligt_status);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <hr>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Late In Grace Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'shift_ligt');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="shift_ligt" id="shift_ligt" required value="<?php echo $shift_ligt;?>" tabindex="4" />
                  <small><?php echo $vResult["shift_ligt"];?></small><label><small>Late In grace Time in <strong>MINUTES</strong> only</small></label> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Late Out Grace Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'shift_logt');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="shift_logt" id="shift_logt" required value="<?php echo $shift_logt;?>" tabindex="5" />
                  <small><?php echo $vResult["shift_logt"];?></small><label><small>Late Out grace Time in <strong>MINUTES</strong> only</small></label> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Early Out Grace Time</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'shift_eogt');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="shift_eogt" id="shift_eogt" value="<?php echo $shift_eogt;?>" tabindex="6" />
                  <small><?php echo $vResult["shift_eogt"];?></small><label><small>Time in <strong>MINUTES</strong> only</small></label> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">25% Off on Late-IN</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'qutr_late_in');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="qutr_late_in" id="qutr_late_in" required value="<?php echo $qutr_late_in;?>" tabindex="7" />
                  <small><?php echo $vResult["qutr_late_in"];?></small><label><small>LATE-IN cutting in <strong>MINUTES</strong> only (Example: Office Time <code>9:00AM</code> & with grace time <code>9:10AM</code> then first 25% off on <code>9:30AM</code> so then write only <code>20</code>)</small></label> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">50% Off on Late-IN</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'half_late_in');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="half_late_in" id="half_late_in" required value="<?php echo $half_late_in;?>" tabindex="8" />
                  <small><?php echo $vResult["half_late_in"];?></small><label><small>LATE-IN cutting in <strong>MINUTES</strong> only (Example: Office Time <code>9:00AM</code> & with grace time <code>9:10AM</code> then 50% off on <code>10:30AM</code> so then write only <code>80</code>)</small></label> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">100% Off on Late-IN</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'full_late_in');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="full_late_in" id="full_late_in" required value="<?php echo $full_late_in;?>" tabindex="9" />
                  <small><?php echo $vResult["full_late_in"];?></small><label><small>LATE-IN cutting in <strong>MINUTES</strong> only (Example: Office Time <code>9:00AM</code> & with grace time <code>9:10AM</code> then 100% off after <code>10:30AM</code> so then write only <code>80</code>)</small></label> </div>
              </div>
            </div>
            
            <hr>
             <div class="row">
              <label class="col-sm-2 label-on-left">Early Out Condition</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="eogt_status" id="eogt_status" title="Early Out Condition" tabindex="10">
                    <option value="1" <?php echo StaticDDSelection(1, $eogt_status);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $eogt_status);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <label class="col-sm-2 label-on-left">100% Off Before Leave</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'full_off_bef');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="full_off_bef" id="full_off_bef" required value="<?php echo $full_off_bef;?>" tabindex="10" />
                  <small><?php echo $vResult["full_off_bef"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">50% Off Before Leave</label>
              <div class="col-sm-9">
              <div class="col-sm-3">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'half_off_bef_start');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="half_off_bef_start" id="half_off_bef_start" required value="<?php echo $half_off_bef_start;?>" tabindex="11" />
                  <small><?php echo $vResult["half_off_bef_start"];?></small> </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'half_off_bef_end');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="half_off_bef_end" id="half_off_bef_end" required value="<?php echo $half_off_bef_end;?>" tabindex="12" />
                  <small><?php echo $vResult["half_off_bef_end"];?></small> </div>
              </div>
              </div>
            </div>
            
            
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">25% Off Before Leave</label>
              <div class="col-sm-9">
              <div class="col-sm-3">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'qutr_off_bef_start');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="qutr_off_bef_start" id="qutr_off_bef_start" required value="<?php echo $qutr_off_bef_start;?>" tabindex="13" />
                  <small><?php echo $vResult["qutr_off_bef_start"];?></small> </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'qutr_off_bef_end');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="qutr_off_bef_end" id="qutr_off_bef_end" required value="<?php echo $qutr_off_bef_end;?>" tabindex="14" />
                  <small><?php echo $vResult["qutr_off_bef_end"];?></small> </div>
              </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">10% Off Before Leave</label>
              <div class="col-sm-9">
              <div class="col-sm-3">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'ten_off_bef_start');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="ten_off_bef_start" id="ten_off_bef_start" required value="<?php echo $ten_off_bef_start;?>" tabindex="15" />
                  <small><?php echo $vResult["ten_off_bef_start"];?></small> </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'ten_off_bef_end');?>">
                  <label class="control-label"></label>
                  <input class="form-control timepicker" type="text" name="ten_off_bef_end" id="ten_off_bef_end" required value="<?php echo $ten_off_bef_end;?>" tabindex="16" />
                  <small><?php echo $vResult["ten_off_bef_end"];?></small> </div>
              </div>
              </div>
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Shift Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Shift Status" tabindex="17">
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
