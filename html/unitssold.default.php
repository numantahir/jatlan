<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php if($_GET["li"]==''){?>
        <h3 class="card-title CardWidth">Sold Units List</h3>
        <div class="toolbar add-btn text-right mt-50px">  </div>
        <?php } else { ?>
        <h3 class="card-title CardWidth">Sold Unit Detail</h3>
        <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=unitssold');?>" class="btn btn-primary">Back</a> </div>
        <?php } ?>
        <div class="card">
          <div class="card-content">
            <?php if($_GET["li"]==''){?>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Unit#</th>
                    <th>Unit Size</th>
                    <th>Property Detail</th>
                    <th>Customer</th>
                    <th>Buying Value</th>
                    <th>Register From</th>
                    <th>Agent</th>
                    <th>Reg-Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $objQayadProertyInfo = new Qayadproperty;
					$objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("property_share_status", 2);
					$objQayadapplication->setProperty("project_id", $CurrentPorjectId);
                    $objQayadapplication->setProperty("ORDERBY", 'entery_datetime DESC');
                    $objQayadapplication->lstAplicCompleteSoldDetail();
                    while($SoldList = $objQayadapplication->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=unitssold&li='.EncData($SoldList["property_share_id"], 2, $objBF));?>"><?php echo $SoldList["property_share_number"];?></a></td>
                    <td><?php echo $SoldList["share_unit_size"];?> Sq-Ft</td>
                    <td><?php echo $objQayadProertyInfo->PropertyInfo($SoldList["property_id"]);?></td>
                    <td><?php echo $SoldList["customer_fullname"];?></td>
                    <td><?php echo Numberformt($SoldList["amount_deposit"]);?></td>
                    <td><?php echo ApplicBookingFrom($SoldList["aplic_reg_type"]);?></td>
                    <td><?php echo $objQayaduser->GetUserFullName($SoldList["user_id"]); ?></td>
                    <td><?php echo dateFormate_4($SoldList["aplic_date"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else {
			$objQayadProertyInfo = new Qayadproperty;
			$objQayadapplication->setProperty("property_share_id", trim(DecData($_GET["li"], 1, $objBF)));
			$objQayadapplication->lstAplicCompleteSoldDetail();
			$LockedPrpertyDetail = $objQayadapplication->dbFetchArray(1);
			
			$objQayaduser->resetProperty();
			$objQayaduser->setProperty("user_id", $LockedPrpertyDetail["user_id"]);
			$objQayaduser->lstUsers();
			$LockedUserDetail = $objQayaduser->dbFetchArray(1);
			?>
            <div class="table-responsive">
              <table class="table" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td class="text-primary label-type">Unit #</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["property_share_number"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Detail</td>
                    <td class="value"><?php echo $objQayadProertyInfo->PropertyInfo($LockedPrpertyDetail["property_id"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Area</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["share_unit_size"];?> sq/ft</td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Book Date:</td>
                    <td class="value"><?php echo dateFormate_4($LockedPrpertyDetail["aplic_date"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Customer Name:</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["customer_fullname"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Customer Phone #</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["customer_phone"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Customer Mobile #</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["customer_mobile"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Customer Mobile # (2)</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["customer_mobile_2"];?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><h5 class="card-title CardWidth">Register Unit User Detail</h5></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Register User Name</td>
                    <td class="value"><?php echo $objQayaduser->GetUserFullName($LockedUserDetail["user_id"]);?></td>
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
