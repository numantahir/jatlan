<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
           <h3 class="card-title CardWidth">
           <?php if(trim(DecData($_GET["v"], 1, $objBF)) != 'modification'){ ?>
           <code><?php echo $GetTenantInfo["tenant_name"] . ' / '. $GetTenantInfo["tenant_shop_name"];?></code> Bill Section</h3>
           <?php } else { 
		   
			
			//
		   ?>
           <code><?php echo $GetTenantInfo["tenant_name"] . ' / '. $GetTenantInfo["tenant_shop_name"];?></code> (<code><?php echo MonthList($ReqGenBill["current_month"]);?></code>) Bill Modification</h3>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=printbill&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF));?>" class="btn">Back</a> </div>
           <?php } ?>
            <div class="material-datatables">
              <?php if(trim(DecData($_GET["v"], 1, $objBF)) != 'modification'){?>
              <table id="datatables_ol" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                <thead>
                  <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Modification</th>
                    <th>reGenerate</th>
                    <th>Print</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSPaidstatusCheck = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("ORDERBY", 'generate_bill_id DESC');
					$objSSSinventory->lstGenMonthlyBill();
					while($ListofGen = $objSSSinventory->dbFetchArray(1)){
						
						
						$objSSSPaidstatusCheck->resetProperty();
						$objSSSPaidstatusCheck->setProperty("isAcitve", 1);
						$objSSSPaidstatusCheck->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
						$objSSSPaidstatusCheck->setProperty("generate_bill_id", $ListofGen["generate_bill_id"]);
						$objSSSPaidstatusCheck->setProperty("ORDERBY", 'monthly_rent_id DESC');
						$objSSSPaidstatusCheck->lstMonthlyRent();
						if($objSSSPaidstatusCheck->totalRecords() > 0){
						$GetPaidStatus = $objSSSPaidstatusCheck->dbFetchArray(1);
						$PaidStatusChecker = $GetPaidStatus["rent_status"];
						} else {
						$PaidStatusChecker = 2;	
						}
						//lstMonthlyRent
				?>
                  <tr>
                    <td><?php echo MonthList($ListofGen["current_month"]);?></td>
                    <td><?php echo $ListofGen["current_year"];?></td>
                    <td><a href="<?php echo Route::_('show=printbill&v='.EncData('modification', 2, $objBF).'&gbi='.EncData($ListofGen["generate_bill_id"], 2, $objBF).'&i='.EncData($GetTenantInfo["tenant_id"], 2, $objBF));?>">Modification</a></td>
                    
                    <td>
                    <?php if($PaidStatusChecker == 2){?>
                    <a href="<?php echo SITE_URL. 'regn.php?do='.EncData('regenerate', 2, $objBF).'&t='.EncData($GetTenantInfo["tenant_id"], 2, $objBF).'&mbi='.EncData($ListofGen["generate_bill_id"], 2, $objBF);?>" target="new">reGenerate</a>
                    <?php } else { ?>
                    <span  id="<?php echo $GetPaidStatus["monthly_rent_id"].' --- '.$PaidStatusChecker;?>">reGenerate</span>
                    <?php } ?>
                    </td>
                     <td><a href="<?php echo SITE_URL. 'rept.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($GetTenantInfo["tenant_id"], 2, $objBF).'&mbi='.EncData($ListofGen["generate_bill_id"], 2, $objBF);?>" target="new">Re-Print</a></td>
                     
                     <td><a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($GetTenantInfo["tenant_id"], 2, $objBF).'&mbi='.EncData($ListofGen["generate_bill_id"], 2, $objBF);?>" target="new">View</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else {?><hr />
              <h4 class="card-title" style="padding-bottom:0px;">Tenant Overview</h4>
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Phone#</th>
                    <th>Shop Name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $GetTenantInfo["tenant_name"];?></td>
                    <td><?php echo $GetTenantInfo["tenant_cnic"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_phone"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_shop_name"];?></td>
                  </tr>
                </tbody>
              </table>
              <hr />
             <h4 class="card-title" style="padding-bottom:0px;">List of Tenant Properties</h4>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Block</th>
                    <th>Building No.</th>
                    <th>Floor</th>
                    <th>Type</th>
                    <th>Pro No.</th>
                    <th>Pro Code.</th>
                    <th>Monthly</th>
                  </tr>
                </thead>
                <tbody>
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
						$MonthlyRevenue += $ListOfProperties["monthly_maint"];
				?>
                  <tr>
                    <td><?php echo $ListOfProperties["block_name"];?></td>
                    <td><?php echo $ListOfProperties["building_no"];?></td>
                     <td><?php echo $ListOfProperties["floor_name"];?></td>
                     <td><?php echo PropertyTypeById($ListOfProperties["property_type"]);?></td>
                     <td><?php echo $ListOfProperties["property_number"];?></td>
                     <td><?php echo $ListOfProperties["property_code"];?></td>
                     <td><?php echo $ListOfProperties["monthly_maint"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              
              <hr />
              <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="gbi" value="<?php echo EncData($ReqGenBill["generate_bill_id"], 1, $objBF);?>">
            <input type="hidden" name="tni" value="<?php echo EncData($GetTenantInfo["tenant_id"], 1, $objBF);?>">
            <input type="hidden" name="mri" value="<?php echo EncData($MonthlyBillDetail["monthly_rent_id"], 1, $objBF);?>">
           <input type="hidden" name="tnp" value="<?php echo $CountNoOfPropertiesInBill;?>">
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Bill No.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'bill_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" style="background-color:#F2F2F2;" name="bill_no" readonly="readonly" value="<?php echo $MonthlyBillDetail["bill_no"];?>" tabindex="2" />
                  <small><?php echo $vResult["bill_no"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Current Bill Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'within_monthly_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" style="background-color:#F2F2F2;" name="within_monthly_rent" readonly="readonly" value="<?php echo $MonthlyBillDetail["within_monthly_rent"];?>" tabindex="3" />
                  <small><?php echo $vResult["within_monthly_rent"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Arrears Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'within_monthly_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" style="background-color:#F2F2F2;" name="arrears_rent" readonly="readonly" value="<?php echo $MonthlyBillDetail["arrears_rent"];?>" tabindex="4" />
                  <small><?php echo $vResult["within_monthly_rent"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Extra Charges</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'within_monthly_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" style="background-color:#F2F2F2;" name="arrears_rent" readonly="readonly" value="<?php echo $GetExtraChargesRq["extra_charges"];?>" tabindex="4" />
                  <small><?php echo $vResult["within_monthly_rent"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Total No. of Properties</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'within_monthly_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" style="background-color:#F2F2F2;" name="arrears_rent" readonly="readonly" value="<?php echo $CountNoOfPropertiesInBill;?>" tabindex="4" />
                   </div>
              </div>
            </div>
            
            <hr />
            <h4 class="card-title" style="padding-bottom:0px;">Modification Section</h4>
           
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Modify As</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="modification_option" required title="Modify As" tabindex="1">
                   <?php if($MonthlyBillDetail["rent_status"]==2){?>
                    <option value="1" <?php echo StaticDDSelection(1, $rent_status);?> selected> Permanent fix (Property Base) with current <code>Month</code></option>
                    <option value="2" <?php echo StaticDDSelection(2, $rent_status);?> selected> Permanent fix (Property Base) from next <code>Month</code></option>
                    <option value="3" <?php echo StaticDDSelection(3, $rent_status);?>>Selected month bill only.</option>
                    <?php } else { ?>
                    <option value="2" <?php echo StaticDDSelection(2, $rent_status);?> selected> Permanent fix (Property Base) from next <code>Month</code></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Amount Property Base</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'after_monthly_rent');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="new_amount" required="required" value="<?php echo $new_amount;?>" tabindex="5" />
                  <small><?php echo $vResult["after_monthly_rent"];?></small> <small style="color:#F00;">Note: Write a new amount on per property base not total. Like if the total amount is Rs.8000/- and you have 4 properties so you write 2000 only. System will be automatically set with each property or in bill.</small></div>
              </div>
            </div>
            
            
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
           </div>
          </form>
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