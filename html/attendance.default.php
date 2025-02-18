<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">markunread_mailbox</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">Attendance Management</h3>
            <div class="toolbar add-btn text-right"></div>
            <hr>
            
            <?php if(trim(DecData($_GET["v"], 1, $objBF)) != "monthly"){ ?>
            
            <div class="material-datatables">
				<h4><code>Attendance Report's</code></h4>
                
                
                
              <div class="col-xs-4">
                    <div class="card">
                    <a href="#" onClick="openRequestedPopup('<?php echo SITE_URL.'monthly_attendance.php';?>', 2);">
                        <div class="card-content text-center">
                            <code>This Month Attendance All Employee</code>
                        </div>
                    </a>
                    </div>
                </div>
                
              <div class="col-xs-4">
                    <div class="card">
                    <a href="<?php echo Route::_('show=attendance&v='.EncData("monthly", 2, $objBF));?>">
                        <div class="card-content text-center">
                            <code>Monthly Base Attendance</code>
                        </div>
                    </a>
                    </div>
                </div>
                
              <div class="col-xs-4" style="display:none;">
                    <div class="card">
                    <a href="<?php echo Route::_('show=employeform&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                        <div class="card-content text-center">
                            <code>Last Month Attendance All Employee</code>
                        </div>
                    </a>
                    </div>
                </div>
                
              <div class="col-xs-4" style="display:none;">
                    <div class="card">
                    <a href="<?php echo Route::_('show=employeform&i='.EncData($EmployeData["user_id"], 2, $objBF));?>">
                        <div class="card-content text-center">
                            <code>Last Month Attendance Selective Employee</code>
                        </div>
                    </a>
                    </div>
                </div> 
              
              <hr>
              
              <h4><code>Attendance Modification / Add</code></h4>
              <div class="col-xs-4">
                    <div class="card">
                    <a href="<?php echo Route::_('show=attendancemodification');?>">
                        <div class="card-content text-center">
                            <code>Modify In/Out Time</code>
                        </div>
                    </a>
                    </div>
                </div>
              
              <div class="col-xs-4">
                    <div class="card">
                    <a href="<?php echo Route::_('show=addattendance');?>">
                        <div class="card-content text-center">
                            <code>Add Manually Attendance</code>
                        </div>
                    </a>
                    </div>
                </div>
              
            </div>
			<?php } else { ?>
            
            <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Start Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="st_date" required tabindex="1" />
                   </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="en_date" required tabindex="2" />
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
          <!-- end content--> 
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>