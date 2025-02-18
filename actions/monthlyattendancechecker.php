<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$pst_date			= trim($_POST['st_date']);
	$pen_date			= trim($_POST['en_date']);
	
	list($StMonth,$StDate,$StYear)= explode('/', $pst_date);
	$ReturnStartDate = $StYear . '-' . $StMonth . '-' . $StDate;
	
	list($EnMonth,$EnDate,$EnYear)= explode('/', $pen_date);
	$ReturnEndDate = $EnYear . '-' . $EnMonth . '-' . $EnDate;
	
	$AttendanceURL 		= SITE_URL.'m_att.php?sd='.$ReturnStartDate.'&ed='.$ReturnEndDate;

echo '<script>
window.open("'.$AttendanceURL.'", "CNN_WindowName", "directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=1020,height=800");
</script>';		
		//$objCommon->setMessage(_ATTENDANCE_ADDED_SUCCESSFULLY, 'Info');
		//sleep(5);
		//$link = Route::_('show=attendance');
		//redirect($link);
}
?>

