<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Payment Mode Info</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=paymentinfoform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Mode Type</th>
                    <th>Mode Title</th>
                    <th>Mode Detail</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("ORDERBY", 'pm_info_id');
                    $objQayadaccount->lstPaymentModeInfo();
                    while($PaymentMode = $objQayadaccount->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo PaymentModeType($PaymentMode["pm_mode_id"]);?></td>
                    <td><?php echo $PaymentMode["pm_mode_title"];?></td>
                    <td><?php echo $PaymentMode["m_mode_detail"];?></td>
                    <td><a href="<?php echo Route::_('show=paymentinfoform&i='.EncData($PaymentMode["pm_info_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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