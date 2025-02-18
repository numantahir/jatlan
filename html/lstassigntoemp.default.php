<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
          <?php if(trim(DecData($_GET["i"], 1, $objBF)) !='' && trim(DecData($_GET["v"], 1, $objBF)) == 'blocks'){
			  
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objQayaduser->lstUsers();
					$RequestedUser = $objQayaduser->dbFetchArray(1);
			  ?>
          <h3 class="card-title CardWidth">List of <?php echo $RequestedUser["fullname"];?> Properties</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=assigntoemp');?>" class="btn btn-primary">Assign</a> </div>
          <?php } else { ?>
            <h3 class="card-title CardWidth">List of Assign to Employee Properties</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=assigntoemp');?>" class="btn btn-primary">Assign</a> </div>
            <?php } ?>
            <hr>
            <div class="material-datatables">
            <?php if(trim(DecData($_GET["i"], 1, $objBF)) !='' && trim(DecData($_GET["v"], 1, $objBF)) == 'blocks'){ ?>
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Block Name</th>
                    <th>No. of Properties</th>
                    <th class="disabled-sorting text-right">Reassign</th>
                  </tr>
                </thead>
                <tbody>
                <?php
						$objSSSBlockName = new SSSinventory;
						$objSSSPropertyCounter = new SSSinventory;
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("employee_id", trim(DecData($_GET["i"], 1, $objBF)));
						$objSSSinventory->setProperty("GROUPBY", 'block_id');
						$objSSSinventory->lstAssignToEmployeeProperty();
						while($ListofBlocks = $objSSSinventory->dbFetchArray(1)){
							
							$objSSSBlockName->resetProperty();
							$objSSSBlockName->setProperty("block_id", $ListofBlocks["block_id"]);
							$objSSSBlockName->lstBlocks();
							$GetBlockName = $objSSSBlockName->dbFetchArray(1);
							
							$objSSSPropertyCounter->resetProperty();
							$objSSSPropertyCounter->setProperty("block_id", $ListofBlocks["block_id"]);
							$objSSSPropertyCounter->lstAssignToEmployeeProperty();
							$CountPropertiesBlock = $objSSSPropertyCounter->totalRecords();
				?>
                  <tr>
                    <td><?php echo $GetBlockName["block_name"];?></td>
                    <td><?php echo $CountPropertiesBlock;?></td>
                    <td class="td-actions text-right">
                     <a title="Re-Assigned This Block" href="<?php echo Route::_('show=reassignblock&i='.EncData($ListofBlocks["employee_id"], 2, $objBF).'&b='.EncData($ListofBlocks["block_id"], 2, $objBF));?>">Reassign</a>
					</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } else { ?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Phone #</th>
                    <th>No. of Block</th>
                    <th class="disabled-sorting text-right">View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("isNot", 3);
					$objQayaduser->setProperty("user_type_id", 4);
					$objQayaduser->setProperty("ORDERBY", 'user_fname DESC');
					$objQayaduser->lstUsers();
					while($ListOfUsers = $objQayaduser->dbFetchArray(1)){
						
						$objSSSinventory->resetProperty();
						$objSSSinventory->setProperty("employee_id", $ListOfUsers["user_id"]);
						$objSSSinventory->setProperty("GROUPBY", 'block_id');
						$objSSSinventory->lstAssignToEmployeeProperty();
						$CountNoOfProperties = $objSSSinventory->totalRecords();
						//lstAssignToEmployeeProperty
						//$CountEmailAddress = $objUserUsername->totalRecords();
				?>
                  <tr>
                    <td><?php echo $ListOfUsers["fullname"];?></td>
                    <td><?php echo $ListOfUsers["user_mobile"];?></td>
                     <td><?php echo $CountNoOfProperties;?></td>
                    <td class="td-actions text-right">
                     <a title="View Assigned Blocks" href="<?php echo Route::_('show=lstassigntoemp&i='.EncData($ListOfUsers["user_id"], 2, $objBF).'&v='.EncData('blocks', 2, $objBF));?>">View</a>
					</td>
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