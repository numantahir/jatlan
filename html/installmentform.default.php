<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
          <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->lstTenantInformation();
				$GetTenantInfo = $objSSSinventory->dbFetchArray(1);
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("installment_option", 2);
				$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->setProperty("ORDERBY", 'tenant_installment_id DESC');
				$objSSSinventory->lstInstallmentPlan();
				$InstallmentCounter = $objSSSinventory->totalRecords();
				if($InstallmentCounter > 0){
				$ListOfTenantPropertyList = $objSSSinventory->dbFetchArray(1); 
				}
			?>
          <h3 class="card-title CardWidth">Detail of <code><?php echo $GetTenantInfo["tenant_name"];?></code> Tenant</h3>
          <?php } else { ?>
            <h3 class="card-title CardWidth">Select Tenant for new installment</h3>
            <?php } ?>
            <hr>
            <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ ?>
            <div class="material-datatables">
            <h4 class="card-title" style="padding-bottom:0px;">Tenant Overview</h4>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Phone#</th>
                    <th>Reg Date</th>
                    <th>Shop Name</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $GetTenantInfo["tenant_name"];?></td>
                    <td><?php echo $GetTenantInfo["tenant_cnic"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_phone"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_joinin_date"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_shop_name"];?></td>
                    <td><?php echo StatusName($GetTenantInfo["isActive"]);?></td>
                  </tr>
                </tbody>
              </table>
              
              
              <hr />
              
          
               
               
              <h4 class="card-title" style="padding-bottom:0px;">Pending Amount Detail</h4>
              <!--<div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=pendingfrm&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF));?>" class="btn btn-primary">Add Pendings</a></div>--><br />
            	<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Month/Year</th>
                    <th>Due Date</th>
                    <th>Bill No.</th>
                    <th>Within Date</th>
                    <th>Arrears</th>
                    <th>Installment</th>
                    <th>Extra Charges</th>
                    <th>Pending</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$pendingAmount = 0;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("limit", 1);
					$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
					$objSSSinventory->lstMonthlyRent();
					$ListOfTenantProperty = $objSSSinventory->dbFetchArray(1);
						$pendingAmount += $ListOfTenantProperty["total_rent_amount"];	
				?>
                  <tr>
                    <td><?php echo MonthList($ListOfTenantProperty["rent_of_month"]).'/'.$ListOfTenantProperty["rent_year"];?></td>
                     <td><?php echo dateFormate_3($ListOfTenantProperty["due_date"]);?></td>
                     <td><?php echo $ListOfTenantProperty["bill_no"];?></td>
                     <td>Rs.<?php echo ArrearsAmount($ListOfTenantProperty["within_monthly_rent"]);?></td>
                     <td>Rs.<?php echo ArrearsAmount($ListOfTenantProperty["arrears_rent"]);?></td>
                     <td>Rs.<?php echo ArrearsAmount($ListOfTenantProperty["installment_amount"]);?></td>
                     <td>Rs.<?php echo ArrearsAmount($ListOfTenantProperty["extra_amount"]);?></td>
                     <td><strong>Rs.<?php echo $pendingAmount;?></strong></td>
                  </tr>
                 
                  <?php //} ?>
                </tbody>
              </table>
              <hr />
              <?php
			  		$pendingAmount_sum = 0;
					$NoOfInstallmentPending =0;
					$mode = 'I';
					if($InstallmentCounter > 0){
						$mode = 'U';
						
				?>
              <h4 class="card-title" style="padding-bottom:0px;">Installment Overview</h4>
            	<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Pending Amount</th>
                    <th>Per Installment</th>
                    <th>No. of Installments</th>
                    <th>Installment Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
				$InstallmentPlanId = $ListOfTenantPropertyList["tenant_installment_id"];
				?>
                  <tr>
                    <td>Rs.<?php echo $ListOfTenantPropertyList["pending_amount"];?></td>
                     <td>Rs.<?php echo $ListOfTenantPropertyList["installment_amount"];?></td>
                     <td><?php echo $ListOfTenantPropertyList["no_of_installment"];?></td>
                     <td><?php echo InstalmentStatus($ListOfTenantPropertyList["installment_status"]);?></td>
                  </tr>
                </tbody>
              </table>
              <hr />
              <h4 class="card-title" style="padding-bottom:0px;">Installment Detail</h4>
            	<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Installment Amount</th>
                    <th>Status</th>
                     <th>Link with</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					
					$objSSSBillDetail = new SSSinventory;
					$objSSSGenBillid = new SSSinventory;
					$objSSSBillNo = new SSSinventory;
					$objSSSTenantName = new SSSinventory;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("installment_option", 2);
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("ORDERBY", 'installment_list_id DESC');
					$objSSSinventory->lstInstallmentList();
					while($ListOfTenantInstallmentList = $objSSSinventory->dbFetchArray(1)){
						
						$objSSSTenantName->resetProperty();
					$objSSSBillNo->resetProperty();
					$objSSSGenBillid->resetProperty();
					//if($ListOfTenantInstallmentList["installment_list_id"] != ''){
					$objSSSBillDetail->resetProperty();
					$objSSSBillDetail->setProperty("isActive", 1);
					$objSSSBillDetail->setProperty("installment_id", $ListOfTenantInstallmentList["installment_list_id"]);
					$objSSSBillDetail->lstMonthlyRentAmount();
					$BillDetail = $objSSSBillDetail->dbFetchArray(1);
					if($ListOfTenantInstallmentList["installment_status"] == 2){
						$NoOfInstallmentPending++;
						if($ListOfTenantProperty["installment_list_id"] != $ListOfTenantInstallmentList["installment_list_id"]){
						$pendingAmount_sum += $ListOfTenantInstallmentList["monthly_payment"];
						}
					}
				?>
                  <tr>
                    <td>Rs.<?php echo $ListOfTenantInstallmentList["monthly_payment"];?></td>
                     <td><?php echo InstalmentStatus($ListOfTenantInstallmentList["installment_status"]);?></td>
                     <td> <?php  if($BillDetail["rent_amount_id"] != ''){?>
                     <a href="<?php echo SITE_URL.'vbill.php?mbi='.EncData($objSSSGenBillid->GetGeneratedMonthId($BillDetail["monthly_rent_id"]), 2, $objBF).'&do='.EncData('reprint', 2, $objBF).'&t='.EncData($BillDetail["tenant_id"], 2, $objBF);?>" target="new"><?php echo $objSSSBillNo->GetBillNo($BillDetail["monthly_rent_id"]);?></a>
                     <?php } else { ?>
                     Pending
                     <?php } ?></td>
                  </tr>
                 
                  <?php } ?>
                </tbody>
              </table>
              <hr />
              <?php } ?>
              <h4 class="card-title" style="padding-bottom:0px;">Make New Installment</h4>
              
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
               
                  <tr>
                    <th width="30%">Pending Amount:</th>
                     <td width="70%">Rs.<?php echo $pendingAmount;?></td>
                  </tr>
                   <tr>
                    <th>Pending Installment:</th>
                     <td><?php echo $pendingAmount_sum;?></td>
                  </tr>
                   <tr>
                    <th>No.of Installment:</th>
                     <td><?php echo $NoOfInstallmentPending;?></td>
                  </tr>
                </tbody>
              </table>
              <hr />
            <h4 style="text-align:center; padding-bottom:10px; padding-top:10px; background-color:#900;"><div style="color:#FFF; letter-spacing:1px;"><strong>Note: Current remaining installment will be automatically removed/disable once you process a new installment plan.</strong></div></h4>
            
              <hr />
              <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <input type="text" name="tii" value="<?php echo $InstallmentPlanId;?>" />
            <input type="hidden" name="t" value="<?php echo $objBF->encrypt($GetTenantInfo["tenant_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="mi" value="<?php echo $objBF->encrypt($ListOfTenantProperty["monthly_rent_id"], ENCRYPTION_KEY);?>" />
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Total Pending Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" style="background-color:#EAEAEA; padding-left:10px; font-weight:bold;" name="total_pending_amount" id="total_pending_amount" readonly="readonly" value="<?php echo $pendingAmount + $pendingAmount_sum;?>" tabindex="1" />
                  <small style="color:#F00">Note: This pending amount is based on <strong>Current Month Bill</strong> and no of <strong>Pending Installment Base</strong>.</small> </div>
              </div>
            </div>
            
            <hr />
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Discount:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="discount_apply" id="discount_apply" title="Apply Discount" tabindex="1">
                    <option value="1" <?php echo StaticDDSelection(1, $discount_apply);?>>Yes</option>
                    <option value="2" <?php echo StaticDDSelection(2, $discount_apply);?> selected>No</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div id="discount_opt_yes" style="display:none;">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Discount As:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="discount_type" id="discount_type" title="Discount Type" tabindex="2">
                    <option value="1" <?php echo StaticDDSelection(1, $discount_type);?>selected>Percentage Base</option>
                    <option value="2" <?php echo StaticDDSelection(2, $discount_type);?>>Fix Amount</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Discount Value:</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'discount_value');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="discount_value" id="discount_value" value="<?php echo $discount_value;?>" tabindex="3" />
                  <small style="color:#F00;">Note: If discount in Percentage Base then it must be written in 1 to 99 range without any dot.</small> </div>
              </div>
            </div>
            
            
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Final Amount</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'head_code');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="pending_amount" id="pending_amount" readonly="readonly" value="<?php echo $pendingAmount + $pendingAmount_sum;?>" tabindex="5" />
                  <small><?php echo $vResult["pending_amount"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">No. of Installment</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'no_of_installment');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" min="1" name="no_of_installment" required="required" id="no_of_installment" value="<?php echo $no_of_installment;?>" tabindex="6" />
                  <small><?php echo $vResult["no_of_installment"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Per Month Installment</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'installment_amount');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="installment_amount" readonly="readonly" id="installment_amount" value="<?php echo $installment_amount;?>" tabindex="7" />
                  <small><?php echo $vResult["installment_amount"];?></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left"></label>
              <div class="col-sm-9">
                <code style="letter-spacing:1px; color:#F00"><strong>Note: The new installment will be automatically updated in the next month's [<strong style="color:#900"><?php echo date('M-Y', strtotime(date('Y-m').' + 1 Months'));?></strong>] bill.</strong></code>
              </div>
            </div>
            
            
            
            
          
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="7">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
              
              <?php //} ?>
              
             
             
            </div>
            <?php } else { ?>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>GID</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>CNIC</th>
                    <th>Phone#</th>
                    <th>No.of Unit</th>
                    <th>Shop Name</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Select</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTotalUnits = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'tenant_id');
					$objSSSinventory->lstTenantInformation();
					while($ListOfTenant = $objSSSinventory->dbFetchArray(1)){
						$objSSSTotalUnits->resetProperty();
				?>
                  <tr>
                    <td><?php echo $ListOfTenant["group_id"];?></td>
                    <td><?php echo $ListOfTenant["tenant_code"];?></td>
                    <td><?php echo $ListOfTenant["tenant_name"];?></td>
                    <td><?php echo $ListOfTenant["tenant_cnic"];?></td>
                     <td><?php echo $ListOfTenant["tenant_phone"];?></td>
                     <td><?php echo $objSSSTotalUnits->GetTenantUnitCounter($ListOfTenant["tenant_id"]);?></td>
                     <td><?php echo $ListOfTenant["tenant_shop_name"];?></td>
                    <td><?php echo StatusName($ListOfTenant["isActive"]);?></td>
                    <td class="td-actions text-right">
                    <a title="View Tenant Info" href="<?php echo Route::_('show=installmentform&i='.EncData($ListOfTenant["tenant_id"], 2, $objBF));?>"> Select </a>
					</td>
                  </tr>
                  <?php } ?>
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