<?php
$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", trim(DecData($_GET["agi"], 1, $objBF)));
$objQayaduser->lstUsers();
$GetAgentInfo = $objQayaduser->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Change / Delete Option of (<?php echo $GetAgentInfo["fullname"];?>)</h4>
            <hr>
            
            
            <?php if(trim(DecData($_GET["md"], 1, $objBF)) == 'showoption'){ ?>
            <div class="col-md-4 col-md-offset-1">
                <div class="card">
                	<a href="<?php echo Route::_('show=agoption&md='.EncData('change', 2, $objBF).'&agi='.EncData($GetAgentInfo["user_id"], 2, $objBF));?>">
                    <div class="card-content text-center">
                        <code>Change Team Lead</code>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div class="card">
                	<a href="<?php echo Route::_('show=agoption&md='.EncData('remove', 2, $objBF).'&agi='.EncData($GetAgentInfo["user_id"], 2, $objBF));?>">
                    <div class="card-content text-center">
                        <code>Remove</code>
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
                    <th>Status</th>
                    <th>Set Team Lead</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("location_id", $objQayaduser->location_id);
					$objQayaduser->setProperty("teamlead_status", 2);
                    $objQayaduser->lstUsers();
                    while($UserList = $objQayaduser->dbFetchArray(1)){
						if($GetAgentInfo["teamlead_id"] == $UserList["user_id"]){
							$PassStatus = 'Current';
						} else {
							$PassStatus = 'New';
						}
                    ?>
                  <tr>
                    <td><?php echo $UserList["fullname"];?></td>
                    <td><?php echo $UserList["user_mobile"];?></td>
                    <td><?php echo $PassStatus;?></td>
                    <td>
                    <?php if($GetAgentInfo["teamlead_id"] == $UserList["user_id"]){ echo "Team Lead"; } else { ?>
                    
                    <a href="<?php echo Route::_('show=agoption&md='.EncData('change_teamlead', 2, $objBF).'&tli='.EncData($UserList["user_id"], 2, $objBF).'&agi='.EncData($GetAgentInfo["user_id"], 2, $objBF));?>">Set Team Lead</a>
                    <?php } ?>
                    </td>
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