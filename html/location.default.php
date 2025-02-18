<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Destination / Location Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=locationform');?>" class="btn btn-primary">Add New</a> </div>
        <div class="card">
          <!--<div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>-->
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Delivery Charges</th>
                    <th>Unloading Charges</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'location_name');
					$objSSSjatlan->setProperty("isNot", 3);
                    $objSSSjatlan->lstLocation();
					//$GetList = $objQayaduser->SQLTestFunc();
					//print_r($GetList);
					//die();
                    while($Location = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $Location["location_name"];?></td>
                    <td><?php echo RsAmount($Location["deliver_chagres"]);?></td>
                    <td><?php echo RsAmount($Location["unloading_charges"]);?></td>
                    <td><?php echo StatusName($Location["isActive"]);?></td>
                    <td><a href="<?php echo Route::_('show=locationform&i='.EncData($Location["location_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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