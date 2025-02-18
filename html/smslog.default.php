<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">notes</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">SMS Log</h4>
            <div class="toolbar"> </div>
            <hr>
            <div class="material-datatables">
              <table class="table">
                  	<thead>
                    	<tr>
                            <th class="text-left">Send To</th>
                            <th class="text-left">Title</th>
                            <th class="text-left">Message</th>
                            <th class="text-center">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                     <?php
                    $objQayadsms->resetProperty();
					$objQayadsms->setProperty("limit", 100);
					$objQayadsms->setProperty("ORDERBY", 'sms_send_log_id DESC');
                    $objQayadsms->lstSMSSendingLog();
                    while($SMSSendingLogDetail = $objQayadsms->dbFetchArray(1)){
                    ?>
                      <tr>
                        <td class="text-left"><?php echo $SMSSendingLogDetail["sms_send_to"];?></td>
                        <td class="text-left"><?php echo $SMSSendingLogDetail["sms_send_for"];?></td>
                        <td class="text-left"><?php echo $SMSSendingLogDetail["sms_text_msg"];?></td>
                        <td class="text-center"><?php echo dateFormate_4($SMSSendingLogDetail["sms_send_at"]);?></td>
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
