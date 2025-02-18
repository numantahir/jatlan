<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">message</i> </div>
          <?php if($_GET["i"]==''){?>
          <div class="card-content">
            <h4 class="card-title CardWidth">SMS Template Management</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=smstemplateform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Section/Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Title</th>
                    <th>Section/Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayadsms->resetProperty();
                    $objQayadsms->setProperty("ORDERBY", 'sms_template_id');
                    $objQayadsms->lstSMSTemplate();
                    while($SMSTemlateList = $objQayadsms->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=smstemplate&i='.EncData($SMSTemlateList["sms_template_id"], 2, $objBF));?>"><?php echo $SMSTemlateList["sms_title"];?></a></td>
                    <td><?php echo SMSTemplateType($SMSTemlateList["sms_type_id"]);?></td>
                    <td><?php echo StatusName($SMSTemlateList["isActive"]);?></td>
                    <td><a href="<?php echo Route::_('show=smstemplateform&i='.EncData($SMSTemlateList["sms_template_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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