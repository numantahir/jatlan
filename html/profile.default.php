<div class="content">
<div class="container-fluid">
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header card-header-text" data-background-color="rose">
        <h4 class="card-title">My Profile [ <?php echo $LoginUserInfo["fullname"];?> ]</h4>
      </div>
      <div class="toolbar btn-back text-right"> </div>
      <div class="card-content">
        <div class="col-md-12 Bord-Rt no-border-right">
          <h4>Basic Profile</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up basic-info" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">First Name</td>
                <td><?php echo $LoginUserInfo["user_fname"];?></td>
                <td class="profile_tb_heading">Last Name</td>
                <td><?php echo $LoginUserInfo["user_lname"];?></td>
              </tr>
              <tr>
                <td class="profile_tb_heading">Mobile#</td>
                <td><?php echo $LoginUserInfo["user_mobile"];?></td>
                <td class="profile_tb_heading">Phone#</td>
                <td><?php echo $LoginUserInfo["user_phone"];?></td>
              </tr>
              <tr>
                <td class="profile_tb_heading">Email</td>
                <td><?php echo $LoginUserInfo["user_email"];?></td>
                <td class="profile_tb_heading">CNIC</td>
                <td><?php echo $LoginUserInfo["user_cnic"];?></td>
              </tr>
              <tr>
                <td class="profile_tb_heading">Gender</td>
                <td><?php echo GenderSelection($LoginUserInfo["user_gender"]);?></td>
                <td class="profile_tb_heading">Blood Group</td>
                <td><?php echo BloodGroup($LoginUserInfo["blood_group"]);?></td>
              </tr>
              <tr>
                <td class="profile_tb_heading">Marital Status</td>
                <td><?php echo UserMaritalStatus($LoginUserInfo["user_marital_status"]);?></td>
                <td class="profile_tb_heading">Address</td>
                <td><?php echo $LoginUserInfo["user_address"];?></td>
              </tr>
            </tbody>
          </table>
          <hr>
          <h4>Job Description</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up work-info" cellspacing="0" width="100%" style="width:100%">
            <tbody>
              <tr>
                <td class="profile_tb_heading">Company Name</td>
                <td><?php echo $LoginUserInfo["company_name"];?></td>
                <td class="profile_tb_heading">Department Name</td>
                <td><?php echo $LoginUserInfo["department_name"];?></td>
              </tr>
              <tr>
                <td class="profile_tb_heading">Job Title</td>
                <td><?php echo $LoginUserInfo["job_title"];?></td>
                <td class="profile_tb_heading">Job Type</td>
                <td><?php echo JobTypeDetail($LoginUserInfo["job_type"]);?></td>
              </tr>
             
              <tr>
                <td class="profile_tb_heading">Probation Status</td>
                <td><?php echo YesNo($LoginUserInfo["probation_period_status"]);?></td>
                <td class="profile_tb_heading">Probation End on</td>
                <td><?php echo dateFormate_3($LoginUserInfo["probation_period_end_date"]);?></td>
              </tr>
               <tr>
                <td class="profile_tb_heading">Joined Date</td>
                <td><?php echo $LoginUserInfo["joined_date"];?></td>
                <td class="profile_tb_heading">Service End</td>
                <td><?php echo $LoginUserInfo["service_end_date"];?></td>
              </tr>
              
              
            </tbody>
          </table>
          <hr>
          <h4>My Skills <code style="float:right;"><a href="<?php echo Route::_('show=profileform&sa='.EncData("1", 2, $objBF));?>"><i class="material-icons">add</i></a></code></h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
          		<tr>
                <th>Skills</th>
                <th width="30">Action</th>
              </tr>
            <tbody>
            <?php
				$objQayaduser->resetProperty();
                $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isActive", 1);
                $objQayaduser->lstUserSkills();
                while($UserSkills = $objQayaduser->dbFetchArray(1)){
            ?>
              <tr>
                <td><?php echo $UserSkills["skills"];?></td>
                <td align="center"><a href="<?php echo Route::_('show=profileform&ei='.EncData($UserSkills["user_skills_id"], 2, $objBF).'&sa='.EncData("1", 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <hr>
          <h4>Education <code style="float:right;"><a href="<?php echo Route::_('show=profileform&sa='.EncData("2", 2, $objBF));?>"><i class="material-icons">add</i></a></code></h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up edu-info" cellspacing="0" width="100%" style="width:100%">
          		<tr>
                <th>Institute Name</th>
                <th>Major</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Note</th>
                <th>Doc File</th>
                <th width="30">Action</th>
              </tr>
            <tbody>
            <?php
				$objQayaduser->resetProperty();
                $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isAcitve", 1);
                $objQayaduser->lstUserEducationDetail();
                while($UserEducation = $objQayaduser->dbFetchArray(1)){
            ?>
              <tr>
                <td><?php echo $UserEducation["institute_name"];?></td>
                <td><?php echo $UserEducation["major"];?></td>
                <td><?php echo dateFormate_3($UserEducation["start_date"]);?></td>
                <td><?php echo dateFormate_3($UserEducation["end_date"]);?></td>
                <td><?php echo $UserEducation["other_note"];?></td>
                <td>
                <?php if($UserEducation["document_file"] != ''){?>
                <a href="<?php echo SITE_URL;?>dn.php?di=<?php echo EncData(USER_DOCUMENT_URL.$UserEducation["document_file"], 2, $objBF);?>&dfn=<?php echo EncData($UserEducation["document_file_name"], 2, $objBF);?>">Doc File</a>
                <?php } else { ?>
                No File
                <?php } ?>
                </td>
                <td align="center"><a href="<?php echo Route::_('show=profileform&ei='.EncData($UserEducation["user_education_id"], 2, $objBF).'&sa='.EncData("2", 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <hr>
          <h4>Employment History <code style="float:right;"><a href="<?php echo Route::_('show=profileform&sa='.EncData("3", 2, $objBF));?>"><i class="material-icons">add</i></a></code></h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up emp-history" cellspacing="0" width="100%" style="width:100%">
          		<tr>
                <th>Company Name</th>
                <th>Job Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th width="30">Action</th>
              </tr>
            <tbody>
            <?php
				$objQayaduser->resetProperty();
                $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isActive", 1);
                $objQayaduser->lstUserEmploymentHistory();
                while($UserEmployment = $objQayaduser->dbFetchArray(1)){
            ?>
              <tr>
                <td><?php echo $UserEmployment["company_name"];?></td>
                <td><?php echo $UserEmployment["job_title"];?></td>
                <td><?php echo dateFormate_3($UserEmployment["from_date"]);?></td>
                <td><?php echo dateFormate_3($UserEmployment["end_date"]);?></td>
                <td align="center"><a href="<?php echo Route::_('show=profileform&ei='.EncData($UserEmployment["user_employment_id"], 2, $objBF).'&sa='.EncData("3", 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          
          <hr>
          <h4>Reference Detail <code style="float:right;"><a href="<?php echo Route::_('show=profileform&sa='.EncData("4", 2, $objBF));?>"><i class="material-icons">add</i></a></code></h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up ref-detail" cellspacing="0" width="100%" style="width:100%">
          		<tr>
                <th>Person Name</th>
                <th>Company Name</th>
                <th>Contact Number</th>
                <th width="30">Action</th>
              </tr>
            <tbody>
            <?php
				$objQayaduser->resetProperty();
                $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isActive", 1);
                $objQayaduser->lstUserReference();
                while($UserReference = $objQayaduser->dbFetchArray(1)){
            ?>
              <tr>
                <td><?php echo $UserReference["person_name"];?></td>
                <td><?php echo $UserReference["company_name"];?></td>
                <td><?php echo $UserReference["contact_no"];?></td>
                <td align="center"><a href="<?php echo Route::_('show=profileform&ei='.EncData($UserReference["user_reference_id"], 2, $objBF).'&sa='.EncData("4", 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <hr>
          <h4>Emergency Contact Detail <code style="float:right;"><a href="<?php echo Route::_('show=profileform&sa='.EncData("5", 2, $objBF));?>"><i class="material-icons">add</i></a></code></h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up emer-detail" cellspacing="0" width="100%" style="width:100%">
          		<tr>
                <th>Person Name</th>
                <th>Contact Number</th>
                <th width="30">Action</th>
              </tr>
            <tbody>
            <?php
				$objQayaduser->resetProperty();
                $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isActive", 1);
                $objQayaduser->lstUserEmergency();
                while($UserEmergency = $objQayaduser->dbFetchArray(1)){
            ?>
              <tr>
                <td><?php echo $UserEmergency["person_name"];?></td>
                <td><?php echo $UserEmergency["contact_number"];?></td>
                <td align="center"><a href="<?php echo Route::_('show=profileform&ei='.EncData($UserEmergency["user_emergency_id"], 2, $objBF).'&sa='.EncData("5", 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <hr>
          <h4>Shift Detail</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up shift-timing" cellspacing="0" width="100%" style="width:100%">
          	   <tr>
                <th>Shift Name</th>
                <th>Day</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>LIGT</th>
                <th>LOGT</th>
                <th>EOGT</th>
                <th>On/Off</th>
              </tr>
            <tbody>
            <?php
				$objQayadShift = new Qayaduser;
				$objQayaduser->resetProperty();
                $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isActive", 1);
				$objQayaduser->setProperty("ORDERBY", 'day_id');
                $objQayaduser->lstUserShifts();
                while($UserShitDetail = $objQayaduser->dbFetchArray(1)){
						$objQayadShift->setProperty("shift_id", $UserShitDetail["shift_id"]);
						$objQayadShift->lstShifts();
						$ShitDetail = $objQayadShift->dbFetchArray(1);
            ?>
              <tr>
                <td><?php echo $ShitDetail["shift_name"];?></td>
                <td><?php echo GetDayName($UserShitDetail["day_id"]);?></td>
                <td><?php echo $ShitDetail["shift_st"];?></td>
                <td><?php echo $ShitDetail["shift_et"];?></td>
                <td><?php echo $ShitDetail["shift_ligt"];?></td>
                <td><?php echo $ShitDetail["shift_logt"];?></td>
                <td><?php echo $ShitDetail["shift_eogt"];?></td>
                <td><?php echo OnOff($UserShitDetail["day_status"]);?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <hr>
          <h4>Bonus Amount</h4>
          <hr>
          <table class="table table-striped table-no-bordered table-hover follow-up bonus-amt" cellspacing="0" width="100%" style="width:100%">
          		<tr>
                <th>Bonus Amount</th>
                <th>Bonus Status</th>
                <th>Date</th>
              </tr>
            <tbody>
            <?php
				$objQayaduser->resetProperty();
                $objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
				$objQayaduser->setProperty("isActive", 1);
                $objQayaduser->lstBonus();
                while($UserBonus = $objQayaduser->dbFetchArray(1)){
            ?>
              <tr>
                <td><div style="display:none;float: left;margin-right: 20px;" id="mybonus_<?php echo $UserBonus["user_bonus_id"];?>">
				<?php echo Numberformt($UserBonus["bonus_amount"]);?>
                </div> <span onClick="ShowHide('mybonus_<?php echo $UserBonus["user_bonus_id"];?>', 'mybonus_<?php echo $UserBonus["user_bonus_id"];?>_text');" id="mybonus_<?php echo $UserBonus["user_bonus_id"];?>_text">Show</span></td>
                <td><?php echo BonusStatus($UserBonus["bonus_status"]);?></td>
                <td><?php echo dateFormate_4($UserBonus["entery_date"]);?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
