<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Pending Charges Request</h3>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Tenant Name</th>
                    <th>Tenant Shop</th>
                    <th>Tenant Code</th>
                    <th>M/Y</th>
                    <th>Due Date</th>
                    <th>Charges</th>
                    <th>Arrears</th>
                    <th>Approved</th>
                    <th>Reject</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					//$objSSSinventory->setProperty("generate_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
					$objSSSinventory->setProperty("rent_status", 3);
					$objSSSinventory->lstMonthlyRent();
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
                    <td><a href="<?php echo Route::_('show=lsttenants&i='.EncData($GetTenantDetail["tenant_id"], 2, $objBF));?>" target="new"><?php echo $GetTenantDetail["tenant_code"];?></a></td>
                    <td><?php echo MonthList($ListOfPendingCharges["rent_of_month"]).'/'.$ListOfPendingCharges["rent_year"];?></td>
                    <td><?php echo dateFormate_3($ListOfPendingCharges["due_date"]);?></td>
                    <td><?php echo $ListOfPendingCharges["within_monthly_rent"];?></td>
                    <td><?php echo $ListOfPendingCharges["arrears_rent"];?></td>
                     <td><a href="<?php echo Route::_('show=lstpendingrequest&i='.EncData($ListOfPendingCharges["generate_bill_id"], 2, $objBF).'&b='.EncData($ListOfPendingCharges["monthly_rent_id"], 2, $objBF).'&t='.EncData($ListOfPendingCharges["tenant_id"], 2, $objBF).'&ms='.EncData('approved', 2, $objBF));?>" data-price="Rs.<?php echo $ListOfPendingCharges["within_monthly_rent"];?>" data-title="<?php echo $TenantName;?>" class="paidbill">Approved</a>
                     </td>
                     
                     <td><a href="<?php echo Route::_('show=lstpendingrequest&i='.EncData($ListOfPendingCharges["generate_bill_id"], 2, $objBF).'&b='.EncData($ListOfPendingCharges["monthly_rent_id"], 2, $objBF).'&t='.EncData($ListOfPendingCharges["tenant_id"], 2, $objBF).'&ms='.EncData('reject', 2, $objBF));?>" data-price="Rs.<?php echo $ListOfPendingCharges["within_monthly_rent"];?>" data-title="<?php echo $TenantName;?>" class="paidbill">Reject</a>
                     </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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