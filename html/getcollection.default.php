<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
            <?php 
		//  echo trim(DecData($_GET["s"], 1, $objBF));
		  if(trim(DecData($_GET["s"], 1, $objBF)) == 1){?>
            <h3 class="card-title CardWidth">Get Collection By Tenant Name</h3>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=getcollection');?>" class="btn">Back</a> </div>
            <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 2){?>
            <h3 class="card-title CardWidth">Get Collection By Tenant CNIC</h3>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=getcollection');?>" class="btn">Back</a> </div>
            <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 3){?>
            <h3 class="card-title CardWidth">Get Collection By Tenant Phone#</h3>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=getcollection');?>" class="btn">Back</a> </div>
            <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 4){?>
            <h3 class="card-title CardWidth">Get Collection By Bill No.</h3>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=getcollection');?>" class="btn">Back</a> </div>
            <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 5){?>
            <h3 class="card-title CardWidth">Get Collection By Property Code</h3>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=getcollection');?>" class="btn">Back</a> </div>
            <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 6){?>
            <h3 class="card-title CardWidth">Get Collection By Shop Name</h3>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=getcollection');?>" class="btn">Back</a> </div>
            <?php } else { 
			
			if(trim(DecData($_GET["t"], 1, $objBF)) != ''){
				
				$objResultInventory = new SSSinventory;
				$objPropertyBundle = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				$objSSSinventory->setProperty("ORDERBY", 'tenant_shop_name');
				$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["t"], 1, $objBF)));
				$objSSSinventory->lstTenantInformation();
				$SearchResult = $objSSSinventory->dbFetchArray(1);
				
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isAcitve", 1);
				$objSSSinventory->setProperty("rent_status", 2);
				$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
				$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["t"], 1, $objBF)));
				$objSSSinventory->lstMonthlyRent();
				$MonthlyRentDetail = $objSSSinventory->dbFetchArray(1);

				if($MonthlyRentDetail["monthly_rent_id"] ==''){
				$CounterPaidStatus = 1;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isAcitve", 1);
				$objSSSinventory->setProperty("rent_status", 1);
				$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id DESC');
				$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["t"], 1, $objBF)));
				$objSSSinventory->lstMonthlyRent();
				$PaidMonthlyBill = $objSSSinventory->dbFetchArray(1);
				} else {
				$CounterPaidStatus = 0;
				}
			?>
            <h3 class="card-title CardWidth">Entery Client Monthly Charges</h3>
            <?php /*if($CounterPaidStatus == 0){?>
            <div class="toolbar add-btn text-right"><a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($PaidMonthlyBill["tenant_id"], 2, $objBF).'&mbi='.EncData($PaidMonthlyBill["generate_bill_id"], 2, $objBF);?>" target="new">View Bill</a> </div>
            <?php } else { ?>
            <div class="toolbar add-btn text-right"><a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($PaidMonthlyBill["tenant_id"], 2, $objBF).'&mbi='.EncData($PaidMonthlyBill["generate_bill_id"], 2, $objBF);?>" target="new">View Bill</a> </div>
            <?php } */?>
            <?php  } else { ?>
            <h3 class="card-title CardWidth">Get Collection Search By</h3>
            <?php } }?>
            <hr>
            <?php if(trim(DecData($_GET["s"], 1, $objBF)) != '' && trim(DecData($_GET["rs"], 1, $objBF)) != 'view'){?>
            <div class="col-md-12">
              <div class="card">
                <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="mode" value="<?php echo $mode;?>">
                  <input type="hidden" name="md" value="<?php echo $objBF->encrypt('search', ENCRYPTION_KEY);?>">
                  <div class="card-content">
                    <div class="col-md-12 Bord-Rt no-border-right">
                      <div class="row">
                        <?php if(trim(DecData($_GET["s"], 1, $objBF)) == 1){?>
                        <label class="col-sm-12" style="text-align:center">Entery Tenant Name</label>
                        <input type="hidden" name="search_type" value="1" />
                        <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 2){?>
                        <label class="col-sm-12" style="text-align:center">Entery Tenant CNIC</label>
                        <input type="hidden" name="search_type" value="2" />
                        <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 3){?>
                        <label class="col-sm-12" style="text-align:center">Entery Tenant Phone#</label>
                        <input type="hidden" name="search_type" value="3" />
                        <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 4){?>
                        <label class="col-sm-12" style="text-align:center">Entery Bill No.</label>
                        <input type="hidden" name="search_type" value="4" />
                        <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 5){?>
                        <label class="col-sm-12" style="text-align:center">Entery Property Code</label>
                        <input type="hidden" name="search_type" value="5" />
                        <?php }elseif(trim(DecData($_GET["s"], 1, $objBF)) == 6){?>
                        <label class="col-sm-12" style="text-align:center">Entery Shop Name</label>
                        <input type="hidden" name="search_type" value="6" />
                        <?php } ?>
                        <div class="col-sm-12">
                          <div class="form-group label-floating<?php echo is_form_error($vResult,'search_vale');?>">
                            <label class="control-label"></label>
                            <input class="form-control" type="text" style="text-align:center;" name="search_vale" required value="<?php echo $search_vale;?>" tabindex="1" />
                            <small><?php echo $vResult["search_vale"];?></small> </div>
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
            
            <!-- end col-md-12 --> 
          </div>
          <!-- end row --> 
        </div>
        <?php } elseif(trim(DecData($_GET["s"], 1, $objBF)) != '' && trim(DecData($_GET["rs"], 1, $objBF)) == 'view'){?>
        <div class="col-md-12">
          <div class="card-content">
            <?php if(trim(DecData($_GET["s"], 1, $objBF)) == 6 or trim(DecData($_GET["s"], 1, $objBF)) == 1 or trim(DecData($_GET["s"], 1, $objBF)) == 2 or trim(DecData($_GET["s"], 1, $objBF)) == 3){
				
				$objResultInventory = new SSSinventory;
				$objPropertyBundle = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isActive", 1);
				if(trim(DecData($_GET["s"], 1, $objBF)) == 6){
				$objSSSinventory->setProperty("ORDERBY", 'tenant_shop_name');
				$objSSSinventory->setProperty("search_by_shop_name", trim(DecData($_GET["v"], 1, $objBF)));
				} elseif(trim(DecData($_GET["s"], 1, $objBF)) == 1){
				$objSSSinventory->setProperty("ORDERBY", 'tenant_name');
				$objSSSinventory->setProperty("search_by_name", trim(DecData($_GET["v"], 1, $objBF)));
				} elseif(trim(DecData($_GET["s"], 1, $objBF)) == 2){
				$objSSSinventory->setProperty("ORDERBY", 'tenant_name');
				$objSSSinventory->setProperty("tenant_cnic", trim(DecData($_GET["v"], 1, $objBF)));	
				} elseif(trim(DecData($_GET["s"], 1, $objBF)) == 3){
				$objSSSinventory->setProperty("ORDERBY", 'tenant_name');
				$objSSSinventory->setProperty("tenant_phone", trim(DecData($_GET["v"], 1, $objBF)));		
				}
				$objSSSinventory->lstTenantInformation();
				if($objSSSinventory->totalRecords() > 0){
				while($SearchResult = $objSSSinventory->dbFetchArray(1)){

			?>
            <a href="<?php echo Route::_('show=getcollection&rs='.EncData('action', 2, $objBF).'&t='.EncData($SearchResult["tenant_id"], 2, $objBF));?>">
            <div class="col-md-12">
              <div class="card" style="margin-top:5px; margin-bottom:5px;">
                <div class="card-content" style="text-align:center"> <strong><?php echo $SearchResult["tenant_name"];?> / <?php echo $SearchResult["tenant_shop_name"];?></strong>
                  <?php 
							$objResultInventory->resetProperty();
							$objResultInventory->setProperty("isActive", 1);
							$objResultInventory->setProperty("tenant_id", $SearchResult["tenant_id"]);
							$objResultInventory->lstTenantAssignProperty();
							while($SearchProperties = $objResultInventory->dbFetchArray(1)){

							$objPropertyBundle->resetProperty();
							$objPropertyBundle->setProperty("isActive", 1);
							$objPropertyBundle->setProperty("property_id", $SearchProperties["property_id"]);
							$objPropertyBundle->lstPropertyBundle();
							$PropertyDetail = $objPropertyBundle->dbFetchArray(1);
						?>
                  <br />
                  <code><?php echo $PropertyDetail["block_name"].'/'.$PropertyDetail["building_no"].'/'.$PropertyDetail["floor_name"].'/'.$PropertyDetail["property_number"].'/'.$PropertyDetail["property_code"].'/'.PropertyTypeById($PropertyDetail["property_type"]);?></code>
                  <?php } ?>
                </div>
              </div>
            </div>
            </a>
            <?php  }
			} else { ?>
            <div class="col-md-12">
              <div class="card" style="margin-top:5px; margin-bottom:5px;">
                <div class="card-content" style="text-align:center"> <?php echo 'No Record found.';?> </div>
              </div>
            </div>
            <?php  }  ?>
            <?php } elseif(trim(DecData($_GET["s"], 1, $objBF)) == 4){
				//echo trim(DecData($_GET["v"], 1, $objBF));
				$objResultInventory = new SSSinventory;
				$objPropertyBundle = new SSSinventory;
				$objTenantInfo = new SSSinventory;
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("isAcitve", 1);
				$objSSSinventory->setProperty("ORDERBY", 'monthly_rent_id');
				$objSSSinventory->setProperty("bill_no", trim(DecData($_GET["v"], 1, $objBF)));		
				$objSSSinventory->lstMonthlyRent();
				if($objSSSinventory->totalRecords() > 0){
				while($SearchResult = $objSSSinventory->dbFetchArray(1)){
					
					$objTenantInfo->resetProperty();
					$objTenantInfo->setProperty("isActive", 1);
					$objTenantInfo->setProperty("tenant_id", $SearchResult["tenant_id"]);
					$objTenantInfo->lstTenantInformation();
					$TenantInfo = $objTenantInfo->dbFetchArray(1);
			?>
            <a href="<?php echo Route::_('show=getcollection&rs='.EncData('action', 2, $objBF).'&t='.EncData($SearchResult["tenant_id"], 2, $objBF));?>">
            <div class="col-md-12">
              <div class="card" style="margin-top:5px; margin-bottom:5px;">
                <div class="card-content" style="text-align:center"> <strong><?php echo $TenantInfo["tenant_name"];?> / <?php echo $TenantInfo["tenant_shop_name"];?></strong>
                  <?php 
							$objResultInventory->resetProperty();
							$objResultInventory->setProperty("isActive", 1);
							$objResultInventory->setProperty("tenant_id", $SearchResult["tenant_id"]);
							$objResultInventory->lstTenantAssignProperty();
							while($SearchProperties = $objResultInventory->dbFetchArray(1)){

							$objPropertyBundle->resetProperty();
							$objPropertyBundle->setProperty("isActive", 1);
							$objPropertyBundle->setProperty("property_id", $SearchProperties["property_id"]);
							$objPropertyBundle->lstPropertyBundle();
							$PropertyDetail = $objPropertyBundle->dbFetchArray(1);
						?>
                  <br />
                  <code><?php echo $PropertyDetail["block_name"].'/'.$PropertyDetail["building_no"].'/'.$PropertyDetail["floor_name"].'/'.$PropertyDetail["property_number"].'/'.$PropertyDetail["property_code"].'/'.PropertyTypeById($PropertyDetail["property_type"]);?></code>
                  <?php } ?>
                </div>
              </div>
            </div>
            </a>
            <?php  }
			} else { ?>
            <div class="col-md-12">
              <div class="card" style="margin-top:5px; margin-bottom:5px;">
                <div class="card-content" style="text-align:center"> <?php echo 'No Record found.';?> </div>
              </div>
            </div>
            <?php  }  ?>
            <?php } ?>
          </div>
          <!-- end content--> 
        </div>
        <?php } elseif(trim(DecData($_GET["t"], 1, $objBF)) != '' && trim(DecData($_GET["rs"], 1, $objBF)) == 'action'){ ?>
        <div class="col-md-12">
          <div class="card" style="margin-top:5px; margin-bottom:5px;">
            <div class="card-content" style="text-align:center"> <strong><?php echo $SearchResult["tenant_name"];?> / <?php echo $SearchResult["tenant_shop_name"];?></strong><br />
              <?php 
							$objResultInventory->resetProperty();
							$objResultInventory->setProperty("isActive", 1);
							$objResultInventory->setProperty("tenant_id", $SearchResult["tenant_id"]);
							$objResultInventory->lstTenantAssignProperty();
							while($SearchProperties = $objResultInventory->dbFetchArray(1)){

							$objPropertyBundle->resetProperty();
							$objPropertyBundle->setProperty("isActive", 1);
							$objPropertyBundle->setProperty("property_id", $SearchProperties["property_id"]);
							$objPropertyBundle->lstPropertyBundle();
							$PropertyDetail = $objPropertyBundle->dbFetchArray(1);
						?>
              <code><?php echo $PropertyDetail["block_name"].'/'.$PropertyDetail["building_no"].'/'.$PropertyDetail["floor_name"].'/'.$PropertyDetail["property_number"].'/'.$PropertyDetail["property_code"].'/'.PropertyTypeById($PropertyDetail["property_type"]);?></code> ::
              <?php } ?>
            </div>
          </div>
        </div>
        <?php if($MonthlyRentDetail["monthly_rent_id"]!=''){ ?>
        <div class="col-md-12">
          <div class="card" style="margin-top:5px; margin-bottom:5px;">
            
            <div class="card-content" style="text-align:center"> <strong>Rs.<?php echo $MonthlyRentDetail["total_rent_amount"];?>/-</strong> &nbsp;&nbsp; | &nbsp;&nbsp; <a href="<?php echo SITE_URL.'vbill.php?do='.EncData('reprint', 2, $objBF).'&t='.EncData($MonthlyRentDetail["tenant_id"], 2, $objBF).'&mbi='.EncData($MonthlyRentDetail["generate_bill_id"], 2, $objBF);?>" target="new"><code style="color:#F00;"><strong>View Bill</strong></code></a>
              <?php 
							$objResultInventory->resetProperty();
							$objResultInventory->setProperty("isActive", 1);
							$objResultInventory->setProperty("monthly_rent_id", $MonthlyRentDetail["monthly_rent_id"]);
							$objResultInventory->setProperty("tenant_id", trim(DecData($_GET["t"], 1, $objBF)));
							$objResultInventory->lstMonthlyRentAmount();
							while($ThisMonthList = $objResultInventory->dbFetchArray(1)){

							$objPropertyBundle->resetProperty();
							$objPropertyBundle->setProperty("isActive", 1);
							$objPropertyBundle->setProperty("property_id", $ThisMonthList["property_id"]);
							$objPropertyBundle->lstPropertyBundle();
							$PropertyDetail = $objPropertyBundle->dbFetchArray(1);
						?>
              <br />
              <code><?php echo $PropertyDetail["block_name"].'/'.$PropertyDetail["building_no"].'/'.$PropertyDetail["floor_name"].'/'.$PropertyDetail["property_number"].'/'.$PropertyDetail["property_code"].'/'.PropertyTypeById($PropertyDetail["property_type"]);?> <strong>(Rs.<?php echo $ThisMonthList["total_amount"];?>)</strong></code>
              <?php } ?>
              <br />
              <colgroup><strong>Bill Month: </strong><?php echo MonthList($MonthlyRentDetail["rent_of_month"]).' / '.$MonthlyRentDetail["rent_year"];?></colgroup>
            </div>
            
          </div>
        </div>
        <div class="col-md-12">
          <div class="card">
            <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
              <input type="hidden" name="mode" value="<?php echo $mode;?>">
              <input type="hidden" name="mri" value="<?php echo $objBF->encrypt($MonthlyRentDetail["monthly_rent_id"], ENCRYPTION_KEY);?>">
              <input type="hidden" name="md" value="<?php echo $objBF->encrypt('ca', ENCRYPTION_KEY);?>">
              <div class="card-content">
                <div class="col-md-12 Bord-Rt no-border-right">
                  <div class="row">
                    <label class="col-sm-12" style="text-align:center">Entery Amount</label>
                    <div class="col-sm-12">
                      <div class="form-group label-floating<?php echo is_form_error($vResult,'collection_amount');?>">
                        <label class="control-label"></label>
                        <input class="form-control" type="number" style="text-align:center;" name="collection_amount" max="<?php echo $MonthlyRentDetail["total_rent_amount"];?>" required value="<?php echo $collection_amount;?>" tabindex="1" />
                        <small><?php echo $vResult["collection_amount"];?></small> </div>
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
        <div class="col-md-12">
          <div class="card" style="margin-top:5px; margin-bottom:5px;">
            <div class="card-content" style="text-align:center"> <strong>Monthly Amount Paid.</strong><br />
            </div>
          </div>
        </div>
        <?php } } else { ?>
        <a href="<?php echo Route::_('show=getcollection&s='.EncData('6', 2, $objBF));?>">
        <div class="col-md-12">
          <div class="card" style="margin-top:10px; margin-bottom:10px;">
            <div class="card-content" style="text-align:center"> Shop Name </div>
          </div>
        </div>
        </a> <a href="<?php echo Route::_('show=getcollection&s='.EncData('1', 2, $objBF));?>">
        <div class="col-md-12">
          <div class="card" style="margin-top:10px; margin-bottom:10px;">
            <div class="card-content" style="text-align:center"> Tenant Name </div>
          </div>
        </div>
        </a> <a href="<?php echo Route::_('show=getcollection&s='.EncData('2', 2, $objBF));?>">
        <div class="col-md-12">
          <div class="card" style="margin-top:10px; margin-bottom:10px;">
            <div class="card-content" style="text-align:center"> Tenant CNIC </div>
          </div>
        </div>
        </a> <a href="<?php echo Route::_('show=getcollection&s='.EncData('3', 2, $objBF));?>">
        <div class="col-md-12">
          <div class="card" style="margin-top:10px; margin-bottom:10px;">
            <div class="card-content" style="text-align:center"> Tenant Phone# </div>
          </div>
        </div>
        </a> <a href="<?php echo Route::_('show=getcollection&s='.EncData('4', 2, $objBF));?>">
        <div class="col-md-12">
          <div class="card" style="margin-top:10px; margin-bottom:10px;">
            <div class="card-content" style="text-align:center"> Bill No. </div>
          </div>
        </div>
        </a> <a href="<?php echo Route::_('show=getcollection&s='.EncData('5', 2, $objBF));?>" style="display:none;">
        <div class="col-md-12">
          <div class="card" style="margin-top:10px; margin-bottom:10px;">
            <div class="card-content" style="text-align:center"> Property Code </div>
          </div>
        </div>
        </a>
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
