<?php
$objQayadapplication->resetProperty();
$objQayadapplication->setProperty("aplic_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadapplication->lstApplication();
$ApplicationDetail = $objQayadapplication->dbFetchArray(1);

$StoreCustomerDocImgName = array();
$objQayadapplicationCNIC = new Qayadapplication;
$objQayadapplicationCNIC->setProperty("aplic_id", $ApplicationDetail["aplic_id"]);
$objQayadapplicationCNIC->lstGeneralDocument();
while($GetCustomerCNICFrontSide = $objQayadapplicationCNIC->dbFetchArray(1)){
$StoreCustomerDocImgName[$GetCustomerCNICFrontSide["url_key"]] = $GetCustomerCNICFrontSide["document_filename"];
}
$objQayadapplication->resetProperty();
$objQayadapplication->setProperty("customer_id", $ApplicationDetail['customer_id']);
$objQayadapplication->lstApplicationCustomer();
$GetCustomerDoc = $objQayadapplication->dbFetchArray(1);
$CustomerProfileImageName = $GetCustomerDoc["customer_image"];
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="ai" value="<?php echo EncData(trim(DecData($_GET["i"], 1, $objBF)), 1, $objBF);?>">
            <input type="hidden" name="stg" value="4">
            <input type="hidden" name="ci" value="<?php echo EncData($ApplicationDetail["customer_id"], 1, $objBF);?>" />
            <input type="hidden" name="ni" value="<?php echo EncData($ApplicationDetail["nominee_id"], 1, $objBF);?>" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Document Upload for Application#'.$ApplicationDetail["reg_number"];?></h4>
            </div>
            <div class="toolbar btn-back text-right view-form">
              <!--<a href="#" data-toggle="modal" data-target="#applicationform" class="btn">View Form</a>-->
              <a href="#" class="btn">View Form</a>
              <?php //include(HTML_PATH.'applicationform.php');?>
            </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt">
              <?php print_r($vResult);?>
                <div class="row">
                  <div class="text-center col-md-12">
                    <h4><?php echo 'Attached Document for Applicant';?></h4>
                    <hr>
                  </div>
                  <?php /* 
				  //Upload Application Profile Image via camera 
                  <div class="col-md-4 text-center">
                    <legend>Applicant Profile Image <?php //echo EncData('mode_1', 2, $objBF);?></legend>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <input type="hidden" id="applicant_propfile_image_data" name="applicant_propfile_image_data" value="">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_profile_image"]);?>" id="applicantprofileimage" class="applicantprofileimage" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new" data-toggle="modal" data-target="#webcam" onClick="loadcam();">Select image</span> </span> 
                        </div>      
                    </div>
                  </div>
                  */ ?>
                  <?php
                  /*
				  //Old Applicant Profile Image Uploadng Section
				  */
				  ?>
                  <div class="col-md-3 text-center">
                    <legend>Applicant Profile Image </legend>
                    <?php if($CustomerProfileImageName !=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CustomerProfileImageName);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_PROFILE_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_profile_image"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_profile_image" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-3 text-center">
                    <legend>Applicant CNIC Front Side</legend>
                    <?php if($StoreCustomerDocImgName["applicant_cnic_front_side"] !=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreCustomerDocImgName["applicant_cnic_front_side"]);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_cnic_front_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_cnic_front_side" required="required" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-3 text-center">
                    <legend>Applicant CNIC Back Side</legend>
                    <?php if($StoreCustomerDocImgName["applicant_cnic_back_side"] !=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreCustomerDocImgName["applicant_cnic_back_side"]);?>" alt="..."> </div>
                    </div>
                    <?php } else { ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["applicant_cnic_back_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_cnic_back_side" required="required" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-3 text-center">
                    <legend>Applicant Signature</legend>
                    <?php if($GetCustomerDoc["customer_sign"]!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_SIGNATURE_THUMB_URL.ProfileImgChecker($GetCustomerDoc["customer_sign"]);?>" alt="..."> </div>
                    </div>
                    <?php }else{ ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_SIGNATURE_THUMB_URL.SignatureChecker($CurrentSValue["applicant_signature"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="applicant_signature" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <hr>
                  <div class="text-center col-md-12">
                    <h4><?php echo 'Attached Document for Nominee';?></h4>
                    <hr>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Nominee CNIC Front Side</legend>
                    <?php if($StoreCustomerDocImgName["nominee_cnic_front_side"]!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreCustomerDocImgName["nominee_cnic_front_side"]);?>" alt="..."> </div>
                    </div>
                    <?php }else{ ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["nominee_cnic_front_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="nominee_cnic_front_side" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  <div class="col-md-4 text-center">
                    <legend>Nominee CNIC Back Side</legend>
                    <?php if($StoreCustomerDocImgName["nominee_cnic_back_side"]!=''){?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($StoreCustomerDocImgName["nominee_cnic_back_side"]);?>" alt="..."> </div>
                    </div>
                    <?php }else{ ?>
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-new thumbnail"> <img src="<?php echo CUSTOMER_DOCUMENT_THUMB_URL.ProfileImgChecker($CurrentSValue["nominee_cnic_back_side"]);?>" alt="..."> </div>
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div> <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new">Select image</span> <span class="fileinput-exists">Change</span>
                        <input type="file" name="nominee_cnic_back_side" />
                        </span> <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a> </div>
                    </div>
                    <?php } ?>
                  </div>
                  
                </div>
              </div>
              
              
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Upload & Forward to Finance Department >></button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <div class="modal fade" id="webcam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-notice" style="width:300px;">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick="StopWebCam();"><i class="material-icons">clear</i></button>
                  <h5 class="modal-title" id="myModalLabel"><i class="material-icons">camera_alt</i> Applicant Profile Picture</h5>
                </div>
                <div class="modal-body text-center">
                  <div id="cam_screen"></div>
                  <span class="btn btn-rose btn-round btn-file"> <span class="fileinput-new" onClick="take_snapshot();"><i class="material-icons">camera_alt</i> Take Picture</span> </span> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
