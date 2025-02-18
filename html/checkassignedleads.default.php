<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Assign Leads</h4>
            </div>
            <div class="toolbar btn-back text-right"> </div>
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
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                  </tr>
                  <tr>
                    <td>Client Email</td>
                    <td><?php echo $Leadslist["client_email"];?></td>
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
                    <td><?php echo AssignAgentLeadStatus($GetLeadStatus["assign_action_status"]);?></td>
                  </tr>
                </tbody>
              </table>
				
				<section class="comment-list">
					<h1>Comments</h1>
					<article class="row">
						<?php
						$objQayaduser->resetProperty();
						$objQayaduser->setProperty("ORDERBY", 'entery_date DESC');
						$objQayaduser->setProperty("assign_lead_id", trim(DecData($_GET["aldi"], 1, $objBF)));
						$objQayaduser->lstLeadComments();
						while($LeadComments = $objQayaduser->dbFetchArray(1)){
						?>
						<div class="col-md-1 col-sm-1 hidden-xs">
							<figure class="thumbnail">
								<img class="img-responsive" src="http://www.tangoflooring.ca/wp-content/uploads/2015/07/user-avatar-placeholder.png" />
								<!--<figcaption class="text-center">username</figcaption>-->
							</figure>
						</div>
						<div class="col-md-11 col-sm-11">
							<div class="panel panel-default arrow left">
								<div class="panel-body">
									<header class="text-left">
										<div class="comment-user"><i class="fa fa-user"></i> <?php echo AssignAgentLeadStatus($LeadComments["assign_lead_status"]);?></div>
										<date class="comment-date" date="16-12-2014"><i class="fa fa-clock-o"></i> <?php echo dateFormate_9($LeadComments["entery_date"]);?></date>
									</header>
									<div class="comment-post">
										<?php echo $LeadComments["lead_comment"];?>
									</div>
								</div>
							</div>
						</div>
						<div class="row"></div>
						<?php } ?>
					</article>
				</section>
				
				
            <?php } else { ?>
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                    <th>Assign Date / Time</th>
                    <th>Assign Hour's</th>
                    <th>Agent</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objQayadAssignLeads = new Qayaduser;
					$objQayadAgentName = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'assign_datetime DESC');
					$objQayaduser->setProperty("assign_location_id", $LoginUserInfo["location_id"]);
                    $objQayaduser->lstLeads();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
							
							$objQayadAssignLeads->setProperty("lead_id", $Leadslist["leads_id"]);
							$objQayadAssignLeads->setProperty("assign_lead_status", 1);
							$objQayadAssignLeads->lstLeadsAssign();
							if($objQayadAssignLeads->totalRecords() > 0){
							$GetLeadStatus = $objQayadAssignLeads->dbFetchArray(1);
							$GetAssignTime = GetLeadAssignTime(date('Y-m-d H:i:s'), $Leadslist["assign_datetime"]);
                    ?>
                  <tr>
                    <td><?php echo AssignAgentLeadStatus($GetLeadStatus["assign_action_status"]);?></td>
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                    <td><?php echo dateFormate_9($Leadslist["assign_datetime"]);?></td>
                    <td><?php echo 'D:'.$GetAssignTime->d.'/H:'.$GetAssignTime->h .'/M:'.$GetAssignTime->i;?></td>
                    <td><?php echo $objQayadAgentName->GetUserFullName($GetLeadStatus["assign_user_id"]);?></td>
                    <td>
                    <?php 
					if($GetLeadStatus["assign_action_status"] == 1){
						echo '<a href="'.Route::_('show=newleadreassign&ldi='.EncData($Leadslist["leads_id"], 2, $objBF)).'">Re-Assign</a>';
					} else {
						echo '<a href="'.Route::_('show=checkassignedleads&v='.EncData('open', 2, $objBF).'&aldi='.EncData($GetLeadStatus["assign_lead_id"], 2, $objBF)).'">View</a>';
					}
					?>
                    </td>
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
