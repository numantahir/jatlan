<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <?php if($SectionArea == 1){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="user_skills_id" value="<?php echo $objBF->encrypt($user_skills_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <input type="hidden" name="sectionarea" value="1">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Skills', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=profile');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Skill's</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'skills');?>">
                  <label class="control-label"></label>
                  <textarea class="form-control" name="skills" rows="10"><?php echo $skills;?></textarea>
                  <small><?php echo $vResult["skills"];?></small> </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } elseif($SectionArea == 2){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="user_education_id" value="<?php echo $objBF->encrypt($user_education_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <input type="hidden" name="sectionarea" value="1">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Employee Education', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=employeedu&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Institute Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'institute_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="institute_name" required value="<?php echo $institute_name;?>" tabindex="1" />
                  <small><?php echo $vResult["institute_name"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Major</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'major');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="major" value="<?php echo $major;?>" tabindex="2" />
                  <small><?php echo $vResult["major"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Start Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'start_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="start_date" required value="<?php echo dateFormate_11($start_date);?>" tabindex="4" />
                  <small><?php echo $vResult["start_date"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'end_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="end_date" required value="<?php echo dateFormate_11($end_date);?>" tabindex="5" />
                  <small><?php echo $vResult["end_date"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="6">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
            <label class="col-sm-2 label-on-left">Select Document File</label>
                <div class="col-md-2 text-center">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="fileinput-preview fileinput-exists thumbnail"></div>
                        <div>
                            <span class="btn btn-rose btn-round btn-file upload">
                                <span class="fileinput-new">Select File</span>
                                <span class="fileinput-exists">Change</span>
                                <input type="file" name="document_file" />
                            </span>
                            <a href="#pablo" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                        </div>
                    </div>
                </div>
            </div>
            
            
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } elseif($SectionArea == 3){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="user_employment_id" value="<?php echo $objBF->encrypt($user_employment_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Employee Employment', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=employmenthistory&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Company Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'company_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="company_name" required value="<?php echo $company_name;?>" tabindex="1" />
                  <small><?php echo $vResult["company_name"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Job Title</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'job_title');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="job_title" value="<?php echo $job_title;?>" tabindex="2" />
                  <small><?php echo $vResult["job_title"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Start Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'from_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="from_date" required value="<?php echo dateFormate_11($from_date);?>" tabindex="4" />
                  <small><?php echo $vResult["from_date"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'end_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="end_date" required value="<?php echo dateFormate_11($end_date);?>" tabindex="5" />
                  <small><?php echo $vResult["end_date"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="6">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } elseif($SectionArea == 4){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="user_reference_id" value="<?php echo $objBF->encrypt($user_reference_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Reference', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=employeedu&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Person Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'person_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="person_name" required value="<?php echo $person_name;?>" tabindex="1" />
                  <small><?php echo $vResult["person_name"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Contact No.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'contact_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="contact_no" required value="<?php echo $contact_no;?>" tabindex="2" />
                  <small><?php echo $vResult["contact_no"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Company Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'company_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="company_name" value="<?php echo $company_name;?>" tabindex="3" />
                  </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="6">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } elseif($SectionArea == 5){ ?>
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="user_emergency_id" value="<?php echo $objBF->encrypt($user_emergency_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="employee_id" value="<?php echo EncData(trim($objBF->decrypt($_GET["i"], 1, ENCRYPTION_KEY)), 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Emergency Number', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=employeedu&i='.$_GET["i"]);?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            <div class="row">
              <label class="col-sm-2 label-on-left">Person Name</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'person_name');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="person_name" required value="<?php echo $person_name;?>" tabindex="1" />
                  <small><?php echo $vResult["person_name"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Contact No.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'contact_number');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="contact_number" required value="<?php echo $contact_number;?>" tabindex="2" />
                  <small><?php echo $vResult["contact_number"];?></small> </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="3">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
          <?php } ?>
          
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
