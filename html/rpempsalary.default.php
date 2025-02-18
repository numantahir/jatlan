<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">List of Employee Salary</h4>
            <div class="toolbar btn-back text-right" style="margin-top:-44px;"> <a href="#" onClick="openRequestedPopup('<?php echo SITE_URL;?>empsalry.php');" class="btn">Print</a> </div>
            <hr>
            <div class="material-datatables">
            
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Employee Name</th>
                    <th>Basic Salary</th>
                    <th>House Rent Allowance</th>
                    <th>Utilities</th>
                    <th>Gross Salary</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$GrandTotalNumberofLeaves = 0;
					$TotalOfCurrtingAmountValue =0;
					$WorkingHRPerDay = 8;
					
					$objQayaduser_case_a = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'user_fname');
                    $objQayaduser->lstEmployeeSalaryDetail();
                    while($EmpListSalary = $objQayaduser->dbFetchArray(1)){
						
					$EmployeeMonthlySalary = trim($objBF->decrypt($EmpListSalary["salary_amount"], 1, ENCRYPTION_KEY));
					$EmployeeDailySalary = trim($objBF->decrypt($EmpListSalary["salary_amount"], 1, ENCRYPTION_KEY)) / 30;
					$EmployeeHourlySalary = $EmployeeDailySalary / $WorkingHRPerDay;
					$EmployeeMintuesSalary = $EmployeeHourlySalary / 60;
					$ten_PersentCutting = $EmployeeDailySalary * 0.10;
					$twentyfine_PersentCutting = $EmployeeDailySalary * 0.25;
					$Fifty_PersentCutting = $EmployeeDailySalary * 0.50;
					$Hundred_PersentCutting = $EmployeeDailySalary;
					$EmployeSalayComplete = $EmployeeMonthlySalary;
					$EmployeeWorkingDays = 30;

					if($EmployeSalayComplete > 10000){
					$CountBasicSalary = $EmployeSalayComplete * 66.666 / 100 / 30 * $EmployeeWorkingDays;
					$EmployeeBasicSalaryDetail = round($CountBasicSalary);
					} else {
					$EmployeeBasicSalaryDetail = $EmployeSalayComplete;
					}
					
					if($EmployeSalayComplete > 5000){
					$HouseRent = $EmployeSalayComplete * 26.666 / 100 / 30 * $EmployeeWorkingDays;
					$EmployeeHouseRent = round($HouseRent);
					} else {
					$EmployeeHouseRent = 0;
					}
					
					if($EmployeSalayComplete > 5000){
					$Utilities = $EmployeSalayComplete * 6.666 / 100 / 30 * $EmployeeWorkingDays;
					$EmployeeUtilitiesBills = round($Utilities);
					} else {
					$EmployeeUtilitiesBills = 0;
					}
					
					$EmployeeGrossSalary = $EmployeeBasicSalaryDetail + $EmployeeHouseRent + $EmployeeUtilitiesBills;	
						
                    ?>
                  <tr>
                    <td><?php echo $EmpListSalary["fullname"];?></td>
                    <td><?php echo Salaryformt($EmployeeBasicSalaryDetail);?>/-</td>
                    <td><?php echo Salaryformt($EmployeeHouseRent);?>/-</td>
                    <td><?php echo Salaryformt($EmployeeUtilitiesBills);?>/-</td>
                    <td><?php echo Salaryformt($EmployeeMonthlySalary);?>/-</td>
                  </tr>
                  <?php 
				  		$CountBasicSalary = 0;
						$EmployeeBasicSalaryDetail = 0;
						$HouseRent = 0;
						$EmployeeHouseRent = 0;
						$Utilities = 0;
						$EmployeeUtilitiesBills = 0;
						$EmployeeGrossSalary = 0;
					
					
					$EmployeeMonthlySalary = 0;
					$EmployeeDailySalary = 0;
					$EmployeeHourlySalary = 0;
					$EmployeeMintuesSalary = 0;
					$ten_PersentCutting = 0;
					$twentyfine_PersentCutting = 0;
					$Fifty_PersentCutting = 0;
					$Hundred_PersentCutting = 0;
					$EmployeSalayComplete = 0;
					
				  } ?>
                </tbody>
              </table>
            
            </div>
          </div>
          
              
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>





