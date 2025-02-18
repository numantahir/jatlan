<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">access_time</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Check IN / OUT [<code><?php echo date("H:i:s");?></code>]</h4>
            <div class="toolbar text-right">  </div>
            <hr />
            
            <div class="col-md-6 Bord-Rt">
            <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo 'CI';?>">
            <div class="card-footer col-md-12"><br /><br /></div>
            <?php
			$objQayadAttendance->resetProperty();
			$objQayadAttendance->setProperty("device_id", 1);
			$objQayadAttendance->setProperty("device_uid", $LoginUserInfo["device_uid"]);
			$objQayadAttendance->setProperty("att_date", date("Y-m-d"));
			$objQayadAttendance->lstAttendance();
			$AttendanceREcord = $objQayadAttendance->dbFetchArray(1);
			if($AttendanceREcord["att_in"] == ''){	
			?>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" id="hideafterclick">Check-IN</button>
            </div>
            <?php } else { ?>
            <div class="card-footer text-center col-md-12">
              <div class="btn btn-default btn-fill">Check-IN</div>
            </div>
            <?php } ?>
          </form>
            
            </div>
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            <div class="col-md-6">
            <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo 'CO';?>">
            <div class="card-footer col-md-12"><br /><br /></div>
            <?php
			$objQayadAttendance->resetProperty();
			$objQayadAttendance->setProperty("device_id", 1);
			$objQayadAttendance->setProperty("device_uid", $LoginUserInfo["device_uid"]);
			$objQayadAttendance->setProperty("att_date", date("Y-m-d"));
			$objQayadAttendance->lstAttendance();
			$AttendanceREcord = $objQayadAttendance->dbFetchArray(1);
			if($AttendanceREcord["att_out"] == ''){	
			?>
            <div class="card-footer text-center col-md-12">
              <input type="hidden" name="ati" value="<?php echo EncData($AttendanceREcord["attendance_id"], 1, $objBF);?>">
              <button type="submit" class="btn btn-rose btn-fill" id="hideafterclick">Check-OUT</button>
            </div>
            <?php } else { ?>
            <div class="card-footer text-center col-md-12">
              <div class="btn btn-default btn-fill">Check-OUT</div>
            </div>
            <?php } ?>
            <div class="card-footer col-md-12"><br /><br /></div>
            
          </form>
            
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