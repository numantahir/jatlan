<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php if(trim(DecData($_GET["v"], 1, $objBF)) == "list" && trim(DecData($_GET["st"], 1, $objBF)) != "" && trim(DecData($_GET["ed"], 1, $objBF)) != ""){ ?>
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Monthly Salary Calculation <code>[ST:<?php echo trim(DecData($_GET["st"], 1, $objBF));?> To ED:<?php echo trim(DecData($_GET["ed"], 1, $objBF)); ?>]</code> <small>| Cutting Mode<code><?php echo GetOptionStatus($_GET["cm"]);?></code> </small></h4>
            <div class="toolbar btn-back text-right" style="margin-top:-44px;"> <a href="<?php echo Route::_('show=monthlysalaryhr');?>" class="btn">Back</a> </div>
            <hr>
            <div class="material-datatables">
              <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
                <input type="hidden" name="mode" value="<?php echo 'stg1';?>">
                <input type="hidden" name="cutting_mode" value="<?php echo $mode;?>">
                <input type="hidden" name="flt_sd" value="<?php echo $ST_StartDate;?>">
                <input type="hidden" name="flt_ed" value="<?php echo $ST_EndDate;?>">
                <table class="table table-striped table-no-bordered table-hover " cellspacing="0" width="100%" style="width:100%">
                  <thead>
                    <tr>
                      <th>Employee Name</th>
                      <th>L/E (I/O)</th>
                      <th>Absent</th>
                      <th>Leaves</th>
                      <th>Adv Salary</th>
                      <th>Bonus</th>
                      <th>Loan Pay</th>
                      <th>IncomeTax</th>
                      <th>Deduction</th>
                      <th>Adjustment</th>
                      <th>Net Salary</th>
                      <th colspan="2">Mode</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
					/**************************************************************************************************************/
					/**************************************************************************************************************/
					/**************************************************************************************************************/
					/**/ $CashSalaryCounter = 0; $BankTransferSalryCounter = 0; $EmployeeMonthlySalary = 0;						/**/
					/**/ $EmployeeDailySalary = 0; $EmployeeHourlySalary = 0; $EmployeeMintuesSalary = 0;						/**/
					/**/ $ten_PersentCutting = 0; $twentyfine_PersentCutting = 0; $Fifty_PersentCutting = 0;					/**/
					/**/ $Hundred_PersentCutting = 0; $EmployeSalayComplete = 0; $LIEO_TotalAmountCutting = 0;					/**/
					/**/ $PassAmountCase = 0; $GrandLateInComming = 0; $GrandEarlyOut = 0; $GrandAbsentCutting = 0;				/**/
					/**/ $NoOfLateComing = 0; $NoOfEarlyGoing = 0; $NoOfAbsentCutting = 0;  $TwoLeaveCount = 0;					/**/
					/**/ $GrandTtalAmountCase_approvedLeave = 0; $GrandTtalNoOfApprovedLeaved = 0; $EmployeeDeductionValue = 0;	/**/
					/**/ $GrandTotalNumberofLeaves = 0; $TotalOfCurrtingAmountValue = 0; $GrandTotalNumberofLeaves = 0;			/**/
					/**/ $TotalOfCurrtingAmountValue = 0; $GrandTotalNumberofLeaves = 0; $TotalOfCurrtingAmountValue = 0;		/**/
					/**/ $TotalOfCurrtingAmountValue = 0; $EmployeeBonusAmount = 0; $cot=0; $GrandTotalOverTimeAmount = 0;		/**/
					/**/ $GrandTotalincometax = 0;
					/**************************************************************************************************************/
					/**************************************************************************************************************/
					/**************************************************************************************************************/
					
					$objUserAdvanceSalaryChecker = new Qayaduser;
					$objUserBonusAmountChecker = new Qayaduser;
					$objUserAttendanceLeavesChecker = new Qayadattendance;
					$objUserApprovedLeavesChecker = new Qayaduser;
					$objUserOverTimeAmountChecker = new Qayaduser;
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'user_fname');
                    $objQayaduser->setProperty("isActive", 1);
					if($EmpModeStatus == "Yes" && $EmployeeID != ""){
					$objQayaduser->setProperty("user_id", $EmployeeID);
					}
                    $objQayaduser->lstEmployeeSalaryDetail();
                    while($EmpListSalary = $objQayaduser->dbFetchArray(1)){
					$cot++;
					$EmployeeMonthlySalary = trim($objBF->decrypt($EmpListSalary["salary_amount"], 1, ENCRYPTION_KEY));
					$EmployeeDailySalary = trim($objBF->decrypt($EmpListSalary["salary_amount"], 1, ENCRYPTION_KEY)) / 30;
					$EmployeeHourlySalary = $EmployeeDailySalary / $WorkingHRPerDay;
					$EmployeeMintuesSalary = $EmployeeHourlySalary / 60;
					$ten_PersentCutting = $EmployeeDailySalary * 0.10;
					$twentyfine_PersentCutting = $EmployeeDailySalary * 0.25;
					$Fifty_PersentCutting = $EmployeeDailySalary * 0.50;
					$Hundred_PersentCutting = $EmployeeDailySalary;
					$GrandTotalincometax = IncomeTaxCalculation($EmployeeMonthlySalary);
					$EmployeSalayComplete = $EmployeeMonthlySalary;
					$EmployeeWorkingDays = 30;
					/**********************************************************************************/
					/**********************************************************************************/
					//User Attendance Leaves Cutting Section
					
					$objUserAttendanceLeavesChecker->resetProperty();
					$objUserAttendanceLeavesChecker->setProperty("user_id", $EmpListSalary["user_id"]);
					$objUserAttendanceLeavesChecker->setProperty("isActive", 1);
					$objUserAttendanceLeavesChecker->setProperty("DATEFILTER", "YES");
					$objUserAttendanceLeavesChecker->setProperty("STARTDATE", trim(dateFormate_10($ST_StartDate)));
					$objUserAttendanceLeavesChecker->setProperty("ENDDATE", trim(dateFormate_10($ST_EndDate)));
					$objUserAttendanceLeavesChecker->lstUserAttLeaves();
					while($AttendanceCuttingDetail = $objUserAttendanceLeavesChecker->dbFetchArray(1)){
						if($AttendanceCuttingDetail["att_leave_cutting"] == 1){							
							$PassAmountCase = $twentyfine_PersentCutting;
							$GrandLateInComming += $twentyfine_PersentCutting;
							$GrandEarlyOut += 0;
							$GrandAbsentCutting += 0;
							$NoOfLateComing += $AttendanceCuttingDetail["att_leave_cutting_value"];
							$NoOfEarlyGoing += 0;
							$NoOfAbsentCutting += 0;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 2){
							$PassAmountCase = $Fifty_PersentCutting;
							$GrandLateInComming += $Fifty_PersentCutting;
							$GrandEarlyOut += 0;
							$GrandAbsentCutting += 0;
							$NoOfLateComing += $AttendanceCuttingDetail["att_leave_cutting_value"];
							$NoOfEarlyGoing += 0;
							$NoOfAbsentCutting += 0;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 3){
							$PassAmountCase = $Hundred_PersentCutting;
							$GrandLateInComming += $Hundred_PersentCutting;
							$GrandEarlyOut += 0;
							$GrandAbsentCutting += 0;
							$NoOfLateComing += $AttendanceCuttingDetail["att_leave_cutting_value"];
							$NoOfEarlyGoing += 0;
							$NoOfAbsentCutting += 0;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 4){
							$PassAmountCase = $ten_PersentCutting;
							$GrandLateInComming += 0;
							$GrandEarlyOut += $ten_PersentCutting;
							$GrandAbsentCutting += 0;
							$NoOfLateComing += 0;
							$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
							$NoOfAbsentCutting += 0;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 5){
							$PassAmountCase = $twentyfine_PersentCutting;
							$GrandLateInComming += 0;
							$GrandEarlyOut += $twentyfine_PersentCutting;
							$GrandAbsentCutting += 0;
							$NoOfLateComing += 0;
							$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
							$NoOfAbsentCutting += 0;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 6){
							$PassAmountCase = $Fifty_PersentCutting;
							$GrandLateInComming += 0;
							$GrandEarlyOut += $Fifty_PersentCutting;
							$GrandAbsentCutting += 0;
							$NoOfLateComing += 0;
							$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
							$NoOfAbsentCutting += 0;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 7){
							$PassAmountCase = $Hundred_PersentCutting;
							$GrandLateInComming += 0;
							$GrandEarlyOut += $Hundred_PersentCutting;
							$GrandAbsentCutting += 0;
							$NoOfLateComing += 0;
							$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
							$NoOfAbsentCutting += 0;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 8){
							$PassAmountCase = $Hundred_PersentCutting;
							$GrandLateInComming += 0;
							$GrandEarlyOut += 0;
							$GrandAbsentCutting += $Hundred_PersentCutting;
							$NoOfLateComing += 0;
							$NoOfEarlyGoing += 0;
							$NoOfAbsentCutting += 1;
						} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 9){
							$PassAmountCase = $Hundred_PersentCutting;
							$GrandLateInComming += 0;
							$GrandEarlyOut += 0;
							$GrandAbsentCutting += $Hundred_PersentCutting;
							$NoOfLateComing += 0;
							$NoOfEarlyGoing += 0;
							$NoOfAbsentCutting += 1;
						}
						$GrandTtalAmountCase_a += $PassAmountCase;
						$LIEO_TotalAmountCutting = $GrandLateInComming + $GrandEarlyOut;
					  }
					
					/**********************************************************************************/
					/**********************************************************************************/
					$GrandTotalNumberofLeaves += $NoOfAbsentCutting;
					$TotalOfCurrtingAmountValue += $GrandAbsentCutting;
					$GrandTotalNumberofLeaves += $NoOfLateComing;
					$TotalOfCurrtingAmountValue += $GrandLateInComming;
					$GrandTotalNumberofLeaves += $NoOfEarlyGoing;
					$TotalOfCurrtingAmountValue += $GrandEarlyOut;
					$TotalOfCurrtingAmountValue += $AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"];
					$TwoLeaveCount = $EmployeeDailySalary * 2;
					/**********************************************************************************/
					/**********************************************************************************/
					//Monthly Approved Leaves Checker
					$objUserApprovedLeavesChecker->resetProperty();
					$objUserApprovedLeavesChecker->setProperty("user_id", $EmpListSalary["user_id"]);
					$objUserApprovedLeavesChecker->setProperty("isActive_not", 3);
					$objUserApprovedLeavesChecker->setProperty("leave_status", 2);
					$objUserApprovedLeavesChecker->setProperty("leave_sd_up", trim(dateFormate_10($ST_StartDate)));
					$objUserApprovedLeavesChecker->setProperty("leave_ed_dw", trim(dateFormate_10($ST_EndDate)));
					$objUserApprovedLeavesChecker->lstUserLeaveRequest();
					while($MyApprovedLeaves = $objUserApprovedLeavesChecker->dbFetchArray(1)){
						if($MyApprovedLeaves["leave_of"] == 1){
						$GetReturnData = GetLeadAssignTime($MyApprovedLeaves["leave_sd"], date('Y-m-d', strtotime($MyApprovedLeaves["leave_ed"] . ' +1 day'))); 
						trim($GetReturnData->d).'<br>';
						$RetrunPassValue = trim($GetReturnData->d);
						} else {
						$RetrunPassValue = 0.50;
						}
						if($MyApprovedLeaves["yearly_leave_type"] == 3){
						$ApprovedLeavedCutting = $EmployeeDailySalary * $RetrunPassValue;
						} else {
						$ApprovedLeavedCutting = 0;	
						}
						
						$GrandTtalNoOfApprovedLeaved += $RetrunPassValue;
						$GrandTtalAmountCase_approvedLeave += $ApprovedLeavedCutting;
						
						$GrandTotalNumberofLeaves += $RetrunPassValue;
						$TotalOfCurrtingAmountValue += $ApprovedLeavedCutting;
					}
					/**********************************************************************************/
					/**********************************************************************************/
					$EmployeeDeductionValue = $LIEO_TotalAmountCutting + $GrandAbsentCutting + $GrandTtalAmountCase_approvedLeave + $AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"];
					$EmployeeBonusAmount = $BonusAmount[$EmpListSalary["user_id"]]["bonus_amount"];
					
					
					$objUserOverTimeAmountChecker->setProperty("user_id", $EmpListSalary["user_id"]);
					$objUserOverTimeAmountChecker->setProperty("overtime_approved", 1);
					$objUserOverTimeAmountChecker->setProperty("overtime_pay", 2);
					//$objQayaduser->setProperty("DATEFILTER", "YES");
					$objUserOverTimeAmountChecker->setProperty("STARTDATE", trim(dateFormate_10($ST_StartDate)));
					$objUserOverTimeAmountChecker->setProperty("ENDDATE", trim(dateFormate_10($ST_EndDate)));
					$objUserOverTimeAmountChecker->lstUserOverTimeDetail();
					//$GrandTotalOverTimeAmount = 0;
					while($MyApprovedOverTime = $objUserOverTimeAmountChecker->dbFetchArray(1)){
						if($MyApprovedOverTime["rate_per_hr"] == 1){
							$PassTitleRatePerHr = 'x 1.0';	
							$MultipleRate = 1 * $EmployeeMintuesSalary;
							$TotalAmountCounter = $MultipleRate * $MyApprovedOverTime["no_of_hrs"];
							} elseif($MyApprovedOverTime["rate_per_hr"] == 2){
								$PassTitleRatePerHr = 'x 1.5';	
								$MultipleRate = 1.5 * $EmployeeMintuesSalary;
								$TotalAmountCounter = $MultipleRate * $MyApprovedOverTime["no_of_hrs"];
								} elseif($MyApprovedOverTime["rate_per_hr"] == 3){
									$PassTitleRatePerHr = 'x 2.0';	
									$MultipleRate = 2 * $EmployeeMintuesSalary;
									$TotalAmountCounter = $MultipleRate * $MyApprovedOverTime["no_of_hrs"];
									}		
						$GrandTotalOverTimeAmount += $TotalAmountCounter;
					}
				  ?>
                  <input type="hidden" value="<?php echo $EmpListSalary["user_id"] ." - ". $LIEO_TotalAmountCutting ." - ". $GrandAbsentCutting ." - ". $GrandTtalAmountCase_approvedLeave ." - ". $AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"];?>">
                  <input type="hidden" name="userid[]" value="<?php echo $EmpListSalary["user_id"]; ?>">
                  <input type="hidden" name="emp_bonus_id_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $BonusAmount[$EmpListSalary["user_id"]]["user_bonus_id"]; ?>">
                  <input type="hidden" name="emp_bonus_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $BonusAmount[$EmpListSalary["user_id"]]["bonus_amount"]; ?>">
                  <input type="hidden" name="cot[]" value="<?php echo $cot;?>">
                  <input type="hidden" name="emp_lieo_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $LIEO_TotalAmountCutting;?>">
                  <input type="hidden" name="emp_absent_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $GrandAbsentCutting;?>">
                  <input type="hidden" name="emp_aprv_leaves_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $GrandTtalAmountCase_approvedLeave;?>">
                  <input type="hidden" name="emp_adv_amount_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"];?>">
                  <input type="hidden" name="emp_adv_payback_id_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $AdvanceSalary[$EmpListSalary["user_id"]]["payback_monthly_id"];?>">
                  <input type="hidden" name="emp_deduction_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $EmployeeDeductionValue;?>">
                  <input type="hidden" name="emp_cutting_mode_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $EmployeeSalary["cutting_mode"];?>">
                  <input type="hidden" name="emp_overtime_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $GrandTotalOverTimeAmount;?>">
                  <input type="hidden" name="emp_incometax_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $GrandTotalincometax;?>">
                  
                  <tr>
                    <td><a href="javascript:void(0);" onClick="openRequestedPopup('<?php echo SITE_URL;?>emsd.php?ei=<?php echo EncData($EmpListSalary["user_id"], 2, $objBF);?>&st=<?php echo EncData($ST_StartDate, 2, $objBF);?>&ed=<?php echo EncData($ST_EndDate, 2, $objBF);?>', 1);"><?php echo $cot.' - '.$EmpListSalary["fullname"];?></a></td>
                    <td><?php echo Salaryformt($LIEO_TotalAmountCutting);?>/-</td>
                    <td><?php echo Salaryformt($GrandAbsentCutting);?>/-</td>
                    <td><?php echo Salaryformt($GrandTtalAmountCase_approvedLeave).'/-';?></td>
                    <td><?php echo Salaryformt($AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"]);?>/-</td>
                    <td><?php echo Salaryformt($EmployeeBonusAmount);?>/-</td>
                    <td><?php echo Salaryformt($GrandTotalOverTimeAmount);?>/-</td>
                    <td><?php echo Salaryformt($GrandTotalincometax);?>/-</td>
                    <td><?php echo Salaryformt($EmployeeDeductionValue);?>/-</td>
                    <?php if($EmployeeSalary["cutting_mode"] == 2){ ?>
                    <td><?php echo 'Rs.0/-';?></td>
                    <td><?php echo Salaryformt($EmployeeMonthlySalary + $EmployeeBonusAmount + $GrandTotalOverTimeAmount);?>/-
                      <input type="hidden" name="emp_monthly_salary_<?php echo $EmpListSalary["user_id"];?>" value="<?php echo $EmployeeMonthlySalary + $EmployeeBonusAmount +  $GrandTotalOverTimeAmount - $GrandTotalincometax; ?>"></td>
                    <?php 
					/**********************************************************/
					/**********************************************************/
					/**/ if($EmpListSalary["bank_id"] != ""){
					/**/ 	$CashSalaryCounter += 0;
					/**/ 	$BankTransferSalryCounter += $EmployeeMonthlySalary + $EmployeeBonusAmount;
					/**/ } else {
					/**/ 	$CashSalaryCounter += $EmployeeMonthlySalary + $EmployeeBonusAmount;
					/**/ 	$BankTransferSalryCounter += 0;
					/**/ }
					/**********************************************************/
					/**********************************************************/
					} else { 
					
					if($GrandTotalNumberofLeaves > 2 && $TotalOfCurrtingAmountValue > $TwoLeaveCount){
						echo '<td>'.Salaryformt($TwoLeaveCount).'/-</td>';	
					} else {
						echo '<td>'.Salaryformt('0').'/-</td>';	
					}
					if(trim($_GET["cm"]) == 1){
					if($GrandTotalNumberofLeaves > 2 && $TotalOfCurrtingAmountValue > $TwoLeaveCount){
                    $NetSalaryAmount = $EmployeeMonthlySalary - $TotalOfCurrtingAmountValue;
                    $AddAdjsment = $NetSalaryAmount + $TwoLeaveCount;
					echo '<td>'.Salaryformt($AddAdjsment + $EmployeeBonusAmount + $GrandTotalOverTimeAmount).'</td>';
					$Stage_3 = $AddAdjsment + $EmployeeBonusAmount + $GrandTotalOverTimeAmount - $GrandTotalincometax;
					echo '<input type="hidden" name="emp_monthly_salary_'.$EmpListSalary["user_id"].'" value="'.$Stage_3.'">';
					/**********************************************************/
					/**********************************************************/
					/**/ if($EmpListSalary["bank_id"] != ""){
					/**/ 	$CashSalaryCounter += 0;
					/**/ 	$BankTransferSalryCounter += $AddAdjsment + $EmployeeBonusAmount;
					/**/ } else {
					/**/ 	$CashSalaryCounter += $AddAdjsment + $EmployeeBonusAmount;
					/**/ 	$BankTransferSalryCounter += 0;
					/**/ }
					/**********************************************************/
					/**********************************************************/
                    } else {
                    $AddAdjsment = $EmployeeMonthlySalary - $AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"];
					echo '<td>'.Salaryformt($AddAdjsment + $EmployeeBonusAmount + $GrandTotalOverTimeAmount).'</td>';
					$Stage_4 = $AddAdjsment + $EmployeeBonusAmount + $GrandTotalOverTimeAmount - $GrandTotalincometax;
					echo '<input type="hidden" name="emp_monthly_salary_'.$EmpListSalary["user_id"].'" value="'.$Stage_4.'">';
					/**********************************************************/
					/**********************************************************/
					/**/ if($EmpListSalary["bank_id"] != ""){
					/**/ 	$CashSalaryCounter += 0;
					/**/ 	$BankTransferSalryCounter += $AddAdjsment + $EmployeeBonusAmount;
					/**/ } else {
					/**/ 	$CashSalaryCounter += $AddAdjsment + $EmployeeBonusAmount;
					/**/ 	$BankTransferSalryCounter += 0;
					/**/ }
					/**********************************************************/
					/**********************************************************/
                    }
					} else {
					echo '<td>'.Salaryformt($EmployeeMonthlySalary + $EmployeeBonusAmount + $GrandTotalOverTimeAmount - $AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"]).'/-</td>';
					$Stage_5 = $EmployeeMonthlySalary + $EmployeeBonusAmount + $GrandTotalOverTimeAmount - $GrandTotalincometax - $AdvanceSalary[$EmpListSalary["user_id"]]["monthly_amount"];
					echo '<input type="hidden" name="emp_monthly_salary_'.$EmpListSalary["user_id"].'" value="'.$Stage_5.'">';
					/**********************************************************/
					/**********************************************************/
					/**/ if($EmpListSalary["bank_id"] != ""){
					/**/ 	$CashSalaryCounter += 0;
					/**/ 	$BankTransferSalryCounter += $EmployeeMonthlySalary + $EmployeeBonusAmount;
					/**/ } else {
					/**/ 	$CashSalaryCounter += $EmployeeMonthlySalary + $EmployeeBonusAmount;
					/**/ 	$BankTransferSalryCounter += 0;
					/**/ }
					/**********************************************************/
					/**********************************************************/
					}
					}
                    ?>
                    <td align="center"><label>
                        <input type="radio" name="pay_mode_<?php echo $EmpListSalary["user_id"]; ?>" value="1" <?php if($EmpListSalary["bank_id"] == ""){ echo " checked";} else { echo "";}?>>
                        Cash </label></td>
                    <td align="center"><label>
                        <input type="radio" name="pay_mode_<?php echo $EmpListSalary["user_id"]; ?>" value="2" <?php if($EmpListSalary["bank_id"] != ""){ echo " checked";} else { echo "";}?>>
                        Bank </label></td>
                  </tr>
                  <?php 
					$EmployeeMonthlySalary = 0;
					$EmployeeDailySalary = 0;
					$EmployeeHourlySalary = 0;
					$EmployeeMintuesSalary = 0;
					$ten_PersentCutting = 0;
					$twentyfine_PersentCutting = 0;
					$Fifty_PersentCutting = 0;
					$Hundred_PersentCutting = 0;
					$EmployeSalayComplete = 0;
					$LIEO_TotalAmountCutting = 0;
					$PassAmountCase = 0;
					$GrandLateInComming = 0;
					$GrandEarlyOut = 0;
					$GrandAbsentCutting = 0;
					$NoOfLateComing = 0;
					$NoOfEarlyGoing = 0;
					$NoOfAbsentCutting = 0;
					$GrandTtalAmountCase_approvedLeave = 0;
					$GrandTtalNoOfApprovedLeaved = 0;
					$GrandTotalNumberofLeaves = 0;
					$TotalOfCurrtingAmountValue = 0;
					$GrandTotalNumberofLeaves = 0;
					$TotalOfCurrtingAmountValue = 0;
					$GrandTotalNumberofLeaves = 0;
					$TotalOfCurrtingAmountValue = 0;
					$TotalOfCurrtingAmountValue = 0;
					$TwoLeaveCount = 0;
					$EmployeeBonusAmount = 0;
					$GrandTotalOverTimeAmount = 0;
					$GrandTotalincometax = 0;
					
				  } ?>
                  <tr>
                    <td colspan="8">&nbsp;</td>
                    <th colspan="2" align="right">Cash Amount:</th>
                    <th colspan="2"><?php echo Salaryformt($CashSalaryCounter);?>/-</th>
                  </tr>
                  <tr>
                    <td colspan="8">&nbsp;</td>
                    <th colspan="2" align="right">Bank Transfer:</th>
                    <th colspan="2"><?php echo Salaryformt($BankTransferSalryCounter);?>/-</th>
                  </tr>
                  <tr>
                    <td colspan="8">&nbsp;</td>
                    <td colspan="2" align="right">&nbsp;</td>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="8">&nbsp;</td>
                    <td colspan="2" align="right">&nbsp;</td>
                    <td colspan="2"><button type="submit" class="btn btn-rose btn-fill" tabindex="7">Submit</button></td>
                  </tr>
                  </tbody>
                  
                </table>
              </form>
            </div>
          </div>
          <?php } else { ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
            <input type="hidden" name="mode" value="<?php echo 'stg0';?>">
            <input type="hidden" name="user_id" value="<?php echo EncData($user_id,1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Monthly Salary Calculation <code>[ST:<?php echo date('d-m-Y', strtotime('first day of last month'));?> To ED:<?php echo date('d-m-Y', strtotime('last day of last month')); ?>]</code></h4>
            </div>
            <div class="toolbar back-btn text-right"> </div>
            <div class="card-content">
            <div class="col-md-12">
            <div class="row">
              <label class="col-sm-2 label-on-left">Start Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'start_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="start_date" required value="<?php echo date('m/d/Y', strtotime('first day of last month'));?>" tabindex="1" />
                  <small><?php echo $vResult["start_date"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'end_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="end_date" required value="<?php echo date('m/d/Y', strtotime('last day of last month'));?>" tabindex="2" />
                  <small><?php echo $vResult["end_date"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Employee</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="employeeid" title="Employee List">
                    <option value="">Select Employee</option>
                    <?php echo $objQayaduser->EmployeeCombo();?>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Cutting Mode</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="cutting_mode" title="Cutting Mode">
                    <option value="1">Enable</option>
                    <option value="2" selected>Disable</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Calculate Salary</button>
            </div>
          </form>
          <?php } ?>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
