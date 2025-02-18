<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">message</i> </div>
          <?php if($_GET["i"] == ''){?>
          <div class="card-content">
            <h4 class="card-title CardWidth">SMS Marketing (Template Selection) </h4>
            <div class="toolbar text-right"> </div>
            <hr>
            <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Template Title &amp; Detail</th>
                    <th>Template Selection</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					$objQayadsms->resetProperty();
                    $objQayadsms->setProperty("sms_type_id", 7);
					$objQayadsms->setProperty("ORDERBY", 'sms_template_id');
                    $objQayadsms->lstSMSTemplate();
                    while($SMSTemlateList = $objQayadsms->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><strong><?php echo $SMSTemlateList["sms_title"];?></strong><br>
                      <?php echo $SMSTemlateList["sms_content"];?></td>
                    <td align="center"><a href="<?php echo Route::_('show=smsmarketingform&i='.EncData($SMSTemlateList["sms_template_id"], 2, $objBF));?>">Select</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <?php } else { 
				$objQayadsms->resetProperty();
				$objQayadsms->setProperty("sms_template_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objQayadsms->lstSMSTemplate();
				$SMSTemlateList = $objQayadsms->dbFetchArray(1);
		  ?>
          <div class="card-content">
            <h4 class="card-title CardWidth">SMS Marketing (<?php echo $SMSTemlateList["sms_title"];?>) </h4>
            <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="mode" value="<?php echo $mode;?>">
              <input type="hidden" name="contact_id" value="<?php echo EncData($contact_id, 1, $objBF);?>">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Template Content</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <textarea name="templatecontent" rows="3" class="form-control" readonly><?php echo $SMSTemlateList["sms_content"];?></textarea>
                       </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Send To</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Send To" tabindex="3">
                        <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>All</option>
                        <option value="3" <?php echo StaticDDSelection(2, $isActive);?>>Selected Customer</option>
                      </select>
                    </div>
                  </div>
                </div>
                
                <div class="card-footer text-center col-md-12">
                  <button type="submit" class="btn btn-rose btn-fill">Submit</button>
                  <button type="reset" class="btn btn-fill">Reset</button>
                </div>
              </div>
            </form>
          </div>
          <?php } ?>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>