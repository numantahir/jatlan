<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php if($_GET["li"]==''){?>
        <h3 class="card-title CardWidth">Locked Units Detail</h3>
        
        <div class="toolbar add-btn text-right mt-50px"> 
        <?php if($objCheckLogin->user_type != 3){ ?>
        <a href="<?php echo Route::_('show=unitlockedform');?>" class="btn btn-primary">Make New Locked</a>
        <?php } ?>
         </div>
        <?php } else { ?>
        <h3 class="card-title CardWidth">Locked Units Detail</h3>
        <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=unitslocked');?>" class="btn btn-primary">Back</a> </div>
        <?php } ?>
        <div class="card">
          <div class="card-content">
            <?php if($_GET["li"]==''){?>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Unit #</th>
                    <th>Property Detail</th>
                    <th>Till Locked</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $objQayadProerty->resetProperty();
					$objQayadProertyInfo = new Qayadproperty;
					if($objCheckLogin->user_type != 1 && $objCheckLogin->user_type != 2 && $objCheckLogin->user_type != 3){
					$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					}
					if($objCheckLogin->user_type == 3){
					$objQayadProerty->setProperty("lock_status_array", '1,5,6,7');
					}
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
                    $objQayadProerty->setProperty("ORDERBY", 'temp_lock_id DESC');
                    $objQayadProerty->lstPropertyUnitDetail();
                    while($LockedList = $objQayadProerty->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=unitslocked&li='.EncData($LockedList["temp_lock_id"], 1, $objBF));?>"><?php echo $LockedList["property_share_number"];?></a></td>
                    <td><?php echo $objQayadProertyInfo->PropertyInfo($LockedList["property_id"]);?></td>
                    <td><?php echo dateFormate_3($LockedList["till_lock_duration"]);?></td>
                    <td><?php echo TempLockedStatus($LockedList["lock_status"]);?></td>
                    <td class="td-actions text-right"><?php if($LockedList["lock_status"]==1 && trim(DecData($objQayaduser->user_id, 1, $objBF)) == $LockedList["user_id"]){?>
                      <a href="
					<?php echo Route::_('show=unitslocked&mode=c&st='.EncData('in', 2, $objBF).'&i='.EncData($LockedList["temp_lock_id"], 2, $objBF) .'&psi='.EncData($LockedList["property_share_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple"> UnLocked </a>
                      <?php /* } elseif($LockedList["lock_status"]==1 && $objCheckLogin->user_type == 3){?>
                      <a href="
					<?php echo Route::_('show=propertylocked&mode=c&st='.EncData('ad', 2, $objBF).'&i='.EncData($LockedList["temp_lock_id"], 2, $objBF) .'&pi='.EncData($LockedList["property_id"], 1, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple"> UnLocked + Adjustment</a>
                      <?php } elseif($LockedList["lock_status"]==6 && trim(DecData($objQayaduser->user_id, 1, $objBF)) == $LockedList["user_id"]){?>
                      <a href="
					<?php echo Route::_('show=unitslockedform&st='.EncData('ad', 2, $objBF).'&i='.EncData($LockedList["temp_lock_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple"> Adjustment Now </a>
                      <?php */ } else {  ?>
                      By <?php echo $objQayaduser->GetUserFullName($LockedList["user_id"]); ?>
                      <?php } ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else { 			
			$objQayadProerty->setProperty("temp_lock_id", trim(DecData($_GET["li"], 1, $objBF)));
			$objQayadProerty->lstPropertyUnitDetail();
			$LockedPrpertyDetail = $objQayadProerty->dbFetchArray(1);
			
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
                    <td class="text-primary label-type">Property Section</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["property_section"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Floor Number:</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["floor_name"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property/Shop/Room Number:</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["property_number"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Area</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["property_area"];?> sq/ft</td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Lock Date:</td>
                    <td class="value"><?php echo dateFormate_4($LockedPrpertyDetail["entery_date"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Lock Till:</td>
                    <td class="value"><?php echo dateFormate_4($LockedPrpertyDetail["till_lock_duration"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Customer Name:</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["customer_fname"] . ' ' . $LockedPrpertyDetail["customer_lname"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Customer Mobile #</td>
                    <td class="value"><?php echo $LockedPrpertyDetail["customer_mobile"];?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><h5 class="card-title CardWidth">Register Lock Property User Detail</h5></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">First Name</td>
                    <td class="value"><?php echo $LockedUserDetail["user_fname"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Last Name</td>
                    <td class="value"><?php echo $LockedUserDetail["user_lname"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Mobile #</td>
                    <td class="value"><?php echo $LockedUserDetail["user_mobile"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">User Type</td>
                    <td class="value"><?php echo UserType($LockedUserDetail["user_type_id"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">User Designation</td>
                    <td class="value"><?php echo $LockedUserDetail["user_designation"];?></td>
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
