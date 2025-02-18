<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">List of Department</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            
             <?php
			 if($_GET["di"] == ''){
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'department_name');
					$objQayaduser->setProperty("isActive", 1);
					$objQayaduser->setProperty("company_id", $LoginUserInfo["company_id"]);
                    $objQayaduser->lstDepartments();
                    while($Leadslist = $objQayaduser->dbFetchArray(1)){
                    ?>
            <div class="col-md-4 col-md-offset-1">
                <div class="card">
                	<a href="<?php echo Route::_('show=departmentpage&di='.EncData($Leadslist["department_id"], 2, $objBF));?>">
                    <div class="card-content text-center">
                        <code><?php echo $Leadslist["department_name"];?></code>
                    </div>
                    </a>
                </div>
            </div>
			<?php } } else { ?>
            
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Employee Name</th>
                    <th>Phone Number</th>
                    <th>Department</th>
                    <th>Assign Date</th>
                    <th>Change</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Employee Name</th>
                    <th>Phone Number</th>
                    <th>Department</th>
                    <th>Assign Date</th>
                    <th>Change</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("ORDERBY", 'user_id DESC');
					$objQayaduser->setProperty("department_id", trim(DecData($_GET["di"], 1, $objBF)));
					$objQayaduser->setProperty("teamlead_status", 2);
                    $objQayaduser->VwUserDetail();
                    while($Userslist = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $Userslist["fullname"];?></td>
                    <td><?php echo $Userslist["user_mobile"];?></td>
                    <td><?php echo $Userslist["department_name"];?></td>
                    <td><?php echo dateFormate_3($Userslist["teamlead_date"]);?></td>
                    <td><a href="">Change</a></td>
                  </tr>
                  <?php } ?>
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