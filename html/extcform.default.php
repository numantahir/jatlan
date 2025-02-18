<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="extra_charges_id" value="<?php echo $objBF->encrypt($extra_charges_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Extra Tenant Charges', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=extracharges');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
           <div class="row">
              <label class="col-sm-2 label-on-left">Tenant List</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="tenant_id" required title="Tenant List" tabindex="1" data-live-search="true">
                  <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'tenant_name');
					$objSSSinventory->lstTenantInformation();
					while($ListOfTenant = $objSSSinventory->dbFetchArray(1)){
				?>
                    <option value="<?php echo $ListOfTenant["tenant_id"];?>" <?php echo StaticDDSelection($ListOfTenant["tenant_id"], $tenant_id);?>><?php echo $ListOfTenant["tenant_code"].' -> '.$ListOfTenant["tenant_name"]; if($ListOfTenant["tenant_shop_name"] != ''){ echo ' / '.$ListOfTenant["tenant_shop_name"];}?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Extra Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'extra_title');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="extra_title" required value="<?php echo $extra_title;?>" tabindex="2" />
                  <small><?php echo $vResult["extra_title"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Extra Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'extra_charges');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="extra_charges" required value="<?php echo $extra_charges;?>" tabindex="3" />
                  <small><?php echo $vResult["extra_charges"];?></small> </div>
              </div>
            </div>
			
            <div class="row">
              <label class="col-sm-2 label-on-left">Charges Type</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="extra_type" required title="Extra Charges Type" tabindex="4">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Monthly</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>OnTime</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" required title="Status" tabindex="4">
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
