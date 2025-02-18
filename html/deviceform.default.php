<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="device_id" value="<?php echo $objBF->encrypt($device_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Attendance Device', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=device');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Device Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'device_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="device_name" required value="<?php echo $device_name;?>" tabindex="1" />
                  <small><?php echo $vResult["device_name"];?></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Device Location</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'device_location');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="device_location" required value="<?php echo $device_location;?>" tabindex="2" />
                  <small><?php echo $vResult["device_location"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Device IP</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'device_ip');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="device_ip" required value="<?php echo $device_ip;?>" tabindex="3" />
                  <small><?php echo $vResult["device_ip"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Device Port</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'device_port');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="device_port" required value="<?php echo $device_port;?>" tabindex="4" />
                  <small><?php echo $vResult["device_port"];?></small> </div>
              </div>
            </div>
            
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Device Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Device Status" tabindex="5">
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
