<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Change Security Code</h4>
            </div>
            <div class="toolbar btn-back"> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <?php //echo $objCommon->displayMessage_js();?>
            <div class="row">
              <label class="col-sm-2 label-on-left">Current Security Code</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_c_s_code');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_c_s_code" required tabindex="1" />
                  <small><?php echo $vResult["user_c_s_code"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">New Security Code</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_s_code');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_s_code" id="user_s_code" required tabindex="2" />
                  <small><?php echo $vResult["user_s_code"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Confirm New Security Code</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_ncf_s_code');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_ncf_s_code" id="user_s_code_confirmation" equalTo="#user_s_code" required tabindex="3" />
                  <small><?php echo $vResult["user_ncf_s_code"];?></small> </div>
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
