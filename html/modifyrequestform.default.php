<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="t" value="<?php echo $objBF->encrypt('search', ENCRYPTION_KEY);?>">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo SetFormPageTitle('Bill Modification', $mode);?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=modifyrequest');?>" class="btn">Back</a> </div>
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Bill no.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'bill_no');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="bill_no" required value="<?php echo trim(DecData($_GET["b"], 1, $objBF));?>" tabindex="1" />
                      <small><?php echo $vResult["bill_no"];?></small> </div>
                  </div>
                </div>
                <div class="card-footer text-center col-md-12">
                  <button type="submit" class="btn btn-rose btn-fill">Search</button>
                  <button type="reset" class="btn btn-fill">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ ?>
      <hr style="margin-bottom:0px; margin-top:0px;" />
      <div class="col-md-12">
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Tenant Name</th>
                    <th>Shop Name</th>
                    <th>Bill no.</th>
                    <th>Month of Bill</th>
                    <th>Due Date</th>
                    <th>Arrear</th>
                    <th>Total Amount</th>
                    <th>Paid</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					$objSSSTenantDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("monthly_rent_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
					$objSSSinventory->lstMonthlyRent();
					if($objSSSinventory->totalRecords() > 0){
					$RequestBillDetail = $objSSSinventory->dbFetchArray(1);
						//GetUserFullName
						//GetTenantFullName
					$objSSSTenantDetail->resetProperty();
					$objSSSTenantDetail->setProperty("isAcitve", 1);
					$objSSSTenantDetail->setProperty("tenant_id", $RequestBillDetail["tenant_id"]);
					$objSSSTenantDetail->lstTenantInformation();
					$GetTenantDetail = $objSSSTenantDetail->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php 
					$TenantName = $GetTenantDetail["tenant_name"];
					echo $TenantName;?></td>
                    <td><?php echo $GetTenantDetail["tenant_shop_name"];?></td>
                    <td><a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($RequestBillDetail["tenant_id"], 2, $objBF).'&mbi='.EncData($RequestBillDetail["generate_bill_id"], 2, $objBF);?>" target="new"><?php echo $RequestBillDetail["bill_no"];?></a></td>
                    <td><?php echo MonthList($RequestBillDetail["rent_of_month"]).'/'.$RequestBillDetail["rent_year"];?></td>
                    <td><?php echo dateFormate_3($RequestBillDetail["due_date"]);?></td>
                    <td><?php echo $RequestBillDetail["arrears_rent"];?></td>
                    <td><?php echo $RequestBillDetail["total_rent_amount"];?></td>
                    <td><?php echo $RequestBillDetail["received_amount"];?></td>
                    <td><?php echo BillStatus($RequestBillDetail["rent_status"]);?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <hr />
              <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Property Code</th>
                    <th>Property Type</th>
                    <th>Property Monthly Rs.</th>
                    <th>Assign Bill Rs.</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					$summPropertyAmount=0;
					$summBillingAmount=0;
					$objSSSPropertyDetail = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("monthly_rent_id", trim(DecData($_GET["i"], 1, $objBF)));
					$objSSSinventory->setProperty("ORDERBY", 'rent_amount_id');
					$objSSSinventory->lstMonthlyRentAmount();
					while($GetBillDetailList = $objSSSinventory->dbFetchArray(1)){
						//GetUserFullName
						//GetTenantFullName
					$objSSSPropertyDetail->resetProperty();
					$objSSSPropertyDetail->setProperty("isAcitve", 1);
					$objSSSPropertyDetail->setProperty("property_id", $GetBillDetailList["property_id"]);
					$objSSSPropertyDetail->lstProperties();
					$GetPropertyDetail = $objSSSPropertyDetail->dbFetchArray(1);
					$summPropertyAmount += $GetPropertyDetail["monthly_maint"];
					$summBillingAmount += $GetBillDetailList["monthly_amount"];
				?>
                  <tr>
                    <td><?php echo $GetPropertyDetail["property_code"];?></td>
                    <td><?php echo PropertyTypeById($GetPropertyDetail["property_type"]);?></td>
                    <td><?php echo $GetPropertyDetail["monthly_maint"];?></td>
                    <td><?php echo $GetBillDetailList["monthly_amount"];?></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                    <th><?php echo 'Rs.'.$summPropertyAmount;?></th>
                    <th><?php echo 'Rs.'.$summBillingAmount;?></th>
                  </tr>
                </tbody>
              </table>
              <?php
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isAcitve", 1);
				$objSSSinventory->setProperty("monthly_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->setProperty("request_status", 1);
				$objSSSinventory->lstBillModificationRequest();
				$CheckRequestRecord = $objSSSinventory->totalRecords();
				if($CheckRequestRecord == 0){
			  ?>
              <hr />
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Request Code</th>
                    <th>Request Date</th>
                    <th>Extra Note</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isAcitve", 1);
					$objSSSinventory->setProperty("monthly_bill_id", trim(DecData($_GET["i"], 1, $objBF)));
					//$objSSSinventory->setProperty("request_status", 1);
					$objSSSinventory->lstBillModificationRequest();
					while($GetRequestDetail = $objSSSinventory->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo $GetRequestDetail["request_code"];?></td>
                    <td><?php echo dateFormate_9($GetRequestDetail["request_date"]);?></td>
                    <td><?php echo $GetRequestDetail["request_extra_note"];?></td>
                    <td><?php echo BillRequestStatus($GetRequestDetail["request_status"]);?></td>
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
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="mode" value="<?php echo $mode;?>">
            <input type="hidden" name="t" value="<?php echo $objBF->encrypt('modification', ENCRYPTION_KEY);?>">
            <input type="hidden" name="i" value="<?php echo $objBF->encrypt(trim(DecData($_GET["i"], 1, $objBF)), ENCRYPTION_KEY);?>">
            <input type="hidden" name="b" value="<?php echo $objBF->encrypt(trim(DecData($_GET["b"], 1, $objBF)), ENCRYPTION_KEY);?>">
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Request Option:</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" required name="request_type" id="request_type" tabindex="1" title="Select Request Option">
                        <option value="1">ByMistake Paid Bill.</option>
                        <option value="2">Remove the arrear amount and regenerate the bill.</option>
                        <option value="3">Submitted Bill amount correction.</option>
                        <option value="4">Tenant Leave close monthly assigned bill.</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Current Bill no.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'bill_no');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="bill_no" readonly="readonly" value="<?php echo trim(DecData($_GET["b"], 1, $objBF));?>" tabindex="1" />
                    </div>
                  </div>
                </div>
                <div class="row" id="d_original_bill_no" style="display:none;">
                  <label class="col-sm-2 label-on-left">Original Bill no.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="original_bill_no" id="original_bill_no" tabindex="1" />
                    </div>
                  </div>
                </div>
                <div class="row" id="d_arrear_amount_remove" style="display:none;">
                  <label class="col-sm-2 label-on-left">Arrear Amount.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="number" name="arrear_amount_remove" value="<?php echo $RequestBillDetail["arrears_rent"];?>" id="arrear_amount_remove" tabindex="1" />
                    </div>
                  </div>
                </div>
                <div class="row" id="d_original_amount" style="display:none;">
                  <label class="col-sm-2 label-on-left">Received Amount.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="number" name="original_amount" id="original_amount" tabindex="1" />
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Write Request Detail.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'request_extra_note');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" required name="request_extra_note" tabindex="1" />
                    </div>
                  </div>
                </div>
                <div class="card-footer text-center col-md-12">
                  <button type="submit" class="btn btn-rose btn-fill">Submit</button>
                  <button type="reset" class="btn btn-fill">Reset</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <?php } else { ?>
      <hr />
      			<table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  
                  <tr>
                    <th align="center" style="text-align:center">Sorry this bill is already under process. <br />Please wait until the pending process is complete.</th>
                  </tr>
                </tbody>
              </table>
      			<?php } } ?>
    </div>
  </div>
</div>
