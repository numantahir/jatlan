<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h3 class="card-title CardWidth">List of Supplier's</h3>
        <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=productsform');?>" class="btn btn-primary">Add New</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
              <tr>
                <th>Product Name</th>
                <th>Product Size</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Set Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
					$objSSSjatlanSupplier = new SSSjatlan;
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("ORDERBY", 'product_id DESC');
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->lstProducts();
					while($ProductList = $objSSSjatlan->dbFetchArray(1)){
						
						$objSSSjatlanSupplier->resetProperty();
						$objSSSjatlanSupplier->setProperty("customer_id", $ProductList["vendor_id"]);
						$objSSSjatlanSupplier->lstCustomers();
						$GetSupplierDetail = $objSSSjatlanSupplier->dbFetchArray(1);
				?>
              <tr>
                <td><?php echo $ProductList["product_name"];?></td>
                <td><?php echo $ProductList["product_size"];?></td>
                <td><?php echo $GetSupplierDetail["customer_business_name"];?></td>
                <td><?php echo StatusName($ProductList["isActive"]);?></td>
                <td><a href="<?php echo Route::_('show=productprice&i='.EncData($ProductList["product_id"], 2, $objBF));?>">Set Price</a></td>
                <td><a href="<?php echo Route::_('show=productsform&i='.EncData($ProductList["product_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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
