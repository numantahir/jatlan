              <?php if(trim(DecData($_GET["sec"], 1, $objBF)) == ""){?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Resync Time & Attendance Records</h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
                          
               <div class="col-xs-6">
                    <div class="card">
                    <a href="<?php echo Route::_('show=restaction&sec='.EncData('SecTwo', 2, $objBF));?>">
                        <div class="card-content text-center">
                            <code>Resync Start to End Date Rang All Employee</code>
                        </div>
                    </a>
                    </div>
                </div>
                
                 <div class="col-xs-6">
                    <div class="card">
                    <a href="<?php echo Route::_('show=restaction&sec='.EncData('SecOne', 2, $objBF));?>">
                        <div class="card-content text-center">
                            <code>Recync Single Employee Base</code>
                        </div>
                    </a>
                    </div>
                </div>
</div>
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
              <?php } ?>
              <?php if(trim(DecData($_GET["sec"], 1, $objBF)) == "SecOne"){?>
          
          
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
          <input type="hidden" name="mode" value="<?php echo EncData('SecOne', 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Recync Time & Attendance Record Employee Base</h4>
            </div>
            <div class="toolbar back-btn text-right"> <a href="<?php echo Route::_('show=restaction');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12">
            
           <div class="row">
              <label class="col-sm-2 label-on-left">Start Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="start_date" tabindex="1" />
                </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="end_date" tabindex="2" />
                </div>
              </div>
            </div>
            
			
            <div class="row">
              <label class="col-sm-2 label-on-left">Select Employee <small>*</small></label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="employeeid" title="Employee List" tabindex="3">
                    <option value="">Select Employee</option>
                    <?php echo $objQayaduser->EmployeeCombo();?>
                  </select>
                </div>
              </div>
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
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

          
          
              <?php } elseif(trim(DecData($_GET["sec"], 1, $objBF)) == "SecTwo"){ ?>
              <div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="employeeform">
          <input type="hidden" name="mode" value="<?php echo EncData('SecTwo', 1, $objBF);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title">Recync Time & Attendance Record Data Range Base</h4>
            </div>
            <div class="toolbar back-btn text-right"> <a href="<?php echo Route::_('show=restaction');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12">
            
           <div class="row">
              <label class="col-sm-2 label-on-left">Start Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="start_date" tabindex="1" />
                </div>
              </div>
            </div>
            <div class="row">
              <label class="col-sm-2 label-on-left">End Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <label class="control-label"></label>
                  <input class="form-control datepicker" type="text" name="end_date" tabindex="2" />
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
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


              <?php } ?>
            