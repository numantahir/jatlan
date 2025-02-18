<input type="hidden" name="trans_type" value="1">
<input type="hidden" name="aplic_mode" value="2">
<div class="row">
  <label class="col-sm-2 label-on-left">Select Supplier Head:</label>
  <div class="col-sm-9">
    <div class="form-group label-floating">
      <select class="selectpicker" data-style="select-with-transition" name="head_id" id="head_id" title="List of Supplier Head" data-live-search="true" required tabindex="1">
        <?php
                    $objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("isActive", 1);
                    $objQayadaccount->setProperty("head_type_id", 6);
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                    ?>
        <option value="<?php echo EncData($AccountHeadList["head_id"], 1, $objBF);?>"> <?php echo $AccountHeadList["head_code"] . ' - ' . $AccountHeadList["head_title"] . ' ';?> </option>
        <?php } ?>
      </select>
    </div>
  </div>
</div>
<div class="row" id="loadingresp" style="display:none;">
  <div class="col-sm-12">
    <div class="card">
      <div class="card-content text-center"> <svg width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" class="lds-square" style="background: none;">
        <g transform="translate(20 20)">
          <rect x="-15" y="-15" width="30" height="30" fill="#220b09" transform="scale(1 1)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.5599999999999999s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(50 20)">
          <rect x="-15" y="-15" width="30" height="30" fill="#d34c31" transform="scale(1 1)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.42s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(80 20)">
          <rect x="-15" y="-15" width="30" height="30" fill="#e88432" transform="scale(0.843719 0.843719)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.27999999999999997s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(20 50)">
          <rect x="-15" y="-15" width="30" height="30" fill="#d34c31" transform="scale(1 1)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.42s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(50 50)">
          <rect x="-15" y="-15" width="30" height="30" fill="#e88432" transform="scale(0.843719 0.843719)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.27999999999999997s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(80 50)">
          <rect x="-15" y="-15" width="30" height="30" fill="#ff312d" transform="scale(0.562556 0.562556)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.13999999999999999s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(20 80)">
          <rect x="-15" y="-15" width="30" height="30" fill="#e88432" transform="scale(0.843719 0.843719)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.27999999999999997s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(50 80)">
          <rect x="-15" y="-15" width="30" height="30" fill="#ff312d" transform="scale(0.562556 0.562556)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="-0.13999999999999999s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        <g transform="translate(80 80)">
          <rect x="-15" y="-15" width="30" height="30" fill="#f5c037" transform="scale(0.311458 0.311458)">
            <animateTransform attributeName="transform" type="scale" calcMode="spline" values="1;1;0.2;1;1" keyTimes="0;0.2;0.5;0.8;1" dur="1.4s" keySplines="0.5 0.5 0.5 0.5;0 0.1 0.9 1;0.1 0 1 0.9;0.5 0.5 0.5 0.5" begin="0s" repeatCount="indefinite"></animateTransform>
          </rect>
        </g>
        </svg> &nbsp; Please wait Customer/Application information loading... </div>
    </div>
  </div>
</div>
<div id="loadingdate"></div>
<div id="otherfields" style="display:none;">
  <hr>
  <div class="row">
    <label class="col-sm-2 label-on-left">Pay Balance:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_amount');?>">
        <!--<label class="control-label"></label>
        <input class="form-control" type="text" name="trans_amount" id="trans_amount" required value="<?php echo $trans_amount;?>" tabindex="2" />-->
        <label class="control-label"></label>
                    <input class="form-control" type="text" name="trans_amount" onkeyup="word.innerHTML=convertNumberToWords(this.value)" id="trans_amount" required value="<?php echo $trans_amount;?>" tabindex="2" /><label><small id="word"></small></label>
      </div>
    </div>
  </div>
  <div class="row">
    <label class="col-sm-2 label-on-left">Payment Mode:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
        <select class="selectpicker" data-style="select-with-transition" name="pay_mode" id="pay_mode" title="List of Payment Mode" required tabindex="2">
          <option value="1">Cash</option>
          <option value="2">Cheque</option>
          <option value="3">Pay Order</option>
          <option value="4">Bank Transfer</option>
          <option value="5">Demand Draft</option>
          <option value="6">Online</option>
        </select>
      </div>
    </div>
  </div>
  <div class="row" id="mode_no" style="display:none;">
    <label class="col-sm-2 label-on-left">Mode No:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
        <label class="control-label"></label>
        <input class="form-control" type="text" name="payment_mode_no" id="pay_mode_field" value="<?php echo $pay_mode;?>" tabindex="2" />
        <code>Note: Mode No for 'Cheque, Pay Order, Bank Transfer, etc' transaction number.</code> </div>
    </div>
  </div>
  <div class="row">
    <label class="col-sm-2 label-on-left"><?php echo $HeadTransfer;?>:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'pay_mode');?>">
        <select class="selectpicker" data-style="select-with-transition" name="transfer_head_id" id="transfer_head_id" title="List of Transfer Head's" required tabindex="2">
          <?php
					$objQayadaccount->resetProperty();
					$objQayadaccount->setProperty("isActive", 1);
					$objQayadaccount->setProperty("head_type_id_array", '2,3');
                    $objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                    ?>
          <option value="<?php echo EncData($AccountHeadList["head_id"], 1, $objBF);?>"> <?php echo $AccountHeadList["head_code"] . ' - ' . $AccountHeadList["head_title"] . ' ';?> </option>
          <?php } ?>
        </select>
      </div>
    </div>
  </div>
  <div id="haeditemdiv" style="display:none;"></div>
  <div class="row">
    <label class="col-sm-2 label-on-left">Transaction Date:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_date');?>">
        <label class="control-label"></label>
        <input class="form-control datepicker" type="text" name="trans_date" required value="<?php echo date("m/d/Y");?>" tabindex="1" />
        <small><?php echo $vResult["trans_date"];?></small> </div>
    </div>
  </div>
  <div class="row">
    <label class="col-sm-2 label-on-left">Title:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_title');?>">
        <label class="control-label"></label>
        <input class="form-control" type="text" name="trans_title" id="trans_title" required value="<?php echo $trans_title;?>" tabindex="2" />
        <small><?php echo $vResult["trans_title"];?></small> </div>
    </div>
  </div>
  <div class="row">
    <label class="col-sm-2 label-on-left">Note / Description:</label>
    <div class="col-sm-9">
      <div class="form-group label-floating<?php echo is_form_error($vResult,'trans_note');?>">
        <label class="control-label"></label>
        <input class="form-control" type="text" name="trans_note" value="<?php echo $trans_note;?>" tabindex="2" />
        <small><?php echo $vResult["trans_note"];?></small> </div>
    </div>
  </div>
  <div class="card-footer text-center col-md-12">
    <button type="submit" class="btn btn-rose btn-fill" id="SubmitBtn">Submit</button>
    <button type="reset" class="btn btn-fill">Reset</button>
  </div>
</div>
