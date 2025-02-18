<?php
$objQayadProerty->setProperty("property_id", trim(DecData($_GET["i"], 1, $objBF)));
$objQayadProerty->lstProperties();
$GetPropertyInfo = $objQayadProerty->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">image</i> </div>
          <div class="card-content">
            <?php if($_GET["pi"]==''){?>
            <h4 class="card-title CardWidth">Property Gallery of (<?php echo $GetPropertyInfo["property_section"].', '.$GetPropertyInfo["floor_name"].', '.$GetPropertyInfo["property_number"].') -  [Area:'.$GetPropertyInfo["property_area"].']';?></h4>
            <div class="toolbar add-btn text-right"> <a href="<?php echo Route::_('show=pppropertyform&i='.$_GET["i"]);?>" class="btn btn-primary">Add New</a> </div>
            <hr>
            <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card">
                                <div class="card-content text-center">
                                    <div class="col-sm-12">
                                    <img src="<?php echo SITE_URL;?>photo_bank/company_user/signature/orig/8700c.jpg">
                                    </div>
                                    <small>Testing</small>
                                </div>
                            </div>
                        </div>
                        
                    </div>
            <?php } else { 
			$objQayadProerty->setProperty("propty_payment_id", trim(DecData($_GET["pi"], 1, $objBF)));
			$objQayadProerty->lstPropertyPaymentDetail();
			$PPaymentDetail = $objQayadProerty->dbFetchArray(1);
			?>
            <h4 class="card-title CardWidth">Payment Plan Detail of (<?php echo $GetPropertyInfo["property_section"].', '.$GetPropertyInfo["floor_name"].', '.$GetPropertyInfo["property_number"].') -  [Area:'.$GetPropertyInfo["property_area"].']';?></h4>
            <div class="toolbar text-right"> <a href="<?php echo Route::_('show=pppropertyform&i='.$_GET["i"].'&pi='.$_GET['pi']);?>" class="btn btn-primary">Edit</a> <a href="<?php echo Route::_('show=ppproperties&i='.$_GET["i"]);?>" class="btn btn-primary">Back</a> </div>
            <div class="table-responsive">
              <table class="table" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td class="text-primary">Rent SQ/FT</td>
                    <td><?php echo Numberformt($PPaymentDetail["rate_per_sq_ft"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Down Payment</td>
                    <td><?php echo Numberformt($PPaymentDetail["down_payment"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Instalment Per Month</td>
                    <td><?php echo Numberformt($PPaymentDetail["instalment_per_month"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Discount <small>(Down Payment)</small></td>
                    <td><?php echo Numberformt($PPaymentDetail["dp_discount"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Discount <small>(Total Payment)</small></td>
                    <td><?php echo Numberformt($PPaymentDetail["total_discount"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Payback Cutting Mode</td>
                    <td><?php echo PayBackCuttingMode($PPaymentDetail["payback_cutting"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Payback Value</td>
                    <td><?php echo $PPaymentDetail["pb_cutting_value"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Ownership Transfer Fee</td>
                    <td><?php echo Numberformt($PPaymentDetail["property_transfer_fee"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Property Rent Value</td>
                    <td><?php echo Numberformt($PPaymentDetail["property_rent_value"]);?></td>
                  </tr>
                  <tr>
                    <td class="text-primary">Plan Status</td>
                    <td><?php echo StatusName($PropertyDetail["isActive"]);?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <?php } ?>
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