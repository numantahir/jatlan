<div class="content">
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-text" data-background-color="rose">
        <h4 class="card-title">No Action Leads</h4>
      </div>
      <div class="toolbar btn-back text-right"> </div>
      <div class="card-content">
        <div class="col-md-12 Bord-Rt no-border-right">
          <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
              <tr>
                <th>Phone #</th>
                <th>Client Name</th>
                <th>Message</th>
                <th>Assign Date</th>
                <th>Duration</th>
                <th>Agent</th>
              </tr>
            </thead>
            <tbody>
              <?php
					$objQayadAssignLeads = new Qayaduser;
					$objQayadAgentName = new Qayaduser;
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_date DESC");
					$objQayaduser->setProperty("assign_action_status", 1);
					$objQayaduser->setProperty("assign_location_id", $LoginUserInfo["location_id"]);
					$objQayaduser->lstLeadsAssign();
					while($GetLeadStatus = $objQayaduser->dbFetchArray(1)){
						
							$objQayadAssignLeads->setProperty("leads_id", $GetLeadStatus["lead_id"]);
							$objQayadAssignLeads->lstLeads();
							$Leadslist = $objQayadAssignLeads->dbFetchArray(1);
							$GetAssignTime = GetLeadAssignTime(date('Y-m-d H:i:s'), $Leadslist["assign_datetime"]);
							$NumberofDays = $GetAssignTime->d * 24 * 60; $NumberofHours = $GetAssignTime->h * 60;
							$NumberofMintues = $GetAssignTime->i; $GetTotalMinutes = $NumberofDays + $NumberofHours + $NumberofMintues;
						//	if($GetTotalMinutes > 720){
                    ?>
              <tr>
                <td><?php echo $Leadslist["client_phone_number"];?></td>
                <td><?php echo $Leadslist["client_name"];?></td>
                <td><?php echo $Leadslist["client_message"];?></td>
                <td><?php echo $GetLeadStatus["assign_date"];?></td>
                <td><?php echo MinutesConvertHours($GetTotalMinutes); ?></td>
                <td><?php echo $objQayadAgentName->GetUserFullName($GetLeadStatus["assign_user_id"]);?></td>
              </tr>
              <?php } //}?>
            </tbody>
          </table>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
