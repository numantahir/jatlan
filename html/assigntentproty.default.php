<?php
$objSSSinventory->resetProperty();
$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));
$objSSSinventory->lstTenantInformation();
$GetTenantInfo = $objSSSinventory->dbFetchArray(1);
?>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Assign Property to '.$GetTenantInfo["tenant_name"];?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=lsttenants');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th style="width:5%"><input type="checkbox" id="checkAll"></th>
                    <th>Block</th>
                    <th>Building No.</th>
                    <th>Floor</th>
                    <th>Type</th>
                    <th>Pro No.</th>
                    <th>Pro Code.</th>
                    <th>Monthly</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'block_name, building_no, floor_name, property_number');
					$objSSSinventory->setProperty("tenant_status", 2);
					$objSSSinventory->lstPropertyBundle();
					while($ListOfProperties = $objSSSinventory->dbFetchArray(1)){
				?>
                  <tr>
                  	<td><input type="checkbox" class="leadscheckbox" name="property_id[]" required value="<?php echo $ListOfProperties["property_id"];?>"></td>
                    <td><?php echo $ListOfProperties["block_name"];?></td>
                    <td><?php echo $ListOfProperties["building_no"];?></td>
                     <td><?php echo $ListOfProperties["floor_name"];?></td>
                     <td><?php echo PropertyTypeById($ListOfProperties["property_type"]);?></td>
                     <td><?php echo $ListOfProperties["property_number"];?></td>
                     <td><?php echo $ListOfProperties["property_code"];?></td>
                     <td><?php echo $ListOfProperties["monthly_maint"];?></td>
					</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              
            
            <hr>
            
            <div class="row">
              <div class="col-sm-5">
              <label class="label-on-left">Select Tenant</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="tenant_id" required title="Tenant List" tabindex="2">
					<?php
                    $objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					if(trim(DecData($_GET["i"], 1, $objBF)) !=''){
					$objSSSinventory->setProperty("tenant_id", trim(DecData($_GET["i"], 1, $objBF)));		
					}
					$objSSSinventory->setProperty("ORDERBY", 'tenant_id');
					$objSSSinventory->lstTenantInformation();
					while($ListOfTenant = $objSSSinventory->dbFetchArray(1)){
						if($GetTenantInfo["tenant_id"] !=''){
							$selected_va = ' selected="selected"';
						} else {
							$selected_va = '';
						}
                    ?>
                  	<option<?php echo $selected_va;?> value="<?php echo $ListOfTenant["tenant_id"];?>"><?php echo $ListOfTenant["tenant_name"];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill">Submit</button>
              <button type="reset" class="btn btn-fill">Reset</button>
            </div>
          </form>
        </div>
      </div>
      <!-- end col-md-12 --> 
    </div>
    <!-- end row --> 
  </div>
</div>
