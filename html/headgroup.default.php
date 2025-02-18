<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">domain_disabled</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Account Head Group's</h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=headgroupform');?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Head Group Title</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                  	<th>Head Group Title</th>
                    <th>Action</th>
                  </tr>
                </tfoot>
                <tbody>
					<?php
					$objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("ORDERBY", 'group_title');
                    $objQayadaccount->lstHeadGroup();
                    while($HeadGroup = $objQayadaccount->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $HeadGroup["group_title"];?></td>
                    <td><a href="<?php echo Route::_('show=headgroupform&i='.EncData($HeadGroup["head_group_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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