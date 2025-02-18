<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["mode"], 1, $objBF)) == "SecOne"){

	$startDate				= trim($_POST['start_date']);
	$end_date				= trim($_POST['end_date']);
	$employeeid				= trim($_POST['employeeid']);
	$mode					= trim(DecData($_POST['mode'], 1, $objBF));
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("start_date", 'Start Date' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("end_date", 'End Date' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("employeeid", 'Employee Selection' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				//print_r($_POST);
				$PassStartDate 		= EncData(dateFormate_10($startDate), 2, $objBF);
				$PassEndDate 		= EncData(dateFormate_10($end_date), 2, $objBF);
				$PassEmployeeId		= EncData($employeeid, 2, $objBF);
				?>
				<script type="text/javascript">window.open("<?php echo SITE_URL.'resyncconfirm.php?st='.$PassStartDate.'&ed='.$PassEndDate.'&i='.$PassEmployeeId.'&sec='.EncData($mode, 2, $objBF);?>", "CNN_WindowName", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=920,height=800");
                window.location.replace("<?php echo Route::_('show=restaction');?>");
                </script>';
				<?php						
			}
}
if($_SERVER['REQUEST_METHOD'] == "POST" && trim(DecData($_POST["mode"], 1, $objBF)) == "SecTwo"){

	$startDate				= trim($_POST['start_date']);
	$end_date				= trim($_POST['end_date']);
	$mode					= trim(DecData($_POST['mode'], 1, $objBF));
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("start_date", 'Start Date' . _IS_REQUIRED_FLD, "S");
	$objValidate->setCheckField("end_date", 'End Date' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				//print_r($_POST);
				$PassStartDate 		= EncData(dateFormate_10($startDate), 2, $objBF);
				$PassEndDate 		= EncData(dateFormate_10($end_date), 2, $objBF);
				$PassEmployeeId		= EncData($employeeid, 2, $objBF);
				?>
				<script type="text/javascript">window.open("<?php echo SITE_URL.'resyncconfirm.php?st='.$PassStartDate.'&ed='.$PassEndDate.'&i=&sec='.EncData($mode, 2, $objBF);?>", "CNN_WindowName", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=920,height=800");
                window.location.replace("<?php echo Route::_('show=restaction');?>");
                </script>';
				<?php						
			}
}
?>