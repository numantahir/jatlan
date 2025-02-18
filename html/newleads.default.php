<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">New Leads</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=assignleads');?>" class="btn btn-primary">Assign Leads</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Client Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Hot / Cold</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Client Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Hot / Cold</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'leads_id DESC');
					$objQayaduser->setProperty("assign_location_id", $LoginUserInfo["location_id"]);
					$objQayaduser->setProperty("rm_lead_fwd_status", 1);
                    $objQayaduser->lstLeads();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $Leadslist["client_name"];?></td>
                    <td><?php echo $Leadslist["client_phone_number"];?></td>
                    <td><?php echo $Leadslist["client_email"];?></td>
                    <td><?php echo $Leadslist["client_message"];?></td>
                    <td><?php echo dateFormate_4($Leadslist["entery_datetime"]);?></td>
                    <td><?php echo LeadStatus($Leadslist["rm_lead_status"]);?></td>
                    <td>
                    <?php if($Leadslist["rm_lead_status"] == 1){?>
                    <a href="<?php echo Route::_('show=newleads&mode='.EncData('Hot', 2, $objBF).'&li='.EncData($Leadslist["leads_id"], 2, $objBF));?>">Hot</a> &nbsp;/&nbsp; <a href="<?php echo Route::_('show=newleads&mode='.EncData('Cold', 2, $objBF).'&li='.EncData($Leadslist["leads_id"], 2, $objBF));?>">Cold</a>
                    <?php } elseif($Leadslist["rm_lead_status"] == 2){?>
                    <strong>Hot</strong> &nbsp;/&nbsp; <a href="<?php echo Route::_('show=newleads&mode='.EncData('Cold', 2, $objBF).'&li='.EncData($Leadslist["leads_id"], 2, $objBF));?>">Cold</a>
                    <?php } elseif($Leadslist["rm_lead_status"] == 3){?>
                    <a href="<?php echo Route::_('show=newleads&mode='.EncData('Hot', 2, $objBF).'&li='.EncData($Leadslist["leads_id"], 2, $objBF));?>">Hot</a> &nbsp;/&nbsp; <strong>Cold</strong>
                    <?php } ?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
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