<?php
require_once("config/config.php");
$objCommon 				= new Common;
$objSSSjatlan			= new SSSjatlan;
$objSSSCustomerCategory	= new SSSjatlan;
$objSSSCustomerLocation	= new SSSjatlan;
$objSSSCustomerChecker	= new SSSjatlan;
$objQayaduser			= new Qayaduser;
$objQayadaccount		= new Qayadaccount;
$objBF 					= new Crypt_Blowfish('CBC');
$objBF->setKey($cipher_key);


function replaceAll($text) { 
    $text = str_replace(" ", "", $text);
    $text = preg_replace("/[-]+/i", "", $text);
    return $text;
}
			if( $xlsx = SimpleXLSX::parse(COMPANY_LEAD_PATH.'listofcustomer.xlsx') ) {
				$ReadExcelFile = $xlsx->rows();
				for($e=1;$e<=count($ReadExcelFile);$e++){
					if($ReadExcelFile[$e][0] != ''){
					

					$objSSSCustomerCategory->resetProperty();
                    $objSSSCustomerCategory->setProperty("category_type", 1);
					$objSSSCustomerCategory->setProperty("isActive", 1);
					$objSSSCustomerCategory->setProperty("category_name", $ReadExcelFile[$e][1]);
                    $objSSSCustomerCategory->lstCustomerCategory();
                    $CustomerCategory = $objSSSCustomerCategory->dbFetchArray(1);
					
					$objSSSCustomerLocation->resetProperty();
					$objSSSCustomerLocation->setProperty("isActive", 1);
					$objSSSCustomerLocation->setProperty("location_name", $ReadExcelFile[$e][6]);
                    $objSSSCustomerLocation->lstLocation();
                    $Location = $objSSSCustomerLocation->dbFetchArray(1);
							
					if(trim($ReadExcelFile[$e][8]) == 'ACTIVE'){
						$CustomerStatus = 1;
					} elseif(trim($ReadExcelFile[$e][8]) == 'INACTIVE'){
						$CustomerStatus = 2;
					}
					
					if(trim($ReadExcelFile[$e][10]) == 'Debit'){
						$trans_mode = 1;
					} elseif(trim($ReadExcelFile[$e][10]) == 'Credit'){
						$trans_mode = 2;
					}
				
				$objSSSCustomerChecker->resetProperty();	
				$objSSSCustomerChecker->resetProperty();
				$objSSSCustomerChecker->setProperty("c_code", $ReadExcelFile[$e][11]);
				$objSSSCustomerChecker->lstCustomers();
				if($objSSSCustomerChecker->totalRecords() == 0){
					  
				$objSSSjatlan->resetProperty();
				$customer_id = $objSSSjatlan->genCode("rs_tbl_jt_customers", "customer_id");
				$objSSSjatlan->resetProperty();
				$objSSSjatlan->setProperty("customer_id", $customer_id);
				$objSSSjatlan->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSjatlan->setProperty("customer_name", ucfirst(strtolower($ReadExcelFile[$e][2])));
				$objSSSjatlan->setProperty("customer_type", 1);
				$objSSSjatlan->setProperty("customer_category", $CustomerCategory["category_id"]);
				$objSSSjatlan->setProperty("customer_phone", $ReadExcelFile[$e][5]);
				$objSSSjatlan->setProperty("customer_mobile", $ReadExcelFile[$e][4]);
				$objSSSjatlan->setProperty("location_id", $Location["location_id"]);
				$objSSSjatlan->setProperty("customer_address", $ReadExcelFile[$e][7]);
				$objSSSjatlan->setProperty("isActive", $CustomerStatus);
				$objSSSjatlan->setProperty("c_code", $ReadExcelFile[$e][11]);
				$objSSSjatlan->setProperty("entery_date", date('Y-m-d H:i:s'));
				if($objSSSjatlan->actCustomers('I')){	
				
							$head_code = 'JT-'.$customer_id;
							$Head_Title = ucfirst(strtolower($ReadExcelFile[$e][2])) .' ('.$Location["location_name"]. ')';
							$head_description = ucfirst(strtolower($ReadExcelFile[$e][2])) .' ('.$Location["location_name"]. ') Customer Head';
							$objQayadaccount->resetProperty();
							$head_id = $objQayadaccount->genCode("rs_tbl_account_head", "head_id");
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("head_id", $head_id);
							$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayadaccount->setProperty("head_code", $head_code);
							$objQayadaccount->setProperty("head_title", $Head_Title);
							$objQayadaccount->setProperty("head_type_id", 4); //Customer Type
							$objQayadaccount->setProperty("head_description", $head_description);
							$objQayadaccount->setProperty("entity_id", $customer_id);
							$objQayadaccount->setProperty("entery_date", date('Y-m-d H:i:s'));
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->actHead('I');
				
						if(trim($ReadExcelFile[$e][9]) != ''){
							
							$objQayadaccount->resetProperty();
							$transaction_id = $objQayadaccount->genCode("rs_tbl_account_transaction", "transaction_id");
							$objQayadaccount->resetProperty();
							$objQayadaccount->setProperty("transaction_id", $transaction_id);
							$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
							$objQayadaccount->setProperty("head_id", $head_id);
							$objQayadaccount->setProperty("transaction_number", CreateTransactionNumber($transaction_id));
							$objQayadaccount->setProperty("trans_title", 'Opening Balance of '.$Head_Title);
							$objQayadaccount->setProperty("trans_mode", $trans_mode);
							$objQayadaccount->setProperty("trans_type", 8);
							$objQayadaccount->setProperty("aplic_mode", 1);
							$objQayadaccount->setProperty("pay_mode", 7);
							$objQayadaccount->setProperty("trans_amount", trim($ReadExcelFile[$e][9]));
							$objQayadaccount->setProperty("trans_date", date('Y-m-d'));
							$objQayadaccount->setProperty("trans_status", 1);
							$objQayadaccount->setProperty("entery_date", date('Y-m-d H:i:s'));
							$objQayadaccount->setProperty("isActive", 1);
							$objQayadaccount->setProperty("transfer_mode", 1);
							$objQayadaccount->actAccountTransaction('I');
							
						}
					
				}
				}
							
					echo $e.'-0>'.$ReadExcelFile[$e][0].
					' -1>'.$ReadExcelFile[$e][1].' ('.$CustomerCategory["category_id"].') '.
					' -2>'.ucfirst(strtolower($ReadExcelFile[$e][2])).
					' -3>'.$ReadExcelFile[$e][3].
					' -4>'.$ReadExcelFile[$e][4].
					' -5>'.$ReadExcelFile[$e][5].
					' -6>'.$ReadExcelFile[$e][6]. ' ('.$Location["location_id"].') '.
					' -7>'.$ReadExcelFile[$e][7].
					' -8>'.$ReadExcelFile[$e][8].
					' -9>'.$ReadExcelFile[$e][9].
					' -10>'.$ReadExcelFile[$e][10].'<br>';
					
						
					}
					
					
					
					}
				}
?>
