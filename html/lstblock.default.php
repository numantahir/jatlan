<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Block Management</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=lstblockform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Total (Units)</th>
                    <th>Ocpd (Units)</th>
                    <th>Vcnt (Units)</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Actions</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTotalUnits = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'block_id');
					$objSSSinventory->lstBlocks();
					while($ListOfBlocks = $objSSSinventory->dbFetchArray(1)){
						$objSSSTotalUnits->resetProperty();
				?>
                  <tr>
                    <td><?php echo $ListOfBlocks["block_name"];?></td>
                    <td><?php echo $objSSSTotalUnits->GetTotalUnitCounter($ListOfBlocks["block_id"]);?></td>
                    <td> <a href="<?php echo Route::_('show=lstoccupiedpro&b='.EncData($ListOfBlocks["block_id"], 2, $objBF).'&t='.EncData('1', 2, $objBF));?>"><?php echo $objSSSTotalUnits->GetTotalOcpdUnitCounter($ListOfBlocks["block_id"]);?></a></td>
                    <td> <a href="<?php echo Route::_('show=lstvacantpro&b='.EncData($ListOfBlocks["block_id"], 2, $objBF).'&t='.EncData('2', 2, $objBF));?>"><?php echo $objSSSTotalUnits->GetTotalVcntUnitCounter($ListOfBlocks["block_id"]);?></a></td>
                    <td><?php echo StatusName($ListOfBlocks["isActive"]);?></td>
                    <td class="td-actions text-right">
                    <a href="<?php echo Route::_('show=lstblockform&i='.EncData($ListOfBlocks["block_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit"> <i class="material-icons">edit</i> </a>
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