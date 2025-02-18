<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Vacant Property Management</h3>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Block</th>
                    <th>Building No.</th>
                    <th>Floor</th>
                    <th>Type</th>
                    <th>Pro No.</th>
                    <th>Pro Code.</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantList = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					if(trim($objBF->decrypt($_GET["b"], 1, ENCRYPTION_KEY)) !=''){
					$objSSSinventory->setProperty("block_id", trim($objBF->decrypt($_GET["b"], 1, ENCRYPTION_KEY)));	
					}	
					$objSSSinventory->setProperty("ORDERBY", 'block_name, building_no, floor_name, property_number');
					$objSSSinventory->setProperty("tenant_status", 2);
					$objSSSinventory->lstPropertyBundle();
					while($ListOfProperties = $objSSSinventory->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo $ListOfProperties["block_name"];?></td>
                    <td><?php echo $ListOfProperties["building_no"];?></td>
                     <td><?php echo $ListOfProperties["floor_name"];?></td>
                     <td><?php echo PropertyTypeById($ListOfProperties["property_type"]);?></td>
                     <td><?php echo $ListOfProperties["property_number"];?></td>
                     <td><?php echo $ListOfProperties["property_code"];?></td>                     
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