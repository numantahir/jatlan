<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="pm_info_id" value="<?php echo $objBF->encrypt($pm_info_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Payment Info', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=paymentinfo');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Mode Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="pm_mode_id" title="Payment Mode Type Selection" tabindex="1">
                    <option value="1" <?php echo StaticDDSelection(1, $pm_mode_id);?> selected>MoneyGram</option>
                    <option value="2" <?php echo StaticDDSelection(2, $pm_mode_id);?>>Western Union</option>
                    <option value="3" <?php echo StaticDDSelection(3, $pm_mode_id);?>>Remit</option>
                    <option value="4" <?php echo StaticDDSelection(4, $pm_mode_id);?>>XE Money Transfer</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Payment Mode Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'pm_mode_title');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="pm_mode_title" required value="<?php echo $pm_mode_title;?>" tabindex="2" />
                  <small><?php echo $vResult["pm_mode_title"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Payment Mode Detail</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'m_mode_detail');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="m_mode_detail" required tabindex="3"><?php echo $m_mode_detail;?></textarea>
                  <small><?php echo $vResult["m_mode_detail"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Mode Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Mode Status" tabindex="4">
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
