<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <form id="TypeValidation" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
            <div class="card-header card-header-text" data-background-color="rose">
              <h4 class="card-title"><?php echo 'Re-Assign Block to Employee';?></h4>
            </div>
            <div class="toolbar btn-back text-right"> <a href="<?php echo Route::_('show=lstassigntoemp');?>" class="btn">Back</a> </div>
            <div class="card-content">
            <div class="col-md-12 Bord-Rt no-border-right">
            
            
            
            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                <thead>
                  <tr>
                  	<th style="width:5%"><input type="checkbox" id="checkAll"></th>
                    <th>Block</th>
                  </tr>
                </thead>
                <tbody>
                <?php
					$objSSSinventory->resetProperty();
					$objSSSinventory->setProperty("isNot", 3);
					$objSSSinventory->setProperty("ORDERBY", 'block_name');
					if(trim(DecData($_GET["i"], 1, $objBF)) !=''){
					$objSSSinventory->setProperty("block_id", trim(DecData($_GET["b"], 1, $objBF)));	
					}
					$objSSSinventory->lstBlocks();
					while($ListOfBlocks = $objSSSinventory->dbFetchArray(1)){
				?>
                  <tr>
                  	<td><input type="checkbox" class="leadscheckbox" name="block_id" required value="<?php echo $ListOfBlocks["block_id"];?>"></td>
                    <td><?php echo $ListOfBlocks["block_name"];?></td>
					</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
              
            
            <hr>
            
            <div class="row">
              <div class="col-sm-5">
              <label class="label-on-left">Select Employee</label>
                <div class="form-group label-floating">
                  <select class="selectpicker" data-style="select-with-transition" name="employee_id" required title="Employee List" tabindex="2">
					<?php
                    $objQayaduser->resetProperty();
					$objQayaduser->setProperty("isNot", 3);
					$objQayaduser->setProperty("user_type_id", 4);
					$objQayaduser->setProperty("user_id_not", trim(DecData($_GET["i"], 1, $objBF)));	
					$objQayaduser->setProperty("ORDERBY", 'user_fname DESC');
					$objQayaduser->lstUsers();
					while($ListOfUsers = $objQayaduser->dbFetchArray(1)){
                    ?>
                  	<option value="<?php echo $ListOfUsers["user_id"];?>"><?php echo $ListOfUsers["fullname"];?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              
              
            </div>
            
            
            <div class="card-footer text-center col-md-12">
              <button type="submit" class="btn btn-rose btn-fill submitbutton">Submit</button>
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
