<?php
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayaduser->lstUsers();
$GetRequestedEmp = $objQayaduser->dbFetchArray(1);

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("assign_action_status", 1);
$objQayaduser->lstAgentAssignLeads();
$NoOfNewLeads = $objQayaduser->totalRecords();

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("rm_lead_status", 2);
$objQayaduser->lstAgentAssignLeads();
$NoOfHotLeads = $objQayaduser->totalRecords();

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("rm_lead_status", 3);
$objQayaduser->lstAgentAssignLeads();
$NoOfColdLeads = $objQayaduser->totalRecords();

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("assign_action_status", 2);
$objQayaduser->lstAgentAssignLeads();
$NoOfFollowUpLeads = $objQayaduser->totalRecords();

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("assign_action_status", 3);
$objQayaduser->lstAgentAssignLeads();
$NoOfNotRespondingLeads = $objQayaduser->totalRecords();

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("assign_action_status", 4);
$objQayaduser->lstAgentAssignLeads();
$NoOfInterestedLeads = $objQayaduser->totalRecords();

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("assign_action_status", 5);
$objQayaduser->lstAgentAssignLeads();
$NoOfNotInterestedLeads = $objQayaduser->totalRecords();

$objQayaduser->resetProperty();
$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
$objQayaduser->setProperty("assign_action_status", 6);
$objQayaduser->lstAgentAssignLeads();
$NoOfConvertedLeads = $objQayaduser->totalRecords();

$objQayadsms->resetProperty();
$objQayadsms->setProperty("user_id", $GetRequestedEmp["user_id"]);
$objQayadsms->lstSMSNRContactList();
$NoOfMyContactLeads = $objQayadsms->totalRecords();

$objQayadsms->resetProperty();
$objQayadsms->setProperty("user_id", $GetRequestedEmp["user_id"]);
$objQayadsms->setProperty("data_selection", date("Y-m-d"));
$objQayadsms->lstSMSNRContactList();
$NoOfMyTodayContactLeads = $objQayadsms->totalRecords();
?>
<style>th{ font-size:1.0em !important;}</style>


