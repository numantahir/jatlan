<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="complain_id" value="<?php echo $objBF->encrypt($complain_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="complain_assign_id" value="<?php echo $objBF->encrypt($complain_assign_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Complain', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=complain');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">List of Category</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="category_id" required title="List of Categories" data-live-search="true" tabindex="1">
                    <?php echo $objSSSinventory->ComplainCategoryCombo($category_id);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">List of Properties</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="property_id" required title="List of Properties" data-live-search="true" tabindex="2">
                    <?php
						$objSSSinventory->resetProperty();
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("isActive", 1);
						$objSSSinventory->setProperty("tenant_status", 1);
						$objSSSinventory->setProperty("ORDERBY", 'block_name, building_no, floor_name, property_number');
						$objSSSinventory->lstPropertyBundle();
						while($GetPropertyDetail = $objSSSinventory->dbFetchArray(1)){
							if($GetPropertyDetail["property_id"] == $property_id){
								$AddSelected = ' selected="selected"';
							} else {
								$AddSelected = '';
							}
					?>
                    <option<?php echo $AddSelected;?> value="<?php echo $GetPropertyDetail["property_id"]; ?>"><?php echo $GetPropertyDetail["block_name"].' / '.$GetPropertyDetail["building_no"].' / '.$GetPropertyDetail["floor_name"].' / '.$GetPropertyDetail["property_number"].' / '.$GetPropertyDetail["property_code"];?></option>
                    <?php } ?>
                  </select>
                  <code>Block / Building No. / Floor Name / Property No. / Property Code</code>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Complain Detail</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'complain_text');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="complain_text" required value="<?php echo $complain_text;?>" tabindex="3" />
                  <small><?php echo $vResult["complain_text"];?></small> </div>
              </div>
            </div>





			<div class="row">
              <label class="col-sm-2 label-on-left">Assign to</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="assign_to_id" required title="List of Team Member" data-live-search="true" tabindex="4">
                    <?php echo $objQayaduser->ComplainTeamCombo($assign_to_id);?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" required title="Status" tabindex="5">
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
