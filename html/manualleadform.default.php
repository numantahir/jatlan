<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Add New Lead', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=advancesalary');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Client Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'client_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="client_name" required tabindex="1" />
                  <small><?php echo $vResult["client_name"];?></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Client Phone #</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'client_phone_number');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="client_phone_number" required tabindex="2" />
                  <small><?php echo $vResult["client_phone_number"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Client Email</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'client_email');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="email" name="client_email" tabindex="3" />
                  <small><?php echo $vResult["client_email"];?></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Client Message</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'client_message');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="client_message" rows="8" tabindex="4"></textarea>
                  <small><?php echo $vResult["client_message"];?></small> </div>
              </div>
            </div>
            
           <div class="row">
              <label class="col-sm-2 label-on-left">Lead From</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="lead_from_id" title="Select Lead From" required tabindex="5">
                    <option value="1" <?php echo StaticDDSelection(1, $lead_from_id);?>>Zameen</option>
                    <option value="2" <?php echo StaticDDSelection(2, $lead_from_id);?>>OLX</option>
                    <option value="3" <?php echo StaticDDSelection(3, $lead_from_id);?>>Social Media</option>
                    <option value="4" <?php echo StaticDDSelection(4, $lead_from_id);?>>Other</option>
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
