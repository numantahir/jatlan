<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Property Management</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=lstpropertyform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table class="datatablesbtn table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Block</th>
                    <th>Bldg No.</th>
                    <th>Floor</th>
                    <th>Type</th>
                    <th>Pro No.</th>
                    <th>Pro Code.</th>
                    <th>Monthly</th>
                    <th>T.Status</th>
                    <th>T-Name</th>
                    <th>T-Shop</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSGetTenantInfo = new SSSinventory;
					$objSSSinventory->resetProperty();
					//$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'block_name, building_no, floor_name, property_number');
					$objSSSinventory->lstPropertyBundle();
					while($ListOfProperties = $objSSSinventory->dbFetchArray(1)){
						if($ListOfProperties["tenant_status"] == 1){
						$objSSSGetTenantInfo->resetProperty();
						$objSSSGetTenantInfo->setProperty("tenant_status", 1);
						$objSSSGetTenantInfo->setProperty("property_id", $ListOfProperties["property_id"]);
						$objSSSGetTenantInfo->lstAssignTenantList();
						$GetTenantInfo = $objSSSGetTenantInfo->dbFetchArray(1);
						if($GetTenantInfo["tenant_shop_name"] != ''){
							$AddShopName = 	$GetTenantInfo["tenant_shop_name"];
						} else {
							$AddShopName = 	'';
						}
						$TenantInfoPrint = $GetTenantInfo["tenant_name"];
						} else {
						$TenantInfoPrint = 'Null';
						$AddShopName = 'Null';	
						}
						
				?>
                  <tr>
                    <td><?php echo $ListOfProperties["block_name"];?></td>
                    <td><?php echo $ListOfProperties["building_no"];?></td>
                     <td><?php echo $ListOfProperties["floor_name"];?></td>
                     <td><?php echo PropertyTypeById($ListOfProperties["property_type"]);?></td>
                     <td><?php echo $ListOfProperties["property_number"];?></td>
                     <td><?php echo $ListOfProperties["property_code"];?></td>
                     <td><?php echo $ListOfProperties["monthly_maint"];?></td>
                     <td><?php echo PropertyTenantStatus($ListOfProperties["tenant_status"]);?></td>
                    <td><?php echo $TenantInfoPrint;?></td>
                    <td><?php echo $AddShopName;?></td>
                    <td><?php echo StatusName($ListOfProperties["isActive"]);?></td>
                    <td class="td-actions text-right">
                    <a href="<?php echo Route::_('show=lstpropertyform&i='.EncData($ListOfProperties["property_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit"> <i class="material-icons">edit</i> </a>
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