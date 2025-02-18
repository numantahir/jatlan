<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="product_price_id" value="<?php echo $objBF->encrypt($product_price_id, ENCRYPTION_KEY);?>">
            <input type="hidden" name="product_id" value="<?php echo $objBF->encrypt($GetProductInfo["product_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="mode" value="<?php echo $mode;?>" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle($GetProductInfo["buy_price"].' Price Information', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=productprice&i='.EncData($GetProductInfo["product_id"], 2, $objBF));?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Buy Price</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'buy_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="buy_price" value="<?php echo $buy_price;?>" tabindex="1" />
                  <small><?php echo $vResult["buy_price"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Sell Price</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'selling_price');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="number" name="selling_price" required value="<?php echo $selling_price;?>" tabindex="2" />
                  <small><?php echo $vResult["selling_price"];?></small> </div>
              </div>
            </div>
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="isActive" title="Status" tabindex="3">
                    <option value="1" <?php echo StaticDDSelection(1, $isActive);?> selected>Active</option>
                    <option value="2" <?php echo StaticDDSelection(2, $isActive);?>>InActive</option>
                  </select>
                </div>
              </div>
            </div>
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="4">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
            </div>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
