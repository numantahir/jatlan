<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Paid Charges</h3>
            <hr>
            <div class="material-datatables">
              <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ ?>
             <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Tenant Name</th>
                    <th>Tenant Shop</th>
                    <th>Tenant Code</th>
                    <th>M/Y</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Paid</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("generate_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
					if($objCheckLogin->user_type != 2){
					$objSSSinventory->setProperty("employee_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
					}
					$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
					$objSSSinventory->setProperty("GROUPBY", 'monthly_rent_id');
					$objSSSinventory->setProperty("rent_status", 1);
					$objSSSinventory->lstMCOMonthlyRent();
					while($ListOfPendingCharges = $objSSSinventory->dbFetchArray(1)){
						//GetUserFullName
						//GetTenantFullName
					$objSSSTenantDetail->resetProperty();
					$objSSSTenantDetail->setProperty("isAcitve", 1);
					$objSSSTenantDetail->setProperty("tenant_id", $ListOfPendingCharges["tenant_id"]);
					$objSSSTenantDetail->lstTenantInformation();
					$GetTenantDetail = $objSSSTenantDetail->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php 
					$TenantName = $GetTenantDetail["tenant_name"];
					echo $TenantName;?></td>
                    <td><?php echo $GetTenantDetail["tenant_shop_name"];?></td>
                    <td><?php echo $GetTenantDetail["tenant_code"];?></td>
                    <td><?php echo MonthList($ListOfPendingCharges["rent_of_month"]).'/'.$ListOfPendingCharges["rent_year"];?></td>
                    <td><?php echo dateFormate_3($ListOfPendingCharges["due_date"]);?></td>
                    <td><?php echo $ListOfPendingCharges["total_rent_amount"];?></td>
                    <td><?php echo $ListOfPendingCharges["received_amount"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else { ?>
              <table id="datatables_ol" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                <thead>
                  <tr>
                    <th>Month</th>
                    <th>Year</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'generate_bill_id DESC');
					$objSSSinventory->lstGenMonthlyBill();
					while($ListofGen = $objSSSinventory->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo MonthList($ListofGen["current_month"]);?></td>
                    <td><?php echo $ListofGen["current_year"];?></td>
                    <td><a href="<?php echo Route::_('show=lstpaidchrg&i='.EncData($ListofGen["generate_bill_id"], 2, $objBF));?>">View</a></td>                     
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