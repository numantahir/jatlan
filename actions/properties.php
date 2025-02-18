<?php
if(trim(DecData($_GET["mode"], 1, $objBF)) == "ChangeStatus" && trim(DecData($_GET["pu"], 1, $objBF)) == "DownAll" && trim(DecData($_GET["pi"], 1, $objBF)) != ""){

$property_id		= trim(DecData($_GET["pi"], 1, $objBF));

$objQayadProerty->resetProperty();
$objQayadProerty->setProperty("property_id", $property_id);
$objQayadProerty->setProperty("isActive", 2);
if($objQayadProerty->actProperties('U')){
	
		$objQayadProerty->resetProperty();
		$objQayadProerty->setProperty("property_id", $property_id);
		$objQayadProerty->setProperty("isActive", 2);
		$objQayadProerty->actPropertyShares('U');
	
}

$objCommon->setMessage('Property and Unit status has been updated successfully.', 'Info');
$link = Route::_('show=properties');
redirect($link);
}

if(trim(DecData($_GET["mode"], 1, $objBF)) == "ChangeStatus" && trim(DecData($_GET["pu"], 1, $objBF)) == "ActiveAll" && trim(DecData($_GET["pi"], 1, $objBF)) != ""){
	
$property_id		= trim(DecData($_GET["pi"], 1, $objBF));

$objQayadProerty->resetProperty();
$objQayadProerty->setProperty("property_id", $property_id);
$objQayadProerty->setProperty("isActive", 1);
if($objQayadProerty->actProperties('U')){
	
		$objQayadProerty->resetProperty();
		$objQayadProerty->setProperty("property_id", $property_id);
		$objQayadProerty->setProperty("isActive", 1);
		$objQayadProerty->actPropertyShares('U');
	
}

$objCommon->setMessage('Property and Unit status has been updated successfully.', 'Info');
$link = Route::_('show=properties');
redirect($link);
	
}
?>