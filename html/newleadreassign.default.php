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
                    <th><input type="checkbox" id="checkAll"></th>
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
					$objQayaduser->setProperty("leads_id", trim($objBF->decrypt($_GET["ldi"], 1, ENCRYPTION_KEY)));
                    $objQayaduser->lstLeads();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><input type="checkbox" class="leadscheckbox" name="leads_id[]" required value="<?php echo $Leadslist["leads_id"];?>"></td>
                    <td><?php echo LeadStatus($Leadslist["rm_lead_status"]);?></td>
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                    <td><?php echo dateFormate_9($Leadslist["rm_lead_fwd_datetime"]);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
            <hr>
            
            <div class="row">
              
              <div class="col-sm-5">
              <label class="label-on-left">Select Agent to Assign Leads</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="assign_agent_id" required id="team_lead_of" title="Agent List" tabindex="2">
					<?php
                    $objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isNot", 3);
					if($LoginUserInfo["teamlead_status"] == 2){
					$objQayaduser->setProperty("teamlead_id", $LoginUserInfo["user_id"]);	
					} else {
                    $objQayaduser->setProperty("location_id", $LoginUserInfo["location_id"]);
					}
					$objQayaduser->setProperty("user_type_id", '4');
                    $objQayaduser->setProperty("ORDERBY", 'user_fname DESC');
                    $objQayaduser->lstUsers();
                    while($ListOfUsers = $objQayaduser->dbFetchArray(1)){
                    ?>
                  	<option value="<?php echo $ListOfUsers["user_id"];?>"><?php echo $ListOfUsers["fullname"];?></option>
                    <?php } ?>
                  </select>
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
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
