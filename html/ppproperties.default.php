<?php 
$objQayadProerty->resetProperty();
$objQayadProerty->setProperty("project_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadProerty->lstProjects();
$GetProjectDetail = $objQayadProerty->dbFetchArray(1);
/********************************************************************************************/
$objQayadProerty->resetProperty();
$objQayadProerty->setProperty("propety_floor_id", trim(DecData($_GET["fi"], 1, $objBF)));
$objQayadProerty->lstPropertyFloorPlan();
$GetFloorDetail = $objQayadProerty->dbFetchArray(1);
/********************************************************************************************/
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
	      <?php if($_GET["pi"]==''){?>
          <h3 class="card-title CardWidth">Payment Plan of (<?php echo $GetProjectDetail["project_name"].' >> '.$GetFloorDetail["floor_name"];?>)</h3>
            <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=pppropertyform&i='.EncData($GetProjectDetail["project_id"], 2, $objBF).'&fi='.EncData($GetFloorDetail["propety_floor_id"], 2, $objBF));?>" class="btn btn-primary">Add New</a> </div>
          <?php } else { ?>
          <h3 class="card-title CardWidth">Payment Plan of (<?php echo $GetProjectDetail["project_name"].' >> '.$GetFloorDetail["floor_name"];?>)</h3>
          <?php } ?>
        <div class="card">
          <div class="card-content">
            <?php if($_GET["pi"]==''){?>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Rate/Sq-ft</th>
                    <th>Payback</th>
                    <th>Transfer Fee</th>
                    <th>Registration Fee</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("project_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objQayadProerty->setProperty("floor_id", trim(DecData($_GET["fi"], 1, $objBF)));
					$objQayadProerty->setProperty("ORDERBY", 'floor_payment_id DESC');
					$objQayadProerty->lstFloorPaymentDetail();
					while($PaymentPlan = $objQayadProerty->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo Numberformt_second($PaymentPlan["rate_per_sq_ft"]);?>/Sq-Ft</td>
                    <td><?php echo PayBackCuttingMode($PaymentPlan["payback_cutting"]) . ' ' . $PaymentPlan["pb_cutting_value"];?></td>
                    <td><?php echo Numberformt($PaymentPlan["unit_transfer_fee"]);?></td>
                    <td><?php echo Numberformt($PaymentPlan["registration_fee"]);?></td>
                    <td><?php echo StatusName($PaymentPlan["isActive"]);?></td>
                    <td class="td-actions text-right">
                    <a href="<?php echo Route::_('show=ppproperties&i='.EncData($PaymentPlan["project_id"], 2, $objBF).'&fi='.EncData($PaymentPlan["floor_id"], 2, $objBF).'&pi='.EncData($PaymentPlan["floor_payment_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple"> <i class="material-icons">domain</i> </a> 
                    
                    <a href="<?php echo Route::_('show=pppropertyform&i='.EncData($PaymentPlan["project_id"], 2, $objBF).'&fi='.EncData($PaymentPlan["floor_id"], 2, $objBF).'&pi='.EncData($PaymentPlan["floor_payment_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple"> <i class="material-icons">edit</i> </a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else { 
			$objQayadProerty->setProperty("floor_payment_id", trim(DecData($_GET["pi"], 1, $objBF)));
			$objQayadProerty->lstFloorPaymentDetail();
			$PPaymentDetail = $objQayadProerty->dbFetchArray(1);
			?>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=pppropertyform&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&fi='.EncData(trim(DecData($_GET["fi"], 1, $objBF)), 2, $objBF));?>" class="btn btn-primary">Edit</a> <a href="<?php echo Route::_('show=ppproperties&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF).'&fi='.EncData(trim(DecData($_GET["fi"], 1, $objBF)), 2, $objBF));?>" class="btn btn-primary back">Back</a> </div>
            <div class="table-responsive">
              <table class="table" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td class="text-primary">Rent SQ/FT</td>
                    <td><?php echo Numberformt($PPaymentDetail["rate_per_sq_ft"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Payback Cutting Mode</td>
                    <td><?php echo PayBackCuttingMode($PPaymentDetail["payback_cutting"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Payback Value</td>
                    <td><?php echo $PPaymentDetail["pb_cutting_value"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Ownership Transfer Fee</td>
                    <td><?php echo Numberformt($PPaymentDetail["unit_transfer_fee"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Plan Status</td>
                    <td><?php echo StatusName($PPaymentDetail["isActive"]);?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <?php } ?>
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