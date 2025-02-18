<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">Agent Migration History</h3>
            <div class="toolbar add-btn text-right"> <a href="<?php echo Route::_('show=migrationform');?>" class="btn btn-primary">New Migration</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Agent Name</th>
                    <th>Migrate From</th>
                    <th>Migrate To</th>
                    <th>Migration Reason</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Agent Name</th>
                    <th>Migrate From</th>
                    <th>Migrate To</th>
                    <th>Migration Reason</th>
                    <th>Date</th>
                  </tr>
                </tfoot>
                <tbody>
                <?php
					$objQayadGetUser = new Qayaduser;
					$objQayadLocationFrom = new Qayaduser;
					$objQayadLocationTo = new Qayaduser;
					$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
					$objQayaduser->setProperty("ORDERBY", 'migration_id DESC');
					$objQayaduser->lstUserMigration();
					while($ListOfMigration = $objQayaduser->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo $objQayadGetUser->GetUserFullName($ListOfMigration["migration_user_id"]);?></td>
                    <td><?php echo $objQayadLocationFrom->GetLocation($ListOfMigration["current_location_id"]);?></td>
                    <td><?php echo $objQayadLocationTo->GetLocation($ListOfMigration["migration_location_id"]);?></td>
                    <td><?php echo $ListOfMigration["migration_reason"];?></td>
                    <td><?php echo dateFormate_3($ListOfMigration["migration_date"]);?></td>
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