<div class="content">
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-text" data-background-color="rose">
        <h4 class="card-title">Employee detail of <strong><?php echo $GetRequestedEmp["fullname"];?></strong></h4>
      </div>
      <div class="toolbar btn-back text-right"> </div>
      <div class="card-content">
        <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">No. of New/No Action Leads </span></div>
          <div class="card-content"><h3 class="card-title"><?php echo $NoOfNewLeads;?></h3></div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">No. of Hot Leads</span></div>
          <div class="card-content"><h3 class="card-title"><?php echo $NoOfHotLeads;?></h3></div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">No. of Cold Leads</span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfColdLeads;?></h3>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span"> No. of Follow up Leads</span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfFollowUpLeads;?></h3>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">No. of Not Responding</span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfNotRespondingLeads;?></h3>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">No. of Interested Leads</span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfInterestedLeads;?></h3>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">No. of Not Interested Leads</span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfNotInterestedLeads;?></h3>
          </div>
        </div>
      </div>
      
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">No. of Converted Leads</span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfConvertedLeads;?></h3>
          </div>
        </div>
      </div>
      
      
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">Today [<?php echo date("d-m-Y");?>] My Contact Leads</span> <span style="float:right;"><a href="">View List</a></span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfMyTodayContactLeads;?></h3>
          </div>
        </div>
      </div>
      
      
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div data-background-color="red"> <i class="material-icons">contacts</i> <span class="card_span">All My Contact Leads</span> <span style="float:right;"><a href="">View List</a></span></div>
          <div class="card-content">
            <h3 class="card-title"><?php echo $NoOfMyContactLeads;?></h3>
          </div>
        </div>
      </div>
        
        <hr>
        
        <div class="row">
        <div class="col-md-6">
        <div class="card" style="min-height:275px;">
        	<div class="col-md-12">
          <div data-background-color="green"> <i class="material-icons">people</i> <span class="card_span">List of No Action Lead's</span></div>
          <div class="card-content">
            <div class="row">
                <div class="material-datatables">
                  <table id="" class="datatables_home table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Client Name</th>
                            <th class="text-left">Client Phone#</th>
                            <th class="text-center">Assign Duration</th>
                            <th class="text-center">Assign By</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
					$objQayadAssignTo = new Qayaduser;
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_lead_id DESC");
					$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
					$objQayaduser->setProperty("assign_action_status", 1);
					$objQayaduser->lstAgentAssignLeads();
					while($GetAssignLeads = $objQayaduser->dbFetchArray(1)){										
							$GetAssignTime = GetLeadAssignTime(date('Y-m-d H:i:s'), $GetAssignLeads["assign_date"].' '.$GetAssignLeads["assign_time"]);
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $GetAssignLeads["client_name"];?></td>
                        <td class="text-left"><?php echo $GetAssignLeads["client_phone_number"];?></td>
                        <td class="text-center"><?php echo 'D:'.$GetAssignTime->d.'/H:'.$GetAssignTime->h .'/M:'.$GetAssignTime->i;?></td>
                        <td class="text-center"><?php echo LeadAssignBy($GetAssignLeads["assign_by"]);?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            </div>
        </div>
        
        <div class="col-md-6">
        <div class="card" style="min-height:275px;">
        	<div class="col-md-12">
          <div data-background-color="green"> <i class="material-icons">people</i> <span class="card_span">List of Follow up Lead's</span></div>
          <div class="card-content">
            <div class="row">
                <div class="material-datatables">
                  <table id="" class="datatables_home table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Client Name</th>
                            <th class="text-left">Client Phone#</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_lead_id DESC");
					$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
					$objQayaduser->setProperty("assign_action_status", 2);
					$objQayaduser->lstAgentAssignLeads();
					while($GetAssignLeads = $objQayaduser->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $GetAssignLeads["client_name"];?></td>
                        <td class="text-left"><?php echo $GetAssignLeads["client_phone_number"];?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <div class="card" style="min-height:275px;">
        	<div class="col-md-12">
          <div data-background-color="green"> <i class="material-icons">people</i> <span class="card_span">List of Not Responding Lead's</span></div>
          <div class="card-content">
            <div class="row">
                <div class="material-datatables">
                  <table id="" class="datatables_home table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Client Name</th>
                            <th class="text-left">Client Phone#</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_lead_id DESC");
					$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
					$objQayaduser->setProperty("assign_action_status", 3);
					$objQayaduser->lstAgentAssignLeads();
					while($GetAssignLeads = $objQayaduser->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $GetAssignLeads["client_name"];?></td>
                        <td class="text-left"><?php echo $GetAssignLeads["client_phone_number"];?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            </div>
        </div>
        
        <div class="col-md-6">
        <div class="card" style="min-height:275px;">
        	<div class="col-md-12">
          <div data-background-color="green"> <i class="material-icons">people</i> <span class="card_span">List of Interested Lead's</span></div>
          <div class="card-content">
            <div class="row">
                <div class="material-datatables">
                  <table id="" class="datatables_home table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Client Name</th>
                            <th class="text-left">Client Phone#</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_lead_id DESC");
					$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
					$objQayaduser->setProperty("assign_action_status", 4);
					$objQayaduser->lstAgentAssignLeads();
					while($GetAssignLeads = $objQayaduser->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $GetAssignLeads["client_name"];?></td>
                        <td class="text-left"><?php echo $GetAssignLeads["client_phone_number"];?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <div class="card" style="min-height:275px;">
        	<div class="col-md-12">
          <div data-background-color="green"> <i class="material-icons">people</i> <span class="card_span">List of Not Interested Lead's</span></div>
          <div class="card-content">
            <div class="row">
                <div class="material-datatables">
                  <table id="" class="datatables_home table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Client Name</th>
                            <th class="text-left">Client Phone#</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_lead_id DESC");
					$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
					$objQayaduser->setProperty("assign_action_status", 5);
					$objQayaduser->lstAgentAssignLeads();
					while($GetAssignLeads = $objQayaduser->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $GetAssignLeads["client_name"];?></td>
                        <td class="text-left"><?php echo $GetAssignLeads["client_phone_number"];?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            </div>
        </div>
        
        <div class="col-md-6">
        <div class="card" style="min-height:275px;">
        	<div class="col-md-12">
          <div data-background-color="green"> <i class="material-icons">people</i> <span class="card_span">List of Converted Lead's</span></div>
          <div class="card-content">
            <div class="row">
                <div class="material-datatables">
                  <table class="datatables_home table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Client Name</th>
                            <th class="text-left">Client Phone#</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("ORDERBY", "assign_lead_id DESC");
					$objQayaduser->setProperty("assign_user_id", $GetRequestedEmp["user_id"]);
					$objQayaduser->setProperty("assign_action_status", 6);
					$objQayaduser->lstAgentAssignLeads();
					while($GetAssignLeads = $objQayaduser->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $GetAssignLeads["client_name"];?></td>
                        <td class="text-left"><?php echo $GetAssignLeads["client_phone_number"];?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
            </div>
        </div>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
