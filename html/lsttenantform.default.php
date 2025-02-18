<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="tenant_id" value="<?php echo $objBF->encrypt($tenant_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Tenant', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=lsttenants');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Tenant Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'tenant_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="tenant_name" required value="<?php echo $tenant_name;?>" tabindex="1" />
                  <small><?php echo $vResult["tenant_name"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Tenant CNIC</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'tenant_cnic');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="tenant_cnic" required value="<?php echo $tenant_cnic;?>" tabindex="2" />
                  <small><?php echo $vResult["tenant_cnic"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Tenant Phone#</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'tenant_phone');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="tenant_phone" required value="<?php echo $tenant_phone;?>" tabindex="3" />
                  <small><?php echo $vResult["tenant_phone"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Tenant Shop Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'tenant_shop_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="tenant_shop_name" value="<?php echo $tenant_shop_name;?>" tabindex="4" />
                  <small><?php echo $vResult["tenant_shop_name"];?></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Tenant Join Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'tenant_joinin_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="tenant_joinin_date" value="<?php echo $tenant_joinin_date;?>" tabindex="5" />
                  <small><?php echo $vResult["tenant_joinin_date"];?></small> </div>
              </div>
            </div>
            

            <div class="row">
              <label class="col-sm-2 label-on-left">Tenant Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" required title="Tenant Status" tabindex="6">
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
