<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){

	$Batch_id				= trim(DecData($_POST["bi"], 1, $objBF));
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("bi", 'Batch ID' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("batch_id", $Batch_id);
				$objSSSinventory->setProperty("batch_status", 2);
				$objSSSinventory->setProperty("batch_fwd_date", date('Y-m-d H:i:s'));
				if($objSSSinventory->actBatch('U')){
				
						$objCommon->setMessage('Batch request has been forward to the finance department successfully. Please deposit the amount in the finance department for further process.', 'Info');
						$link = Route::_('show=pendcollbatch');
						redirect($link);
				}
				
			}
	}