<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <?php if($_GET["i"]==''){?>
      <h3 class="card-title CardWidth">List of Supplier's</h3>
      <div class="toolbar add-btn text-right mt-50px"> <a href="<?php echo Route::_('show=suppliersform');?>" class="btn btn-primary">Add New</a> </div>
      <?php } else { 
	  		
			$objSSSjatlan->resetProperty();
			$objSSSjatlan->setProperty("customer_id", trim($objBF->decrypt($_GET['i'], 1, ENCRYPTION_KEY)));
			$objSSSjatlan->lstCustomers();
			$CustomerInfo = $objSSSjatlan->dbFetchArray(1);
			
						$objSSSjatlan->resetProperty();
						$objSSSjatlan->setProperty("category_id", $CustomerInfo["customer_category"]);
						$objSSSjatlan->lstCustomerCategory();
						$GetCustomerCategory = $objSSSjatlan->dbFetchArray(1);
						
						$objSSSjatlan->resetProperty();
						$objSSSjatlan->setProperty("location_id", $CustomerInfo["location_id"]);
						$objSSSjatlan->lstLocation();
						$GetCustomerLocation = $objSSSjatlan->dbFetchArray(1);
	  ?>
      <h3 class="card-title CardWidth">Supplier Detail :: <span class="text-primary"><?php echo $CustomerInfo["customer_name"];?></span></h3>
      <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=suppliers');?>" class="btn">Back</a> </div>
      <?php } ?>
        <div class="card">
          <div class="card-content">
            <?php if($_GET["i"]==''){?>
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Business Title</th>
                   	<th>Person Name</th>
                    <th>Location</th>
                    <th>Phone#</th>
                    <th>Mobile#</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSjatlanLocation = new SSSjatlan;
					$objSSSjatlanCategory = new SSSjatlan;
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("ORDERBY", 'customer_id DESC');
					$objSSSjatlan->setProperty("customer_type", 2);
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->lstCustomers();
					while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
						
						$objSSSjatlanLocation->resetProperty();
						$objSSSjatlanLocation->setProperty("location_id", $CustomerList["location_id"]);
						$objSSSjatlanLocation->lstLocation();
						$GetCustomerLocation = $objSSSjatlanLocation->dbFetchArray(1);
				?>
                  <tr>
                    <td><a href="<?php echo Route::_('show=suppliers&i='.EncData($CustomerList["customer_id"], 2, $objBF));?>"><?php echo $CustomerList["customer_business_name"];?></a></td>
                    <td><?php echo $CustomerList["customer_name"];?></td>
                    <td><?php echo $GetCustomerLocation["location_name"];?></td>
                    <td><?php echo $CustomerList["customer_phone"];?></td>
                    <td><?php echo $CustomerList["customer_mobile"];?></td>
                    <td><a href="<?php echo Route::_('show=suppliersform&i='.EncData($CustomerList["customer_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <?php } else { ?>
            <div class="table-responsive">
              <table class="table" cellspacing="0" width="100%" style="width:100%">
                <tbody>
                  <tr>
                    <td class="text-primary label-type">Customer Name</td>
                    <td class="value"><?php echo $CustomerInfo["customer_name"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Phone #</td>
                    <td class="value"><?php echo $CustomerInfo["customer_phone"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Mobile #</td>
                    <td class="value"><?php echo $CustomerInfo["customer_mobile"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Email</td>
                    <td class="value"><?php echo $CustomerInfo["customer_email"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Address</td>
                    <td class="value"><?php echo $CustomerInfo["customer_address"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Location</td>
                    <td class="value"><?php echo $GetCustomerLocation["location_name"];?></td>
                  </tr>
                  <tr>
                    <td class="text-primary label-type">Business/Shop Name</td>
                    <td class="value"><?php echo $CustomerInfo["customer_business_name"];?></td>
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