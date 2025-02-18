<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="vehicle_id" value="<?php echo $objBF->encrypt($vehicle_id, ENCRYPTION_KEY);?>">
            <?php $TranMode = 0;?>
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Vehicle', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=vehicletype');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Vehicle Number</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'vehicle_number');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="vehicle_number" required value="<?php echo $vehicle_number;?>" tabindex="1" />
                  <small><?php echo $vResult["vehicle_number"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Vehicle Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'vehicle_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="vehicle_name" value="<?php echo $vehicle_name;?>" tabindex="2" />
                  <small><?php echo $vResult["vehicle_name"];?></small> </div>
              </div>
            </div>
           
           <div class="row">
              <label class="col-sm-2 label-on-left">Vehicle Source</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="vehicle_source" title="Vehicle Source" tabindex="3">
                    <option value="1" <?php echo StaticDDSelection(1, $vehicle_source);?> selected>In-House</option>
                    <option value="2" <?php echo StaticDDSelection(2, $vehicle_source);?>>Outside</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Vehicle Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" required name="vehicle_type_id" title="Vehicle Type" tabindex="4">
                    <?php echo $objSSSjatlan->VehicleTypeCombo($vehicle_type_id);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Loading Capacity</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'loading_capacity');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="loading_capacity" value="<?php echo $loading_capacity;?>" tabindex="5" />
                  <small><?php echo $vResult["loading_capacity"];?></small> </div>
              </div>
            </div>
             <input type="hidden" name="actr" value="<?php echo $TranMode;?>" />
             
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
              <button type="submit" class="btn btn-rose btn-fill" tabindex="7">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>