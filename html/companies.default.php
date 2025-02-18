<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">business</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Companies Management</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=companyform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Company Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Company Name</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'company_name');
                    $objQayaduser->lstCompanies();
                    while($Comapnies = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $Comapnies["company_name"];?></td>
                    <td><?php echo StatusName($Comapnies["isActive"]);?></td>
                    <td><a href="<?php echo Route::_('show=companyform&i='.EncData($Comapnies["company_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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