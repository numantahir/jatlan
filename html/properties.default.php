<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?php if($_GET["i"]==''){?>
        <h3 class="card-title CardWidth">Property Management</h3>
        <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=propertyform');?>" class="btn btn-primary">Add New</a> </div>
        <?php } else { 
	  		$objQayadProerty->setProperty("property_id", trim(DecData($_GET["i"], 1, $objBF)));
			$objQayadProerty->lstProperties();
			$PropertyDetail = $objQayadProerty->dbFetchArray(1);
	  ?>
        <h3 class="card-title CardWidth">Units Management :: <span class="text-primary"><?php echo $PropertyDetail["property_section"].', '.$PropertyDetail["floor_name"].', '.$PropertyDetail["property_number"];?></span></h3>
        <?php } ?>
        <div class="card">
          <div class="card-content">
            <?php if($_GET["i"]==''){?>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Property #</th>
                    <th>Floor #</th>
                    <th>Section</th>
                    <th>Area (sq-ft)</th>
                    <th>No.of/U (20)</th>
                    <th>No.of/U (10)</th>
                    <th>No.of/U (5)</th>
                    <th>Type</th>
                    <th>Available/Sold</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					$objQayadProerty->setProperty("isNot", 3);
					//$objQayadProerty->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
					$objQayadProerty->setProperty("ORDERBY", 'property_id');
					$objQayadProerty->lstProperties();
					while($ListOfProperties = $objQayadProerty->dbFetchArray(1)){
				?>
                  <tr>
                    <td><a rel="tooltip" title="<?php echo $ListOfProperties["property_number"];?> Detail Info" href="<?php echo Route::_('show=properties&i='.EncData($ListOfProperties["property_id"], 2, $objBF));?>"><?php echo $ListOfProperties["property_number"];?></a></td>
                    <td><?php echo $ListOfProperties["floor_name"];?></td>
                    <td><?php echo $ListOfProperties["property_section"];?></td>
                    <td><?php echo $ListOfProperties["property_area"];?></td>
                    <td><?php echo $ListOfProperties["share_20"]; ?></td>
                    <td><?php echo $ListOfProperties["share_10"]; ?></td>
                    <td><?php echo $ListOfProperties["share_5"]; ?></td>
                    <td><?php echo RegisterProject($ListOfProperties["property_registered_id"]);?></td>
                    <td><?php
					$TotalNumberofUnites = $ListOfProperties["share_20"] + $ListOfProperties["share_10"] + $ListOfProperties["share_5"];
					echo $TotalNumberofUnites . '/' . $ListOfProperties["no_of_sold_shares"];
					?></td>
                    <td><?php echo StatusName($ListOfProperties["isActive"]);?></td>
                    <td class="td-actions text-right"><!--<a href="<?php //echo Route::_('show=ppgallery&i='.EncData($ListOfProperties["property_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple" title="Property Image Gallery"> <i class="material-icons">image</i> </a>--> 
                      <!--<a href="<?php //echo Route::_('show=ppproperties&i='.EncData($ListOfProperties["property_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple" title="Property Payment Plan Detail"> <i class="material-icons">payment</i> </a>--> 
                      <?php if($ListOfProperties["isActive"] == 1){?>
                      <a href="<?php echo Route::_('show=properties&mode='.EncData("ChangeStatus", 2, $objBF).'&pu='.EncData("DownAll", 2, $objBF).'&pi='.EncData($ListOfProperties["property_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-default btn-simple" title="InActive This Property (<?php echo $ListOfProperties["property_number"];?>)"> <i class="material-icons">remove</i> </a>
                      <?php } else { ?>
                      <a href="<?php echo Route::_('show=properties&mode='.EncData("ChangeStatus", 2, $objBF).'&pu='.EncData("ActiveAll", 2, $objBF).'&pi='.EncData($ListOfProperties["property_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-info btn-simple" title="Active This Property (<?php echo $ListOfProperties["property_number"];?>)"> <i class="material-icons">done</i> </a>
                      <?php } ?>
                      
                      <a href="<?php echo Route::_('show=propertyform&i='.EncData($ListOfProperties["property_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit" title="Edit Property Detail info"> <i class="material-icons">edit</i> </a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else {
				//echo $PropertyDetail["propety_floor_id"];
				//die();
			$objQayadProerty->resetProperty();
			$objQayadProerty->setProperty("floor_id", $PropertyDetail["propety_floor_id"]);
			$objQayadProerty->setProperty("isActive", 1);
			$objQayadProerty->lstFloorPaymentDetail();
			$FloorPriceDetail = $objQayadProerty->dbFetchArray(1);
			?>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=propertyform&i='.$_GET["i"]);?>" class="btn btn-primary">Edit</a> </div>
            <div class="material-datatables">
              <table class="table" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td class="text-primary label-type">Project:</td>
                    <td class="value"><?php echo $objQayadProerty->ProjectName($PropertyDetail["project_id"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Section:</td>
                    <td class="value"><?php echo $PropertyDetail["property_section"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Floor Number:</td>
                    <td class="value"><?php echo $PropertyDetail["floor_name"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property/Shop/Room Number:</td>
                    <td class="value"><?php echo $PropertyDetail["property_number"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Area:</td>
                    <td class="value"><?php echo $PropertyDetail["property_area"];?> sq/ft</td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Status:</td>
                    <td class="value"><?php echo PropertyStatus($PropertyDetail["property_status"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Lock Duration:</td>
                    <td class="value"><?php echo $PropertyDetail["book_duration"];?> Day's</td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Property Descriotion:</td>
                    <td class="value"><?php echo $PropertyDetail["property_desc"];?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr style="margin-bottom:0px; margin-top:0px;" /></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Floor Price:</td>
                    <td class="value"><?php echo Numberformt_second($FloorPriceDetail["rate_per_sq_ft"]);?>/Sq-Ft</td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Pay Back As/Cutting:</td>
                    <td class="value"><?php echo PayBackCuttingMode($FloorPriceDetail["payback_cutting"]).'/'.$FloorPriceDetail["pb_cutting_value"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Transfer Fees:</td>
                    <td class="value"><?php echo Numberformt($FloorPriceDetail["unit_transfer_fee"]);?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                        <thead>
                          <tr>
                            <th>Unit Size</th>
                            <th>Unit No.</th>
                            <th>Unit Price</th>
                            <th>Unit Status</th>
                            <th>Unit Lock Days</th>
                            <th>Unit Lock Till</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
					$objQayadProerty->resetProperty();
					$objQayadProerty->setProperty("property_id", trim(DecData($_GET["i"], 1, $objBF)));
					//$objQayadProerty->setProperty("property_floor_id", $PropertyDetail["propety_floor_id"]);
					//$objQayadProerty->setProperty("project_type_id", $PropertyDetail["project_type_id"]);
					//$objQayadProerty->setProperty("isActive", 1);
					$objQayadProerty->setProperty("ORDERBY", "share_unit_size DESC");
					$objQayadProerty->lstPropertyShares();
					while($ListOfShares = $objQayadProerty->dbFetchArray(1)){
						if($ListOfShares["share_unit_size"] == 5){
						$UnitSizeModify = '05';
						} else {
						$UnitSizeModify = $ListOfShares["share_unit_size"];
						}
				  ?>
                          <tr>
                            <td class="value"><?php echo $UnitSizeModify;?> SqFt</td>
                            <td class="value"><?php echo $ListOfShares["property_share_number"];?></td>
                            <td class="value"><?php echo Numberformt($FloorPriceDetail["rate_per_sq_ft"] * $ListOfShares["share_unit_size"]); ?></td>
                            <td class="value"><?php echo PropertyStatus($ListOfShares["property_share_status"]);?></td>
                            <td class="value"><?php echo checkvalue($ListOfShares["property_lock_days"], 2);?></td>
                            <td class="value"><?php echo checkvalue($ListOfShares["property_lock_till_date"], 2);?></td>
                            <td class="value"><?php echo StatusName($ListOfShares["isActive"]);?></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table></td>
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
