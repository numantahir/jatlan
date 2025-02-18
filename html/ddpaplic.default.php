<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Forward to Document Aplication List</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <?php if($objCheckLogin->user_type == 1){ ?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Registration#</th>
                    <th>Unit#</th>
                    <th>Floor/Type/Number</th>
                    <th>Booking Date</th>
                    <th>Customer Name</th>
                    <th>Book As</th>
                    <th>Agent</th>
                  </tr>
                </thead>
                <tbody>
					<?php
                    $objQayadAplicCustomer = new Qayadapplication;
					$objQayadProertyInfo = new Qayadproperty;
					$objQayadapplication->resetProperty();
					if($objCheckLogin->user_type != 1){
					$objQayadapplication->setProperty("user_id", trim(DecData($objCheckLogin->user_id, 1, $objBF)));	
					}
					$objQayadapplication->setProperty("aplic_stage", 4);
                    $objQayadapplication->setProperty("ORDERBY", 'aplic_id DESC');
                    $objQayadapplication->lstApplication();
                    while($ListofAplic = $objQayadapplication->dbFetchArray(1)){
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadProerty->resetProperty();
					/**/$objQayadProerty->setProperty("property_share_id", $ListofAplic["property_share_id"]);
					/**/$objQayadProerty->lstPropertyShares();
					/**/$PropertyUnitDetail = $objQayadProerty->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadAplicCustomer->setProperty("customer_id", $ListofAplic["customer_id"]);
					/**/$objQayadAplicCustomer->lstApplicationCustomer();
					/**/$AplicCustomer = $objQayadAplicCustomer->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
                    ?>
                  <tr>
                    <td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'af.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF);?>');"><?php echo $ListofAplic["reg_number"];?></a></td>
                    <td><?php echo $PropertyUnitDetail["property_share_number"];?></td>
                    <td><?php echo $objQayadProertyInfo->PropertyInfo($ListofAplic["property_id"]);?></td>
                    <td><?php echo dateFormate_4($ListofAplic["aplic_date"]);?></td>
                    <td><?php echo $AplicCustomer["fullname"];?></td>
                    <td><?php echo ApplicBookingFrom($ListofAplic["aplic_reg_type"]);?></td>
                    <td><?php echo $objQayaduser->GetUserFullName($ListofAplic["user_id"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else { ?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Registration#</th>
                    <th>Unit#</th>
                    <th>Floor/Type/Number</th>
                    <th>Booking Date</th>
                    <th>Customer Name</th>
                  </tr>
                </thead>
                <tbody>
					<?php
                    $objQayadAplicCustomer = new Qayadapplication;
					$objQayadProertyInfo = new Qayadproperty;
					$objQayadapplication->resetProperty();
					if($objCheckLogin->user_type != 1){
					$objQayadapplication->setProperty("user_id", trim(DecData($objCheckLogin->user_id, 1, $objBF)));	
					}
					$objQayadapplication->setProperty("aplic_stage", 4);
                    $objQayadapplication->setProperty("ORDERBY", 'aplic_id DESC');
                    $objQayadapplication->lstApplication();
                    while($ListofAplic = $objQayadapplication->dbFetchArray(1)){
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadProerty->resetProperty();
					/**/$objQayadProerty->setProperty("property_share_id", $ListofAplic["property_share_id"]);
					/**/$objQayadProerty->lstPropertyShares();
					/**/$PropertyUnitDetail = $objQayadProerty->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadAplicCustomer->setProperty("customer_id", $ListofAplic["customer_id"]);
					/**/$objQayadAplicCustomer->lstApplicationCustomer();
					/**/$AplicCustomer = $objQayadAplicCustomer->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
                    ?>
                  <tr>
                    <td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'af.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF);?>');"><?php echo $ListofAplic["reg_number"];?></a></td>
                    <td><?php echo $PropertyUnitDetail["property_share_number"];?></td>
                    <td><?php echo $objQayadProertyInfo->PropertyInfo($ListofAplic["property_id"]);?></td>
                    <td><?php echo dateFormate_4($ListofAplic["aplic_date"]);?></td>
                    <td><?php echo $AplicCustomer["fullname"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } ?>
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