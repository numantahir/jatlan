<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">User Request Flow Structure Management</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=deprequestflowform');?>" class="btn btn-primary">Modification</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Type</th>
                    <th>Company / Department</th>
                    <th>For Leave Request</th>
                    <th>For Payment Request</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				//GetLocation
					$objGetComDepartInfo = new Qayaduser;
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("request_flow_type", 1);
					$objQayaduser->setProperty("ORDERBY", 'request_flow_id DESC');
					$objQayaduser->lstUserRequestFlow();
					while($RequestFlow = $objQayaduser->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo RequestFlowType($RequestFlow["request_flow_type"]);?></td>
                    <td><?php echo $objGetComDepartInfo->GetComDeptInfo($RequestFlow["department_id"]);?></td>
                    <td><?php echo $objGetComDepartInfo->GetUserFullName($RequestFlow["leave_request_to"]);?></td>
                    <td><?php echo $objGetComDepartInfo->GetUserFullName($RequestFlow["overtime_request_to"]);?></td>
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