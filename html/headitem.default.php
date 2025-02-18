<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Head Item's</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=headitemform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Item Title</th>
                    <th>Head</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th><i class="material-icons">edit</i></th>
                  </tr>
                </thead>
                <tbody>
					<?php
					$objQayadaccount->resetProperty();
					$objQayadaccountHead = new Qayadaccount;
					//$objQayadaccount->setProperty("user_id", trim($objBF->decrypt($objQayaduser->user_id, 1, ENCRYPTION_KEY)));
                    $objQayadaccount->setProperty("ORDERBY", 'item_title');
                    $objQayadaccount->lstHeadItems();
                    while($HeadItemList = $objQayadaccount->dbFetchArray(1)){
							$objQayadaccountHead->setProperty("head_id", $HeadItemList["head_id"]);
							$objQayadaccountHead->lstHead();
							$AccountHead = $objQayadaccountHead->dbFetchArray(1);
                    ?>
                  <tr>
                    <td><?php echo $HeadItemList["item_title"];?></td>
                    <td><?php echo $AccountHead["head_title"];?></td>
                    <td><?php echo AccountHeadItemType($HeadItemList["head_type"]);?></td>
                    
                    <td><?php echo $HeadItemList["item_description"];?></td>
                    <td><a href="<?php echo Route::_('show=headitemform&i='.EncData($HeadItemList["item_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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