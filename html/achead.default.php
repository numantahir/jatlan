<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Account Head's</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=acheadform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Head Code</th>
                    <th>Head Title</th>
                    <th>Head Group</th>
                    <th>Head Type</th>
                    <th>Description</th>
                    <th><i class="material-icons">edit</i></th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadaccount->resetProperty();
					$objQayadaccountgroup = new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
							$objQayadaccountgroup->setProperty("head_group_id", $AccountHeadList["head_group_id"]);
							$objQayadaccountgroup->lstHeadGroup();
							$HeadGroup = $objQayadaccountgroup->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo $AccountHeadList["head_code"];?></td>
                    <td><?php echo $AccountHeadList["head_title"];?></td>
                    <td><?php echo $HeadGroup["group_title"];?></td>
                    <td><?php echo AccountHeadType($AccountHeadList["head_type_id"]);?></td>
                    <td><?php echo $AccountHeadList["head_description"];?></td>
                    <td><a href="<?php echo Route::_('show=acheadform&i='.EncData($AccountHeadList["head_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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