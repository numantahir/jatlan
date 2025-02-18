<?php
$objQayaduser->resetProperty();
$objQayaduser->setProperty("ORDERBY", 'leads_id DESC');
$objQayaduser->setProperty("leads_id", trim(DecData($_GET["li"], 1, $objBF)));
$objQayaduser->lstLeads();
$Leadslist = $objQayaduser->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="forward_to_option" value="1">
          <input type="hidden" name="leads_id[]" value="<?php echo $Leadslist["leads_id"];?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Re-Assign Leads', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=assignto');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            
            
            <table id="datatables1" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Status</th>
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Message</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo LeadStatus($Leadslist["rm_lead_status"]);?></td>
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                  </tr>
                </tbody>
              </table>
            <hr>
            
            <div class="row">
              
              <div class="col-sm-5">
              <label class="label-on-left">Team Lead Of</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="assign_location_id" required id="team_lead_of" title="Select Team Lead Of" tabindex="2">
                  	<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'location_name DESC');
					$objQayaduser->setProperty("location_id_not", $Leadslist["assign_location_id"]);
                    $objQayaduser->lstLocation();
                    while($LocationList = $objQayaduser->dbFetchArray(1)){
                    ?>
                    <option value="<?php echo $LocationList["location_id"];?>"><?php echo $LocationList["location_name"];?></option>
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
