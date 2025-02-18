<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="property_id" value="<?php echo $objBF->encrypt($property_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Property', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=lstproperty');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">List of Sections</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="floor_id" required title="List of Sections" tabindex="1">
                    <?php echo $objSSSinventory->FloorBuildingBlockCombo($floor_id);?>
                  </select>
                  <small><code>FL:->Floor Name / BU:->Building No. / BL:->Block No.</code></small>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Property Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="property_type" required title="Property Type" tabindex="2">
                    <option value="1" <?php echo StaticDDSelection(1, $property_type);?> selected>Shop</option>
                    <option value="2" <?php echo StaticDDSelection(2, $property_type);?>>Office</option>
                    <option value="3" <?php echo StaticDDSelection(3, $property_type);?>>Flat</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Property No.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'property_number');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="property_number" required value="<?php echo $property_number;?>" tabindex="3" />
                  <small><?php echo $vResult["property_number"];?></small> </div>
              </div>
            </div>

            
            <div class="row">
              <label class="col-sm-2 label-on-left">Monthly Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'monthly_maint');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="monthly_maint" required value="<?php echo $monthly_maint;?>" tabindex="5" />
                  <small><?php echo $vResult["monthly_maint"];?></small> </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 label-on-left">Property Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" required title="Property Status" tabindex="6">
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
