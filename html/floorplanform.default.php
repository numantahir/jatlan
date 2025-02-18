<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="propety_floor_id" value="<?php echo $objBF->encrypt($propety_floor_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="project_id" value="<?php echo $CurrentPorjectId;?>" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Floor Plan', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=floorplan');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Project Floor Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="project_type_id" title="Choose Project Floor Type" required tabindex="1">
                    <option value="" disabled>Select Project Floor Type</option>
                    <?php echo ProjectTypeOptionList($project_type_id);?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Floor Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'floor_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="floor_name" required value="<?php echo $floor_name;?>" tabindex="2" />
                  <small><?php echo $vResult["floor_name"];?></small> </div>
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
