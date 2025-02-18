<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            
            <?php if($_GET["li"] == ''){ ?>
            <h4 class="card-title CardWidth">Select Location For Team Lead</h4>
            <?php } else { 
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("location_id", trim(DecData($_GET["li"], 1, $objBF)));
			$objQayaduser->setProperty("location_id", $LoginUserInfo["location_id"]);
			$objQayaduser->lstLocation();
			$GetLocationDetail = $objQayaduser->dbFetchArray(1);
			?>
            <h4 class="card-title CardWidth">List of (<?php echo $GetLocationDetail["location_name"];?>) Team Lead</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=setteamlead&li='.EncData($GetLocationDetail["location_id"], 2, $objBF));?>" class="btn btn-primary">Change/New Team Lead</a> </div>
            <?php } ?>
            <hr>
            
             <?php
			 		if($_GET["li"] == ''){
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'location_name');
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("location_id", $LoginUserInfo["location_id"]);
                    $objQayaduser->lstLocation();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
            <div class="col-md-4 col-md-offset-1">
                <div class="card">
                	<a href="<?php echo Route::_('show=teamlead&li='.EncData($Leadslist["location_id"], 2, $objBF));?>">
                    <div class="card-content text-center">
                        <code><?php echo $Leadslist["location_name"];?></code>
                    </div>
                    </a>
                </div>
            </div>
			<?php } } else { ?>
            
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Agent Name</th>
                    <th>Phone Number</th>
                    <th>Location</th>
                    <th>My Agents</th>
                    <th>No.of Agents</th>
                    <th>Change/Del</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadTeamLead = new Qayaduser;
					$objQayadTLAgents = new Qayaduser;
					$objQayadTeamLead->setProperty("location_id", trim(DecData($_GET["li"], 1, $objBF)));
					$objQayadTeamLead->setProperty("teamlead_status", 2);
                    $objQayadTeamLead->lstUsers();
                    while($TeamLeadList = $objQayadTeamLead->dbFetchArray(1)){
						$objQayadTLAgents->setProperty("teamlead_id", $TeamLeadList["user_id"]);
                    	$objQayadTLAgents->lstUsers();
						$TotalNoOfAgents = $objQayadTLAgents->totalRecords();
                    ?>
                  <tr>
                    <td><?php echo $TeamLeadList["fullname"];?></td>
                    <td><?php echo $TeamLeadList["user_mobile"];?></td>
                    <td><?php echo $objQayaduser->GetLocation($TeamLeadList["location_id"]);?></td>
                    <td><a href="<?php echo Route::_('show=myagents&tli='.EncData($TeamLeadList["user_id"], 2, $objBF));?>">My Agent</a></td>
                    <td><?php echo $TotalNoOfAgents;?></td>
                    <td><a href="<?php echo Route::_('show=tloption&tli='.EncData($TeamLeadList["user_id"], 2, $objBF));?>">Change/Del</a></td>
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