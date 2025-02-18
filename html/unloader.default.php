<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
      <h3 class="card-title CardWidth">Unloader Detail</h3>
      <div class="toolbar add-btn text-right mt-50px">  </div>
        <div class="card">
          <div class="card-content">
            <div class="material-datatables">
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    <th>Business Title</th>
                   	<th>Person Name</th>
                    
                    <th>Phone#</th>
                    <th>Mobile#</th>
                    <th>Address</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSjatlanLocation = new SSSjatlan;
					$objSSSjatlanCategory = new SSSjatlan;
					$objSSSjatlan->resetProperty();
					$objSSSjatlan->setProperty("ORDERBY", 'customer_id DESC');
					$objSSSjatlan->setProperty("customer_type", 3);
					$objSSSjatlan->setProperty("isNot", 3);
					$objSSSjatlan->lstCustomers();
					while($CustomerList = $objSSSjatlan->dbFetchArray(1)){
						
						$objSSSjatlanLocation->resetProperty();
						$objSSSjatlanLocation->setProperty("location_id", $CustomerList["location_id"]);
						$objSSSjatlanLocation->lstLocation();
						$GetCustomerLocation = $objSSSjatlanLocation->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php echo $CustomerList["customer_business_name"];?></td>
                    <td><?php echo $CustomerList["customer_name"];?></td>
                    
                    <td><?php echo $CustomerList["customer_phone"];?></td>
                    <td><?php echo $CustomerList["customer_mobile"];?></td>
                    <td><?php echo $CustomerList["customer_address"];?></td>
                    <td><a href="<?php echo Route::_('show=unloaderform&i='.EncData($CustomerList["customer_id"], 2, $objBF));?>"><i class="material-icons">edit</i></a></td>
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