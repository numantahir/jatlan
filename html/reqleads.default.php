<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo RequestedLeadsTitle(trim(DecData($_GET["rt"], 1, $objBF)));?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <span onClick="window.print();" class="btn d-print-none"><i class="material-icons">print</i></span> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <?php if(trim(DecData($_GET["opt"], 1, $objBF)) == 1){ ?>
            <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Client Name</th>
                    <th>Message</th>
                    <th>Agent Name</th>
                    <th>Assign Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
					$objQayadAgentName = new Qayaduser;
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("lead_from_id", trim(DecData($_GET["lt"], 1, $objBF)));
					//$objQayaduser->setProperty("assign_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->lstLeadAssignedCom();
					while($GetLeadStatus = $objQayaduser->dbFetchArray(1)){
						
				  ?>
                  <tr>
                    <td><?php echo AssignAgentLeadStatus($GetLeadStatus["assign_action_status"]);?></td>
                    <td><?php echo $GetLeadStatus["client_name"];?></td>
                    <td><?php echo $GetLeadStatus["client_message"];?></td>
                    <td><?php echo $objQayadAgentName->GetUserFullName($GetLeadStatus["assign_user_id"]);?></td>
                    <td><?php echo $GetLeadStatus["assign_date"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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
				if(trim(DecData($_GET["rt"], 1, $objBF)) <= 6){
					$objQayadAssignLeads = new Qayaduser;
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_date DESC");
					$objQayaduser->setProperty("assign_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->setProperty("assign_action_status", trim(DecData($_GET["rt"], 1, $objBF)));
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
                  <?php } } else { 
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("rm_lead_status", trim(DecData($_GET["rt"], 1, $objBF)));
					$objQayaduser->setProperty("assign_user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->lstLeadAssignedCom();
					while($GetLeadStatus = $objQayaduser->dbFetchArray(1)){
						$GetAssignTime = GetLeadAssignTime(date('Y-m-d H:i:s'), $GetLeadStatus["assign_datetime"]);
				  ?>
                  <tr>
                    <td><?php echo AssignAgentLeadStatus($GetLeadStatus["assign_action_status"]);?></td>
                    <td><?php echo $GetLeadStatus["client_name"];?></td>
                    <td><?php echo $GetLeadStatus["client_message"];?></td>
                    <td><?php echo $GetLeadStatus["assign_date"];?></td>
                    <td><?php 
					if($GetLeadStatus["assign_action_status"] == 1){
					echo 'D:'.$GetAssignTime->d.'/H:'.$GetAssignTime->h .'/M:'.$GetAssignTime->i;
					}
					?></td>
                    <td class="d-print-none"><a href="<?php echo Route::_('show=myleads&v='.EncData('open', 2, $objBF).'&aldi='.EncData($GetLeadStatus["assign_lead_id"], 2, $objBF)); ?>">View</a></td>
                  </tr>
                  <?php } } ?>
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
