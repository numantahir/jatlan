<style>
.MainInnerDiv{
	border:solid 1px #f0f0f0; margin-top:35px; min-height:165px;
}
.InnerHeadingSection{
	margin: -13px 15px 0 !important;background-color: #ffffff;width: max-content;padding-left: 10px;padding-right: 10px;
}
</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'User Requested Flow Structure Modification';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=deprequestflow');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
			<?php
            $objEmployeeList = new Qayaduser;
			$objRequestChecker = new Qayaduser;
			$objQayaduser->resetProperty();
            $objQayaduser->setProperty("isActive", 1);
			$objQayaduser->setProperty("ORDERBY", 'company_name');
            $objQayaduser->lstDepartments();
            while($DepartmentList = $objQayaduser->dbFetchArray(1)){
				
				$objRequestChecker->resetProperty();
				$objRequestChecker->setProperty("department_id", $DepartmentList["department_id"]);
				$objRequestChecker->setProperty("company_id", $DepartmentList["company_id"]);
				$objRequestChecker->setProperty("request_flow_type", 1);
				$objRequestChecker->lstUserRequestFlow();
				if($objRequestChecker->totalRecords() > 0){
					$RequestChecker = $objRequestChecker->dbFetchArray(1);
					$request_flow_id = $RequestChecker["request_flow_id"];
					$leave_request_to = $RequestChecker["leave_request_to"];
					$overtime_request_to = $RequestChecker["overtime_request_to"];
					if($leave_request_to != 0){
						$Pass_leave_request_to = $leave_request_to;
						$Pass_overtime_request_to = $overtime_request_to;
						$Request_Mode = 'U';
					} else {
						$Pass_leave_request_to = 0;
						$Pass_overtime_request_to = 0;
						$Request_Mode = 'I';
					}
				} else {
					//$RequestChecker = $objRequestChecker->dbFetchArray(1);
					$request_flow_id = '';
					$Pass_leave_request_to = 0;
					$Pass_overtime_request_to = 0;
					$Request_Mode = 'I';
				}
            ?>
            <input type="hidden" name="loopcot[]" value="1">
            <input type="hidden" name="request_flow_id[]" value="<?php echo $request_flow_id;?>">
            <input type="hidden" name="mode[]" value="<?php echo $Request_Mode;?>">
            <input type="hidden" name="department_id[]" value="<?php echo $DepartmentList["department_id"];?>">
            <input type="hidden" name="company_id[]" value="<?php echo $DepartmentList["company_id"];?>">
            <div class="MainInnerDiv">
              <h4 class="card-title InnerHeadingSection"><?php echo $DepartmentList["company_name"].' / '.$DepartmentList["department_name"];?></h4>
            <div class="row">
              <label class="col-sm-4 label-on-left">Leave Request Forward To</label>
              <div class="col-sm-7">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="leave_request_to[]" title="Select Employee">
                    <option value="0">Select Employee</option>
                    <?php echo $objEmployeeList->customerCombo($Pass_leave_request_to);?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-4 label-on-left">Loan/Adv Payment Request Forward To</label>
              <div class="col-sm-7">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="overtime_request_to[]" title="Select Employee">
                    <option value="0">Select Employee</option>
                    <?php echo $objEmployeeList->customerCombo($Pass_overtime_request_to);?>
                  </select>
                </div>
              </div>
            </div>
            
            </div>
            
            
            <?php } ?>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="7">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
