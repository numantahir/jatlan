<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Assign Leads</h4>
            </div>
            <div class="toolbar btn-back text-right"> <span onClick="window.print();" class="btn d-print-none"><i class="material-icons">print</i></span> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <?php if(trim(DecData($_GET["v"], 1, $objBF)) == 'open' && trim(DecData($_GET["aldi"], 1, $objBF)) != ''){
				$objQayadAssignLeads = new Qayaduser;
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("assign_lead_id", trim(DecData($_GET["aldi"], 1, $objBF)));
				$objQayaduser->lstLeadsAssign();
				$GetLeadStatus = $objQayaduser->dbFetchArray(1);
				
				$objQayadAssignLeads->setProperty("leads_id", $GetLeadStatus["lead_id"]);
				$objQayadAssignLeads->lstLeads();
				$Leadslist = $objQayadAssignLeads->dbFetchArray(1);
				 ?>
            <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td>Client Name</td>
                    <td><?php echo $Leadslist["client_name"];?></td>
                  </tr>
                  <tr>
                    <td>Phone Number</td>
                    <td><a href="tel:<?php echo $Leadslist["client_phone_number"];?>"><?php echo $Leadslist["client_phone_number"];?></a></td>
                  </tr>
                  <tr>
                    <td>Client Email</td>
                    <td><a href="mailto:<?php echo $Leadslist["client_email"];?>"><?php echo $Leadslist["client_email"];?></a></td>
                  </tr>
                  <tr>
                    <td>Client Message</td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                  </tr>
                  <tr>
                    <td>Assign Date / Time</td>
                    <td><?php echo $GetLeadStatus["assign_date"].'/'.$GetLeadStatus["assign_time"];?></td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td><?php echo $GetLeadStatus["assign_lead_id"].''.AssignAgentLeadStatus($GetLeadStatus["assign_action_status"]);?></td>
                  </tr>
                </tbody>
              </table>
              <hr>
              <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
              
                <tbody>
                <?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'entery_date DESC');
					$objQayaduser->setProperty("assign_lead_id", trim(DecData($_GET["aldi"], 1, $objBF)));
                    $objQayaduser->lstLeadComments();
                    while($LeadComments = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td style="width:70%;"><?php echo $LeadComments["lead_comment"];?></td>
                    <td style="width:15%;"><?php echo AssignAgentLeadStatus($LeadComments["assign_lead_status"]);?></td>
                    <td style="width:15%;"><?php echo dateFormate_9($LeadComments["entery_date"]);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
              <hr>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="assign_lead_id" value="<?php echo $GetLeadStatus["assign_lead_id"];?>">
            <input type="hidden" name="lead_id" value="<?php echo $GetLeadStatus["lead_id"];?>">
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Update Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="assign_action_status" title="Update Status" tabindex="1">
                    <option value="2" <?php echo StaticDDSelection(2, $assign_action_status["assign_action_status"]);?> selected>Follow Up</option>
                    <option value="3" <?php echo StaticDDSelection(3, $assign_action_status["assign_action_status"]);?>>Not Responding</option>
                    <option value="4" <?php echo StaticDDSelection(4, $assign_action_status["assign_action_status"]);?>>Interested</option>
                    <option value="5" <?php echo StaticDDSelection(5, $assign_action_status["assign_action_status"]);?>>Not Interested</option>
                    <option value="6" <?php echo StaticDDSelection(6, $assign_action_status["assign_action_status"]);?>>Converted</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Comment</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'lead_comment');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" rows="8" name="lead_comment" required></textarea>
                  <small><?php echo $vResult["lead_comment"];?></small> </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
            <?php } else { ?>
            <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Client Name</th>
                    <th>Message</th>
                    <th>Assign Date</th>
                    <th>Assign Hour's</th>
                    <th class="d-print-none">View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objQayadAssignLeads = new Qayaduser;
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_date DESC");
					$objQayaduser->setProperty("assign_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					//$objQayaduser->setProperty("assign_lead_status_not", 1);
					$objQayaduser->lstLeadsAssign();
					while($GetLeadStatus = $objQayaduser->dbFetchArray(1)){
						
							$objQayadAssignLeads->setProperty("leads_id", $GetLeadStatus["lead_id"]);
							$objQayadAssignLeads->lstLeads();
							$Leadslist = $objQayadAssignLeads->dbFetchArray(1);
							$GetAssignTime = GetLeadAssignTime(date('Y-m-d H:i:s'), $Leadslist["assign_datetime"]);
                    ?>
                  <tr>
                    <td><?php echo AssignAgentLeadStatus($GetLeadStatus["assign_action_status"]);?></td>
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                    <td><?php echo $GetLeadStatus["assign_date"];?></td>
                    <td><?php 
					if($GetLeadStatus["assign_action_status"] == 1){
					echo 'D:'.$GetAssignTime->d.'/H:'.$GetAssignTime->h .'/M:'.$GetAssignTime->i;
					}
					?></td>
                    <td class="d-print-none"><a href="<?php echo Route::_('show=myleads&v='.EncData('open', 2, $objBF).'&aldi='.EncData($GetLeadStatus["assign_lead_id"], 2, $objBF)); ?>">View</a></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
              <?php } ?>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
