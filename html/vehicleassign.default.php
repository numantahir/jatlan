<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Vehicle (<code><?php echo $VehicleDetail["vehicle_number"];?></code>) Driver Management</h3>
       <div class="toolbar add-btn text-right mt-50px">  </div>
        <div class="card">
        <div class="card-content">
      	 <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="vehicle_assign_id" value="<?php echo $objBF->encrypt($VehicleDriver["vehicle_assign_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="vehicle_id" value="<?php echo $objBF->encrypt($VehicleDetail["vehicle_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="cdi" value="<?php echo $objBF->encrypt($driver_id, ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Select Driver';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=vehicletype');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
           
           <div class="row">
              <label class="col-sm-2 label-on-left">List of Drivers</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="driver_id" title="List of Drivers" tabindex="1">
                  <?php
				 	$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("user_type_id", 4);
					$objQayaduser->setProperty("ORDERBY", 'user_fname DESC');
					$objQayaduser->lstUsers();
					while($ListOfUsers = $objQayaduser->dbFetchArray(1)){
						if($ListOfUsers["user_id"] == $VehicleDriver["driver_id"]){
							$SelectedCurrentDriver = ' selected';
						} else {
							$SelectedCurrentDriver = '';
						}
				  ?>
                    <option value="<?php echo $ListOfUsers["user_id"];?>" <?php echo $SelectedCurrentDriver;?>><?php echo $ListOfUsers["fullname"];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="2">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
          
          </div>
       </div>
        <div class="card">
        
        
          
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Driver Name</th>
                    <th>Assign Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					$objSSSVehicleType = new SSSjatlan;
					$objSSSAssignTo = new SSSjatlan;
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("vehicle_id", $VehicleDetail['vehicle_id']);
                    $objSSSjatlan->setProperty("ORDERBY", 'vehicle_id');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstVehicleAssignDriver();
                    while($VehicleAssigned = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $VehicleAssigned["user_fname"].' '.$VehicleAssigned["user_lname"];?></td>
                    <td><?php echo dateFormate_4($VehicleAssigned["entery_date"]);?></td>
                    <td><?php echo StatusName($VehicleAssigned["isActive"]);?></td>
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