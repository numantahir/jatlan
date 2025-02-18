<?php
if(trim(DecData($_GET["vm"], 1, $objBF)) == "ListView" && trim(DecData($_GET["msi"], 1, $objBF)) != ""){
$objQayaduser->resetProperty();
$objQayaduser->setProperty("monthly_salary_id", trim(DecData($_GET["msi"], 1, $objBF)));
$objQayaduser->lstUserMonthlyPaidSalary();
$MonthlyPaidSalary = $objQayaduser->dbFetchArray(1);
$HeaderTitleByGS = 'Generated Salary :: <code>'.dateFormate_3($MonthlyPaidSalary["flt_start_date"]) .' - To - '. dateFormate_3($MonthlyPaidSalary["flt_end_date"]).'</code>';
$PrintBtnAdd = 'yes';
} else {
$HeaderTitleByGS = 'Generated Salary';	
$PrintBtnAdd = 'no';
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><?php echo $HeaderTitleByGS;?></h4>
            <div class="toolbar text-right"> 
            <?php if($PrintBtnAdd == "yes"){?>
            <a href="javascript:void(0);" onClick="openRequestedPopup('<?php echo SITE_URL;?>empgsd.php?msi=<?php echo EncData(trim(DecData($_GET["msi"], 1, $objBF)), 2, $objBF);?>&md=<?php echo EncData(trim(DecData($_GET["md"], 1, $objBF)), 2, $objBF);?>', 1);" class="btn">Print</a>
            <?php } ?>
            </div>
            <hr>
            <div class="material-datatables">
            <?php if(trim(DecData($_GET["vm"], 1, $objBF)) != "ListView" && trim(DecData($_GET["msi"], 1, $objBF)) == ""){?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Start To End Date</th>
                    <th>Cash Salary</th>
                    <th>Bank Transfer</th>
                    <th>View Both</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
                    $objQayaduser->lstUserMonthlyPaidSalary();
                    while($GeneratedSalary = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo '<code>'.dateFormate_8($GeneratedSalary["flt_start_date"]).'</code> To <code>'.dateFormate_8($GeneratedSalary["flt_end_date"]).'</code>';?></td>
                    <td><a href="<?php echo Route::_('show=generatedsalary&vm='.EncData('ListView', 2, $objBF).'&md='.EncData('1', 2, $objBF).'&msi='.EncData($GeneratedSalary["monthly_salary_id"], 2, $objBF));?>">Cash Salary</a></td>
                    <td><a href="<?php echo Route::_('show=generatedsalary&vm='.EncData('ListView', 2, $objBF).'&md='.EncData('2', 2, $objBF).'&msi='.EncData($GeneratedSalary["monthly_salary_id"], 2, $objBF));?>">Bank Transfer</a></td>
                    <td><a href="<?php echo Route::_('show=generatedsalary&vm='.EncData('ListView', 2, $objBF).'&md='.EncData('3', 2, $objBF).'&msi='.EncData($GeneratedSalary["monthly_salary_id"], 2, $objBF));?>">View Both</a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else { ?>
              <table class="table table-striped table-no-bordered table-hover " cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr>
                      <th>Employee Name</th>
                      <th>L/E (I/O)</th>
                      <th>Absent</th>
                      <th>Leaves</th>
                      <th>Adv Salary</th>
                      <th>Bonus</th>
                      <th>OverTime</th>
                      <th>Deduction</th>
                      <th>Net Salary</th>
                      <th>Mode</th>
                    </tr>
                  </thead>
                  <tbody>
					<?php
					$CashAmount = 0;
					$BankTransferAmount = 0;
					$objQayaduserinfo = new Qayaduser;
                    $objQayaduser->resetProperty();
                    $objQayaduser->setProperty("monthly_salary_id", trim(DecData($_GET["msi"], 1, $objBF)));
					if(trim(DecData($_GET["md"], 1, $objBF)) == 1){
					$objQayaduser->setProperty("pay_mode", 1);	
					} elseif(trim(DecData($_GET["md"], 1, $objBF)) == 2){
					$objQayaduser->setProperty("pay_mode", 2);
					} else {
					//$objQayaduser->setProperty("pay_mode", 2);
					}
					//pay_mode
                    $objQayaduser->lstUserMonthlyPaidSalaryDetail();
                    while($EmpListSalary = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><a href="javascript:void(0);" onClick="openRequestedPopup('<?php echo SITE_URL;?>emsd.php?ei=<?php echo EncData($EmpListSalary["user_id"], 2, $objBF);?>&st=<?php echo EncData(dateFormate_11($MonthlyPaidSalary["flt_start_date"]), 2, $objBF);?>&ed=<?php echo EncData(dateFormate_11($MonthlyPaidSalary["flt_end_date"]), 2, $objBF);?>', 1);"><?php echo $objQayaduserinfo->GetUserFullName($EmpListSalary["user_id"]);?></a></td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_lieo"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_absent"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_aprv_leaves"]).'/-';?></td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_adv_amount"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_bonus"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_overtime"]);?>/-</td>
                    <td><?php echo Salaryformt($EmpListSalary["emp_deduction"]);?>/-</td>
                    <td><?php echo Salaryformt(trim(DecData($EmpListSalary["emp_monthly_salary"], 1, $objBF)));?>/-</td>
                    <td align="center">
                    <?php
					if($EmpListSalary["pay_mode"] == 1){
						echo 'Cash';
						if($EmpListSalary["emp_monthly_salary"] == '0.00'){
						$CashAmount += 0;
						$BankTransferAmount += 0;
						} else {
						$CashAmount += $EmpListSalary["emp_monthly_salary"];
						$BankTransferAmount += 0;
						}
					} else {
						echo 'Bank Transfer';
						if($EmpListSalary["emp_monthly_salary"] == '0.00'){
						$CashAmount += 0;
						$BankTransferAmount += 0;
						} else {
						$CashAmount += 0;
						$BankTransferAmount += $EmpListSalary["emp_monthly_salary"];
						}
					}
					?>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="6">&nbsp;</td>
                    <th colspan="2" align="right">Cash Amount:</th>
                    <th><?php echo Salaryformt($CashAmount);?>/-</th>
                  </tr>
                  <tr>
                    <td colspan="6">&nbsp;</td>
                    <th colspan="2" align="right">Bank Transfer:</th>
                    <th><?php echo Salaryformt($BankTransferAmount);?>/-</th>
                  </tr>
                  </tbody>
                  
                </table>
              <?php } ?>
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