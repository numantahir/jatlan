<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">notes</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Account Log</h4>
            <div class="toolbar"> </div>
            <hr>
            <div class="material-datatables">
              <table class="table">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Name</th>
                            <th class="text-left">Activity</th>
                            <th class="text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                    $objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("limit", 100);
					$objQayadaccount->setProperty("ORDERBY", 'account_log_id DESC');
                    $objQayadaccount->lstAccountLog();
                    while($TransactionLogDetail = $objQayadaccount->dbFetchArray(1)){
							$objQayaduser->setProperty("user_id", $TransactionLogDetail["user_id"]);
							$objQayaduser->lstUsers();
							$GetUserName = $objQayaduser->dbFetchArray(1);
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $GetUserName["user_fname"].' '.$GetUserName["user_lname"];?></td>
                        <td class="text-left"><?php echo $TransactionLogDetail["log_desc"];?></td>
                        <td class="text-center"><?php echo dateFormate_4($TransactionLogDetail["entery_date"]);?></td>
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
