<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Salary History</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover available-leaves" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Pay Month</th>
                    <th>L/E (I/O)</th>
                    <th>Absent</th>
                    <th>Leaves</th>
                    <th>Adv Salary</th>
                    <th>Bonus</th>
                    <th>Deduction</th>
                    <th>Net Salary</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayaduserMPS = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
                    $objQayaduser->lstUserMonthlyPaidSalaryDetail();
                    while($EmpListSalary = $objQayaduser->dbFetchArray(1)){
						
						$objQayaduserMPS->setProperty("monthly_salary_id", $EmpListSalary["monthly_salary_id"]);
						$objQayaduserMPS->lstUserMonthlyPaidSalary();
						$GeneratedSalary = $objQayaduserMPS->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo '<code>'.dateFormate_8($GeneratedSalary["flt_start_date"]).'</code> To <code>'.dateFormate_8($GeneratedSalary["flt_end_date"]).'</code>';?></td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_lieo"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_absent"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_aprv_leaves"]).'/-';?></td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_adv_amount"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_bonus"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_deduction"]);?>/-</td>
                    <td><?php echo Salaryformt(trim(DecData($EmpListSalary["emp_monthly_salary"], 1, $objBF)));?>/-</td>
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
