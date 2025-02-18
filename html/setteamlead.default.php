<?php
$objQayaduser->resetProperty();
$objQayaduser->setProperty("location_id", trim(DecData($_GET["li"], 1, $objBF)));
$objQayaduser->lstLocation();
$GetLocationDetail = $objQayaduser->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">
            List of (<?php echo $GetLocationDetail["location_name"];?>) Agent's
            </h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=setteamlead');?>" class="btn btn-primary">Change/New Team Lead</a> </div>
            <hr>
           
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Agent Name</th>
                    <th>Phone Number</th>
                    <th>Set Team Lead</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("location_id", trim(DecData($_GET["li"], 1, $objBF)));
					$objQayaduser->setProperty("user_type_id", 4);
					$objQayaduser->setProperty("teamlead_status", 1);
					$objQayaduser->setProperty("teamlead_id_zero", 1);
                    $objQayaduser->lstUsers();
                    while($UserList = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $UserList["fullname"];?></td>
                    <td><?php echo $UserList["user_mobile"];?></td>
                    <td><a href="<?php echo Route::_('show=setteamlead&mode='.EncData('add_teamlead', 2, $objBF).'&ui='.EncData($UserList["user_id"], 2, $objBF).'&li='.EncData($GetLocationDetail["location_id"], 2, $objBF));?>">Set Team Lead</a></td>
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