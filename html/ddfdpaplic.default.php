<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Forward to Finance Aplication List</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Registration#</th>
                    <th>Unit#</th>
                    <th>Type/Section/Floor/Area/Property#</th>
                    <th>Booking Date</th>
                    <th>Customer Name</th>
                    <th>Booking From</th>
                  </tr>
                </thead>
                <tbody>
					<?php
                    $objQayadAplicCustomer = new Qayadapplication;
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("aplic_stage", 2);
                    $objQayadapplication->setProperty("ORDERBY", 'aplic_id DESC');
                    $objQayadapplication->lstApplication();
                    while($ListofAplic = $objQayadapplication->dbFetchArray(1)){
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadProerty->resetProperty();
					/**/$objQayadProerty->setProperty("property_share_id", $ListofAplic["property_share_id"]);
					/**/$objQayadProerty->lstPropertyShares();
					/**/$UnitsDetail = $objQayadProerty->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadProerty->resetProperty();
					/**/$objQayadProerty->setProperty("property_id", $ListofAplic["property_id"]);
					/**/$objQayadProerty->lstProperties();
					/**/$PropertyDetail = $objQayadProerty->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadAplicCustomer->setProperty("customer_id", $ListofAplic["customer_id"]);
					/**/$objQayadAplicCustomer->lstApplicationCustomer();
					/**/$AplicCustomer = $objQayadAplicCustomer->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
                    ?>
                  <tr>
                    <td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'af.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF);?>');"><?php echo $ListofAplic["reg_number"];?></a></td>
                    <td><?php echo $UnitsDetail["property_share_number"];?></td>
                    <td><?php echo RegisterProject($PropertyDetail["property_registered_id"]).'/'.$PropertyDetail["property_section"].'/'.$PropertyDetail["floor_name"].'/'.$PropertyDetail["property_area"].'/'.$PropertyDetail["property_number"];?></td>
                    <td><?php echo dateFormate_4($ListofAplic["aplic_date"]);?></td>
                    <td><?php echo $AplicCustomer["fullname"];?></td>
                    <td><?php echo ApplicBookingFrom($ListofAplic["aplic_reg_type"]);?></td>
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
<style>
	table#datatables td:last-child {
    text-align: left;
}
</style>