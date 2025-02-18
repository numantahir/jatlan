<input type="hidden" name="trans_type" id="trans_type" value="3">
            <input type="hidden" name="aplic_mode" value="15">
            <input type="hidden" name="head_id" id="dyn_head_id" value="">
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Employee Salary: </label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="paid_salary_detail_id" id="emp_salary_sel" title="List of Employee Salary" required tabindex="2" data-live-search="true">
                    <?php
					$objGetEmployeeName = new Qayaduser;
					$objGetGeneratedDate = new Qayaduser;
					$objQayaduser->resetProperty();
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("pay_mode", 1);
                    $objQayaduser->setProperty("ORDERBY", 'paid_salary_detail_id DESC');
                    $objQayaduser->lstUserMonthlyPaidSalaryDetail();
                    while($EmployeeSalaryList = $objQayaduser->dbFetchArray(1)){
						
						$objGetGeneratedDate->resetProperty();
						$objGetGeneratedDate->setProperty("isActive", 1);
						$objGetGeneratedDate->setProperty("monthly_salary_id", $EmployeeSalaryList['monthly_salary_id']);
						$objGetGeneratedDate->lstUserMonthlyPaidSalary();
						$GetGeneratedDate = $objGetGeneratedDate->dbFetchArray(1);
						
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->setProperty("head_type_id", 5);
							$objQayadaccount->setProperty("entity_id", $EmployeeSalaryList["user_id"]);
							$objQayadaccount->lstHead();
							$AccountHeadList = $objQayadaccount->dbFetchArray(1);
							$EmployeeFullnamePrint = $objGetEmployeeName->GetUserFullName($EmployeeSalaryList["user_id"]);
							
							list($PaidSYear,$PaidSMonth,$PaidSDay)= explode('-', $GetGeneratedDate["flt_start_date"]);
							$GenMonthPaidOf = date("F", mktime(0, 0, 0, $PaidSMonth, 10)) . '-' . $PaidSYear;
							
                    ?>
                    <option data-paiddate="<?php echo $GenMonthPaidOf;?>" data-salary="<?php echo $EmployeeSalaryList["emp_monthly_salary"];?>" data-emname="<?php echo $EmployeeFullnamePrint;?>" data-head="<?php echo $AccountHeadList["head_id"];?>" value="<?php echo EncData($EmployeeSalaryList["paid_salary_detail_id"], 1, $objBF);?>"> <?php echo 'SG: ['.$GenMonthPaidOf.'] '.$EmployeeFullnamePrint . ' Rs.'.$EmployeeSalaryList["emp_monthly_salary"];?> </option>
                    <?php } ?>
                  </select>
                </div>
              </div>
            </div>
            <div id="Generalhaeditemdiv" style="display:none;"></div>
            <div id="Third_section_" style="display:none;">
              <hr>
              <div class="row">
                <label class="col-sm-2 label-on-left">Amount:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_amount');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="trans_amount" onkeyup="word.innerHTML=convertNumberToWords(this.value)" id="trans_amount" required value="<?php echo $trans_amount;?>" tabindex="2" /><label><small id="word"></small></label>
                  </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Payment Mode:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
                    <select class="selectpicker" data-style="select-with-transition" name="pay_mode" id="pay_mode" title="List of Payment Mode" required tabindex="2">
                      <option value="1">Cash</option>
                      <option value="2">Cheque</option>
                      <option value="3">Pay Order</option>
                      <option value="4">Bank Transfer</option>
                      <option value="5">Demand Draft</option>
                      <option value="6">Online</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row" id="mode_no" style="display:none;">
                <label class="col-sm-2 label-on-left">Mode No:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="payment_mode_no" id="pay_mode_field" value="<?php echo $pay_mode;?>" tabindex="2" />
                    <code>Note: Mode No for 'Cheque, Pay Order, Bank Transfer, etc' transaction number.</code> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left"><?php echo $HeadTransfer;?>:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
                    <select class="selectpicker" data-style="select-with-transition" name="transfer_head_id" id="transfer_head_id" title="List of Transfer Head's" required tabindex="2">
                      <?php
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					if($LoginUserInfo["user_type_id"] == 18  or $LoginUserInfo["user_type_id"] == 9) {
					$objQayadaccount->setProperty("head_type_id", '2');
					} else {
					$objQayadaccount->setProperty("head_type_id_array", '3,2');	
					}
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                    ?>
                      <option value="<?php echo EncData($AccountHeadList["head_id"], 1, $objBF);?>"> <?php echo $AccountHeadList["head_code"] . ' - ' . $AccountHeadList["head_title"] . ' ';?> </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div id="haeditemdiv" style="display:none;"></div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Transaction Date:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_date');?>">
                    <label class="control-label"></label>
                    <input class="form-control datepicker" type="text" name="trans_date" required value="<?php echo $trans_date;?>" tabindex="1" />
                    <small><?php echo $vResult["trans_date"];?></small> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Title:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_title');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="trans_title" id="trans_title" required value="<?php echo $trans_title;?>" tabindex="2" />
                    <small><?php echo $vResult["trans_title"];?></small> </div>
                </div>
              </div>
              <div class="row">
                <label class="col-sm-2 label-on-left">Note / Description:</label>
                <div class="col-sm-9">
                  <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_note');?>">
                    <label class="control-label"></label>
                    <input class="form-control" type="text" name="trans_note" value="<?php echo $trans_note;?>" tabindex="2" />
                    <small><?php echo $vResult["trans_note"];?></small> </div>
                </div>
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill" id="SubmitBtn">Submit</button>
                <button type="reset" class="btn btn-fill">Reset</button>
              </div>
            </div>