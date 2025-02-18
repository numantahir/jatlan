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
            <h4 class="card-title CardWidth">Change / Delete Option of (<?php echo $GetTeamLeadInfo["fullname"];?>)</h4>
            <hr>
            
            
            <?php if(trim(DecData($_GET["md"], 1, $objBF)) == ''){ ?>
            <div class="col-md-4 col-md-offset-1">
                <div class="card">
                	<a href="<?php echo Route::_('show=tloption&md='.EncData('change', 2, $objBF).'&tli='.EncData($GetTeamLeadInfo["user_id"], 2, $objBF));?>">
                    <div class="card-content text-center">
                        <code>Change Team Lead</code>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="card">
                	<a href="<?php echo Route::_('show=setteamlead&mode='.EncData('remove', 2, $objBF).'&ui='.EncData($GetTeamLeadInfo["user_id"], 2, $objBF));?>">
                    <div class="card-content text-center">
                        <code>Remove Team Lead</code>
                    </div>
                    </a>
                </div>
            </div>
            <?php } elseif(trim(DecData($_GET["md"], 1, $objBF)) == 'change'){ ?>
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
					$objQayaduser->setProperty("location_id", $objQayaduser->location_id);
					$objQayaduser->setProperty("user_type_id", 4);
					$objQayaduser->setProperty("teamlead_status", 1);
                    $objQayaduser->lstUsers();
                    while($UserList = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $UserList["fullname"];?></td>
                    <td><?php echo $UserList["user_mobile"];?></td>
                    <td><a href="<?php echo Route::_('show=setteamlead&mode='.EncData('change_teamlead', 2, $objBF).'&ui='.EncData($UserList["user_id"], 2, $objBF).'&ci='.EncData($GetTeamLeadInfo["user_id"], 2, $objBF));?>">Set Team Lead</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } ?>
            
            
            
            
            
            
            
            
            
            
            
            
            
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