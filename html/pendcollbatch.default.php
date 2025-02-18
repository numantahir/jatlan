<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Pending Collection Batch</h3>
            <hr>
            <div class="material-datatables">
            <?php if(trim(DecData($_GET["v"], 1, $objBF)) != 'detail'){?>
            
            <?php if(trim(DecData($_GET["md"], 1, $objBF)) == 'processing'){?>
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Batch No.</th>
                    <th>Batch Date</th>
                    <th>Batch Amount</th>
                    <th>Batch Status</th>
                    <th>Forward Date/Time</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantName = new SSSinventory;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'batch_id DESC');
					$objSSSinventory->setProperty("employee_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
					$objSSSinventory->setProperty("batch_code", $BatchCode);
					$objSSSinventory->setProperty("batch_status", 2);
					$objSSSinventory->lstBatchList();
					while($ListofBatch = $objSSSinventory->dbFetchArray(1)){

				?>
                  <tr>
                    <td><?php echo $ListofBatch["batch_code"];?></td>
                    <td><?php echo dateFormate_3($ListofBatch["batch_date"]);?></td>
                    <td>Rs.<?php echo $ListofBatch["received_amount"];?></td>
                    <td><?php echo BatchStatus($ListofBatch["batch_status"]);?></td>
                    <td><?php echo dateFormate_9($ListofBatch["batch_fwd_date"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php } else { ?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Batch No.</th>
                    <th>Batch Date</th>
                    <th>Batch Amount</th>
                    <th>Batch Status</th>
                    <th>View & Forward</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantName = new SSSinventory;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'batch_id DESC');
					$objSSSinventory->setProperty("employee_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
					$objSSSinventory->setProperty("batch_code", $BatchCode);
					$objSSSinventory->setProperty("batch_status", 1);
					$objSSSinventory->lstBatchList();
					while($ListofBatch = $objSSSinventory->dbFetchArray(1)){

				?>
                  <tr>
                    <td><?php echo $ListofBatch["batch_code"];?></td>
                    <td><?php echo dateFormate_3($ListofBatch["batch_date"]);?></td>
                    <td>Rs.<?php echo $ListofBatch["received_amount"];?></td>
                    <td><?php echo BatchStatus($ListofBatch["batch_status"]);?></td>
                    <td><a href="<?php echo Route::_('show=pendcollbatch&v='.EncData('detail', 2, $objBF).'&i='.EncData($ListofBatch["batch_id"], 2, $objBF));?>">View & Forward</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            
            <?php } } else { 
			
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("employee_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
				$objSSSinventory->setProperty("batch_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->lstBatchList();
				$GetBatchDetail = $objSSSinventory->dbFetchArray(1);
			?>
			
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="bi" value="<?php echo $objBF->encrypt($GetBatchDetail["batch_id"], ENCRYPTION_KEY);?>">
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
           <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <th width="30%">Batch Code: </th>
                    <td width="70%">&nbsp;<?php echo $GetBatchDetail["batch_code"];?></td>
                  </tr>
                  <tr>
                    <th>Batch Amount: </th>
                    <td>&nbsp;Rs.<?php echo $GetBatchDetail["received_amount"];?></td>
                  </tr>
                  <tr>
                    <th>No. of Bills: </th>
                    <td>&nbsp;<?php echo $GetBatchDetail["no_of_bills"];?></td>
                  </tr>
                  <tr>
                    <th>Batch Date: </th>
                    <td>&nbsp;<?php echo dateFormate_3($GetBatchDetail["batch_date"]);?></td>
                  </tr>
                  <tr>
                    <th>Batch Status: </th>
                    <td>&nbsp;<?php echo BatchStatus($GetBatchDetail["batch_status"]);?></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="center"><button type="submit" class="btn btn-rose ">Submit Batch</button></td>
                  </tr>
                </tbody>
              </table>

            </div>
            </div>
          </form>
          <hr />
          <h3 class="card-title CardWidth">List of Batch Enteries</h3>
        <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Property Code</th>
                    <th>Tenant Name</th>
                    <th>Received Amount</th>
                    <th>Entery Date/Time</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objGetPropertyCode = new SSSinventory;
					$objGetTenantName = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("ORDERBY", 'batch_detail_id DESC');
					$objSSSinventory->setProperty("employee_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
					$objSSSinventory->setProperty("batch_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->lstBatchDetailList();
					while($BatchDetail = $objSSSinventory->dbFetchArray(1)){
					$objGetPropertyCode->resetProperty();
					$objGetTenantName->resetProperty();
				?>
                  <tr>
                    <td><?php echo $objGetPropertyCode->GetPropertyCode($BatchDetail["property_id"]);?></td>
                    <td><?php echo $objGetTenantName->GetTenantFullName($BatchDetail["tenant_id"]);?></td>
                    <td>Rs.<?php echo $BatchDetail["received_amount"];?></td>
                    <td><?php echo dateFormate_9($BatchDetail["entery_date"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            <?php  } ?>
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