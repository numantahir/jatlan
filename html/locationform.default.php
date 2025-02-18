<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="location_id" value="<?php echo $objBF->encrypt($location_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Destination / Location', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=location');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Location Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'location_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="location_name" required value="<?php echo $location_name;?>" tabindex="1" />
                  <small><?php echo $vResult["location_name"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'deliver_chagres');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="deliver_chagres" required value="<?php echo $deliver_chagres;?>" tabindex="2" />
                  <small><?php echo $vResult["deliver_chagres"];?></small> 
                  <code>Note: Write delivery charges on per bag base.</code>
                  </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Unloading Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'unloading_charges');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="unloading_charges" required value="<?php echo $unloading_charges;?>" tabindex="3" />
                  <small><?php echo $vResult["unloading_charges"];?></small>
                  <code>Note: Write unloading charges on per bag base.</code>
                   </div>
              </div>
            </div>
           
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="5">Submit</button>
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