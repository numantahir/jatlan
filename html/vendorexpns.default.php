<?php
$objSSSjatlan->resetProperty();
$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
$objSSSjatlan->lstOrderRequestDetail();
$OrderRequest = $objSSSjatlan->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth"><?php echo dateFormate_4($OrderRequest["d_date"]).' <code>['.$OrderRequest["cof_no"].'/'.$OrderRequest["d_invoice_no"].']</code>';?> Management</h3>
       <div class="toolbar add-btn text-right mt-50px"> <a href="#" data-toggle="modal" data-target="#receivedpaymentpopup" class="btn btn-primary">New Expense</a> </div>
       
       
       
       
       
       
       
       
       
       
       
       
       <div class="modal fade transaction" id="receivedpaymentpopup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog transaction">
                                    <div class="modal-content transaction">
                                        <div class="modal-header transaction">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                <i class="material-icons">clear</i>
                                            </button>
											<div class="pop-heading">
                                            	<h4 class="modal-title">Select Expense Type</h4>
											</div>
                                        </div>
                                        <div class="modal-body transaction">
                                        
                                        <br />
                                        
                                        
               <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td align="center"><a href="<?php echo Route::_('show=vendorexpnsform&apm='.EncData('2', 2, $objBF).'&ori='.EncData('ori-'.$OrderRequest["order_request_id"], 2, $objBF));?>">Diesel Expense</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=vendorexpnsform&apm='.EncData('3', 2, $objBF).'&ori='.EncData('ori-'.$OrderRequest["order_request_id"], 2, $objBF));?>">Mobil Oil Expense</a></td>
                  </tr>
                   <tr>
                    <td align="center"><a href="<?php echo Route::_('show=vendorexpnsform&apm='.EncData('4', 2, $objBF).'&ori='.EncData('ori-'.$OrderRequest["order_request_id"], 2, $objBF));?>">Tyre Expense</a></td>
                  </tr>
                </tbody>
              </table>
              
            
                                            <div class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
            
            
            
            
            
            
            
            
            
            
            
                            
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" data-order="[[ 0, &quot;desc&quot; ]]" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Date</th>
                    <th>Vendor</th>
                    <th>Type</th>
                    <th>Detail</th>
                    <th>Qty</th>
					<th>Amount</th>
                  </tr>
                </thead>
                
                <tbody>
					<?php
					$objSSSVendordetail = new SSSjatlan;
					$objSSSjatlan->resetProperty();
                    $objSSSjatlan->setProperty("ORDERBY", 'vendor_exp_detail_id');
					$objSSSjatlan->setProperty("isActive", 1);
					$objSSSjatlan->setProperty("order_request_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
                    $objSSSjatlan->lstVehicleExpSupplierTrans();
                    while($VendExpDetail = $objSSSjatlan->dbFetchArray(1)){
						
						$objSSSVendordetail->resetProperty();
						$objSSSVendordetail->setProperty("vehicle_exp_id", $VendExpDetail['vendor_exp_id']);
						$objSSSVendordetail->lstVehicleExpSupplier();
						$VendorInfo = $objSSSVendordetail->dbFetchArray(1);
                    ?>
                  <tr>
                  <td><?php echo dateFormate_3($VendExpDetail["exp_date"]);?></td>
                    <td><?php echo $VendorInfo["exp_title"];?></td>
                    <td><?php echo VendorExpOptType($VendExpDetail["option_type"]);?></td>
                    <td><?php echo $VendExpDetail["exp_detail"];?></td>
                    <td><?php echo $VendExpDetail["quantity_detail"];?></td>
                    <td><?php echo RsAmount($VendExpDetail["exp_amount"]);?></td>
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