<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">notes</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">User Log</h4>
            <div class="toolbar"> </div>
            <hr>
            <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>User</th>
                    <th>Log Detail</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>User</th>
                    <th>Log Detail</th>
                    <th>Date</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
				  	$objQayaduser->resetProperty();
					$objQayaduserInfo = new Qayaduser;
					$objQayaduser->setProperty("ORDERBY", 'log_id DESC');
					$objQayaduser->setProperty("limit", '50');
					$objQayaduser->lstUserLog();
					while($LogList = $objQayaduser->dbFetchArray(1)){
						$objQayaduserInfo->setProperty("user_id", $LogList["user_id"]);
						$objQayaduserInfo->lstUsers();
						$GetUserName = $objQayaduserInfo->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php echo $GetUserName["user_fname"].' '.$GetUserName["user_lname"];?></td>
                        <td><?php echo $LogList["activity_detail"];?></td>
                        <td><?php echo dateFormate_4($LogList["entery_date"]);?></td>
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
