<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php if(trim(DecData($_GET["stage"], 1, $objBF)) == ''){?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="stage" value="<?php echo EncData('1', 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Registration Application From';?></h4>
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
                <div class="row row_property_floor" style="display:none;">
                  <label class="col-sm-2 label-on-left">Floor Selection</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
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
                <div class="row row_property_section" style="display:none;">
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
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 2){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="stage" value="<?php echo EncData('1', 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Registration Application From';?></h4>
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
            $objQayadProerty->setProperty("isActive", 1);
			$objQayadProerty->setProperty("property_registered_id", $pri);
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
                        <?php if($PropertyPaymentPlan["rate_per_sq_ft"] !=''){?>
                        <a href="<?php echo Route::_('show=newappreg&stage='.EncData('2.5', 2, $objBF).'&bl='.EncData($Getbbl, 2, $objBF).'&pi='.EncData($PropertyDetail["property_id"], 2, $objBF).$AdjustmentLinkPass);?>" class="btn btn-rose btn-fill">View Units</a>
                        <?php } else { ?>
                        <a href="javascript:alert('Oopsss!\nSorry we cant offer this at the moment...');" class="btn btn-default btn-fill"> Unit Price Not Set </a>
						<?php } } else { ?>
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
              <h4 class="card-title"><?php echo 'Unit > '. $FloorNumber['floor_name'] . ' > ' . $PropertyTypeDetail["property_section"] . ' [' . $PropertyTypeDetail["property_area"].'/sq-ft] ' . ' > Property#' . $GetPropertyNumber . ' > ' . Numberformt_second($CurrentUnitPrice) . '-Sq/Ft';?></h4>
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
					$UnitPricePerSize = $CurrentUnitPrice * $PropertyUnitsList["share_unit_size"];
				?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=newappreg&stage='.EncData('3', 2, $objBF).'&bl='.EncData($Getbbl, 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&ui='.EncData($PropertyUnitsList["property_share_id"], 2, $objBF));?>"><?php echo $PropertyUnitsList["property_share_number"];?></a></td>
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
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 3){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="stage" value="<?php echo EncData(trim(DecData($_GET["stage"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="bl" value="<?php echo EncData(trim(DecData($_GET["bl"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="pi" value="<?php echo EncData(trim(DecData($_GET["pi"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="ui" value="<?php echo EncData(trim(DecData($_GET["ui"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="lkc" value="<?php echo $CountLockRecord;?>">
            <input type="hidden" name="lk" value="<?php echo EncData($GetLockedDuration["temp_lock_id"], 1, $objBF);?>">
            <input type="hidden" name="declaration_status" value="1">
            <input type="hidden" name="customer_mode" value="<?php echo $customer_mode;?>">
            <input type="hidden" name="customer_old_id" value="<?php echo $customer_old_id;?>">
            <input type="hidden" name="customer_nominee_mode" value="<?php echo $customer_nominee_mode;?>">
            <input type="hidden" name="customer_nominee_old_id" value="<?php echo $FetchNomineeInfo["customer_id"];?>">
            <input type="hidden" name="registration_type" value="1" />
            <input type="hidden" name="payment_mode" value="2">
            <?php if($objCheckLogin->user_type == 4){?>
            <input type="hidden" name="aplic_reg_type" value="2">
            <?php } else { ?>
            <input type="hidden" name="aplic_reg_type" value="1">
            <?php } ?>
            
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Registration Application From';?></h4>
            </div>
            <div class="toolbar btn-back text-right">
              <h4 class="card-title"><?php echo RegisterProject($pri).' -> '.$FloorNumber['floor_name'].' -> '.$PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft]';?></h4>
            </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  
                  <?php if($CountLockRecord == 0 && $GetLockedDuration["temp_lock_id"]==''){ ?>
                  <div class="col-sm-12 text-right"> <a href="#" data-toggle="modal" data-target="#cnicpopup"><i class="material-icons">people</i> Existing Customer</a> </div>
                  <?php } ?>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <h4 class="card-title">Personal Information</h4>
                    <hr>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_fname');?>">
                      <label class="label-control">Applicant First Name:</label>
                      <input class="form-control" type="text" name="customer_fname" required value="<?php echo $customer_fname;?>"<?php if($CountLockRecord == 1){ echo ' readonly';} else {echo '';}?> tabindex="2"<?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_fname"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_lname');?>">
                      <label class="label-control">Applicant Last Name:</label>
                      <input class="form-control" type="text" name="customer_lname" required value="<?php echo $customer_lname;?>" tabindex="3"<?php if($CountLockRecord == 1){ echo ' readonly';} else {echo '';}?><?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_lname"];?></small> </div>
                  </div>
                  <div class="col-sm-6" style="border-bottom: 1px solid #D2D2D2;">
                    <label class="label-control">S/O, D/O, W/O:</label>
                    <div class="form-group label-floating">
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="customer_of"<?php if($customer_of!=''){ echo StaticRadioChecked(1, $customer_of); } else { echo ' checked'; } ?> required value="1" tabindex="4">
                          Son of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="customer_of"<?php echo StaticRadioChecked(2, $customer_of);?> required value="2" tabindex="4">
                          Wife of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="customer_of"<?php echo StaticRadioChecked(3, $customer_of);?> required value="3" tabindex="4">
                          Daughter of </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_father');?>">
                      <label class="label-control">Name of (S/O, D/O, W/O):</label>
                      <input class="form-control" type="text" name="customer_father" required value="<?php echo $customer_father;?>" tabindex="5"<?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_father"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_cnic');?>" id="cnic_div">
                      <label class="label-control">CNIC:</label>
                      <input class="form-control" type="number" id="customer_cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXXXXXXXXXX" name="customer_cnic" required value="<?php echo $customer_cnic;?>" data-maxlength="13" tabindex="6"<?php if($CountLockRecord == 1){ echo ' readonly';} else {echo '';}?><?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_cnic"];?>
                      <error id="cnic_error_msg" style="color:#900;"></error>
                      </small>
                      <label class="label-control"><small>Note: Write CNIC Number without DASH ( - )</small></label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_email');?>">
                      <label class="label-control">Email Address:</label>
                      <input class="form-control" type="email" name="customer_email" required value="<?php echo $customer_email;?>" tabindex="8"<?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_email"];?></small> </div>
                  </div>
                  <div class="col-sm-6" style="clear: both;">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_c_address');?>">
                      <label class="label-control">Mailing Address:</label>
                      <input class="form-control" type="text" name="customer_c_address" required value="<?php echo $customer_c_address;?>" tabindex="9"<?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_c_address"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_p_address');?>">
                      <label class="label-control">Permanent Address:</label>
                      <input class="form-control" type="text" name="customer_p_address" required value="<?php echo $customer_p_address;?>" tabindex="10"<?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_p_address"];?></small> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_phone');?>">
                      <label class="label-control">Phone No Res:</label>
                      <input class="form-control" type="text" name="customer_phone" required value="<?php echo $customer_phone;?>" tabindex="11"<?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_phone"];?></small> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_mobile');?>">
                      <label class="label-control">Mobile No:</label>
                      <input class="form-control" type="text" name="customer_mobile" required value="<?php echo $customer_mobile;?>" tabindex="12"<?php if($CountLockRecord == 1){ echo ' readonly';} else {echo '';}?><?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_mobile"];?></small> </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_mobile_2');?>">
                      <label class="label-control">Mobile 2 No:</label>
                      <input class="form-control" type="text" name="customer_mobile_2" value="<?php echo $customer_phone;?>" tabindex="13"<?php echo ReadOnlyField($FieldOption);?> />
                      <small><?php echo $vResult["customer_mobile_2"];?></small> </div>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-10">
                    <h4 class="card-title">Nominee Information</h4>
                  </div>
                  <?php if($customer_old_id !=''){?>
                  <?php if(trim(DecData($_GET["cnoi"], 1, $objBF)) !=''){?>
                  <div class="col-sm-2"> <a href="<?php echo Route::_('show=newappreg&rm=n&stage='.EncData(trim(DecData($_GET["stage"], 1, $objBF)), 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&coi='.EncData($customer_old_id, 2, $objBF).'&cm='.EncData($customer_mode, 2, $objBF));?>"><i class="material-icons">people</i> New Nominee</a> </div>
                  <?php } else {?>
                  <div class="col-sm-2"> <a href="#" data-toggle="modal" data-target="#nomineepopup"><i class="material-icons">people</i> Select Old Nominee</a> </div>
                  <?php } ?>
                  <?php } ?>
                  <hr>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'n_customer_fname');?>">
                      <label class="label-control">Nominee First Name:</label>
                      <input class="form-control" type="text" name="n_customer_fname" required value="<?php echo $n_customer_fname;?>" tabindex="14"<?php echo ReadOnlyField($NomineeFieldOption);?> />
                      <small><?php echo $vResult["n_customer_fname"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'n_customer_lname');?>">
                      <label class="label-control">Nominee Last Name:</label>
                      <input class="form-control" type="text" name="n_customer_lname" required value="<?php echo $n_customer_lname;?>" tabindex="15"<?php echo ReadOnlyField($NomineeFieldOption);?> />
                      <small><?php echo $vResult["n_customer_lname"];?></small> </div>
                  </div>
                  <div class="col-sm-6" style="border-bottom: 1px solid #D2D2D2;">
                    <label class="label-control">S/O, D/O, W/O:</label>
                    <div class="form-group label-floating">
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="n_customer_of"<?php if($n_customer_of!=''){ echo StaticRadioChecked(1, $n_customer_of); } else { echo ' checked'; } ?> required value="1" tabindex="16">
                          Son of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="n_customer_of"<?php echo StaticRadioChecked(2, $n_customer_of);?> required value="2" tabindex="16">
                          Wife of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="n_customer_of"<?php echo StaticRadioChecked(3, $n_customer_of);?> required value="3" tabindex="16">
                          Daughter of </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'n_customer_father');?>">
                      <label class="label-control">Name of (S/O, D/O, W/O):</label>
                      <input class="form-control" type="text" name="n_customer_father" required value="<?php echo $n_customer_father;?>" tabindex="17"<?php echo ReadOnlyField($NomineeFieldOption);?> />
                      <small><?php echo $vResult["n_customer_father"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'n_customer_cnic');?>" id="n_cnic_div">
                      <label class="label-control">CNIC:</label>
                      <input class="form-control" type="number" id="n_customer_cnic" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXXXXXXXXXX" name="n_customer_cnic" required value="<?php echo $n_customer_cnic;?>" tabindex="18"<?php echo ReadOnlyField($NomineeFieldOption);?> />
                      <small><?php echo $vResult["n_customer_cnic"];?>
                      <error id="n_cnic_error_msg" style="color:#900;"></error>
                      </small>
                      <label class="label-control"><small>Note: Write CNIC Number without DASH ( - )</small></label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'customer_email');?>">
                      <label class="label-control">Relationship with Applicant:</label>
                      <input class="form-control" type="text" name="customer_relation_name" required value="<?php echo $customer_relation_name;?>" tabindex="20"<?php echo ReadOnlyField($NomineeFieldOption);?> />
                      <small><?php echo $vResult["customer_relation_name"];?></small> </div>
                  </div>
                  <div class="col-sm-12" style="clear: both;">
                    <div class="form-group <?php echo is_form_error($vResult,'n_customer_c_address');?>">
                      <label class="label-control">Mailing Address:</label>
                      <input class="form-control" type="text" name="n_customer_c_address" required value="<?php echo $n_customer_c_address;?>" tabindex="21"<?php echo ReadOnlyField($NomineeFieldOption);?> />
                      <small><?php echo $vResult["n_customer_c_address"];?></small> </div>
                  </div>
                </div>
                <hr>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="label-control">Note/Other Info:</label>
                    <textarea class="form-control" name="aplic_desc" tabindex="22" /> <?php echo $aplic_desc;?></textarea>
                  </div>
                </div>
                
                
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill" tabindex="24">Next</button>
                <button type="reset" class="btn btn-fill" tabindex="25">Reset</button>
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
                          <input type="hidden" name="stage" value="<?php echo EncData('6', 1, $objBF);?>">
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
          <div class="modal fade" id="nomineepopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                  <h5 class="modal-title" id="myModalLabel"><i class="material-icons">lock</i> Fetch Customer Info</h5>
                </div>
                <div class="modal-body">
                  <div class="instruction">
                    <div class="row">
                      <div class="material-datatables" id="old_nominee_list">
                        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                          <thead>
                            <tr>
                              <th>Full Name -1</th>
                              <th>CNIC</th>
                              <th>Mobile #</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $objQayadapplication->resetProperty();
                                $objQayadapplicationCustomer = new Qayadapplication;
                                $objQayadapplication->setProperty("ORDERBY", 'aplic_id');
                                $objQayadapplication->setProperty("GROUPBY", 'nominee_id');
								$objQayadapplication->setProperty("customer_id", $customer_old_id);
                                $objQayadapplication->lstApplication();
                                while($ListApplic = $objQayadapplication->dbFetchArray(1)){
                                    $objQayadapplicationCustomer->setProperty("customer_id", $ListApplic["nominee_id"]);
                                    $objQayadapplicationCustomer->lstApplicationCustomer();
                                    while($ListAppliCustomer = $objQayadapplicationCustomer->dbFetchArray(1)){
                                ?>
                            <tr>
                              <td><?php echo $ListAppliCustomer["fullname"];?></td>
                              <td><?php echo $ListAppliCustomer["customer_cnic"];?></td>
                              <td><?php echo $ListAppliCustomer["customer_mobile"];?></td>
                              <td><a href="<?php echo Route::_('show=newappreg&up=cncoi&stage='.EncData(trim(DecData($_GET["stage"], 1, $objBF)), 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&ui='.EncData(trim(DecData($_GET["ui"], 1, $objBF)), 2, $objBF).'&coi='.EncData($customer_old_id, 2, $objBF).'&cm='.EncData($customer_mode, 2, $objBF).'&cnoi='.EncData($ListAppliCustomer["customer_id"], 2, $objBF).'&cnm='.EncData('U', 2, $objBF));?>">Select</a></td>
                            </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
                        <hr>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 4){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="stage" value="<?php echo $_GET["stage"];?>">
            <input type="hidden" name="bl" value="<?php echo EncData(trim(DecData($_GET["bl"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="pi" value="<?php echo trim(DecData($_GET["pi"], 1, $objBF));?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Registration Application From';?></h4>
            </div>
            <div class="toolbar btn-back text-right view-form">
              <h4 class="card-title"><?php echo RegisterProject($pri).' -> '.$FloorNumber['floor_name'].' -> '.$PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft]';?></h4>
              <a href="#" data-toggle="modal" data-target="#applicationform" class="btn">View Form</a>
              <?php include(HTML_PATH.'applicationform.php');?>
            </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt">
                <div class="row">
                  <div class="text-center col-md-12">
                    <h4><?php echo 'Attached Document for Applicant';?></h4>
                    <hr>
                  </div>
                  
                  
                  
                  
                  <?php 
                  /* 
				  //Upload Application Profile Image via camera 
                  <div class="col-md-4 text-center">
                    <legend>Applicant Profile Image <?php //echo EncData('mode_1', 2, $objBF);?></legend>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <input type="hidden" id="applicant_propfile_image_data" name="applicant_propfile_image_data" value="">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_profile_image"]);?>" id="applicantprofileimage" class="applicantprofileimage" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new" data-toggle="modal" data-target="#webcam" onClick="loadcam();">Select image</span> </span> 
                        </div>
                        
                    </div>
                  </div>
                  
                  
                  
                  
                  
                  
                  */ ?>
                  <?php
                  /*
				  //Old Applicant Profile Image Uploadng Section
				  */
				  ?>
                  <div class="col-md-4 text-center">
                    <legend>Applicant Profile Image </legend>
                    <?php if($CustomerProfileImageName !=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CustomerProfileImageName);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_profile_image"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_profile_image" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  
                  <div class="col-md-4 text-center">
                    <legend>Applicant CNIC Front Side</legend>
                    <?php if($StoreCustomerDocImgName["applicant_cnic_front_side"] !=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreCustomerDocImgName["applicant_cnic_front_side"]);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_cnic_front_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_cnic_front_side" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Applicant CNIC Back Side</legend>
                    <?php if($StoreCustomerDocImgName["applicant_cnic_back_side"] !=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreCustomerDocImgName["applicant_cnic_back_side"]);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_cnic_back_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_cnic_back_side" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Applicant Signature</legend>
                    <?php if($GetCustomerDoc["customer_sign"]!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_SIGNATURE_THUMB_URL.ProfileImgChecker($GetCustomerDoc["customer_sign"]);?>" alt="..."> </div>
                    </div>
                    <?php }else{ ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_SIGNATURE_THUMB_URL.SignatureChecker($CurrentSValue["applicant_signature"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_signature" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Applicant Passport Copy</legend>
                    <?php if($StoreCustomerDocImgName["applicant_passport_copy"] !=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreCustomerDocImgName["applicant_passport_copy"]);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_passport_copy"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_passport_copy" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <hr>
                  <hr>
                  <hr>
                  <div class="text-center col-md-12">
                    <h4><?php echo 'Attached Document for Nominee';?></h4>
                    <hr>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Nominee CNIC Front Side</legend>
                    <?php if($StoreNomineeDocImgName["nominee_cnic_front_side"]!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreNomineeDocImgName["nominee_cnic_front_side"]);?>" alt="..."> </div>
                    </div>
                    <?php }else{ ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["nominee_cnic_front_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="nominee_cnic_front_side" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Nominee CNIC Back Side</legend>
                    <?php if($StoreNomineeDocImgName["nominee_cnic_back_side"]!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreNomineeDocImgName["nominee_cnic_back_side"]);?>" alt="..."> </div>
                    </div>
                    <?php }else{ ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["nominee_cnic_back_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="nominee_cnic_back_side" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Nominee Passport Copy</legend>
                    <?php if($StoreNomineeDocImgName["nominee_passport_copy"]!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreNomineeDocImgName["nominee_passport_copy"]);?>" alt="..."> </div>
                    </div>
                    <?php }else{ ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["nominee_passport_copy"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="nominee_passport_copy" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Next</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          
          
          <div class="modal fade" id="webcam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice" style="width:300px;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="StopWebCam();"><i class="material-icons">clear</i></button>
                  <h5 class="modal-title" id="myModalLabel"><i class="material-icons">camera_alt</i> Applicant Profile Picture</h5>
                </div>
                <div class="modal-body text-center">
                  <div id="cam_screen"></div>
                    <span class="btn btn-rose btn-round btn-file">
                    	<span class="fileinput-new" onClick="take_snapshot();"><i class="material-icons">camera_alt</i> Take Picture</span>
                    </span> 
                </div>
              </div>
            </div>
          </div>
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 5){?>
          <style>
        @font-face{
            font-family:'GothamBlack','GothamBook';
            src:url("<?php echo SITE_URL.'appform/';?>fonts/Gotham-Black.ttf");
            src:url("<?php echo SITE_URL.'appform/';?>fonts/Gotham-Book.ttf");
        }
       
        .compname{
            float:left;
        }        
        .compname h1{
            font-family:GothamBlack;
            font-size:20px;
            font-weight:bold;
            margin-bottom:0px;
        }
        .compname span{
            font-family:'Gotham Book';
            font-size:20px;
        }
        .compname h5{
            margin:0px;
            padding:0px;
            font-size:10px;
            font-family:'Gotham Book';
        }
        .compname h3{
            margin-top:5px;
            font-size:13px;
            font-family:'Gotham Book';
        }

        .compname h3 span{
            padding-left:200px;
            font-size:13px;
        }
        .complogo img{
            float:right;
            width:180px;
            height:auto;
            margin-top:10px;
        }
        .comptable{
            display:table;
            /*width:600px;*/
            width:800px;

            border:solid 2px #51BD9A;      
            position: relative;
            color:white;
            margin-top:10px;
            border-top:0px; 
        }
        .comptable img{
            /*width:600px;*/
            width:800px;
            height:20px;
        }
        .comptable h3{
            position: absolute;
            top:3px;
            left:40px;
            font-size:13px;
            font-family:GothamBlack;
            margin:0px;
        }

        .h3prop{
            font-family:GothamBlack;
            font-size:12px;
            margin:10px 20px 15px 40px;
            color:black;
            letter-spacing:0.5px;
        }
        .h3prop2{
            font-family:'Gotham Book';
            font-size:14px;
            margin:10px 20px 15px 40px;
            color:black;
            letter-spacing:0.5px;
        }
        .rowprop{
            width:100%;
            margin-right:0px;
        }
        .spanprop{
            font-family:'Gotham Book';
            font-size:12px;
            margin:10px 0px 5px 0px;
            color:black;
            letter-spacing:0px;
        }

        .checkboxprop{
            align-items:baseline;
            font-family:'Gotham Book';
            font-size:14px;
            margin:10px 20px;
        }

        /*input[type='checkbox']{
                border: 1px solid #FFFFFF;
                background: transparent; 
        }*/
        .tempuncheck{
            background:transparent ;
            background-position: center;
            border:solid 2px #000;
        }
        .tempcheck{
            background-color:black ;
            background-position: center;
            border:solid 2px #000;
        }
        .block{
            background:transparent ;
            background-position: center;
            border:solid 1px #000;
            padding:0px 4px;
            margin-right:-4px;
        }

        .termblock{
            display:table;
            /*width:600px;*/
            width:800px;

            position: relative;
            margin-top:10px;
        }
        .footerprop{
            width:800px;
            height:26px;
            margin-top:10px;
            bottom:0px;

        }
        section{
            margin-bottom:18px;
        }
        strong{
            font-family:GothamMedium;
            font-size:14px;
        }
    </style>
          <div class="card-header card-header-text" data-background-color="rose">
            <h4 class="card-title"><?php echo 'New Registration Application From';?></h4>
          </div>
          <div class="toolbar  text-right">
            <h4 class="card-title"><?php echo RegisterProject($pri).' -> '.$FloorNumber['floor_name'].' -> '.$PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft]';?></h4>
            <?php 
			$blDec = trim(DecData($_SESSION['InfoDetail']['bl'], 1, $objBF)); 
			$piDec = trim(DecData($_SESSION['InfoDetail']['pi'], 2, $objBF)); 
			?>
            <a href="<?php echo Route::_('show=newappreg&mode='.EncData('edit', 2, $objBF).'&stage='.EncData('3', 2, $objBF).'&bl='.EncData($blDec, 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&ui='.EncData(trim(DecData($_GET["ui"], 1, $objBF)), 2, $objBF));?>" class="btn btn-rose btn-fill"><i class="material-icons">edit</i> Edit</a> &nbsp; <a href="<?php echo Route::_('show=newappreg&mode='.EncData('save', 2, $objBF).'&stage='.EncData('6', 2, $objBF));?>" class="btn btn-rose btn-fill" id="hideafterclick"><i class="material-icons">save</i> Save Now</a> </div>
          <div class="col-md-10 col-md-offset-1">
            <?php //include(HTML_PATH.'finalapplicationform.php');?>
            <?php //include(HTML_PATH.'finalapplicationform.php');?>
            Application Form Area
          </div>
          <?php } elseif(trim(DecData($_GET["stage"], 1, $objBF)) == 8){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="stage" value="<?php echo EncData(trim(DecData($_GET["stage"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="bl" value="<?php echo EncData(trim(DecData($_GET["bl"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="pi" value="<?php echo EncData(trim(DecData($_GET["pi"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="ui" value="<?php echo EncData(trim(DecData($_GET["ui"], 1, $objBF)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'New Registration Application From';?></h4>
            </div>
            <div class="toolbar btn-back text-right">
              <h4 class="card-title"><?php echo RegisterProject($pri).' -> '.$FloorNumber['floor_name'].' -> '.$PropertyTypeDetail["property_section"].' ['.$PropertyTypeDetail["property_area"].'/sq-ft]';?></h4>
            </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="col-sm-6">
                  <label class="label-control">Joint Applicant:</label>
                  <div class="form-group label-floating">
                    <div class="radio col-sm-6">
                      <label>
                        <input type="radio" class="login_required joint_aplic_opt" name="joint_aplic_opt"<?php echo StaticRadioChecked(1, $joint_aplic_opt);?> required value="1" tabindex="21">
                        Yes</label>
                    </div>
                    <div class="radio col-sm-6">
                      <label>
                        <input type="radio" class="login_required joint_aplic_opt" name="joint_aplic_opt"<?php if($joint_aplic_opt!=''){ echo StaticRadioChecked(2, $joint_aplic_opt); } else { echo ' checked'; } ?> required value="2" tabindex="21">
                        No</label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="row" id="jointaplic_section">
                  <div class="col-sm-12">
                    <h4 class="card-title">Joint Applicant Information</h4>
                    <hr>
                  </div>
                  <div class="row  center-page">
                    <div class="col-xs-4">
                      <div class="card"> <a href="#" onClick="openRequestedPopup('<?php echo Route::_('show=newappregjoint&ja='.EncData('form', 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(DecData($_GET["pi"], 1, $objBF), 2, $objBF).'&jn='.EncData('1', 2, $objBF));?>', 2);">
                        <div class="card-content text-center tab"><div class="icons joint"><img src="../assets/img/joint-icon.png"></div> <code>Add/Edit First Joint</code> </div>
                        </a> </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="card"> <a href="#" onClick="openRequestedPopup('<?php echo Route::_('show=newappregjoint&ja='.EncData('form', 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(DecData($_GET["pi"], 1, $objBF), 2, $objBF).'&jn='.EncData('2', 2, $objBF));?>', 2);">
                        <div class="card-content text-center tab"><div class="icons joint"><img src="../assets/img/joint-icon.png"></div> <code>Add/Edit Second Joint</code> </div>
                        </a> </div>
                    </div>
                    <div class="col-xs-4">
                      <div class="card"> <a href="#" onClick="openRequestedPopup('<?php echo Route::_('show=newappregjoint&ja='.EncData('form', 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(DecData($_GET["pi"], 1, $objBF), 2, $objBF).'&jn='.EncData('3', 2, $objBF));?>', 2);">
                        <div class="card-content text-center tab"><div class="icons joint"><img src="../assets/img/joint-icon.png"></div> <code>Add/Edit Third Joint</code> </div>
                        </a> </div>
                    </div>
					  <div class="row center-page">
                    <div class="col-xs-4 joint-label">
                      <div class="card"> <a href="#" onClick="openRequestedPopup('<?php echo Route::_('show=newappregjoint&ja='.EncData('form', 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(DecData($_GET["pi"], 1, $objBF), 2, $objBF).'&jn='.EncData('4', 2, $objBF));?>', 2);">
                        <div class="card-content text-center tab"><div class="icons joint"><img src="../assets/img/joint-icon.png"></div> <code>Add/Edit Fourth Joint</code> </div>
                        </a> </div>
                    </div>
                    <div class="col-xs-4 joint-label">
                      <div class="card"> <a href="#" onClick="openRequestedPopup('<?php echo Route::_('show=newappregjoint&ja='.EncData('form', 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(DecData($_GET["pi"], 1, $objBF), 2, $objBF).'&jn='.EncData('5', 2, $objBF));?>', 2);">
                        <div class="card-content text-center tab"><div class="icons joint"><img src="../assets/img/joint-icon.png"></div> <code>Add/Edit Fifth Joint</code> </div>
                        </a> </div>
                    </div>
						  </div>
                  </div>
                </div>
                <hr>
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill" tabindex="24">Next</button>
                <button type="reset" class="btn btn-fill" tabindex="25">Reset</button>
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
                          <input type="hidden" name="stage" value="<?php echo EncData('6', 1, $objBF);?>">
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
          <div class="modal fade" id="nomineepopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="material-icons">clear</i></button>
                  <h5 class="modal-title" id="myModalLabel"><i class="material-icons">lock</i> Fetch Customer Info</h5>
                </div>
                <div class="modal-body">
                  <div class="instruction">
                    <div class="row">
                      <div class="material-datatables" id="old_nominee_list">
                        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                          <thead>
                            <tr>
                              <th>Full Name</th>
                              <th>CNIC</th>
                              <th>Mobile #</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                                $objQayadapplication->resetProperty();
                                $objQayadapplicationCustomer = new Qayadapplication;
                                $objQayadapplication->setProperty("ORDERBY", 'aplic_id');
                                $objQayadapplication->setProperty("GROUPBY", 'nominee_id');
                                $objQayadapplication->lstApplication();
                                while($ListApplic = $objQayadapplication->dbFetchArray(1)){
                                    $objQayadapplicationCustomer->setProperty("customer_id", $ListApplic["nominee_id"]);
                                    $objQayadapplicationCustomer->lstApplicationCustomer();
                                    while($ListAppliCustomer = $objQayadapplicationCustomer->dbFetchArray(1)){
                                ?>
                            <tr>
                              <td><?php echo $ListAppliCustomer["fullname"];?></td>
                              <td><?php echo $ListAppliCustomer["customer_cnic"];?></td>
                              <td><?php echo $ListAppliCustomer["customer_mobile"];?></td>
                              <td><a href="<?php echo Route::_('show=newappreg&up=cncoi&stage='.EncData(trim(DecData($_GET["stage"], 1, $objBF)), 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&coi='.EncData($customer_old_id, 2, $objBF).'&cm='.EncData($customer_mode, 2, $objBF).'&cnoi='.EncData($ListAppliCustomer["customer_id"], 2, $objBF).'&cnm='.EncData('U', 2, $objBF));?>">Select</a></td>
                            </tr>
                            <?php } } ?>
                          </tbody>
                        </table>
                        <hr>
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