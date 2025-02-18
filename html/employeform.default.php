<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
          <input type="hidden" name="mode" value="<?php echo $mode;?>">
          <input type="hidden" name="user_id" value="<?php echo EncData($user_id,1, $objBF);?>">
          <input type="hidden" name="device_uid" value="1" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('User', $mode);?></h4>
            </div>
            <div class="toolbar back-btn text-right"> <a href="<?php echo Route::_('show=employeopt&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
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
                  <input class="form-control" type="text" name="user_lname" required value="<?php echo $user_lname;?>" tabindex="2" />
                  <small><?php echo $vResult["user_lname"];?></small>
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Mobile #</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'mobile_ext');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_mobile" required value="<?php echo $user_mobile;?>" tabindex="4" />
                  <small><?php echo $vResult["mobile_ext"];?></small>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Email</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_email" email="true" value="<?php echo $user_email;?>" tabindex="5" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Password</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_pass');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" id="registerpassword" name="user_pass" <?php echo NotRequired($mode, 'U');?> tabindex="6" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Confirm Password</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="password" name="user_pass_confrim" id="registerPasswordConfirmation"  <?php echo NotRequired($mode, 'U');?> equalTo="#registerpassword" tabindex="7" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">CNIC</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'user_cnic');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="user_cnic" number="true" value="<?php echo $user_cnic;?>" tabindex="8" />
                  <small><?php echo $vResult["user_cnic"];?></small>
                  <span class="help-block">Please write CNIC number without dash ( - ). Exp: 3520265475547</span> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Designation</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_designation" value="<?php echo $user_designation;?>" tabindex="9" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Address</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_address" value="<?php echo $user_address;?>" tabindex="10" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Phone</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="user_phone" value="<?php echo $user_phone;?>" tabindex="11" />
                </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Gender <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="user_gender" title="Choose Gender" required tabindex="15">
                    <option value="1" selected="selected" <?php echo StaticDDSelection(1, $user_gender);?>>Male</option>
                    <option value="2" <?php echo StaticDDSelection(2, $user_gender);?>>Female</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Date of Birth</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="user_dob" value="<?php echo dateFormate_11($user_dob);?>" tabindex="16" />
                </div>
              </div>
            </div>
            

            <?php if($objCheckLogin->user_type==9){?>
            <div class="row">
              <label class="col-sm-2 label-on-left">User Type <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="user_type_id" title="Choose User Type" required tabindex="18">
                    <option value="2" <?php echo StaticDDSelection(6, $user_type_id);?>>Management</option>
                    <option value="3" <?php echo StaticDDSelection(4, $user_type_id);?>>Finance</option>
                    <option value="4" <?php echo StaticDDSelection(2, $user_type_id);?>>Drivers</option>
                    <option value="5" <?php echo StaticDDSelection(10, $user_type_id);?>>Employees</option>
                    
                  
                  </select>
                </div>
              </div>
            </div>
            <?php } elseif($objCheckLogin->user_type==1){?>
            <div class="row">
              <label class="col-sm-2 label-on-left">User Type <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="user_type_id" title="Choose User Type" required tabindex="18">
                  <option value="1" <?php echo StaticDDSelection(6, $user_type_id);?>>Admin</option>
                  <option value="2" <?php echo StaticDDSelection(6, $user_type_id);?>>Management</option>
                    <option value="3" <?php echo StaticDDSelection(4, $user_type_id);?>>Finance</option>
                    <option value="4" <?php echo StaticDDSelection(2, $user_type_id);?>>Drivers</option>
                    <option value="5" <?php echo StaticDDSelection(10, $user_type_id);?>>Employees</option>
                    
                  
                  </select>
                </div>
              </div>
            </div>
            <?php } ?>
            
            
            
            
            <div class="row">
                  <label class="col-sm-2 label-on-left">Vehicle</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" data-size="5" data-live-search="true" name="vehicle_id" title="Select Vehicle" tabindex="19">
                      <option selected="selected" value="">Select Vehicle</option>
                        <?php echo $objSSSjatlan->VehicleOrderProcessCombo($vechile_id);?>
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
                  <select class="selectpicker" data-style="select-with-transition" name="sms_verification" required title="2Way Login Verification">
                    <option value="1" <?php echo StaticDDSelection(1, $sms_verification);?>>Required</option>
                    <option value="2" <?php echo StaticDDSelection(2, $sms_verification);?> selected>Not Required</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">User Account Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="User Account Status">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            </div>
			<div class="col-md-2">
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
            <hr>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <legend>CNIC Front Side</legend>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="<?php echo USER_DOCUMENT_THUMB_URL.DocumentChecker($cnic_front_side);?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file upload">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="cnic_front_side" />
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <legend>CNIC Back Side</legend>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-new thumbnail">
                            <img src="<?php echo USER_DOCUMENT_THUMB_URL.DocumentChecker($cnic_back_side);?>" alt="...">
                        </div>
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file upload">
                                <span class="fileinput-new">Select image</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="cnic_back_side" />
                            </span>
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
