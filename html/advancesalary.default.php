<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Advance Salary Request</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=advsalaryform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Amount</th>
                    <th>Date/Month</th>
                    <th>PayBack Mode</th>
                    <th>PayBack Duration</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Amount</th>
                    <th>Date/Month</th>
                    <th>PayBack Mode</th>
                    <th>PayBack Duration</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayaduser->resetProperty();
                    $objQayaduser->setProperty("isActive_not", 3);
					$objQayaduser->setProperty("user_id", $LoginUserInfo["user_id"]);
                    $objQayaduser->lstUserAdvanceSalary();
                    while($AdvanceSalary = $objQayaduser->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $AdvanceSalary["salary_amount"];?></td>
                    <td><?php echo MonthList($AdvanceSalary["advance_month"]);?></td>
                    <td><?php echo AdvancePayBackMode($AdvanceSalary["payback_option"]);?></td>
                    <td><?php echo $AdvanceSalary["payback_in_months"];?> Month's</td>
                    <td><?php echo LeaveStatus($AdvanceSalary["advance_salary_status"]);?></td>
                    <td>
                    <?php if($AdvanceSalary["advance_salary_status"] == 1){?>
                    <a href="<?php echo Route::_('show=advancesalary&rq='.EncData('Delete', 2, $objBF).'&i='.EncData($AdvanceSalary["advance_salary_id"], 2, $objBF));?>"><i class="material-icons">delete</i></a>
                    <?php } else { }?>
                    </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
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