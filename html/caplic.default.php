<?php 
$objQayadapplication->resetProperty();
$objQayadapplication->setProperty("customer_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadapplication->lstApplicationCustomer();
$ApplicantInfo = $objQayadapplication->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
       <h3 class="card-title CardWidth">Aplication List's of <?php echo $ApplicantInfo["fullname"];?></h3>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Registration#</th>
                    <th>Unit#</th>
                    <th>Floor/Type/Number</th>
                    <th>Booking Date</th>
                    <th>Nominee Name</th>
                    <th>Print Document</th>
                  </tr>
                </thead>
                <tbody>
					<?php
                    $objQayadAplicCustomer = new Qayadapplication;
					$objQayadProertyInfo = new Qayadproperty;
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("aplic_stage", 3);
					$objQayadapplication->setProperty("customer_id", $ApplicantInfo["customer_id"]);
                    $objQayadapplication->setProperty("ORDERBY", 'aplic_id DESC');
                    $objQayadapplication->lstApplication();
                    while($ListofAplic = $objQayadapplication->dbFetchArray(1)){
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadProerty->resetProperty();
					/**/$objQayadProerty->setProperty("property_share_id", $ListofAplic["property_share_id"]);
					/**/$objQayadProerty->lstPropertyShares();
					/**/$PropertyUnitDetail = $objQayadProerty->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadAplicCustomer->setProperty("customer_id", $ListofAplic["nominee_id"]);
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
                    <td><a href="<?php echo Route::_('show=printdoc&i='.EncData($ListofAplic["aplic_id"], 2, $objBF));?>">Print Document</a></td>
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