<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Shift's Management</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=shiftform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                      <th>Shift Name</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>LIGT</th>
                      <th>LOGT</th>
                      <th>EOGT</th>
                      <th>LI 25%</th>
                      <th>LI 50%</th>
                      <th> > LI 100%</th>
                      <th>EO 10%</th>
                      <th>EO 25%</th>
                      <th>EO 50%</th>
                      <th>EO 100%</th>
                      <th>LIGT/EOGT</th>
                      <th>Action</th>
                    </tr>
                </thead>
                
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'shift_name');
                    $objQayaduser->lstShifts();
                    while($ShitDetail = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $ShitDetail["shift_name"];?></td>
                        <td><?php echo $ShitDetail["shift_st"];?></td>
                        <td><?php echo $ShitDetail["shift_et"];?></td>
                        <td><?php echo $ShitDetail["shift_ligt"];?>Mins</td>
                        <td><?php echo $ShitDetail["shift_logt"];?>Mins</td>
                        <td><?php echo $ShitDetail["shift_eogt"];?>Mins</td>
                        <td><?php echo $ShitDetail["qutr_late_in"];?>Mins</td>
                        <td><?php echo $ShitDetail["half_late_in"];?>Mins</td>
                        <td>> <?php echo $ShitDetail["full_late_in"];?>Mins</td>
                        <td><?php echo $ShitDetail["ten_off_bef_start"].' > '.$ShitDetail["ten_off_bef_end"];?></td>
                        <td><?php echo $ShitDetail["qutr_off_bef_start"].' > '.$ShitDetail["qutr_off_bef_end"];?></td>
                        <td><?php echo $ShitDetail["half_off_bef_start"].' > '.$ShitDetail["half_off_bef_end"];?></td>
                        <td>> <?php echo $ShitDetail["full_off_bef"];?></td>
                    	<td><?php echo StatusName($ShitDetail["ligt_status"]) .'/'.StatusName($ShitDetail["eogt_status"]);?></td>
                    <td><a href="<?php echo Route::_('show=shiftform&i='.EncData($ShitDetail["shift_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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