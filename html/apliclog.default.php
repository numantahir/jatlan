<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">notes</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Application Log</h4>
            <div class="toolbar"> </div>
            <hr>
            <div class="material-datatables">
              <table class="table">
                  	<thead>
                    	<tr>
                        	<th class="text-left">Aplic#</th>
                            <th class="text-left">Customer Name</th>
                            <th class="text-left">User Name</th>
                            <th class="text-left">Activity</th>
                            <th class="text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                    $objQayadapplication->resetProperty();
					$objQayadapplication->setProperty("limit", 50);
					$objQayadapplication->setProperty("ORDERBY", 'log_id DESC');
                    $objQayadapplication->lstApplicationLog();
                    while($TransactionLogDetail = $objQayadapplication->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $TransactionLogDetail["reg_number"];?></td>
                        <td class="text-left"><?php echo $TransactionLogDetail["customer_fullname"];?></td>
                        <td class="text-left"><?php echo $TransactionLogDetail["user_fullname"];?></td>
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
