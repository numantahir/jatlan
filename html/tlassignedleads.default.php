<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Assign Leads', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right">  </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                    <th>FWD Date / Time</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'leads_id DESC');
					$objQayaduser->setProperty("assign_location_id", $LoginUserInfo["location_id"]);
					$objQayaduser->setProperty("rm_lead_fwd_status", 2);
					$objQayaduser->setProperty("assign_agent_status", 1);
                    $objQayaduser->lstLeads();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo LeadStatus($Leadslist["rm_lead_status"]);?></td>
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                    <td><?php echo dateFormate_9($Leadslist["rm_lead_fwd_datetime"]);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>

          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
