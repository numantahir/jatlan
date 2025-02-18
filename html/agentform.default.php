<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="mode" value="<?php echo $mode;?>">
          <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
          <input type="hidden" name="location_id" value="<?php echo trim($objCheckLogin->location_id);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Agent/User', $mode);?></h4>
            </div>
            <div class="toolbar back-btn text-right"> <a href="<?php echo Route::_('show=users');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-10  user-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">First Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_fname');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_fname" required value="<?php echo $user_fname;?>" tabindex="1" />
                  <small><?php echo $vResult["user_fname"];?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Last Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_lname');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_lname" required value="<?php echo $user_fname;?>" tabindex="2" />
                  <small><?php echo $vResult["user_lname"];?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Device UID</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'device_uid');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="device_uid" id="device_uid" value="<?php echo $device_uid;?>" tabindex="3" />
                  <small><?php echo $vResult["device_uid"];?></small>
                </div>
              </div><label class="col-sm-1 label-on-right"><a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'deviceft.php';?>', 2);"><i class="material-icons">search</i></a></label>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Mobile #</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'mobile_ext');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_mobile" required value="<?php echo $user_mobile;?>" tabindex="3" />
                  <small><?php echo $vResult["mobile_ext"];?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Email</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_email" email="true" value="<?php echo $user_email;?>" tabindex="4" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Password</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_pass');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" id="registerpassword" name="user_pass" <?php echo NotRequired($mode, 'U');?> tabindex="5" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Confirm Password</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_pass_confrim" id="registerPasswordConfirmation"  <?php echo NotRequired($mode, 'U');?> equalTo="#registerpassword" tabindex="6" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">CNIC</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_cnic');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="user_cnic" number="true" value="<?php echo $user_cnic;?>" tabindex="7" />
                  <small><?php echo $vResult["user_cnic"];?></small>
                  <span class="help-block">Please write CNIC number without dash ( - ). Exp: 3520265475547</span> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Designation</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_designation" required value="<?php echo $user_designation;?>" tabindex="8" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Address</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_address" value="<?php echo $user_address;?>" tabindex="9" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Phone</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_phone" value="<?php echo $user_phone;?>" tabindex="10" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Location <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="location_id" title="Choose Office Location" required tabindex="12">
                    <?php echo $objQayaduser->LocationCombo($location_id);?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Blood Group <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="blood_group" title="Select Blood Group" required tabindex="13">
                    <?php echo BloodGroupCombo($blood_group);?>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Gender <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="user_gender" title="Choose Gender" required tabindex="15">
                    <option value="1" <?php echo StaticDDSelection(1, $user_gender);?>>Male</option>
                    <option value="2" <?php echo StaticDDSelection(2, $user_gender);?>>Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Marital Status <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="user_marital_status" title="Choose Marital Status" required tabindex="16">
                    <option value="1" <?php echo StaticDDSelection(1, $user_marital_status);?>>Single</option>
                    <option value="2" <?php echo StaticDDSelection(2, $user_marital_status);?>>Married</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">User Type <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="user_type_id" title="Choose User Type" required tabindex="12">
                    <option disabled> Choose user type</option>
                    <option value="4" <?php echo StaticDDSelection(3, $user_type_id);?>>Agent</option>
                    <option value="2" <?php echo StaticDDSelection(2, $user_type_id);?>>Front-Desk</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Allow Login</label>
              <div class="col-sm-9">
                <div class="form-group allow-login label-floating">
                  <div class="radio col-sm-2"><label> <input type="radio" class="login_required" name="login_required"<?php echo StaticRadioChecked(1,$login_required); ?> checked="true" value="1"> Yes </label></div>
                  <div class="radio col-sm-1"><label> <input type="radio" class="login_required" name="login_required"<?php echo StaticRadioChecked(2,$login_required); ?> value="2"> No </label></div>
                </div>
              </div>
            </div>
            <div class="row" id="loginbase">
              <label class="col-sm-2 label-on-left">2Way Login Verification</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="sms_verification" title="2Way Login Verification">
                    <option value="1" <?php echo StaticDDSelection(1, $sms_verification);?>>Required</option>
                    <option value="2" <?php echo StaticDDSelection(2, $sms_verification);?>>Not Required</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">User Account Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="User Account Status">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?>>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            </div>
			<div class="col-md-2">
            <div class="row">
                <div class="col-md-12 text-center">
                    <legend>User Signature</legend>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="<?php echo USER_SIGNATURE_THUMB_URL.SignatureChecker($user_signature);?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file upload">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="user_signature" />
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
            <div class="col-md-12 text-center">
                <legend>Profile Image</legend>
                <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-new thumbnail img-circle">
                        <img src="<?php echo USER_PROFILE_THUMB_URL.ProfileImgChecker($user_profile_img);?>" alt="...">
                    </div>
                    <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                    <div>
                        <span class="btn btn-round btn-rose btn-file upload">
                            <span class="fileinput-new">Add Photo</span>
                            <span class="fileinput-exists">Change</span>
                            <input type="file" name="user_profile_img" />
                        </span>
                        <br />
                        <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                </div>
            </div>
            </div>
            
            
            </div>
            
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
