<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$device_id			= trim($_POST['device_id']);
	$employee_name		= trim($_POST['employee_name']);
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("employee_name", 'Employee Name is a required field.', "S");
	$objValidate->setCheckField("device_id", 'Device Selction is a required field.', "S");
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				
				
				$objQayaddevice->resetProperty();
				$objQayaddevice->setProperty("ORDERBY", 'device_uid DESC');
				$objQayaddevice->lstDevice();
				$GetLastID = $objQayaddevice->dbFetchArray(1);
				$NewEnrolmentId = $GetLastID["last_emp_id"] + 1;
				$zk = new ZKLib($GetLastID["device_ip"], $GetLastID["device_port"]);
				$ret = $zk->connect();
				sleep(1);
				if ( $ret ){
					$zk->disableDevice();
					sleep(1);	
					$enrolment = $zk->enrollUser($NewEnrolmentId);
					$enrolment_sec = $zk->setUser($self, $NewEnrolmentId, $employee_name, '', '', 'USER');
					$zk->enableDevice();
					sleep(1);
					$zk->disconnect();
				$objQayaddevice->resetProperty();
				$objQayaddevice->setProperty("device_id", $device_id);
				$objQayaddevice->setProperty("last_emp_id", $NewEnrolmentId);
				$objQayaddevice->actDevice('U');
					$link = 'deviceft.php?st=done&eni='.$NewEnrolmentId;
					redirect($link);
				} else {
					echo 'Unable to connect device.';	
					$link = 'deviceft.php?st=error';
					redirect($link);
				}
				

				$objQayaddevice->resetProperty();
				$objQayaddevice->setProperty("ORDERBY", 'device_uid DESC');
				$objQayaddevice->lstUserDeviceUId();
				$GetLastID = $objQayaddevice->dbFetchArray(1);
				$NewEnrolmentId = $GetLastID["device_uid"] + 1;
				
				$objQayaddeviceAdd->resetProperty();
				$objQayaddeviceAdd->setProperty("device_uid", trim($NewEnrolmentId));
				$objQayaddeviceAdd->setProperty("employee_name", trim($employee_name));
				$objQayaddeviceAdd->setProperty("device_id", $device_id);
				$objQayaddeviceAdd->setProperty("isActive", 1);
				$objQayaddeviceAdd->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaddeviceAdd->setProperty("sync_status", 1);
				$objQayaddeviceAdd->setProperty("push_status", 1);
				$objQayaddeviceAdd->actUserDeviceUId('I');
				$link = 'deviceft.php?st=done&eni='.$NewEnrolmentId;
				redirect($link);		
			}
}