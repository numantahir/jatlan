<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Assign Leads', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=leads');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            
            
            <table class="datatablesbtn_limited table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th style="width:5%"><input type="checkbox" id="checkAll"></th>
                    <!--<th>Status</th>-->
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'leads_id DESC');
					//$objQayaduser->setProperty("rm_user_id", $LoginUserInfo["user_id"]);
					$objQayaduser->setProperty("assign_location_id", $LoginUserInfo["location_id"]);
					$objQayaduser->setProperty("rm_lead_fwd_status", 1);
					//$objQayaduser->setProperty("rm_lead_status_not", 1);
                    $objQayaduser->lstLeads();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><input type="checkbox" class="leadscheckbox" name="leads_id[]" required value="<?php echo $Leadslist["leads_id"];?>"></td>
                   <!-- <td><?php //echo LeadStatus($Leadslist["rm_lead_status"]);?></td>-->
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                    <td><?php echo dateFormate_4($Leadslist["entery_datetime"]);?></td>
                  </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
            <hr>
            
            <div class="row">
              <div class="col-sm-3">
              <label class="label-on-left">Forward To</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="forward_to_option" required id="forward_to_option" title="Forward To" tabindex="1">
                    <option value="" selected>Select Option</option>
                    <?php if($LoginUserInfo["location_id"]!=4){?>
                    <option value="1">Team Lead</option>
                    <?php } ?>
                    <?php //if($LoginUserInfo["location_id"]==4){?>
                    <option value="2">Any Single Agent</option>
                    <?php //} ?>
                  </select>
                </div>
              </div>
              
               <?php if($LoginUserInfo["location_id"]!=4){?>
              <div class="col-sm-5" style="display:none;" id="teamlead_opt">
              <label class="label-on-left">Team Lead Of</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="assign_location_id" required id="team_lead_of" title="Select Team Lead Of" tabindex="2">
                  	<?php $objQayaduser->resetProperty(); echo $objQayaduser->LocationComboWTL(); ?>
                  </select>
                </div>
              </div>
              <?php } ?>
              
              <div class="col-sm-5" style="display:none;" id="agentlist_opt">
              <label class="label-on-left">Select Agent</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="assign_agent_id" required id="team_lead_of" title="Agent List" tabindex="2">
					<?php
                    $objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive", 1);
                    $objQayaduser->setProperty("user_type_id_array", '4,14');
					$objQayaduser->setProperty("location_id", $LoginUserInfo["location_id"]);
                    $objQayaduser->setProperty("ORDERBY", 'user_fname DESC');
                    $objQayaduser->lstUsers();
                    while($ListOfUsers = $objQayaduser->dbFetchArray(1)){
                    ?>
                  	<option value="<?php echo $ListOfUsers["location_id"].'-'.$ListOfUsers["user_id"];?>"><?php echo $ListOfUsers["fullname"];?></option>
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
