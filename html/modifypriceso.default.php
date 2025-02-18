<style>
.card-title-customize {
	font-size: 16px !important;
	padding-bottom: 0px !important;
}
</style>
<?php
$CallWSet = 'col-md-2';
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth">Modify Purchase Order Price </h4>

            <div class="col-md-12">
  <hr>

  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="mode" value="search">
    <div class="col-md-3">
      <div class="card-content ledger"> <code>Start Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="start_date" value="<?php echo $ReturnStartDate;?>" required tabindex="1" />
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card-content ledger"> <code>End Date</code>
        <div class="form-group start">
          <input type="text" class="form-control datepicker" name="end_date" value="<?php echo $ReturnEndDate;?>" required tabindex="2" />
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card-content ledger"> <code>Select Vendor</code>
        <div class="form-group">
          <select class="selectpicker" data-style="select-with-transition" data-live-search="true" name="by_vendor" title="Select Vendor" required tabindex="3">
          <option>Select Vendor</option>
            <?php
			$objSSSjatlan->resetProperty();
			$objSSSjatlan->setProperty("ORDERBY", 'customer_id DESC');
			$objSSSjatlan->setProperty("customer_type", 2);
			$objSSSjatlan->setProperty("isNot", 3);
			$objSSSjatlan->lstCustomers();
			while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
			?>
            <option value="<?php echo $CustomerList["customer_id"];?>"<?php echo StaticDDSelection($CustomerList["customer_id"], $Return_by_vendor);?>><?php echo $CustomerList["customer_business_name"];?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    </div>

    
    
    <div class="col-md-2">
      <div class="card-content ledger">
        <div class="form-group" style="text-align:center;">
          <button type="submit" class="btn btn-success btn-round" tabindex="4">Load List</button>
        </div>
      </div>
    </div>
  </form>
 
  
</div>

<?php //} ?>
            
            <hr>
            <div class="material-datatables">
            
<?php if($_GET['d'] == 'r'){?>
  <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="upval" value="yes">
            <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Order#</th>
                  	<th>Order Date</th>
                    <th>Item</th>
                    <th>COF</th>
                    <th>Qty</th>
                    <th>Rate</th>
                    <th>Final Amount</th>
                    <th>New Rate</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
          $count = 0;
					// die($ReturnStartDate . ' --- ' . $ReturnEndDate);
					$objSSSDestination = new SSSjatlan;
					$objSSSCustomers = new SSSjatlan;
					$objSSSProducts = new SSSjatlan;
					$objSSSVehcil = new SSSjatlan;
					$objSSSjatlan->resetProperty();
          $objSSSjatlan->setProperty("ORDERBY", 'order_request_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_request_type", 2);
					$objSSSjatlan->setProperty("order_process_status", 1);
          $objSSSjatlan->setProperty("vendor_id", $Return_by_vendor);

          $objSSSjatlan->setProperty("DATEFILTER", 'yes');
          $objSSSjatlan->setProperty("STARTDATE", dateFormate_10($ReturnStartDate));
          $objSSSjatlan->setProperty("ENDDATE", dateFormate_10($ReturnEndDate));
          
					//DATEFILTER
          $objSSSjatlan->setProperty("order_status", 1);
                    $objSSSjatlan->lstOrderRequestDetail();
                    while($OrderRequest = $objSSSjatlan->dbFetchArray(1)){
                      $count++;
							$objSSSProducts->resetProperty();
							$objSSSProducts->setProperty("product_id", $OrderRequest["product_id"]);
							$objSSSProducts->lstProducts();
							$ProductInfo = $objSSSProducts->dbFetchArray(1);
							
                    ?>
                  <tr>
                  <td><?php echo $OrderRequest["tran_code"];?></td>
                  <td><?php echo dateFormate_4($OrderRequest["d_date"]);?></td>
                    <td><?php echo $ProductInfo["product_name"];?></td>
                    <td><?php echo $OrderRequest["cof_no"];?></td>
                    <td><?php echo $OrderRequest["no_of_items"];?></td>
                    <td><?php echo $OrderRequest["per_item_amount"];?></td>
                    <td><?php echo $OrderRequest["final_amount"];?></td>
                    <td><input type="hidden" name="ordi[]" value="<?php echo $OrderRequest["order_request_id"];?>">
                    <input type="text" name="pia_<?php echo $OrderRequest["order_request_id"];?>" value="<?php echo $OrderRequest["per_item_amount"];?>">
                  </td>
                    
                    
                   
                  </tr>
                  <?php } ?>

                  <tr>
                  <td colspan="7"></td>
                    <td align="right">
                    <?php if($count > 0){?>  
                    <button type="submit" class="btn btn-rose btn-fill" tabindex="8">Update Per Item Amount</button>
                    <?php } ?>
                  </td>
                    
                    
                   
                  </tr>
                </tbody>
              </table>
  </form>

<?php } ?>
             
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
<script type="text/javascript">
  $(document).ready(function(){
    $('.datatablesbtn').dataTable({
    paging: false
});
});
</script>