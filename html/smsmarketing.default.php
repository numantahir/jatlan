<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">message</i> </div>
          <?php if($_GET["i"]==''){?>
          <div class="card-content">
            <h4 class="card-title CardWidth">SMS Marketing Management</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=smsmarketingform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Send To</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Title</th>
                    <th>Send To</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayadsmsDetail = new Qayadsms;
					$objQayadsms->resetProperty();
                    $objQayadsms->setProperty("ORDERBY", 'sms_request_id DESC');
                    $objQayadsms->lstSMSSendingRequest();
                    while($SMSSendingRequest = $objQayadsms->dbFetchArray(1)){
						
						$objQayadsmsDetail->setProperty("sms_template_id", $SMSSendingRequest["sms_template_id"]);
						$objQayadsmsDetail->lstSMSTemplate();
						$TemplateDetail = $objQayadsmsDetail->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo $TemplateDetail["sms_title"];?></td>
                    <td><?php echo SMSSendingOption($SMSSendingRequest["sending_option"]);?></td>
                    <td><?php echo SMSSendingRequestStatus($SMSSendingRequest["request_status"]);?></td>
                    <td><a href="<?php echo Route::_('show=smsmarketingform&i='.EncData($SMSSendingRequest["sms_request_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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
            <h4 class="card-title CardWidth"><?php echo $SMSTemlateList["sms_title"];?></h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=smstemplateform&i='.EncData($SMSTemlateList["sms_template_id"], 2, $objBF));?>" class="btn btn-primary">Edit</a> </div>
            <hr>
            <div class="material-datatables">
              <p><?php echo $SMSTemlateList["sms_content"];?></p>
            </div>
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