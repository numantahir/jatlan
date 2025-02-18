<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Collection Batch</h3>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Batch No.</th>
                    <th>Batch Date</th>
                    <th>Batch Amount</th>
                    <th>Batch Status</th>
                    <th>Submition Date</th>
                    <th>Received Date</th>
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
					$objSSSinventory->setProperty("batch_status", 3);
					$objSSSinventory->lstBatchList();
					while($ListofBatch = $objSSSinventory->dbFetchArray(1)){

				?>
                  <tr>
                    <td><?php echo $ListofBatch["batch_code"];?></td>
                    <td><?php echo dateFormate_3($ListofBatch["batch_date"]);?></td>
                    <td>Rs.<?php echo $ListofBatch["received_amount"];?></td>
                    <td><?php echo BatchStatus($ListofBatch["batch_status"]);?></td>
                    <td><?php echo dateFormate_9($ListofBatch["batch_fwd_date"]);?></td>
                    <td><?php echo dateFormate_9($ListofBatch["batch_fwd_rec_date"]);?></td>

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