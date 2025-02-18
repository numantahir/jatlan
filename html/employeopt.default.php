<?php
$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
$objQayaduser->lstUsers();
$EmployeData = $objQayaduser->dbFetchArray(1);

$objQayaduser->resetProperty();
$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
$objQayaduser->lstUserDeviceList();
if($objQayaduser->totalRecords() > 0){
$AgentMobileCode = $objQayaduser->dbFetchArray(1);
$AgentMobileRegCode = '<code>'.$AgentMobileCode["security_code"].'</code>';
} else {
$AgentMobileRegCode = '';	
}
?>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth"><?php echo $EmployeData["fullname"];?> Employee Section <?php echo $AgentMobileRegCode;?></h3>
            <div class="toolbar add-btn text-right"></div>
            <hr>
            <div class="material-datatables">
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employeform&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Edit Basic Profile</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employeojobdetail&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Edit Organization</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employeedu&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Add/Edit Education</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employmenthistory&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Add/Edit Employment History</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employereference&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Add/Edit Reference</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employeskills&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Add/Edit Skill's</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employemrgncy&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Add/Edit Emergency Number's</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employbank&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Add/Edit Bank Account Detail</code> </div>
                  </a> </div>
              </div>
              <hr>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employeshift&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Assign Shift</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employesalary&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Employee Salary</code> </div>
                  </a> </div>
              </div>
              <div class="col-xs-4">
                <div class="card"> <a href="<?php echo Route::_('show=employebonus&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                  <div class="card-content text-center"> <code>Employee Bonus</code> </div>
                  </a> </div>
              </div>
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
