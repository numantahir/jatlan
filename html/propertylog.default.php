<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Property Log</h4>
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
					$objQayadProerty->setProperty("ORDERBY", 'property_log_id DESC');
					$objQayadProerty->setProperty("limit", '100');
					$objQayadProerty->lstPropertyLog();
					while($LogList = $objQayadProerty->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo $LogList["fullname"];?></td>
                    <td><?php echo $LogList["log_desc"];?></td>
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
