<style>.wrapper{ height:auto !important;}</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="stage" value="<?php echo EncData('7', 1, $objBF);?>">
            <input type="hidden" name="bl" value="<?php echo EncData(trim(DecData($_GET["bl"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="pi" value="<?php echo EncData(trim(DecData($_GET["pi"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="jn" value="<?php echo EncData(trim(DecData($_GET["jn"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="jnp" value="<?php echo EncData('yes', 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo $MainHeadTitle;?></h4>
            </div>
            
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <!--jointaplic_section-->
                <div class="row">
                  <div class="col-sm-12">
                    <h4 class="card-title">Joint Applicant Information</h4>
                    <div class="toolbar text-right"> <a href="<?php echo Route::_('show=newappregjoint&mode='.EncData('reset', 2, $objBF).'&sec='.EncData('joint', 2, $objBF).'&ja='.EncData(trim(DecData($_GET["ja"], 1, $objBF)), 2, $objBF).'&bl='.EncData(trim(DecData($_GET["bl"], 1, $objBF)), 2, $objBF).'&pi='.EncData(trim(DecData($_GET["pi"], 1, $objBF)), 2, $objBF).'&jn='.EncData(trim(DecData($_GET["jn"], 1, $objBF)), 2, $objBF));?>" class="btn btn-default">Delete / Reset</a> </div>
                    <hr>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_fname');?>">
                      <label class="label-control">Joint Applicant First Name:</label>
                      <input class="form-control jointaplic" type="text" name="ja_customer_fname" required value="<?php echo $ja_customer_fname;?>" tabindex="1" />
                      <small><?php echo $vResult["ja_customer_fname"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_lname');?>">
                      <label class="label-control">Joint Applicant Last Name:</label>
                      <input class="form-control jointaplic" type="text" name="ja_customer_lname" required value="<?php echo $ja_customer_lname;?>" tabindex="2" />
                      <small><?php echo $vResult["ja_customer_lname"];?></small> </div>
                  </div>
                  <div class="col-sm-6" style="border-bottom: 1px solid #D2D2D2;">
                    <label class="label-control">S/O, D/O, W/O:</label>
                    <div class="form-group label-floating">
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="ja_customer_of"<?php if($ja_customer_of!=''){ echo StaticRadioChecked(1, $ja_customer_of); } else { echo ' checked'; } ?> required value="1" tabindex="1">
                          Son of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="ja_customer_of"<?php echo StaticRadioChecked(2, $ja_customer_of);?> required value="2" tabindex="1">
                          Wife of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="ja_customer_of"<?php echo StaticRadioChecked(3, $ja_customer_of);?> required value="3" tabindex="1">
                          Daughter of </label>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_father');?>">
                      <label class="label-control">Name of (S/O, D/O, W/O):</label>
                      <input class="form-control jointaplic" type="text" name="ja_customer_father" required value="<?php echo $ja_customer_father;?>" tabindex="3" />
                      <small><?php echo $vResult["ja_customer_father"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_cnic');?>" id="ja_cnic_div">
                      <label class="label-control">CNIC:</label>
                      <input class="form-control jointaplic" type="number" id="ja_customer_cnic" required data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXXXXXXXXXX" name="ja_customer_cnic" value="<?php echo $ja_customer_cnic;?>" tabindex="4" />
                      <small><?php echo $vResult["ja_customer_cnic"];?><error id="ja_cnic_error_msg" style="color:#900;"></error></small>
                      <label class="label-control"><small>Note: Write CNIC Number without DASH ( - )</small></label>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label class="label-control">Passport No:</label>
                      <input class="form-control" type="text" name="ja_customer_passport" value="<?php echo $ja_customer_passport;?>" tabindex="5" />
                    </div>
                  </div>
                  <div class="col-sm-6" style="clear: both;">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_email');?>">
                      <label class="label-control">Email Address:</label>
                      <input class="form-control jointaplic" type="email" name="ja_customer_email" value="<?php echo $ja_customer_email;?>" tabindex="6" />
                      <small><?php echo $vResult["ja_customer_email"];?></small> </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_c_address');?>">
                      <label class="label-control">Mailing Address:</label>
                      <input class="form-control jointaplic" type="text" name="ja_customer_c_address" required value="<?php echo $ja_customer_c_address;?>" tabindex="7" />
                      <small><?php echo $vResult["ja_customer_c_address"];?></small> </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_p_address');?>">
                      <label class="label-control">Permanent Address:</label>
                      <input class="form-control jointaplic" type="text" name="ja_customer_p_address" value="<?php echo $ja_customer_p_address;?>" tabindex="8" />
                      <small><?php echo $vResult["ja_customer_p_address"];?></small> </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_phone');?>">
                      <label class="label-control">Phone No Res:</label>
                      <input class="form-control jointaplic" type="text" name="ja_customer_phone" value="<?php echo $ja_customer_phone;?>" tabindex="9" />
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group <?php echo is_form_error($vResult,'ja_customer_mobile');?>">
                      <label class="label-control">Mobile No:</label>
                      <input class="form-control jointaplic" type="text" name="ja_customer_mobile" required value="<?php echo $ja_customer_mobile;?>" tabindex="10" />
                      <small><?php echo $vResult["ja_customer_mobile"];?></small> </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="label-control">Mobile 2 No:</label>
                      <input class="form-control" type="text" name="ja_customer_mobile_2" value="<?php echo $ja_customer_phone;?>" tabindex="11" />
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label class="label-control">Percentage (%):</label>
                      <input class="form-control" type="number" name="share_percentage" required value="<?php echo $share_percentage;?>" tabindex="12" />
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <hr>
                      <h4 class="card-title">Joint Applicant Nominee Information</h4>
                      <hr>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group <?php echo is_form_error($vResult,'ja_n_customer_fname');?>">
                        <label class="label-control">Nominee First Name:</label>
                        <input class="form-control jointaplic" type="text" name="ja_n_customer_fname" required value="<?php echo $ja_n_customer_fname;?>" tabindex="13" />
                        <small><?php echo $vResult["ja_n_customer_fname"];?></small> </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group <?php echo is_form_error($vResult,'ja_n_customer_lname');?>">
                        <label class="label-control">Nominee Last Name:</label>
                        <input class="form-control jointaplic" type="text" name="ja_n_customer_lname" required value="<?php echo $ja_n_customer_lname;?>" tabindex="14" />
                        <small><?php echo $vResult["ja_n_customer_lname"];?></small> </div>
                    </div>
                    <div class="col-sm-6" style="border-bottom: 1px solid #D2D2D2;">
                    <label class="label-control">S/O, D/O, W/O:</label>
                    <div class="form-group label-floating">
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="ja_n_customer_of"<?php if($ja_n_customer_of!=''){ echo StaticRadioChecked(1, $ja_n_customer_of); } else { echo ' checked'; } ?> required value="1" tabindex="1">
                          Son of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="ja_n_customer_of"<?php echo StaticRadioChecked(2, $ja_n_customer_of);?> required value="2" tabindex="1">
                          Wife of </label>
                      </div>
                      <div class="radio col-sm-4">
                        <label>
                          <input type="radio" class="login_required" name="ja_n_customer_of"<?php echo StaticRadioChecked(3, $ja_n_customer_of);?> required value="3" tabindex="1">
                          Daughter of </label>
                      </div>
                    </div>
                  </div>
                    <div class="col-sm-6">
                      <div class="form-group <?php echo is_form_error($vResult,'ja_n_customer_father');?>">
                        <label class="label-control">Name of (S/O, D/O, W/O):</label>
                        <input class="form-control jointaplic" type="text" name="ja_n_customer_father" value="<?php echo $ja_n_customer_father;?>" tabindex="15" />
                        <small><?php echo $vResult["ja_n_customer_father"];?></small> </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group <?php echo is_form_error($vResult,'ja_n_customer_cnic');?>">
                        <label class="label-control">CNIC:</label>
                        <input class="form-control jointaplic" type="number" id="ja_n_customer_cnic" required data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXXXXXXXXXX" name="ja_n_customer_cnic" value="<?php echo $ja_n_customer_cnic;?>" tabindex="16" />
                        <small><?php echo $vResult["ja_n_customer_cnic"];?></small>
                        <label class="label-control"><small>Note: Write CNIC Number without DASH ( - )</small></label>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="label-control">Passport No:</label>
                        <input class="form-control" type="text" name="ja_n_customer_passport" value="<?php echo $ja_n_customer_passport;?>" tabindex="17" />
                      </div>
                    </div>
                    <div class="col-sm-6" style="clear: both;">
                      <div class="form-group <?php echo is_form_error($vResult,'ja_customer_email');?>">
                        <label class="label-control">Relationship with Applicant:</label>
                        <input class="form-control jointaplic" type="text" name="ja_customer_relation_name" value="<?php echo $ja_customer_relation_name;?>" tabindex="18" />
                        <small><?php echo $vResult["ja_customer_relation_name"];?></small> </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group <?php echo is_form_error($vResult,'ja_n_customer_c_address');?>">
                        <label class="label-control">Mailing Address:</label>
                        <input class="form-control jointaplic" type="text" name="ja_n_customer_c_address" value="<?php echo $ja_n_customer_c_address;?>" tabindex="19" />
                        <small><?php echo $vResult["ja_n_customer_c_address"];?></small> </div>
                    </div>
                  </div>
                </div>
                <hr>
                  <div class="text-center col-md-12">
                    <h4><?php echo 'Attached Document for Joint Applicant';?></h4>
                    <hr>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Applicant Profile Image</legend>
                    <?php if($joint_applicant_profile_image!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($joint_applicant_profile_image);?>" alt="..."> </div>
                    </div>
                    <?php } else {?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CurrentSValue["joint_applicant_profile_image"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_applicant_profile_image" tabindex="20" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Applicant CNIC Front Side</legend>
                     <?php if($joint_applicant_cnic_front_side!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($joint_applicant_cnic_front_side);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["joint_applicant_cnic_front_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_applicant_cnic_front_side" tabindex="21" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Applicant CNIC Back Side</legend>
                    <?php if($joint_applicant_cnic_back_side!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($joint_applicant_cnic_back_side);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["joint_applicant_cnic_back_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_applicant_cnic_back_side" tabindex="22" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Applicant Signature</legend>
                    <?php if($joint_applicant_signature!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_SIGNATURE_THUMB_URL.SignatureChecker($joint_applicant_signature);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_SIGNATURE_THUMB_URL.SignatureChecker($CurrentSValue["joint_applicant_signature"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_applicant_signature" tabindex="23" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Applicant Passport Copy</legend>
                    <?php if($joint_applicant_passport_copy!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($joint_applicant_passport_copy);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_applicant_passport_copy" tabindex="24" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["joint_applicant_passport_copy"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_applicant_passport_copy" tabindex="25" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <hr>
                  <hr>
                  <hr>
                  <div class="text-center col-md-12">
                    <h4><?php echo 'Attached Document for Joint -> Nominee';?></h4>
                    <hr>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Nominee CNIC Front Side</legend>
                    <?php if($joint_nominee_cnic_front_side!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($joint_nominee_cnic_front_side);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["joint_nominee_cnic_front_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_nominee_cnic_front_side" tabindex="26" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Nominee CNIC Back Side</legend>
                    <?php if($joint_nominee_cnic_back_side!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($joint_nominee_cnic_back_side);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["joint_nominee_cnic_back_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_nominee_cnic_back_side" tabindex="27" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
					<?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Joint Nominee Passport Copy</legend>
                    <?php if($joint_nominee_passport_copy!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($joint_nominee_passport_copy);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["joint_nominee_passport_copy"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="joint_nominee_passport_copy" tabindex="28" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
              </div>
              <div class="card-footer text-center col-md-12">
                <button type="submit" class="btn btn-rose btn-fill" tabindex="29">Save</button>
                <button type="reset" class="btn btn-fill">Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
