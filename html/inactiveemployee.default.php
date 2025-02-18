<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">person</i> </div>
          <div class="card-content">
            <?php if($_GET["i"]==''){?>
            <h3 class="card-title CardWidth">InActive Employees Management</h3>
            <div class="toolbar add-btn text-right">
            <?php if($objCheckLogin->user_type == 9){ ?>
            <a href="<?php echo Route::_('show=employeform');?>" class="btn btn-primary">Add New</a>
            <?php } ?>
            </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Company/Location</th>
                    <th>Position</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <?php if($objCheckLogin->user_type == 9){ ?>
                    <th>Action</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Company/Location</th>
                    <th>Position</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <?php if($objCheckLogin->user_type == 9){ ?>
                    <th>Action</th>
                    <?php } ?>
                  </tr>
                </tfoot>
                <tbody>
                <?php
				//1=>Admin, 2=>Front Desk, 3=>Finance, 4=>Agent, 5=>Sales, 6=>SMS Account, 7=>Director, 8=>Creative-Director, 9=>HR, 10=>Employee
					$objQayadLocation = new Qayaduser;
					$objQayaduser->setProperty("isActive", 2);
					//$objQayaduser->setProperty("user_type_id_array", '2,3,4,5,6,7,8,9,10,11');
					$objQayaduser->setProperty("user_type_id_not", '1');
					$objQayaduser->setProperty("ORDERBY", 'user_fname DESC');
					$objQayaduser->lstUsers();
					while($ListOfUsers = $objQayaduser->dbFetchArray(1)){
					//	print_r($ListOfUsers).'<br>';
				?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=employees&i='.EncData($ListOfUsers["user_id"], 2, $objBF));?>"><?php echo $ListOfUsers["fullname"];?></a></td>
                    <td><?php echo $objQayadLocation->GetComLocInfo($ListOfUsers["location_id"]);?></td>
                    <td><?php echo $ListOfUsers["user_designation"];?></td>
                    <td><?php echo $ListOfUsers["user_mobile"];?></td>
                    <td><?php echo UserType($ListOfUsers["user_type_id"]);?></td>
                    <?php if($objCheckLogin->user_type == 9){ ?>
                    <td class="td-actions">
                    <a href="<?php echo Route::_('show=employeopt&i='.EncData($ListOfUsers["user_id"], 2, $objBF));?>" type="button" rel="tooltip" class="btn btn-success btn-simple form-edit"> <i class="material-icons">storage</i> </a></td>
                    <?php } ?>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else { 
			$objQayadLocation = new Qayaduser;
			$objQayaduser->setProperty("user_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
			$objQayaduser->lstUsers();
			$UserInfo = $objQayaduser->dbFetchArray(1);
			?>
            <h4 class="card-title CardWidth">Employee Management :: <span class="text-primary"><?php echo $UserInfo["fullname"];?></span></h4>
            <div class="toolbar add-btn text-right"> </div>
            <div class="table-responsive">
              <table class="table" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td class="text-primary label-type">Name</td>
                    <td class="value"><?php echo $UserInfo["fullname"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Email Address</td>
                    <td class="value"><?php echo $UserInfo["user_email"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Mobile #</td>
                    <td class="value"><?php echo $UserInfo["user_mobile"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Phone #</td>
                    <td class="value"><?php echo $UserInfo["user_phone"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Address</td>
                    <td class="value"><?php echo $UserInfo["user_address"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">CNIC</td>
                    <td class="value"><?php echo CnicFormat($UserInfo["user_cnic"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Company / Location</td>
                    <td class="value"><?php echo $objQayadLocation->GetComLocInfo($UserInfo["location_id"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">User Type</td>
                    <td class="value"><?php echo UserType($UserInfo["user_type_id"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Designation</td>
                    <td class="value"><?php echo $UserInfo["user_designation"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Profile Image</td>
                    <td class="value"><div class="col-md-4 col-sm-4">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail"> <img src="<?php echo USER_PROFILE_THUMB_URL.ProfileImgChecker($UserInfo["user_profile_img"]);?>" alt="<?php echo $UserInfo["fullname"];?>" style="width:100px;"> </div>
                        </div>
                      </div></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Signature</td>
                    <td class="value"><div class="col-md-4 col-sm-4">
                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                          <div class="fileinput-new thumbnail"> <img src="<?php echo USER_SIGNATURE_THUMB_URL.SignatureChecker($UserInfo["user_signature"]);?>" alt="<?php echo $UserInfo["fullname"];?>" style="width:100px;"> </div>
                        </div>
                      </div></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <?php } ?>
          </div>
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>