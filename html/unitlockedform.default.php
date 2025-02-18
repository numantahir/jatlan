<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php if(trim(DecData($_GET["stage"], 1, $objBF)) == ''){?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="stage" value="<?php echo EncData('1', 1, $objBF);?>">

            <input type="hidden" name="st" value="<?php echo trim(DecData($_GET["st"], 1, $objBF));?>">
            <input type="hidden" name="tli" value="<?php echo trim(DecData($_GET["i"], 1, $objBF));?>">
            
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Unit Locked From';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Property Type </label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" name="property_registered_id" id="property_registered_id" title="Choose Property Type" required tabindex="1">
                    <option value="" disabled>Select Property Type</option>
                    <?php echo ProjectTypeOptionList($property_registered_id);?>
                  </select>
                    </div>
                  </div>
                </div>
                <div class="row row_property_floor">
                  <label class="col-sm-2 label-on-left">Floor Selection</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating floor-selection">
                      <?php
                    $objQayadProerty->setProperty("ORDERBY", 'propety_floor_id');
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
                    $objQayadProerty->lstPropertyFloorPlan();
                    while($FloorListTitle = $objQayadProerty->dbFetchArray(1)){
                    ?>
                      <div class="radio col-sm-3 propertyfloor floor-num-<?php echo $FloorListTitle["project_type_id"];?>">
                        <label>
                          <input type="radio" class="login_required psro GetPropertySection" name="floor_number"<?php echo StaticRadioChecked($FloorListTitle["propety_floor_id"],$propety_floor_id); ?> required value="<?php echo $FloorListTitle["propety_floor_id"];?>" id="<?php echo $FloorListTitle["propety_floor_id"] . '-' . $FloorListTitle["project_id"];?>">
                          <?php echo $FloorListTitle["floor_name"];?> </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="row row_property_section">
                  <label class="col-sm-2 label-on-left">Property Section</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <?php
					$objQayadProerty->resetProperty();
                    $objQayadProerty->setProperty("ORDERBY", 'property_type_id');
					$objQayadProerty->setProperty("project_id", $CurrentPorjectId);
                    $objQayadProerty->lstPropertyType();
                    while($SectionListTitle = $objQayadProerty->dbFetchArray(1)){
                    ?>
                      <div class="radio col-sm-3 propertysection sectionradio-<?php echo $SectionListTitle["propety_floor_id"].'-'.$SectionListTitle["project_id"];?>">
                        <label>
                          <input type="radio" class="login_required psro" name="property_type_id"<?php echo StaticRadioChecked($SectionListTitle["property_type_id"],$property_type_id); ?> required value="<?php echo $SectionListTitle["property_type_id"];?>">
                          <?php echo $SectionListTitle["property_section"].' <small>'.$SectionListTitle["property_area"].'/sq/ft</small>';?> </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="5">Next</button>
              <button type="reset" class="btn btn-fill" tabindex="6">Reset</button>
            </div>
          </form>
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 2){ 
		  	
			/*if(trim(DecData($_GET["st"], 1, $objBF)) == 'ad' && trim(DecData($_GET["tli"], 1, $objBF)) != ''){
			$objQayadProerty->resetProperty();
			$objQayadProerty->setProperty("temp_lock_id", trim(DecData($_GET["tli"], 1, $objBF)));
			$objQayadProerty->VwLockedPropertyDetail();
			$OldLockedPropertyDetail = $objQayadProerty->dbFetchArray(1);
				$AdjustmentLinkPass = '&st='.EncData('ad', 2, $objBF).'&tli='.EncData(trim(DecData($_GET["tli"], 1, $objBF)), 2, $objBF);
			}*/
		  ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="stage" value="<?php echo EncData('1', 1, $objBF);?>">
            
            <input type="hidden" name="st" value="<?php echo trim(DecData($_GET["st"], 1, $objBF));?>">
            <input type="hidden" name="tli" value="<?php echo trim(DecData($_GET["tli"], 1, $objBF));?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Property Locked From';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=newappreg');?>" class="btn btn-primary">Back</a> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <div class="col-sm-12 text-center">
                    <h4 class="card-title"><?php echo RegisterProject($pri).' -> '.$FloorNumber['floor_name'].' -> '.$PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft]';?></h4>
                  </div>
                  <?php
			$objQayadProertyPaymentPlan 	= new Qayadproperty;
			$objQayadLockedProperty 	= new Qayadproperty;
            $objQayadProerty->setProperty("property_registered_id", $pri);
			$objQayadProerty->setProperty("isActive", 1);
			$objQayadProerty->setProperty("property_type_id", $pti);
			$objQayadProerty->setProperty("propety_floor_id", $fn);
            $objQayadProerty->lstProperties();
			if($objQayadProerty->totalRecords() > 0){
            while($PropertyDetail = $objQayadProerty->dbFetchArray(1)){
				
				$objQayadProertyPaymentPlan->setProperty("floor_id", $PropertyDetail["propety_floor_id"]);
				$objQayadProertyPaymentPlan->setProperty("isActive", 1);
				$objQayadProertyPaymentPlan->lstFloorPaymentDetail();
				$PropertyPaymentPlan = $objQayadProertyPaymentPlan->dbFetchArray(1);
            ?>
                  <div class="col-sm-6 col-lg-3 ExtraHeight">
                    <div class="card">
                      <div class="card-content text-center"> <i class="material-icons">domain</i>
                        <h3><?php echo $PropertyDetail["property_number"];?></h3>
                        <code>Area:<?php echo $PropertyDetail["property_area"];?>Sq-Ft</code> <code>Cost:<?php echo Numberformt($PropertyPaymentPlan["rate_per_sq_ft"]);?>/sq/ft</code><br>
                        <code>No. of 20-Sq/Ft Units: <?php echo $PropertyDetail["share_20"];?></code><br><code>No. of 10-Sq/Ft Units: <?php echo $PropertyDetail["share_10"];?></code><br><code>No. of 5-Sq/Ft Units: <?php echo $PropertyDetail["share_5"];?></code><br>
                        
                        <code>Total No. of Units: <?php echo $PropertyDetail["share_20"] + $PropertyDetail["share_10"] + $PropertyDetail["share_5"];?></code><br />
                        <code>Available No. of Units: <?php $TotalNumberofUnits = $PropertyDetail["share_20"] + $PropertyDetail["share_10"] + $PropertyDetail["share_5"];
						$TotalAvailableUnits = $TotalNumberofUnits - $PropertyDetail["no_of_sold_shares"];
						echo $TotalAvailableUnits;
						?></code>
           <br />             
                        <code>Sold No. of Units: <?php echo $PropertyDetail["no_of_sold_shares"]; ?></code>
                        <?php if($TotalAvailableUnits >0){?>
                        <a href="<?php echo Route::_('show=unitlockedform&stage='.EncData('2.5', 2, $objBF).'&bl='.EncData($Getbbl, 2, $objBF).'&pi='.EncData($PropertyDetail["property_id"], 2, $objBF).$AdjustmentLinkPass);?>" class="btn btn-rose btn-fill">View Units</a>
                        <?php } else { ?>
                        <a href="#" class="btn btn-rose btn-fill"> Sold </a>
						<?php } ?>
                        </div>
                    </div>
                  </div>
                  <?php }  } else {?>
                  <div class="col-sm-12">
                    <div class="card">
                      <div class="card-content text-center"> <code>Oops! Sorry No <?php echo $PropertyTypeDetail["property_section"].'['.$PropertyTypeDetail["property_area"].']';?> Available</code> </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </form>
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 2.5){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="stage" value="<?php echo EncData('1', 1, $objBF);?>">
            
            <input type="hidden" name="st" value="<?php echo trim(DecData($_GET["st"], 1, $objBF));?>">
            <input type="hidden" name="tli" value="<?php echo trim(DecData($_GET["tli"], 1, $objBF));?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Unit > '.RegisterProject($pri).' > '.$FloorNumber['floor_name'].' > '.$PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft] '.' > Property#'.$SelectivePropertyDetail["property_number"] . ' > ' . Numberformt_second($SelectiveFloorPriceDetail["rate_per_sq_ft"]).'-Sq/Ft';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=newappreg');?>" class="btn btn-primary">Back</a> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <div class="material-datatables"><br />
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Unit#</th>
                    <th>Size Sq-Ft</th>
                    <th>Price</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				$objQayadProerty->setProperty("ORDERBY", "property_share_id");
				$objQayadProerty->setProperty("property_share_status", 1);
				$objQayadProerty->setProperty("isActive", 1);
				$objQayadProerty->setProperty("property_id", trim(DecData($_GET["pi"], 1, $objBF)));
                $objQayadProerty->lstPropertyShares();
                while($PropertyUnitsList = $objQayadProerty->dbFetchArray(1)){
					$UnitPricePerSize = $SelectiveFloorPriceDetail["rate_per_sq_ft"] * $PropertyUnitsList["share_unit_size"];
				?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=unitlockedform&stage='.EncData('3', 2, $objBF).'&bl='.EncData($Getbbl, 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&ui='.EncData($PropertyUnitsList["property_share_id"], 2, $objBF));?>"><?php echo $PropertyUnitsList["property_share_number"];?></a></td>
                    <td><?php echo $PropertyUnitsList["share_unit_size"];?> Sq-Ft</td>
                    <td><?php echo Numberformt($UnitPricePerSize);?></td>
                    <td><?php echo PropertyStatus($PropertyUnitsList["property_share_status"]);?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
		          </div>
                </div>
              </div>
            </div>
          </form>
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 3 && trim(DecData($_GET["ui"], 1, $objBF)) != ''){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="stage" value="<?php echo EncData(trim(DecData($_GET["stage"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="bl" value="<?php echo EncData(trim(DecData($_GET["bl"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="pi" value="<?php echo EncData(trim(DecData($_GET["pi"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="ui" value="<?php echo EncData(trim(DecData($_GET["ui"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="customer_old_id" value="<?php echo $customer_old_id;?>">
            <input type="hidden" name="customer_mode" value="<?php echo $customer_mode;?>">
            
            <input type="hidden" name="st" value="<?php echo trim(DecData($_GET["st"], 1, $objBF));?>">
            <input type="hidden" name="tli" value="<?php echo trim(DecData($_GET["tli"], 1, $objBF));?>">
            <input type="hidden" name="adc" value="<?php echo $AdjustmentCode;?>">
            
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Property Locked From';?></h4>
            </div>
            <div class="toolbar btn-back text-right">
              <h4 class="card-title"><?php echo RegisterProject($pri).' -> '.$FloorNumber['floor_name'].' -> '.$PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft]'. ' > <b>' .$SelectiveUnitDetail["property_share_number"].'</b>';?></h4>
            </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <div class="col-sm-9">
                    <h4 class="card-title">Personal Information</h4>
                    
                  </div>
                  <div class="col-sm-3"> <a href="#" data-toggle="modal" data-target="#cnicpopup"><i class="material-icons">people</i> Existing Customer</a> </div>
                  <hr>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_fname');?>">
                      <label class="label-control">Applicant First Name:</label>
                      <input class="form-control" type="text" name="customer_fname" required value="<?php echo $customer_fname;?>" tabindex="1"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_fname"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_lname');?>">
                      <label class="label-control">Applicant Last Name:</label>
                      <input class="form-control" type="text" name="customer_lname" required value="<?php echo $customer_lname;?>" tabindex="2"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_lname"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_father');?>">
                      <label class="label-control">S/O, D/O, W/O:</label>
                      <input class="form-control" type="text" name="customer_father" required value="<?php echo $customer_father;?>" tabindex="3"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_father"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_cnic');?>" id="cnic_div">
                      <label class="label-control">CNIC:</label>
                      <input class="form-control" type="number" id="customer_cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXXXXXXXXXX" name="customer_cnic" required value="<?php echo $customer_cnic;?>" data-maxlength="13" tabindex="4"<?php echo $ReadOnlyApply.$EXC_ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_cnic"];?><error id="cnic_error_msg" style="color:#900;"></error></small>
                      <label class="label-control"><small>Note: Write CNIC Number without DASH ( - )</small></label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_email');?>">
                      <label class="label-control">Email Address:</label>
                      <input class="form-control" type="email" name="customer_email" required value="<?php echo $customer_email;?>" tabindex="6"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_email"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_c_address');?>">
                      <label class="label-control">Mailing Address:</label>
                      <input class="form-control" type="text" name="customer_c_address" required value="<?php echo $customer_c_address;?>" tabindex="7"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_c_address"];?></small> </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_p_address');?>">
                      <label class="label-control">Permanent Address:</label>
                      <input class="form-control" type="text" name="customer_p_address" required value="<?php echo $customer_p_address;?>" tabindex="8"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_p_address"];?></small> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_phone');?>">
                      <label class="label-control">Phone No Res:</label>
                      <input class="form-control" type="number" name="customer_phone" required value="<?php echo $customer_phone;?>" tabindex="9"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_phone"];?></small> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_mobile');?>">
                      <label class="label-control">Mobile No:</label>
                      <input class="form-control" type="number" name="customer_mobile" required value="<?php echo $customer_mobile;?>" tabindex="10"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_mobile"];?></small> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_mobile_2');?>">
                      <label class="label-control">Mobile 2 No:</label>
                      <input class="form-control" type="number" name="customer_mobile_2" value="<?php echo $customer_phone;?>" tabindex="11"<?php echo $ReadOnlyApply;?> />
                      <small><?php echo $vResult["customer_mobile_2"];?></small> </div>
                  </div>
                  
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'received_amount');?>">
                      <label class="label-control">Token Amount:</label>
                      <input class="form-control" type="number" name="received_amount" value="<?php echo $received_amount;?>" onkeyup="word.innerHTML=convertNumberToWords(this.value)" tabindex="13"<?php echo $ReadOnlyApply;?> tabindex="12" />
                      <small><?php echo $vResult["received_amount"];?></small> <label><small id="word"></small></label> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="label-control">Lock Duration:</label>
                      <select class="selectpicker" data-style="select-with-transition" name="till_lock_duration" title="Select Lock Duration" required tabindex="13">
                        <option disabled>Select Lock Duration</option>
                        <option value="1"> 1 Day => <?php echo date('d-m-Y', strtotime(date("Y-m-d"). ' + 1 days')); ?></option>
                        <option value="2"> 2 Days => <?php echo date('d-m-Y', strtotime(date("Y-m-d"). ' + 2 days')); ?></option>
                        <option value="3"> 3 Days => <?php echo date('d-m-Y', strtotime(date("Y-m-d"). ' + 3 days')); ?></option>
                        <option value="4"> 4 Days => <?php echo date('d-m-Y', strtotime(date("Y-m-d"). ' + 4 days')); ?></option>
                        <option value="5"> 5 Days => <?php echo date('d-m-Y', strtotime(date("Y-m-d"). ' + 5 days')); ?></option>
                        <option value="6"> 6 Days => <?php echo date('d-m-Y', strtotime(date("Y-m-d"). ' + 6 days')); ?></option>
                        <option value="7"> 7 Days => <?php echo date('d-m-Y', strtotime(date("Y-m-d"). ' + 7 days')); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill" tabindex="14">Next</button>
                <button type="reset" class="btn btn-fill" tabindex="15">Reset</button>
              </div>
            </div>
          </form>
          
          <div class="modal fade" id="cnicpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                  <h5 class="modal-title" id="myModalLabel"><i class="material-icons">lock</i> Fetch Customer Info</h5>
                </div>
                <div class="modal-body">
                  <div class="instruction">
                    <div class="row">
                      <div class="col-md-12">
                        <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="typemode" value="searchcnic">
                          <input type="hidden" name="stage" value="6">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label class="label-control">Customer CNIC Number:</label>
                              <input class="form-control customer_old_cnic" type="number" name="customer_old_cnic" required value="" tabindex="1" />
                            </div>
                          </div>
                          <div class="card-footer text-center col-md-12">
                            <button type="submit" class="btn btn-rose btn-fill" tabindex="2">Search</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
