<?php
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['cp']=="cp"){
	$objRoute 			= new Route;
	$objAdminUser 		= new AdminUser;
	
	$customer_id		= $_POST['customer_id'];
	$old_pass			= $_POST['oldpassword'];
	$newpass			= $_POST['newpasswrd'];	
	$password			= $_POST['confrmpasswrd'];
	//if($old_pass == ''){
		//$link = Route::_('show=cpanel&callpage=setting&cp=cp&s=6');
		//redirect($link);
	if($newpass == ''){
		$link = Route::_('show=cpanel&callpage=setting&cp=cp&s=7');
		redirect($link);
	} elseif($password == '' ){
		$link = Route::_('show=cpanel&callpage=setting&cp=cp&s=4');
		redirect($link);
	} elseif($newpass != $password){
		$link = Route::_('show=cpanel&callpage=setting&cp=cp&s=2');
		redirect($link);
	}
	//$objCustomer = new Customer();
	//$objCustomer->setProperty("customer_id", $customer_id);
	//$objCustomer->setProperty("cpassword", md5($old_pass));
	//$result = $objCustomer->checkPassword();
	$result = true;
	if($result==false)
	{
		//echo '<div class="errorMessageDiv">Sorry Your Old password does not match</div>';	
		$link = Route::_('show=cpanel&callpage=setting&cp=cp&s=1');
		redirect($link);
	}
	else{
		 
		if($newpass==$password)
		{
				$GetUserUrlKey = list($username,$OtherInfo)= explode('@', $email);
	
				$url_link  = $objRoute->getUserKey($username, $user_id);
	
				$objValidate->setArray($_POST);
				$vResult = $objValidate->doValidate();
				if(!$vResult){
				$objCustomer->setProperty("customer_id", $customer_id);
				$objCustomer->setProperty("password", md5($password));
				
				if($objCustomer->actCustomer("U")){
					$link = Route::_('show=cpanel&callpage=setting&cp=cp&s=3');
					redirect($link);
				}
			}		
		}	
		
		else
		{
			//echo '<div class="errorMessageDiv">Password does not match</div>';
			$link = Route::_('show=cpanel&callpage=setting&cp=cp&s=2');
			redirect($link);
		}	
		}	
		
					
	}
	
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['cp']=="ea"){
		
	$customer_id		= $_POST['customer_id'];
	$first_name			= $_POST['first_name'];
	$last_name			= $_POST['last_name'];	
	$dob				= $_POST['dob'];	
	$address			= $_POST['address'];	
	$city				= $_POST['city'];	
	$state				= $_POST['state'];	 
	$country_id			= $_POST['country_id'];	
	$phone				= $_POST['phone'];	 
	$mobile             = $_POST['mobile'];
	$country_id			= $_POST['country_id'];
	
	$objValidate->setArray($_POST);
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
    
				$objCustomer = new Customer;
				$objCustomer->setProperty("first_name", $first_name);
				$objCustomer->setProperty("last_name", $last_name);
				$objCustomer->setProperty("dob", $dob);
				$objCustomer->setProperty("address", $address);
				$objCustomer->setProperty("city", $city);
				$objCustomer->setProperty("state", $state);
				$objCustomer->setProperty("country", $country_id);
				$objCustomer->setProperty("phone", $phone);
				$objCustomer->setProperty("mobile", $mobile);			
				$objCustomer->setProperty("customer_id", $customer_id);
				if($objCustomer->actCustomer("U")){
					$link = Route::_('show=cpanel&callpage=setting&s=1');
					redirect($link);
				}
	}
}
	
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['cp']=="py"){
		
		$objRoute 			= new Route;
		$objAdminUser 		= new AdminUser;	
		$ObjAttribute		= new Customer;	
		$pp_email			= $_POST['pp_email'];
		$cc_name			= $_POST['cc_name'];
		$cc_email			= $_POST['cc_email'];
		$customer_id		= $_POST['customer_id'];
		$PaymentOption		= trim($_POST['payment_option']);
		$PaymentOption_id	= $ObjAttribute->AttributeCheck('payment_option');
		
			$objCustomer_1 = new Customer;
			$objCustomer_1->setProperty("attribute_value_id", $_POST['povi']);
			$objCustomer_1->setProperty("attribute_value", $_POST['payment_option']);
			$objCustomer_1->actCustomerAttributeValue("U");
				
		if($PaymentOption==1){
				$objCustomer = new Customer;
				$objCustomer->setProperty("attribute_value_id", $_POST['ppai']);
				$objCustomer->setProperty("attribute_value", $_POST['pp_email']);
				if($objCustomer->actCustomerAttributeValue("U")){
				$link = Route::_('show=cpanel&callpage=setting&cp=py&s=1');
				redirect($link);
				}	
		
		} else {
			
				$objCustomer = new Customer;
				$objCustomer->setProperty("attribute_value_id", $_POST['ccnai']);
				$objCustomer->setProperty("attribute_value", $_POST['cc_name']);
				$objCustomer->actCustomerAttributeValue("U");
				
				$objCustomer_2 = new Customer;
				$objCustomer_2->setProperty("attribute_value_id", $_POST['cceai']);
				$objCustomer_2->setProperty("attribute_value", $_POST['cc_email']);
				$objCustomer_2->actCustomerAttributeValue("U");
				$link = Route::_('show=cpanel&callpage=setting&cp=py&s=2');
				redirect($link);		
		}
}	
		
		
	
		
