<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Mobil Oil Supplier Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=mobiloilform');?>" class="btn btn-primary">Add New</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Person Name</th>
                    <th>Contact#</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'vehicle_exp_id');
					$objSSSjatlan->setProperty("option_type", 2);
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstVehicleExpSupplier();
                    while($SupplierList = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $SupplierList["exp_title"];?></td>
                    <td><?php echo $SupplierList["supplier_name"];?></td>
                    <td><?php echo $SupplierList["supplier_contact_no"];?></td>
                    <td><?php echo $SupplierList["supplier_location"];?></td>
                    <td><?php echo StatusName($SupplierList["isActive"]);?></td>
                    <td><a href="<?php echo Route::_('show=mobiloilform&i='.EncData($SupplierList["vehicle_exp_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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