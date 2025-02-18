<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Customer Type Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=customertypeform');?>" class="btn btn-primary">Add New</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Customer Type</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'category_name');
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->setProperty("category_type", 1);
                    $objSSSjatlan->lstCustomerCategory();
					//$GetList = $objQayaduser->SQLTestFunc();
					//print_r($GetList);
					//die();
                    while($Location = $objSSSjatlan->dbFetchArray(1)){
                    ?>
                  <tr>
                    <td><?php echo $Location["category_name"];?></td>
                    <td><?php echo StatusName($Location["isActive"]);?></td>
                    <td><a href="<?php echo Route::_('show=customertypeform&i='.EncData($Location["category_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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