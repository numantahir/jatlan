<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="project_id" value="<?php echo $objBF->encrypt($project_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Project', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=projects');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Project Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'project_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="project_name" required value="<?php echo $project_name;?>" tabindex="1" />
                  <small><?php echo $vResult["project_name"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Location</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'project_location');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="project_location" required value="<?php echo $project_location;?>" tabindex="2" />
                  <small><?php echo $vResult["project_location"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Contact Numbers</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="project_contact_number" value="<?php echo $project_contact_number;?>" tabindex="3" />
                  </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Project Detail</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'project_name');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" rows="8" name="project_description" tabindex="4"><?php echo $project_description;?></textarea>
                  </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Project Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="project_type" title="Project Type" tabindex="5">
                    <option value="1" <?php echo StaticDDSelection(1, $project_type);?> selected>Under Construction</option>
                    <option value="2" <?php echo StaticDDSelection(2, $project_type);?>>Completed</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="7">
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
