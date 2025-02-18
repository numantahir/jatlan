<?php
$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
$objQayaduser->lstUsers();
$EmployeData = $objQayaduser->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><?php echo $EmployeData["fullname"];?> skill List</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=employeskillform&i='.$_GET["i"]);?>" class="btn btn-primary">Add New</a> </div>
            <div class="toolbar btn-back text-right" style="margin-top:-44px;"> <a href="<?php echo Route::_('show=employeopt&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Skill</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Skill</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
                    $objQayaduser->setProperty("ORDERBY", 'skills');
                    $objQayaduser->lstUserSkills();
                    while($Skilllist = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $Skilllist["skills"];?></td>
                    <td><a href="<?php echo Route::_('show=employeskillform&i='.$_GET["i"].'&ei='.EncData($Skilllist["user_skills_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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