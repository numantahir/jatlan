<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        
        <?php if(trim(DecData($_GET["v"], 1, $objBF)) == 'open' && trim(DecData($_GET["scdi"], 1, $objBF)) != ''){
				$objQayadsms->resetProperty();
					$objQayadsms->setProperty("contact_id", trim(DecData($_GET["scdi"], 1, $objBF)));
                    $objQayadsms->setProperty("ORDERBY", 'contact_id DESC');
                    $objQayadsms->lstSMSNRContactList();
                    $SMSTemlateList = $objQayadsms->dbFetchArray(1);
				 ?>
        <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Non-Register Contact's Management</h4>
            </div>
            <div class="toolbar back-btn text-right"> <?php if($objCheckLogin->user_type != 6 && $objCheckLogin->user_type != 1){?> <a href="<?php echo Route::_('show=smscontactlistform');?>" class="btn btn-primary">Add New</a> <?php } ?> </div>
            <div class="card-content">
            <div class="col-md-12">
               <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td>Client Name</td>
                    <td><?php echo $SMSTemlateList["customer_name"];?></td>
                  </tr>
                  <tr>
                    <td>Phone Number</td>
                    <td><a href="tel:<?php echo $SMSTemlateList["customer_number"];?>"><?php echo $SMSTemlateList["customer_number"];?></a></td>
                  </tr>
                  <tr>
                    <td>CNIC</td>
                    <td><?php echo $SMSTemlateList["customer_cnic"];?></td>
                  </tr>
                  <tr>
                    <td>Client Message</td>
                    <td><?php echo $SMSTemlateList["customer_note"];?></td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
               <thead>
                  <tr>
                    <th>Comment</th>
                    <th>Status</th>
                    <th>Entry Date</th>
                    <th>Recheck Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objQayadsms->resetProperty();
                    $objQayadsms->setProperty("ORDERBY", 'entery_date DESC');
					$objQayadsms->setProperty("contact_id", trim(DecData($_GET["scdi"], 1, $objBF)));
                    $objQayadsms->lstSMSContactCommentList();
                    while($SMSContacntComments = $objQayadsms->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td style="width:70%;"><?php echo $SMSContacntComments["contact_comment"];?></td>
                    <td style="width:15%;"><?php echo AssignAgentLeadStatus($SMSContacntComments["contact_status"]);?></td>
                    <td style="width:15%;"><?php echo dateFormate_9($SMSContacntComments["entery_date"]);?></td>
                    <td style="width:15%;"><?php echo dateFormate_9($SMSContacntComments["recheck_date"]);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
              <hr>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="contact_id" value="<?php echo $SMSTemlateList["contact_id"];?>">
            <div class="row">
              <label class="col-sm-2 label-on-left">Update Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="contact_status" title="Update Status" tabindex="1">
                    <option value="2" selected>Follow Up</option>
                    <option value="3">Not Responding</option>
                    <option value="4">Interested</option>
                    <option value="5">Not Interested</option>
                    <option value="6">Converted</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Comment</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'contact_comment');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" rows="5" name="contact_comment" required></textarea>
                  <small><?php echo $vResult["contact_comment"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Re-Call Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="recheck_date" tabindex="3" />
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
		  <?php } else { ?>
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">contacts</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Non-Register Contact's Management </h4>
            <div class="toolbar text-right"> <?php if($objCheckLogin->user_type != 6 && $objCheckLogin->user_type != 1){?> <a href="<?php echo Route::_('show=smscontactlistform');?>" class="btn btn-primary">Add New</a> <?php } ?>
             </div>
            <hr>
            <div class="material-datatables">
               
            
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact Number</th>
                    <th>CNIC</th>
                    <th>Message/Note</th>
                    <th>Agent Name</th>
                    <th>Status</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadsms->resetProperty();
					
					if($objCheckLogin->user_type == 4){
					$objQayadsms->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					}
					if($objCheckLogin->user_type == 7){
					$objQayadsms->setProperty("location_id", trim($objQayaduser->location_id));
					}
                    $objQayadsms->setProperty("ORDERBY", 'contact_id DESC');
                    $objQayadsms->lstSMSNRContactList();
                    while($SMSTemlateList = $objQayadsms->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $SMSTemlateList["customer_name"];?></td>
                    <td><?php echo $SMSTemlateList["customer_number"];?></td>
                    <td><?php echo $SMSTemlateList["customer_cnic"];?></td>
                    <td><?php echo $SMSTemlateList["customer_note"];?></td>
                    <td><?php echo $SMSTemlateList["user_fname"].' '.$SMSTemlateList["user_lname"];?></td>
                    <td><?php echo StatusName($SMSTemlateList["isActive"]);?></td>
                    
                    <td class="d-print-none"><a href="<?php echo Route::_('show=smscontactlist&v='.EncData('open', 2, $objBF).'&scdi='.EncData($SMSTemlateList["contact_id"], 2, $objBF)); ?>">View</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } ?>
              
              
              
              
            </div>
          </div>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>