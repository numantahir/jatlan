<?php
if(trim(DecData($_GET["t"], 1, $objBF)) == 1){
$HeaderTitle = "List of Application Invoice's";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 2){
$HeaderTitle = "List of Token Amount";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 3){
$HeaderTitle = "List of Bank Account's";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 4){
$HeaderTitle = "List of Application Head's";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 5){
$HeaderTitle = "List of Properties";
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><?php echo $HeaderTitle;?></h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              
				<?php if($_GET["t"]==''){?>
                <div class="row page-center">
                <div class="col-sm-6 col-lg-3 center-btn">
                    <a href="<?php echo Route::_('show=invoice&t='.EncData('1', 2, $objBF));?>">
                    <div class="card">
                        <div class="card-content text-center invoice">
                            <div class="icons genral"><img src="../assets/img/ledger-icon.png"></div><h4 style="color:#06C">Application</h4>
                        </div>
                    </div>
                    </a>
                </div>
                
                <div class="col-sm-6 col-lg-3 center-btn ">
                    <a href="<?php echo Route::_('show=invoice&t='.EncData('2', 2, $objBF));?>">
                    <div class="card">
                        <div class="card-content text-center invoice">
                            <div class="icons genral"><img src="../assets/img/ledger-icon.png"></div><h4 style="color:#06C">Token Amount</h4>
                        </div>
                    </div>
                    </a>
                </div>
                 </div>
                 <?php } else {?>
              <?php if(DecData($_GET["t"], 1, $objBF)==1){?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Application #</th>
                    <th>Unit#</th>
                    <th>Unit Size</th>
                    <th>Section/Floor/Area/Property#</th>
                    <th>Booking Date</th>
                    <th>Amount</th>
                    <th>Customer Name</th>
                    <th>Invoice</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadPaymentInvoice = new Qayadapplication;
					$objQayadPaymentHistory = new Qayadapplication;
                    $objQayadAplicCustomer = new Qayadapplication;
					$objQayadAplicPaymentDetail = new Qayadapplication;
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("aplic_stage", 3);
                    $objQayadapplication->setProperty("ORDERBY", 'aplic_id DESC');
                    $objQayadapplication->lstApplication();
                    while($ListofAplic = $objQayadapplication->dbFetchArray(1)){
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadProerty->resetProperty();
					/**/$objQayadProerty->setProperty("property_share_id", $ListofAplic["property_share_id"]);
					/**/$objQayadProerty->lstPropertyShares();
					/**/$PropertyUnitDetail = $objQayadProerty->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadProerty->resetProperty();
					/**/$objQayadProerty->setProperty("property_id", $ListofAplic["property_id"]);
					/**/$objQayadProerty->lstPropertyDetail();
					/**/$PropertyDetail = $objQayadProerty->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					/**/$objQayadAplicPaymentDetail->setProperty("customer_id", $ListofAplic["customer_id"]);
					/**/$objQayadAplicPaymentDetail->lstApplicationPaymentDetail();
					/**/$AplicPaymentDetail = $objQayadAplicPaymentDetail->dbFetchArray(1);
					/**///////////////////////////////////////////////////////////////////////////////
					//
                    ?>
                  <tr>
                    <td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'af.php?i='.EncData($ListofAplic["aplic_id"], 2, $objBF);?>');"><?php echo $ListofAplic["reg_number"];?></a></td>
                    <td><?php echo $PropertyUnitDetail["property_share_number"];?></td>
                    <td><?php echo $PropertyUnitDetail["share_unit_size"];?> Sq-Ft</td>
                    <td><?php echo $PropertyDetail["property_section"].'/'.$PropertyDetail["floor_name"].'/'.$PropertyDetail["property_area"].'/'.$PropertyDetail["property_number"];?></td>
                    <td><?php echo dateFormate_4($ListofAplic["aplic_date"]);?></td>
                    <td><?php echo Numberformt($AplicPaymentDetail["amount_deposit"]);?></td>
                    <td><?php echo $objQayadAplicCustomer->ApplicationCustomer($ListofAplic["customer_id"]);?></td>
                    <td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'inv.php?i='.EncData($AplicPaymentDetail["payment_id"], 2, $objBF).'&tp='.EncData('invoice', 2, $objBF);?>');">Invoice</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
				<?php } elseif(DecData($_GET["t"], 1, $objBF)==2){?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Customer Name</th>
                    <th>CNIC Number</th>
                    <th>Unit#</th>
                    <th>Section/Floor/Area/Property#</th>
                    <th>Booking Date</th>
                    <th>Amount</th>
                    <th>Print</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("lock_status", 1);
                    $objQayadProerty->setProperty("ORDERBY", 'temp_lock_id DESC');
                    $objQayadProerty->lstPropertyUnitDetail();
                    while($ListOfLockAplic = $objQayadProerty->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $ListOfLockAplic["customer_fname"] .' '. $ListOfLockAplic["customer_lname"];?></td>
                    <td><?php echo CnicFormat($ListOfLockAplic["customer_cnic"]);?></td>
                    <td><?php echo $ListOfLockAplic["property_share_number"];?></td>
                    <td><?php echo $ListOfLockAplic["property_section"].'/'.$ListOfLockAplic["floor_name"].'/'.$ListOfLockAplic["property_area"].'/'.$ListOfLockAplic["property_number"];?></td>
                    <td><?php echo dateFormate_4($ListOfLockAplic["entery_date"]);?></td>
                    <td><?php echo Numberformt($ListOfLockAplic["received_amount"]);?></td>
                    <td><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'inv.php?tp='.EncData('token', 2, $objBF).'&i='.EncData($ListOfLockAplic["temp_lock_id"], 2, $objBF);?>');">Print</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
                 <?php } } ?>       
             
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