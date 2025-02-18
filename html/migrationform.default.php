<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="migration_id" value="<?php echo $migration_id;?>">
            <input type="hidden" name="current_location_id" value="<?php echo $objQayaduser->location_id;?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('User Migration', $mode);?></h4>
            </div>
            <div class="toolbar back-btn text-right"> <a href="<?php echo Route::_('show=migration');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12">
              <div class="row">
                <label class="col-sm-2 label-on-left">Select User</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'user_fname');?>">
                    <select class="selectpicker" data-style="select-with-transition" name="migration_user_id" title="Select User" required tabindex="1">
                      <?php echo $objQayaduser->AgentCombo($objQayaduser->location_id,$objCheckLogin->user_type);?>
                    </select>
                    <small><?php echo $vResult["user_fname"];?></small> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Migrate From</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="currentlocaton_name" required value="<?php echo $objQayaduser->GetLocation($objQayaduser->location_id);?>" tabindex="2" readonly />
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Migrate To</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'migration_location_id');?>">
                    <select class="selectpicker" data-style="select-with-transition" name="migration_location_id" title="Migrate To" required tabindex="3">
                      <?php echo $objQayaduser->MogrationCombo();?>
                    </select>
                    <small><?php echo $vResult["migration_location_id"];?></small> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Migration Reason</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'migration_reason');?>">
                    <label class="control-label"></label>
                    <textarea name="migration_reason" class="form-control" rows="5" tabindex="4"></textarea>
                  </div>
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
