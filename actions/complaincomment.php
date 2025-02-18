<?php
$mode = 'I';
if($_SERVER['REQUEST_METHOD'] == "POST"){
	$complain_id			= trim($_POST['ci']);
	$comment_text			= trim($_POST['comment_text']);
	$complain_status		= trim($_POST['complain_status']);
	$mode 					= trim($_POST['mode']);
	$entery_date			= date('Y-m-d H:i:s');
	
	$objValidate->setArray($_POST);
	$objValidate->setCheckField("comment_text", 'Comment text' . _IS_REQUIRED_FLD, "S");
	
	$vResult = $objValidate->doValidate();
	// See if any error are not returned
	if(!$vResult){
				//complain_picture
				
				$objSSSinventory->resetProperty();
				$complain_comment_id = $objSSSinventory->genCode("rs_tbl_inv_complain_comment", "complain_comment_id");
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("complain_comment_id", $complain_comment_id);
				$objSSSinventory->setProperty("complain_id", $complain_id);
				$objSSSinventory->setProperty("employee_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objSSSinventory->setProperty("comment_text", $comment_text);
				$objSSSinventory->setProperty("comment_date", $entery_date);
				if($objSSSinventory->actComplainComment('I')){	
				
				if(is_uploaded_file($_FILES['complain_picture']['tmp_name'])){
				$objSSSinventory->resetProperty();
				$CommentComplainPicture = $objSSSinventory->getImagename($_FILES['complain_picture']['type'], rand(999,9999));
				if(move_uploaded_file($_FILES['complain_picture']['tmp_name'], COMPLAIN_PICTURE_PATH . $CommentComplainPicture)){
					
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("complain_comment_id", $complain_comment_id);
				$objSSSinventory->setProperty("comment_picture", $CommentComplainPicture);
				$objSSSinventory->actComplainComment('U');
					
				}
				}
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("complain_id", $complain_id);
				$objSSSinventory->setProperty("complain_status", $complain_status);
				if($complain_status==3){
				$objSSSinventory->setProperty("complain_resolved_date", $entery_date);
				}
				$objSSSinventory->actComplain('U');
				
							
				$objQayaduser->resetProperty();
				$objQayaduser->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
				$objQayaduser->setProperty("entery_date", date('Y-m-d H:i:s'));
				$objQayaduser->setProperty("activity_detail", "Add New Complain Comment by ".$LoginUserInfo["fullname"]." -> (".$comment_text .")");
				$objQayaduser->actUserLog("I");
				
						$objCommon->setMessage('Complain information detail has been saved successfully.', 'Info');
						if($complain_status==3){
						$link = Route::_('show=complain');
						} else {
						$link = Route::_('show=complain&i='.EncData($complain_id, 2, $objBF));	
						}
						redirect($link);
				}
				
			}
}