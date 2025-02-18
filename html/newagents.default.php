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
        <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Add New Agents for (<?php echo $GetTeamLeadInfo["fullname"];?>)</h4>
            <hr>
            
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  <th><input type="checkbox" id="checkAll"></th>
                    <th>Agent Name</th>
                    <th>Phone Number</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("location_id", $objQayaduser->location_id);
					$objQayaduser->setProperty("user_type_id", 4);
					$objQayaduser->setProperty("teamlead_status", 1);
					$objQayaduser->setProperty("teamlead_id_zero", 'YES');
                    $objQayaduser->lstUsers();
					$CountAgentsCurrent = $objQayaduser->totalRecords();
                    while($UserList = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                  <td><input type="checkbox" class="leadscheckbox" name="agents_id[]" required value="<?php echo $UserList["user_id"];?>"></td>
                    <td><?php echo $UserList["fullname"];?></td>
                    <td><?php echo $UserList["user_mobile"];?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <hr>
              
              <div class="row">
              
              <div class="col-sm-5"  id="teamlead_opt">
              <label class="label-on-left">Team Lead Of</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="teamlead_id" required title="Select Team Lead" tabindex="2">
                  	<?php $objQayaduser->resetProperty(); echo $objQayaduser->GetTeamLeadsCombo(trim(DecData($_GET["tli"], 1, $objBF))); ?>
                  </select>
                </div>
              </div>
              
              
              
              
              
            </div>
              
              <?php if($CountAgentsCurrent > 0){?>
              <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            <?php } ?>
            </div>
            
            
          </div>
          <!-- end content--> 
          </form>
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>