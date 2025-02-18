<div class="content">
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-text" data-background-color="rose">
        <h4 class="card-title">My Salary Detail [ This Month 01 -  <?php echo date('d', strtotime('last day of this month'));?>]</h4>
      </div>
      <div class="toolbar btn-back text-right"> </div>
      <div class="card-content">
        <div class="col-md-12 Bord-Rt no-border-right">
          <h4>Basic Salary</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">Monthly</td>
                <td class="profile_tb_heading">Daily</td>
                <td class="profile_tb_heading">Hourly</td>
                <td class="profile_tb_heading">Per Minute</td>
              </tr>
              <tr>
                <td><div style="display:none;float: left;margin-right: 20px;" id="Monthly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeMonthlySalary);?>/- </div>
                  <span onClick="ShowHide('Monthly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'Monthly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="Monthly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
                <td><div style="display:none;float: left;margin-right: 20px;" id="daily_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeDailySalary);?>/- </div>
                  <span onClick="ShowHide('daily_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'daily_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="daily_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
                <td><div style="display:none;float: left;margin-right: 20px;" id="hourly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeHourlySalary);?>/- </div>
                  <span onClick="ShowHide('hourly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'hourly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="hourly_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
                <td><div style="display:none;float: left;margin-right: 20px;" id="PerMintus_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeMintuesSalary);?>/- </div>
                  <span onClick="ShowHide('PerMintus_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'PerMintus_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="PerMintus_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <h4>Salary Breakdown</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">Basic Salary</td>
                <td class="profile_tb_heading">House Rent Allowance</td>
                <td class="profile_tb_heading">Utilities</td>
                <td class="profile_tb_heading">Gross Salary</td>
              </tr>
              <tr>
                <td><div style="display:none;float: left;margin-right: 20px;" id="Basic_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeBasicSalaryDetail);?>/- </div>
                  <span onClick="ShowHide('Basic_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'Basic_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="Basic_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
                <td><div style="display:none;float: left;margin-right: 20px;" id="Rent_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeHouseRent);?>/- </div>
                  <span onClick="ShowHide('Rent_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'Rent_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="Rent_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
                <td><div style="display:none;float: left;margin-right: 20px;" id="Utilites_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeUtilitiesBills);?>/- </div>
                  <span onClick="ShowHide('Utilites_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'Utilites_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="Utilites_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
                <td><div style="display:none;float: left;margin-right: 20px;" id="Gross_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>"> <?php echo Salaryformt($EmployeeGrossSalary);?>/- </div>
                  <span onClick="ShowHide('Gross_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>', 'Gross_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text');" id="Gross_Salary_<?php echo $EmployeeSalary["user_salary_id"];?>_text" style="cursor:pointer; color:#039;">Show</span></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <h4>Late-In/Early-Out & Absent Salary Deduction</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">Date</td>
                <td class="profile_tb_heading">Mode</td>
                <td class="profile_tb_heading">10%</td>
                <td class="profile_tb_heading">25%</td>
                <td class="profile_tb_heading">50%</td>
                <td class="profile_tb_heading">100%</td>
                <td class="profile_tb_heading">Amount</td>
              </tr>
              <?php
			$GrandTtalAmountCase_a = 0;
			$GrandLateInComming = 0;
			$GrandEarlyOut = 0;
			$GrandAbsentCutting = 0;
			$NoOfLateComing = 0;
			$NoOfEarlyGoing = 0;
			$NoOfAbsentCutting = 0;
            $objQayadAttendance->resetProperty();
            $objQayadAttendance->setProperty("user_id", $LoginUserInfo["user_id"]);
            $objQayadAttendance->setProperty("isActive", 1);
            $objQayadAttendance->setProperty("DATEFILTER", "YES");
			//$objQayadAttendance->setProperty("att_leave_cutting_not", 8);
			$objQayadAttendance->setProperty("STARTDATE", SALARY_START_DATE);
			$objQayadAttendance->setProperty("ENDDATE", SALARY_END_DATE);
			//$objQayadAttendance->setProperty("STARTDATE", "2020-05-01");
			//$objQayadAttendance->setProperty("ENDDATE", "2020-05-31");
            $objQayadAttendance->lstUserAttLeaves();
            while($AttendanceCuttingDetail = $objQayadAttendance->dbFetchArray(1)){
				//1=>Late-In, 2=>Short-Time, 3=>Absent, 4=>LI & ST
				if($AttendanceCuttingDetail["att_leave_mode"] == 1){
					$CuttingMode = 'Late-IN';
				} elseif($AttendanceCuttingDetail["att_leave_mode"] == 2){
					$CuttingMode = 'Early-OUT';
				} elseif($AttendanceCuttingDetail["att_leave_mode"] == 3){
					$CuttingMode = 'Absent';
				} elseif($AttendanceCuttingDetail["att_leave_mode"] == 4){
					$CuttingMode = 'Late-IN & Early-OUT';
				} elseif($AttendanceCuttingDetail["att_leave_mode"] == 5){
					$CuttingMode = 'Out Time Missing';
				}
				
				if($AttendanceCuttingDetail["att_leave_cutting"] == 1){
				 	$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#0C0">done</i>';
					$Case_c = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_d = '<i class="material-icons" style="color:#900">clear</i>';
					
					$PassAmountCase = $twentyfine_PersentCutting;
					$GrandLateInComming += $twentyfine_PersentCutting;
					$GrandEarlyOut += 0;
					$GrandAbsentCutting += 0;
					$NoOfLateComing += $AttendanceCuttingDetail["att_leave_cutting_value"];
					$NoOfEarlyGoing += 0;
					$NoOfAbsentCutting += 0;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 2){
					$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_c = '<i class="material-icons" style="color:#0C0">done</i>';
					$Case_d = '<i class="material-icons" style="color:#900">clear</i>';
					$PassAmountCase = $Fifty_PersentCutting;
					$GrandLateInComming += $Fifty_PersentCutting;
					$GrandEarlyOut += 0;
					$GrandAbsentCutting += 0;
					$NoOfLateComing += $AttendanceCuttingDetail["att_leave_cutting_value"];
					$NoOfEarlyGoing += 0;
					$NoOfAbsentCutting += 0;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 3){
					$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_c = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_d = '<i class="material-icons" style="color:#0C0">done</i>';
					$PassAmountCase = $Hundred_PersentCutting;
					$GrandLateInComming += $Hundred_PersentCutting;
					$GrandEarlyOut += 0;
					$GrandAbsentCutting += 0;
					$NoOfLateComing += $AttendanceCuttingDetail["att_leave_cutting_value"];
					$NoOfEarlyGoing += 0;
					$NoOfAbsentCutting += 0;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 4){
					$Case_a = '<i class="material-icons" style="color:#0C0">done</i>';
					$Case_b = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_c = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_d = '<i class="material-icons" style="color:#900">clear</i>';
					$PassAmountCase = $ten_PersentCutting;
					$GrandLateInComming += 0;
					$GrandEarlyOut += $ten_PersentCutting;
					$GrandAbsentCutting += 0;
					$NoOfLateComing += 0;
					$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
					$NoOfAbsentCutting += 0;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 5){
					$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#0C0">done</i>';
					$Case_c = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_d = '<i class="material-icons" style="color:#900">clear</i>';
					$PassAmountCase = $twentyfine_PersentCutting;
					$GrandLateInComming += 0;
					$GrandEarlyOut += $twentyfine_PersentCutting;
					$GrandAbsentCutting += 0;
					$NoOfLateComing += 0;
					$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
					$NoOfAbsentCutting += 0;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 6){
					$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_c = '<i class="material-icons" style="color:#0C0">done</i>';
					$Case_d = '<i class="material-icons" style="color:#900">clear</i>';
					$PassAmountCase = $Fifty_PersentCutting;
					$GrandLateInComming += 0;
					$GrandEarlyOut += $Fifty_PersentCutting;
					$GrandAbsentCutting += 0;
					$NoOfLateComing += 0;
					$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
					$NoOfAbsentCutting += 0;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 7){
					$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_c = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_d = '<i class="material-icons" style="color:#0C0">done</i>';
					$PassAmountCase = $Hundred_PersentCutting;
					$GrandLateInComming += 0;
					$GrandEarlyOut += $Hundred_PersentCutting;
					$GrandAbsentCutting += 0;
					$NoOfLateComing += 0;
					$NoOfEarlyGoing += $AttendanceCuttingDetail["att_leave_cutting_value"];
					$NoOfAbsentCutting += 0;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 8){
					$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_c = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_d = '<i class="material-icons" style="color:#0C0">done</i>';
					$PassAmountCase = $Hundred_PersentCutting;
					$GrandLateInComming += 0;
					$GrandEarlyOut += 0;
					$GrandAbsentCutting += $Hundred_PersentCutting;
					$NoOfLateComing += 0;
					$NoOfEarlyGoing += 0;
					$NoOfAbsentCutting += 1;
				} elseif($AttendanceCuttingDetail["att_leave_cutting"] == 9){
					$Case_a = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_b = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_c = '<i class="material-icons" style="color:#900">clear</i>';
					$Case_d = '<i class="material-icons" style="color:#0C0">done</i>';
					$PassAmountCase = $Hundred_PersentCutting;
					$GrandLateInComming += 0;
					$GrandEarlyOut += 0;
					$GrandAbsentCutting += $Hundred_PersentCutting;
					$NoOfLateComing += 0;
					$NoOfEarlyGoing += 0;
					$NoOfAbsentCutting += 1;
				}
				$GrandTtalAmountCase_a += $PassAmountCase;
            ?>
              <tr>
                <td><?php echo dateFormate_3($AttendanceCuttingDetail["att_date"]);?></td>
                <td><?php echo $CuttingMode;?></td>
                <td align="center"><?php echo $Case_a;?></td>
                <td align="center"><?php echo $Case_b;?></td>
                <td align="center"><?php echo $Case_c;?></td>
                <td align="center"><?php echo $Case_d;?></td>
                <td><?php echo Salaryformt($PassAmountCase);?>/-</td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="6" class="profile_tb_heading">Total</td>
                <td class="profile_tb_heading"><?php echo Salaryformt($GrandTtalAmountCase_a);?>/-</td>
              </tr>
            </tbody>
          </table>
          <hr>
          <h4>Approved Leaves Detail</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">Reason</td>
                <td class="profile_tb_heading">Type</td>
                <td class="profile_tb_heading">Start Date</td>
                <td class="profile_tb_heading">End Date</td>
                <td class="profile_tb_heading">Duration</td>
                <td class="profile_tb_heading">No.of Days</td>
                <td class="profile_tb_heading">Amount</td>
              </tr>
              <?php 
			  
				  	$GrandTotalNumberofLeaves += $NoOfAbsentCutting;
					$TotalOfCurrtingAmountValue += $GrandAbsentCutting;
					$GrandTotalNumberofLeaves += $NoOfLateComing;
					$TotalOfCurrtingAmountValue += $GrandLateInComming;
					$GrandTotalNumberofLeaves += $NoOfEarlyGoing;
					$TotalOfCurrtingAmountValue += $GrandEarlyOut;
					$TotalOfCurrtingAmountValue += $EmployeeAdvanceSalary["monthly_amount"];
					$TwoLeaveCount = $EmployeeDailySalary * 2;
					
			  	$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isActive_not", 3);
				$objQayaduser->setProperty("leave_status", 2);
				$objQayaduser->setProperty("leave_sd_up", SALARY_START_DATE);
				$objQayaduser->setProperty("leave_ed_dw", SALARY_END_DATE);
				//$objQayaduser->setProperty("leave_sd_up", "2020-05-01");
				//$objQayaduser->setProperty("leave_ed_dw", "2020-05-31");
				$objQayaduser->lstUserLeaveRequest();
				$GrandTtalAmountCase_approvedLeave = 0;
				$GrandTtalNoOfApprovedLeaved = 0;
				while($MyApprovedLeaves = $objQayaduser->dbFetchArray(1)){
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
					
					
					//$GrandTotalNumberofLeaves += $NoOfAbsentCutting + $NoOfLateComing + $NoOfEarlyGoing + $GrandTtalNoOfApprovedLeaved;
			  ?>
              <tr>
                <td><?php echo $MyApprovedLeaves["leave_reason"];?></td>
                <td><?php echo $MyApprovedLeaves["yearly_leave_name"];?></td>
                <td><?php echo dateFormate_3($MyApprovedLeaves["leave_sd"]);?></td>
                <td><?php echo dateFormate_3($MyApprovedLeaves["leave_ed"]);?></td>
                <td><?php echo LeaveOf($MyApprovedLeaves["leave_of"]);?></td>
                <td align="center"><?php echo $RetrunPassValue;?></td>
                <td>- Rs.<?php echo $ApprovedLeavedCutting;?>/-</td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="5" class="profile_tb_heading">Total</td>
                <td class="profile_tb_heading" style="text-align:center;"><?php echo $GrandTtalNoOfApprovedLeaved;?></td>
                <td class="profile_tb_heading"><?php echo Salaryformt($GrandTtalAmountCase_approvedLeave);?>/-</td>
              </tr>
            </tbody>
          </table>
          
          <hr>
          <h4>OverTime Detail</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">Date</td>
                <td class="profile_tb_heading">OT Minutes</td>
                <td class="profile_tb_heading">OT x [1.0 / 1.5 / 2.0]</td>
                <td class="profile_tb_heading">Amount</td>
              </tr>
              <?php 
			  	$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("overtime_approved", 1);
				$objQayaduser->setProperty("overtime_pay", 2);
				$objQayaduser->setProperty("DATEFILTER", "YES");
				$objQayaduser->setProperty("STARTDATE", SALARY_START_DATE);
				$objQayaduser->setProperty("ENDDATE", SALARY_END_DATE);
				$objQayaduser->lstUserOverTimeDetail();
				$GrandOverTimeAmount = 0;
				while($MyApprovedOverTime = $objQayaduser->dbFetchArray(1)){
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
							
					$GrandOverTimeAmount += $TotalAmountCounter;
			  ?>
              <tr>
                <td><?php echo $MyApprovedOverTime["att_date"];?></td>
                <td><?php echo $MyApprovedOverTime["no_of_hrs"];?></td>
                <td><?php echo $PassTitleRatePerHr;?></td>
                <td><?php echo Salaryformt($TotalAmountCounter);?>/-</td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="3" class="profile_tb_heading">Total</td>
                <td class="profile_tb_heading"><?php echo Salaryformt($GrandOverTimeAmount);?>/-</td>
              </tr>
            </tbody>
          </table>
          
          <hr>
          <h4>Salary Overview</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">Title</td>
                <td class="profile_tb_heading">No.Of</td>
                <td class="profile_tb_heading">Amount</td>
              </tr>
              <tr>
                <td>Absent</td>
                <td><?php  echo $NoOfAbsentCutting;?></td>
                <td>- <?php echo Salaryformt($GrandAbsentCutting);?>/-</td>
              </tr>
              <tr>
                <td>Late-IN (0.25 + 0.50 + 1.00)</td>
                <td><?php echo $NoOfLateComing;?></td>
                <td>-
                  <?php  echo Salaryformt($GrandLateInComming);?>
                  /-</td>
              </tr>
              <tr>
                <td>Early-OUT (0.10 + 0.25 + 0.50 + 1.00)</td>
                <td><?php echo $NoOfEarlyGoing;?></td>
                <td>- <?php echo Salaryformt($GrandEarlyOut);?>/-</td>
              </tr>
              <tr>
                <td>Approved Leaves</td>
                <td><?php echo $GrandTtalNoOfApprovedLeaved;?></td>
                <td>- <?php echo Salaryformt($GrandTtalAmountCase_approvedLeave);?>/-</td>
              </tr>
              <tr>
                <td style="border-bottom:solid 1px #000000;">Advance Salary</td>
                <td style="border-bottom:solid 1px #000000;">This Month</td>
                <td style="border-bottom:solid 1px #000000;">- <?php echo Salaryformt($EmployeeAdvanceSalary["monthly_amount"]);?>/-</td>
              </tr>
              <tr>
                <td class="profile_tb_heading">Total</td>
                <td class="profile_tb_heading"><?php echo $GrandTotalNumberofLeaves;?></td>
                <td class="profile_tb_heading"><?php echo Salaryformt($TotalOfCurrtingAmountValue);?>/-</td>
              </tr>
              <?php if($GrandTotalNumberofLeaves > 2 && $TotalOfCurrtingAmountValue > $TwoLeaveCount){?>
              <tr>
                <td>Monthly Leaves Adjustment</td>
                <td>2</td>
                <td>+ <?php echo Salaryformt($TwoLeaveCount);?>/-</td>
              </tr>
              <?php } ?>
              <tr>
                <td>Basic Salary</td>
                <td>This Month</td>
                <td><?php echo Salaryformt($EmployeeMonthlySalary);?>/-</td>
              </tr>
              <tr>
                <td>Income Tax</td>
                <td>This Month</td>
                <td><?php $IncomeTaxThisMonth = IncomeTaxCalculation($EmployeeMonthlySalary); 
				echo Salaryformt($IncomeTaxThisMonth);?>/-</td>
              </tr>
              <tr>
                <td>OverTime Amount</td>
                <td>This Month</td>
                <td>+ <?php echo Salaryformt($GrandOverTimeAmount);?>/-</td>
              </tr>
			  <?php if($EmployeeBonusSalary["user_bonus_id"] != ""){
				  $TotalBonusAmount = $EmployeeBonusSalary["bonus_amount"];
				  ?>
              <tr>
                <td>Bonus Amount</td>
                <td>This Month</td>
                <td>+ <?php echo Salaryformt($EmployeeBonusSalary["bonus_amount"]);?>/-</td>
              </tr>
              <?php } else { $TotalBonusAmount = 0;}?>
              <?php if($EmployeeSalary["cutting_mode"] == 2){ ?>
              <tr>
                <td colspan="2">Net Salary</td>
                <td><?php echo Salaryformt($EmployeeMonthlySalary + $TotalBonusAmount + $GrandOverTimeAmount - $IncomeTaxThisMonth);?>/-</td>
              </tr>
              <?php } else { ?>
              <tr>
                <td colspan="2">Net Salary</td>
                <td><?php 
			  if($GrandTotalNumberofLeaves > 2 && $TotalOfCurrtingAmountValue > $TwoLeaveCount){
			  $NetSalaryAmount = $EmployeeMonthlySalary - $TotalOfCurrtingAmountValue - $IncomeTaxThisMonth;
			  $AddAdjsment = $NetSalaryAmount + $TwoLeaveCount;
			  } else {
			  $AddAdjsment = $EmployeeMonthlySalary - $EmployeeAdvanceSalary["monthly_amount"] - $IncomeTaxThisMonth;
			  }
			  echo Salaryformt($AddAdjsment + $TotalBonusAmount + $GrandOverTimeAmount);?>
                  /-</td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- end col-md-12 --> 
      
    </div>
    
    <!-- end row --> 
    
  </div>
</div>
