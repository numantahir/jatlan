<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Building Management</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=lstbuildingform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Block</th>
                    <th>Building No.</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSBlockDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'building_id');
					$objSSSinventory->lstBuildings();
					while($ListOfBuilding = $objSSSinventory->dbFetchArray(1)){
						
					$objSSSBlockDetail->resetProperty();
					$objSSSBlockDetail->setProperty("block_id", $ListOfBuilding["block_id"]);
					$objSSSBlockDetail->lstBlocks();
					$GetBlockDetail = $objSSSBlockDetail->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php echo $GetBlockDetail["block_name"];?></td>
                    <td><?php echo $ListOfBuilding["building_no"];?></td>
                    <td><?php echo StatusName($ListOfBuilding["isActive"]);?></td>
                    <td class="td-actions text-right">
                    <a href="<?php echo Route::_('show=lstbuildingform&i='.EncData($ListOfBuilding["building_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit"> <i class="material-icons">edit</i> </a>
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