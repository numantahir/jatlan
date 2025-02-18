<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Web Base Leads Management</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th style="width:5% !important;"><input type="checkbox" id="checkAll"></th>
                    <th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Client Email</th>
                    <th>Message</th>
                    <th>From</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  <th></th>
                  	<th>Client Name</th>
                    <th>Phone Number</th>
                    <th>Client Email</th>
                    <th>Message</th>
                    <th>From</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'prospect_id DESC');
					$objQayaduser->setProperty("isActive", 1);
                    $objQayaduser->lstProspectDetail();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                     <td><input type="checkbox" class="leadscheckbox" name="leads_id[]" required value="<?php echo $Leadslist["prospect_id"];?>"></td>
                    <td><?php echo $Leadslist["prospect_name"];?></td>
                    <td><?php echo $Leadslist["prospect_phone"];?></td>
                    <td><?php echo $Leadslist["prospect_email"];?></td>
                    <td><?php echo $Leadslist["prospect_msg"];?></td>
                    <td><?php echo ProspectFromId($Leadslist["prospect_formid"]);?></td>
                    <td><?php echo dateFormate_4($Leadslist["entery_date"]);?></td>
                    <td><a href="<?php echo Route::_('show=webbaselead&v='.EncData('del', 2, $objBF).'&ldi='.EncData($Leadslist["prospect_id"], 2, $objBF)); ?>"><i class="material-icons">delete</i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </div>
          <!-- end content--> 
          </form>
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>