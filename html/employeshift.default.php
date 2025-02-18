<?php
$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
$objQayaduser->lstUsers();
$EmployeData = $objQayaduser->dbFetchArray(1);
$objQayaduser->resetProperty();
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo $EmployeData["fullname"];?> Shift Assign</h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=employeopt&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <?php 
			for($D=1;$D<=7;$D++){ 
			$objQayaduser->resetProperty();
			//$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)));
			$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET["i"], 1, $objBF)));
			$objQayaduser->setProperty("day_id", $D);
			$objQayaduser->lstUserShifts();
			if($objQayaduser->totalRecords() > 0){
			$GetShiftID = $objQayaduser->dbFetchArray(1);
				if($GetShiftID["shift_id"] != 0){
					$PassShiftId = $GetShiftID["shift_id"];
				} else {
					$PassShiftId = '0';
				}
				$mode = 'U';
				$ShiftId = EncData($GetShiftID["user_shift_id"], 1, $objBF);
			} else {
				$PassShiftId = '';
				$mode = 'I';
				$ShiftId = '';
			}
			?>
            <div class="row">
              <label class="col-sm-3 label-on-left"><?php echo GetDayName($D);?></label>
              <div class="col-sm-8">
                <div class="form-group label-floating">
                  <input type="hidden" name="mode[<?php echo $D;?>]" value="<?php echo $mode;?>">
                  <input type="hidden" name="user_shift_id[<?php echo $D;?>]" value="<?php echo $ShiftId;?>">
                  <input type="hidden" name="day_id[<?php echo $D;?>]" value="<?php echo $D;?>">
                  <select class="selectpicker" data-style="select-with-transition" name="shift_id[<?php echo $D;?>]" required title="Select Shift" tabindex="<?php echo $D;?>">
                    <?php echo $objQayaduser->ShiftCombo($PassShiftId);?>
                  </select>
                </div>
              </div>
            </div>
            <?php } ?>
            
            
            
            
            <br><hr><br>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
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
