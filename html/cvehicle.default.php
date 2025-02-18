<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <div class="card">
      <div class="card-header card-header-text" data-background-color="rose">
          <h4 class="card-title"><?php echo 'Current Vehicle';?></h4>
        </div><br /><br />
        <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Vehicle #</th>
                    <th>Type</th>
                    <th>Source</th>
                    <th>Capacity</th>
                    <th>Assign To</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					$objSSSVehicleType = new SSSjatlan;
					$objSSSAssignTo = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("vechile_id", $OrderDetail["vechile_id"]);
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstVehicle();
                    $VehicleList = $objSSSjatlan->dbFetchArray(1);
						
						$objSSSVehicleType->resetProperty();
						$objSSSVehicleType->setProperty("vechile_type_id", $VehicleList["vehicle_type_id"]);
						$objSSSVehicleType->setProperty("isNot", 3);
						$objSSSVehicleType->lstVehicleType();
						$VehicleType = $objSSSVehicleType->dbFetchArray(1);
						
						$objSSSVehicleType->resetProperty();
						$objSSSVehicleType->setProperty("vehicle_id", $VehicleList["vehicle_id"]);
						$objSSSVehicleType->setProperty("isActive", 1);
						$objSSSVehicleType->lstVehicleAssignDriver();
						$DriverDetail = $objSSSVehicleType->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo $VehicleList["vehicle_number"];?></td>
                    <td><?php echo $VehicleType["type_name"];?></td>
                    <td><?php echo VehicleSource($VehicleList["vehicle_source"]);?></td>
                    <td><?php echo $VehicleList["loading_capacity"];?></td>
                    <td><?php echo $DriverDetail["user_fname"].' '.$DriverDetail["user_lname"];?></td>
                  </tr>
                </tbody>
              </table>
      </div>
      <hr />
        <div class="card">
        
        
        
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_id" value="<?php echo $objBF->encrypt($OrderDetail["order_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="driver_id" id="op_driver_id" value="<?php echo $driver_id;?>" />
            <input type="hidden" name="odn" value="<?php echo $OrderDetail["order_no"];?>">
            
            <input type="hidden" name="ovn" value="<?php echo $VehicleList["vehicle_number"];?>">
            
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Change Order Vehicle';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=uporders&i='.EncData($OrderDetail["order_id"], 2, $objBF));?>" class="btn">Back</a> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Select Vehicle</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" required name="vechile_id" id="op_vehicle_selection" title="Select Vehicle" tabindex="1">
                        <?php echo $objSSSjatlan->ChangeVehicleInOrderCombo($OrderDetail["vechile_id"]);?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Number</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_number" id="op_number" value="<?php echo $no_of_items;?>" tabindex="2" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Name</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_name" id="op_name" value="<?php echo $no_of_items;?>" tabindex="3" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Type</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_type" id="op_type" value="<?php echo $no_of_items;?>" tabindex="4" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Capacity</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_capacity" id="op_capacity" value="<?php echo $no_of_items;?>" tabindex="5" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Driver</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_driver" id="op_driver" value="<?php echo $no_of_items;?>" tabindex="6" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Source</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" readonly="readonly" name="op_source" id="op_source" value="<?php echo $no_of_items;?>" tabindex="7" />
                    </div>
                  </div>
                </div>
               
                <div class="card-footer text-center col-md-12">
                  <button type="submit" class="btn btn-rose btn-fill" tabindex="10">Update Order Vehicle</button>
                  <button type="reset" class="btn btn-fill">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
