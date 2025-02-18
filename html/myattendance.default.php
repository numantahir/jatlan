<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">markunread_mailbox</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth"><?php echo date("M");?> Attendance </h3>
            <div class="toolbar add-btn text-right"></div>
            <hr>
            <div class="material-datatables">
              <?php include_once(INC_PATH . 'empatt.php'); ?>
              <div class="cal-arrow">
					<div class="arrows">
                    <?php if($LastMonth >= 1 && $LastMonth <= 12){?>
					<a class="left-arrow" href="<?php echo Route::_('show=myattendance&m='.$LastMonth);?>">
                    <?php } else { ?>
                    <a class="left-arrow" href="javascript:void(0)">
					<?php } ?>
                    <img src="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/left-arrow.png" alt="arrow" style="height:35px !important;"></a><span><?php echo MonthList($month).' '.date("Y");?></span>
                    <?php if($NextMonth >= 1 && $NextMonth <= 12){?>
					<a class="right-arrow" href="<?php echo Route::_('show=myattendance&m='.$NextMonth);?>">
                    <?php } else { ?>
                    <a class="right-arrow" href="javascript:void(0)">
					<?php } ?>
                    <img src="<?php echo SITE_URL;?>assets<?php echo $CallMenuBarAndHeader;?>/img/right-arrow.png" alt="arrow" style="height:35px !important;"></a>
						</div>
				</div>
                
                
                
                
              <div class="col-md-8 col-xs-12 left-side">
                <table border="0" class="table table-striped table-no-bordered table-hover calendar" cellspacing="0" width="100%" style="float: left; margin-right: 10px;">
                  <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                  </tr>
                  <tr>
                    <?php include_once(INC_PATH . 'empattdetail.php'); ?>
                </table>
                <div class="legend-heading">Legend</div>
                <ul class="lagends">
                  <li>
                    <div class="color-box weekend"></div>
                    Weekend</li>
                  <li>
                    <div class="color-box absent"></div>
                    Absent</li>
                  <li>
                    <div class="color-box present"></div>
                    Present</li>
                  <li>
                    <div class="color-box leave"></div>
                    Leave</li>
                  <li>
                    <div class="color-box holiday"></div>
                    Holiday</li>
                  <li style="display:none;">
                    <div class="color-box time-over"></div>
                    Over time</li>
                  <li>
                    <div class="color-box late-in"></div>
                    Late-In / Early-Out</li>
                </ul>
              </div>
              <div class="col-md-4 col-xs-12">
                <div class="attends-detail">
                  <div class="cal-month">This Month overview</div>
                  <div class="login-time logout">Late-In Time: <span><?php echo MinutesConvertHours($LateInTotalTimeMint);?></span></div>
                  <div class="login-time">Late-In Cutting: <span><?php echo $LateComingCutting;?> Days</span></div>
                  <div class="login-time logout" style="display:none;">OverTime (1): <span><?php echo MinutesConvertHours($OverTimeFirstShiftCount); ?></span></div>
                  <div class="login-time logout" style="display:none;">OverTime (1.5): <span><?php echo MinutesConvertHours($OverTimeSecondShiftCount); ?></span></div>
                  <div class="login-time logout" style="display:none;">OverTime (2.0): <span><?php echo MinutesConvertHours($OverTimeThirdShiftCount); ?></span></div>
                  <div class="login-time logout">Number of Absent: <span><?php echo $TotalNumberofAbsent; ?></span></div>
                  <div class="login-time logout">Number of Leaves: <span><?php echo $TotalNumberofLeave; ?></span></div>
                  <div class="login-time logout">Short-Time / Early-Out: <span><?php echo MinutesConvertHours($TotalRemainingShortTime);?></span></div>
                  <div class="login-time logout">Short-Time / Early-Out Cutting: <span><?php echo $ShortTimeCuttingValue;?> Days</span></div>
                </div>
                <div class="attends-detail">
                  <div class="cal-month" id="att_req_mdate"><?php echo date("jS M, Y", strtotime(date("Y-m-d")));?></div>
                  <div class="cal-day" id="att_req_dayname"><?php echo $PassTodayDayName;?></div>
                  <div class="login-time">Log in time: <span id="att_req_logInTime"><?php echo TimerChecker($PassTodayInTime);?></span></div>
                  <div class="login-time logout">Log out time: <span id="att_req_logOutTime"><?php echo TimerChecker($PassTodayOutTime);?></span></div>
                  <div class="login-time extra-time" style="display:none;">Over time: <span id="att_overtile_div"> <?php echo $TodayOverTimePass;?> </span></div>
                  <div class="login-time extra-time">Short time: <span id="att_sorttime_div"> <?php echo $TodayShortTimePass;?></span></div>
                  <div class="total-time">Total hours worked: <span id="TotalNoOfHours"><?php echo AttValueChecker($PassTodayNumberofHours);?></span></div>
                  <div class="late-time">Late in <small>(LI)</small>: <span id="att_latein_div"><?php echo AttValueChecker($TodayLateInTimePass);?> Mins</span></div>
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
