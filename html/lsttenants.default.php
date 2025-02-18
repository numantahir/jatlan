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
			?>
          <h3 class="card-title CardWidth">Detail of <code><?php echo $GetTenantInfo["tenant_name"];?></code> Tenant</h3>
            
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=lsttenantform&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF));?>" class="btn btn-primary">Edit</a> </div>
          <?php } else { ?>
            <h3 class="card-title CardWidth">List of Tenants Management</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=lsttenantform');?>" class="btn btn-primary">Add New</a> </div>
            <?php } ?>
            <hr>
            <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ ?>
            <div class="toolbar text-right"><a href="<?php echo Route::_('show=printbill&i='.EncData($GetTenantInfo["tenant_id"], 2, $objBF));?>" class="btn btn-primary"><strong>Re-Gen/Print</strong></a> &nbsp;&nbsp;</div>
            <div class="material-datatables">
            <h4 class="card-title" style="padding-bottom:0px;">Tenant Overview</h4>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Code</th>
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
                    <td><?php echo $GetTenantInfo["tenant_code"];?></td>
                    <td><?php echo $GetTenantInfo["tenant_cnic"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_phone"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_joinin_date"];?></td>
                     <td><?php echo $GetTenantInfo["tenant_shop_name"];?></td>
                    <td><?php echo StatusName($GetTenantInfo["isActive"]);?></td>
                  </tr>
                </tbody>
              </table>
              <hr />
             <h4 class="card-title" style="padding-bottom:0px;">List of Tenant Properties</h4>
             <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=assigntentproty&i='.EncData(trim(DecData($_GET["i"], 1, $objBF)), 2, $objBF));?>" class="btn btn-primary">Assign New</a></div><br />
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
                    <th>Leave</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$MonthlyRevenue = 0;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
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
                     <td><a href="<?php echo Route::_('show=lsttenants&i='.EncData($ListOfTenantProperty["assign_property_id"], 2, $objBF).'&ac='.EncData('leave', 2, $objBF).'&emp='.EncData('yes', 2, $objBF).'&p='.EncData($ListOfTenantProperty["property_id"], 2, $objBF).'&t='.EncData($ListOfTenantProperty["tenant_id"], 2, $objBF));?>" class="leave">Leave</a></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="6" align="right"><strong>Monthly Revenue:</strong></td>
                    <th colspan="2"><strong><?php echo 'Rs.'.$MonthlyRevenue;?></strong></th>
                  </tr>
                </tbody>
              </table>
              <hr />
              <h4 class="card-title" style="padding-bottom:0px;">List of Extra Charges</h4>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Title</th>
                    <th>Charges</th>
                    <th>Tenant</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantName = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'extra_charges_id DESC');
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->lstTenantExtraCharges();
					while($ListofExtraCharges = $objSSSinventory->dbFetchArray(1)){

				?>
                  <tr>
                    <td><?php echo $ListofExtraCharges["extra_title"];?></td>
                    <td><?php echo $ListofExtraCharges["extra_charges"];?></td>
                    <td><?php echo $objSSSTenantName->GetTenantFullName($ListofExtraCharges["tenant_id"]);?></td>
                    <td><?php echo StatusName($ListofExtraCharges["isActive"]);?></td>
                  </tr>
                  <?php } ?>
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
						
						$pendingAmount += $ListOfTenantProperty["within_monthly_rent"] + $ListOfTenantProperty["installment_amount"] + $ListOfTenantProperty["extra_amount"];
				?>
                  <tr>
                    <td><?php echo MonthList($ListOfTenantProperty["rent_of_month"]).'/'.$ListOfTenantProperty["rent_year"];?></td>
                     <td><?php echo dateFormate_3($ListOfTenantProperty["due_date"]);?></td>
                     <td><?php echo $ListOfTenantProperty["bill_no"];?></td>
                     <td>Rs.<?php echo $ListOfTenantProperty["within_monthly_rent"];?></td>
                     <td>Rs.<?php echo $ListOfTenantProperty["arrears_rent"];?></td>
                     <td>Rs.<?php echo $ListOfTenantProperty["installment_amount"];?></td>
                     <td>Rs.<?php echo $ListOfTenantProperty["extra_amount"];?></td>
                     <td><strong>Rs.<?php echo $pendingAmount;?></strong></td>
                  </tr>
                 
                  <?php //} ?>
                </tbody>
              </table>
              <hr />
              <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("installment_option", 2);
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("ORDERBY", 'tenant_installment_id DESC');
					$objSSSinventory->lstInstallmentPlan();
					$InstallmentCounter = $objSSSinventory->totalRecords();
					if($InstallmentCounter > 0){
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
                <?php $ListOfTenantProperty = $objSSSinventory->dbFetchArray(1); ?>
                  <tr>
                    <td>Rs.<?php echo $ListOfTenantProperty["pending_amount"];?></td>
                     <td>Rs.<?php echo $ListOfTenantProperty["installment_amount"];?></td>
                     <td><?php echo $ListOfTenantProperty["no_of_installment"];?></td>
                     <td><?php echo InstalmentStatus($ListOfTenantProperty["installment_status"]);?></td>
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
					$pendingAmount = 0;
					$objSSSBillDetail = new SSSinventory;
					$objSSSGenBillid = new SSSinventory;
					$objSSSBillNo = new SSSinventory;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("installment_option", 2);
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("ORDERBY", 'installment_list_id DESC');
					$objSSSinventory->lstInstallmentList();
					while($ListOfTenantProperty = $objSSSinventory->dbFetchArray(1)){
						$objSSSTenantName->resetProperty();
					$objSSSBillNo->resetProperty();
					$objSSSGenBillid->resetProperty();
					//if($ListOfTenantProperty["installment_list_id"] != ''){
					$objSSSBillDetail->resetProperty();
					$objSSSBillDetail->setProperty("isActive", 1);
					$objSSSBillDetail->setProperty("installment_id", $ListOfTenantProperty["installment_list_id"]);
					$objSSSBillDetail->lstMonthlyRentAmount();
					$BillDetail = $objSSSBillDetail->dbFetchArray(1);
						$pendingAmount += $ListOfTenantProperty["within_monthly_rent"] + $ListOfTenantProperty["arrears_rent"];
				?>
                  <tr>
                    <td>Rs.<?php echo $ListOfTenantProperty["monthly_payment"];?></td>
                     <td><?php echo InstalmentStatus($ListOfTenantProperty["installment_status"]);?></td>
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
              
             
              <h4 class="card-title" style="padding-bottom:0px;">Generated Bill List</h4>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Bill No.</th>
                    <th>Month/Year</th>
                    <th>Monthly (W)</th>
                    <th>Monthly (A)</th>
                    <th>Arrears</th>
                    <th>INSTL Amount</th>
                    <th>Extra Amount</th>
                    <th>Received Amount</th>
                    <th>Due Date</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->lstMonthlyRent();
					while($ListofRent = $objSSSinventory->dbFetchArray(1)){

				?>
                  <tr>
                    <td><?php echo $ListofRent["bill_no"];?></td>
                    <td><?php echo MonthList($ListofRent["rent_of_month"]).' / '.$ListofRent["rent_year"];?></td>
                    <td>Rs.<?php echo ArrearsAmount($ListofRent["within_monthly_rent"]);?></td>
                     <td>Rs.<?php echo ArrearsAmount($ListofRent["after_monthly_rent"]);?></td>
                      <td>Rs.<?php echo ArrearsAmount($ListofRent["arrears_rent"]);?></td>
                       <td>Rs.<?php echo ArrearsAmount($ListofRent["installment_amount"]);?></td>
                        <td>Rs.<?php echo ArrearsAmount($ListofRent["extra_amount"]);?></td>
                         <td>Rs.<?php echo ArrearsAmount($ListofRent["received_amount"]);?></td>
                          <td><?php echo dateFormate_3($ListofRent["due_date"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
               <hr />
            </div>
            <?php } else { ?>
            <div class="material-datatables">
              <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
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
                    <th class="disabled-sorting text-right">View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTotalUnits = new SSSinventory;
					$objSSSinventory->resetProperty();
					//$objSSSinventory->setProperty("isActive", 1);
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
                    <a title="View Tenant Info" href="<?php echo Route::_('show=lsttenants&i='.EncData($ListOfTenant["tenant_id"], 2, $objBF));?>"> View </a>
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