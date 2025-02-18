<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Project Event Management</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=proeventform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Project Event Title</th>
                    <th>Expected Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Project Event Title</th>
                    <th>Expected Date</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayadProerty->resetProperty();
                    $objQayadProerty->setProperty("ORDERBY", 'project_event_id');
                    $objQayadProerty->lstPropertyProjectEvent();
                    while($ProjectEvent = $objQayadProerty->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $ProjectEvent["event_name"];?></td>
                    <td><?php echo dateFormate_3($ProjectEvent["expected_date"]);?></td>
                    <td><a href="<?php echo Route::_('show=proeventform&i='.EncData($ProjectEvent["project_event_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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