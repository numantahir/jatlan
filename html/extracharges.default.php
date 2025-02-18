<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Extra Tenant Charges</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=extcform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Title</th>
                    <th>Charges</th>
                    <th>Tenant</th>
                    <th>Shop</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantName = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'extra_charges_id DESC');
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->lstTenantExtraCharges();
					while($ListofExtraCharges = $objSSSinventory->dbFetchArray(1)){

				?>
                  <tr>
                    <td><?php echo $ListofExtraCharges["extra_title"];?></td>
                    <td><?php echo $ListofExtraCharges["extra_charges"];?></td>
                    <td><?php echo $objSSSTenantName->GetTenantFullName($ListofExtraCharges["tenant_id"]);?></td>
                     <td><?php echo $objSSSTenantName->GetTenantShopName($ListofExtraCharges["tenant_id"]);?></td>
                    <td><?php echo ExtraChargesType($ListofExtraCharges["extra_type"]);
						if($ListofExtraCharges["extra_type"] == 2){
						echo '<br><code>'.ExtraChargesStatus($ListofExtraCharges["type_status"]).'</code>';	
						}
					?></td>
                    <td><?php echo StatusName($ListofExtraCharges["isActive"]);?></td>
                    <td><a href="<?php echo Route::_('show=extcform&i='.EncData($ListofExtraCharges["extra_charges_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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