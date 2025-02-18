<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
           <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ 
				$objSSSinventory->resetProperty();
		   ?>
           <h3 class="card-title CardWidth"><code><?php echo $objSSSinventory->GetTenantFullName(trim(DecData($_GET["t"], 1, $objBF)));?></code> Tenant Installmets</h3>
           <?php } else { ?>
            <h3 class="card-title CardWidth">List of Tenant Pending Amount</h3>
            <?php } ?>
            <hr>
            <div class="material-datatables">
              <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ ?>
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Tenant Name</th>
                    <th>Pendings</th>
                    <th>No.of Inst</th>
                    <th>Inst Amount</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantName = new SSSinventory;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("tenant_installment_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->lstInstallmentPlan();
					$ListOfInstalment = $objSSSinventory->dbFetchArray(1);
					$objSSSTenantName->resetProperty();
				?>
                  <tr>
                    <td><?php echo $objSSSTenantName->GetTenantFullName($ListOfInstalment["tenant_id"]);?></td>
					<td>Rs.<?php echo $ListOfInstalment["pending_amount"];?></td>
                    <td><?php echo $ListOfInstalment["no_of_installment"];?></td>
                    <td>Rs.<?php echo $ListOfInstalment["installment_amount"];?></td>
                    <td><?php echo InstalmentStatus($ListOfInstalment["installment_status"]);?></td>
                  </tr>
                  <?php //} ?>
                </tbody>
              </table>
              <hr />
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Monthly Amount</th>
                    <th>Due Month</th>
                    <th>Status</th>
                    <th>Bill No.</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSBillDetail = new SSSinventory;
					$objSSSGenBillid = new SSSinventory;
					$objSSSBillNo = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("tenant_installment_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->lstInstallmentList();
					while($ListOfInstalmentDetail = $objSSSinventory->dbFetchArray(1)){
					$objSSSTenantName->resetProperty();
					$objSSSBillNo->resetProperty();
					$objSSSGenBillid->resetProperty();
					//if($ListOfInstalmentDetail["installment_list_id"] != ''){
					$objSSSBillDetail->resetProperty();
					$objSSSBillDetail->setProperty("isActive", 1);
					$objSSSBillDetail->setProperty("installment_id", $ListOfInstalmentDetail["installment_list_id"]);
					$objSSSBillDetail->lstMonthlyRentAmount();
					$BillDetail = $objSSSBillDetail->dbFetchArray(1);
				?>
                  <tr>
					<td>Rs.<?php echo $ListOfInstalmentDetail["monthly_payment"];?></td>
                    <td><?php echo MonthList($ListOfInstalmentDetail["installment_month"]).'-'.$ListOfInstalmentDetail["installment_year"];?></td>
                    <td><?php echo InstalmentStatus($ListOfInstalmentDetail["installment_status"]);?></td>
                     <td>
                     <?php  if($BillDetail["rent_amount_id"] != ''){?>
                     <a href="<?php echo SITE_URL.'vbill.php?mbi='.EncData($objSSSGenBillid->GetGeneratedMonthId($BillDetail["monthly_rent_id"]), 2, $objBF).'&do='.EncData('reprint', 2, $objBF).'&t='.EncData($BillDetail["tenant_id"], 2, $objBF);?>" target="new"><?php echo $objSSSBillNo->GetBillNo($BillDetail["monthly_rent_id"]);?></a>
                     <?php } else { ?>
                     Pending
                     <?php } ?>
                     </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else { ?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Tenant Name</th>
                    <th>Pendings</th>
                    <th>No.of Inst</th>
                    <th>Inst Amount</th>
                    <th>Status</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantName = new SSSinventory;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("installment_option", 1);
					$objSSSinventory->setProperty("ORDERBY", 'tenant_installment_id DESC');
					$objSSSinventory->lstInstallmentPlan();
					while($ListOfInstalment = $objSSSinventory->dbFetchArray(1)){
					$objSSSTenantName->resetProperty();
				?>
                  <tr>
                    <td><?php echo $objSSSTenantName->GetTenantFullName($ListOfInstalment["tenant_id"]);?></td>
					<td>Rs.<?php echo $ListOfInstalment["pending_amount"];?></td>
                    <td><?php echo $ListOfInstalment["no_of_installment"];?></td>
                    <td>Rs.<?php echo $ListOfInstalment["installment_amount"];?></td>
                    <td><?php echo InstalmentStatus($ListOfInstalment["installment_status"]);?></td>
                     <td><a href="<?php echo Route::_('show=lsttenantpendings&i='.EncData($ListOfInstalment["tenant_installment_id"], 2, $objBF).'&t='.EncData($ListOfInstalment["tenant_id"], 2, $objBF));?>">View</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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