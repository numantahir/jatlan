<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Yearly Leave's Management</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=yearlyleaveform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Yearly Leave Name</th>
                    <th>Number of Leave's</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Yearly Leave Name</th>
                    <th>Number of Leave's</th>
                    <th>Type</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'yearly_leave_name');
                    $objQayaduser->lstYearlyLeaveType();
                    while($YearlyLeavesList = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $YearlyLeavesList["yearly_leave_name"];?></td>
                    <td><?php echo $YearlyLeavesList["number_of_leave"];?></td>
                    <td><?php echo YearlyLeaveType($YearlyLeavesList["yearly_leave_type"]);?></td>
                    <td><a href="<?php echo Route::_('show=yearlyleaveform&i='.EncData($YearlyLeavesList["yearly_leave_type_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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