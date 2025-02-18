<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          
          
          <?php if(trim(DecData($_GET["v"], 1, $objBF)) == "list" && trim(DecData($_GET["st"], 1, $objBF)) != "" && trim(DecData($_GET["ed"], 1, $objBF)) != ""){ ?>
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Monthly Salary Calculation <code>[ST:<?php echo '21-'.date('m', strtotime('last month')).'-2019';?> To ED:<?php echo '20-'.date('m', strtotime('this month')).'-2019'; ?>]</code> <small>| Cutting Mode<code>Enable</code></small></h4>
            <div class="toolbar btn-back text-right" style="margin-top:-44px;"> <a href="<?php echo Route::_('show=monthlysalaryhr');?>" class="btn">Back</a> </div>
            <hr>
            <div class="material-datatables">
            
            <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
            <input type="hidden" name="cutting_mode" value="<?php echo $mode;?>">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Employee Name</th>
                    <th>L/E (I/O)</th>
                    <th>Absent</th>
                    <th>Leaves</th>
                    <th>Adv Salary</th>
                    <th>Bonus</th>
                    <th>Adjustment</th>
                    <th>Net Salary</th>
                    <th colspan="2">Mode</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$GrandTtalAmountCase_a = 0;
					$GrandLateInComming = 0;
					$GrandEarlyOut = 0;
					$GrandAbsentCutting = 0;
					$NoOfLateComing = 0;
					$NoOfEarlyGoing = 0;
					$NoOfAbsentCutting = 0;
					
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

						$objQayadAttendance->resetProperty();
						$objQayadAttendance->setProperty("isActive", 1);
						$objQayadAttendance->setProperty("user_id", $EmpListSalary["user_id"]);
						$objQayadAttendance->setProperty("DATEFILTER", "YES");
						$objQayadAttendance->setProperty("STARTDATE", dateFormate_10($ST_StartDate));
						$objQayadAttendance->setProperty("ENDDATE", dateFormate_10($ST_EndDate));
						$objQayadAttendance->setProperty("STARTDATE", '2019-02-21');
						$objQayadAttendance->setProperty("ENDDATE", '2019-03-20');
						$objQayadAttendance->lstUserAttLeaves();
						$CounyUserAttLeaves = 0;
						while($AttendanceCuttingDetail = $objQayadAttendance->dbFetchArray(1)){
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
						
						}
							
						$GrandTotalNumberofLeaves += $NoOfAbsentCutting;
						$TotalOfCurrtingAmountValue += $GrandAbsentCutting;
						$GrandTotalNumberofLeaves += $NoOfLateComing;
						$TotalOfCurrtingAmountValue += $GrandLateInComming;
						$GrandTotalNumberofLeaves += $NoOfEarlyGoing;
						$TotalOfCurrtingAmountValue += $GrandEarlyOut;
						$TotalOfCurrtingAmountValue += $EmployeeAdvanceSalary["monthly_amount"];
						$TwoLeaveCount = $EmployeeDailySalary * 2;
						
						//$objQayaduser->resetProperty();
						$objQayaduser_case_a->setProperty("user_id", $EmpListSalary["user_id"]);
						$objQayaduser_case_a->setProperty("isActive_not", 3);
						$objQayaduser_case_a->setProperty("leave_status", 2);
						$objQayaduser_case_a->setProperty("leave_sd_up", dateFormate_10($ST_StartDate));
						$objQayaduser_case_a->setProperty("leave_ed_dw", dateFormate_10($ST_EndDate));
						$objQayaduser_case_a->lstUserLeaveRequest();
						$GrandTtalAmountCase_approvedLeave = 0;
						$GrandTtalNoOfApprovedLeaved = 0;
						while($MyApprovedLeaves = $objQayaduser_case_a->dbFetchArray(1)){
							if($MyApprovedLeaves["leave_of"] == 1){
							$GetReturnData = GetLeadAssignTime($MyApprovedLeaves["leave_sd"], date('Y-m-d', strtotime($MyApprovedLeaves["leave_ed"] . ' +1 day'))); 
							trim($GetReturnData->d).'<br>';
							$RetrunPassValue = trim($GetReturnData->d);
							} else {
							$RetrunPassValue = 0.50;
							$GrandTtalNoOfApprovedLeaved += $RetrunPassValue;
							$GrandTtalAmountCase_approvedLeave += $ApprovedLeavedCutting;
							
							$GrandTotalNumberofLeaves += $RetrunPassValue;
							$TotalOfCurrtingAmountValue += $ApprovedLeavedCutting;				
							}
							if($MyApprovedLeaves["yearly_leave_type"] == 3){
							$ApprovedLeavedCutting = $EmployeeDailySalary * $RetrunPassValue;
							} else {
							$ApprovedLeavedCutting = 0;	
							}
						}
							
							
							
						
                    ?>
                    <input type="hidden" name="userid" value="<?php echo $EmpListSalary["user_id"]; ?>">
                    <input type="hidden" name="empmsalary" value="<?php echo $EmployeeMonthlySalary; ?>">
                    <input type="hidden" name="lieo" value="<?php echo $GrandTtalAmountCase_a; ?>">
                  <tr>
                    <td><?php echo $EmpListSalary["fullname"];?></td>
                    <td><?php echo Salaryformt($GrandTtalAmountCase_a);?>/-</td>
                    <td><?php echo Salaryformt($NoOfAbsentCutting);?>/-</td>
                    <td><?php echo Salaryformt($GrandTtalAmountCase_approvedLeave);?>/-</td>
                    <td><?php echo 'Rs.'.rand(9999,99999).'/-';?></td>
                    <td><?php echo 'Rs.'.rand(9999,99999).'/-';?></td>
                    <td><?php echo 'Rs.'.rand(9999,99999).'/-';?></td>
                    <td><?php echo 'Rs.'.$EmployeeMonthlySalary.'/-';?></td>
                    <td align="center">
                    <label>
                    <input type="radio" name="pay_mode_<?php echo $EmpListSalary["user_id"]; ?>" value="1" <?php if($EmpListSalary["bank_id"] == ""){ echo " checked";} else { echo "";}?>> Cash
                    </label>
                    </td>
                    <td align="center"><label>
                    <input type="radio" name="pay_mode_<?php echo $EmpListSalary["user_id"]; ?>" value="2" <?php if($EmpListSalary["bank_id"] != ""){ echo " checked";} else { echo "";}?>> Bank
                    </label></td>
                  </tr>
                  <?php 
				  		$ApprovedLeavedCutting = 0;
						$RetrunPassValue = 0;
						$GrandTtalAmountCase_a = 0;
						$PassAmountCase = 0;
						$GrandLateInComming = 0;
						$GrandEarlyOut = 0;
						$GrandAbsentCutting = 0;
						$NoOfLateComing = 0;
						$NoOfEarlyGoing = 0;
						$NoOfAbsentCutting = 0;
					
					
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
            </form>
            </div>
          </div>
          
          <?php } else { ?>
          
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
          <input type="hidden" name="mode" value="<?php echo $mode;?>">
          <input type="hidden" name="user_id" value="<?php echo EncData($user_id,1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Monthly Salary Calculation <code>[ST:<?php echo '21-'.date('m', strtotime('last month')).'-2019';?> To ED:<?php echo '20-'.date('m', strtotime('this month')).'-2019'; ?>]</code></h4>
            </div>
            <div class="toolbar back-btn text-right"> </div>
            <div class="card-content">
            <div class="col-md-12">
            
                <div class="row">
                  <label class="col-sm-2 label-on-left">Start Date</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'start_date');?>">
                      <label class="control-label"></label>
                      <input class="form-control datepicker" type="text" name="start_date" required value="<?php echo date('m', strtotime('last month')).'/21/'.date("Y");?>" tabindex="1" />
                      <small><?php echo $vResult["start_date"];?></small> </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">End Date</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'end_date');?>">
                      <label class="control-label"></label>
                      <input class="form-control datepicker" type="text" name="end_date" required value="<?php echo date('m', strtotime('this month')).'/20/'.date("Y");?>" tabindex="2" />
                      <small><?php echo $vResult["end_date"];?></small> </div>
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





