<?php
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", trim(DecData($_GET["tli"], 1, $objBF)));
$objQayaduser->lstUsers();
$GetTeamLeadInfo = $objQayaduser->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Agents of (<?php echo $GetTeamLeadInfo["fullname"];?>)</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=newagents&tli='.EncData($GetTeamLeadInfo["user_id"], 2, $objBF));?>" class="btn btn-primary">Add New Agents</a> </div>
            <hr>
            
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Agent Name</th>
                    <th>Phone Number</th>
                    <th>Move/Remove</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("teamlead_id", trim(DecData($_GET["tli"], 1, $objBF)));
					$objQayaduser->setProperty("user_type_id", 4);
					$objQayaduser->setProperty("teamlead_status", 1);
                    $objQayaduser->lstUsers();
                    while($UserList = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $UserList["fullname"];?></td>
                    <td><?php echo $UserList["user_mobile"];?></td>
                    <td><a href="<?php echo Route::_('show=agoption&md='.EncData('showoption', 2, $objBF).'&agi='.EncData($UserList["user_id"], 2, $objBF));?>">Move/Remove</a></td>
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