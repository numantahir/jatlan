<?php
if(trim(DecData($_GET["i"], 1, $objBF)) != '' && trim(DecData($_GET["b"], 1, $objBF)) != '' && trim(DecData($_GET["t"], 1, $objBF)) != '' && trim(DecData($_GET["ms"], 1, $objBF)) == 'approved'){

$objMonthlyAmountUpdate	= new SSSinventory;
$generate_bill_id		= trim(DecData($_GET["i"], 1, $objBF));
$monthly_rent_id		= trim(DecData($_GET["b"], 1, $objBF));
$tenant_id				= trim(DecData($_GET["t"], 1, $objBF));


				/*****************************************************************************************************************/
				/*****************************************************************************************************************/
				/*****************************************************************************************************************/
				/**/$objSSSinventory->resetProperty();
				/**/$objSSSinventory->setProperty("isAcitve", 1);
				/**/$objSSSinventory->setProperty("generate_bill_id", $generate_bill_id);
				/**/$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
				/**/$objSSSinventory->setProperty("tenant_id", $tenant_id);
				/**/$objSSSinventory->lstMonthlyRent();
				/**/$GetRequestedNovAmount = $objSSSinventory->dbFetchArray(1);
				/*****************************************************************************************************************/
				/*****************************************************************************************************************/
				/*****************************************************************************************************************/

				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
				$objSSSinventory->setProperty("received_amount", $GetRequestedNovAmount["total_rent_amount"]);
				$objSSSinventory->setProperty("rent_status", 1);
				$objSSSinventory->setProperty("received_by", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				if($objSSSinventory->actMonthlyRent('U')){
					
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
					$objSSSinventory->lstMonthlyRentAmount();
					while($MonthlyAmountList = $objSSSinventory->dbFetchArray(1)){
						/*************************************************************************************************/
						/**/ $objMonthlyAmountUpdate->resetProperty();
						/**/ $objMonthlyAmountUpdate->setProperty("rent_amount_id", $MonthlyAmountList["rent_amount_id"]);
						/**/ $objMonthlyAmountUpdate->setProperty("received_amount", $GetRequestedNovAmount["total_rent_amount"]);
						/**/ $objMonthlyAmountUpdate->setProperty("pending_amount", 0);
						/**/ $objMonthlyAmountUpdate->setProperty("rent_status", 2);
						/**/ $objMonthlyAmountUpdate->setProperty("received_date", date("Y-m-d"));
						/**/ $objMonthlyAmountUpdate->actMonthlyRentAmount('U');
						/*************************************************************************************************/
					}
				}
	
			$objCommon->setMessage('Select Tenant Bill amount status approved successfully.', 'Info');
			$link = Route::_('show=lstpendingrequest&i='.EncData($generate_bill_id, 2, $objBF));
			redirect($link);
}
if(trim(DecData($_GET["i"], 1, $objBF)) != '' && trim(DecData($_GET["b"], 1, $objBF)) != '' && trim(DecData($_GET["t"], 1, $objBF)) != '' && trim(DecData($_GET["ms"], 1, $objBF)) == 'reject'){

$objMonthlyAmountUpdate	= new SSSinventory;
$generate_bill_id		= trim(DecData($_GET["i"], 1, $objBF));
$monthly_rent_id		= trim(DecData($_GET["b"], 1, $objBF));
$tenant_id				= trim(DecData($_GET["t"], 1, $objBF));


				/*****************************************************************************************************************/
				/*****************************************************************************************************************/
				/*****************************************************************************************************************/
				/**/$objSSSinventory->resetProperty();
				/**/$objSSSinventory->setProperty("isAcitve", 1);
				/**/$objSSSinventory->setProperty("generate_bill_id", $generate_bill_id);
				/**/$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
				/**/$objSSSinventory->setProperty("tenant_id", $tenant_id);
				/**/$objSSSinventory->lstMonthlyRent();
				/**/$GetRequestedNovAmount = $objSSSinventory->dbFetchArray(1);
				/*****************************************************************************************************************/
				/*****************************************************************************************************************/
				/*****************************************************************************************************************/

				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
				$objSSSinventory->setProperty("received_amount", '0.00');
				$objSSSinventory->setProperty("rent_status", 2);
				if($objSSSinventory->actMonthlyRent('U')){
					
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("monthly_rent_id", $monthly_rent_id);
					$objSSSinventory->lstMonthlyRentAmount();
					while($MonthlyAmountList = $objSSSinventory->dbFetchArray(1)){
						/*************************************************************************************************/
						/**/ $objMonthlyAmountUpdate->resetProperty();
						/**/ $objMonthlyAmountUpdate->setProperty("rent_amount_id", $MonthlyAmountList["rent_amount_id"]);
						/**/ $objMonthlyAmountUpdate->setProperty("received_amount", '0.00');
						/**/ $objMonthlyAmountUpdate->setProperty("pending_amount", $GetRequestedNovAmount["total_rent_amount"]);
						/**/ $objMonthlyAmountUpdate->setProperty("rent_status", 1);
						/**/ $objMonthlyAmountUpdate->setProperty("received_date", '0000-00-00');
						/**/ $objMonthlyAmountUpdate->actMonthlyRentAmount('U');
						/*************************************************************************************************/
					}
				}
	
			$objCommon->setMessage('Select Tenant Bill amount status reject successfully.', 'Info');
			$link = Route::_('show=lstpendingrequest&i='.EncData($generate_bill_id, 2, $objBF));
			redirect($link);
}
?>