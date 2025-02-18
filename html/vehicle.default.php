<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Vehicle Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=vehicleform');?>" class="btn btn-primary">Add New</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Vehicle #</th>
                    <th>Type</th>
                    <th>Source</th>
                    <th>Capacity</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					$objSSSVehicleType = new SSSjatlan;
					$objSSSAssignTo = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'vehicle_id');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstVehicle();
                    while($VehicleList = $objSSSjatlan->dbFetchArray(1)){
						
						$objSSSVehicleType->resetProperty();
						$objSSSVehicleType->setProperty("vechile_type_id", $VehicleList["vehicle_type_id"]);
						$objSSSVehicleType->setProperty("isNot", 3);
						$objSSSVehicleType->lstVehicleType();
						$VehicleType = $objSSSVehicleType->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo $VehicleList["vehicle_number"];?></td>
                    <td><?php echo $VehicleType["type_name"];?></td>
                    <td><?php echo VehicleSource($VehicleList["vehicle_source"]);?></td>
                    <td><?php echo $VehicleList["loading_capacity"];?></td>
                    <td><?php echo StatusName($VehicleList["isActive"]);?></td>
                    <td><a href="<?php echo Route::_('show=vehicleform&i='.EncData($VehicleList["vehicle_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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