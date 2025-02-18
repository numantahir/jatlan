<?php
$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
$objSSSinventory->lstTenantInformation();
$GetTenantInfo = $objSSSinventory->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="monthly_rent_id" value="<?php echo $objBF->encrypt($monthly_rent_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="tenant_id" value="<?php echo $objBF->encrypt($GetTenantInfo["tenant_id"], ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo $GetTenantInfo["tenant_name"].' Pending Amounts';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=lsttenants&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF));?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Property</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="property_id" required title="<?php echo $GetTenantInfo["tenant_name"]; ?> Property List" tabindex="0">
                  <?php
					$MonthlyRevenue = 0;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("tenant_status", 1);
					$objSSSinventory->lstTenantAssignProperty();
					while($ListOfTenantProperty = $objSSSinventory->dbFetchArray(1)){
						
						$objSSSPropertyDetail->resetProperty();
						$objSSSPropertyDetail->setProperty("property_id", $ListOfTenantProperty['property_id']);
						$objSSSPropertyDetail->lstPropertyBundle();
						$ListOfProperties = $objSSSPropertyDetail->dbFetchArray(1);
				?>
                    <option value="<?php echo $ListOfProperties["property_id"];?>" <?php echo StaticDDSelection($ListOfProperties["property_id"], $property_id);?> selected><?php echo 'B: '.$ListOfProperties["block_name"].' / BU: '.$ListOfProperties["building_no"].' / F: '.$ListOfProperties["floor_name"].' / PT: '.PropertyTypeById($ListOfProperties["property_type"]). ' / PN: '.$ListOfProperties["property_number"].' / PC: '.$ListOfProperties["property_code"]; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Bill No.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'bill_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="bill_no" required value="<?php echo $bill_no;?>" tabindex="1" />
                  <small><?php echo $vResult["bill_no"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Within Date Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'within_monthly_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="within_monthly_rent" required value="<?php echo $within_monthly_rent;?>" tabindex="2" />
                  <small><?php echo $vResult["within_monthly_rent"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">After Due Date Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'after_monthly_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="after_monthly_rent" value="<?php echo $after_monthly_rent;?>" tabindex="3" />
                  <small><?php echo $vResult["after_monthly_rent"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Arrears Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'arrears_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="arrears_rent" value="<?php echo $arrears_rent;?>" tabindex="4" />
                  <small><?php echo $vResult["arrears_rent"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Final Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'total_rent_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="total_rent_amount" required value="<?php echo $total_rent_amount;?>" tabindex="5" />
                  <small><?php echo $vResult["total_rent_amount"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Month</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="rent_of_month" required title="Select Month" tabindex="6">
                    <?php 
					$objSSSinventory->resetProperty();
					echo $objSSSinventory->MonthList($rent_of_month);?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Year</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="rent_year" required title="Select Year" tabindex="7">
                    <option value="2020" <?php echo StaticDDSelection(2020, $rent_year);?> >2020</option>
                    <option value="2021" <?php echo StaticDDSelection(2021, $rent_year);?>>2021</option>
                    <option value="2022" <?php echo StaticDDSelection(2022, $rent_year);?>selected>2022</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Amount Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="rent_status" required title="Amount Status" tabindex="8">
                    <option value="2" <?php echo StaticDDSelection(2, $rent_status);?> selected>Pending</option>
                    <option value="1" <?php echo StaticDDSelection(1, $rent_status);?>>Paid</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Due Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'due_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="due_date" required value="<?php echo $due_date;?>" tabindex="9" />
                  <small><?php echo $vResult["due_date"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Generate Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'generate_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="generate_date" value="<?php echo $generate_date;?>" tabindex="10" />
                  <small><?php echo $vResult["generate_date"];?></small> </div>
              </div>
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
