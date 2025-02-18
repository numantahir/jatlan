<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Pending Charges</h3>
            <hr>
            <div class="material-datatables">
            <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ ?>
              <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Tenant Name</th>
                    <th>M/Y</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Bill no</th>
                    <th>Block</th>
                    <th>Building No.</th>
                    <th>Floor</th>
                    <th>Type</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantName = new SSSinventory;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
					$objSSSinventory->setProperty("GROUPBY", 'monthly_rent_id');
					$objSSSinventory->setProperty("generate_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("employee_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
					$objSSSinventory->setProperty("rent_status", 2);
					$objSSSinventory->lstMCOMonthlyRent();
					while($ListOfPendingCharges = $objSSSinventory->dbFetchArray(1)){
						
					$objSSSTenantName->resetProperty();
					//$objQayaduser->resetProperty();
					
					$objSSSPropertyDetail->resetProperty();
					$objSSSPropertyDetail->setProperty("property_id", $ListOfPendingCharges['property_id']);
					$objSSSPropertyDetail->lstPropertyBundle();
					$GetPropertyDetail = $objSSSPropertyDetail->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php echo $objSSSTenantName->GetTenantFullName($ListOfPendingCharges["tenant_id"]);?></td>
                    <td><?php echo MonthList($ListOfPendingCharges["rent_of_month"]).'/'.$ListOfPendingCharges["rent_year"];?></td>
                    <td><?php echo dateFormate_3($ListOfPendingCharges["due_date"]);?></td>
                    <td><?php echo $ListOfPendingCharges["total_rent_amount"];?></td>
                    <td><a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($ListOfPendingCharges["tenant_id"], 2, $objBF).'&mbi='.EncData($ListOfPendingCharges["generate_bill_id"], 2, $objBF);?>" target="new"><?php echo $ListOfPendingCharges["bill_no"];?></a></td>
                    <td><?php echo $GetPropertyDetail["block_name"];?></td>
                    <td><?php echo $GetPropertyDetail["building_no"];?></td>
                     <td><?php echo $GetPropertyDetail["floor_name"];?></td>
                     <td><?php echo PropertyTypeById($GetPropertyDetail["property_type"]);?></td>
                      <td><a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($ListOfPendingCharges["tenant_id"], 2, $objBF).'&mbi='.EncData($ListOfPendingCharges["generate_bill_id"], 2, $objBF);?>" target="new">View</a></td>
                      <?php /*
                      <td>
                     <a href="<?php echo Route::_('show=pendingcoll&i='.EncData($ListOfPendingCharges["generate_bill_id"], 2, $objBF).'&b='.EncData($ListOfPendingCharges["monthly_rent_id"], 2, $objBF).'&t='.EncData($ListOfPendingCharges["tenant_id"], 2, $objBF).'&m='.EncData('novbill', 2, $objBF));?>" data-price="Rs.<?php echo $ListOfPendingCharges["within_monthly_rent"];?>" data-title="<?php echo $TenantName;?>" class="paidbill">Paid</a>
                     </td> */ ?>
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
                    <td><a href="<?php echo Route::_('show=pendingcoll&i='.EncData($ListofGen["generate_bill_id"], 2, $objBF));?>">View</a></td>                     
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