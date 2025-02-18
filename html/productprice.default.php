<?php
$PriductID = trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY));
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("product_id", $PriductID);
$objSSSjatlan->lstProducts();
$GetProductInfo = $objSSSjatlan->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h3 class="card-title CardWidth">List of <code><?php echo $GetProductInfo["product_name"];?></code> Price Detail</h3>
        <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=productpriceform&p='.EncData($GetProductInfo["product_id"], 2, $objBF));?>" class="btn btn-primary">Add New</a> </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
          <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
            <thead>
              <tr>
                <th>Buy Price</th>
                <th>Selling Size</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("product_id", $PriductID);
					$objSSSjatlan->setProperty("ORDERBY", 'product_price_id DESC');
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->lstProductPrice();
					while($ProductList = $objSSSjatlan->dbFetchArray(1)){
				?>
              <tr>
                <td><?php echo RsAmount($ProductList["buy_price"]) . ' <code>/Bag</code>';?></td>
                <td><?php echo RsAmount($ProductList["selling_price"]) . ' <code>/Bag</code>';?></td>
                <td><?php echo StatusName($ProductList["isActive"]);?></td>
                <td><a href="<?php echo Route::_('show=productpriceform&i='.EncData($ProductList["product_price_id"], 2, $objBF).'&p='.EncData($ProductList["product_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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
