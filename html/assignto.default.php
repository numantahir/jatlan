<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Assign Leads To Team <?php echo trim(DecData($_GET["li"], 1, $objBF));?></h4>
            <div class="toolbar text-right">  </div>
            <hr>
            
             <?php
			 if($_GET["li"] == ''){
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'location_name');
					$objQayaduser->setProperty("isActive", 1);
					if($LoginUserInfo["location_id"] != 1){
					$objQayaduser->setProperty("location_id", $LoginUserInfo["location_id"]);
					}
                    $objQayaduser->lstLocation();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
            <div class="col-md-4 col-md-offset-1">
                <div class="card">
                	<a href="<?php echo Route::_('show=assignto&li='.EncData($Leadslist["location_id"], 2, $objBF));?>">
                    <div class="card-content text-center">
                        <code><?php echo $Leadslist["location_name"];?></code>
                    </div>
                    </a>
                </div>
            </div>
			<?php } } else { ?>
            <div class="material-datatables">
              <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Client Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Agent Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Client Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Agent Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayadAssignLeads = new Qayaduser;
					$objQayadAssignUser = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'leads_id DESC');
					$objQayaduser->setProperty("assign_location_id", trim(DecData($_GET["li"], 1, $objBF)));
					//$objQayaduser->setProperty("rm_user_id", $LoginUserInfo["user_id"]);
					$objQayaduser->setProperty("rm_lead_fwd_status", 2);
                    $objQayaduser->lstLeads();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
							
							$objQayadAssignLeads->resetProperty();
							$objQayadAssignLeads->setProperty("lead_id", $Leadslist["leads_id"]);
							$objQayadAssignLeads->lstLeadsAssign();
							$GetLeadStatus = $objQayadAssignLeads->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                    <td><?php echo $Leadslist["client_email"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                    <td><?php echo dateFormate_3($GetLeadStatus["assign_date"]);?></td>
                    <td><?php echo $objQayadAssignUser->GetUserFullName($GetLeadStatus["assign_user_id"]);?></td>
                    <td><?php echo AssignAgentLeadStatus($GetLeadStatus["assign_action_status"]);?></td>
                    <td>
                     <?php 
					 if($GetLeadStatus["assign_lead_id"] != ''){
					if($GetLeadStatus["assign_action_status"] == 1){
						echo '<a href="'.Route::_('show=newleadreassign&ldi='.EncData($Leadslist["leads_id"], 2, $objBF)).'">Re-Assign</a>';
					} else {
						echo '<a href="'.Route::_('show=assignedleads&v='.EncData('open', 2, $objBF).'&aldi='.EncData($GetLeadStatus["assign_lead_id"], 2, $objBF)).'">View</a>';
					}
					 }
					?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            
            <?php } ?>
            
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