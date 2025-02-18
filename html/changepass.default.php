<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="property_id" value="<?php echo $property_id;?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Change Password</h4>
            </div>
            <div class="toolbar btn-back"> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <?php //echo $objCommon->displayMessage_js();?>
            <div class="row">
              <label class="col-sm-2 label-on-left">Current Password</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_c_pass');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_c_pass" required tabindex="1" />
                  <small><?php echo $vResult["user_c_pass"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">New Password</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_pass');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_pass" id="user_pass" required tabindex="2" />
                  <small><?php echo $vResult["user_pass"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Confirm New Password</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_ncf_pass');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_ncf_pass" id="user_pass_confirmation" equalTo="#user_pass" required tabindex="3" />
                  <small><?php echo $vResult["user_ncf_pass"];?></small> </div>
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
