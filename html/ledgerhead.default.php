<?php
if(trim(DecData($_GET["t"], 1, $objBF)) == 1){
$HeaderTitle = "List of General Head's";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 2){
$HeaderTitle = "List of Cash Head's";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 3){
$HeaderTitle = "List of Bank Account's";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 4){
$HeaderTitle = "List of Customer Head's";
} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 5){
$HeaderTitle = "List of Employee Head's";
}
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-icon" data-background-color="purple"> <i class="material-icons">attach_money</i> </div>
          <div class="card-content">
            <h4 class="card-title CardWidth"><?php echo $HeaderTitle;?></h4>
            <div class="toolbar text-right">  </div>
            <hr>
            <div class="material-datatables">
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                    
                    <?php if(trim(DecData($_GET["t"], 1, $objBF)) == 4 or trim(DecData($_GET["t"], 1, $objBF)) == 'CD'){?>
                    <th>Title / Name</th>
                    <th>Location</th>
                    <?php } else { ?>
                    <th style="width:95%">Title / Name</th>
                    <?php } ?>
                    <th>View Ledger</th>
                  </tr>
                </thead>
                <tbody>
					<?php
                    $objQayadaccount->resetProperty();
                    $objQayadaccount->setProperty("isActive", 1);
					if(trim(DecData($_GET["t"], 1, $objBF)) == 'CD'){
					$objQayadaccount->setProperty("head_type_id", 4);
					} elseif(trim(DecData($_GET["t"], 1, $objBF)) == 'SD'){
					$objQayadaccount->setProperty("head_type_id", 6);
					} else {
					$objQayadaccount->setProperty("head_type_id", trim(DecData($_GET["t"], 1, $objBF)));
					}
					$objQayadaccount->setProperty("ORDERBY", 'head_title');
                    $objQayadaccount->lstHead();
                    while($AccountHeadList = $objQayadaccount->dbFetchArray(1)){
                    ?>
                     <tr>
                    <td><?php echo $AccountHeadList["head_title"];?></td>
                    <?php if(trim(DecData($_GET["t"], 1, $objBF)) == 4 or trim(DecData($_GET["t"], 1, $objBF)) == 'CD'){
						$objSSSjatlan->resetProperty();
						$objSSSjatlan->setProperty("customer_id", $AccountHeadList["entity_id"]);
						$objSSSjatlan->lstCustomers();
						$CustomerInfo = $objSSSjatlan->dbFetchArray(1);
						?>
                    <td><?php echo $CustomerInfo["customer_address"];?></td>
                    <?php } ?>
                    <td>
                    <?php if(trim(DecData($_GET["t"], 1, $objBF)) == 'CD'){?>
                    <a href="<?php echo Route::_('show=ledgerheaddetail&i='.EncData($AccountHeadList["head_id"], 2, $objBF).'&t='.EncData('CD', 2, $objBF));?>">View Ledger</a>
                    <?php } elseif(trim(DecData($_GET["t"], 1, $objBF)) == 'SD'){?>
                     <a href="<?php echo Route::_('show=ledgerheaddetail&i='.EncData($AccountHeadList["head_id"], 2, $objBF).'&t='.EncData('SD', 2, $objBF));?>">View Ledger</a>
                    <?php } else { ?>
                     <a href="<?php echo Route::_('show=ledgerheaddetail&i='.EncData($AccountHeadList["head_id"], 2, $objBF).'&t='.EncData($AccountHeadList["head_type_id"], 2, $objBF));?>">View Ledger</a>
                    <?php } ?>
                    
                    </td>
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