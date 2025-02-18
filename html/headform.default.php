<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="head_group_id" value="<?php echo $objBF->encrypt($head_group_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Head Group', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=headgroup');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Group Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'group_title');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="group_title" required value="<?php echo $group_title;?>" tabindex="1" />
                  <small><?php echo $vResult["group_title"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Group Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Property Status" tabindex="2">
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
