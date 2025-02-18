<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      
      
      <div class="card">
        <table class="table table-striped table-no-bordered table-hover follow-up" cellspacing="0" width="100%" style="width:100%">
          <thead>
            <tr>
              <th>Order#</th>
              <th>Vechile#</th>
              <th>Driver</th>
              <th>No. of Items</th>
              <th>Create Date</th>
              <th>Amount</th>
              <th>Order Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><?php echo $OrderProcess["order_no"];?></td>
              <td><?php echo $VehicleNumber["vehicle_number"];?></td>
              <td><?php echo $DriverDetail["user_fname"].' '.$DriverDetail["user_lname"];?></td>
              <td><?php echo '('.$TotalNoOfOrders.') '.$OrderProcess["total_quantity_order"];?></td>
              <td><?php echo dateFormate_4($OrderProcess["create_date"]);?></td>
              <td><?php echo RsAmount($OrderProcess["total_order_sell_cost"]);?></td>
              <td><?php echo OrderProcessingStatus($OrderProcess["order_status"]);?></td>
            </tr>
          </tbody>
        </table>
      </div>
      
      
      <hr />
      
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="order_id" value="<?php echo $objBF->encrypt($OrderProcess["order_id"], ENCRYPTION_KEY);?>">
            <input type="hidden" name="odn" value="<?php echo $OrderProcess["order_no"];?>" />
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo '<code>'.$OrderProcess["order_no"]. '</code> Complete Delivery Information';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=uporders&i='.EncData($OrderProcess["order_id"], 2, $objBF));?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Invoice No.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'d_invoice_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="d_invoice_no" value="<?php echo $d_invoice_no;?>" tabindex="1" />
                  <small><?php echo $vResult["d_invoice_no"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">COF Number.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'d_cof_number');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="d_cof_number" value="<?php echo $d_cof_number;?>" tabindex="2" />
                  <small><?php echo $vResult["d_cof_number"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Loading Advice No.</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'d_loading_advice_no');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="text" name="d_loading_advice_no" value="<?php echo $d_loading_advice_no;?>" tabindex="3" />
                  <small><?php echo $vResult["d_loading_advice_no"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Delivery Date</label>
              <div class="col-sm-9">
                <div class="form-group label-floating<?php echo is_form_error($vResult,'deliver_date');?>">
                  <label class="control-label"></label>
                  <input class="form-control" type="date" name="deliver_date" value="<?php echo date("m/d/Y");?>" tabindex="4" />
                  <small><?php echo $vResult["deliver_date"];?></small> </div>
              </div>
            </div>
            
            <div class="row">
              <label class="col-sm-2 label-on-left">Status</label>
              <div class="col-sm-9">
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="order_status" title="Order Status" tabindex="5">
                    <option value="3" selected>Deliver</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill" tabindex="5">Submit</button>
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