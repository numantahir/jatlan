<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">work</i> </div>
          <div class="card-content">
          <?php if(trim(DecData($_GET["v"], 1, $objBF)) == 'detail'){
				$objSSSinventory->resetProperty();
				$objSSSinventory->setProperty("generate_bill_id", trim(DecData($_GET['i'], 1, $objBF)));
				$objSSSinventory->lstGenMonthlyBill();
				$GenInfo = $objSSSinventory->dbFetchArray(1);
			  ?>
           <h3 class="card-title CardWidth">(<?php echo MonthList($GenInfo["current_month"]) . ' / '. $GenInfo["current_year"];?>) Generated Bill Detail</h3>
           <?php } else { ?>
           <h3 class="card-title CardWidth">Monthly Bill Generate Management</h3>
           <div class="toolbar add-btn text-right"><a href="<?php echo Route::_('show=getbillreqfrm');?>" class="btn btn-primary">Add New</a> </div>
           <?php } ?>
            <div class="material-datatables">
              <?php if(trim(DecData($_GET["v"], 1, $objBF)) != 'detail'){?>
              
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                <thead>
                  <tr>
                    <th>Month</th>
                    <th>Year</th>
                   <!-- <th>No.of Tenant</th>
                    <th>Total Amount</th>-->
                    <th>Status</th>
                    <th>Request Date</th>
                    <th>View</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'generate_bill_id DESC');
					$objSSSinventory->lstGenMonthlyBill();
					while($ListofGen = $objSSSinventory->dbFetchArray(1)){
				?>
                  <tr>
                    <td><?php echo MonthList($ListofGen["current_month"]);?></td>
                    <td><?php echo $ListofGen["current_year"];?></td>
                    <!--<td><?php echo $ListofGen["no_of_tenant"];?></td>
                     <td><?php echo 'Rs.'.$ListofGen["generated_amount"];?></td>-->
                     <td><?php echo GenerateBillStatus($ListofGen["process_status"]);?></td>
                     <td><?php echo dateFormate_4($ListofGen["entery_date"]);?></td>
                     <td>
                     <?php if($ListofGen["process_status"]==1){?>
                     <a href="<?php echo Route::_('show=getbillrequest&v='.EncData('detail', 2, $objBF).'&i='.EncData($ListofGen["generate_bill_id"], 2, $objBF));?>">View</a>
                     <?php } else { ?>
                     View
                     <?php } ?>
                     </td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              <?php } else {?>
              <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0">
                <thead>
                  <tr>
                    <th>Block Name</th>
                    <th>Assign To</th>
                    <th>Generate & Download PDF</th>
                  </tr>
                </thead>
                <tbody>
                <?php
				if($objCheckLogin->user_type == 2){
					$objSSSAssignTo = new SSSinventory;
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'block_id');
					$objSSSinventory->lstBlocks();
					while($ListOfBlocks = $objSSSinventory->dbFetchArray(1)){
							
							$objQayaduser->resetProperty();
							$objSSSAssignTo->resetProperty();
							$objSSSAssignTo->setProperty("block_id", $ListOfBlocks ['block_id']);
							$objSSSAssignTo->lstAssignToEmployeeProperty();
							$AssignTo = $objSSSAssignTo->dbFetchArray(1);

				?>
                  <tr>
                    <td><?php echo $ListOfBlocks["block_name"];?></td>
                    <td><?php echo $objQayaduser->GetUserFullName($AssignTo["employee_id"]);?></td>
                     <td><a href="<?php echo SITE_URL.'d.php?i='.base64_encode($GenInfo["generate_bill_id"]).'&b='.base64_encode($ListOfBlocks["block_id"]); //echo SITE_URL.'d.php?i='.EncData($GenInfo["generate_bill_id"], 2, $objBF).'&b='.EncData($ListOfBlocks["block_id"], 2, $objBF);?>" target="new">Generate & Download PDF</a></td>
                  </tr>
                  <?php } } elseif($objCheckLogin->user_type == 4){
					  
					$objSSSAssignTo = new SSSinventory;
					
					$objQayaduser->resetProperty();
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("employee_id", trim(DecData($objQayaduser->user_id, 1, $objBF)));
					$objSSSinventory->setProperty("GROUPBY", 'block_id');
					
					$objSSSinventory->lstAssignToEmployeeProperty();
					while($AssignTo = $objSSSinventory->dbFetchArray(1)){

						$objSSSAssignTo->resetProperty();
						$objSSSAssignTo->setProperty("block_id", $AssignTo['block_id']);
						$objSSSAssignTo->lstBlocks();
						$ListOfBlocks = $objSSSAssignTo->dbFetchArray(1);
				?>
                  <tr>
                    <td><?php echo $ListOfBlocks["block_name"];?></td>
                    <td><?php echo $objQayaduser->GetUserFullName($AssignTo["employee_id"]);?></td>
                     <td><a href="<?php echo SITE_URL.'d.php?i='.base64_encode($GenInfo["generate_bill_id"]).'&b='.base64_encode($ListOfBlocks["block_id"]).'&d='.rand(99,999).rand(99,999); //echo SITE_URL.'d.php?i='.EncData($GenInfo["generate_bill_id"], 2, $objBF).'&b='.EncData($ListOfBlocks["block_id"], 2, $objBF);?>" target="new">Generate & Download PDF</a></td>
                  </tr>
                  <?php } }?>
                </tbody>
              </table>
              <?php } ?>
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