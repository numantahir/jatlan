<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
        
        
        <?php if($objCheckLogin->user_type == 3){ ?>
        
        <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Paid Bill Modify Request</h3>
            
            
            <hr>
            <div class="material-datatables">
            
            <?php if(trim(DecData($_GET["i"], 1, $objBF)) !=''){ ?>
            
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
					$objSSSinventory->setProperty("monthly_rent_id", trim(DecData($_GET["m"], 1, $objBF)));
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
					$objSSSinventory->setProperty("monthly_rent_id", trim(DecData($_GET["m"], 1, $objBF)));
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
				$objSSSinventory->setProperty("bill_modify_req_id", trim(DecData($_GET["i"], 1, $objBF)));
				$objSSSinventory->setProperty("request_status", 1);
				$objSSSinventory->lstBillModificationRequest();
				$GetRequestDetail = $objSSSinventory->dbFetchArray(1);
			  ?>
              <hr />
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Note</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $GetRequestDetail["request_code"];?></td>
                    <td><?php echo dateFormate_9($GetRequestDetail["request_date"]);?></td>
                    <td><?php echo BillRequestType($GetRequestDetail["request_type"]);?></td>
                    <td><?php echo $GetRequestDetail["request_extra_note"];?></td>
                    <td><?php echo BillRequestStatus($GetRequestDetail["request_status"]);?></td>
                  </tr>
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
            <input type="hidden" name="t" value="<?php echo $objBF->encrypt('action', ENCRYPTION_KEY);?>">
            <input type="hidden" name="i" value="<?php echo $objBF->encrypt(trim(DecData($_GET["i"], 1, $objBF)), ENCRYPTION_KEY);?>">
            <input type="hidden" name="m" value="<?php echo $objBF->encrypt(trim(DecData($_GET["m"], 1, $objBF)), ENCRYPTION_KEY);?>">
            <input type="hidden" name="rqt" value="<?php echo $objBF->encrypt($GetRequestDetail["request_type"], ENCRYPTION_KEY);?>" />
            <div class="card-content">
              <div class="col-md-12 Bord-Rt no-border-right">
                <div class="row">
                  <label class="col-sm-2 label-on-left">Request For:</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <input class="form-control" type="text" disabled="disabled" value="<?php echo BillRequestType($GetRequestDetail["request_type"]);?>" />
                    </div>
                  </div>
                </div>
                <?php if($GetRequestDetail["request_type"] == 1){
						/*************************************************************************/
						/**/ $objSSSinventory->resetProperty();
						/**/ $objSSSinventory->setProperty("isAcitve", 1);
						/**/ $objSSSinventory->setProperty("bill_no", $GetRequestDetail["original_bill_no"]);
						/**/ $objSSSinventory->lstMonthlyRent();
						/**/ $GetBillDetail = $objSSSinventory->dbFetchArray(1);
						/*************************************************************************/
						/**/ $objSSSinventory->resetProperty();
						/**/ $objSSSinventory->setProperty("isAcitve", 1);
						/**/ $objSSSinventory->setProperty("monthly_rent_id", trim(DecData($_GET["m"], 1, $objBF)));
						/**/ $objSSSinventory->lstBatchDetailList();
						/**/ $GetBatchID = $objSSSinventory->dbFetchArray(1);
						/*************************************************************************/
					?>
                    <input type="hidden" name="bi" value="<?php echo $objBF->encrypt($GetBatchID["batch_id"], ENCRYPTION_KEY);?>" /> 
                   <input type="hidden" name="obn" value="<?php echo $objBF->encrypt($GetRequestDetail["original_bill_no"], ENCRYPTION_KEY);?>" /> 
                  <div class="row">
                  <label class="col-sm-2 label-on-left">Original Bill Detail:</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                     <table class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Tenant Name</th>
                    <th>Tenant Shop</th>
                    <th>Tenant Code</th>
                    <th>M/Y</th>
                    <th>Due Date</th>
                    <th>Amount</th>
                    <th>Bill no</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSTenantDetail = new SSSinventory;
					$objSSSTenantDetail->resetProperty();
					$objSSSTenantDetail->setProperty("isAcitve", 1);
					$objSSSTenantDetail->setProperty("tenant_id", $ListOfPendingCharges["tenant_id"]);
					$objSSSTenantDetail->lstTenantInformation();
					$GetTenantDetail = $objSSSTenantDetail->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php 
					$TenantName = $GetTenantDetail["tenant_name"];
					echo $TenantName;?></td>
                    <td><?php echo $GetTenantDetail["tenant_shop_name"];?></td>
                    <td><a href="<?php echo Route::_('show=lsttenants&i='.EncData($GetTenantDetail["tenant_id"], 2, $objBF));?>" target="new"><?php echo $GetTenantDetail["tenant_code"];?></a></td>
                    <td><?php echo MonthList($GetBillDetail["rent_of_month"]).'/'.$GetBillDetail["rent_year"];?></td>
                    <td><?php echo dateFormate_3($GetBillDetail["due_date"]);?></td>
                    <td><?php echo $GetBillDetail["total_rent_amount"];?></td>
                    <td><a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($GetBillDetail["tenant_id"], 2, $objBF).'&mbi='.EncData($GetBillDetail["generate_bill_id"], 2, $objBF);?>" target="new"><?php echo $GetBillDetail["bill_no"];?></a></td>
                  </tr>
                  <?php //} ?>
                </tbody>
              </table>
                    </div>
                  </div>
                </div>  
                <?php } if($GetRequestDetail["request_type"] == 2){
						/*************************************************************************/
						/**/ $objSSSinventory->resetProperty();
						/**/ $objSSSinventory->setProperty("isAcitve", 1);
						/**/ $objSSSinventory->setProperty("monthly_rent_id", trim(DecData($_GET["m"], 1, $objBF)));
						/**/ $objSSSinventory->lstMonthlyRent();
						/**/ $GetBillDetail = $objSSSinventory->dbFetchArray(1);
						/*************************************************************************/
					?>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Arrear Amount.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="number" name="arrear_amount_remove" value="<?php echo $GetRequestDetail["arrear_amount_remove"];?>" id="arrear_amount_remove" tabindex="1" max="<?php echo $GetRequestDetail["arrear_amount_remove"];?>" />
                      <code style="color:#F00"><?php echo 'Original bill arrear amount is Rs.'.$GetBillDetail["arrears_rent"];?></code>
                    </div>
                  </div>
                </div>
                <?php } if($GetRequestDetail["request_type"] == 3){ ?>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Requested Amount.</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <label class="control-label"></label>
                      <input class="form-control" type="number" name="original_amount" value="<?php echo $GetRequestDetail["original_amount"];?>" id="original_amount" tabindex="1" max="<?php echo $GetRequestDetail["original_amount"];?>" />
                    </div>
                  </div>
                </div>
                <?php }?>
                <div class="row">
                  <label class="col-sm-2 label-on-left">Comment / Note:</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating<?php echo is_form_error($vResult,'extra_note');?>">
                      <label class="control-label"></label>
                      <input class="form-control" type="text" name="extra_note" tabindex="1" />
                    </div>
                  </div>
                </div>
                
                
                <div class="row">
                  <label class="col-sm-2 label-on-left">Request Action:</label>
                  <div class="col-sm-9">
                    <div class="form-group label-floating">
                      <select class="selectpicker" data-style="select-with-transition" required name="request_status" title="Select Request Action">
                        <option value="2">Approved & Complete Process</option>
                        <option value="3">Reject</option>
                      </select>
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
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Code</th>
                    <th>Bill no.</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Extra Note</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSGetBillNo = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("ORDERBY", 'bill_modify_req_id');
					$objSSSinventory->setProperty("request_status", 1);
					$objSSSinventory->lstBillModificationRequest();
					while($ListOfBillModification = $objSSSinventory->dbFetchArray(1)){
						$objSSSGetBillNo->resetProperty();
				?>
                  <tr>
                  	<td><?php echo $ListOfBillModification["request_code"];?></td>
                    <td><?php echo $objSSSGetBillNo->GetBillNo($ListOfBillModification["monthly_bill_id"]);?></td>
                    <td><?php echo dateFormate_9($ListOfBillModification["request_date"]);?></td>
                    <td><?php echo BillRequestType($ListOfBillModification["request_type"]);?></td>
                    <td><?php echo $ListOfBillModification["request_extra_note"];?></td>
                    <td><?php echo BillRequestStatus($ListOfBillModification["request_status"]);?></td>
                    
                    <td class="td-actions text-right">
                    <?php  if($ListOfBillModification["request_status"] == 1){?>
                    <a href="<?php echo Route::_('show=modifyrequest&i='.EncData($ListOfBillModification["bill_modify_req_id"], 2, $objBF).'&m='.EncData($ListOfBillModification["monthly_bill_id"], 2, $objBF));?>"> View </a>
                    <?php } else { ?>
                    <i class="material-icons">delete</i>
                    <?php } ?>
					</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } ?>
            </div>
          </div>
          <!-- end content--> 
          
          
        <?php } else { ?>
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <h3 class="card-title CardWidth">List of Bill Modification Request</h3>
            <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=modifyrequestform');?>" class="btn btn-primary">New Request</a> </div>
            <hr>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th>Code</th>
                    <th>Bill no.</th>
                    <th>Request Date</th>
                    <th>Request Type</th>
                    <th>Extra Note</th>
                    <th>Status</th>
                    <th class="disabled-sorting text-right">Delete</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSGetBillNo = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isActive", 1);
					$objSSSinventory->setProperty("ORDERBY", 'bill_modify_req_id');
					$objSSSinventory->lstBillModificationRequest();
					while($ListOfBillModification = $objSSSinventory->dbFetchArray(1)){
						$objSSSGetBillNo->resetProperty();
				?>
                  <tr>
                  	<td><?php echo $ListOfBillModification["request_code"];?></td>
                    <td><?php echo $objSSSGetBillNo->GetBillNo($ListOfBillModification["monthly_bill_id"]);?></td>
                    <td><?php echo dateFormate_9($ListOfBillModification["request_date"]);?></td>
                    <td><?php echo BillRequestType($ListOfBillModification["request_type"]);?></td>
                    <td><?php echo $ListOfBillModification["request_extra_note"];?></td>
                    <td><?php echo BillRequestStatus($ListOfBillModification["request_status"]);?></td>
                    
                    <td class="td-actions text-right">
                    <?php  if($ListOfBillModification["request_status"] == 1){?>
                    <a href="<?php echo Route::_('show=modifyrequest&i='.EncData($ListOfBillModification["bill_modify_req_id"], 2, $objBF).'&rq='.EncData('remove', 2, $objBF).'&ts='.EncData('request', 2, $objBF));?>" type="button" rel="tooltip" class="remove btn btn-success btn-simple form-edit"> <i class="material-icons">delete</i> </a>
                    <?php } else { ?>
                    <i class="material-icons">delete</i>
                    <?php } ?>
					</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- end content--> 
          <?php } ?>
          
          
          
          
          
          
          
          
          
        </div>
        <!--  end card  --> 
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>